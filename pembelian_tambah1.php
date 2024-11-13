<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pelanggan'], $_POST['produk'])) {
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
    $produk = $_POST['produk'];
    $total = 0;
    $tanggal = date('Y-m-d H:i:s');

    // Menyimpan data penjualan
    $stmt = $koneksi->prepare("INSERT INTO penjualan (tanggal_penjualan, id_pelanggan) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $koneksi->error);
    }
    $stmt->bind_param("si", $tanggal, $id_pelanggan);
    
    if ($stmt->execute()) {
        $idTerakhir = $koneksi->insert_id;

        foreach ($produk as $key => $val) {
            if ($val > 0) { 
                $stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
                $stmt->bind_param("i", $key);
                $stmt->execute();
                $result = $stmt->get_result();
                $pr = $result->fetch_array();

                if ($pr) {
                    $sub = $val * $pr['harga'];
                    $total += $sub;

                    // Menyimpan detail penjualan
                    $stmtDetail = $koneksi->prepare("INSERT INTO detail_penjualan (id_penjualan, id_produk, jumlah_produk, sub_total) VALUES (?, ?, ?, ?)");
                    if (!$stmtDetail) {
                        die("Prepare detail failed: " . $koneksi->error);
                    }
                    $stmtDetail->bind_param("iiid", $idTerakhir, $key, $val, $sub);
                    if (!$stmtDetail->execute()) {
                        echo '<div class="alert alert-danger">Gagal menambah detail penjualan: ' . $stmtDetail->error . '</div>';
                        exit;
                    }

                    // Mengurangi stok produk
                    $new_stock = $pr['stok'] - $val;
                    if ($new_stock >= 0) {
                        $stmtUpdateStock = $koneksi->prepare("UPDATE produk SET stok = ? WHERE id_produk = ?");
                        $stmtUpdateStock->bind_param("ii", $new_stock, $key);
                        if (!$stmtUpdateStock->execute()) {
                            echo '<div class="alert alert-danger">Gagal memperbarui stok: ' . $stmtUpdateStock->error . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">Stok tidak mencukupi untuk produk: ' . htmlspecialchars($pr['nama_produk']) . '.</div>';
                    }
                } else {
                    echo '<div class="alert alert-warning">Produk tidak ditemukan.</div>';
                }
            }
        }

        // Memperbarui total harga penjualan
        $stmtUpdate = $koneksi->prepare("UPDATE penjualan SET total_harga = ? WHERE id_penjualan = ?");
        $stmtUpdate->bind_param("di", $total, $idTerakhir);
        if ($stmtUpdate->execute()) {
            $_SESSION['total_harga'] = $total; // Simpan total harga ke sesi
            echo '<div class="alert alert-success">Berhasil menambah data.</div>';
            echo '<script>window.location.href="?page=pembelian";</script>';
        } else {
            echo '<div class="alert alert-danger">Gagal memperbarui total harga: ' . $stmtUpdate->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Gagal menambah data penjualan: ' . $stmt->error . '</div>';
    }
}

?>

<div class="container">
    <!-- Form Pembelian Produk -->
<h2>Form Pembelian Produk</h2>
    <form method="post" action="pembelian_proses.php">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan semua produk yang tersedia
                $produkQuery = mysqli_query($koneksi, "SELECT * FROM produk");
                while ($produk = mysqli_fetch_array($produkQuery)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($produk['nama_produk']); ?></td>
                    <td><?php echo $produk['stok']; ?></td>
                    <td><?php echo number_format($produk['harga'], 2, ',', '.'); ?></td>
                    <td>
                        <input class="form-control" type="number" name="produk[<?php echo $produk['id_produk']; ?>]" min="0" max="<?php echo $produk['stok']; ?>" value="0" oninput="hitungTotal()">
                    </td>
                    <td id="subtotal-<?php echo $produk['id_produk']; ?>">0.00</td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <!-- Total Harga -->
        <div class="form-group row">
            <label for="totalHarga" class="col-sm-2 col-form-label">Total Harga</label>
            <div class="col-sm-10">
                <input type="text" id="totalHarga" class="form-control" value="0.00" readonly>
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="form-group row">
            <label for="tunai" class="col-sm-2 col-form-label">Tunai</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="tunai" name="tunai" oninput="hitungKembalian()">
            </div>
        </div>

        <!-- Kembalian -->
        <div class="form-group row">
            <label for="kembalian" class="col-sm-2 col-form-label">Kembalian</label>
            <div class="col-sm-10">
                <input type="text" id="kembalian" class="form-control" value="0.00" readonly>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk menghitung total harga berdasarkan produk yang dipilih
    function hitungTotal() {
        let totalHarga = 0;
        // Ambil semua input produk yang ada
        document.querySelectorAll('input[name^="produk["]').forEach(function(input) {
            let jumlah = parseInt(input.value) || 0; // Jumlah yang dimasukkan
            let harga = parseFloat(input.closest('tr').querySelector('td:nth-child(3)').innerText.replace(/\./g, '').replace(',', '.')); // Harga produk

            let subtotal = jumlah * harga; // Hitung subtotal
            input.closest('tr').querySelector('td[id^="subtotal-"]').innerText = subtotal.toFixed(2);

            totalHarga += subtotal; // Hitung total harga
        });

        // Menampilkan total harga di halaman
        document.getElementById('totalHarga').value = totalHarga.toFixed(2);
    }

    // Fungsi untuk menghitung kembalian setelah pembayaran
    function hitungKembalian() {
        let totalHarga = parseFloat(document.getElementById('totalHarga').value) || 0;
        let tunai = parseFloat(document.getElementById('tunai').value) || 0;
        
        // Hitung kembalian
        let kembalian = tunai - totalHarga;
        
        // Menampilkan kembalian di halaman
        document.getElementById('kembalian').value = kembalian.toFixed(2);
    }
</script>


</div>


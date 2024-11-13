<?php 
include('koneksi.php');  // Pastikan koneksi sudah benar

// Proses penyimpanan pembelian
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_pelanggan'], $_POST['produk'])) {
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);  // Pastikan menggunakan escape untuk keamanan
    $produk = $_POST['produk'];  // Produk yang dipilih
    $total_harga = 0;  // Total harga yang dihitung
    $tanggal = date('Y-m-d H:i:s');  // Tanggal transaksi

    // Menyimpan data penjualan
    $stmt = $koneksi->prepare("INSERT INTO penjualan (tanggal_penjualan, id_pelanggan) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $koneksi->error);
    }
    $stmt->bind_param("si", $tanggal, $id_pelanggan);
    
    if ($stmt->execute()) {
        $idTerakhir = $koneksi->insert_id;  // Ambil ID penjualan terakhir yang baru saja disimpan

        // Proses detail penjualan
        foreach ($produk as $key => $val) {
            if ($val > 0) {  // Pastikan jumlah produk lebih dari 0
                $stmt = $koneksi->prepare("SELECT * FROM produk WHERE id_produk = ?");
                $stmt->bind_param("i", $key);
                $stmt->execute();
                $result = $stmt->get_result();
                $pr = $result->fetch_array();

                if ($pr) {
                    $sub = $val * $pr['harga'];  // Subtotal per produk
                    $total_harga += $sub;  // Tambahkan ke total harga

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

        $stmt = $koneksi->prepare("INSERT INTO penjualan (tanggal_penjualan, id_pelanggan, total_harga, tunai, kembalian) VALUES (NOW(), ?, ?, ?, ?)");
$stmt->bind_param("iddd", $id_pelanggan, $total_harga, $tunai, $kembalian);

if ($stmt->execute()) {
    echo "<script>alert('Pembelian berhasil!');</script>";
} else {
    echo "<script>alert('Gagal menyimpan data pembelian: " . $stmt->error . "');</script>";
}


        // Memperbarui total harga penjualan
        $stmtUpdate = $koneksi->prepare("UPDATE penjualan SET total_harga = ? WHERE id_penjualan = ?");
        $stmtUpdate->bind_param("di", $total_harga, $idTerakhir);
        if ($stmtUpdate->execute()) {
            $_SESSION['total_harga'] = $total_harga;  // Simpan total harga ke sesi
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


<div class="container-fluid  px-4">
    <h1 class="mt-4">Stok Produk</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Stok Produk</li>
    </ol>
    <a href="?page=pembelian_user" class="btn btn-danger">Kembali</a>
    <hr>
    <form method="post">
        <table class="table table-bordered">
        </table>

        <!-- Tabel untuk stok produk -->
        <h5>Stok Produk</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $pro = mysqli_query($koneksi, "SELECT * FROM produk");
                while ($produk = mysqli_fetch_array($pro)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($produk['nama_produk']); ?></td>
                    <td><?php echo htmlspecialchars($produk['stok']); ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <form method="post" action="pembelian.php">
    <!-- Tabel Produk -->
    <table class="table table-bordered mb-4">
    <h1 class="mt-4">Produk Yang di Pesan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pembelian</li>
    </ol><hr>
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <td>
                    <select class="form-control" id="id_pelanggan" name="id_pelanggan" required>
                        <option value="">Pilih Pelanggan</option>
                        <?php
                        // Menampilkan daftar pelanggan
                        $p = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while ($pel = mysqli_fetch_array($p)) {
                            echo "<option value='" . htmlspecialchars($pel['id_pelanggan']) . "'>" . htmlspecialchars($pel['nama_pelanggan']) . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </thead>
                    </table>
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
            // Menampilkan produk
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
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
</form><br><br>
</div>
</div>
<script>
    function hitungTotal() {
    let totalHarga = 0;
    document.querySelectorAll('input[name^="produk["]').forEach(input => {
        let jumlah = parseInt(input.value) || 0;
        let harga = parseFloat(input.closest('tr').querySelector('td:nth-child(3)').innerText.replace(/\./g, '').replace(',', '.'));
        let subtotal = jumlah * harga;
        input.closest('tr').querySelector('td[id^="subtotal-"]').innerText = subtotal.toFixed(2);
        totalHarga += subtotal;
    });
    document.getElementById('totalHarga').value = totalHarga.toFixed(2);
}

function hitungKembalian() {
    let totalHarga = parseFloat(document.getElementById('totalHarga').value) || 0;
    let tunai = parseFloat(document.getElementById('tunai').value) || 0;
    let kembalian = tunai - totalHarga;
    document.getElementById('kembalian').value = kembalian.toFixed(2);
}

window.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[name^="produk["]').forEach(input => {
        input.addEventListener('input', function() {
            hitungTotal();
            hitungKembalian();
        });
    });

    document.getElementById('tunai').addEventListener('input', hitungKembalian);
});

</script>




    <!-- <form method="post">
        <table class="table table-bordered">
            <tr>
                <td width="200px">Nama Pelanggan</td>
                <td width="1">:</td>
                <td>
                    <select class="form-control form-select" name="id_pelanggan" required>
                        <option value="">Pilih Pelanggan</option>
                        <?php 
                        $p = mysqli_query($koneksi, "SELECT * FROM pelanggan");
                        while ($pel = mysqli_fetch_array($p)) {
                        ?>
                            <option value="<?php echo htmlspecialchars($pel['id_pelanggan']); ?>">
                                <?php echo htmlspecialchars($pel['nama_pelanggan']); ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <?php 
            $pro = mysqli_query($koneksi, "SELECT * FROM produk");
            while ($produk = mysqli_fetch_array($pro)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($produk['nama_produk']); ?></td>
                <td>:</td>
                <td>
                    <input class="form-control" type="number" min="0" max="<?php echo htmlspecialchars($produk['stok']); ?>" 
                           name="produk[<?php echo $produk['id_produk']; ?>]" 
                           value="0" required 
                           oninput="hitungTotal()" 
                           data-harga="<?php echo htmlspecialchars($produk['harga']); ?>"
                           data-nama="<?php echo htmlspecialchars($produk['nama_produk']); ?>">
                </td>
            </tr>
            <?php
            }
            ?>

            <tr>
                <td>Total Harga</td>
                <td>:</td>
                <td id="total-harga">0.00</td>
            </tr>

            <tr>
                <td>Tunai</td>
                <td>:</td>
                <td>
                    <input class="form-control" type="number" name="tunai" id="tunai" required placeholder="Masukkan Uang Tunai" oninput="hitungKembalian()">
                </td>
            </tr>

            <tr>
                <td>Kembalian</td>
                <td>:</td>
                <td id="kembalian">0.00</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </td>
            </tr>

        </table>
    </form> -->
</div>

<!-- <script>
    // Fungsi untuk menghitung total harga berdasarkan produk yang dipilih
    function hitungTotal() {
        let totalHarga = 0;
        // Ambil semua input produk yang ada
        document.querySelectorAll('input[name^="produk["]').forEach(function(input) {
            let jumlah = parseInt(input.value) || 0; // Jumlah yang dimasukkan
            let harga = parseFloat(input.getAttribute('data-harga')); // Harga produk

            totalHarga += jumlah * harga; // Hitung total harga
        });

        // Menampilkan total harga di halaman
        document.getElementById('total-harga').innerText = totalHarga.toFixed(2);
        // Menyimpan total harga dalam form agar bisa diproses saat submit
        document.querySelector('input[name="total_harga"]').value = totalHarga;
    }

    // Fungsi untuk menghitung kembalian setelah pembayaran
    function hitungKembalian() {
        let totalHarga = parseFloat(document.getElementById('total-harga').innerText) || 0;
        let tunai = parseFloat(document.getElementById('tunai').value) || 0;
        
        // Hitung kembalian
        let kembalian = tunai - totalHarga;
        
        // Menampilkan kembalian di halaman
        document.getElementById('kembalian').innerText = kembalian.toFixed(2);
    }
</script>


<script>
function hitungTotal() {
    const totalElement = document.getElementById('total-harga');
    let total = 0;
    const inputs = document.querySelectorAll('input[type="number"]');

    inputs.forEach(input => {
        const jumlah = parseInt(input.value) || 0;
        const harga = parseFloat(input.dataset.harga) || 0;
        total += jumlah * harga;
    });

    totalElement.innerText = total.toFixed(2);
}
</script> -->



<!-- <?php
// Membersihkan sesi untuk total harga
if (isset($_SESSION['total_harga'])) {
    unset($_SESSION['total_harga']);
}
?>
<script>
function hitungTotal() {
    const totalElement = document.getElementById('total-harga');
    let total = 0;
    const inputs = document.querySelectorAll('input[type="number"]');

    inputs.forEach(input => {
        const jumlah = parseInt(input.value) || 0;
        const harga = parseFloat(input.dataset.harga) || 0;
        total += jumlah * harga;
    });

    totalElement.innerText = total.toFixed(2);
}
</script>

<?php
// Membersihkan sesi untuk total harga
if (isset($_SESSION['total_harga'])) {
    unset($_SESSION['total_harga']);
}
?>
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pelanggan'], $_POST['produk'])) {
    $id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
    $produk = $_POST['produk'];
    $total = 0;
    $tanggal = date('Y-m-d H:i:s');

    // Menyimpan data penjualan
    $stmt = $koneksi->prepare("INSERT INTO penjualan (tanggal_penjualan, id_pelanggan) VALUES (?, ?)");
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
                    $stmtDetail->bind_param("iiid", $idTerakhir, $key, $val, $sub);
                    if (!$stmtDetail->execute()) {
                        echo '<div class="alert alert-danger">Gagal menambah detail penjualan: ' . $stmtDetail->error . '</div>';
                        exit;
                    }

                    // Mengurangi stok produk
                    $new_stock = $pr['stok'] - $val;
                    $stmtUpdateStock = $koneksi->prepare("UPDATE produk SET stok = ? WHERE id_produk = ?");
                    $stmtUpdateStock->bind_param("ii", $new_stock, $key);
                    if (!$stmtUpdateStock->execute()) {
                        echo '<div class="alert alert-danger">Gagal memperbarui stok: ' . $stmtUpdateStock->error . '</div>';
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
?> -->

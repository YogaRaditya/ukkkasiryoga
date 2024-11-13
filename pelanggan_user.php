<div class="container-fluid px-4">
<link href="css/styles.css" rel="stylesheet" />
<link rel="icon" type="assets/img" href="assets/img/logo-bn666.png">
    <h1 class="mt-4">Pelanggan</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Pelanggan</li>
    </ol>
    <div class="row mb-4">
    <div class="col-auto">
        <a href="?page=pelanggan_tambah" class="btn btn-primary">+ Tambah Data</a>
    </div>

<script>
function printData() {
    // Ambil data yang ingin dicetak
    const dataToPrint = "Data yang ingin dicetak"; // Ganti dengan data yang sesuai
    
    // Misalnya, tampilkan di konsol atau di elemen tertentu
    console.log(dataToPrint);
    
    // Jika ingin mencetak halaman
    window.print();
}
</script>

<style>
@media print {
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    .no-print {
        display: none; /* Sembunyikan elemen yang tidak ingin dicetak */
    }
    h1, h2, h3 {
        color: black; /* Pastikan warna teks cetak */
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #000;
        padding: 10px;
        text-align: left;
    }
    /* Sesuaikan lebih lanjut sesuai kebutuhan */
}
</style>


</div>
<hr>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-primary text-light">
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>No Telepon</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Pastikan koneksi sudah benar
        include('koneksi.php'); // atau sesuaikan dengan lokasi koneksi Anda

        // Query untuk mengambil data pelanggan
        $query = "SELECT * FROM pelanggan";
        $result = mysqli_query($koneksi, $query);

        // Cek apakah query berhasil
        if ($result) {
            // Loop untuk menampilkan data pelanggan
            while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo htmlspecialchars($data['nama_pelanggan']); ?></td>
                <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                <td><?php echo htmlspecialchars($data['no_telepon']); ?></td>
            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='4'>Data tidak ditemukan</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

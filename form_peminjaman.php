<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $judul = $_POST['judul'];
    $tgl = $_POST['tgl_pinjam'];
    $tenggat = $_POST['tenggat'];

    $sql = "INSERT INTO peminjaman (nim, nama, judul, tanggal_peminjaman, tenggat)
            VALUES ('$nim', '$nama', '$judul', '$tgl', '$tenggat')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>window.location.href = "data_peminjaman.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
$conn->close();
?>

<?php include 'header.php'?>

<div class="d-flex Peminjaman">
    <div class="cardPeminjaman">
        <form action="" method="post">
            <h1>InputData</h1>
            <div class="d-flex cardSec">
                <span>
                    <p>NIM</p>
                    <p>Nama</p>
                    <p>Judul Buku</p>
                    <p>Tanggal Peminjaman</p>
                    <p>Tenggat Peminjaman</p>
                </span>
                <span>
                    <input type="text" name="nim" required> <br>
                    <input type="text" name="nama" required> <br>
                    <input type="text" name="judul" required> <br>
                    <input type="date" name="tgl_pinjam" required> <br>
                    <input type="date" name="tenggat" required> <br>
                </span>
            </div>
            <div class="button">
                <button type="submit" name="submit">SIMPAN</button>
            </div>
        </form>
    </div>

</div>

<?php include 'footer.php'?>
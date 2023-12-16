<?php
include 'koneksi.php';

$id = $tanggal = $denda = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['tanggal'], $_POST['tenggat'], $_POST['judul'])) {
        $id = $_POST['id'];
        $tanggal = $_POST['tanggal'];
        $tenggat = $_POST['tenggat'];
        $judul = $_POST['judul'];

        $queryUpdate = "UPDATE peminjaman SET 
                        tanggal_peminjaman = '$tanggal', 
                        tenggat = '$tenggat',
                        judul = '$judul'
                        WHERE id = $id";

        if (mysqli_query($conn, $queryUpdate)) {
            // echo '<script>alert("Data berhasil diupdate");</script>';
            echo "<script>window.location.href = 'data_peminjaman.php'</script>";
        } else {
            echo "Error: " . $queryUpdate . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Semua kolom harus diisi.";
    }
}

// Fetch the data for the selected ID from the database
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM peminjaman WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tanggal = $row["tanggal_peminjaman"];
        $tenggat = $row["tenggat"];
        $nama = $row["nama"];
        $judul = $row["judul"];
    } else {
        echo "Data tidak ditemukan.";
    }
}
?>
<?php include 'header.php' ?>
<style>
    .formEdit{
    width: 100%;
    padding: 13px;
    display: flex;
    justify-content: center;
    background-color: transparent;
}
</style>


<div class="formEdit">
    <div class="editData">
        <div class="dataCard">
            <form action="" method="post">
                <!-- Add hidden input for ID -->
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <h3 style="text-align: center;">EDIT DATA <?php echo $nama; ?></h3>
                <section>
                    <span>
                        <p>JUDUL BUKU</p>
                        <input type="text" name="judul" value="<?php echo $judul; ?>">
                    </span>
                    <span>
                        <p>TANGGAL PEMINJAMAN</p>
                        <input type="date" name="tanggal" value="<?php echo $tanggal; ?>">
                    </span>
                    <span>
                        <p>TENGGAT</p>
                        <input type="date" name="tenggat" value="<?php echo $tenggat; ?>">
                    </span>
                </section>
                <div class="d-flex" style="justify-content: center;">
                    <button type="submit" name="submit" style="background-color: #AC0000;">BATAL</button>
                    <button type="submit" name="submit" style="background-color: #163E71;">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>
<?php
include 'koneksi.php';

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $sql = "DELETE FROM peminjaman WHERE id= '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Row deleted successfully";
    } else {
        echo "<script>alert('Tidak dapat dihapus, terdapat data dalam tabel child')</script>" . $conn->error;
    }

    $conn->close();
} else {
    echo "<script>alert('Tidak dapat dihapus, terdapat data dalam tabel child')</script>";
}
?>

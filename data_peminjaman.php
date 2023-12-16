<?php
include 'koneksi.php';

$sql = "SELECT * FROM peminjaman";
$result = $conn->query($sql);


$conn->close();
?>

<?php include 'header.php' ?>
<style>
    .tabelPinjam button {
        background-color: transparent;
        border: none;
    }

    .table tr th {
        text-align: center;
    }
    .peminjaman .tabelPinjam {
        border-radius: 20px;
    }
</style>

<div class="peminjaman">
    <div class="tabelPinjam">
        <h1 style="text-align: center; margin-bottom: 20px">DATA PEMINJAMAN DAN DENDA</h1>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">NAMA PEMINJAM</th>
                    <th scope="col">NIM</th>
                    <th scope="col">JUDUL BUKU</th>
                    <th scope="col">TANGGAL PEMINJAMAN</th>
                    <th scope="col">TENGGAT PENGEMBALIAN</th>
                    <th scope="col">NOMINAL DENDA</th>
                    <th scope="col" colspan="2">AKSI</th>
                </tr>
            </thead>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $idMhs = $row['id'];
                    $tenggat_date = strtotime($row['tenggat']);
                    $return_date = strtotime(date('Y-m-d'));

                    if ($return_date > $tenggat_date) {
                        $days_overdue = floor(($return_date - $tenggat_date) / (60 * 60 * 24));
                        $fine_amount_per_day = 1000; // Adjust the fine amount per day as needed
                        $nominal_denda = $days_overdue * $fine_amount_per_day;
                    } else {
                        $nominal_denda = 0;
                    }
                    // Update the "DENDA" column in the database
                    include 'koneksi.php';
                    $updateSql = "UPDATE peminjaman SET denda = '$nominal_denda' WHERE id = " . $row['id'];
                    mysqli_query($conn, $updateSql);
            ?>
                    <tbody>
                        <tr>
                            <th style="display:none;"><?php echo $idMhs; ?></th>
                            <th scope="row"><?php echo $row["nama"]; ?></th>
                            <td><?php echo $row["nim"]; ?></td>
                            <td><?php echo $row["judul"]; ?></td>
                            <td><?php echo $row["tanggal_peminjaman"]; ?></td>
                            <td><?php echo $row["tenggat"]; ?></td>
                            <td><?php echo $nominal_denda; ?></td>
                            <td><button onclick="edit(<?php echo $idMhs; ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 50 50" fill="none">
                                        <path d="M34.3271 6.25838C34.675 6.28963 34.8271 6.71463 34.5771 6.96255L17.2438 24.2959C17.048 24.4918 16.9078 24.7363 16.8375 25.0042L14.7542 32.9834C14.6854 33.2471 14.6868 33.5242 14.7582 33.7871C14.8296 34.0501 14.9686 34.2899 15.1613 34.4826C15.354 34.6753 15.5937 34.8142 15.8567 34.8856C16.1197 34.957 16.3968 34.9584 16.6605 34.8896L24.6375 32.8063C24.9057 32.7354 25.1501 32.5944 25.3459 32.398L42.925 14.8188C42.98 14.7623 43.0501 14.7228 43.1268 14.7049C43.2036 14.687 43.2839 14.6915 43.3582 14.7178C43.4325 14.7441 43.4977 14.7911 43.5461 14.8533C43.5945 14.9155 43.6241 14.9903 43.6313 15.0688C44.3626 22.0472 44.3207 29.085 43.5063 36.0542C43.0417 40.023 39.8521 43.1375 35.898 43.5813C28.6556 44.3842 21.3466 44.3842 14.1042 43.5813C10.148 43.1375 6.95837 40.023 6.49378 36.0542C5.63488 28.7105 5.63488 21.2917 6.49378 13.948C6.95837 9.97713 10.148 6.86255 14.1042 6.42088C20.8219 5.67641 27.5983 5.62196 34.3271 6.25838Z" fill="#163E71" />
                                        <path d="M37.1312 8.82709C37.1796 8.77858 37.237 8.7401 37.3003 8.71384C37.3636 8.68759 37.4314 8.67407 37.4999 8.67407C37.5684 8.67407 37.6363 8.68759 37.6995 8.71384C37.7628 8.7401 37.8203 8.77858 37.8687 8.82709L40.8145 11.775C40.9118 11.8726 40.9665 12.0049 40.9665 12.1427C40.9665 12.2806 40.9118 12.4128 40.8145 12.5104L23.5374 29.7917C23.4716 29.8569 23.3896 29.9036 23.2999 29.9271L19.3124 30.9688C19.2245 30.9917 19.1322 30.9912 19.0445 30.9674C18.9568 30.9436 18.8769 30.8973 18.8127 30.8331C18.7485 30.7688 18.7022 30.6889 18.6784 30.6013C18.6546 30.5136 18.6541 30.4212 18.677 30.3333L19.7187 26.3458C19.7419 26.256 19.7886 26.174 19.8541 26.1083L37.1312 8.82709Z" fill="#163E71" />
                                    </svg>
                                </button></td>
                            <td><button onclick="deleteRow(<?php echo $idMhs; ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="39" viewBox="0 0 50 49" fill="none">
                                        <path d="M20.4334 34.7083H22.5167V16.3333H20.4334V34.7083ZM27.4834 34.7083H29.5668V16.3333H27.4834V34.7083ZM12.5001 40.8333V12.25H10.4167V10.2083H18.7501V8.63623H31.2501V10.2083H39.5834V12.25H37.5001V40.8333H12.5001Z" fill="#163E71" />
                                    </svg>
                                </button></td>
                        </tr>
                    </tbody>
            <?php
                }
            } else {
                echo "<tr><td colspan='12'>No data available</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<script>
    function edit(id) {

        window.location.href = 'formEdit.php?id=' + id;
    }

    function deleteRow(id) {
        var confirmation = confirm("Anda yakin ingin menghapus baris ini?");
        if (confirmation) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "deleteRow.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.send("id=" + id);
        }
    }
</script>

<?php include 'footer.php' ?>
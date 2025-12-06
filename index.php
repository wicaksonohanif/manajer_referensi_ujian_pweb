<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajer Referensi | Ujian PWEB</title>
</head>

<body>
    <div class="container my-5">
        <h2>Manajer Referensi</h2>
        <a class="btn btn-primary" href="create.php" role="button">Tambah Referensi</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Volume</th>
                    <th scope="col">Issue</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Halaman</th>
                    <th scope="col">DOI</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'db_references';

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                    die("Koneksi DB Gagal: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM referensi";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Query Gagal: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['penulis'] . "</td>
                            <td>" . $row['judul'] . "</td>
                            <td>" . $row['penerbit'] . "</td>
                            <td>" . $row['volume'] . "</td>
                            <td>" . $row['issue'] . "</td>
                            <td>" . $row['tahun'] . "</td>
                            <td>" . $row['halaman'] . "</td>
                            <td>" . $row['DOI'] . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='edit.php?id=" . $row['id'] . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=" . $row['id'] . "'>Hapus</a>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">          
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajer Referensi | Ujian PWEB</title>
</head>

<body>


    <div class="layout">

        <aside class="sidebar">            
            
            <br>

            <?php
            $currentSort = $_GET['sort'] ?? 'id';
            $currentOrder = $_GET['order'] ?? 'asc';
            $currentFilter = $_GET['filter'] ?? 'all';
            ?>
            <div class="logoContainer">
                <h3>Cideley</h3>
            </div>
            <p>SORT ASC</p>
            <ul>
                <li><a class="<?= ($currentSort=='id' && $currentOrder=='asc')?'active':'' ?>" href="index.php?sort=id&order=asc&filter=<?= $currentFilter ?>">
                    <img src="assets/icons/id.svg" alt="ID" width="16" height="16">
                    ID</a></li>
                <li><a class="<?= ($currentSort=='penulis' && $currentOrder=='asc')?'active':'' ?>" href="index.php?sort=penulis&order=asc&filter=<?= $currentFilter ?>">
                    <img src="assets/icons/penulis.svg" alt="penulis" width="16" height="16">
                    Penulis</a></li>
                <li><a class="<?= ($currentSort=='judul' && $currentOrder=='asc')?'active':'' ?>"href="index.php?sort=judul&order=asc&filter=<?= $currentFilter ?>">
                    <img src="assets/icons/judul.svg" alt="judul" width="16" height="16">
                    Judul</a></li>
                <li><a class="<?= ($currentSort=='tahun' && $currentOrder=='asc')?'active':'' ?>"href="index.php?sort=tahun&order=asc&filter=<?= $currentFilter ?>">
                    <img src="assets/icons/tahun.svg" alt="tahun" width="16" height="16">
                    Year</a></li>
            </ul>

            <br><br>
            <p>SORT DESC</p>
            <ul>
                <li><a class="<?= ($currentSort=='id' && $currentOrder=='desc')?'active':'' ?>" href="index.php?sort=id&order=desc&filter=<?= $currentFilter ?>">
                    <img src="assets/icons/id.svg" alt="ID" width="16" height="16">
                    ID</a></li>
                <li><a class="<?= ($currentSort=='penulis' && $currentOrder=='desc')?'active':'' ?>" href="index.php?sort=penulis&order=desc&filter=<?= $currentFilter ?>">
                    <img src="assets/icons/penulis.svg" alt="penulis" width="16" height="16">
                    Penulis</a></li>
                <li><a class="<?= ($currentSort=='judul' && $currentOrder=='desc')?'active':'' ?>" href="index.php?sort=judul&order=desc&filter=<?= $currentFilter ?>">
                    <img src="assets/icons/judul.svg" alt="judul" width="16" height="16">
                    Judul</a></li>
                <li><a class="<?= ($currentSort=='tahun' && $currentOrder=='desc')?'active':'' ?>" href="index.php?sort=tahun&order=desc&filter=<?= $currentFilter ?>">
                    <img src="assets/icons/tahun.svg" alt="tahun" width="16" height="16">
                    Year</a></li>
            </ul>
        </aside>
        
        <main class="content">
                <h2>Manajer Referensi</h2>
                <div class="tableButton">
                    <div class="addRef">
                        <a href="create.php" role="button">Tambah Referensi</a>
                    </div>
                    <ul class="filter">
                        <li><a class="<?= ($currentFilter=='all')?'active':'' ?>" href="index.php?filter=all&sort=<?= $currentSort ?>&order=<?= $currentOrder ?>">All</a></li>
                        <li><a class="<?= ($currentFilter=='2020-2025')?'active':'' ?>" href="index.php?filter=2020-2025&sort=<?= $currentSort ?>&order=<?= $currentOrder ?>">2020-2025</a></li>
                        <li><a class="<?= ($currentFilter=='<2020')?'active':'' ?>" href="index.php?filter=<2020&sort=<?= $currentSort ?>&order=<?= $currentOrder ?>"><2020</a></li>
                    </ul>
                </div>

                <br>
                <div class="scrollTable">
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
                        $servername = '127.0.0.1';
                        $username = 'root';
                        $password = '';
                        $database = 'db_references';

                        $connection = new mysqli($servername, $username, $password, $database);

                        if ($connection->connect_error) {
                            die("Koneksi DB Gagal: " . $connection->connect_error);
                        }

                        $sort = $_GET['sort'] ?? 'id';
                        $order = $_GET['order'] ?? 'asc';
                        $filter = $_GET['filter'] ?? 'all';
                        $whereClause = '';
                        if ($filter == '2020-2025') {
                            $whereClause = "WHERE tahun BETWEEN 2020 AND 2025";
                        } elseif ($filter == '<2020') {
                            $whereClause = "WHERE tahun < 2020";
                        }
                        $sql  = "SELECT * FROM referensi $whereClause ORDER BY $sort $order";
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
                                        <a class='tombolEdit' href='edit.php?id=" . $row['id'] . "'>Edit</a>
                                        <a class='tombolHapus' href='delete.php?id=" . $row['id'] . "'>Hapus</a>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
                </div>
        </main>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
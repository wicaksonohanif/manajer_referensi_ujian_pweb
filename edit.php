<?php
$servername = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'db_references';
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$penulis = "";
$judul = "";
$penerbit = "";
$volume = "";
$issue = "";
$tahun = "";
$halaman = "";
$DOI = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM referensi WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    if (!$row) {
        header("location: index.php");
        exit;
    }
    $penulis = $row["penulis"];
    $judul = $row["judul"];
    $penerbit = $row["penerbit"];
    $volume = $row["volume"];
    $issue = $row["issue"];
    $tahun = $row["tahun"];
    $halaman = $row["halaman"];
    $DOI = $row["DOI"];
} else {
    $id = $_POST["id"];
    $penulis = $_POST["penulis"];
    $judul = $_POST["judul"];
    $penerbit = $_POST["penerbit"];
    $volume = $_POST["volume"];
    $issue = $_POST["issue"];
    $tahun = $_POST["tahun"];
    $halaman = $_POST["halaman"];
    $DOI = $_POST["DOI"];

    do {
        if (empty($penulis) || empty($judul) || empty($penerbit) || empty($volume) || empty($issue) || empty($tahun) || empty($halaman) || empty($DOI)) {
            $errorMessage = "Semua field harus diisi";
            break;
        }

        $sql = "UPDATE referensi " .
            "SET penulis = '$penulis', judul = '$judul', penerbit = '$penerbit', volume = '$volume', issue = '$issue', tahun = '$tahun', halaman = '$halaman', DOI = '$DOI' " .
            "WHERE id = $id";

        $result = $connection->query($sql);
        if (!$result) {
            $errorMessage = "Query Gagal: " . $connection->error;
            break;
        }

        $successMessage = "Referensi berhasil diperbarui";

        header("location: index.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajer Referensi | Ujian PWEB</title>
</head>

<body>
    <div class="container my-5">
        <h2>Tambah Referensi</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- Penulis -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Penulis</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="penulis" value="<?php echo $penulis; ?>">
                </div>
            </div>
            <!-- judul -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="judul" value="<?php echo $judul; ?>">
                </div>
            </div>
            <!-- penerbit -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Penerbit</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="penerbit" value="<?php echo $penerbit; ?>">
                </div>
            </div>
            <!-- volume -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Volume</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="volume" value="<?php echo $volume; ?>">
                </div>
            </div>
            <!-- issue -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Issue</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="issue" value="<?php echo $issue; ?>">
                </div>
            </div>
            <!-- tahun -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Tahun</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tahun" value="<?php echo $tahun; ?>">
                </div>
            </div>
            <!-- halaman -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Halaman</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="halaman" value="<?php echo $halaman; ?>">
                </div>
            </div>
            <!-- DOI -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">DOI</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="DOI" value="<?php echo $DOI; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    <a class="btn btn-secondary" href="index.php" role="button">Batal</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
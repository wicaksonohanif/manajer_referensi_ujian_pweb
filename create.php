<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'db_references';
$connection = new mysqli($servername, $username, $password, $database);


$penulis = '';
$judul = '';
$penerbit = '';
$volume = '';
$issue = '';
$tahun = '';
$halaman = '';
$DOI = '';

$errorMessage = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $penulis = $_POST['penulis'];
    $judul = $_POST['judul'];
    $penerbit = $_POST['penerbit'];
    $volume = $_POST['volume'];
    $issue = $_POST['issue'];
    $tahun = $_POST['tahun'];
    $halaman = $_POST['halaman'];
    $DOI = $_POST['DOI'];

    do {
        if (empty($penulis) || empty($judul) || empty($penerbit) || empty($volume) || empty($issue) || empty($tahun) || empty($halaman) || empty($DOI)) {
            $errorMessage = "Semua field harus diisi";
            break;
        }

        $sql = "INSERT INTO referensi (penulis, judul, penerbit, volume, issue, tahun, halaman, DOI) " .
            "VALUES ('$penulis', '$judul', '$penerbit', '$volume', '$issue', '$tahun', '$halaman', '$DOI')";
        $result = $connection->query($sql);
        if (!$result) {
            $errorMessage = "Query Gagal: " . $connection->error;
            break;
        }

        $penulis = "";
        $judul = "";
        $penerbit = "";
        $volume = "";
        $issue = "";
        $tahun = "";
        $halaman = "";
        $DOI = "";

        $successMessage = "Referensi berhasil ditambahkan";

        header("location: index.php");
        exit;

    } while (false);
}
?>

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
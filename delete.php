<?php 
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $servername = '127.0.0.1';
    $username = 'root';
    $password = '';
    $database = 'db_references';
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM referensi WHERE id=$id";
    $connection->query($sql);
}
    header("location: index.php");
    exit;

?>
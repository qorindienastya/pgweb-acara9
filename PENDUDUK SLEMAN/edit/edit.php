<?php
// Tangkap data dari form
$id              = $_POST['id'];
$kecamatan       = $_POST['kecamatan'];
$longitude       = $_POST['longitude'];
$latitude        = $_POST['latitude'];
$luas            = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Setting database
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "latihan";

// Koneksi ke MariaDB
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update data berdasarkan ID
$sql = "UPDATE penduduk SET 
        kecamatan='$kecamatan', 
        longitude='$longitude', 
        latitude='$latitude', 
        luas=$luas, 
        jumlah_penduduk=$jumlah_penduduk 
        WHERE id=$id";

$conn->query($sql);
$conn->close();

// Wajib mengembalikan browser ke index.php di folder luar
header("Location: ../index.php");
exit();
?>
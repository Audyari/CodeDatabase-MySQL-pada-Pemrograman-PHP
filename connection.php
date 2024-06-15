<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    echo "Gagal terhubung ke database!";
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Berhasil terhubung ke database!";
}

?>
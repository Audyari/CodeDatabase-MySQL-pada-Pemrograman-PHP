<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Gagal terhubung ke database!";
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the URL parameter
$id = $_GET['id'];

// Delete the user
$sql = "DELETE FROM users WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Data berhasil dihapus.";
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
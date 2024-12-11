<?php
$conn = new mysqli("localhost", "root", "", "firma");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT COUNT(*) AS liczba FROM pracownicy";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo $row["liczba"];

$conn->close();
?>

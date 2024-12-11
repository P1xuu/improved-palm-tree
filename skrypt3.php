<?php
$conn = new mysqli("localhost", "root", "", "firma");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, imie, nazwisko FROM pracownicy WHERE id = 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $image = $row["id"] . ".jpg";
        echo "<img src='$image' alt='pracownik'>";
        echo "<h2>" . $row["imie"] . " " . $row["nazwisko"] . "</h2>";
    }
}

$sql = "SELECT stanowiska.nazwa, stanowiska.opis FROM stanowiska 
        JOIN pracownicy ON pracownicy.stanowisko_id = stanowiska.id 
        WHERE pracownicy.id = 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h4>" . $row["nazwa"] . "</h4>";
        echo "<h5>" . $row["opis"] . "</h5>";
    }
}

$conn->close();
?>

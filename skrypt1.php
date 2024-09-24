<?php
$conn = new mysqli("localhost", "root", "", "firma");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT imie, nazwisko, adres, miasto, czyRODO, czyBadania FROM pracownicy WHERE id = 2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h3>dane</h3>";
        echo "<p>" . $row["imie"] . " " . $row["nazwisko"] . "</p>";
        echo "<hr>";
        echo "<h3>adres</h3>";
        echo "<p>" . $row["adres"] . "</p>";
        echo "<p>" . $row["miasto"] . "</p>";
        echo "<hr>";
        echo "<p>RODO: " . ($row["czyRODO"] ? "podpisano" : "niepodpisano") . "</p>";
        echo "<p>Badania: " . ($row["czyBadania"] ? "aktualne" : "nieaktualne") . "</p>";
    }
} else {
    echo "Brak danych";
}

$conn->close();
?>

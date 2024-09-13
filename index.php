<?php
// Połączenie z bazą danych
$servername = "localhost";  // Zastąp localhost odpowiednią nazwą hosta
$username = "root";         // Zastąp root odpowiednią nazwą użytkownika
$password = "";             // Zastąp pusty ciąg hasłem użytkownika
$dbname = "sklep_elektronika";

// Utwórz połączenie
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

// Funkcja pobierania danych z tabeli klienci
function getKlienci($conn) {
    $sql = "SELECT id_klienta, nazwa_klienta FROM klienci";
    $result = $conn->query($sql);
    return $result;
}

// Funkcja pobierania danych z tabeli produkty
function getProdukty($conn) {
    $sql = "SELECT id_produktu, nazwa_produktu, cena_produktu FROM produkty";
    $result = $conn->query($sql);
    return $result;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep Elektronika - Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            margin-top: 50px;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Sklep Elektronika - Menu</h1>
    <p>Wybierz co chcesz wyświetlić:</p>

    <!-- Formularz wyboru tabeli -->
    <form action="index.php" method="post">
        <input type="submit" name="show_klienci" value="Pokaż Klientów">
        <input type="submit" name="show_produkty" value="Pokaż Produkty">
    </form>

    <!-- Wyświetlanie wyników -->
    <div>
        <?php
        // Sprawdzenie, którą tabelę wyświetlić
        if (isset($_POST['show_klienci'])) {
            echo "<h2>Lista Klientów</h2>";
            $result = getKlienci($conn);
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID Klienta</th><th>Nazwa Klienta</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id_klienta"] . "</td><td>" . $row["nazwa_klienta"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Brak danych w tabeli klienci.";
            }
        }

        if (isset($_POST['show_produkty'])) {
            echo "<h2>Lista Produktów</h2>";
            $result = getProdukty($conn);
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID Produktu</th><th>Nazwa Produktu</th><th>Cena Produktu</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id_produktu"] . "</td><td>" . $row["nazwa_produktu"] . "</td><td>" . $row["cena_produktu"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Brak danych w tabeli produkty.";
            }
        }

        // Zamknięcie połączenia z bazą
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>

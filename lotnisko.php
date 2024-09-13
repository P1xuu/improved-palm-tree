<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Lotów</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 id="h1">System Lotów</h1>

    <hr>
    
    <!-- Formularz 1: Wyświetl zawartość wszystkich tabel -->
    <h2>Wyświetl zawartość wszystkich tabel</h2>
    <form action="lotnisko.php" method="POST">
        <button type="submit" name="view_all">Wyświetl tabeli</button>
    </form>

    <?php
    if (isset($_POST['view_all'])) {
        include 'db.php';
        
        // Tabela samolot
        $result = $conn->query("SELECT * FROM samolot");
        echo "<h3>Tabela Samolot</h3>";
        echo "<table border='1'><tr><th>ID</th><th>Nazwa</th><th>Typ</th><th>Rok Produkcji</th><th>Numer Seryjny</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id_samolot']}</td><td>{$row['nazwa']}</td><td>{$row['typ']}</td><td>{$row['rok_produkcji']}</td><td>{$row['numer_seryjny']}</td></tr>";
        }
        echo "</table>";

        // Tabela pilot
        $result = $conn->query("SELECT * FROM pilot");
        echo "<h3>Tabela Pilot</h3>";
        echo "<table border='1'><tr><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Adres</th><th>Telefon</th><th>PESEL</th><th>Email</th><th>Rok Urodzenia</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id_pilot']}</td><td>{$row['imię']}</td><td>{$row['nazwisko']}</td><td>{$row['adres']}</td><td>{$row['telefon']}</td><td>{$row['pesel']}</td><td>{$row['email']}</td><td>{$row['rok_urodzenia']}</td></tr>";
        }
        echo "</table>";

        // Tabela lot
        $result = $conn->query("SELECT * FROM lot");
        echo "<h3>Tabela Lot</h3>";
        echo "<table border='1'><tr><th>ID</th><th>Lotnisko Start</th><th>Lotnisko Cel</th><th>Kierunek Lotu</th><th>Data Lotu</th><th>ID Samolot</th><th>ID Pilot</th><th>Godzina</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id_lot']}</td><td>{$row['lotnisko_start']}</td><td>{$row['lotnisko_cel']}</td><td>{$row['kierunek_lotu']}</td><td>{$row['data_lotu']}</td><td>{$row['id_samolot']}</td><td>{$row['id_pilot']}</td><td>{$row['godzina']}</td></tr>";
        }
        echo "</table>";

        // Tabela bilet
        $result = $conn->query("SELECT * FROM bilet");
        echo "<h3>Tabela Bilet</h3>";
        echo "<table border='1'><tr><th>ID</th><th>Miejsce</th><th>ID Lot</th><th>Cena</th><th>Klasa</th><th>Zniżka</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id_bilet']}</td><td>{$row['miejsce']}</td><td>{$row['id_lot']}</td><td>{$row['cena']}</td><td>{$row['klasa']}</td><td>{$row['zniżka']}</td></tr>";
        }
        echo "</table>";

        $conn->close();
    }
    ?>

    <!-- Formularz 2: Loty do Polski, gdzie piloci nie skończyli 50 roku życia -->
    <h2>Loty do Polski (piloci < 50 lat)</h2>
    <form action="lotnisko.php" method="POST">
        <button type="submit" name="flights_to_poland">Pokaż loty</button>
    </form>

    <?php
    if (isset($_POST['flights_to_poland'])) {
        include 'db.php';

        $current_year = date('Y');
        $result = $conn->query("
            SELECT l.*
            FROM lot l
            JOIN pilot p ON l.id_pilot = p.id_pilot
            WHERE l.lotnisko_cel LIKE '%Polska%'
              AND ($current_year - p.rok_urodzenia) < 50
        ");
        echo "<h3>Loty do Polski (piloci < 50 lat)</h3>";
        echo "<table border='1'><tr><th>ID</th><th>Lotnisko Start</th><th>Lotnisko Cel</th><th>Kierunek Lotu</th><th>Data Lotu</th><th>ID Samolot</th><th>ID Pilot</th><th>Godzina</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id_lot']}</td><td>{$row['lotnisko_start']}</td><td>{$row['lotnisko_cel']}</td><td>{$row['kierunek_lotu']}</td><td>{$row['data_lotu']}</td><td>{$row['id_samolot']}</td><td>{$row['id_pilot']}</td><td>{$row['godzina']}</td></tr>";
        }
        echo "</table>";

        $conn->close();
    }
    ?>

    <!-- Formularz 3: Samoloty nie starsze niż 10 lat -->
    <h2>Samoloty nie starsze niż 10 lat</h2>
    <form action="lotnisko.php" method="POST">
        <button type="submit" name="new_aircraft">Pokaż samoloty</button>
    </form>

    <?php
    if (isset($_POST['new_aircraft'])) {
        include 'db.php';

        $year_limit = date('Y') - 10;
        $result = $conn->query("
            SELECT *
            FROM samolot
            WHERE rok_produkcji >= $year_limit
        ");
        echo "<h3>Samoloty nie starsze niż 10 lat</h3>";
        echo "<table border='1'><tr><th>ID</th><th>Nazwa</th><th>Typ</th><th>Rok Produkcji</th><th>Numer Seryjny</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id_samolot']}</td><td>{$row['nazwa']}</td><td>{$row['typ']}</td><td>{$row['rok_produkcji']}</td><td>{$row['numer_seryjny']}</td></tr>";
        }
        echo "</table>";

        $conn->close();
    }
    ?>

    <!-- Formularz 4: Bilety ze zniżką >= 20% -->
    <h2>Bilety ze zniżką >= 20%</h2>
    <form action="lotnisko.php" method="POST">
        <button type="submit" name="discount_tickets">Pokaż bilety</button>
    </form>

    <?php
    if (isset($_POST['discount_tickets'])) {
        include 'db.php';

        $result = $conn->query("
            SELECT *
            FROM bilet
            WHERE zniżka >= 20
        ");
        echo "<h3>Bilety ze zniżką >= 20%</h3>";
        echo "<table border='1'><tr><th>ID</th><th>Miejsce</th><th>ID Lot</th><th>Cena</th><th>Klasa</th><th>Zniżka</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id_bilet']}</td><td>{$row['miejsce']}</td><td>{$row['id_lot']}</td><td>{$row['cena']}</td><td>{$row['klasa']}</td><td>{$row['zniżka']}</td></tr>";
        }
        echo "</table>";

        $conn->close();
    }
    ?>
</body>
</html>

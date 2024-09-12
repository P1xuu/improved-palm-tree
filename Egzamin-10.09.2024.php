<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rozgrywki futbolowe</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div id="container">
        <!-- Baner -->
        <div id="baner">
            <h2>Światowe rozgrywki piłkarskie</h2>
            <img src="./dane/obraz1.jpg" alt="boisko">
        </div>
        
        <!-- Mecze -->
        <div id="mecze">
            <?php
            // Połączenie z bazą danych
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "egzamin";

            // Utworzenie połączenia
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Sprawdzenie połączenia
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Zapytanie o mecze
            $sql1 = "SELECT zespol1, zespol2, wynik, data_rozgrywki FROM rozgrywka";
            $result1 = $conn->query($sql1);

            if ($result1->num_rows > 0) {
                // Wyświetlanie wyników
                while($row = $result1->fetch_assoc()) {
                    echo "<div class='mecz'>";
                    echo "<h3>" . $row['zespol1'] . " - " . $row['zespol2'] . "</h3>";
                    echo "<h4>Wynik: " . $row['wynik'] . "</h4>";
                    echo "<p>w dniu: " . $row['data_rozgrywki'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "Brak wyników";
            }
            ?>
        </div>
        
        <!-- Główny blok -->
        <div id="główny">
            <h2>Reprezentacja Polski</h2>
        </div>
        
        <!-- Lewy blok -->
        <div id="lewy">
            <p>Podaj pozycję zawodników (1-bramkarze, 2-obrońcy, 3-pomocnicy, 4-napastnicy):</p>
            <form action="futbol.php" method="POST">
                <input type="number" name="pozycja" min="1" max="4">
                <input type="submit" value="Sprawdź">
            </form>

            <?php
            // Obsługa formularza
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $pozycja = $_POST['pozycja'];

                if (!empty($pozycja)) {
                    // Zapytanie o zawodników na podstawie pozycji
                    $sql2 = "SELECT imie, nazwisko FROM zawodnik WHERE pozycja_id = $pozycja";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        echo "<ul>";
                        while ($row = $result2->fetch_assoc()) {
                            echo "<li>" . $row['imie'] . " " . $row['nazwisko'] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "Brak zawodników na tej pozycji";
                    }
                }
            }

            // Zamknięcie połączenia
            $conn->close();
            ?>
        </div>

        <!-- Prawy blok -->
        <div id="prawy">
            <img src="./dane/zad1.png" alt="piłkarz">
            <p>Autor: Paweł Żołyński</p>
        </div>
    </div>
</body>
</html>


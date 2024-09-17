<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "psy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $powtorz_haslo = $_POST['powtorz-haslo'];

    if (empty($login) || empty($haslo) || empty($powtorz_haslo)) {
        $status = "wypełnij wszystkie pola";
    } elseif ($haslo != $powtorz_haslo) {
        $status = "hasła nie są takie same, konto nie zostało dodane";
    } else {
        $sql = "SELECT * FROM uzytkownicy WHERE login = '$login'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $status = "login występuje w bazie danych, konto nie zostało dodane";
        } else {
            $hashed_password = sha1($haslo);
            $sql = "INSERT INTO uzytkownicy (login, haslo) VALUES ('$login', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                $status = "Konto zostało dodane";
            } else {
                $status = "Błąd: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="styl4.css">
</head>
<body>
    <section id="baner">
        <h1>Forum wielbicieli psów</h1>
    </section>

    <div id="main-content" class="clearfix">
        <section id="blok-lewy">
            <img src="./pliki4/pliki4/zad1/obraz.jpg" alt="foksterier">
        </section>

        <section id="blok-prawy-1">
            <h2>Zapisz się</h2>
            <form action="logowanie.php" method="post">
                <label for="login">login: </label>
                <input type="text" id="login" name="login"><br>
                <label for="haslo">hasło: </label>
                <input type="password" id="haslo" name="haslo"><br>
                <label for="powtorz-haslo">powtórz hasło: </label>
                <input type="password" id="powtorz-haslo" name="powtorz-haslo"><br><br>
                <input type="submit" value="Zapisz">
            </form>
            <p>STATUS: <span id="status"><?= $status ?></span></p>
        </section>

        <section id="blok-prawy-2">
            <h2>Zapraszamy wszystkich</h2>
            <ol>
                <li>właścicieli psów</li>
                <li>weterynarzy</li>
                <li>tych, co chcą kupić psa</li>
                <li>tych, co lubią psy</li>
            </ol>
            <a href="regulamin.html">Przeczytaj regulamin forum</a>
        </section>
    </div>

    <section id="stopka">
        <p>Stronę wykonał: Paweł Żołyński</p>
    </section>
</body>
</html>

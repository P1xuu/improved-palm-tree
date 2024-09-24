<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sekretariat</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <section id="lewy">
        <h1>Akta Pracownicze</h1>
        <?php include 'skrypt1.php'; ?>
        <hr>
        <h3>Dokumenty pracownika</h3>
        <a href="cv.txt">Pobierz</a>
        <h1>Liczba zatrudnionych pracowników</h1>
        <p><?php include 'skrypt2.php'; ?></p>
    </section>

    <section id="prawy">
        <?php include 'skrypt3.php'; ?>
    </section>

    <footer>
        Autorem aplikacji jest: Paweł Żołyński<br>
        <ul>
            <li>skontaktuj się</li>
            <li>poznaj naszą firmę</li>
        </ul>
    </footer>
</body>
</html>

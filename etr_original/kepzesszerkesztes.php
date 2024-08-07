<?php
include_once("common/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/index.css">
    
    <title>ETR</title>
</head>
<body>
        <nav>
            <div>
                ETR
            </div>
            <div id="menu">
            <a href="index.php">Főoldal</a>
            <a href="hallgatok.php">Hallgatók</a>
            <a href="oktatok.php">Oktatók</a>
            <a href="kepzesek.php">Képzések</a>
            <a href="kurzusok.php">Kurzusok</a>
            <a href="termek.php">Termek</a>
            <a href="reszvetelek.php">Részvételek</a>
            <a href="tanarbeosztas.php">Tanárbeosztás</a>
            <a href="helyszin.php">Órahelyszínek</a>
            </div>
        </nav>
        <main>
            <h1>Képzés szerkesztése</h1>

            <?php
                $kepzeskod=$_POST["kepzeskod"];
                $kepzeskod=htmlspecialchars($kepzeskod);
                $kepzesadatok=get_kepzesadatok($kepzeskod);
            ?>

            <form method="POST" action="kepzesmodositas.php" accept-charset="utf-8">
            <label class="label">Képzéskód:</label>
            <?php
            echo '<input class="input" type="text" name="kepzeskod" value="'.$kepzeskod.'"/>';
            ?>
            <br>
            <label class="label">Képzésnév:</label>
            <?php
                echo '<input class="input" type="text" name="kepzesnev" value="'.$kepzesadatok["KépzésNév"].'"/>';
            ?>
            <br>
            <?php
               echo '<input type="hidden" name="oldkepzeskod" value="'.$kepzeskod.'">';
            ?>
            <input class="input" type="submit" value="Megváltoztatás">
            </form>
            <form action="kepzestorles.php" method="POST">
            <?php
               echo '<input type="hidden" name="kepzeskod" value="'.$kepzeskod.'">';
            ?>
            <input class="input" type="submit" value="Törlés">
            </form>

        </main>
</body>
</html>
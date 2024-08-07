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
            <h1>Terem szerkesztése</h1>

            <?php
                $teremkod=$_POST["teremkod"];
                $teremkod=htmlspecialchars($teremkod);
                $teremadatok=get_teremadatok($teremkod);
            ?>

            <form method="POST" action="teremmodositas.php" accept-charset="utf-8">
            <label class="label">Teremkód:</label>
            <?php
            echo '<input class="input" type="text" name="teremkod" value="'.$teremkod.'"/>';
            ?>
            <br>
            <label class="label">Teremnév:</label>
            <?php
            echo '<input class="input" type="text" name="teremnev" value="'.$teremadatok["TeremNév"].'"/>';
            ?>
            <br>
            <label class="label">Terem férőhely:</label>
            <?php
            echo '<input class="input" type="text" name="teremferohely" value="'.$teremadatok["TeremFérőhely"].'"/>';
            ?>
            <br>
            <?php
               echo '<input type="hidden" name="oldteremkod" value="'.$teremkod.'">';
            ?>
            <input class="input" type="submit" value="Megváltoztatás">
            </form>
            <form action="teremtorles.php" method="POST">
            <?php
               echo '<input type="hidden" name="teremkod" value="'.$teremkod.'">';
            ?>
            <input class="input" type="submit" value="Törlés">
            </form>

        </main>
</body>
</html>
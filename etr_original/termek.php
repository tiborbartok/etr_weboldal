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
            <a href="termek.php" class="active">Termek</a>
            <a href="reszvetelek.php">Részvételek</a>
            <a href="tanarbeosztas.php">Tanárbeosztás</a>
            <a href="helyszin.php">Órahelyszínek</a>
            </div>
        </nav>

        <main>
            <div>
            <h1>Új terem felvétele</h1>
            <form method="POST" action="teremuj.php" accept-charset="utf-8">
            <label class="label">Teremkód:</label>
            <input class="input" type="text" name="teremkod"/>
            <br>
            <label class="label">Teremnév:</label>
            <input class="input" type="text" name="teremnev"/>
            <br>
            <label class="label">Terem férőhelye:</label>
            <input class="input" type="number" min="1" max="999999999999999999999999999999" name="teremferohely"/>
            <br>
            <input class="input" type="submit" value="Felvétel">
            </form>
            </div>
            <div>

                <h2>Termek</h2>
                <table class="table">
                    <tr>
                        <th>Teremkód</th>
                        <th>Teremnév</th>
                        <th>Terem férőhely</th>
                        <th></th>
                    </tr>
                <?php
                $osszterem=get_termek();

                while($adottsor=mysqli_fetch_assoc($osszterem)){
                    echo '<form action="teremszerkesztes.php" method="POST">';
                    echo '<tr>';
                    echo '<td>'. $adottsor["TeremKód"] .'</td>';
                    echo '<td>'. $adottsor["TeremNév"] .'</td>';
                    echo '<td>'. $adottsor["TeremFérőhely"] .'</td>';
                    echo '<td><input type="submit" value="Szerkesztés"></td>';
                    echo '</tr>';
                    echo '<input type="hidden" name="teremkod" value="'.$adottsor["TeremKód"].'">';
                    echo '</form>';
                 }
                 mysqli_free_result($osszterem);
                ?>
            </div>
        </main>
</body>
</html>
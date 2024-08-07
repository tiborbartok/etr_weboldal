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
            <a href="oktatok.php" class="active">Oktatók</a>
            <a href="kepzesek.php">Képzések</a>
            <a href="kurzusok.php">Kurzusok</a>
            <a href="termek.php">Termek</a>
            <a href="reszvetelek.php">Részvételek</a>
            <a href="tanarbeosztas.php">Tanárbeosztás</a>
            <a href="helyszin.php">Órahelyszínek</a>
            </div>
        </nav>
        <main>
            <div>
            <h1>Új oktató felvétele</h1>
            <form method="POST" action="oktatouj.php" accept-charset="utf-8">
            <label class="label">Oktatókód:</label>
            <input class="input" type="text" name="oktatokod"/>
            <br>
            <label class="label">Vezetéknév:</label>
            <input class="input" type="text" name="oktatovezeteknev"/>
            <br>
            <label class="label">Keresztnév:</label>
            <input class="input" type="text" name="oktatokeresztnev"/>
            <br>
            <label class="label">Születési Dátum:</label>
                <select name="oktatoszulev" class="input">
                <?php
                    for ($i=1900; $i<=2100; $i++){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
                </select>év &nbsp;

                <select name="oktatoszulhonap">
                <?php
                    for($i=1; $i<=12; $i++){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
                </select>hónap &nbsp;

                <select name="oktatoszulnap">
                <?php
                    for($i=1; $i<=31; $i++){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
                </select>nap &nbsp;
            <br>
            <input class="input" type="submit" value="Felvétel">
            </form>
            </div>
            <div>

                <h2>Oktatók</h2>
                <table class="table">
                    <tr>
                        <th>Oktatókód</th>
                        <th>Vezetéknév</th>
                        <th>Keresztnév</th>
                        <th>Születési dátum</th>
                        <th></th>
                    </tr>
                <?php
                $osszoktato=get_oktatok();

                while($adottsor=mysqli_fetch_assoc($osszoktato)){
                    echo '<form action="oktatoszerkesztes.php" method="POST">';
                    echo '<tr>';
                    echo '<td>'. $adottsor["OktatóKód"] .'</td>';
                    echo '<td>'. $adottsor["OktatóVezetékNév"] .'</td>';
                    echo '<td>'. $adottsor["OktatóKeresztNév"] .'</td>';
                    echo '<td>'. date_format(date_create($adottsor["OktatóSzületésiDátum"]), 'Y. m. d.') .'</td>';
                    echo '<td><input type="submit" value="Szerkesztés"></td>';
                    echo '</tr>';
                    echo '<input type="hidden" name="oktatokod" value="'.$adottsor["OktatóKód"].'">';
                    echo '</form>';
                 }
                 mysqli_free_result($osszoktato);
                ?>
            </div>
        </main>
</body>
</html>
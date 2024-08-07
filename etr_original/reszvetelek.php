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
            <a href="reszvetelek.php" class="active">Részvételek</a>
            <a href="tanarbeosztas.php">Tanárbeosztás</a>
            <a href="helyszin.php">Órahelyszínek</a>
            </div>
        </nav>

        <main>
            <div>
            <h1>Új részvétel felvétele</h1>
            <form method="POST" action="reszveteluj.php" accept-charset="utf-8">
            <label class="label">Hallgató:</label>
            <select name="reszvetelhallgato" class="input">
            <?php
                    $felvehetohallgatok=get_felvehetohallgatok();
                    if (mysqli_num_rows($felvehetohallgatok)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetohallgatok)){
                            echo '<option value="'.$adottsor["HallgatóKód"].'">'.$adottsor["HallgatóKód"].' - '.$adottsor["HallgatóVezetékNév"].' '.$adottsor["HallgatóKeresztNév"].' - '.$adottsor["KépzésKód"].'</option>';
                        }
                    }
                    else{
                        echo '<option value=""> !NINCS VÁLASZTHATÓ HALLGATÓ! </option>';
                    }
                ?>
            </select>
            <br>
            <label class="label">Kurzus:</label>
            <select name="reszvetelkurzus" class="input">
            <?php
                    $felvehetokurzusok=get_felvehetokurzusok();
                    if (mysqli_num_rows($felvehetokurzusok)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetokurzusok)){
                            echo '<option value="'.$adottsor["KurzusKód"].'">'.$adottsor["KurzusKód"].' - '.$adottsor["KurzusNév"].' - '.$adottsor["KépzésKód"].'</option>';
                        }
                    }
                    else{
                        echo '<option value=""> !NINCS VÁLASZTHATÓ KURZUS! </option>';
                    }
                ?>
            </select>
            <br>
            <input class="input" type="submit" value="Felvétel">
            </form>
            </div>
            <h2>Részvételek</h2>
                <table class="table">
                    <tr>
                        <th>Hallgatókód</th>
                        <th>Vezetéknév</th>
                        <th>Keresztnév</th>
                        <th>Kurzuskód</th>
                        <th>Kurzusnév</th>
                        <th>Képzéskód</th>  
                        <th></th>
                    </tr>
                <?php
                $osszreszvetel=get_reszvetel();

                while($adottsor=mysqli_fetch_assoc($osszreszvetel)){
                    echo '<form action="reszvetelszerkesztes.php" method="POST">';
                    echo '<tr>';
                    echo '<td>'. $adottsor["hallkod"] .'</td>';
                    echo '<td>'. $adottsor["hallvez"] .'</td>';
                    echo '<td>'. $adottsor["hallker"] .'</td>';
                    echo '<td>'. $adottsor["kurkod"] .'</td>';
                    echo '<td>'. $adottsor["kurnev"] .'</td>';
                    echo '<td>'. $adottsor["kepkod"] .'</td>';
                    echo '<td><input type="submit" value="Szerkesztés"></td>';
                    echo '</tr>';
                    echo '<input type="hidden" name="hallgatokod" value="'.$adottsor["hallkod"].'">';
                    echo '<input type="hidden" name="kurzuskod" value="'.$adottsor["kurkod"].'">';
                    echo '</form>';
                 }
                 mysqli_free_result($osszreszvetel);
                ?>
</body>
</html>
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
            <a href="helyszin.php" class="active">Órahelyszínek</a>
            </div>
        </nav>

        <main>
            <div>
            <h1>Új helyszín felvétele</h1>
            <form method="POST" action="helyszinuj.php" accept-charset="utf-8">
            <label class="label">Terem:</label>
            <select name="helyszinterem" class="input">
            <?php
                    $felvehetotermek=get_felvehetotermek();
                    if (mysqli_num_rows($felvehetotermek)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetotermek)){
                            echo '<option value="'.$adottsor["TeremKód"].'">'.$adottsor["TeremKód"].' - '.$adottsor["TeremNév"].' - '.$adottsor["TeremFérőhely"].' fő</option>';
                        }
                    }
                    else{
                        echo '<option value=""> !NINCS VÁLASZTHATÓ OKTATÓ! </option>';
                    }
                ?>
            </select>
            <br>
            <label class="label">Kurzus:</label>
            <select name="helyszinkurzus" class="input">
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


            <h2>Helyszínek</h2>
                <table class="table">
                    <tr>
                        <th>Teremkód</th>
                        <th>Teremnév</th>
                        <th>Teremférőhely</th>
                        <th>Kurzuskód</th>
                        <th>Kurzusnév</th>
                        <th></th>
                    </tr>
                <?php
                $osszhelyszin=get_helyszin();

                while($adottsor=mysqli_fetch_assoc($osszhelyszin)){
                    echo '<form action="helyszinszerkesztes.php" method="POST">';
                    echo '<tr>';
                    echo '<td>'. $adottsor["terkod"] .'</td>';
                    echo '<td>'. $adottsor["ternev"] .'</td>';
                    echo '<td>'. $adottsor["terfer"] .'</td>';
                    echo '<td>'. $adottsor["kurkod"] .'</td>';
                    echo '<td>'. $adottsor["kurnev"] .'</td>';
                    echo '<td><input type="submit" value="Szerkesztés"></td>';
                    echo '</tr>';
                    echo '<input type="hidden" name="teremkod" value="'.$adottsor["terkod"].'">';
                    echo '<input type="hidden" name="kurzuskod" value="'.$adottsor["kurkod"].'">';
                    echo '</form>';
                 }
                 mysqli_free_result($osszhelyszin);
                ?>
</body>
</html>
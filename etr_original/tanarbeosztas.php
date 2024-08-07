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
            <a href="tanarbeosztas.php" class="active">Tanárbeosztás</a>
            <a href="helyszin.php">Órahelyszínek</a>
            </div>
        </nav>

        <main>
            <div>
            <h1>Új beosztás felvétele</h1>
            <form method="POST" action="tanarbeosztasuj.php" accept-charset="utf-8">
            <label class="label">Oktató:</label>
            <select name="beosztasoktato" class="input">
            <?php
                    $felvehetooktatok=get_felvehetooktatok();
                    if (mysqli_num_rows($felvehetooktatok)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetooktatok)){
                            echo '<option value="'.$adottsor["OktatóKód"].'">'.$adottsor["OktatóKód"].' - '.$adottsor["OktatóVezetékNév"].' '.$adottsor["OktatóKeresztNév"].'</option>';
                        }
                    }
                    else{
                        echo '<option value=""> !NINCS VÁLASZTHATÓ OKTATÓ! </option>';
                    }
                ?>
            </select>
            <br>
            <label class="label">Kurzus:</label>
            <select name="beosztaskurzus" class="input">
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
            <h2>Beosztás</h2>
                <table class="table">
                    <tr>
                        <th>Oktatókód</th>
                        <th>Vezetéknév</th>
                        <th>Keresztnév</th>
                        <th>Kurzuskód</th>
                        <th>Kurzusnév</th>
                        <th></th>
                    </tr>
                <?php
                $osszbeosztas=get_beosztas();

                while($adottsor=mysqli_fetch_assoc($osszbeosztas)){
                    echo '<form action="tanarbeosztasszerkesztes.php" method="POST">';
                    echo '<tr>';
                    echo '<td>'. $adottsor["oktkod"] .'</td>';
                    echo '<td>'. $adottsor["oktvez"] .'</td>';
                    echo '<td>'. $adottsor["oktker"] .'</td>';
                    echo '<td>'. $adottsor["kurkod"] .'</td>';
                    echo '<td>'. $adottsor["kurnev"] .'</td>';
                    echo '<td><input type="submit" value="Szerkesztés"></td>';
                    echo '</tr>';
                    echo '<input type="hidden" name="oktatokod" value="'.$adottsor["oktkod"].'">';
                    echo '<input type="hidden" name="kurzuskod" value="'.$adottsor["kurkod"].'">';
                    echo '</form>';
                 }
                 mysqli_free_result($osszbeosztas);
                ?>
</body>
</html>
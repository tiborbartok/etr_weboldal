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
            <a href="kurzusok.php" class="active">Kurzusok</a>
            <a href="termek.php">Termek</a>
            <a href="reszvetelek.php">Részvételek</a>
            <a href="tanarbeosztas.php">Tanárbeosztás</a>
            <a href="helyszin.php">Órahelyszínek</a>
            </div>
        </nav>

        <main>
            <div>
            <h1>Új kurzus felvétele</h1>
            <form method="POST" action="kurzusuj.php" accept-charset="utf-8">
            <label class="label">Kurzuskód:</label>
            <input class="input" type="text" name="kurzuskod"/>
            <br>
            <label class="label">Kurzusnév:</label>
            <input class="input" type="text" name="kurzusnev"/>
            <br>
            <label class="label">Képzés:</label>
            <select name="kurzuskepzes" class="input">
                <?php
                    $felvehetokepzesek=get_felvehetokepzesek();
                    if (mysqli_num_rows($felvehetokepzesek)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetokepzesek)){
                            echo '<option value="'.$adottsor["KépzésKód"].'">'.$adottsor["KépzésKód"].' - '.$adottsor["KépzésNév"].'</option>';
                        }
                    }
                    else{
                        echo '<option value=""> !NINCS VÁLASZTHATÓ KÉPZÉS! </option>';
                    }
               
                ?>
            </select>
            <br>
            <input class="input" type="submit" value="Felvétel">
            </form>
            </div>
            <h2>Kurzusok</h2>
                <table class="table">
                    <tr>
                        <th>Kurzuskód</th>
                        <th>Kurzusnév</th>
                        <th>Képzéskód</th>
                        <th></th>
                    </tr>
                <?php
                $osszkurzus=get_kurzusok();

                while($adottsor=mysqli_fetch_assoc($osszkurzus)){
                    echo '<form action="kurzusszerkesztes.php" method="POST">';
                    echo '<tr>';
                    echo '<td>'. $adottsor["KurzusKód"] .'</td>';
                    echo '<td>'. $adottsor["KurzusNév"] .'</td>';
                    echo '<td>'. $adottsor["KépzésKód"] .'</td>';
                    echo '<td><input type="submit" value="Szerkesztés"></td>';
                    echo '</tr>';
                    echo '<input type="hidden" name="kurzuskod" value="'.$adottsor["KurzusKód"].'">';
                    echo '</form>';
                 }
                 mysqli_free_result($osszkurzus);
                ?>
            </div>
        </main>
</body>
</html>
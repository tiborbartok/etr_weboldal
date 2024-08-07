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
            <a href="hallgatok.php" class="active">Hallgatók</a>
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
            <div>
            <h1>Új hallgató felvétele</h1>
            <form method="POST" action="hallgatouj.php" accept-charset="utf-8">
            <label class="label">Hallgatókód:</label>
            <input class="input" type="text" name="hallgatokod"/>
            <br>
            <label class="label">Vezetéknév:</label>
            <input class="input" type="text" name="hallgatovezeteknev"/>
            <br>
            <label class="label">Keresztnév:</label>
            <input class="input" type="text" name="hallgatokeresztnev"/>
            <br>
            <label class="label">Születési Dátum:</label>
                <select name="hallgatoszulev" class="input">
                <?php
                    for ($i=1900; $i<=2100; $i++){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
                </select>év &nbsp;

                <select name="hallgatoszulhonap">
                <?php
                    for($i=1; $i<=12; $i++){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
                </select>hónap &nbsp;

                <select name="hallgatoszulnap">
                <?php
                    for($i=1; $i<=31; $i++){
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                ?>
                </select>nap &nbsp;
            <br>
            <label class="label">Képzés:</label>
            <select name="felvettkepzes" class="input">
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
            <label class="label">Felvétel éve:</label>
            <input class="input" type="number" min="1800" max="2100" name="felveteliev"/>
            <br>
            <input class="input" type="submit" value="Felvétel">
            </form>
            </div>
            <div>


                <h2>Hallgatók</h2>
                <table class="table">
                    <tr>
                        <th>Hallgatókód</th>
                        <th>Vezetéknév</th>
                        <th>Keresztnév</th>
                        <th>Születési dátum</th>
                        <th>Képzés</th>
                        <th>Felvételi év</th>
                        <th></th>
                    </tr>
                <?php
                $osszhallgato=get_hallgatok();
                

                while($adottsor=mysqli_fetch_assoc($osszhallgato)){
                    echo '<form action="hallgatoszerkesztes.php" method="POST">';
                    echo '<tr>';
                    echo '<td>'. $adottsor["HallgatóKód"] .'</td>';
                    echo '<td>'. $adottsor["HallgatóVezetékNév"] .'</td>';
                    echo '<td>'. $adottsor["HallgatóKeresztNév"] .'</td>';
                    echo '<td>'. date_format(date_create($adottsor["HallgatóSzületésiDátum"]), 'Y. m. d.') .'</td>';
                    echo '<td>'. $adottsor["KépzésKód"] .'</td>';
                    echo '<td>'. $adottsor["FelvételiÉv"] .'</td>';
                    echo '<td><input type="submit" value="Szerkesztés"></td>';
                    echo '</tr>';
                    echo '<input type="hidden" name="hallgatokod" value="'.$adottsor["HallgatóKód"].'">';
                    echo '</form>';
                 }
                 mysqli_free_result($osszhallgato);
                ?>

            </div>
        </main>
    </div>

</body>
</html>
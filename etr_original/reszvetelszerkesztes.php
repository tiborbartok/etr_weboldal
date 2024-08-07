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
            <h1>Részvétel szerkesztése</h1>

            <?php
                $hallgatokod=$_POST["hallgatokod"];
                $kurzuskod=$_POST["kurzuskod"];
                $hallgatokod=htmlspecialchars($hallgatokod);
                $kurzuskod=htmlspecialchars($kurzuskod);
                $felvehetohallgatok=get_felvehetohallgatok();
                $felvehetokurzusok=get_felvehetokurzusok();
                $reszveteladatok=get_reszveteladatok($hallgatokod, $kurzuskod);
            ?>

            <form method="POST" action="reszvetelmodositas.php" accept-charset="utf-8">
            <label class="label">Hallgató:</label>
            <select name="reszvetelhallgato" class="input">
            <?php
                    if (mysqli_num_rows($felvehetohallgatok)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetohallgatok)){
                            if ($adottsor["HallgatóKód"]==$reszveteladatok["HallgatóKód"]){
                                echo '<option value="'.$adottsor["HallgatóKód"].'" selected>'.$adottsor["HallgatóKód"].' - '.$adottsor["HallgatóVezetékNév"].' '.$adottsor["HallgatóKeresztNév"].' - '.$adottsor["KépzésKód"].'</option>';
                            }
                            else{
                                echo '<option value="'.$adottsor["HallgatóKód"].'">'.$adottsor["HallgatóKód"].' - '.$adottsor["HallgatóVezetékNév"].' '.$adottsor["HallgatóKeresztNév"].' - '.$adottsor["KépzésKód"].'</option>';
                            }
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
                    if (mysqli_num_rows($felvehetokurzusok)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetokurzusok)){
                            if ($adottsor["KurzusKód"]==$reszveteladatok["KurzusKód"]){
                                echo '<option value="'.$adottsor["KurzusKód"].'" selected>'.$adottsor["KurzusKód"].' - '.$adottsor["KurzusNév"].' - '.$adottsor["KépzésKód"].'</option>';
                            }
                            else{
                                echo '<option value="'.$adottsor["KurzusKód"].'">'.$adottsor["KurzusKód"].' - '.$adottsor["KurzusNév"].' - '.$adottsor["KépzésKód"].'</option>';
                            }
                        }
                    }
                    else{
                        echo '<option value=""> !NINCS VÁLASZTHATÓ KURZUS! </option>';
                    }
                ?>
            </select>
            <br>
            <?php
               echo '<input type="hidden" name="oldhallgatokod" value="'.$hallgatokod.'">';
               echo '<input type="hidden" name="oldkurzuskod" value="'.$kurzuskod.'">';
            ?>
            <input class="input" type="submit" value="Megváltoztatás">
            </form>
            <form action="reszveteltorles.php" method="POST">
            <?php
               echo '<input type="hidden" name="hallgatokod" value="'.$hallgatokod.'">';
               echo '<input type="hidden" name="kurzuskod" value="'.$kurzuskod.'">';
            ?>
            <input class="input" type="submit" value="Törlés">
            </form>

        </main>
</body>
</html>
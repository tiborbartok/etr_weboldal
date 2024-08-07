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
            <h1>Helyszín szerkesztése</h1>

            <?php
                $teremkod=$_POST["teremkod"];
                $kurzuskod=$_POST["kurzuskod"];
                $teremkod=htmlspecialchars($teremkod);
                $kurzuskod=htmlspecialchars($kurzuskod);
                $felvehetotermek=get_felvehetotermek();
                $felvehetokurzusok=get_felvehetokurzusok();
                $helyszinadatok=get_helyszinadatok($teremkod, $kurzuskod);
            ?>

            <form method="POST" action="helyszinmodositas.php" accept-charset="utf-8">
            <label class="label">Terem:</label>
            <select name="helyszinterem" class="input">
            <?php
                    if (mysqli_num_rows($felvehetotermek)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetotermek)){
                            if ($adottsor["TeremKód"]==$helyszinadatok["TeremKód"]){
                                echo '<option value="'.$adottsor["TeremKód"].'" selected>'.$adottsor["TeremKód"].' - '.$adottsor["TeremNév"].' - '.$adottsor["TeremFérőhely"].' fő</option>';
                            }
                            else{
                                echo '<option value="'.$adottsor["TeremKód"].'">'.$adottsor["TeremKód"].' - '.$adottsor["TeremNév"].' - '.$adottsor["TeremFérőhely"].' fő</option>';
                            }
                        }
                    }
                    else{
                        echo '<option value=""> !NINCS VÁLASZTHATÓ TEREM! </option>';
                    }
                ?>
            </select>
            <br>
            <label class="label">Kurzus:</label>
            <select name="helyszinkurzus" class="input">
            <?php
                    if (mysqli_num_rows($felvehetokurzusok)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetokurzusok)){
                            if ($adottsor["KurzusKód"]==$helyszinadatok["KurzusKód"]){
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
               echo '<input type="hidden" name="oldteremkod" value="'.$teremkod.'">';
               echo '<input type="hidden" name="oldkurzuskod" value="'.$kurzuskod.'">';
            ?>
            <input class="input" type="submit" value="Megváltoztatás">
            </form>
            <form action="helyszintorles.php" method="POST">
            <?php
               echo '<input type="hidden" name="teremkod" value="'.$teremkod.'">';
               echo '<input type="hidden" name="kurzuskod" value="'.$kurzuskod.'">';
            ?>
            <input class="input" type="submit" value="Törlés">
            </form>

        </main>
</body>
</html>
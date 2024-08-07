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
            <h1>Beosztás szerkesztése</h1>

            <?php
                $oktatokod=$_POST["oktatokod"];
                $kurzuskod=$_POST["kurzuskod"];
                $oktatokod=htmlspecialchars($oktatokod);
                $kurzuskod=htmlspecialchars($kurzuskod);
                $felvehetooktatok=get_felvehetooktatok();
                $felvehetokurzusok=get_felvehetokurzusok();
                $beosztasadatok=get_beosztasadatok($oktatokod, $kurzuskod);
            ?>

            <form method="POST" action="tanarbeosztasmodositas.php" accept-charset="utf-8">
            <label class="label">Oktató:</label>
            <select name="beosztasoktato" class="input">
            <?php
                    if (mysqli_num_rows($felvehetooktatok)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetooktatok)){
                            if ($adottsor["OktatóKód"]==$beosztasadatok["OktatóKód"]){
                                echo '<option value="'.$adottsor["OktatóKód"].'" selected>'.$adottsor["OktatóKód"].' - '.$adottsor["OktatóVezetékNév"].' '.$adottsor["OktatóKeresztNév"].'</option>';
                            }
                            else{
                                echo '<option value="'.$adottsor["OktatóKód"].'">'.$adottsor["OktatóKód"].' - '.$adottsor["OktatóVezetékNév"].' '.$adottsor["OktatóKeresztNév"].'</option>';
                            }
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
                    if (mysqli_num_rows($felvehetokurzusok)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetokurzusok)){
                            if ($adottsor["KurzusKód"]==$beosztasadatok["KurzusKód"]){
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
               echo '<input type="hidden" name="oldoktatokod" value="'.$oktatokod.'">';
               echo '<input type="hidden" name="oldkurzuskod" value="'.$kurzuskod.'">';
            ?>
            <input class="input" type="submit" value="Megváltoztatás">
            </form>
            <form action="tanarbeosztastorles.php" method="POST">
            <?php
               echo '<input type="hidden" name="oktatokod" value="'.$oktatokod.'">';
               echo '<input type="hidden" name="kurzuskod" value="'.$kurzuskod.'">';
            ?>
            <input class="input" type="submit" value="Törlés">
            </form>

        </main>
</body>
</html>
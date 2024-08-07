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
            <h1>Kurzus szerkesztése</h1>

            <?php
                $kurzuskod=$_POST["kurzuskod"];
                $kurzuskod=htmlspecialchars($kurzuskod);
                $kurzusadatok=get_kurzusadatok($kurzuskod);
            ?>

            <form method="POST" action="kurzusmodositas.php" accept-charset="utf-8">
            <label class="label">Kurzuskód:</label>
            <?php
            echo '<input class="input" type="text" name="kurzuskod" value="'.$kurzuskod.'"/>';
            ?>
            <br>
            <label class="label">Kurzusnév:</label>
            <?php
            echo '<input class="input" type="text" name="kurzusnev" value="'.$kurzusadatok["KurzusNév"].'"/>';
            ?>
            <br>
            <label class="label">Képzés:</label>
            <select name="kurzuskepzes" class="input">
                <?php
                    $felvehetokepzesek=get_felvehetokepzesek();
                    if (mysqli_num_rows($felvehetokepzesek)>0){
                        while($adottsor=mysqli_fetch_assoc($felvehetokepzesek)){
                            if ($adottsor["KépzésKód"]==$kurzusadatok["KépzésKód"]){
                                echo '<option value="'.$adottsor["KépzésKód"].'" selected>'.$adottsor["KépzésKód"].' - '.$adottsor["KépzésNév"].'</option>';
                            }
                            else{
                                echo '<option value="'.$adottsor["KépzésKód"].'">'.$adottsor["KépzésKód"].' - '.$adottsor["KépzésNév"].'</option>';
                            }
                        }
                    }
                    else{
                        echo '<option value=""> !NINCS VÁLASZTHATÓ KÉPZÉS! </option>';
                    }
                ?>
            </select>
            <br>
            
            <?php
               echo '<input type="hidden" name="oldkurzuskod" value="'.$kurzuskod.'">';
            ?>
            <input class="input" type="submit" value="Megváltoztatás">
            </form>
            <form action="kurzustorles.php" method="POST">
            <?php
               echo '<input type="hidden" name="kurzuskod" value="'.$kurzuskod.'">';
            ?>
            <input class="input" type="submit" value="Törlés">
            </form>

        </main>
</body>
</html>
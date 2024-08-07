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
            <h1>Hallgató szerkesztése</h1>

            <?php
                $hallgatokod=$_POST["hallgatokod"];
                $hallgatokod=htmlspecialchars($hallgatokod);
                $hallgatoadatok=get_hallgatoadatok($hallgatokod);
            ?>

            <form method="POST" action="hallgatomodositas.php" accept-charset="utf-8">
            <label class="label">Hallgatókód:</label>
            <?php
            echo '<input class="input" type="text" name="hallgatokod" value="'.$hallgatokod.'"/>';
            ?>
            <br>
            <label class="label">Vezetéknév:</label>
            <?php
            echo '<input class="input" type="text" name="hallgatovezeteknev" value="'.$hallgatoadatok["HallgatóVezetékNév"].'"/>';
            ?>
            <br>
            <label class="label">Keresztnév:</label>
            <?php
            echo '<input class="input" type="text" name="hallgatokeresztnev" value="'.$hallgatoadatok["HallgatóKeresztNév"].'"/>';
            ?>
            <br>
            <label class="label">Születési dátum:</label>
                <select name="szulev" class="input">
                <?php
                    for($i=1900; $i<=2100; $i++){
                        if ($hallgatoadatok["ev"]==$i){
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        }
                        else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }
                ?>
                </select>év &nbsp;

                <select name="szulhonap">
                <?php
                    for($i=1; $i<=12; $i++){
                        if ($hallgatoadatok["honap"]==$i){
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        }
                        else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }
                ?>
                </select>hónap &nbsp;

                <select name="szulnap">
                <?php
                    for($i=1; $i<=31; $i++){
                        if ($hallgatoadatok["nap"]==$i){
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        }
                        else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
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
                            if ($adottsor["KépzésKód"]==$hallgatoadatok["KépzésKód"]){
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
            <label class="label">Felvétel éve:</label>
            <?php
                echo '<input class="input" type="number" min="1800" max="2100" name="felveteliev" value="'.$hallgatoadatok["FelvételiÉv"].'"/>';
            ?>
            <br>
            <?php
               echo '<input type="hidden" name="oldhallgatokod" value="'.$hallgatokod.'">';
            ?>
            <input class="input" type="submit" value="Megváltoztatás">
            </form>
            <form action="hallgatotorles.php" method="POST">
            <?php
               echo '<input type="hidden" name="hallgatokod" value="'.$hallgatokod.'">';
            ?>
            <input class="input" type="submit" value="Törlés">
            </form>

        </main>
</body>
</html>
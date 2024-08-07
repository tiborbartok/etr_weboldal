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
            <a href="index.php" class="active">Főoldal</a>
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
            <div>
                <h1>Lekérdezések</h1>
                <h2>Hogy hívják a legtöbb kurzuson oktató tanárt?</h2>
                <?php
                    $legtobbetoktatotanar=get_legtobbetoktatotanar();
                    if (mysqli_num_rows($legtobbetoktatotanar)>0){
                        $legtobbetoktatotanar=mysqli_fetch_assoc($legtobbetoktatotanar);
                        echo '<h3>' .$legtobbetoktatotanar["oktvez"].' '.$legtobbetoktatotanar["oktker"].'</h3>';
                    }
                    else{
                        echo '<h3> !NINCS KURZUST OKTATÓ TANÁR! </h3>';
                    }
                ?>
                <h2>Melyek azok a termek, amelyek a legkisebb teremnél több, mint másfélszer annyi hallgatót képesek befogadni?</h2>
                <?php
                    $masfelszerterem=get_masfelszerterem();
                    if (mysqli_num_rows($masfelszerterem)>0){
                        while($adottsor=mysqli_fetch_assoc($masfelszerterem)){
                            echo '<h3>' .$adottsor["TeremNév"].'</h3>';
                        }
                    }
                    else{
                        echo '<h3> !NINCS FELVETT TEREM! </h3>';
                    }
                ?>
                <h2>Melyik az a képzés, amelyhez a legtöbb kurzus tartozik?</h2>
                <?php
                    $legtobbkurzus=get_legtobbkurzus();
                    if (mysqli_num_rows($legtobbkurzus)>0){
                        $legtobbkurzus=mysqli_fetch_assoc($legtobbkurzus);
                        echo '<h3>' .$legtobbkurzus["kepnev"].'</h3>';
                    }
                    else{
                        echo '<h3> !NINCS FELVETT KÉPZÉS! </h3>';
                    }
                ?>
            </div>
        </main>
</body>
</html>
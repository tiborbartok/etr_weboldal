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
            <h1>Oktató szerkesztése</h1>

            <?php
                $oktatokod=$_POST["oktatokod"];
                $oktatokod=htmlspecialchars($oktatokod);
                $oktatoadatok=get_oktatoadatok($oktatokod);
                $datum=explode('-', $oktatoadatok["OktatóSzületésiDátum"]);
            ?>

            <form method="POST" action="oktatomodositas.php" accept-charset="utf-8">
            <label class="label">Oktatókód:</label>
            <?php
            echo '<input class="input" type="text" name="oktatokod" value="'.$oktatokod.'"/>';
            ?>
            <br>
            <label class="label">Oktató vezetéknév:</label>
            <?php
            echo '<input class="input" type="text" name="oktatovezeteknev" value="'.$oktatoadatok["OktatóVezetékNév"].'"/>';
            ?>
            <br>
            <label class="label">Oktató keresztnév:</label>
            <?php
            echo '<input class="input" type="text" name="oktatokeresztnev" value="'.$oktatoadatok["OktatóKeresztNév"].'"/>';
            ?>
            <br>
            <label class="label">Oktató születési dátum:</label>
                <select name="szulev" class="input">
                <?php
                    for($i=1900; $i<=2100; $i++){
                        if ($datum[0]==$i){
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
                        if ($datum[1]==$i){
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
                        if ($datum[2]==$i){
                            echo '<option value="'.$i.'" selected>'.$i.'</option>';
                        }
                        else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    }
                ?>
                </select>nap &nbsp;
            <br>
            <?php
               echo '<input type="hidden" name="oldoktatokod" value="'.$oktatokod.'">';
            ?>
            <input class="input" type="submit" value="Megváltoztatás">
            </form>
            <form action="oktatotorles.php" method="POST">
            <?php
               echo '<input type="hidden" name="oktatokod" value="'.$oktatokod.'">';
            ?>
            <input class="input" type="submit" value="Törlés">
            </form>

        </main>
</body>
</html>
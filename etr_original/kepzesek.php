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
            <a href="kepzesek.php" class="active">Képzések</a>
            <a href="kurzusok.php">Kurzusok</a>
            <a href="termek.php">Termek</a>
            <a href="reszvetelek.php">Részvételek</a>
            <a href="tanarbeosztas.php">Tanárbeosztás</a>
            <a href="helyszin.php">Órahelyszínek</a>
            </div>
        </nav>
        <main>
            <div>
                <h1>Új képzés felvétele</h1>
                <form method="POST" action="kepzesuj.php" accept-charset="utf-8">
                <label class="label">Képzéskód:</label>
                <input class="input" type="text" name="kepzeskod"/>
                <br>
                <label class="label">Képzésnév:</label>
                <input class="input" type="text" name="kepzesnev"/>
                <br>
                <input class="input" type="submit" value="Felvétel">
                </form>
            </div>
            <div>
                <h2>Képzések</h2>
                <table class="table">
                    <tr>
                        <th>Képzéskód</th>
                        <th>Képzésnév</th>
                        <th></th>
                    </tr>

                    <?php
                        $osszkepzes=get_kepzesek();

                         while($adottsor=mysqli_fetch_assoc($osszkepzes)){
                            echo '<form action="kepzesszerkesztes.php" method="POST">';
                            echo '<tr>';
                            echo '<td>'. $adottsor["KépzésKód"] .'</td>';
                            echo '<td>'. $adottsor["KépzésNév"] .'</td>';
                            echo '<td><input type="submit" value="Szerkesztés"></td>';
                            echo '</tr>';
                            echo '<input type="hidden" name="kepzeskod" value="'.$adottsor["KépzésKód"].'">';
                            echo '</form>';
                         }
                         mysqli_free_result($osszkepzes);
                    ?>
                </table>
            </div>
        </main>
</body>
</html>
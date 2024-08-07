<?php
include_once("common/functions.php");

$reszvetelhallgato=$_POST["reszvetelhallgato"];
$reszvetelkurzus=$_POST["reszvetelkurzus"];


if (isset($reszvetelhallgato) && isset($reszvetelkurzus)&& $reszvetelhallgato!=null && $reszvetelkurzus!=null){
    $tiszta_reszvetelhallgato=htmlspecialchars($reszvetelhallgato);
    $tiszta_reszvetelkurzus=htmlspecialchars($reszvetelkurzus);

    $success=reszvetel_insert($tiszta_reszvetelhallgato, $tiszta_reszvetelkurzus);

    if ($success==false){
        die("Nem sikerült felvenni.");
    }
    else{
        header("Location: reszvetelek.php");
    }
}
else{
    die("Adj meg minden adatot a felvételhez!");
}
?>
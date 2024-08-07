<?php
include_once("common/functions.php");

$beosztasoktato=$_POST["beosztasoktato"];
$beosztaskurzus=$_POST["beosztaskurzus"];


if (isset($beosztasoktato) && isset($beosztaskurzus)&& $beosztasoktato!=null && $beosztaskurzus!=null){
    $tiszta_beosztasoktato=htmlspecialchars($beosztasoktato);
    $tiszta_beosztaskurzus=htmlspecialchars($beosztaskurzus);

    $success=tanarbeosztas_insert($tiszta_beosztasoktato, $tiszta_beosztaskurzus);

    if ($success==false){
        die("Nem sikerült felvenni.");
    }
    else{
        header("Location: tanarbeosztas.php");
    }
}
else{
    die("Adj meg minden adatot a felvételhez!");
}
?>
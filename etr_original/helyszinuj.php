<?php
include_once("common/functions.php");

$helyszinterem=$_POST["helyszinterem"];
$helyszinkurzus=$_POST["helyszinkurzus"];


if (isset($helyszinterem) && isset($helyszinkurzus)&& $helyszinterem!=null && $helyszinkurzus!=null){
    $tiszta_helyszinterem=htmlspecialchars($helyszinterem);
    $tiszta_helyszinkurzus=htmlspecialchars($helyszinkurzus);

    $success=helyszin_insert($tiszta_helyszinterem, $tiszta_helyszinkurzus);

    if ($success==false){
        die("Nem sikerült felvenni.");
    }
    else{
        header("Location: helyszin.php");
    }
}
else{
    die("Adj meg minden adatot a felvételhez!");
}
?>
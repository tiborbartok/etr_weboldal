<?php
include_once("common/functions.php");

$kepzeskod=$_POST["kepzeskod"];
$kepzesnev=$_POST["kepzesnev"];

if (isset($kepzeskod) && isset($kepzesnev) && $kepzeskod!=null && $kepzesnev!=null){
    $tiszta_kepzeskod=htmlspecialchars($kepzeskod);
    $tiszta_kepzesnev=htmlspecialchars($kepzesnev);

    $success=kepzes_insert($tiszta_kepzeskod, $tiszta_kepzesnev);

    if ($success==false){
        die("Nem sikerült felvenni.");
    }
    else{
        header("Location: kepzesek.php");
    }
}
else{
    die("Adj meg minden adatot a felvételhez!");
}
?>
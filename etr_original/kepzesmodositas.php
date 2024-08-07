<?php
include_once("common/functions.php");

$kepzeskod=$_POST["kepzeskod"];
$kepzesnev=$_POST["kepzesnev"];
$oldkepzeskod=$_POST["oldkepzeskod"];

if (isset($kepzeskod) && isset($kepzesnev) && isset($oldkepzeskod)){
    $tiszta_kepzeskod=htmlspecialchars($kepzeskod);
    $tiszta_kepzesnev=htmlspecialchars($kepzesnev);
    $tiszta_oldkepzeskod=htmlspecialchars($oldkepzeskod);

    $success=kepzes_change($tiszta_kepzeskod, $tiszta_kepzesnev, $tiszta_oldkepzeskod);

    if($success==false){
        die("Nem sikerült megváltoztatni.");
    }
    else{
        header("Location: kepzesek.php");
    }
}
?>
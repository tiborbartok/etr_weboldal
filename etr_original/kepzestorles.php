<?php
include_once("common/functions.php");
$kepzeskod=$_POST["kepzeskod"];

if(isset($kepzeskod)){
    $tiszta_kepzeskod=htmlspecialchars($kepzeskod);

    $success=kepzes_delete($kepzeskod);

    if($success==false){
        die("Nem sikerült törölni.");
    }
    else{
        header("Location: kepzesek.php");
    }
}
?>
<?php
include_once("common/functions.php");
$teremkod=$_POST["teremkod"];

if(isset($teremkod)){
    $tiszta_teremkod=htmlspecialchars($teremkod);

    $success=terem_delete($teremkod);

    if($success==false){
        die("Nem sikerült törölni.");
    }
    else{
        header("Location: termek.php");
    }
}
?>
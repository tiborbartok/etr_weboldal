<?php
include_once("common/functions.php");
$oktatokod=$_POST["oktatokod"];

if(isset($oktatokod)){
    $tiszta_oktatokod=htmlspecialchars($oktatokod);

    $success=oktato_delete($oktatokod);

    if($success==false){
        die("Nem sikerült törölni.");
    }
    else{
        header("Location: oktatok.php");
    }
}
?>
<?php
include_once("common/functions.php");
$hallgatokod=$_POST["hallgatokod"];

if(isset($hallgatokod)){
    $tiszta_hallgatokod=htmlspecialchars($hallgatokod);

    $success=hallgato_delete($tiszta_hallgatokod);

    if($success==false){
        die("Nem sikerült törölni.");
    }
    else{
        header("Location: hallgatok.php");
    }
}
?>
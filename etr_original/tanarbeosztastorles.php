<?php
include_once("common/functions.php");

$oktatokod=$_POST["oktatokod"];
$kurzuskod=$_POST["kurzuskod"];

if(isset($oktatokod) && isset($kurzuskod)){
    $tiszta_oktatokod=htmlspecialchars($oktatokod);
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);

    $success=beosztas_delete($tiszta_oktatokod, $tiszta_kurzuskod);

    if($success==false){
        die("Nem sikerült törölni.");
    }
    else{
        header("Location: tanarbeosztas.php");
    }
}
?>
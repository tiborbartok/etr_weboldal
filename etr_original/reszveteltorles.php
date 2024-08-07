<?php
include_once("common/functions.php");

$hallgatokod=$_POST["hallgatokod"];
$kurzuskod=$_POST["kurzuskod"];

if(isset($hallgatokod) && isset($kurzuskod)){
    $tiszta_hallgatokod=htmlspecialchars($hallgatokod);
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);

    $success=reszvetel_delete($tiszta_hallgatokod, $tiszta_kurzuskod);

    if($success==false){
        die("Nem sikerült törölni.");
    }
    else{
        header("Location: reszvetelek.php");
    }
}
?>
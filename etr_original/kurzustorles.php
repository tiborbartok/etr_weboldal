<?php
include_once("common/functions.php");
$kurzuskod=$_POST["kurzuskod"];

if(isset($kurzuskod)){
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);

    $success=kurzus_delete($tiszta_kurzuskod);

    if($success==false){
        die("Nem sikerült törölni.");
    }
    else{
        header("Location: kurzusok.php");
    }
}
?>
<?php
include_once("common/functions.php");

$teremkod=$_POST["teremkod"];
$kurzuskod=$_POST["kurzuskod"];

if(isset($teremkod) && isset($kurzuskod)){
    $tiszta_teremkod=htmlspecialchars($teremkod);
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);

    $success=helyszin_delete($tiszta_teremkod, $tiszta_kurzuskod);

    if($success==false){
        die("Nem sikerült törölni.");
    }
    else{
        header("Location: helyszin.php");
    }
}
?>
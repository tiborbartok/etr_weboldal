<?php
include_once("common/functions.php");

$teremkod=$_POST["teremkod"];
$teremnev=$_POST["teremnev"];
$teremferohely=$_POST["teremferohely"];
$oldteremkod=$_POST["oldteremkod"];

if (isset($teremkod) && isset($teremnev) && isset($teremferohely) && isset($oldteremkod) && $teremkod!=null && $teremnev!=null && $teremferohely!=null){
    $tiszta_teremkod=htmlspecialchars($teremkod);
    $tiszta_teremnev=htmlspecialchars($teremnev);
    $tiszta_teremferohely=htmlspecialchars($teremferohely);
    $tiszta_oldteremkod=htmlspecialchars($oldteremkod);
    

    $success=terem_change($tiszta_teremkod, $tiszta_teremnev, $tiszta_teremferohely, $tiszta_oldteremkod);

    if($success==false){
        die("Nem sikerült megváltoztatni.");
    }
    else{
        header("Location: termek.php");
    }
}
?>
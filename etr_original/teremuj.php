<?php
include_once("common/functions.php");

$teremkod=$_POST["teremkod"];
$teremnev=$_POST["teremnev"];
$teremferohely=$_POST["teremferohely"];

if (isset($teremkod) && isset($teremnev) && isset($teremferohely) && $teremkod!=null && $teremnev!=null && $teremferohely!=null){
    $tiszta_teremkod=htmlspecialchars($teremkod);
    $tiszta_teremnev=htmlspecialchars($teremnev);
    $tiszta_teremferohely=htmlspecialchars($teremferohely);

    $success=terem_insert($tiszta_teremkod, $tiszta_teremnev, $tiszta_teremferohely);

    if ($success==false){
        die("Nem sikerült felvenni.");
    }
    else{
        header("Location: termek.php");
    }
}
else{
    die("Adj meg minden adatot a felvételhez!");
}
?>
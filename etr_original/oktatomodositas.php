<?php
include_once("common/functions.php");

$oktatokod=$_POST["oktatokod"];
$oktatovezeteknev=$_POST["oktatovezeteknev"];
$oktatokeresztnev=$_POST["oktatokeresztnev"];
$szulev=$_POST["szulev"];
$szulhonap=$_POST["szulhonap"];
$szulnap=$_POST["szulnap"];
$szuldatum=date('Y-m-d', mktime(0,0,0, $szulhonap, $szulnap, $szulev));
$oldoktatokod=$_POST["oldoktatokod"];

if (isset($oktatokod) && isset($oktatovezeteknev) && isset($oktatokeresztnev) && isset($szuldatum) && isset($oldoktatokod)
    && $oktatokod!=null && $oktatovezeteknev!=null && $oktatokeresztnev!=null && $szuldatum!=null && $oldoktatokod!=null){
    $tiszta_oktatokod=htmlspecialchars($oktatokod);
    $tiszta_oktatovezeteknev=htmlspecialchars($oktatovezeteknev);
    $tiszta_oktatokeresztnev=htmlspecialchars($oktatokeresztnev);
    $tiszta_oldoktatokod=htmlspecialchars($oldoktatokod);
    

    $success=oktato_change($tiszta_oktatokod, $tiszta_oktatovezeteknev, $tiszta_oktatokeresztnev, $szuldatum, $tiszta_oldoktatokod);

    if($success==false){
        die("Nem sikerült megváltoztatni.");
    }
    else{
        header("Location: oktatok.php");
    }
}
?>
<?php
include_once("common/functions.php");

$hallgatokod=$_POST["hallgatokod"];
$hallgatovezeteknev=$_POST["hallgatovezeteknev"];
$hallgatokeresztnev=$_POST["hallgatokeresztnev"];
$szulev=$_POST["hallgatoszulev"];
$szulhonap=$_POST["hallgatoszulhonap"];
$szulnap=$_POST["hallgatoszulnap"];
$szuletesidatum=date('Y-m-d', mktime(0,0,0, $szulhonap, $szulnap, $szulev));
$felvettkepzes=$_POST["felvettkepzes"];
$felveteliev=$_POST["felveteliev"];


if (isset($hallgatokod) && isset($hallgatovezeteknev) && isset($hallgatokeresztnev) && isset($szuletesidatum) && isset($felvettkepzes) && isset($felveteliev) &&
    $hallgatokod!=null && $hallgatovezeteknev!=null && $hallgatokeresztnev!=null && $szuletesidatum!=null && $felvettkepzes!=null && $felveteliev!=null){
    $tiszta_hallgatokod=htmlspecialchars($hallgatokod);
    $tiszta_hallgatovezeteknev=htmlspecialchars($hallgatovezeteknev);
    $tiszta_hallgatokeresztnev=htmlspecialchars($hallgatokeresztnev);
    $tiszta_felvettkepzes=htmlspecialchars($felvettkepzes);
    $tiszta_felveteliev=htmlspecialchars($felveteliev);

    $success=hallgato_insert($tiszta_hallgatokod, $tiszta_hallgatovezeteknev, $tiszta_hallgatokeresztnev, $szuletesidatum, $tiszta_felvettkepzes, $tiszta_felveteliev);

    if ($success==false){
        die("Nem sikerült felvenni.");
    }
    else{
        header("Location: hallgatok.php");
    }
}
else{
    die("Adj meg minden adatot a felvételhez!");
}
?>
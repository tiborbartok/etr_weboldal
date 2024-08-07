<?php
include_once("common/functions.php");

$hallgatokod=$_POST["hallgatokod"];
$hallgatovezeteknev=$_POST["hallgatovezeteknev"];
$hallgatokeresztnev=$_POST["hallgatokeresztnev"];
$szulev=$_POST["szulev"];
$szulhonap=$_POST["szulhonap"];
$szulnap=$_POST["szulnap"];
$szuldatum=date('Y-m-d', mktime(0,0,0, $szulhonap, $szulnap, $szulev));
$felvettkepzes=$_POST["felvettkepzes"];
$felveteliev=$_POST["felveteliev"];
$oldhallgatokod=$_POST["oldhallgatokod"];

if (isset($hallgatokod) && isset($hallgatovezeteknev) && isset($hallgatokeresztnev) && isset($szuldatum) && isset($felvettkepzes) && isset($felveteliev) && isset($oldhallgatokod)
    && $hallgatokod!=null && $hallgatovezeteknev!=null && $hallgatokeresztnev!=null && $szuldatum!=null && $felvettkepzes!=null && $felveteliev!=null && $oldhallgatokod!=null){
    $tiszta_hallgatokod=htmlspecialchars($hallgatokod);
    $tiszta_hallgatovezeteknev=htmlspecialchars($hallgatovezeteknev);
    $tiszta_hallgatokeresztnev=htmlspecialchars($hallgatokeresztnev);
    $tiszta_felvettkepzes=htmlspecialchars($felvettkepzes);
    $tiszta_felveteliev=htmlspecialchars($felveteliev);
    $tiszta_oldhallgatokod=htmlspecialchars($oldhallgatokod);
    

    $success=hallgato_change($tiszta_hallgatokod, $tiszta_hallgatovezeteknev, $tiszta_hallgatokeresztnev, $szuldatum, $tiszta_felvettkepzes, $tiszta_felveteliev, $tiszta_oldhallgatokod);

    if($success==false){
        die("Nem sikerült megváltoztatni.");
    }
    else{
        header("Location: hallgatok.php");
    }
}
?>
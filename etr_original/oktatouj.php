<?php
include_once("common/functions.php");

$oktatokod=$_POST["oktatokod"];
$oktatovezeteknev=$_POST["oktatovezeteknev"];
$oktatokeresztnev=$_POST["oktatokeresztnev"];
$oktatoszulev=$_POST["oktatoszulev"];
$oktatoszulhonap=$_POST["oktatoszulhonap"];
$oktatoszulnap=$_POST["oktatoszulnap"];
$oktatoszuletesidatum=date('Y-m-d', mktime(0,0,0, $oktatoszulhonap, $oktatoszulnap, $oktatoszulev));

if (isset($oktatokod) && isset($oktatovezeteknev) && isset($oktatokeresztnev) && isset($oktatoszuletesidatum) && $oktatokod!=null && $oktatovezeteknev!=null && $oktatokeresztnev!=null && $oktatoszuletesidatum!=null){
    $tiszta_oktatokod=htmlspecialchars($oktatokod);
    $tiszta_oktatovezeteknev=htmlspecialchars($oktatovezeteknev);
    $tiszta_oktatokeresztnev=htmlspecialchars($oktatokeresztnev);

    $success=oktato_insert($tiszta_oktatokod, $tiszta_oktatovezeteknev, $tiszta_oktatokeresztnev, $oktatoszuletesidatum);

    if ($success==false){
        die("Nem sikerült felvenni.");
    }
    else{
        header("Location: oktatok.php");
    }
}
else{
    die("Adj meg minden adatot a felvételhez!");
}
?>
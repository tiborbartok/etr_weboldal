<?php
include_once("common/functions.php");

$hallgatokod=$_POST["reszvetelhallgato"];
$kurzuskod=$_POST["reszvetelkurzus"];
$oldhallgatokod=$_POST["oldhallgatokod"];
$oldkurzuskod=$_POST["oldkurzuskod"];

if (isset($hallgatokod) && isset($kurzuskod) && isset($oldhallgatokod) && isset($oldkurzuskod) && $hallgatokod!=null && $kurzuskod!=null && $oldhallgatokod!=null && $oldkurzuskod!=null){
    $tiszta_hallgatokod=htmlspecialchars($hallgatokod);
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);
    $tiszta_oldhallgatokod=htmlspecialchars($oldhallgatokod);
    $tiszta_oldkurzuskod=htmlspecialchars($oldkurzuskod);
    

    $success=reszvetel_change($tiszta_hallgatokod, $tiszta_kurzuskod, $tiszta_oldhallgatokod, $tiszta_oldkurzuskod);

    if($success==false){
        die("Nem sikerült megváltoztatni.");
    }
    else{
        header("Location: reszvetelek.php");
    }
}
?>
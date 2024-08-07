<?php
include_once("common/functions.php");

$kurzuskod=$_POST["kurzuskod"];
$kurzusnev=$_POST["kurzusnev"];
$kurzuskepzes=$_POST["kurzuskepzes"];


if (isset($kurzuskod) && isset($kurzusnev) && isset($kurzuskepzes) && $kurzuskod!=null && $kurzusnev!=null && $kurzuskepzes!=null){
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);
    $tiszta_kurzusnev=htmlspecialchars($kurzusnev);
    $tiszta_kurzuskepzes=htmlspecialchars($kurzuskepzes);

    $success=kurzus_insert($tiszta_kurzuskod, $tiszta_kurzusnev, $tiszta_kurzuskepzes);

    if ($success==false){
        die("Nem sikerült felvenni.");
    }
    else{
        header("Location: kurzusok.php");
    }
}
else{
    die("Adj meg minden adatot a felvételhez!");
}
?>
<?php
include_once("common/functions.php");

$kurzuskod=$_POST["kurzuskod"];
$kurzusnev=$_POST["kurzusnev"];
$kurzuskepzes=$_POST["kurzuskepzes"];
$oldkurzuskod=$_POST["oldkurzuskod"];

if (isset($kurzuskod) && isset($kurzusnev) && isset($kurzuskepzes) && isset($oldkurzuskod) && $kurzuskod!=null && $kurzusnev!=null && $kurzuskepzes!=null && $oldkurzuskod!=null){
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);
    $tiszta_kurzusnev=htmlspecialchars($kurzusnev);
    $tiszta_kurzuskepzes=htmlspecialchars($kurzuskepzes);
    $tiszta_oldkurzuskod=htmlspecialchars($oldkurzuskod);
    

    $success=kurzus_change($tiszta_kurzuskod, $tiszta_kurzusnev, $tiszta_kurzuskepzes, $tiszta_oldkurzuskod);

    if($success==false){
        die("Nem sikerült megváltoztatni.");
    }
    else{
        header("Location: kurzusok.php");
    }
}
?>
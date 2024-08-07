<?php
include_once("common/functions.php");

$teremkod=$_POST["helyszinterem"];
$kurzuskod=$_POST["helyszinkurzus"];
$oldteremkod=$_POST["oldteremkod"];
$oldkurzuskod=$_POST["oldkurzuskod"];

if (isset($teremkod) && isset($kurzuskod) && isset($oldteremkod) && isset($oldkurzuskod) && $teremkod!=null && $kurzuskod!=null && $oldteremkod!=null && $oldkurzuskod!=null){
    $tiszta_teremkod=htmlspecialchars($teremkod);
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);
    $tiszta_oldteremkod=htmlspecialchars($oldteremkod);
    $tiszta_oldkurzuskod=htmlspecialchars($oldkurzuskod);
    

    $success=helyszin_change($tiszta_teremkod, $tiszta_kurzuskod, $tiszta_oldteremkod, $tiszta_oldkurzuskod);

    if($success==false){
        die("Nem sikerült megváltoztatni.");
    }
    else{
        header("Location: helyszin.php");
    }
}
?>
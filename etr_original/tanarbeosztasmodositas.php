<?php
include_once("common/functions.php");

$oktatokod=$_POST["beosztasoktato"];
$kurzuskod=$_POST["beosztaskurzus"];
$oldoktatokod=$_POST["oldoktatokod"];
$oldkurzuskod=$_POST["oldkurzuskod"];

if (isset($oktatokod) && isset($kurzuskod) && isset($oldoktatokod) && isset($oldkurzuskod) && $oktatokod!=null && $kurzuskod!=null && $oldoktatokod!=null && $oldkurzuskod!=null){
    $tiszta_oktatokod=htmlspecialchars($oktatokod);
    $tiszta_kurzuskod=htmlspecialchars($kurzuskod);
    $tiszta_oldoktatokod=htmlspecialchars($oldoktatokod);
    $tiszta_oldkurzuskod=htmlspecialchars($oldkurzuskod);
    

    $success=beosztas_change($tiszta_oktatokod, $tiszta_kurzuskod, $tiszta_oldoktatokod, $tiszta_oldkurzuskod);

    if($success==false){
        die("Nem sikerült megváltoztatni.");
    }
    else{
        header("Location: tanarbeosztas.php");
    }
}
?>
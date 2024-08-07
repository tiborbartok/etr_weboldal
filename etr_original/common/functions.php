<?php
function connect_to_database(){
    $connection=mysqli_connect("localhost", "etr", "etradatb") or die("Nem sikerült csatlakozni.");
    if (mysqli_select_db($connection, "ETR")==false){
        return null;
    }

    mysqli_query($connection, 'SET character_set_results=utf8');
    mysqli_set_charset($connection, 'utf8');

    return $connection;
}

function kepzes_insert($kepzeskod, $kepzesnev){
    if (!($connection=connect_to_database())){
        return false;
    }

    $result = mysqli_query($connection, "SELECT KépzésKód FROM KEPZES WHERE KépzésKód='$kepzeskod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
       die("Már létezik ilyen kódú képzés.");
    }

    $sqlstatement=mysqli_prepare($connection, "INSERT INTO KEPZES(KépzésKód, KépzésNév) VALUES(?, ?)");
    mysqli_stmt_bind_param($sqlstatement, "ss", $kepzeskod, $kepzesnev);
    
    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function kepzes_change($kepzeskod, $kepzesnev, $oldkepzeskod){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT KépzésKód FROM KEPZES WHERE KépzésKód='$kepzeskod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && $kepzeskod!=$oldkepzeskod) {
        die("Már létezik ilyen kódú képzés.");
    }

    $sqlstatement=mysqli_prepare($connection, "UPDATE KEPZES SET KépzésKód=?, KépzésNév=? WHERE KépzésKód='$oldkepzeskod'");
    mysqli_stmt_bind_param($sqlstatement, "ss", $kepzeskod, $kepzesnev);

    $success=mysqli_stmt_execute($sqlstatement);

    if($success==false){
        die(mysqli_error($connection));
    }

    mysqli_close($connection);
    return $success;
}

function kepzes_delete($kepzeskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $sqlstatement=mysqli_prepare($connection, "DELETE FROM KEPZES WHERE KépzésKód=?");
    mysqli_stmt_bind_param($sqlstatement, "s", $kepzeskod);

    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_kepzesek(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT KépzésKód, KépzésNév FROM KEPZES");

    mysqli_close($connection);
    return $res;
}

function get_kepzesadatok($kepzeskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT KépzésKód, KépzésNév FROM KEPZES WHERE KépzésKód='$kepzeskod'");
    $res2=mysqli_fetch_assoc($res);

    mysqli_close($connection);
    return $res2;
}

function oktato_insert($oktatokod, $oktatovezeteknev, $oktatokeresztnev, $szuletesidatum){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT OktatóKód FROM OKTATO WHERE OktatóKód='$oktatokod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        die("Már létezik ilyen kódú oktató.");
    }

    $sqlstatement=mysqli_prepare($connection, "INSERT INTO OKTATO(OktatóKód, OktatóVezetékNév, OktatóKeresztNév, OktatóSzületésiDátum) VALUES(?, ?, ?, ?)");
    mysqli_stmt_bind_param($sqlstatement, "ssss", $oktatokod, $oktatovezeteknev, $oktatokeresztnev, $szuletesidatum);
    
    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_oktatok(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT OktatóKód, OktatóVezetékNév, OktatóKeresztNév, OktatóSzületésiDátum FROM OKTATO");

    mysqli_close($connection);
    return $res;
}

function get_oktatoadatok($oktatokod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT OktatóKód, OktatóVezetékNév, OktatóKeresztNév, OktatóSzületésiDátum FROM OKTATO WHERE OktatóKód='$oktatokod'");
    $res2=mysqli_fetch_assoc($res);

    mysqli_close($connection);
    return $res2;
}

function oktato_change($oktatokod, $oktatovezeteknev, $oktatokeresztnev, $szuldatum, $oldoktatokod){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT OktatóKód FROM OKTATO WHERE OktatóKód='$oktatokod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && $oktatokod!=$oldoktatokod) {
        die("Már létezik ilyen kódú oktató.");
    }

    $sqlstatement=mysqli_prepare($connection, "UPDATE OKTATO SET OktatóKód=?, OktatóVezetékNév=?, OktatóKeresztNév=?, OktatóSzületésiDátum=? WHERE OktatóKód='$oldoktatokod'");
    mysqli_stmt_bind_param($sqlstatement, "ssss", $oktatokod, $oktatovezeteknev, $oktatokeresztnev, $szuldatum);

    $success=mysqli_stmt_execute($sqlstatement);

    if($success==false){
        die(mysqli_error($connection));
    }

    mysqli_close($connection);
    return $success;
}

function oktato_delete($oktatokod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $sqlstatement=mysqli_prepare($connection, "DELETE FROM OKTATO WHERE OktatóKód=?");
    mysqli_stmt_bind_param($sqlstatement, "s", $oktatokod);

    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function terem_insert($teremkod, $teremnev, $teremferohely){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT TeremKód FROM TEREM WHERE TeremKód='$teremkod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        die("Már létezik ilyen kódú terem.");
    }

    $sqlstatement=mysqli_prepare($connection, "INSERT INTO TEREM(TeremKód, TeremNév, TeremFérőhely) VALUES(?, ?, ?)");
    mysqli_stmt_bind_param($sqlstatement, "ssd", $teremkod, $teremnev, $teremferohely);
    
    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_termek(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT TeremKód, TeremNév, TeremFérőhely FROM TEREM");

    mysqli_close($connection);
    return $res;
}

function get_teremadatok($teremkod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT TeremKód, TeremNév, TeremFérőhely FROM TEREM WHERE TeremKód='$teremkod'");
    $res2=mysqli_fetch_assoc($res);

    mysqli_close($connection);
    return $res2;
}

function terem_change($teremkod, $teremnev, $teremferohely, $oldteremkod){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT TeremKód FROM TEREM WHERE TeremKód='$teremkod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && $teremkod!=$oldteremkod) {
        die("Már létezik ilyen kódú terem.");
    }

    $sqlstatement=mysqli_prepare($connection, "UPDATE TEREM SET TeremKód=?, TeremNév=?, TeremFérőhely=? WHERE TeremKód='$oldteremkod'");
    mysqli_stmt_bind_param($sqlstatement, "ssd", $teremkod, $teremnev, $teremferohely);

    $success=mysqli_stmt_execute($sqlstatement);

    if($success==false){
        die(mysqli_error($connection));
    }

    mysqli_close($connection);
    return $success;
}

function terem_delete($teremkod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $sqlstatement=mysqli_prepare($connection, "DELETE FROM TEREM WHERE TeremKód=?");
    mysqli_stmt_bind_param($sqlstatement, "s", $teremkod);

    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_felvehetokepzesek(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT KépzésKód, KépzésNév FROM KEPZES");

    mysqli_close($connection);
    return $res;
}

function get_felvehetokurzusok(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT KurzusKód, KurzusNév, KépzésKód FROM KURZUS");

    mysqli_close($connection);
    return $res;
}

function get_felvehetohallgatok(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT HallgatóKód, HallgatóVezetékNév, HallgatóKeresztNév, KépzésKód FROM HALLGATO");

    mysqli_close($connection);
    return $res;
}

function get_felvehetooktatok(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT OktatóKód, OktatóVezetékNév, OktatóKeresztNév FROM OKTATO");

    mysqli_close($connection);
    return $res;
}

function get_felvehetotermek(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT TeremKód, TeremNév, TeremFérőhely FROM TEREM");

    mysqli_close($connection);
    return $res;
}

function hallgato_insert($hallgatokod, $hallgatovezeteknev, $hallgatokeresztnev, $szuletesidatum, $felvettkepzes, $felveteliev){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT HallgatóKód FROM HALLGATO WHERE HallgatóKód='$hallgatokod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        die("Már létezik ilyen kódú hallgató.");
    }

    $sqlstatement=mysqli_prepare($connection, "INSERT INTO HALLGATO(HallgatóKód, HallgatóVezetékNév, HallgatóKeresztNév, HallgatóSzületésiDátum, KépzésKód, FelvételiÉv) 
    VALUES(?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sqlstatement, "sssssd", $hallgatokod, $hallgatovezeteknev, $hallgatokeresztnev, $szuletesidatum, $felvettkepzes, $felveteliev);
    
    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_hallgatok(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT HallgatóKód, HallgatóVezetékNév, HallgatóKeresztNév, HallgatóSzületésiDátum, KépzésKód, FelvételiÉv FROM HALLGATO");

    mysqli_close($connection);
    return $res;
}

function get_hallgatoadatok($hallgatokod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT HallgatóKód, HallgatóVezetékNév, HallgatóKeresztNév, YEAR(HallgatóSzületésiDátum) as ev, MONTH(HallgatóSzületésiDátum) as honap,
    DAY(HallgatóSzületésiDátum) as nap, KépzésKód, FelvételiÉv FROM HALLGATO WHERE HallgatóKód='$hallgatokod'");
    $res2=mysqli_fetch_assoc($res);

    mysqli_close($connection);
    return $res2;
}

function hallgato_change($hallgatokod, $hallgatovezeteknev, $hallgatokeresztnev, $szuldatum, $felvettkepzes, $felveteliev, $oldhallgatokod){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT HallgatóKód FROM HALLGATO WHERE HallgatóKód='$hallgatokod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && $hallgatokod!=$oldhallgatokod) {
        die("Már létezik ilyen kódú oktató.");
    }

    $sqlstatement=mysqli_prepare($connection, "UPDATE HALLGATO SET HallgatóKód=?, HallgatóVezetékNév=?, HallgatóKeresztNév=?, HallgatóSzületésiDátum=?,
    KépzésKód=?, FelvételiÉv=? WHERE HallgatóKód='$oldhallgatokod'");
    mysqli_stmt_bind_param($sqlstatement, "sssssd", $hallgatokod, $hallgatovezeteknev, $hallgatokeresztnev, $szuldatum, $felvettkepzes, $felveteliev);

    $success=mysqli_stmt_execute($sqlstatement);

    if($success==false){
        die(mysqli_error($connection));
    }

    mysqli_close($connection);
    return $success;
}

function hallgato_delete($hallgatokod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $sqlstatement=mysqli_prepare($connection, "DELETE FROM HALLGATO WHERE HallgatóKód=?");
    mysqli_stmt_bind_param($sqlstatement, "s", $hallgatokod);

    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function kurzus_insert($kurzuskod, $kurzusnev, $kurzuskepzes){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT KurzusKód FROM KURZUS WHERE KurzusKód='$kurzuskod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        die("Már létezik ilyen kódú kurzus.");
    }

    $sqlstatement=mysqli_prepare($connection, "INSERT INTO KURZUS(KurzusKód, KurzusNév, KépzésKód) VALUES(?, ?, ?)");
    mysqli_stmt_bind_param($sqlstatement, "sss", $kurzuskod, $kurzusnev, $kurzuskepzes);
    
    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_kurzusok(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT KurzusKód, KurzusNév, KépzésKód FROM KURZUS");

    mysqli_close($connection);
    return $res;
}

function get_kurzusadatok($kurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT KurzusKód, KurzusNév, KépzésKód FROM KURZUS WHERE KurzusKód='$kurzuskod'");
    $res2=mysqli_fetch_assoc($res);

    mysqli_close($connection);
    return $res2;
}

function kurzus_change($kurzuskod, $kurzusnev, $kurzuskepzes, $oldkurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT KurzusKód FROM KURZUS WHERE KurzusKód='$kurzuskod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && $kurzuskod!=$oldkurzuskod) {
        die("Már létezik ilyen kódú kurzus.");
    }

    $sqlstatement=mysqli_prepare($connection, "UPDATE KURZUS SET KurzusKód=?, KurzusNév=?, KépzésKód=? WHERE KurzusKód='$oldkurzuskod'");
    mysqli_stmt_bind_param($sqlstatement, "sss", $kurzuskod, $kurzusnev, $kurzuskepzes);

    $success=mysqli_stmt_execute($sqlstatement);

    if($success==false){
        die(mysqli_error($connection));
    }

    mysqli_close($connection);
    return $success;
}

function kurzus_delete($kurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $sqlstatement=mysqli_prepare($connection, "DELETE FROM KURZUS WHERE KurzusKód=?");
    mysqli_stmt_bind_param($sqlstatement, "s", $kurzuskod);

    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_reszvetel(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT HALLGAT.HallgatóKód AS hallkod, HALLGATO.HallgatóVezetékNév AS hallvez , HALLGATO.HallgatóKeresztNév AS hallker, HALLGAT.KurzusKód AS kurkod, KURZUS.KurzusNév AS kurnev,
    HALLGATO.KépzésKód AS kepkod FROM HALLGATO INNER JOIN HALLGAT ON HALLGAT.HallgatóKód=HALLGATO.HallgatóKód INNER JOIN KURZUS ON HALLGAT.KurzusKód=KURZUS.KurzusKód");

    mysqli_close($connection);
    return $res;
}

function reszvetel_insert($reszvetelhallgato, $reszvetelkurzus){
    if(!($connection=connect_to_database())){
        return false;
    }
    $result = mysqli_query($connection, "SELECT HallgatóKód, KurzusKód FROM HALLGAT WHERE HallgatóKód='$reszvetelhallgato' AND KurzusKód='$reszvetelkurzus' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        die("Ez a hallgató már részt vesz a kurzuson.");
    }

    $result2 = mysqli_query($connection, "SELECT HALLGATO.KépzésKód AS hallkod, KURZUS.KépzésKód AS kurkod FROM HALLGATO, KURZUS WHERE HALLGATO.HallgatóKód='$reszvetelhallgato' AND KURZUS.KurzusKód='$reszvetelkurzus' LIMIT 1");
    $result2arr=mysqli_fetch_assoc($result2);
    if ($result2arr["hallkod"] != $result2arr["kurkod"]){
        die("A hallgató más képzés kurzusára nem járhat.");
    }

    $sqlstatement=mysqli_prepare($connection, "INSERT INTO HALLGAT(HallgatóKód, KurzusKód) VALUES(?, ?)");
    mysqli_stmt_bind_param($sqlstatement, "ss", $reszvetelhallgato, $reszvetelkurzus);
    
    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_reszveteladatok($hallgatokod, $kurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT HallgatóKód, KurzusKód FROM HALLGAT WHERE HallgatóKód='$hallgatokod' AND KurzusKód='$kurzuskod'");
    $res2=mysqli_fetch_assoc($res);

    mysqli_close($connection);
    return $res2;
}

function reszvetel_change($hallgatokod, $kurzuskod, $oldhallgatokod, $oldkurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $result = mysqli_query($connection, "SELECT HallgatóKód, KurzusKód FROM HALLGAT WHERE HallgatóKód='$hallgatokod' AND KurzusKód='$kurzuskod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && ($hallgatokod!=$oldhallgatokod || $kurzuskod!=$oldkurzuskod)) {
        die("Ez a hallgató már részt vesz a kurzuson.");
    }

    $result2 = mysqli_query($connection, "SELECT HALLGATO.KépzésKód AS hallkod, KURZUS.KépzésKód AS kurkod FROM HALLGATO, KURZUS WHERE HALLGATO.HallgatóKód='$hallgatokod' AND KURZUS.KurzusKód='$kurzuskod' LIMIT 1");
    $result2arr=mysqli_fetch_assoc($result2);
    if ($result2arr["hallkod"] != $result2arr["kurkod"]){
        die("A hallgató más képzés kurzusára nem járhat.");
    }

    $sqlstatement=mysqli_prepare($connection, "UPDATE HALLGAT SET HallgatóKód=?, KurzusKód=? WHERE HallgatóKód='$oldhallgatokod' AND KurzusKód='$oldkurzuskod'");
    mysqli_stmt_bind_param($sqlstatement, "ss", $hallgatokod, $kurzuskod);

    $success=mysqli_stmt_execute($sqlstatement);

    if($success==false){
        die(mysqli_error($connection));
    }

    mysqli_close($connection);
    return $success;
}

function reszvetel_delete($hallgatokod, $kurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $sqlstatement=mysqli_prepare($connection, "DELETE FROM HALLGAT WHERE HallgatóKód=? AND KurzusKód=?");
    mysqli_stmt_bind_param($sqlstatement, "ss", $hallgatokod, $kurzuskod);

    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function tanarbeosztas_insert($beosztasoktato, $beosztaskurzus){
    if(!($connection=connect_to_database())){
        return false;
    }

    $result = mysqli_query($connection, "SELECT OktatóKód, KurzusKód FROM OKTAT WHERE OktatóKód='$beosztasoktato' AND KurzusKód='$beosztaskurzus' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        die("Ez az oktató már tanít a kurzuson.");
    }

    $sqlstatement=mysqli_prepare($connection, "INSERT INTO OKTAT(OktatóKód, KurzusKód) VALUES(?, ?)");
    mysqli_stmt_bind_param($sqlstatement, "ss", $beosztasoktato, $beosztaskurzus);
    
    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_beosztas(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT OKTATO.OktatóKód AS oktkod, OKTATO.OktatóVezetékNév AS oktvez , OKTATO.OktatóKeresztNév AS oktker, OKTAT.KurzusKód AS kurkod, KURZUS.KurzusNév AS kurnev
    FROM OKTATO INNER JOIN OKTAT ON OKTAT.OktatóKód=OKTATO.OktatóKód INNER JOIN KURZUS ON OKTAT.KurzusKód=KURZUS.KurzusKód");

    mysqli_close($connection);
    return $res;
}

function get_beosztasadatok($oktatokod, $kurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT OktatóKód, KurzusKód FROM OKTAT WHERE OktatóKód='$oktatokod' AND KurzusKód='$kurzuskod'");
    $res2=mysqli_fetch_assoc($res);

    mysqli_close($connection);
    return $res2;
}

function beosztas_change($oktatokod, $kurzuskod, $oldoktatokod, $oldkurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $result = mysqli_query($connection, "SELECT OktatóKód, KurzusKód FROM OKTAT WHERE OktatóKód='$oktatokod' AND KurzusKód='$kurzuskod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && ($oktatokod!=$oldoktatokod || $kurzuskod!=$oldkurzuskod)) {
        die("Ez az oktató már tanít a kurzuson.");
    }

    $sqlstatement=mysqli_prepare($connection, "UPDATE OKTAT SET OktatóKód=?, KurzusKód=? WHERE OktatóKód='$oldoktatokod' AND KurzusKód='$oldkurzuskod'");
    mysqli_stmt_bind_param($sqlstatement, "ss", $oktatokod, $kurzuskod);

    $success=mysqli_stmt_execute($sqlstatement);

    if($success==false){
        die(mysqli_error($connection));
    }

    mysqli_close($connection);
    return $success;
}

function beosztas_delete($oktatokod, $kurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $sqlstatement=mysqli_prepare($connection, "DELETE FROM OKTAT WHERE OktatóKód=? AND KurzusKód=?");
    mysqli_stmt_bind_param($sqlstatement, "ss", $oktatokod, $kurzuskod);

    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function helyszin_insert($helyszinterem, $helyszinkurzus){
    if(!($connection=connect_to_database())){
        return false;
    }

    $result = mysqli_query($connection, "SELECT TeremKód, KurzusKód FROM HELYSZIN WHERE TeremKód='$helyszinterem' AND KurzusKód='$helyszinkurzus' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0) {
        die("Ez a terem már helyszíne ennek a kurzusnak.");
    }

    $sqlstatement=mysqli_prepare($connection, "INSERT INTO HELYSZIN(TeremKód, KurzusKód) VALUES(?, ?)");
    mysqli_stmt_bind_param($sqlstatement, "ss", $helyszinterem, $helyszinkurzus);
    
    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_helyszin(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT HELYSZIN.TeremKód AS terkod, TEREM.TeremNév AS ternev , TEREM.TeremFérőhely AS terfer, KURZUS.KurzusKód AS kurkod, KURZUS.KurzusNév AS kurnev
    FROM TEREM INNER JOIN HELYSZIN ON HELYSZIN.TeremKód=TEREM.TeremKód INNER JOIN KURZUS ON HELYSZIN.KurzusKód=KURZUS.KurzusKód");

    mysqli_close($connection);
    return $res;
}

function get_helyszinadatok($teremkod, $kurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT TeremKód, KurzusKód FROM HELYSZIN WHERE TeremKód='$teremkod' AND KurzusKód='$kurzuskod'");
    $res2=mysqli_fetch_assoc($res);

    mysqli_close($connection);
    return $res2;
}

function helyszin_change($teremkod, $kurzuskod, $oldteremkod, $oldkurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $result = mysqli_query($connection, "SELECT TeremKód, KurzusKód FROM HELYSZIN WHERE TeremKód='$teremkod' AND KurzusKód='$kurzuskod' LIMIT 1");
    $num_rows = mysqli_num_rows($result);

    if ($num_rows > 0 && ($teremkod!=$oldteremkod || $kurzuskod!=$oldkurzuskod)) {
        die("Ez a terem már helyszíne ennek a kurzusnak.");
    }

    $sqlstatement=mysqli_prepare($connection, "UPDATE HELYSZIN SET TeremKód=?, KurzusKód=? WHERE TeremKód='$oldteremkod' AND KurzusKód='$oldkurzuskod'");
    mysqli_stmt_bind_param($sqlstatement, "ss", $teremkod, $kurzuskod);

    $success=mysqli_stmt_execute($sqlstatement);

    if($success==false){
        die(mysqli_error($connection));
    }

    mysqli_close($connection);
    return $success;
}

function helyszin_delete($teremkod, $kurzuskod){
    if(!($connection=connect_to_database())){
        return false;
    }

    $sqlstatement=mysqli_prepare($connection, "DELETE FROM HELYSZIN WHERE TeremKód=? AND KurzusKód=?");
    mysqli_stmt_bind_param($sqlstatement, "ss", $teremkod, $kurzuskod);

    $success=mysqli_stmt_execute($sqlstatement);
    if ($success==false){
        die(mysqli_error($connection));
    }
    mysqli_close($connection);
    return $success;
}

function get_legtobbetoktatotanar(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT OKTATO.OktatóVezetékNév AS oktvez, OKTATO.OktatóKeresztNév AS oktker, OKTAT.OktatóKód, COUNT(OKTAT.OktatóKód) FROM OKTAT INNER JOIN OKTATO ON OKTAT.OktatóKód=OKTATO.OktatóKód
    GROUP BY OKTAT.OktatóKód ORDER BY COUNT(OKTAT.OktatóKód) DESC");

    return $res;
}

function get_masfelszerterem(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT TEREM.TeremNév FROM TEREM WHERE TEREM.TeremFérőhely > 1.5*(SELECT MIN(TEREM.TeremFérőhely) FROM TEREM)");

    return $res;
}

function get_legtobbkurzus(){
    if(!($connection=connect_to_database())){
        return false;
    }

    $res=mysqli_query($connection, "SELECT KEPZES.KépzésNév AS kepnev, COUNT(KURZUS.KépzésKód) FROM KEPZES INNER JOIN KURZUS ON KURZUS.KépzésKód=KEPZES.KépzésKód
    GROUP BY KURZUS.KépzésKód ORDER BY COUNT(KURZUS.KépzésKód) DESC");

    return $res;
}
?>
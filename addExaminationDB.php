<?php

//Skripta za čuvavanje podataka o pregledu pacijenta
//Ovu skriptu koristi svi form obrasci za preglede

session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location: ../pregled/login.php');
}
include 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$id_korisnika = $ar[0];
$imeKorisnika = $ar[1];
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");

$vrsta_pregleda = mysqli_real_escape_string($conn, $_REQUEST['vrsta_pregleda']);
$id_radnika = mysqli_real_escape_string($conn, $_REQUEST['id_radnika']);
$ime_prezime_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['ime_prezime_pacijenta']);
$id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);
$datum_pregleda = date("Y-m-d");
$anamneza = mysqli_real_escape_string($conn, $_REQUEST['anamneza']);
$vod = mysqli_real_escape_string($conn, $_REQUEST['vod']);
$vos = mysqli_real_escape_string($conn, $_REQUEST['vos']);
$motilitet = mysqli_real_escape_string($conn, $_REQUEST['motilitet']);
$bms_od = mysqli_real_escape_string($conn, $_REQUEST['bms_od']);
$bms_os = mysqli_real_escape_string($conn, $_REQUEST['bms_os']);
$tonus_od = mysqli_real_escape_string($conn, $_REQUEST['tonus_od']);
$tonus_os = mysqli_real_escape_string($conn, $_REQUEST['tonus_os']);
$fundus_od = mysqli_real_escape_string($conn, $_REQUEST['fundus_od']);
$fundus_os = mysqli_real_escape_string($conn, $_REQUEST['fundus_os']);
$dijagnoza = mysqli_real_escape_string($conn, $_REQUEST['dijagnoza']);
$terapija = mysqli_real_escape_string($conn, $_REQUEST['terapija']);
$kontrola = mysqli_real_escape_string($conn, $_REQUEST['kontrola']);
$napomena_pregleda  = mysqli_real_escape_string($conn, $_REQUEST['napomena_pregleda']);

//Uslov u kome se provjera prosljeđena vrijednost vrsti pregleda (pregleda naočare ili sočiva).
//Na osnovu toga se izvršava jedan od dva upita
if ($vrsta_pregleda == "naocare") {
    $korekcija_daljina_od = mysqli_real_escape_string($conn, $_REQUEST['korekcija_daljina_od']);
    $korekcija_daljina_os = mysqli_real_escape_string($conn, $_REQUEST['korekcija_daljina_os']);
    $korekcija_blizina_od = mysqli_real_escape_string($conn, $_REQUEST['korekcija_blizina_od']);
    $korekcija_blizina_os = mysqli_real_escape_string($conn, $_REQUEST['korekcija_blizina_os']);
    $pd = mysqli_real_escape_string($conn, $_REQUEST['pd']);

    $stmt = $conn->prepare("INSERT INTO pregledi (ID_pacijenta,ID_korisnika,ID_radnika,datum_pregleda,anamneza,vod,vos,motilitet,bms_od,bms_os,tonus_od,tonus_os,fundus_od,fundus_os,dijagnoza,terapija,korekcija_daljina_od,korekcija_daljina_os,korekcija_blizina_od,korekcija_blizina_os,pd,kontrola,napomena_pregleda,vrsta_pregleda) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiisssssssssssssssssssss", $id_pacijenta, $id_korisnika, $id_radnika, $datum_pregleda, $anamneza, $vod, $vos, $motilitet, $bms_od, $bms_os, $tonus_od, $tonus_os, $fundus_od, $fundus_os, $dijagnoza, $terapija, $korekcija_daljina_od, $korekcija_daljina_os, $korekcija_blizina_od, $korekcija_blizina_os, $pd, $kontrola, $napomena_pregleda, $vrsta_pregleda);
} else {
    $proizvodjac_ks_od = mysqli_real_escape_string($conn, $_REQUEST['proizvodjac_ks_od']);
    $period_ks_od = mysqli_real_escape_string($conn, $_REQUEST['period_ks_od']);
    $tip_ks_od = mysqli_real_escape_string($conn, $_REQUEST['tip_ks_od']);
    $jacina_ks_od = mysqli_real_escape_string($conn, $_REQUEST['jacina_ks_od']);
    $bc_ks_od  = mysqli_real_escape_string($conn, $_REQUEST['bc_ks_od']);
    $velicina_ks_od  = mysqli_real_escape_string($conn, $_REQUEST['velicina_ks_od']);
    $boja_ks_od = mysqli_real_escape_string($conn, $_REQUEST['boja_ks_od']);
    $proizvodjac_ks_os = mysqli_real_escape_string($conn, $_REQUEST['proizvodjac_ks_os']);
    $period_ks_os = mysqli_real_escape_string($conn, $_REQUEST['period_ks_os']);
    $tip_ks_os = mysqli_real_escape_string($conn, $_REQUEST['tip_ks_os']);
    $jacina_ks_os = mysqli_real_escape_string($conn, $_REQUEST['jacina_ks_os']);
    $bc_ks_os = mysqli_real_escape_string($conn, $_REQUEST['bc_ks_os']);
    $velicina_ks_os  = mysqli_real_escape_string($conn, $_REQUEST['velicina_ks_os']);
    $boja_ks_os = mysqli_real_escape_string($conn, $_REQUEST['boja_ks_os']);

    //Na osnovu ID sočiva provjerava se rok sočiva (tj. koliko pakovanje sočiva moze da traje uz redovno korištenje)
    //Rok sočiva je več predifinisan u tabeli sočiva
    $id_sociva = mysqli_real_escape_string($conn, $_REQUEST['id_sociva']);
    $stmt = $conn->prepare("SELECT rok FROM sociva WHERE ID =?");
    $stmt->bind_param("i", $id_sociva);
    $stmt->execute();
    $result = $stmt->get_result();
    $rok = "";
    while ($row = $result->fetch_object()) {
        $rok = $row->rok;
    }

    //Dobijeni rok se sabira sa današnjim danom i na taj način se dobija datum kada bi pacijent trebao da potroši prepisana sočiva
    $notifikacija = date("Y-m-d", strtotime("$rok"));

    $stmt = $conn->prepare("INSERT INTO pregledi (ID_pacijenta,ID_korisnika,ID_radnika,datum_pregleda,anamneza,vod,vos,motilitet,bms_od,bms_os,tonus_od,tonus_os,fundus_od,fundus_os,dijagnoza,terapija,proizvodjac_ks_od,period_ks_od,tip_ks_od,jacina_ks_od,bc_ks_od,velicina_ks_od,boja_ks_od,proizvodjac_ks_os,period_ks_os,tip_ks_os,jacina_ks_os,bc_ks_os,velicina_ks_os,boja_ks_os,kontrola,napomena_pregleda,vrsta_pregleda,notifikacija) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiisssssssssssssssssssssssssssssss", $id_pacijenta, $id_korisnika, $id_radnika, $datum_pregleda, $anamneza, $vod, $vos, $motilitet, $bms_od, $bms_os, $tonus_od, $tonus_os, $fundus_od, $fundus_os, $dijagnoza, $terapija, $proizvodjac_ks_od, $period_ks_od, $tip_ks_od, $jacina_ks_od, $bc_ks_od, $velicina_ks_od, $boja_ks_od, $proizvodjac_ks_os, $period_ks_os, $tip_ks_os, $jacina_ks_os, $bc_ks_os, $velicina_ks_os, $boja_ks_os, $kontrola, $napomena_pregleda, $vrsta_pregleda, $notifikacija);
}

$stmt->execute();
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

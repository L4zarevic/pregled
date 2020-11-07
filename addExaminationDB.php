<?php session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location: ../pregled/login.php');
}
include 'connection.php';
$conn = OpenCon();
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 2);
$ar[1] = rtrim($ar[1], "#");
$idKorisnika = $ar[0];
$id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);
$datum_pregleda = mysqli_real_escape_string($conn, $_REQUEST['datum_pregleda']);
$a1 = mysqli_real_escape_string($conn, $_REQUEST['a1']);
$a2 = mysqli_real_escape_string($conn, $_REQUEST['a2']);
$a3 = mysqli_real_escape_string($conn, $_REQUEST['a3']);
$a4 = mysqli_real_escape_string($conn, $_REQUEST['a4']);
$a5 = mysqli_real_escape_string($conn, $_REQUEST['a5']);
$a6 = mysqli_real_escape_string($conn, $_REQUEST['a6']);
$a7 = mysqli_real_escape_string($conn, $_REQUEST['a7']);
$a8 = mysqli_real_escape_string($conn, $_REQUEST['a8']);
$a9 = mysqli_real_escape_string($conn, $_REQUEST['a9']);
$a10 = mysqli_real_escape_string($conn, $_REQUEST['a10']);
$a11 = mysqli_real_escape_string($conn, $_REQUEST['a11']);
$vod = mysqli_real_escape_string($conn, $_REQUEST['vod']);
$vos = mysqli_real_escape_string($conn, $_REQUEST['vos']);
$motilitet = mysqli_real_escape_string($conn, $_REQUEST['motilitet']);
$bms_od = mysqli_real_escape_string($conn, $_REQUEST['bms_od']);
$bms_os = mysqli_real_escape_string($conn, $_REQUEST['bms_os']);
$tonus_od = mysqli_real_escape_string($conn, $_REQUEST['tonus_od']);
$tonus_os = mysqli_real_escape_string($conn, $_REQUEST['tonus_os']);
$fundus_od = mysqli_real_escape_string($conn, $_REQUEST['fundus_od']);
$fundus_os = mysqli_real_escape_string($conn, $_REQUEST['fundus_os']);
$dijagnoza_od = mysqli_real_escape_string($conn, $_REQUEST['dijagnoza_od']);
$dijagnoza_os = mysqli_real_escape_string($conn, $_REQUEST['dijagnoza_os']);
$korekcija_od = mysqli_real_escape_string($conn, $_REQUEST['korekcija_od']);
$korekcija_os = mysqli_real_escape_string($conn, $_REQUEST['korekcija_os']);
$tip_ks_od = mysqli_real_escape_string($conn, $_REQUEST['tip_ks_od']);
$tip_ks_os = mysqli_real_escape_string($conn, $_REQUEST['tip_ks_os']);
$jacina_ks_od = mysqli_real_escape_string($conn, $_REQUEST['jacina_ks_od']);
$bc_ks_od  = mysqli_real_escape_string($conn, $_REQUEST['bc_ks_od']);
$velicina_ks_od  = mysqli_real_escape_string($conn, $_REQUEST['velicina_ks_od']);
$boja_ks_od = mysqli_real_escape_string($conn, $_REQUEST['boja_ks_od']);
$tip_ks_os = mysqli_real_escape_string($conn, $_REQUEST['tip_ks_os']);
$jacina_ks_os = mysqli_real_escape_string($conn, $_REQUEST['jacina_ks_os']);
$bc_ks_os = mysqli_real_escape_string($conn, $_REQUEST['bc_ks_os']);
$velicina_ks_os  = mysqli_real_escape_string($conn, $_REQUEST['velicina_ks_os']);
$boja_ks_os = mysqli_real_escape_string($conn, $_REQUEST['boja_ks_os']);
$pd = mysqli_real_escape_string($conn, $_REQUEST['pd']);
$kontrola = mysqli_real_escape_string($conn, $_REQUEST['kontrola']);
$napomena_pregleda  = mysqli_real_escape_string($conn, $_REQUEST['napomena_pregleda']);

$anamneza = "";
if (isset($a1)) {
    $anamneza += $a . "#";
}
if (isset($a2)) {
    $anamneza += $a2 . "#";
}
if (isset($a3)) {
    $anamneza += $a3 . "#";
}
if (isset($a4)) {
    $anamneza += $a4 . "#";
}
if (isset($a5)) {
    $anamneza += $a5 . "#";
}
if (isset($a6)) {
    $anamneza += $a6 . "#";
}
if (isset($a7)) {
    $anamneza += $a7 . "#";
}
if (isset($a8)) {
    $anamneza += $a8 . "#";
}
if (isset($a9)) {
    $anamneza += $a9 . "#";
}
if (isset($a10)) {
    $anamneza += $a10 . "#";
}
if (isset($a11)) {
    $anamneza += $a11 . "#";
}



$upit = "INSERT INTO pregledi (ID_pacijenta,ID_korisnika,datumPregleda,anamneza,vod,vos,motilitet,bms_od,bms_os,tonus_od,tonus_os,fundus_od,fundus_os,dijagnoza_od,dijagnoza_os,korekcija_od,korekcija_os,tip_ks_od,jacina_ks_od,bc_ks_od,velicina_ks_od,boja_ks_od,tip_ks_os,jacina_ks_os,bc_ks_os,velicina_ks_os,boja_ks_os,pd,kontrola,napomena_pregleda) VALUES ('','$id_pacijenta','$idKorisnika','$datum_pregleda','$anamneza','$vod','$vos','$motilitet')";
$rezultat = mysqli_query($conn, $upit);
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
header('Location: ' . $_SERVER['HTTP_REFERER'] . '?msg=2');
CloseCon($conn);

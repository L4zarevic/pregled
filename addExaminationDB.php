<?php session_start();
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

$ime_prezime_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['ime_prezime_pacijenta']);
$id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);
$datum_pregleda = mysqli_real_escape_string($conn, $_REQUEST['datum_pregleda']);
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
$korekcija_daljina_od = mysqli_real_escape_string($conn, $_REQUEST['korekcija_daljina_od']);
$korekcija_daljina_os = mysqli_real_escape_string($conn, $_REQUEST['korekcija_daljina_os']);
$korekcija_blizina_od = mysqli_real_escape_string($conn, $_REQUEST['korekcija_blizina_od']);
$korekcija_blizina_os = mysqli_real_escape_string($conn, $_REQUEST['korekcija_blizina_os']);
$tip_ks_od = mysqli_real_escape_string($conn, $_REQUEST['tip_ks_od']);
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

$upit = "INSERT INTO pregledi (ID_pacijenta,ID_korisnika,datum_pregleda,anamneza,vod,vos,motilitet,bms_od,bms_os,tonus_od,tonus_os,fundus_od,fundus_os,dijagnoza,terapija,korekcija_daljina_od,korekcija_daljina_os,korekcija_blizina_od,korekcija_blizina_os,tip_ks_od,jacina_ks_od,bc_ks_od,velicina_ks_od,boja_ks_od,tip_ks_os,jacina_ks_os,bc_ks_os,velicina_ks_os,boja_ks_os,pd,kontrola,napomena_pregleda) VALUES ('$id_pacijenta','$id_korisnika','$datum_pregleda','$anamneza','$vod','$vos','$motilitet','$bms_od','$bms_os','$tonus_od','$tonus_os','$fundus_od','$fundus_os','$dijagnoza','$terapija','$korekcija_daljina_od','$korekcija_daljina_os','$korekcija_blizina_od','$korekcija_blizina_os','$tip_ks_od','$jacina_ks_od','$bc_ks_od','$velicina_ks_od','$boja_ks_od','$tip_ks_os','$jacina_ks_os','$bc_ks_os','$velicina_ks_os','$boja_ks_os','$pd','$kontrola','$napomena_pregleda')";
$rezultat = mysqli_query($conn, $upit);
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

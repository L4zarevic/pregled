<?php

//Skripta za kreiranje radnih naloga

session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location: ../pregled/login.php');
}
include 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode('#', $korisnik, 4);
$ar[1] = rtrim($ar[1], '#');
$id_korisnika = $ar[0];
$imeKorisnika = $ar[2];
$dataBaseName = $ar[3];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, 'utf8');


$broj_radnog_naloga = mysqli_real_escape_string($conn, $_REQUEST['broj_radnog_naloga']);
$id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);
$var = mysqli_real_escape_string($conn, $_REQUEST['datum']);
$date = str_replace('.', '-', $var);
$datum = date('Y-m-d', strtotime($date));
$desno_d_sph = mysqli_real_escape_string($conn, $_REQUEST['desno_d_sph']);
$desno_d_cyl = mysqli_real_escape_string($conn, $_REQUEST['desno_d_cyl']);
$desno_d_ax = mysqli_real_escape_string($conn, $_REQUEST['desno_d_ax']);
$desno_b_sph = mysqli_real_escape_string($conn, $_REQUEST['desno_b_sph']);
$desno_b_cyl = mysqli_real_escape_string($conn, $_REQUEST['desno_b_cyl']);
$desno_b_ax = mysqli_real_escape_string($conn, $_REQUEST['desno_b_ax']);
$lijevo_d_sph = mysqli_real_escape_string($conn, $_REQUEST['lijevo_d_sph']);
$lijevo_d_cyl = mysqli_real_escape_string($conn, $_REQUEST['lijevo_d_cyl']);
$lijevo_d_ax = mysqli_real_escape_string($conn, $_REQUEST['lijevo_d_ax']);
$lijevo_b_sph = mysqli_real_escape_string($conn, $_REQUEST['lijevo_b_sph']);
$lijevo_b_cyl = mysqli_real_escape_string($conn, $_REQUEST['lijevo_b_cyl']);
$lijevo_b_ax = mysqli_real_escape_string($conn, $_REQUEST['lijevo_b_ax']);
$pd_blizina = mysqli_real_escape_string($conn, $_REQUEST['pd_blizina']);
$pd_daljina = mysqli_real_escape_string($conn, $_REQUEST['pd_daljina']);
$napomena = mysqli_real_escape_string($conn, $_REQUEST['napomena']);
$ukupno = mysqli_real_escape_string($conn, $_REQUEST['ukupno']);
$akontacija = mysqli_real_escape_string($conn, $_REQUEST['akontacija']);
$dug = mysqli_real_escape_string($conn, $_REQUEST['dug']);

$stmt = $conn->prepare('INSERT INTO radni_nalog (ID_pacijenta,ID_korisnika,broj_radnog_naloga,datum,desno_d_sph,desno_d_cyl,desno_d_ax,desno_b_sph,desno_b_cyl,desno_b_ax,lijevo_d_sph,lijevo_d_cyl,lijevo_d_ax,lijevo_b_sph,lijevo_b_cyl,lijevo_b_ax,pd_blizina,pd_daljina,napomena,ukupno,akontacija,dug) VALUE (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
$stmt->bind_param('iiissssssssssssssssddd', $id_pacijenta, $id_korisnika, $broj_radnog_naloga, $datum, $desno_d_sph, $desno_d_cyl, $desno_d_ax, $desno_b_sph, $desno_b_cyl, $desno_b_ax, $lijevo_d_sph, $lijevo_d_cyl, $lijevo_d_ax, $lijevo_b_sph, $lijevo_b_cyl, $lijevo_b_ax, $pd_blizina, $pd_daljina, $napomena, $ukupno, $akontacija, $dug);
$stmt->execute();
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

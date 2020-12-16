<?php

//Skripta za ažuriranje podataka o pacijentu u njegovom kartonu
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


$id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);
$generalije_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['generalije_pacijenta']);
$kontaktPacijenta = mysqli_real_escape_string($conn, $_REQUEST['kontakt_pacijenta']);
$napomenaPacijenta = mysqli_real_escape_string($conn, $_REQUEST['napomena_pacijenta']);
$naocare_daljina_od = mysqli_real_escape_string($conn, $_REQUEST['naocare_daljina_od']);
$naocare_daljina_os = mysqli_real_escape_string($conn, $_REQUEST['naocare_daljina_os']);
$naocare_blizina_od = mysqli_real_escape_string($conn, $_REQUEST['naocare_blizina_od']);
$naocare_blizina_os = mysqli_real_escape_string($conn, $_REQUEST['naocare_blizina_os']);
$sociva_od = mysqli_real_escape_string($conn, $_REQUEST['sociva_od']);
$sociva_os = mysqli_real_escape_string($conn, $_REQUEST['sociva_os']);

//Upit za ažuriranje podataka o pacijentu
$stmt = $conn->prepare("UPDATE pacijenti SET generalije_pacijenta=?,kontakt=?,napomena=?,naocare_daljina_od=?,naocare_daljina_os=?,naocare_blizina_od=?,naocare_blizina_os=?,sociva_od=?,sociva_os=? WHERE ID=?");
$stmt->bind_param('sssssssssi',$generalije_pacijenta,$kontaktPacijenta,$napomenaPacijenta,$naocare_daljina_od,$naocare_daljina_os,$naocare_blizina_od,$naocare_blizina_os,$sociva_od,$sociva_os,$id_pacijenta);
$stmt->execute();
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

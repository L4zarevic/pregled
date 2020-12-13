<?php

//Skripta za dobijanje podataka o radniku koji vrši pregled

session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location: ../pregled/login.php');
}
header('Content-Type: text/html; charset=utf-8');
include 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$id_korisnika = $ar[0];
$imeKorisnika = $ar[1];
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");

//Dodjeljivanje promjenljivoj vrijednosti šifre radnika koja je prosljeđena iz form obrasca pregleda
$sifra_radnika = mysqli_real_escape_string($conn, $_REQUEST['sifra_radnika']);

//Pretraga podataka o radniku na osnovu unesene šifre radnika
$upit = "SELECT * FROM radnici WHERE sifra_radnika='$sifra_radnika'";
$result = mysqli_query($conn, $upit);

//Ispis pronađenih rezultata pretrage u vidu labela
//Label sa ID-om radnika je vizualno sakriven i koristi se priliko zapisa pregleda da se zna koji je radnik obavio pregled.
while ($row = mysqli_fetch_object($result)) {
    echo "<label id='id_radnika' hidden><strong>$row->ID</strong></label>";
    echo "<label id='radnik'><strong>$row->imePrezimeRadnika</strong></label>";
}

if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

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

$id_pregleda = mysqli_real_escape_string($conn, $_REQUEST['id_pregleda']);
$anamneza = mysqli_real_escape_string($conn, $_REQUEST['anamneza']);

$upit = "UPDATE pregledi SET anamneza='$anamneza' WHERE ID='$id_pregleda'"; 
$rezultat = mysqli_query($conn, $upit);
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

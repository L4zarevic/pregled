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


$id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);
$generalije_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['generalije']);
$kontaktPacijenta = mysqli_real_escape_string($conn, $_REQUEST['kontakt_pacijenta']);
$napomenaPacijenta = mysqli_real_escape_string($conn, $_REQUEST['napomena_pacijenta']);


$upit = "UPDATE pacijenti SET generalije_pacijenta='$generalije_pacijenta',kontakt='$kontaktPacijenta',napomena='$napomenaPacijenta' WHERE ID='$id_pacijenta'";
$rezultat = mysqli_query($conn, $upit);
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

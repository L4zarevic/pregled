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
$imeKorisnika = $ar[1];
$imePacijenta = mysqli_real_escape_string($conn, $_REQUEST['imePacijenta']);
$prezimePacijenta = mysqli_real_escape_string($conn, $_REQUEST['prezimePacijenta']);
$godistePacijenta = mysqli_real_escape_string($conn, $_REQUEST['godistePacijenta']);
$kontaktPacijenta = mysqli_real_escape_string($conn, $_REQUEST['kontaktPacijenta']);
$napomenaPacijenta = mysqli_real_escape_string($conn, $_REQUEST['napomenaPacijenta']);


$upit = "INSERT INTO pacijenti (ID,IDKorisnika,imePacijenta,prezimePacijenta,godiste,kontakt,napomena) VALUES ('','$idKorisnika','$imePacijenta', '$prezimePacijenta', '$godistePacijenta','$kontaktPacijenta','$napomenaPacijenta')";
$rezultat = mysqli_query($conn, $upit);
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
header('Location: ' . $_SERVER['HTTP_REFERER'] . '?msg=2');
CloseCon($conn);

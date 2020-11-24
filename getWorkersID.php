<?php session_start();
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

$sifra_radnika = mysqli_real_escape_string($conn, $_REQUEST['sifra_radnika']);

$upit = "SELECT * FROM radnici WHERE sifra_radnika='$sifra_radnika'";
$result = mysqli_query($conn, $upit);

while ($row = mysqli_fetch_object($result)) {
    echo "<label id='id_radnika' hidden><strong>$row->ID</strong></label>";
    echo "<label id='radnik'><strong>$row->imePrezimeRadnika</strong></label>";
}

if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

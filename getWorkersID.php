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

$id_radnika = mysqli_real_escape_string($conn, $_REQUEST['id_radnika']);

$upit = "SELECT * FROM radnici WHERE id_radnika='$id_radnika'";
$result = mysqli_query($conn, $upit);

while ($row = mysqli_fetch_object($result)) {
    echo "<label id='radnik'><strong>$row->imePrezimeRadnika</strong></label>";
}

if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

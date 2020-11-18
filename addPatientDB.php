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

$imePacijenta = mysqli_real_escape_string($conn, $_REQUEST['ime_pacijenta']);
$imeOcaPacijenta = mysqli_real_escape_string($conn, $_REQUEST['ime_oca_pacijenta']);
$prezimePacijenta = mysqli_real_escape_string($conn, $_REQUEST['prezime_pacijenta']);
$godistePacijenta = mysqli_real_escape_string($conn, $_REQUEST['godiste_pacijenta']);
$kontaktPacijenta = mysqli_real_escape_string($conn, $_REQUEST['kontakt_pacijenta']);
$napomenaPacijenta = mysqli_real_escape_string($conn, $_REQUEST['napomena_pacijenta']);
$naocare_blizina_od = mysqli_real_escape_string($conn, $_REQUEST['naocare_blizina_od']);
$naocare_blizina_os = mysqli_real_escape_string($conn, $_REQUEST['naocare_blizina_os']);
$naocare_daljina_od = mysqli_real_escape_string($conn, $_REQUEST['naocare_daljina_od']);
$naocare_daljina_os = mysqli_real_escape_string($conn, $_REQUEST['naocare_daljina_os']);
$sociva_od = mysqli_real_escape_string($conn, $_REQUEST['sociva_od']);
$sociva_os = mysqli_real_escape_string($conn, $_REQUEST['sociva_os']);

if (strlen($imeOcaPacijenta) > 0) {
    $generalije_pacijenta = $imePacijenta . " (" . $imeOcaPacijenta . ") " . $prezimePacijenta . " " . $godistePacijenta;
} else {
    $generalije_pacijenta = $imePacijenta . " " . $prezimePacijenta . " " . $godistePacijenta;
}


$upit = "INSERT INTO pacijenti (IDKorisnika,generalije_pacijenta,kontakt,napomena,naocare_blizina_od,naocare_blizina_os,naocare_daljina_od,naocare_daljina_os,sociva_od,sociva_os) VALUES ('$id_korisnika','$generalije_pacijenta','$kontaktPacijenta','$napomenaPacijenta','$naocare_blizina_od','$naocare_blizina_os','$naocare_daljina_od','$naocare_daljina_os','$sociva_od','$sociva_os')";
$rezultat = mysqli_query($conn, $upit);
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

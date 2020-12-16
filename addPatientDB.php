<?php
//Skripta za čuvavanje podataka o novom pacijentu pacijenta
//Ovu skriptu koristi form obrazac za dodavanje novog pacijenta "addPatientForm.php"

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

$imePacijenta = mysqli_real_escape_string($conn, $_REQUEST['ime_pacijenta']);
$imeOcaPacijenta = mysqli_real_escape_string($conn, $_REQUEST['ime_oca_pacijenta']);
$prezimePacijenta = mysqli_real_escape_string($conn, $_REQUEST['prezime_pacijenta']);
$godistePacijenta = mysqli_real_escape_string($conn, $_REQUEST['godiste_pacijenta']);
$kontaktPacijenta = mysqli_real_escape_string($conn, $_REQUEST['kontakt_pacijenta']);
$napomenaPacijenta = mysqli_real_escape_string($conn, $_REQUEST['napomena_pacijenta']);
$naocare_daljina_od = mysqli_real_escape_string($conn, $_REQUEST['naocare_daljina_od']);
$naocare_daljina_os = mysqli_real_escape_string($conn, $_REQUEST['naocare_daljina_os']);
$naocare_blizina_od = mysqli_real_escape_string($conn, $_REQUEST['naocare_blizina_od']);
$naocare_blizina_os = mysqli_real_escape_string($conn, $_REQUEST['naocare_blizina_os']);
$sociva_od = mysqli_real_escape_string($conn, $_REQUEST['sociva_od']);
$sociva_os = mysqli_real_escape_string($conn, $_REQUEST['sociva_os']);

//Uslov u kome se provjera da li je unijeto ime oca. Ukoliko jeste zapis generalija pacijenta će biti u formatu "Ime (Ime oca) Prezime godište"
if (strlen($imeOcaPacijenta) > 0) {
    $generalije_pacijenta = $imePacijenta . " (" . $imeOcaPacijenta . ") " . $prezimePacijenta . " " . $godistePacijenta;
    //Ukoliko nije format će biti "Ime Prezime godište"
} else {
    $generalije_pacijenta = $imePacijenta . " " . $prezimePacijenta . " " . $godistePacijenta;
}


$stmt = $conn->prepare("INSERT INTO pacijenti (IDKorisnika,generalije_pacijenta,kontakt,napomena,naocare_daljina_od,naocare_daljina_os,naocare_blizina_od,naocare_blizina_os,sociva_od,sociva_os) VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param('isssssssss', $id_korisnika, $generalije_pacijenta, $kontaktPacijenta, $napomenaPacijenta, $naocare_daljina_od, $naocare_daljina_os, $naocare_blizina_od, $naocare_blizina_os, $sociva_od, $sociva_os);
$stmt->execute();
//$rezultat = mysqli_query($conn, $upit);
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}
CloseCon($conn);

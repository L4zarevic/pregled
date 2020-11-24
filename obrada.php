<?php session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location:../pregled/modules/login.php');
}
include 'connection.php';
$conn = OpenCon();
mysqli_set_charset($conn,"utf8");

$korisnickoIme = mysqli_real_escape_string($conn, $_POST['korisnicko_ime']);
$lozinka = mysqli_real_escape_string($conn, $_POST['lozinka']);
$hash_password = md5($lozinka);
$upit = "select * from korisnici where korisnicko_ime='$korisnickoIme' AND lozinka='$hash_password'";
$rezultat = mysqli_query($conn, $upit);
if (!$rezultat) die(mysqli_error($conn));
while ($red = mysqli_fetch_object($rezultat)) {
    $idKorisnika = $red->ID;
    $user = $red->korisnicko_ime;
    $pass = $red->lozinka;
    $imeKorisnika = $red->naziv;
    $dataBaseName = $red->db;
}
if (!$korisnickoIme && !$lozinka) {
    $error = 1;
} else if (!$korisnickoIme) {
    $error = 1;
} else if (!$lozinka) {
    $error = 1;
} else {
    if (($korisnickoIme == $user) && ($hash_password == $pass)) {
        $error = 0;
    } else {
        $error = 1;
    }
}
if ($error == 1) {
    header("Location:login.php?msg=1");
    exit;
} else {
    $_SESSION['prijavljen'] = $idKorisnika . "#" . $imeKorisnika . "#" . $dataBaseName;
    die(header("Location:index.php"));
}

<?php session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location:../pregled/modules/login.php');
}
include 'connection.php';
$conn = OpenCon();
mysqli_set_charset($conn, "utf8");

$korisnickoIme = mysqli_real_escape_string($conn, $_POST['korisnicko_ime']);
$lozinka = mysqli_real_escape_string($conn, $_POST['lozinka']);
$hash_password = md5($lozinka);
$sql = "SELECT * FROM korisnici WHERE korisnicko_ime='$korisnickoIme' AND lozinka='$hash_password'";
$result = mysqli_query($conn, $sql);
if (!$result) die(mysqli_error($conn));
while ($row = mysqli_fetch_object($result)) {
    $idKorisnika = $row->ID;
    $user = $row->korisnicko_ime;
    $pass = $row->lozinka;
    $imeKorisnika = $row->naziv;
    $dataBaseName = $row->db;
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

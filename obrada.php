<?php session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location:../pregled/login.php');
}
$login = 0;
include 'connection.php';
$con = OpenCon();
mysqli_set_charset($con, "utf8");
$korisnickoIme = mysqli_real_escape_string($con, $_POST['korisnicko_ime']);
$lozinka = mysqli_real_escape_string($con, $_POST['lozinka']);
$hash_password = md5($lozinka);
$stmt = $con->prepare("SELECT * FROM korisnici WHERE korisnicko_ime=? AND lozinka=?");
$stmt->bind_param('ss', $korisnickoIme, $hash_password);
$stmt->execute();
$result = $stmt->get_result();
if (!$stmt) die(mysqli_error($con));
while ($row = $result->fetch_object()) {
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
        if (isset($_POST['g-recaptcha-response'])) {
            $secret = '6LdbyAgaAAAAAOLrAvSqdlWUrNRoGcJm7iEBm8CA';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                $error = 0;
            } else {
                $error = 1;
            }
        } else {
            $error = 0;
        }
    } else {
        $error = 1;
    }
}
if ($login  > 5) {
    header("Location:login.php?msg=3");
    exit;
}
if ($error == 1) {
    setcookie("login_attempts", "mjauu", time() + 5 * 60);
    header("Location:login.php?msg=1");
    exit;
} else {
    if (isset($_COOKIE['login_attempts'])) {
        unset($_COOKIE['login_attempts']);
        setcookie('login_attempts', '', time() - 3600, '/');
    }
    $_SESSION['prijavljen'] = $idKorisnika . "#" . $imeKorisnika . "#" . $dataBaseName;
    die(header("Location:index.php"));
}

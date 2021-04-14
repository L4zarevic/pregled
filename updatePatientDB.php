<?php

//Skripta za ažuriranje podataka o pacijentu u njegovom kartonu
session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location: ../pregled/login.php');
}
include 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode('#', $korisnik, 4);
$ar[1] = rtrim($ar[1], '#');
$id_korisnika = $ar[0];
$imeKorisnika = $ar[2];
$dataBaseName = $ar[3];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, 'utf8');

$id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);
$generalije_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['generalije_pacijenta']);
$kontaktPacijenta = mysqli_real_escape_string($conn, $_REQUEST['kontakt_pacijenta']);
$napomenaPacijenta = mysqli_real_escape_string($conn, $_REQUEST['napomena_pacijenta']);
$naocare_daljina_od = mysqli_real_escape_string($conn, $_REQUEST['naocare_daljina_od']);
$naocare_daljina_os = mysqli_real_escape_string($conn, $_REQUEST['naocare_daljina_os']);
$naocare_blizina_od = mysqli_real_escape_string($conn, $_REQUEST['naocare_blizina_od']);
$naocare_blizina_os = mysqli_real_escape_string($conn, $_REQUEST['naocare_blizina_os']);
$sociva_od = mysqli_real_escape_string($conn, $_REQUEST['sociva_od']);
$sociva_os = mysqli_real_escape_string($conn, $_REQUEST['sociva_os']);

//// Notifikacija za administratora ukoliko dolazi do ažuriranje generalija o pacijentu ////
$stmt = $conn->prepare('SELECT generalije_pacijenta FROM pacijenti WHERE ID =?');
$stmt->bind_param('i', $id_pacijenta);
$stmt->execute();
$result = $stmt->get_result();
$stare_generalije = "";
while ($row = $result->fetch_object()) {
    $stare_generalije = $row->generalije_pacijenta;
}
if ($stare_generalije != $generalije_pacijenta) {
    $datum = date('d.m.Y H:i');
    //Definisanje email-a
    $header = 'From: no-reply@mojaoptika.com' . "\r\n";
    $to     = 'info@mojaoptika.com';
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: text/html; charset=utf-8\r\n";
    $title  = 'Notifikacija';

    $message = '<html><body>';
    $message .= '<label>Generalije u kartonu klijenta su ažurirane</label>';
    $message .= '<br/>';
    $message .= 'Klijent (stari podaci): ' . $stare_generalije . '<br/>';
    $message .= 'Klijent (novi podaci): ' . $generalije_pacijenta . '<br/>';
    $message .= 'Datum izmjene: ' . $datum . '<br/>';
    $message .= 'Optika: ' . $imeKorisnika . '<br/>';
    $ip = "";
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $message .= 'IP adresa: ' . $ip . '<br/>';
    $message .= '<br/>';
    $message .= '<label>--------------------------------------------------</label><br/>';
    $message .= '<label>Ovo je automatski generisana poruka, ne odgovarati na nju. <a href="https://mojaoptika.com/pregled">mojaoptika.com/pregled </a></label>';
    $message .= '</body></html>';
    mail($to, $title, $message, $header);
}
/////////////////////////////////////////////////////////////////////////////////////////

//Upit za ažuriranje podataka o pacijentu
$stmt = $conn->prepare('UPDATE pacijenti SET generalije_pacijenta=?,kontakt=?,napomena=?,naocare_daljina_od=?,naocare_daljina_os=?,naocare_blizina_od=?,naocare_blizina_os=?,sociva_od=?,sociva_os=? WHERE ID=?');
$stmt->bind_param('sssssssssi', $generalije_pacijenta, $kontaktPacijenta, $napomenaPacijenta, $naocare_daljina_od, $naocare_daljina_os, $naocare_blizina_od, $naocare_blizina_os, $sociva_od, $sociva_os, $id_pacijenta);
$stmt->execute();
if (mysqli_error($conn)) {
    die(mysqli_error($conn));
}




CloseCon($conn);

<?php

require_once 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$idKorisnika = $ar[0];
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");



$todayDate = "" . date("d.m.Y");
$dateSplit = explode(".", $todayDate, 3);
$dateSplit[1] = rtrim($dateSplit[1], ".");
$startDate = "01." . $dateSplit[1] . "." . $dateSplit[2];
$sql = "SELECT COUNT(ID) AS brojPregleda FROM pregledi WHERE datum_pregleda BETWEEN '$startDate' AND '$todayDate' AND ID_korisnika='$idKorisnika'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_object($result)) {
    echo $row->brojPregleda;
}

echo $sql;

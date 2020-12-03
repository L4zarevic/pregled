<?php
session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location: ../pregled/login.php');
}
include 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");
//Getting value of "search" variable from "script.js".
if (isset($_POST['period_ks_od'])) {
    $period_ks_od = $_POST['period_ks_od'];
    $proizvodjac_ks_od = $_POST['proizvodjac_ks_od'];
    //Search query.
    $Query = "SELECT ID,tip FROM sociva WHERE ID_proizvodjaca='$proizvodjac_ks_od' AND period='$period_ks_od' ORDER BY tip ASC";
    //Query execution
    $ExecQuery = MySQLi_query($conn, $Query);
    //Creating unordered list to display result.

    echo "<option default></option>";
    //Fetching result from database.
    while ($row = mysqli_fetch_object($ExecQuery)) {
        echo "<option value='$row->ID'>$row->tip</option>";
    }
}

if (isset($_POST['tip_ks_od'])) {
    $tip_ks_od = $_POST['tip_ks_od'];
    //Search query.
    $Query = "SELECT bc FROM sociva WHERE ID='$tip_ks_od'";
    //Query execution
    $ExecQuery = MySQLi_query($conn, $Query);
    //Creating unordered list to display result.

    echo "<option default></option>";
    //Fetching result from database.
    while ($row = mysqli_fetch_object($ExecQuery)) {
        $bcValue = $row->bc;
        //  $tdValue = $row->td;
        $bcNewValue = explode("|", $bcValue);

        //$bcNewValue = trim($bcNewValue);
        foreach ($bcNewValue as $bc) {
            echo "<option>$bc</option>";
        }
    }
}

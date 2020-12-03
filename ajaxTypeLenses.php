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
    $Query = "SELECT ID,tip FROM sociva WHERE ID_proizvodjaca='$proizvodjac_ks_od' AND period='$period_ks_od' GROUP BY tip";
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
    $Query = "SELECT bc,td FROM sociva WHERE ID='$tip_ks_od'";
    //Query execution
    $ExecQuery = MySQLi_query($conn, $Query);
    //Creating unordered list to display result.

    $bcValue = "";
    $tdValue = "";
    //Fetching result from database.
    while ($row = mysqli_fetch_object($ExecQuery)) {
        $bcOldValue = $row->bc;
        $tdValue = $row->td;
        $bcNewValue = explode("|", $bcOldValue);

        //$bcNewValue = trim($bcNewValue);
        foreach ($bcNewValue as $bc) {
            $bcValue .= "<option>$bc</option>";
        }
    }
    if (strlen($bcValue) > 22) {
        echo "<option default></option>";
    }
    echo $bcValue . "@@@" . $tdValue;
}

if (isset($_POST['period_ks_os'])) {
    $period_ks_os = $_POST['period_ks_os'];
    $proizvodjac_ks_os = $_POST['proizvodjac_ks_os'];
    //Search query.
    $Query = "SELECT ID,tip FROM sociva WHERE ID_proizvodjaca='$proizvodjac_ks_os' AND period='$period_ks_os' GROUP BY tip";
    //Query execution
    $ExecQuery = MySQLi_query($conn, $Query);
    //Creating unordered list to display result.

    echo "<option default></option>";
    //Fetching result from database.
    while ($row = mysqli_fetch_object($ExecQuery)) {
        echo "<option value='$row->ID'>$row->tip</option>";
    }
}

if (isset($_POST['tip_ks_os'])) {
    $tip_ks_os = $_POST['tip_ks_os'];
    //Search query.
    $Query = "SELECT bc,td FROM sociva WHERE ID='$tip_ks_os'";
    //Query execution
    $ExecQuery = MySQLi_query($conn, $Query);
    //Creating unordered list to display result.

    $bcValue = "";
    $tdValue = "";
    //Fetching result from database.
    while ($row = mysqli_fetch_object($ExecQuery)) {
        $bcOldValue = $row->bc;
        $tdValue = $row->td;
        $bcNewValue = explode("|", $bcOldValue);

        //$bcNewValue = trim($bcNewValue);
        foreach ($bcNewValue as $bc) {
            $bcValue .= "<option>$bc</option>";
        }
    }
    // if (strlen($bcValue) > 22) {
    //     echo "<option default></option>";
    // }
    echo $bcValue . "@@@" . $tdValue;
}

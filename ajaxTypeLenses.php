<?php

//Skripta za dobijanje podataka o sočivima na osnovu izabratih select opcija - kaskadni select

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

//Provjera da li je POST metodom poslata vrijednost promjeljive period sociva OD
if (isset($_POST['period_ks_od'])) {
    //Dodjeljivanje poslatih vrijednosti promjenljivim
    $period_ks_od = $_POST['period_ks_od'];
    $proizvodjac_ks_od = $_POST['proizvodjac_ks_od'];

    //Na osnovu dobijenih parametara se vrši upit
    $sql = "SELECT ID,tip FROM sociva WHERE ID_proizvodjaca='$proizvodjac_ks_od' AND period='$period_ks_od' GROUP BY tip";
    //Izvršavanje upita
    $result = MySQLi_query($conn, $sql);

    //Rezultati upita će biti prikazane kao opcije u select box-u.
    //Definišemo praznu opciju kao podrazumijevanu
    echo "<option default></option>";
    //Ispis pronađenih vrijednosti upita
    while ($row = mysqli_fetch_object($result)) {
        echo "<option value='$row->ID'>$row->tip</option>";
    }
}

//Provjera da li je POST metodom poslata vrijednost promjeljive tip sočiva OD
if (isset($_POST['tip_ks_od'])) {
    //Dodjeljivanje poslatih vrijednosti promjenljivoj
    $tip_ks_od = $_POST['tip_ks_od'];

    //Na osnovu dobijenog parametra se vrši upit za čitanje baznih krivina (bc) i veličine sočiva (td)
    $sql = "SELECT bc,td FROM sociva WHERE ID='$tip_ks_od'";
    //Izvršavanje upita
    $result = MySQLi_query($conn, $sql);


    $bcValue = "";
    $tdValue = "";
    //Dodjeljivanje rezultata upita definisanim promjenljivim
    while ($row = mysqli_fetch_object($result)) {
        $bcOldValue = $row->bc;
        $tdValue = $row->td;
        //Za svako sočivo može biti definisano više baznih krivina. One su numeričke vrijednosti (sa decimalnim zarezom).
        //Vrijednosti su zapisane u jedno polje, a seperator je "|"
        $bcNewValue = explode("|", $bcOldValue);

        //Dobijena vrijednost bazne krivine se dijeli na osnovu separatora u više opcija
        foreach ($bcNewValue as $bc) {
            $bcValue .= "<option>$bc</option>";
        }
    }
    //Bazne krivine , separator "@@@" i veličina sočiva su vrijednosti koje se vraćaju obrascu za pregled sočiva
    //Format ovog zapisa bi izgledao npr. '<option>8.4</option><option>8.8</option>@@@14.3'
    echo $bcValue . "@@@" . $tdValue;
}


//Provjera da li je POST metodom poslata vrijednost promjeljie period sočiva OS
if (isset($_POST['period_ks_os'])) {
    $period_ks_os = $_POST['period_ks_os'];
    $proizvodjac_ks_os = $_POST['proizvodjac_ks_os'];

    $sql = "SELECT ID,tip FROM sociva WHERE ID_proizvodjaca='$proizvodjac_ks_os' AND period='$period_ks_os' GROUP BY tip";

    $result = MySQLi_query($conn, $sql);

    echo "<option default></option>";
    while ($row = mysqli_fetch_object($result)) {
        echo "<option value='$row->ID'>$row->tip</option>";
    }
}

//Provjera da li je POST metodom poslata vrijednost promjeljive tip sočiva OS
if (isset($_POST['tip_ks_os'])) {
    $tip_ks_os = $_POST['tip_ks_os'];

    $Query = "SELECT bc,td FROM sociva WHERE ID='$tip_ks_os'";

    $result = MySQLi_query($conn, $Query);

    $bcValue = "";
    $tdValue = "";
    while ($row = mysqli_fetch_object($result)) {
        $bcOldValue = $row->bc;
        $tdValue = $row->td;
        $bcNewValue = explode("|", $bcOldValue);

        foreach ($bcNewValue as $bc) {
            $bcValue .= "<option>$bc</option>";
        }
    }
    echo $bcValue . "@@@" . $tdValue;
}

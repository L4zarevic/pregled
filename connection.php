<?php
//Skripta za ostvarivanje konekcije sa bazom podataka

/**Metod kojim se osvaruje konekcija za bazom u kojoj se nalaze podaci o korisnicima aplikacije.
 * Svaki korisnik ima zapis naziva svoje baze podataka koju koristi za evidentiranje pregleda.
 * Na ovaj način je riješeno višekorisničko okruženje da svaki korisnik može imate svoju posebnu bazu.
 * Ova mogućnost je osmišljena da više različitih optika(firmi) koristi ovu aplikaciju, ali da podaci budu odvojeni jedni od drugih.
 * Ukoliko više korisnika koristi isti naziv baze onda to predstavlja da ta firma ima više poslovnih jedinica i ovime se rješava višekorisničko okruženje u okviru jedne firme.
 **/
function OpenCon() { $dbhost = 'localhost'; $dbuser = 'mojaopt_moptic'; $dbpass = 'mP9!1&plTK$sE%aB8DdM'; $db = 'mojaopt_optike'; $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db); if (!$conn) { die(header("Location:../pregled/login.php?msg=2")); exit; } return $conn; } function CloseCon($conn) { $conn->close(); }

//Metod kojim se osvaruje konekcija sa bazom korisnika
function OpenStoreCon($dataBaseName) { $dbhost = 'localhost'; $dbuser = 'mojaopt_moptic'; $dbpass = 'mP9!1&plTK$sE%aB8DdM'; $db = $dataBaseName; $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db); if (!$conn) { die(header("Location:../pregled/login.php?msg=2")); exit; } return $conn; }
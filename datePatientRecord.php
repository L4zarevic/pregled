<!DOCTYPE html>
<html>

<body>

    <?php

    //Skripta za dobijenje datuma kada je izabrati pacijent radio preglede i u kojoj optici(korisnik)

    session_start();
    if (is_null($_SESSION['prijavljen'])) {
        header('Location: ../pregled/login.php');
    }

    require_once 'connection.php';
    $korisnik = $_SESSION['prijavljen'];
    $ar = explode("#", $korisnik, 3);
    $ar[1] = rtrim($ar[1], "#");
    $dataBaseName = $ar[2];
    $conn = OpenStoreCon($dataBaseName);
    mysqli_set_charset($conn, "utf8");

    $id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);

    //Na osnovu ID pacijenta prikazujemo datume pregleda i optike(korisnike) gdje je obavljen pregled
    $sql = "SELECT ID,datum_pregleda,ID_korisnika FROM pregledi WHERE ID_pacijenta = '" . $id_pacijenta . "' ORDER BY ID DESC";

    //Ivršavanje upita
    $result = mysqli_query($conn, $sql);

    //Vrijednosti upita će biti ispisani kao redovi u tabeli
    echo "<table id='dtDynamicVerticalScrollExample' class='table table-hover  table-sm'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>#</th>";
    echo "<th scope='col'>Datum pregleda:</th>";
    echo "<th scope='col'>Radnja:</th>";
    echo "</tr>";
    echo "</thead>";
    $rb = 0;
    //Ispis rezultata upita
    while ($row = mysqli_fetch_object($result)) {
        $originalDate = $row->datum_pregleda;
        $datum_pregleda = date("d.m.Y", strtotime($originalDate));
        echo "<tr>";
        echo "<td>" . ($rb = $rb + 1) . "</td>";
        //Datumi su linkovi koji sadrže ID pregleda. Nakon klika se otvara stranica za prikaz i uređivanje izvještaja sa dobijenim ID pregleda
        echo "<td><a target='_blank' href='examinationReportEdit.php?id=$row->ID'>$datum_pregleda</a></td>";
        //Upit koji na osnovu dobijenog ID korisnika čita naziv korisnika kojem pripada taj ID
        $sql1 = "SELECT mojaopt_optike.korisnici.naziv FROM mojaopt_optike.korisnici WHERE mojaopt_optike.korisnici.ID =$row->ID_korisnika";
        $result1 = mysqli_query($conn, $sql1);
        while ($row1 = mysqli_fetch_object($result1)) {
            echo "<td>$row1->naziv</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    CloseCon($conn);
    ?>
</body>

</html>
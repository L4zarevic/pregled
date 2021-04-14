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
    $ar = explode('#', $korisnik, 4);
    $ar[1] = rtrim($ar[1], '#');
    $dataBaseName = $ar[3];
    $conn = OpenStoreCon($dataBaseName);
    mysqli_set_charset($conn, 'utf8');

    $id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);

    //Na osnovu ID pacijenta prikazujemo datume pregleda i optike(korisnike) gdje je obavljen pregled
    $stmt1 = $conn->prepare('SELECT ID,datum_pregleda,ID_korisnika FROM pregledi WHERE ID_pacijenta =? ORDER BY ID DESC');
    $stmt1->bind_param('i', $id_pacijenta);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    //Vrijednosti upita će biti ispisani kao redovi u tabeli
    echo "<table id='dtDynamicVerticalScrollExample' class='table table-hover table-sm'>";
    echo "<h6>Pregledi</h6>";
    echo '<thead>';
    echo '<tr>';
    echo "<th scope='col'>#</th>";
    echo "<th scope='col'>Datum pregleda:</th>";
    echo "<th scope='col'>Radnja:</th>";
    echo '</tr>';
    echo '</thead>';
    $rb = 0;
    //Ispis rezultata upita
    while ($row1 = $result1->fetch_object()) {
        $originalDate = $row1->datum_pregleda;
        $datum_pregleda = date('d.m.Y', strtotime($originalDate));
        echo '<tr>';
        echo '<td>' . ($rb = $rb + 1) . '</td>';
        //Datumi su linkovi koji sadrže ID pregleda. Nakon klika se otvara stranica za prikaz i uređivanje izvještaja sa dobijenim ID pregleda
        echo "<td><a target='_blank' href='examinationReportEdit.php?id=$row1->ID'>$datum_pregleda</a></td>";
        //Upit koji na osnovu dobijenog ID korisnika čita naziv korisnika kojem pripada taj ID
        $stmt2 = $conn->prepare('SELECT mojaopt_optike.korisnici.pj FROM mojaopt_optike.korisnici WHERE mojaopt_optike.korisnici.ID =?');
        $stmt2->bind_param('i', $row1->ID_korisnika);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        while ($row2 = $result2->fetch_object()) {
            echo "<td>$row2->pj</td>";
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '</br></br>';

     //Na osnovu ID pacijenta prikazujemo datume pregleda i optike(korisnike) gdje je obavljen pregled
     $stmt2 = $conn->prepare('SELECT ID,datum,broj_radnog_naloga,ID_korisnika FROM radni_nalog WHERE ID_pacijenta =? ORDER BY ID DESC');
     $stmt2->bind_param('i', $id_pacijenta);
     $stmt2->execute();
     $result2= $stmt2->get_result();
 
     //Vrijednosti upita će biti ispisani kao redovi u tabeli
     echo "<table id='dtDynamicVerticalScrollExample1' class='table table-hover table-sm'>";
     echo "<h6>Radni nalozi</h6>";
     echo '<thead>';
     echo '<tr>';
     echo "<th scope='col'>#</th>";
     echo "<th scope='col'>Datum:</th>";
     echo "<th scope='col'>Br. radnog naloga:</th>";
     echo "<th scope='col'>Radnja:</th>";
     echo '</tr>';
     echo '</thead>';
     $rb = 0;
     //Ispis rezultata upita
     while ($row2 = $result2->fetch_object()) {
         $originalDate = $row2->datum;
         $datum_naloga = date('d.m.Y', strtotime($originalDate));
         echo '<tr>';
         echo '<td>' . ($rb = $rb + 1) . '</td>';
         //Datumi su linkovi koji sadrže ID pregleda. Nakon klika se otvara stranica za prikaz i uređivanje izvještaja sa dobijenim ID pregleda
         echo "<td><a target='_blank' href='examinationReportEdit.php?id=$row2->ID'>$datum_naloga</a></td>";
         echo "<td>$row2->broj_radnog_naloga</td>";
         //Upit koji na osnovu dobijenog ID korisnika čita naziv korisnika kojem pripada taj ID
         $stmt2 = $conn->prepare('SELECT mojaopt_optike.korisnici.pj FROM mojaopt_optike.korisnici WHERE mojaopt_optike.korisnici.ID =?');
         $stmt2->bind_param('i', $row2->ID_korisnika);
         $stmt2->execute();
         $result2 = $stmt2->get_result();
         while ($row2 = $result2->fetch_object()) {
             echo "<td>$row2->pj</td>";
         }
         echo '</tr>';
     }
     echo '</table>';

    CloseCon($conn);
    ?>
</body>

</html>
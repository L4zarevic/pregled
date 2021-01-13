<?php

/** Skripta za email notifikaciju.
 * Provjeravaju se datumi iz kolone notifikacija u tabeli 'pregledi'.
 * Ukoliko je datum u opsegu zadnjih 7 dana, onda se šalje email korisnicima(optikama).
 * U email se nalaze osnovni podaci o pacijentu i sočivima koje su mu propisana na pregledu i na taj način optike mogu kontaktirati pacijenta da treba uzeti nova.
 * 
 * 
 * 
 * Cron job izvšava skriptu svaki dan u 03:00 AM
 */

include 'connection.php';

//Kreiranje niza od naziva baza koji su definisani u koloni db u tabeli 'korisnici'
$con = OpenCon();
$sql = 'SELECT DISTINCT db FROM korisnici';
$result = MySQLi_query($con, $sql);
$database_array = array();
while ($row = mysqli_fetch_object($result)) {
    $database_array[] = $row->db;
}

//Foreach petlja prolazi kroz svaki element niza(naziv baze podataka) kojeg prosljeđuje kao parametar metodi za osvarivanje konekcije
foreach ($database_array as $db) {
    $conn = OpenStoreCon($db);
    mysqli_set_charset($conn, 'utf8');

    //Upit koji selektuje datume notifikacija u opsegu zadnjih 7 dana
    $todayDate = date('Y-m-d');
    $startDate = date('Y-m-d', strtotime('-7 days'));
    $stmt = $conn->prepare('SELECT * FROM pregledi WHERE notifikacija BETWEEN ? AND ?');
    $stmt->bind_param('ss', $startDate, $todayDate);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_object()) {
        $ID = $row->ID;
        $ID_korisnika = $row->ID_korisnika;
        $ID_pacijenta = $row->ID_pacijenta;
        $datum_pregleda = $row->datum_pregleda;

        $proizvodjac_ks_od = $row->proizvodjac_ks_od;
        $period_ks_od = $row->period_ks_od;
        $tip_ks_od = $row->tip_ks_od;
        $jacina_ks_od = $row->jacina_ks_od;
        $velicina_ks_od = $row->velicina_ks_od;
        $bc_ks_od = $row->bc_ks_od;
        $boja_ks_od = $row->boja_ks_od;

        $proizvodjac_ks_os = $row->proizvodjac_ks_os;
        $period_ks_os = $row->period_ks_os;
        $tip_ks_os = $row->tip_ks_os;
        $jacina_ks_os = $row->jacina_ks_os;
        $velicina_ks_os = $row->velicina_ks_os;
        $bc_ks_os = $row->bc_ks_os;
        $boja_ks_os = $row->boja_ks_os;

        //Upit koji na osnovu ID_pacijenta prikazuje ime tog pacijenta
        $generalije_pacijenta = '';
        $stmt1 = $conn->prepare('SELECT generalije_pacijenta FROM pacijenti WHERE ID =?');
        $stmt1->bind_param('i', $ID_pacijenta);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        while ($row1 = $result1->fetch_object()) {
            $generalije_pacijenta = $row1->generalije_pacijenta;
        }

        //Upit koji na osnovu ID_korisnika prikazuje njegov email
        $email = '';
        $con2 = OpenCon();
        $stmt2 = $con2->prepare('SELECT email FROM korisnici WHERE ID =?');
        $stmt2->bind_param('i', $ID_korisnika);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        while ($row2 = mysqli_fetch_object($result2)) {
            $email = $row2->email;
        }

        //Konvertovanje datuma iz formata Y-m-d u d.m.Y
        $datum = date('d.m.Y', strtotime($datum_pregleda));

        //Definisanje email-a
        $header = 'From: no-reply@mojaoptika.com' . "\r\n";
        $to     = $email;
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: text/html; charset=utf-8\r\n";
        $title  = 'Notifikacija';

        $message = '<html><body>';
        $message .= '<label>Napomena za propisana kontaktna sočiva</label>';
        $message .= '<br/>';
        $message .= '<br/>Pacijent: ' . $generalije_pacijenta . '<br/>';
        $message .= 'Datum pregleda: ' . $datum . '<br/>';
        $message .= '<br/>';

        //Uslov u kome se provjerava da li postoji vrijednost proizvođača OD
        //Ukoliko postoji ispisuje se vrijednosti u email
        if (strlen($proizvodjac_ks_od) > 0) {
            $message .= '<label>OD:</label><br/>';
            $message .= '<label>Proizvođač:' . $proizvodjac_ks_od . '</label><br/>';
            $message .= '<label>Period:' . $period_ks_od . '</label><br/>';
            $message .= '<label>Tip/vrsta:' . $tip_ks_od . '</label><br/>';
            $message .= '<label>Jačina: ' . $jacina_ks_od . '</label><br/>';
            $message .= '<label>BC: ' . $bc_ks_od . '</label><br/>';
            $message .= '<label>TD: ' . $velicina_ks_od . '</label><br/>';

            //Uslov u kome se provjerava da li postoji vrijednost boje OD
            if (strlen($boja_ks_od) > 0) {
                $message .= '<label>Boja: ' . $boja_ks_od . '</label><br/><br/>';
            }
        }

        //Uslov u kome se provjerava da li postoji vrijednost proizvođača OS
        //Ukoliko postoji ispisuje se vrijednosti u email
        if (strlen($proizvodjac_ks_os) > 0) {
            $message .= '<label>OS:</label><br/>';
            $message .= '<label>Proizvođač:' . $proizvodjac_ks_os . '</label><br/>';
            $message .= '<label>Period:' . $period_ks_os . '</label><br/>';
            $message .= '<label>Tip/vrsta:' . $tip_ks_os . '</label><br/>';
            $message .= '<label>Jačina: ' . $jacina_ks_os . '</label><br/>';
            $message .= '<label>BC: ' . $bc_ks_os . '</label><br/>';
            $message .= '<label>TD: ' . $velicina_ks_os . '</label><br/>';

            //Uslov u kome se provjerava da li postoji vrijednost boje OS
            if (strlen($boja_ks_os) > 0) {
                $message .= '<label>Boja: ' . $boja_ks_os . '</label><br/>';
            }
        }
        $message .= '<br/>';
        $message .= '<br/>';
        $message .= '<br/>';
        $message .= '<label>--------------------------------------------------</label><br/>';
        $message .= '<label>Ovo je automatski generisana poruka, ne odgovarati na nju. <a href="https://mojaoptika.com/pregled">mojaoptika.com/pregled </a></label>';

        $message .= '</body></html>';

        //Slanje email-a
        if (mail($to, $title, $message, $header)) {

            //Nakon poslatog email-a, vrijednost notifikacije se setuje na nulti datum da se više ne bi ponovila
            $stmt3 = $conn->prepare("UPDATE pregledi SET notifikacija = '0000-00-00' WHERE ID =?");
            $stmt3->bind_param('i', $ID);
            $stmt3->execute();
        }
    }
}

<!DOCTYPE html>
<html lang="en">

<?php

include '../pregled/modules/header.php';
require_once 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode('#', $korisnik, 4);
$ar[1] = rtrim($ar[1], '#');
$imeKorisnika = $ar[2];
$dataBaseName = $ar[3];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, 'utf8');

//Prosljeđen ID radnog naloga iz patientRecord.php
$id_naloga = mysqli_real_escape_string($conn, $_REQUEST['id']);

//Čitanje podataka o pregledu na osnovu ID-a
$stmt = $conn->prepare("SELECT * FROM radni_nalog WHERE ID=?");
$stmt->bind_param('i', $id_naloga);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_object()) {
    $ID_pacijenta = $row->ID_pacijenta;
    $ID_korisnika = $row->ID_korisnika;
    $broj_radnog_naloga = $row->broj_radnog_naloga;
    $originalDate = $row->datum;
    $desno_d_sph = $row->desno_d_sph;
    $desno_d_cyl = $row->desno_d_cyl;
    $desno_d_ax = $row->desno_d_ax;
    $desno_b_sph = $row->desno_b_sph;
    $desno_b_cyl = $row->desno_b_cyl;
    $desno_b_ax = $row->desno_b_ax;
    $lijevo_d_sph = $row->lijevo_d_sph;
    $lijevo_d_cyl = $row->lijevo_d_cyl;
    $lijevo_d_ax = $row->lijevo_d_ax;
    $lijevo_b_sph = $row->lijevo_b_sph;
    $lijevo_b_cyl = $row->lijevo_b_cyl;
    $lijevo_b_ax = $row->lijevo_b_ax;
    $pd_blizina = $row->pd_blizina;
    $pd_daljina = $row->pd_daljina;
    $napomena  = $row->napomena;
    $ukupno = $row->ukupno;
    $akontacija = $row->akontacija;
    $dug = $row->dug;
}

//Konvertovanje datuma iz Y-m-d u d.m.Y format
$datum = date('d.m.Y', strtotime($originalDate));


//Pretraga imena pacijenta na osnovu njegovog ID-a u tabeli pregled
$stmt = $conn->prepare("SELECT generalije_pacijenta,kontakt FROM pacijenti WHERE ID=?");
$stmt->bind_param('i', $ID_pacijenta);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) die(mysqli_error($conn));
$generalije_pacijenta = "";
$kontakt = "";
while ($row = $result->fetch_object()) {
    $generalije_pacijenta = $row->generalije_pacijenta;
    $kontakt = $row->kontakt;
}

//Čitanje podataka o optici(korisniku) u kojoj je urađen pregled na osnovu ID korisnika u tabeli pregled
$con = OpenCon();
$stmt = $conn->prepare("SELECT pj,adresa,telefon,website FROM mojaopt_optike.korisnici WHERE ID=?");
$stmt->bind_param('i', $ID_korisnika);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) die(mysqli_error($conn));
while ($row = $result->fetch_object()) {
    $naziv = $row->pj;
    $adresa = $row->adresa;
    $telefon = $row->telefon;
    $website = $row->website;
}

CloseCon($conn);

?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include '../pregled/modules/menu.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                include '../pregled/modules/logout.php';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Radni nalog <i class="fas fa-clipboard-list"></i></i></h1>

                    <div class="row"><strong><label>Broj radnog naloga: </strong></label>&nbsp;<label><?php echo "№" . " " . $broj_radnog_naloga; ?> </label></div>
                    <div class="row"><strong><label>Radnja: </strong></label>&nbsp;<label><?php echo $naziv; ?> </label></div>
                    <div class="row"><strong><label>Datum:</label></strong>&nbsp;<label><?php echo $datum; ?> </label></div>
                    <div class="row"><strong><label>Ime, prezime i godina rođenja:</label></strong>&nbsp;<label><?php echo $generalije_pacijenta; ?> </label></div>
                    <div class="row"><strong><label>Kontakt:</label></strong>&nbsp;<label><?php echo $kontakt; ?> </label></div>
                    <hr>
                    <div class="row">
                        <div class="korekcijaBlizina">
                            <strong> <label>OKO DESNO</label></strong>
                            <div class="form-group col-md-9">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">sph</th>
                                            <th scope="col">cyl</th>
                                            <th scope="col">ax</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">D</th>
                                            <td><label><?php echo $desno_d_sph; ?></label></td>
                                            <td><label><?php echo $desno_d_cyl; ?></label></td>
                                            <td><label><?php echo $desno_d_ax; ?></label></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">B</th>
                                            <td><label><?php echo $desno_b_sph; ?></label></td>
                                            <td><label><?php echo $desno_b_cyl; ?></label></td>
                                            <td><label><?php echo $desno_b_ax; ?></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <strong> <label>PD blizina u mm: </label></strong>
                                        <label><?php echo $pd_blizina; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="korekcijaDaljina">
                            <strong> <label>OKO LIJEVO</label></strong>
                            <div class="form-group col-md-9">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">sph</th>
                                            <th scope="col">cyl</th>
                                            <th scope="col">ax</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">D</th>
                                            <td><label><?php echo $lijevo_d_sph; ?></label></td>
                                            <td><label><?php echo $lijevo_d_cyl; ?></label></td>
                                            <td><label><?php echo $lijevo_d_ax; ?></label></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">B</th>
                                            <td><label><?php echo $lijevo_b_sph; ?></label></td>
                                            <td><label><?php echo $lijevo_b_cyl; ?></label></td>
                                            <td><label><?php echo $lijevo_b_ax; ?></label></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="form-group col-md-5">
                                        <strong><label>PD daljina u mm:</label></strong>
                                        <label><?php echo $pd_daljina; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-10">
                            <strong><label>Napomena:</label></strong>
                            <p><?php echo str_replace('\n', "\n", $napomena); ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="placanje">
                            <div class="placanje_napomena">
                                <div class="form-group col-md-12">
                                    <input name="ukupno" class="form-control" type="text" value='<?php echo $ukupno; ?>' id="ukupno" style="text-align: right;" disabled />
                                </div>
                                <div class="form-group col-md-12">
                                    <input name="ukupno" class="form-control" type="text" value='<?php echo $akontacija; ?>' id="ukupno" style="text-align: right;" disabled />
                                </div>
                                <div class="form-group col-md-12">
                                    <input name="ukupno" class="form-control" type="text" value='<?php echo $dug; ?>' id="ukupno" style="text-align: right;" disabled />
                                </div>
                            </div>
                            <div class="placanje_label">
                                <div class="form-group col-md-7">
                                    <strong><label style="margin-top:1%;">Ukupno</label></strong>
                                </div>
                                <div class="form-group col-md-7">
                                    <strong><label style="margin-top:1%;">Akontacija</label></strong>
                                </div>
                                <div class="form-group col-md-7">
                                    <strong><label style="margin-top:1%;">Dug</label></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <?php
                include '../pregled/modules/footer.php';
                ?>
                <!-- End of Footer -->

                <!-- /.container-fluid -->
            </div>
        </div>
</body>

</html>
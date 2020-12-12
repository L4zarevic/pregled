c
<!DOCTYPE html>
<html lang="en">

<?php

include '../pregled/modules/header.php';
require_once 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$imeKorisnika = $ar[1];
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");

//Prosljeđen ID pregleda iz patientRecord.php
$id_pregleda = mysqli_real_escape_string($conn, $_REQUEST['id']);

//Čitanje podataka o pregledu na osnovu ID-a
$sql1 = "SELECT * FROM pregledi WHERE ID=$id_pregleda";
$result = mysqli_query($conn, $sql1);
if (!$result) die(mysqli_error($conn));
while ($row = mysqli_fetch_object($result)) {
  $ID_pacijenta = $row->ID_pacijenta;
  $ID_korisnika = $row->ID_korisnika;
  $ID_radnika = $row->ID_radnika;
  $originalDate = $row->datum_pregleda;
  $anamneza = $row->anamneza;
  $vod = $row->vod;
  $vos = $row->vos;
  $motilitet = $row->motilitet;
  $bms_od = $row->bms_od;
  $bms_os = $row->bms_os;
  $tonus_od = $row->tonus_od;
  $tonus_os = $row->tonus_os;
  $fundus_od = $row->fundus_od;
  $fundus_os = $row->fundus_os;
  $dijagnoza = $row->dijagnoza;
  $terapija = $row->terapija;
  $korekcija_daljina_od = $row->korekcija_daljina_od;
  $korekcija_daljina_os = $row->korekcija_daljina_os;
  $korekcija_blizina_od = $row->korekcija_blizina_od;
  $korekcija_blizina_os = $row->korekcija_blizina_os;
  $proizvodjac_ks_od = $row->proizvodjac_ks_od;
  $period_ks_od = $row->period_ks_od;
  $tip_ks_od = $row->tip_ks_od;
  $jacina_ks_od = $row->jacina_ks_od;
  $bc_ks_od  = $row->bc_ks_od;
  $velicina_ks_od  = $row->velicina_ks_od;
  $boja_ks_od = $row->boja_ks_od;
  $proizvodjac_ks_os = $row->proizvodjac_ks_os;
  $period_ks_os = $row->period_ks_os;
  $tip_ks_os = $row->tip_ks_os;
  $jacina_ks_os = $row->jacina_ks_os;
  $bc_ks_os = $row->bc_ks_os;
  $velicina_ks_os  = $row->velicina_ks_os;
  $boja_ks_os = $row->boja_ks_os;
  $pd = $row->pd;
  $kontrola = $row->kontrola;
  $napomena_pregleda  = $row->napomena_pregleda;
}

//Konvertovanje datuma iz Y-m-d u d.m.Y format
$datum_pregleda = date("d.m.Y", strtotime($originalDate));


//Pretraga imena pacijenta na osnovu njegovog ID-a u tabeli pregled
$sql2 = "SELECT generalije_pacijenta FROM pacijenti WHERE ID=$ID_pacijenta";
$result = mysqli_query($conn, $sql2);
if (!$result) die(mysqli_error($conn));
while ($row = mysqli_fetch_object($result)) {
  $generalije_pacijenta = $row->generalije_pacijenta;
}

//Čitanje podataka o radniku koji je radio pregled na osnovu ID radnika u tabeli pregled
$sql3 = "SELECT imePrezimeRadnika,sifra_radnika FROM radnici WHERE ID=$ID_radnika";
$result = mysqli_query($conn, $sql3);
if (!$result) die(mysqli_error($conn));
while ($row = mysqli_fetch_object($result)) {
  $imePrezimeRadnika = $row->imePrezimeRadnika;
  $sifra_radnika = $row->sifra_radnika;
}

//Čitanje podataka o optici(korisniku) u kojoj je urađen pregled na osnovu ID korisnika u tabeli pregled
$con = OpenCon();
$sql4 = "SELECT naziv,adresa,telefon,website FROM mojaopt_optike.korisnici WHERE ID=$ID_korisnika";
$result = mysqli_query($con, $sql4);
if (!$result) die(mysqli_error($con));
while ($row = mysqli_fetch_object($result)) {
  $naziv = $row->naziv;
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

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ulogovani ste kao
                  <b>
                    <?php $korisnik = $_SESSION['prijavljen'];
                    $ar = explode("#", $korisnik, 3);
                    $ar[1] = rtrim($ar[1], "#");
                    echo $imeKorisnika = $ar[1];
                    ?>
                  </b> <i class="fas fa-user"></i></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Odjava
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Izvještaj pregleda</h1>

          <div class='tabelaSpecijala1'>

            <div class='row'> <strong><label>Ime, prezime i godina rođenja: </label></strong> &nbsp;<?php echo $generalije_pacijenta; ?></div>
            <div class='row'> <strong><label>Pregled urađen u: </label></strong> &nbsp;<?php echo $naziv; ?></div>
            <div class='row'> <strong><label>Datum: </label></strong> &nbsp;<?php echo $datum_pregleda; ?></div>
            <div class='row'> <strong><label>Radnik: </label></strong> &nbsp;<?php echo $imePrezimeRadnika; ?></div>


            <hr>
            <div class='row'>
              <div class='anamnezaReport'>
                <div class='form-group col-md-9'><strong><label id='labelAnamnezaReport'>ANAMNEZA: </label></strong> &nbsp;
                  <input name='inputAnamenzaReport' title='' type='text' class='form-control' id='inputAnamenzaReport' autocomplete="off" value='<?php echo $anamneza; ?>'></div>
              </div>
            </div>
            <br>
            <div class='row'> <strong><label>VIDNA OŠTRINA: </label></strong></div>
            <div class='row'>
              <div class='vidnaOstrinaReport'>
                <div class='vodReport'>
                  <div class='form-group col-md-6'> <label>VOD:</label id='labelVodReport'> &nbsp;<input name='inputVodReport' autocomplete="off" type='text' class='form-control' id='inputVodReport' value='<?php echo $vod; ?>'></div>
                  <div class='vosReport'>
                    <div class='form-group col-md-6'><label id='labelVosReport'>VOS:</label> &nbsp; <input name='inputVosReport' autocomplete="off" type='text' class='form-control' id='inputVosReport' value='<?php echo $vos; ?>'></div>
                  </div>
                </div>
              </div>
            </div>

            <hr>
            <div class='row'>
              <div class='motilitetTonusReport'>
                <div class='motilitetReport'>
                  <div class='form-group col-md-12'> <strong><label id='labelMotilitetReport'>MOTILITET: </label></strong> &nbsp; <input name='inputMotilitetReport' autocomplete="off" type='text' class='form-control' id='inputMotilitetReport' value='<?php echo $motilitet; ?>'></div>
                </div>

                <div class='tonusReport'>
                  <div class='form-group col-md-10'><strong><label id='labelTonusReport'>TONUS: </label></strong>
                    <label id='labelTonusOdReport'>OD: </label></strong> &nbsp; <input name='inputTonusOdReport' autocomplete="off" type='text' class='form-control' id='inputTonusOdReport' value='<?php echo $tonus_od; ?>'>
                    &nbsp;<label id='labelTonusOsReport'>OS: </label></strong> &nbsp; <input name='inputTonusOsReport' autocomplete="off" type='text' class='form-control' id='inputTonusOsReport' value='<?php echo $tonus_os; ?>'></div>
                </div>

              </div>

            </div>
            <br>
            <div id='grupa1'>
              <div class='row'><strong><label>BMS: </label></strong></div>
              <div class='row'>
                <div class='form-group col-md-8'><label>OD: </label></strong> &nbsp; <input name='inputBmsOdReport' autocomplete="off" type='text' class='form-control' id='inputBmsOdReport' value='<?php echo $bms_od; ?>'></div>
              </div>
              <div class=' row'>
                <div class='form-group col-md-8'><label>OS: </label></strong> &nbsp; <input name='inputBmsOsReport' autocomplete="off" type='text' class='form-control' id='inputBmsOsReport' value='<?php echo $bms_os; ?>'></div>
              </div>
            </div>

            <div id='grupa2'>
              <div class='row'> <strong><label>FUNDUS: </label></strong></div>
              <div class='row'>
                <div class='form-group col-md-8'><label>OD: </label></strong> &nbsp; <input name='inputFundusOdReport' autocomplete="off" type='text' class='form-control' id='inputFundusOdReport' value='<?php echo $fundus_od; ?>'></div>
              </div>
              <div class='row'>
                <div class='form-group col-md-8'><label>OS: </label></strong> &nbsp; <input name='inputFundusOsReport' autocomplete="off" type='text' class='form-control' id='inputFundusOsReport' value='<?php echo $fundus_os; ?>'></div>
              </div>

            </div>

            <hr>
            <div class='row'>
              <div class='form-group col-md-5'><strong><label>DIJAGNOZA: &nbsp;</label></strong><input name='inputDiagnoseReport' autocomplete="off" type='text' class='form-control' id='inputDiagnoseReport' value='<?php echo $dijagnoza; ?>'></div>
            </div>
            <div class='row'>
              <div class='form-group col-md-5'> <strong><label>TERAPIJA:&nbsp;</label></strong><input name='inputTherapyReport' autocomplete="off" type='text' class='form-control' id='inputTherapyReport' value='<?php echo $terapija; ?>'></div>
            </div>

            <hr>
            <div class='korekcijaDaljina'>
              <div class='row'> <strong><label>DALJINA - korekcija: </label></strong></div>
              <div class='row'>
                <div class='form-group col-md-8'><label>OD: </label></strong> &nbsp; <input name='inputDistanceCorrectionOdReport' autocomplete="off" type='text' class='form-control' id='inputDistanceCorrectionOdReport' value='<?php echo $korekcija_daljina_od; ?>'></div>
              </div>
              <div class='row'>
                <div class='form-group col-md-8'><label>OS: </label></strong> &nbsp; <input name='inputDistanceCorrectionOsReport' autocomplete="off" type='text' class='form-control' id='inputDistanceCorrectionOsReport' value='<?php echo $korekcija_daljina_os; ?>'></div>
              </div>

            </div>
            <div class='korekcijaBlizina'>
              <div class='row'> <strong><label>BLIZINA - korekcija: </label></strong></div>
              <div class='row'>
                <div class='form-group col-md-8'><label>OD: </label></strong> &nbsp; <input name='inputProximityCorrectionOdReport' autocomplete="off" type='text' class='form-control' id='inputProximityCorrectionOdReport' value='<?php echo $korekcija_blizina_od; ?>'></div>
              </div>
              <div class='row'>
                <div class='form-group col-md-8'><label>OS: </label></strong> &nbsp; <input name='inputProximityCorrectionOsReport' autocomplete="off" type='text' class='form-control' id='inputProximityCorrectionOsReport' value='<?php echo $korekcija_blizina_os; ?>'></div>
              </div>
            </div>
            <br>
            <br>
            <div class='row'>
              <div class='form-group col-md-2'><strong><label>PD: &nbsp;</label></strong><input name='inputPdReport' autocomplete="off" type='text' class='form-control' id='inputPdReport' value='<?php echo $pd; ?>'></div>
            </div></br>



            <hr>
            <div class="row">
              <strong>
                <labe>KOREKCIJA (kon. sočiva):</label>
              </strong>
            </div>

            <div class="lensesCorrectionOd">
              <label>OD:</label>
              <div class="row">
                <div class="form-group col-md-12">

                  <div class="proizvodjac">
                    <label id='labelManufactured'>Proizvođač:</label>
                    <input name="proizvodjac_ks_od" title="" class="form-control" id="proizvodjac_ks_od" autocomplete="off" value="<?php echo $proizvodjac_ks_od; ?>">
                  </div>

                  <div class="period">
                    <label id='labelType'>Period:</label>
                    <input name="period_ks_od" title="" type="text" class="form-control" autocomplete="off" id="period_ks_od" value="<?php echo $period_ks_od; ?>">
                  </div>

                  <div class="tip">
                    <label id='labelType'>Tip/vrsta:</label>
                    <input name="tip_ks_od" title="" class="form-control" id="tip_ks_od" autocomplete="off" value="<?php echo $tip_ks_od; ?>">
                  </div>

                  <div class="jacina">
                    <label id='labelPower'>Jačina:</label>
                    <input name="jacina_ks_od" title="" type="text" class="form-control" autocomplete="off" id="jacina_ks_od" value="<?php echo $jacina_ks_od; ?>">
                  </div>

                  <div class="bc">
                    <label id='labelBc'>BC:</label>
                    <input name="bc_ks_od" title="" type="text" class="form-control" autocomplete="off" id="bc_ks_od" value="<?php echo $bc_ks_od; ?>">
                  </div>

                  <div class="velicina">
                    <label id='labelSize'>TD:</label>
                    <input name="velicina_ks_od" title="" type="text" class="form-control" autocomplete="off" id="velicina_ks_od" value="<?php echo $velicina_ks_od; ?>">
                  </div>

                  <div class="boja">
                    <label id='labelColor'>Boja:</label>
                    <input name="boja_ks_od" title="" type="text" class="form-control" autocomplete="off" id="boja_ks_od" value="<?php echo $boja_ks_od; ?>">
                  </div>
                </div>

              </div>
            </div>

            <div class="lensesCorrectionOs">
              <label>OS:</label>
              <div class="row">
                <div class="form-group col-md-12">

                  <div class="proizvodjac">
                    <label id='labelManufactured'>Proizvođač:</label>
                    <input name="proizvodjac_ks_os" title="" class="form-control" autocomplete="off" id="proizvodjac_ks_os" value="<?php echo $proizvodjac_ks_os; ?>">
                  </div>

                  <div class="period">
                    <label id='labelType'>Period:</label>
                    <input name="period_ks_os" title="" type="text" class="form-control" autocomplete="off" id="period_ks_os" value="<?php echo $period_ks_os; ?>">
                  </div>

                  <div class="tip">
                    <label id='labelType'>Tip/vrsta:</label>
                    <input name="tip_ks_os" title="" type="text" class="form-control" autocomplete="off" id="tip_ks_os" value="<?php echo $tip_ks_os; ?>">
                  </div>

                  <div class="jacina">
                    <label id='labelPower'>Jačina:</label>
                    <input name="jacina_ks_os" title="" type="text" class="form-control" autocomplete="off" id="jacina_ks_os" value="<?php echo $jacina_ks_os; ?>">
                  </div>

                  <div class="bc">
                    <label id='labelBc'>BC:</label>
                    <input name="bc_ks_os" title="" type="text" class="form-control" autocomplete="off" id="bc_ks_os" value="<?php echo $bc_ks_os; ?>">

                  </div>

                  <div class="velicina">
                    <label id='labelSize'>TD:</label>
                    <input name="velicina_ks_os" title="" type="text" class="form-control" autocomplete="off" id="velicina_ks_os" value="<?php echo $velicina_ks_os; ?>">

                  </div>

                  <div class="boja">
                    <label id='labelColor'>Boja:</label>
                    <input name="boja_ks_os" title="" type="text" class="form-control" autocomplete="off" id="boja_ks_os" value="<?php echo $boja_ks_os; ?>">
                  </div>
                </div>
              </div>
            </div>


            <hr>
            <br>
            <div class='row'>
              <div class='form-group col-md-4'> <strong><label>KONTROLA: &nbsp;</label></strong><input name='inputControlReport' type='text' autocomplete="off" class='form-control' id='inputControlReport' value='<?php echo $kontrola; ?>'></div>
            </div>
            <hr>
            <div class='row'>
              <div class='form-group col-md-6'><strong><label>NAPOMENA: &nbsp;</label></strong> <textarea name='inputNoteExaminationReport' type='text' autocomplete="off" class='form-control' id='inputNoteExaminationReport'><?php echo $napomena_pregleda; ?></textarea></div>
            </div>
            <hr>
            <br>

            <div class="row">
              <div class='form-group col-md-4'>
                <button id="updateButton" class="btn btn-success" onclick="worker()"><i class="fas fa-edit"></i>&nbsp;<label class="labelSaveButton">Potvrdi uređivanje izvještaja</label></button>
              </div>
            </div>

            <br>
            <br>
            <div id='stampa1'>
              <h4>Pregled za naočare</h4>
              <button id='kratkiIspisNaocare' title='Kratki izvještaj pregleda za naočare (A5 landscape)' class='btn btn-primary' onClick='openPrintDialogue()'><i class='fa fa-print'></i>&nbsp;<label class='labelPrintButton'>Štampa kratki ispis</label></button>
              <button id='dugiIspisNaocare' title='Dugi izvještaj pregleda za naočare (A4 portrait)' class='btn btn-primary' onClick='openPrintDialogueA4()'><i class='fa fa-print'></i>&nbsp;<label class='labelPrintButton'>Štampa dugi ispis</label></button>
            </div>
            <div id='stampa2'>
              <h4>Pregled za sočiva</h4>
              <button id='kratkiIspisSociva' title='Kratki izvještaj pregleda za sočiva (A5 landscape)' class='btn btn-primary' onClick='openPrintDialogueLensesShortEximination()'><i class='fa fa-print'></i>&nbsp;<label class='labelPrintButton'>Štampa kratki ispis</label></button>
              <button id='dugiIspisSociva' title='Dugi izvještaj pregleda za sočiva (A4 portrait)' class='btn btn-primary' onClick='openPrintDialogueLensesEximination()'><i class='fa fa-print'></i>&nbsp;<label class='labelPrintButton'>Štampa dugi ispis</label></button>
            </div>
          </div>



          <!-- /.container-fluid -->
        </div>

      </div <!-- Footer -->
      <?php
      include '../pregled/modules/footer.php';
      ?>
      <!-- End of Footer -->

      <?php
      if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == '1') {
          echo "<script src=\"js/alertify.min.js\"></script>";
          echo "<script type=\"text/javascript\"> alertify.error('Greška prilikom ažuriranja');</script>";
          echo "<script type=\"text/javascript\">window.history.replaceState(null, null, window.location.pathname);</script>";
        } else if ($_REQUEST['msg'] == '0') {
          echo "<script src=\"js/alertify.min.js\"></script>";
          echo "<script type=\"text/javascript\">alertify.success('Izvještaj je uspiješno ažuriran');</script>";
          echo "<script type=\"text/javascript\">window.history.replaceState(null, null, window.location.pathname);</script>";
        }
      }
      ?>

      <script>
        //Metode za štampanje izvještaja pregleda
        function openPrintDialogue() {

          $('<iframe>', {
              name: 'myiframe',
              class: 'printFrame'
            })
            .appendTo('body')
            .contents().find('body')
            .append(`

            <html>
            <style>
            @media print{@page{ size: A5 landscape !important; margin: 0mm !important; }}
            @-moz-document url-prefix() {
              @page { size: A5 landscape; margin: 0mm;}

              label {
              font-size: 19pt;
            }
            }
            
            .logo{
              margin:3%;
              display:inline;
              width:55%;
              float:left;
            }
            .kontaktPodaciRadnje{
              display:inline;
              margin-top:5%;
              margin-right:5%;
              width:25%;
              float:right;
            }
            #logo{
              display:inline;
              width:51%;
              heigt:51%;
            }
            hr#linija{
              display:block;
              width:94%;
              margin-left:3%;
              margin-right:3%;
              border: 1px solid #fff;
            }
            
            .generalijeDatum{
              display:block;
              width:94%;
              margin-left:3%;
              margin-right:3%;
            }
            .generalije{
              display:inline-block;
              width:78%;
              margin-top:5%;
              margin-left:3%;
              float:left;
            }
            .datum{
              
              width:5%;
              display:inline-block;
              margin-top:6.5%;
              margin-right:14%;
            }
            .ispisAnamneze{
              display:block;
              margin-top:2%;
              width:70%;
              margin-left:17%;
              margin-right:3%;
            }
            .vidna_ostrina{
              display:block;
              margin-top:2%;
              margin-left:3%;
              margin-right:3%;
            }
            .labelVidnaOstrina{
              display:inline-block;
              float:left;
              width:18%;
            }
            .labelVodVos{
              display:inline-block;
              margin-left:25%;
              width:70%;
            }
            .vidna_ostrina_vod{
              display:inline-block;
	            width:100%;
            }
            .vidna_ostrina_vos{
              margin-top:2%;
              display:inline-block;
              width:100%;
            }
            .korekcija{
              display:block;
              margin-top:5%;
              margin-left:3%;
              margin-right:3%;
            }
            .korekcijaDaljina_R{
              display:inline-block;
	            width:50%;
            }
            #korDaljinaLabel{
              display:inline-block;
	            width:100%;
            }
           
            .korDaljinaOD{
              display:inline-block;
              margin-bottom:2%;
              margin-left:7%;
              width:100%;
            }
            .korDaljinaOS{
              display:inline-block;
              margin-left:7%;
              width:100%;
            }

            .korekcijaBlizina_R{
              display:inline-block;
	            width:45%;
            }
            #korBlizinaLabel{
              display:inline-block;
	            width:100%;
            }
            .korBlizinaOD{
              display:inline-block;
              margin-bottom:2%;
              margin-left:8%;
              width:100%;
            }
            .korBlizinaOS{
              display:inline-block;
              margin-left:8%;
              width:100%;
            }
            .pd{
              display:block;
              margin-left:7%;
            }
           
            .kontrolaPregledao{
              display:block;
              margin-left:3%;
              margin-right:5.5%;
            }
            .kontrolaReport{
              display:inline-block;
              margin-left:14%;
              width:45%;
            }
            .pregledao{
              display:inline-block;
              float:right;
            }
            .napomenaReport{
              display:inline-block;
              margin-top:2%;
              margin-left:16%;
              margin-right:3%;
            }
            .imeRadnika{
              float:right;
              display:inline-block;
              margin-top:2%;
              margin-right:5.5%;
            }
            </style>
            <body>
            <div class='logo'><img id='logo' /></div>
            <div class='kontaktPodaciRadnje'><label>Adresa:</label><label><?php echo $adresa; ?></label></br><label>Tel:</label><label><?php echo $telefon; ?></label></br><label><?php echo $website; ?></label></div>
            <hr id='linija'>
            <div class='generalijeDatum'>
            <div class='generalije'><label></label>&nbsp;<label><?php echo $generalije_pacijenta; ?></label></div>
            <div class='datum'><label></label>&nbsp;<label><?php echo $datum_pregleda; ?></label></div></div>
            <div class='ispisAnamneze'><label></label>&nbsp;<label><?php echo $anamneza; ?></label></div>
            </br>
            <div class='vidna_ostrina'><div class='labelVidnaOstrina'><label></label></div>
            <div class='labelVodVos'>
            <div class='vidna_ostrina_vod'><label></label>&nbsp;<label><?php echo $vod; ?></label></div>
            <div class='vidna_ostrina_vos'><label></label>&nbsp;<label><?php echo $vos; ?></label></div>
            </div></div>
            <div class='korekcija'>
            <div class='korekcijaDaljina_R'>
            <div id='korDaljinaLabel'><label></label></div>
            
            <div class='korDaljinaOD'><label></label>&nbsp;<label><?php echo $korekcija_daljina_od; ?></label></div>
            <div class='korDaljinaOS'><label></label>&nbsp;<label><?php echo $korekcija_daljina_os; ?></label></div>
            </div>

           
            <div class='korekcijaBlizina_R'>
            <div id='korBlizinaLabel'><label></label></div>
            <div class='korBlizinaOD'><label></label>&nbsp;<label><?php echo $korekcija_blizina_od; ?></label></div>
            <div class='korBlizinaOS'><label></label>&nbsp;<label><?php echo $korekcija_blizina_os; ?></label></div>
            </div>
            </div></br>
            <div class='pd'><label></label>&nbsp;<label><?php echo $pd; ?></label></div></br>
            <div class='kontrolaPregledao'>
            <div class='kontrolaReport'><label></label>&nbsp;<label><?php echo $kontrola; ?></label></div>
            <div class='pregledao'><label></label></div>
            </div>
            <div class='napomenaImeRadnika'>
            <div class='napomenaReport'><label></label>&nbsp;<label><?php echo $napomena_pregleda; ?></label></div>
            <div class='imeRadnika'></div>
            </div>
            </body>
            </html>
    `);

          window.frames['myiframe'].focus();
          window.frames['myiframe'].print();

          setTimeout(() => {
            $(".printFrame").remove();
          }, 1000);
        };

        function openPrintDialogueA4() {

          $('<iframe>', {
              name: 'myiframe',
              class: 'printFrame'
            })
            .appendTo('body')
            .contents().find('body')
            .append(`

            <html>
            <style>
            @-moz-document url-prefix() {
              @media print{ @page{ size: A4 portrait !important; margin: 0mm !important; }}
            }
           
            @media print{ @page{ size: A4 portrait !important; margin: 0mm !important; }}
            .logo{
              margin:3%;
              display:inline;
              width:55%;
              float:left;
            }
            .kontaktPodaciRadnje{
              display:inline;
              margin-top:5%;
              margin-right:5%;
              width:25%;
              float:right;
            }
            #linija{
              display:block;
              width:94%;
              margin-left:3%;
              margin-right:3%;
            }
            #logo{
              display:inline;
              width:51%;
              heigt:51%;
            }
            .generalije{
              display:inline-block;
              margin-top:5%;
              margin-left:3%;
            }
            .datum{
              float:right;
              display:inline-block;
              margin-top:5%;
              margin-right:14%;
            }
            .ispisAnamneze{
              display:block;
              margin-top:2%;
              margin-left:3%;
              margin-right:3%;
            }
            .vidna_ostrina{
              display:block;
              margin-top:2%;
              margin-left:3%;
            }
            .vidna_ostrina_vod{
              display:inline;
	            width:100%;
            }
            .vidna_ostrina_vos{
              display:inline;
              margin-left:18.4%;
              margin-top:2%;
	           
            }
            .motilitetTonusReport{
              display:block;
              margin-top:2%;
              margin-left:3%;
              margin-right:3%;
            }
            .motilitetReport{
              display:inline-block;
	            width:50%;
            }
            .tonusReport{
              display:inline-block;
	            width:45%;
            }
            #labelTonusOsReport{
              margin-left:10%;
            }
            .bmsFundus{
              display:block;
              margin-top:2%;
              margin-left:3%;
              margin-right:3%;
            }
            .bmsReport{
              display:inline-block;
	            width:50%;
            }
            #labelBmsReport{
              margin:0 auto;
              display:inline-block;
	            width:100%;
            }
            #labelBmsOdReport{
              display:inline-block;
              margin-bottom:2%;
              width:100%;
            }
            #labelBmsOsReport{
              display:inline-block;
              width:100%;
            }

            .fundusReport{
              display:inline-block;
	            width:45%;
            }
            #labelFundusReport{
              margin:0 auto;
              display:inline-block;
	            width:100%;
            }
            #labelFundusOdReport{
              display:inline-block;
              margin-bottom:2%;
              width:100%;
            }
            #labelFundusOsReport{
              display:inline-block;
              width:100%;
            }
            .korekcija{
              display:block;
              margin-top:2%;
              margin-left:3%;
              margin-right:3%;
            }
            .korekcijaDaljina_R{
              display:inline-block;
	            width:50%;
            }
            #korDaljinaLabel{
              margin:0 auto;
              display:inline-block;
	            width:100%;
            }
           
            .korDaljinaOD{
              display:inline-block;
              margin-bottom:2%;
              width:100%;
            }
            .korDaljinaOS{
              display:inline-block;
              width:100%;
            }

            .korekcijaBlizina_R{
              display:inline-block;
	            width:45%;
            }
            #korBlizinaLabel{
              margin:0 auto;
              display:inline-block;
	            width:100%;
            }
            .korBlizinaOD{
              display:inline-block;
              margin-bottom:2%;
              width:100%;
            }
            .korBlizinaOS{
              display:inline-block;
              width:100%;
            }
            .pd{
              display:block;
              margin-left:3%;
            }
            .dijagnozaReport{
              display:block;
              margin-left:3%;
              margin-right:3%;
            }
            .terapijaReport{
              display:block;
              margin-left:3%;
              margin-right:3%;
            }

            .kontrolaPregledao{
              display:block;
              margin-left:3%;
              margin-right:5.5%;
            }
            .kontrolaReport{
              display:inline-block;
              width:45%;
            }
            .pregledao{
              display:inline-block;
              float:right;
            }
            .napomenaReport{
              display:inline-block;
              margin-top:2%;
              margin-left:3%;
              margin-right:3%;
            }
            .imeRadnika{
              float:right;
              display:inline-block;
              margin-top:2%;
              margin-right:5.5%;
            }
            </style>
            <body>
            <div class='logo'><img id='logo' src='../pregled/images/MO.png' /></div>
            <div class='kontaktPodaciRadnje'><label>Adresa:</label><?php echo $adresa; ?></br><label>Tel:</label><?php echo $telefon; ?></br><label><?php echo $website; ?></label></div>
            <hr id='linija'>
            <div class='generalije'><label></label>&nbsp;<?php echo $generalije_pacijenta; ?></div>
            <div class='datum'><label>Datum:</label>&nbsp;<?php echo $datum_pregleda; ?></div>
            <div class='ispisAnamneze'><label>ANAMNEZA:</label>&nbsp;
            <?php
            echo  "<label>$anamneza</label>";
            echo  "</div>";
            ?></br>
            <div class='vidna_ostrina'><label>VIDNA OŠTRINA:</label>&nbsp;
            <div class='vidna_ostrina_vod'><label>VOD:</label>&nbsp;<?php echo $vod; ?></div></br>
            <div class='vidna_ostrina_vos'><label>VOS:</label>&nbsp;<?php echo $vos; ?></div>
            </div>

            <div class="motilitetTonusReport">
            <div class="motilitetReport"><label>MOTILITET:</label>&nbsp;<?php echo $motilitet; ?></div>
            <div class="tonusReport"><label>TONUS:</label>&nbsp;<label id='labelTonusOdReport'>OD:</label>&nbsp;<?php echo $tonus_od; ?>&nbsp;<label id='labelTonusOsReport'>OS:</label>&nbsp;<?php echo $tonus_os; ?></div>
            </div>

            <div class='bmsFundus'>
            <div class='bmsReport'>
              <label id='labelBmsReport'>BMS:</label>
                <label id='labelBmsOdReport'>OD:&nbsp;<?php echo $bms_od; ?></label>
                <label id='labelBmsOsReport'>OS:&nbsp;<?php echo $bms_os; ?></label>
            </div>

            <div class='fundusReport'>
              <label id='labelFundusReport'>FUNDUS:</label>
                <label id='labelFundusOdReport'>OD:&nbsp;<?php echo $fundus_od; ?></label>
                <label id='labelFundusOsReport'>OS:&nbsp;<?php echo $fundus_os; ?></label>
              </div>
            </div>
            </div>
            </br>
            <div class='dijagnozaReport'><label>DIJAGNOZA:</label>&nbsp;<?php echo $dijagnoza; ?></div>
            </br>
            <div class='terapijaReport'><label>TERAPIJA:</label>&nbsp;<?php echo $terapija; ?></div>
          
            <div class='korekcija'>
            <div class='korekcijaDaljina_R'>
            <div id='korDaljinaLabel'><label>DALJINA - korekcija:</label></div>
            <div class='korDaljinaOD'><label>OD:</label>&nbsp;<?php echo $korekcija_daljina_od; ?></div>
            <div class='korDaljinaOS'><label>OS:</label>&nbsp;<?php echo $korekcija_daljina_os; ?></div>
            </div>
            <div class='korekcijaBlizina_R'>
            <div id='korBlizinaLabel'><label>BLIZINA - korekcija:</label></div>
            <div class='korBlizinaOD'><label>OD:</label>&nbsp;<?php echo $korekcija_blizina_od; ?></div>
            <div class='korBlizinaOS'><label>OS:</label>&nbsp;<?php echo $korekcija_blizina_os; ?></div>
            </div>
            </div>
            </br>
            <div class='pd'><label>PD:</label>&nbsp;<?php echo $pd; ?></div></br>
            <div class='kontrolaPregledao'>
            <div class='kontrolaReport'><label>KONTROLA:</label>&nbsp;<?php echo $kontrola; ?></div>
            <div class='pregledao'><label>Pregledao:</label></div>
            </div>
            <div class='napomenaImeRadnika'>
            <div class='napomenaReport'><label>NAPOMENA:</label>&nbsp;<?php echo $napomena_pregleda; ?></div>
            <div class='imeRadnika'><?php echo $imePrezimeRadnika; ?></div>
            </div>
            </body>
            </html>
    `);

          window.frames['myiframe'].focus();
          window.frames['myiframe'].print();

          setTimeout(() => {
            $(".printFrame").remove();
          }, 1000);

        };



        function openPrintDialogueLensesShortEximination() {

          $('<iframe>', {
              name: 'myiframe',
              class: 'printFrame'
            })
            .appendTo('body')
            .contents().find('body')
            .append(`

  <html>
  <style>
  @-moz-document url-prefix() {
    @media print{ @page{ size: A4 portrait !important; margin: 0mm !important; }}
  }
 
  @media print{ @page{ size: A4 portrait !important; margin: 0mm !important; }}
  .logo{
    margin:3%;
    display:inline;
    width:55%;
    float:left;
  }
  .kontaktPodaciRadnje{
    display:inline;
    margin-top:5%;
    margin-right:5%;
    width:25%;
    float:right;
  }
  #linija{
    display:block;
    width:94%;
    margin-left:3%;
    margin-right:3%;
  }
  #logo{
    display:inline;
    width:51%;
    heigt:51%;
  }
  .generalije{
    display:inline-block;
    margin-top:5%;
    margin-left:3%;
  }
  .datum{
    float:right;
    display:inline-block;
    margin-top:5%;
    margin-right:14%;
  }
  .ispisAnamneze{
    display:block;
    margin-top:2%;
    margin-left:3%;
    margin-right:3%;
  }
  .vidna_ostrina{
    display:block;
    margin-top:2%;
    margin-left:3%;
  }
  .vidna_ostrina_vod{
    display:inline;
    width:100%;
  }
  .vidna_ostrina_vos{
    display:inline;
    margin-left:18.4%;
    margin-top:2%;
  }
  .motilitetTonusReport{
    display:block;
    margin-top:2%;
    margin-left:3%;
    margin-right:3%;
  }
  .motilitetReport{
    display:inline-block;
    width:50%;
  }
  .tonusReport{
    display:inline-block;
    width:45%;
  }
  #labelTonusOsReport{
    margin-left:10%;
  }
  .bmsFundus{
    display:block;
    margin-top:2%;
    margin-left:3%;
    margin-right:3%;
  }
  .bmsReport{
    display:inline-block;
    width:50%;
  }
  #labelBmsReport{
    margin:0 auto;
    display:inline-block;
    width:100%;
  }
  #labelBmsOdReport{
    display:inline-block;
    margin-bottom:2%;
    width:100%;
  }
  #labelBmsOsReport{
    display:inline-block;
    width:100%;
  }
  .fundusReport{
    display:inline-block;
    width:45%;
  }
  #labelFundusReport{
    margin:0 auto;
    display:inline-block;
    width:100%;
  }
  #labelFundusOdReport{
    display:inline-block;
    margin-bottom:2%;
    width:100%;
  }
  #labelFundusOsReport{
    display:inline-block;
    width:100%;
  }
  .labelLensesCorrection{
    display:block;
    margin-left:3%;
  }
  .lensesCorrection{
    display:block;
    margin-top:1%;
    margin-left:3%;
    margin-right:3%;
    width:94%;
  }
  .lensesCorrectionOd{
    display:inline-block;
    width:45%;
    float:left;
  }
  .lensesCorrectionOs{
    display:inline-block;
    width:45%;
  }
  .dijagnozaReport{
    display:block;
    margin-left:3%;
    margin-right:3%;
  }
  .terapijaReport{
    display:block;
    margin-left:3%;
    margin-right:3%;
  }

  .kontrolaPregledao{
    display:block;
    margin-left:3%;
    margin-right:5.5%;
  }
  .kontrolaReport{
    display:inline-block;
    width:45%;
  }
  .pregledao{
    display:inline-block;
    float:right;
  }
  .napomenaReport{
    display:inline-block;
    margin-top:2%;
    margin-left:3%;
    margin-right:3%;
  }
  .imeRadnika{
    float:right;
    display:inline-block;
    margin-top:2%;
    margin-right:5.5%;
  }
  </style>
  <body>
  <div class='logo'><img id='logo' src='../pregled/images/MO.png' /></div>
  <div class='kontaktPodaciRadnje'><label>Adresa:</label><?php echo $adresa; ?></br><label>Tel:</label><?php echo $telefon; ?></br><label><?php echo $website; ?></label></div>
  <hr id='linija'>
  <div class='generalije'><label></label>&nbsp;<?php echo $generalije_pacijenta; ?></div>
  <div class='datum'><label>Datum:</label>&nbsp;<?php echo $datum_pregleda; ?></div>
  <div class='ispisAnamneze'><label>ANAMNEZA:</label>&nbsp;<label><?php echo $anamneza; ?></label></div>
  </br>
  <div class='vidna_ostrina'><label>VIDNA OŠTRINA:</label>&nbsp;
  <div class='vidna_ostrina_vod'><label>VOD:</label>&nbsp;<?php echo $vod; ?></div></br>
  <div class='vidna_ostrina_vos'><label>VOS:</label>&nbsp;<?php echo $vos; ?></div>
  </div>
  
  </br>
  <div class='dijagnozaReport'><label>DIJAGNOZA:</label>&nbsp;<?php echo $dijagnoza; ?></div>
  </br>
  <div class='terapijaReport'><label>TERAPIJA:</label>&nbsp;<?php echo $terapija; ?></div>
  </br>
  <div class='labelLensesCorrection'><labe>KOREKCIJA - kontaktna sočiva:</label></div>
  <div class='lensesCorrection'>
   <div class="lensesCorrectionOd">
      <label>OD:</label>
      <div class="proizvodjac"><label id='labelManufactured'>Proizvođač:</label>&nbsp;<?php echo $proizvodjac_ks_od; ?></div>
      <div class="period"><label id='labelType'>Period:</label>&nbsp;<?php echo $period_ks_od; ?></div>
      <div class="tip"><label id='labelType'>Tip/vrsta:</label>&nbsp;<?php echo $tip_ks_od; ?></div>
      <div class="jacina"><label id='labelPower'>Jačina:</label>&nbsp;<?php echo $jacina_ks_od; ?></div>
      <div class="bc"><label id='labelBc'>BC:</label>&nbsp;<?php echo $bc_ks_od; ?></div>
      <div class="velicina"><label id='labelSize'>TD:</label>&nbsp;<?php echo $velicina_ks_od; ?></div>
      <div class="boja"><label id='labelColor'>Boja:</label>&nbsp;<?php echo $boja_ks_od; ?></div>
   </div>
   <div class="lensesCorrectionOs">
      <label>OS:</label>
      <div class="proizvodjac"><label id='labelManufactured'>Proizvođač:</label>&nbsp;<?php echo $proizvodjac_ks_os; ?></div>
      <div class="period"><label id='labelType'>Period:</label>&nbsp;<?php echo $period_ks_os; ?></div>
      <div class="tip"><label id='labelType'>Tip/vrsta:</label>&nbsp;<?php echo $tip_ks_os; ?></div>
      <div class="jacina"><label id='labelPower'>Jačina:</label>&nbsp;<?php echo $jacina_ks_os; ?></div>
      <div class="bc"><label id='labelBc'>BC:</label>&nbsp;<?php echo $bc_ks_os; ?></div>
      <div class="velicina"><label id='labelSize'>TD:</label>&nbsp;<?php echo $velicina_ks_os; ?></div>
      <div class="boja"><label id='labelColor'>Boja:</label>&nbsp;<?php echo $boja_ks_os; ?> </div>
   </div>
</div>
  </br>
  <div class='kontrolaPregledao'>
  <div class='kontrolaReport'><label>KONTROLA:</label>&nbsp;<?php echo $kontrola; ?></div>
  <div class='pregledao'><label>Pregledao:</label></div>
  </div>
  <div class='napomenaImeRadnika'>
  <div class='napomenaReport'><label>NAPOMENA:</label>&nbsp;<?php echo $napomena_pregleda; ?></div>
  <div class='imeRadnika'></div>
  </div>
  </body>
  </html>
`);

          window.frames['myiframe'].focus();
          window.frames['myiframe'].print();

          setTimeout(() => {
            $(".printFrame").remove();
          }, 1000);

        };

        function openPrintDialogueLensesEximination() {

          $('<iframe>', {
              name: 'myiframe',
              class: 'printFrame'
            })
            .appendTo('body')
            .contents().find('body')
            .append(`

<html>
<style>
@-moz-document url-prefix() {
@media print{ @page{ size: A4 portrait !important; margin: 0mm !important; }}
}

@media print{ @page{ size: A4 portrait !important; margin: 0mm !important; }}
.logo{
margin:3%;
display:inline;
width:55%;
float:left;
}
.kontaktPodaciRadnje{
display:inline;
margin-top:5%;
margin-right:5%;
width:25%;
float:right;
}
#linija{
display:block;
width:94%;
margin-left:3%;
margin-right:3%;
}
#logo{
display:inline;
width:51%;
heigt:51%;
}
.generalije{
display:inline-block;
margin-top:5%;
margin-left:3%;
}
.datum{
float:right;
display:inline-block;
margin-top:5%;
margin-right:14%;
}
.ispisAnamneze{
display:block;
margin-top:2%;
margin-left:3%;
margin-right:3%;
}
.vidna_ostrina{
display:block;
margin-top:2%;
margin-left:3%;
}
.vidna_ostrina_vod{
display:inline;
width:100%;
}
.vidna_ostrina_vos{
display:inline;
margin-left:18.4%;
margin-top:2%;
}
.motilitetTonusReport{
display:block;
margin-top:2%;
margin-left:3%;
margin-right:3%;
}
.motilitetReport{
display:inline-block;
width:50%;
}
.tonusReport{
display:inline-block;
width:45%;
}
#labelTonusOsReport{
margin-left:10%;
}
.bmsFundus{
display:block;
margin-top:2%;
margin-left:3%;
margin-right:3%;
}
.bmsReport{
display:inline-block;
width:50%;
}
#labelBmsReport{
margin:0 auto;
display:inline-block;
width:100%;
}
#labelBmsOdReport{
display:inline-block;
margin-bottom:2%;
width:100%;
}
#labelBmsOsReport{
display:inline-block;
width:100%;
}
.fundusReport{
display:inline-block;
width:45%;
}
#labelFundusReport{
margin:0 auto;
display:inline-block;
width:100%;
}
#labelFundusOdReport{
display:inline-block;
margin-bottom:2%;
width:100%;
}
#labelFundusOsReport{
display:inline-block;
width:100%;
}
.labelLensesCorrection{
display:block;
margin-left:3%;
}
.lensesCorrection{
display:block;
margin-top:1%;
margin-left:3%;
margin-right:3%;
width:94%;
}
.lensesCorrectionOd{
display:inline-block;
width:45%;
float:left;
}
.lensesCorrectionOs{
display:inline-block;
width:45%;
}
.dijagnozaReport{
display:block;
margin-left:3%;
margin-right:3%;
}
.terapijaReport{
display:block;
margin-left:3%;
margin-right:3%;
}

.kontrolaPregledao{
display:block;
margin-left:3%;
margin-right:5.5%;
}
.kontrolaReport{
display:inline-block;
width:45%;
}
.pregledao{
display:inline-block;
float:right;
}
.napomenaReport{
display:inline-block;
margin-top:2%;
margin-left:3%;
margin-right:3%;
}
.imeRadnika{
float:right;
display:inline-block;
margin-top:2%;
margin-right:5.5%;
}
</style>
<body>
<div class='logo'><img id='logo' src='../pregled/images/MO.png' /></div>
<div class='kontaktPodaciRadnje'><label>Adresa:</label><?php echo $adresa; ?></br><label>Tel:</label><?php echo $telefon; ?></br><label><?php echo $website; ?></label></div>
<hr id='linija'>
<div class='generalije'><label></label>&nbsp;<?php echo $generalije_pacijenta; ?></div>
<div class='datum'><label>Datum:</label>&nbsp;<?php echo $datum_pregleda; ?></div>
<div class='ispisAnamneze'><label>ANAMNEZA:</label>&nbsp;<label><?php echo $anamneza; ?></label></div>
</br>
<div class='vidna_ostrina'><label>VIDNA OŠTRINA:</label>&nbsp;
<div class='vidna_ostrina_vod'><label>VOD:</label>&nbsp;<?php echo $vod; ?></div></br>
<div class='vidna_ostrina_vos'><label>VOS:</label>&nbsp;<?php echo $vos; ?></div>
</div>
<div class="motilitetTonusReport">
<div class="motilitetReport"><label>MOTILITET:</label>&nbsp;<?php echo $motilitet; ?></div>
<div class="tonusReport"><label>TONUS:</label>&nbsp;<label id='labelTonusOdReport'>OD:</label>&nbsp;<?php echo $tonus_od; ?>&nbsp;<label id='labelTonusOsReport'>OS:</label>&nbsp;<?php echo $tonus_os; ?></div>
</div>
<div class='bmsFundus'>
<div class='bmsReport'>
<label id='labelBmsReport'>BMS:</label>
<label id='labelBmsOdReport'>OD:&nbsp;<?php echo $bms_od; ?></label>
<label id='labelBmsOsReport'>OS:&nbsp;<?php echo $bms_os; ?></label>
</div>
<div class='fundusReport'>
<label id='labelFundusReport'>FUNDUS:</label>
<label id='labelFundusOdReport'>OD:&nbsp;<?php echo $fundus_od; ?></label>
<label id='labelFundusOsReport'>OS:&nbsp;<?php echo $fundus_os; ?></label>
</div>
</div>
</div>
</br>
<div class='dijagnozaReport'><label>DIJAGNOZA:</label>&nbsp;<?php echo $dijagnoza; ?></div>
</br>
<div class='terapijaReport'><label>TERAPIJA:</label>&nbsp;<?php echo $terapija; ?></div>
</br>
<div class='labelLensesCorrection'><labe>KOREKCIJA - kontaktna sočiva:</label></div>
<div class='lensesCorrection'>
<div class="lensesCorrectionOd">
<label>OD:</label>
<div class="proizvodjac"><label id='labelManufactured'>Proizvođač:</label>&nbsp;<?php echo $proizvodjac_ks_od; ?></div>
<div class="period"><label id='labelType'>Period:</label>&nbsp;<?php echo $period_ks_od; ?></div>
<div class="tip"><label id='labelType'>Tip/vrsta:</label>&nbsp;<?php echo $tip_ks_od; ?></div>
<div class="jacina"><label id='labelPower'>Jačina:</label>&nbsp;<?php echo $jacina_ks_od; ?></div>
<div class="bc"><label id='labelBc'>BC:</label>&nbsp;<?php echo $bc_ks_od; ?></div>
<div class="velicina"><label id='labelSize'>TD:</label>&nbsp;<?php echo $velicina_ks_od; ?></div>
<div class="boja"><label id='labelColor'>Boja:</label>&nbsp;<?php echo $boja_ks_od; ?></div>
</div>
<div class="lensesCorrectionOs">
<label>OS:</label>
<div class="proizvodjac"><label id='labelManufactured'>Proizvođač:</label>&nbsp;<?php echo $proizvodjac_ks_os; ?></div>
<div class="period"><label id='labelType'>Period:</label>&nbsp;<?php echo $period_ks_os; ?></div>
<div class="tip"><label id='labelType'>Tip/vrsta:</label>&nbsp;<?php echo $tip_ks_os; ?></div>
<div class="jacina"><label id='labelPower'>Jačina:</label>&nbsp;<?php echo $jacina_ks_os; ?></div>
<div class="bc"><label id='labelBc'>BC:</label>&nbsp;<?php echo $bc_ks_os; ?></div>
<div class="velicina"><label id='labelSize'>TD:</label>&nbsp;<?php echo $velicina_ks_os; ?></div>
<div class="boja"><label id='labelColor'>Boja:</label>&nbsp;<?php echo $boja_ks_os; ?> </div>
</div>
</div>
</br>
<div class='kontrolaPregledao'>
<div class='kontrolaReport'><label>KONTROLA:</label>&nbsp;<?php echo $kontrola; ?></div>
<div class='pregledao'><label>Pregledao:</label></div>
</div>
<div class='napomenaImeRadnika'>
<div class='napomenaReport'><label>NAPOMENA:</label>&nbsp;<?php echo $napomena_pregleda; ?></div>
<div class='imeRadnika'></div>
</div>
</body>
</html>
`);

          window.frames['myiframe'].focus();
          window.frames['myiframe'].print();

          setTimeout(() => {
            $(".printFrame").remove();
          }, 1000);

        };



        //Metod koji prosljeđuje unesenu šifru radnika i šifru radnika koji je obavio pregled, metodi za provjeru
        function worker() {
          var sifra_radnika = "<?php echo $sifra_radnika; ?>";
          var id_pregleda = "<?php echo $id_pregleda; ?>";
          checkUser(sifra_radnika, id_pregleda);
        }
      </script>



</body>

</html>
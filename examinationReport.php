<!DOCTYPE html>
<html lang="en">

<?php

include '../pregled/modules/header.php';
require_once 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$ID_korisnika = $ar[0];
$imeKorisnika = $ar[1];
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);

$upit = "SELECT adresa,telefon FROM optike.korisnici WHERE ID=$ID_korisnika";
$rezultat = mysqli_query($conn, $upit);
if (!$rezultat) die(mysqli_error($conn));
while ($red = mysqli_fetch_object($rezultat)) {
  $adresa = $red->adresa;
  $telefon = $red->telefon;
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

            <?php

            $ime_prezime_pacijenta = "";
            $datum_pregleda = "";
            $anamneza = "";
            $vod = "";
            $vos = "";
            $motilitet = "";
            $bms_od = "";
            $bms_os = "";
            $tonus_od = "";
            $tonus_os = "";
            $fundus_od = "";
            $fundus_os = "";
            $dijagnoza = "";
            $terapija = "";
            $korekcija_daljina_od = "";
            $korekcija_daljina_os = "";
            $korekcija_blizina_od = "";
            $korekcija_blizina_os = "";
            $tip_ks_od = "";
            $jacina_ks_od = "";
            $bc_ks_od  = "";
            $velicina_ks_od  = "";
            $boja_ks_od = "";
            $tip_ks_os = "";
            $jacina_ks_os = "";
            $bc_ks_os = "";
            $velicina_ks_os  = "";
            $boja_ks_os = "";
            $pd = "";
            $kontrola = "";
            $napomena_pregleda  = "";

            $success = $_REQUEST['success'];

            $ar = explode("@@@", $success, 31);
            $ar[1] = rtrim($ar[1], "@@@");

            if (isset($ar[0])) {
              $ime_prezime_pacijenta = $ar[0];
            }
            if (isset($ar[1])) {
              $datum_pregleda = $ar[1];
            }
            if (isset($ar[2])) {
              $anamneza = $ar[2];
            }
            if (isset($ar[3])) {
              $vod = $ar[3];
            }
            if (isset($ar[4])) {
              $vos = $ar[4];
            }
            if (isset($ar[5])) {
              $motilitet = $ar[5];
            }

            if (isset($ar[6])) {
              $bms_od = $ar[6];
            }
            if (isset($ar[7])) {
              $bms_os = $ar[7];
            }

            if (isset($ar[8])) {
              $tonus_od = $ar[8];
            }
            if (isset($ar[9])) {
              $tonus_os = $ar[9];
            }
            if (isset($ar[10])) {
              $fundus_od = $ar[10];
            }
            if (isset($ar[11])) {
              $fundus_os = $ar[11];
            }
            if (isset($ar[12])) {
              $dijagnoza = $ar[12];
            }
            if (isset($ar[13])) {
              $terapija = $ar[13];
            }
            if (isset($ar[14])) {
              $kontrola = $ar[14];
            }
            if (isset($ar[15])) {
              $korekcija_daljina_od = $ar[15];
            }
            if (isset($ar[16])) {
              $korekcija_daljina_os = $ar[16];
            }
            if (isset($ar[17])) {
              $korekcija_blizina_od = $ar[17];
            }
            if (isset($ar[18])) {
              $korekcija_blizina_os = $ar[18];
            }
            if (isset($ar[19])) {
              $pd = $ar[19];
            }
            if (isset($ar[20])) {
              $tip_ks_od = $ar[20];
            }
            if (isset($ar[21])) {
              $jacina_ks_od = $ar[21];
            }
            if (isset($ar[22])) {
              $bc_ks_od  = $ar[22];
            }
            if (isset($ar[23])) {
              $velicina_ks_od  = $ar[23];
            }
            if (isset($ar[24])) {
              $boja_ks_od = $ar[24];
            }
            if (isset($ar[25])) {
              $tip_ks_os = $ar[25];
            }
            if (isset($ar[26])) {
              $jacina_ks_os = $ar[26];
            }
            if (isset($ar[27])) {
              $bc_ks_os = $ar[27];
            }
            if (isset($ar[28])) {
              $velicina_ks_os  = $ar[28];
            }
            if (isset($ar[29])) {
              $boja_ks_os = $ar[29];
            }
            if (isset($ar[30])) {
              $napomena_pregleda  = $ar[30];
            }




            echo " <div class='row'> <strong><label>Ime, prezime i godina rođenja: </label></strong> &nbsp; $ime_prezime_pacijenta</div>";
            echo " <div class='row'> <strong><label>Datum: </label></strong> &nbsp; $datum_pregleda</div>";
            echo "<hr>";
            echo " <div class='row'> <div class='ispisAnamneze'><strong><label>ANAMNEZA: </label></strong> &nbsp; </div>";
            echo "$anamneza</div>";
            echo "<br>";
            echo "<div class='row'> <strong><label>VIDNA OŠTRINA: </label></strong></div>";
            echo "<div class='row'> <label>VOD:</label> &nbsp; $vod</div>";
            echo "<div class='row'> <label>VOS:</label> &nbsp; $vos</div>";
            echo "<hr>";
            echo "<div class='motelitetTonusGrupa'>";
            echo "<div class='motilitetGrupa'>";
            echo "<div class='row'> <strong><label>MOTILITET: </label></strong> &nbsp; $motilitet</div>";
            echo "</div>";
            echo "<div class='tonusGrupa'>";
            echo "<div class='row'> <strong><label>TONUS: </label></strong></div>";
            echo "<div class='row'> <label>OD: </label></strong> &nbsp; $tonus_od</div>";
            echo "<div class='row'> <label>OS: </label></strong> &nbsp; $tonus_os</div>";
            echo "</div>";
            echo "</div>";
            echo "<br>";
            echo "<div id='grupa1'>";
            echo "<div class='row'> <strong><label>BMS: </label></strong></div>";
            echo "<div class='row'> <label>OD: </label></strong> &nbsp; $bms_od</div>";
            echo "<div class='row'> <label>OS: </label></strong> &nbsp; $bms_os</div>";
            echo "</div>";

            echo "<div id='grupa2'>";
            echo "<div class='row'> <strong><label>FUNDUS: </label></strong></div>";
            echo "<div class='row'> <label>OD: </label></strong> &nbsp; $fundus_od</div>";
            echo "<div class='row'> <label>OS: </label></strong> &nbsp; $fundus_os</div>";

            echo "</div>";
            echo "<hr>";
            echo "<div class='row'> <strong><label>DIJAGNOZA: &nbsp;</label></strong>$dijagnoza</div>";
            echo "<div class='row'> <strong><label>TERAPIJA:&nbsp;</label></strong> $terapija</div>";
            echo "<div class='row'> <strong><label>KONTROLA: &nbsp;</label></strong>  $kontrola</div>";
            echo "<hr>";
            echo "<div class='korekcijaDaljina'>";
            echo "<div class='row'> <strong><label>KOREKCIJA - daljina: </label></strong></div>";
            echo "<div class='row'> <label>OD: </label></strong> &nbsp; $korekcija_daljina_od</div>";
            echo "<div class='row'> <label>OS: </label></strong> &nbsp; $korekcija_daljina_os</div>";
            echo "</div>";
            echo "<div class='korekcijaBlizina'>";
            echo "<div class='row'> <strong><label>KOREKCIJA - blizina: </label></strong></div>";
            echo "<div class='row'> <label>OD: </label></strong> &nbsp; $korekcija_blizina_od</div>";
            echo "<div class='row'> <label>OS: </label></strong> &nbsp; $korekcija_blizina_os</div>";
            echo "</div>";
            echo "<br>";
            echo "<br>";
            echo "<div class='row'> <strong><label>PD: &nbsp;</label></strong> $pd</div></br>";


            echo "<hr>";
            echo "<div class='row'> <strong><label>KOREKCIJA (kon. sočiva): </label></strong></div>";
            echo "<div id='korekcijas1'>";
            echo "<div class='row'> <label>OD:&nbsp; </label></strong></div>";
            echo "<div class='row'> <label></label></strong>Tip/vrsta: &nbsp; $tip_ks_od</div>";
            echo "<div class='row'> <label></label></strong>Jacina: &nbsp; $jacina_ks_od</div>";
            echo "<div class='row'> <label></label></strong>BC: &nbsp; $bc_ks_od</div>";
            echo "<div class='row'> <label></label></strong>Veličina: &nbsp; $velicina_ks_od</div>";
            echo "<div class='row'> <label></label></strong>Boja: &nbsp; $boja_ks_od</div>";
            echo "</div>";
            echo "<div id='korekcijas2'>";
            echo "<div class='row'> <label>OS:&nbsp; </label></strong></div>";
            echo "<div class='row'> <label></label></strong>Tip/vrsta: &nbsp; $tip_ks_os</div>";
            echo "<div class='row'> <label></label></strong>Jacina: &nbsp; $jacina_ks_os</div>";
            echo "<div class='row'> <label></label></strong>BC: &nbsp; $bc_ks_os</div>";
            echo "<div class='row'> <label></label></strong>Veličina: &nbsp; $velicina_ks_os</div>";
            echo "<div class='row'> <label></label></strong>Boja: &nbsp; $boja_ks_os</div>";
            echo "</div>";
            echo "<hr>";



            echo "<div class='row'> <strong><label>NAPOMENA: &nbsp;</label></strong>  $napomena_pregleda</div>";
            echo "<hr>";
            echo "<br>";
            echo "<br>";
            echo "<div id='stampa1'>";
            echo "<h4>Pregled za naočare</h4>";
            echo "<button id='kratkiIspisNaocare' title='Kratki izvještaj pregleda za naočare (A5 landscape)' class='btn btn-primary' onClick='openPrintDialogue()'><i class='fa fa-print' ></i>&nbsp;<label class='labelPrintButton'>Štampa kratki ispis</label></button>";
            echo "<button id='dugiIspisNaocare' title='Dugi izvještaj pregleda za naočare (A4 portrait)' class='btn btn-primary'><i class='fa fa-print'></i>&nbsp;<label class='labelPrintButton'>Štampa dugi ispis</label></button>";
            echo "</div>";
            echo "<div id='stampa2'>";
            echo "<h4>Pregled za sočiva</h4>";
            echo "<button id='kratkiIspisSociva' title='Kratki izvještaj pregleda za sočiva (A5 landscape)' class='btn btn-primary'><i class='fa fa-print'></i>&nbsp;<label class='labelPrintButton'>Štampa kratki ispis</label></button>";
            echo "<button id='dugiIspisSociva' title='Dugi izvještaj pregleda za sočiva (A4 portrait)' class='btn btn-primary'><i class='fa fa-print'></i>&nbsp;<label class='labelPrintButton'>Štampa dugi ispis</label></button>";
            echo "</div>";
            ?>

          </div>




          <!-- /.container-fluid -->
        </div>

      </div <!-- Footer -->
      <?php
      include '../pregled/modules/footer.php';
      ?>
      <!-- End of Footer -->

      <script>
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
            @page { size: A5 landscape;  margin: 0mm; }
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
              margin-right:3%;
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
            .korekcija{
              display:block;
              margin-top:2%;
              margin-left:3%;
              margin-right:3%;
            }
            .korekcijaDaljina_R{
              display:inline-block;
	            width:45%;
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
            .kontrolaIspis{
              display:block;
              margin-left:3%;
              margin-right:3%;
            }
            .napomenaIspis{
              display:block;
              margin-top:2%;
              margin-left:3%;
              margin-right:3%;
            }
            </style>
            <body>
            <div class='logo'><img id='logo' src='../pregled/images/MO.png' /></div>
            <div class='kontaktPodaciRadnje'><label>Adresa:</label><?php echo $adresa; ?></br><label>Tel:</label><?php echo $telefon; ?></br><label>www.mojaoptika.com</label></div>
            <hr id='linija'>
            <div class='generalije'><label></label>&nbsp;<?php echo $ime_prezime_pacijenta; ?></div>
            <div class='datum'><label>Datum:</label>&nbsp;<?php echo $datum_pregleda; ?></div>
            <div class='ispisAnamneze'><label>ANAMNEZA:</label>&nbsp;
            <?php
            //  $separated = explode('$$', $anamneza);
            //echo  "<div class='anamnezaIspis'>";
            // foreach ($separated as $value) {
            echo  "<label>$anamneza</label>";
            //  }
            echo  "</div>";
            ?></br>
            <div class='vidna_ostrina'><label>VIDNA OŠTRINA:</label>&nbsp;
            <div class='vidna_ostrina_vod'><label>VOD:</label>&nbsp;<?php echo $vod; ?></div></br>
            <div class='vidna_ostrina_vos'><label>VOS:</label>&nbsp;<?php echo $vos; ?></div>
            </div>
            <div class='korekcija'>
            <div class='korekcijaDaljina_R'>
            <div id='korDaljinaLabel'><label>KOREKCIJA - daljina:</label></div>
            
            <div class='korDaljinaOD'><label>OD:</label>&nbsp;<?php echo $korekcija_daljina_od; ?></div>
            <div class='korDaljinaOS'><label>OS:</label>&nbsp;<?php echo $korekcija_daljina_os; ?></div>
            </div>

           
            <div class='korekcijaBlizina_R'>
            <div id='korBlizinaLabel'><label>KOREKCIJA - blizina:</label></div>
            <div class='korBlizinaOD'><label>OD:</label>&nbsp;<?php echo $korekcija_blizina_od; ?></div>
            <div class='korBlizinaOS'><label>OS:</label>&nbsp;<?php echo $korekcija_blizina_os; ?></div>
            </div>
            </div></br>
            <div class='pd'><label>PD:</label>&nbsp;<?php echo $pd; ?></div></br>
            <div class='kontrolaIspis'><label>KONTROLA:</label>&nbsp;<?php echo $kontrola; ?></div>
            <div class='napomenaIspis'><label>NAPOMENA:</label>&nbsp;<?php echo $napomena_pregleda; ?></div>
    
    
            </body>
            </html>
    `);

          window.frames['myiframe'].focus();
          window.frames['myiframe'].print();

          setTimeout(() => {
            $(".printFrame").remove();
          }, 1000);
        };

        //$('button#kratkiIspisNaocare').on('click', openPrintDialogue);
      </script>



</body>

</html>
<!DOCTYPE html>
<html lang="en">

<?php

include '../pregled/modules/header.php';
require_once 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 4);
$ar[1] = rtrim($ar[1], "#");
$ID_korisnika = $ar[0];
$imeKorisnika = $ar[2];
$dataBaseName = $ar[3];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");

$sql = "SELECT adresa,telefon,website FROM mojaopt_optike.korisnici WHERE ID=$ID_korisnika";
$rezultat = mysqli_query($conn, $sql);
if (!$rezultat) die(mysqli_error($conn));
while ($row = mysqli_fetch_object($rezultat)) {
  $adresa = $row->adresa;
  $telefon = $row->telefon;
  $website = $row->website;
}
CloseCon($conn);

//Metod za prikaz loga korisnika (optike)
function logo($idKorisnika)
{
  $con = OpenCon();
  $stmt = $con->prepare('SELECT logo FROM korisnici WHERE ID=?');
  $stmt->bind_param('i', $idKorisnika);
  $stmt->execute();
  $result = $stmt->get_result();
  $logo = '../pregled/images/logo_optika/default_logo';
  while ($row = $result->fetch_object()) {
    $logo = '../pregled/images/logo_optika/' . $row->logo;
  }
  echo $logo;
  CloseCon($con);
}


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
          <h1 class="h3 mb-4 text-gray-800">Izvještaj pregleda</h1>

          <div class='tabelaSpecijala1'>

            <?php

            $radnik = "";
            $generalije_pacijenta = "";
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
            $pd = "";
            $kontrola = "";
            $napomena_pregleda  = "";

            $success = $_REQUEST['success'];

            $ar = explode("@@@", $success, 22);
            $ar[1] = rtrim($ar[1], "@@@");

            if (isset($ar[0])) {
              $radnik = $ar[0];
            }
            if (isset($ar[1])) {
              $generalije_pacijenta = $ar[1];
            }
            if (isset($ar[2])) {
              $datum_pregleda = $ar[2];
            }
            if (isset($ar[3])) {
              $anamneza = $ar[3];
            }
            if (isset($ar[4])) {
              $vod = $ar[4];
            }
            if (isset($ar[5])) {
              $vos = $ar[5];
            }
            if (isset($ar[6])) {
              $motilitet = $ar[6];
            }
            if (isset($ar[7])) {
              $bms_od = $ar[7];
            }
            if (isset($ar[8])) {
              $bms_os = $ar[8];
            }
            if (isset($ar[9])) {
              $tonus_od = $ar[9];
            }
            if (isset($ar[10])) {
              $tonus_os = $ar[10];
            }
            if (isset($ar[11])) {
              $fundus_od = $ar[11];
            }
            if (isset($ar[12])) {
              $fundus_os = $ar[12];
            }
            if (isset($ar[13])) {
              $dijagnoza = $ar[13];
            }
            if (isset($ar[14])) {
              $terapija = $ar[14];
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
              $kontrola = $ar[20];
            }
            if (isset($ar[21])) {
              $napomena_pregleda  = $ar[21];
            }


            echo " <div class='row'> <strong><label>Pregled uradio: </label></strong> &nbsp; $radnik</div>";
            echo " <div class='row'> <strong><label>Ime, prezime i godina rođenja: </label></strong> &nbsp; $generalije_pacijenta</div>";
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

            echo "<div class='row'> <strong><label>KONTROLA: &nbsp;</label></strong>  $kontrola</div>";



            echo "<div class='row'> <strong><label>NAPOMENA: &nbsp;</label></strong>  $napomena_pregleda</div>";
            echo "<hr>";
            echo "<br>";
            echo "<br>";
            echo "<div id='stampa1'>";
            echo "<h4></h4>";
            echo "<button id='kratkiIspisNaocare' title='Kratki izvještaj pregleda za naočare (A5 landscape)' class='btn btn-primary' onClick='openPrintDialogue()'><i class='fa fa-print' ></i>&nbsp;<label class='labelPrintButton'>Štampa kratki ispis</label></button>";
            echo "<button id='dugiIspisNaocare' title='Dugi izvještaj pregleda za naočare (A4 portrait)' class='btn btn-primary' onClick='openPrintDialogueA4()'><i class='fa fa-print'></i>&nbsp;<label class='labelPrintButton'>Štampa dugi ispis</label></button>";
            echo "<br>";
            echo "<br>";
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
            <div class='kontaktPodaciRadnje'><label>Adresa:</label><?php echo $adresa; ?></br><label>Tel:</label><?php echo $telefon; ?></br><label><?php echo $website; ?></label></div>
            <hr id='linija'>
            <div class='generalijeDatum'>
            <div class='generalije'><label></label>&nbsp;<?php echo $generalije_pacijenta; ?></div>
            <div class='datum'><label></label>&nbsp;<?php echo $datum_pregleda; ?></div></div>
            <div class='ispisAnamneze'><label></label>&nbsp;<label><?php echo $anamneza; ?></label></div>
            </br>
            <div class='vidna_ostrina'><div class='labelVidnaOstrina'><label></label></div>
            <div class='labelVodVos'>
            <div class='vidna_ostrina_vod'><label></label>&nbsp;<?php echo $vod; ?></div>
            <div class='vidna_ostrina_vos'><label></label>&nbsp;<?php echo $vos; ?></div>
            </div></div>
            <div class='korekcija'>
            <div class='korekcijaDaljina_R'>
            <div id='korDaljinaLabel'><label></label></div>
            
            <div class='korDaljinaOD'><label></label>&nbsp;<?php echo $korekcija_daljina_od; ?></div>
            <div class='korDaljinaOS'><label></label>&nbsp;<?php echo $korekcija_daljina_os; ?></div>
            </div>

           
            <div class='korekcijaBlizina_R'>
            <div id='korBlizinaLabel'><label></label></div>
            <div class='korBlizinaOD'><label></label>&nbsp;<?php echo $korekcija_blizina_od; ?></div>
            <div class='korBlizinaOS'><label></label>&nbsp;<?php echo $korekcija_blizina_os; ?></div>
            </div>
            </div></br>
            <div class='pd'><label></label>&nbsp;<?php echo $pd; ?></div></br>
            <div class='kontrolaPregledao'>
            <div class='kontrolaReport'><label></label>&nbsp;<?php echo $kontrola; ?></div>
            <div class='pregledao'><label></label></div>
            </div>
            <div class='napomenaImeRadnika'>
            <div class='napomenaReport'><label></label>&nbsp;<?php echo $napomena_pregleda; ?></div>
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
            @page { size: A4 portrait !important; margin: 0mm !important; }
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
            <div class='logo'><img id='logo' src='<?php echo logo($idKorisnika); ?>' /></div>
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
            <div class="tonusReport">
            <label>TONUS:</label>&nbsp;
            <label id='labelTonusOdReport'>OD:</label>&nbsp;<?php echo $tonus_od; ?>&nbsp;
            <label id='labelTonusOsReport'>OS:</label>&nbsp;<?php echo $tonus_os; ?></div>
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
      </script>



</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php
include '../pregled/modules/header.php';
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
          <h1 class="h3 mb-4 text-gray-800">Kratki pregled - naočare <i class="fas fa-glasses"></i></h1>
          <div class="row">
            <div class="workersLog">
              <div class="workers">
                <div class="form-group col-md-7">
                  <label><strong>ID radnika:</strong></label>
                  <input name="sifra_radnika" class="form-control" type="password" title="Unesite svoj ID" id="sifra_radnika" autocomplete="off" />
                </div>
              </div>
              <div class="nameWorker">
                <div class="form-group col-md-7">
                  <label>Pregled obavlja:</br></label>
                  <div id="ime_radnika"></div>
                </div>
              </div>
              <div class='lenses'>
                <div class="form-group col-md-7">
                  <button class="btn btn-danger" type="button" onclick="window.location.href='../pregled/addLensesExaminationShortForm.php';"><i class="fas fa-eye"></i>&nbsp;Kratki pregled - kontaktna sočiva</button>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="patientSearch">
              <div class="form-group col-md-10">
                <label for="#search">Pretraga pacijenta</label>&nbsp;<i class="fas fa-search"></i>
                <input name="name" placeholder="npr. Nemanja (Milan) Lazarević 1996" title="Unesite ime,prezime ili godinu rođenja za pretragu pacijenta" type="text" class="form-control" id="search" autocomplete="off" />
              </div>
              <div id="display"></div>
            </div>
            <div class="todayDate">
              <div class="form-group col-md-10">
                <label>Današnji datum</label>
                <input name="datum_pregleda" type="text" class="form-control" id="datum_pregleda" value=<?php echo date("d.m.Y"); ?> disabled>
              </div>
              <input name="id_pacijenta" type="hidden" class="form-control" id="id_pacijenta">
            </div>
            <div class="noteAboutPatient">
              <div class="form-group col-md-10">
                <label for="exampleFormControlSelect2">Podaci o pacijentu:</label>
                <div>
                  <textarea class="form-control" id="ispis_napomene_pacijenta" disabled> </textarea>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="form-group col-md-7">
              <strong> <label id="labelAnamneza">ANAMNEZA:</label></strong>
              <input list="listaAnamneza" name="anamneza" title="Unesite anamnezu" type="text" class="form-control" id="anamneza" autocomplete="off" />
              <datalist id="listaAnamneza">
                <option value="Slabije vidi na daljinu">
                <option value="Slabije vidi na blizinu">
                <option value="Dupla slika">
                <option value="Izobličena slika">
                <option value="Naglo slabi vid">
                <option value="Glavobolja">
                <option value="Očni napor">
                <option value="Bol u oku">
                <option value="Suzenje">
                <option value="Slabije vidi noću">
                <option value="Oko je suvo i svrbi">
              </datalist>
            </div>
          </div>
          <br>
          <div class="row">
            <strong> <label for="exampleFormControlSelect2">VIDNA OŠTRINA</label></strong>
          </div>
          <div class="vidnaOstrina">
            <div class="vidnaOstrina_grupa1">
              <div class="vod1">
                <div class="form-group col-md-5">
                  <label id="label_vod">VOD:</label>
                  <input list="listaVod" name="vod" title="Unesite VOD" type="text" class="form-control" id="vod" autocomplete="off">
                  <datalist id="listaVod">
                    <option value="0.1">
                    <option value="0.2">
                    <option value="0.3">
                    <option value="0.4">
                    <option value="0.5">
                    <option value="0.6">
                    <option value="0.7">
                    <option value="0.8">
                    <option value="0.9">
                    <option value="1.0">
                  </datalist>
                </div>
              </div>
              <div class="vos1">
                <div class="form-group col-md-5">
                  <label id="label_vos">VOS:</label>
                  <input list="listaVos" name="vos" title="Unesite VOS" type="text" class="form-control" id="vos" autocomplete="off">
                  <datalist id="listaVos">
                    <option value="0.1">
                    <option value="0.2">
                    <option value="0.3">
                    <option value="0.4">
                    <option value="0.5">
                    <option value="0.6">
                    <option value="0.7">
                    <option value="0.8">
                    <option value="0.9">
                    <option value="1.0">
                  </datalist>
                </div>
              </div>
            </div>
            <div class="vidnaOstrina_grupa2">
              <div class="sa_cc">
                <label id="sa_cc">sa cc:</label>
              </div>
            </div>
            <div class="vidnaOstrina_grupa3">
              <div class="form-group col-md-12">
                <input name="vod" title="Unesite VOD" type="text" class="form-control" id="vod1" autocomplete="off">
              </div>
              <div class="form-group col-md-12">
                <input name="vos" title="Unesite VOS" type="text" class="form-control" id="vos1" autocomplete="off">
              </div>
            </div>
          </div>
          </br>
          <div class="row">
            <div class="korekcijaDaljina">
              <strong> <label for="exampleFormControlSelect2">DALJINA - korekcija:</label></strong>
              <div class="form-group col-md-7">
                <div class="kor1">
                  <label id="labelKorDaljOd">OD:</label>
                  <input name="korekcija_daljina_od" title="Unesite korekciju daljine OD" type="text" class="form-control" id="korekcija_daljina_od" autocomplete="off">
                </div>
                <div class="kor2">
                  <label id="labelKorDaljOd">OS:</label>
                  <input name="korekcija_daljina_os" title="Unesite korekciju daljine OS" type="text" class="form-control" id="korekcija_daljina_os" autocomplete="off">
                </div>
              </div>
            </div>
            <div class="korekcijaBlizina">
              <strong> <label for="exampleFormControlSelect2">BLIZINA - korekcija:</label></strong>
              <div class="form-group col-md-7">
                <div class="kor3">
                  <label id="labelKorBlizOd">OD:</label>
                  <input name="korekcija_blizina_od" title="Unesite korekciju blizine OD" type="text" class="form-control" id="korekcija_blizina_od" autocomplete="off">
                </div>
                <div class="kor4">
                  <label id="labelKorBlizOs">OS:</label>
                  <input name="korekcija_blizina_os" title="Unesite korekciju blizine OS" type="text" class="form-control" id="korekcija_blizina_os" autocomplete="off">
                </div>
              </div>
            </div>
          </div>
          </br>
          <div class="row">
            <div class="form-group col-md-3">
              <strong><label for="exampleFormControlSelect2">PD:</label> </strong>
              <input name="pd" title="Unesite pupilarnu distancu" type="text" class="form-control" id="pd" autocomplete="off">
            </div>
          </div>
          </br>
          <div class="row">
            <div class="form-group col-md-7">
              <strong><label for="exampleFormControlSelect2">KONTROLA:</label> </strong>
              <input list="listaKontrola" name="kontrola" title="Unesite period za kontrolu" type="text" class="form-control" id="kontrola" autocomplete="off">
              <datalist id="listaKontrola">
                <option>Kontrola za 7 dana</option>
                <option>Kontrola za 1 mjesec</option>
                <option>Kontrola za 3 mjeseca</option>
                <option>Kontrola za 6 mjeseci</option>
                <option>Kontrola za 1 godinu</option>
                <option>Kontrola za 3 godine</option>
                <option>Kontrola po potrebi</option>
              </datalist>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-7">
              <label>Napomena</label>
              <textarea name="napomena_pregleda" class="form-control" type="text" title="Unesite napomenu vezanu za pregled" id="napomena_pregleda" row="9"></textarea>
            </div>
          </div>
          <hr>
          <div class="row">
            <button type='button' onclick="checkFormExamination()" id='dugmeDodajPregled' class='btn btn-success'><i class="fas fa-save"></i>&nbsp;<label class="labelSaveButton">Sačuvaj</label></button>
          </div>
          </br>
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

  <script type="text/javascript">
    //Postavljanje fokusa na polje za unos šifre radnika kada se stranica učita
    document.getElementById('sifra_radnika').focus();

    //Kopiranje dijela teksta iz VOD i VOS i smiještanje u polja za korekciju daljine OD i OS
    $(document).ready(function() {
      $('#vod1').on('change', function(e) {
        var valueVod = document.getElementById('vod1').value;
        $('#korekcija_daljina_od').val(valueVod);
      });
      $('#vos1').on('change', function(e) {
        var valueVos = document.getElementById('vos1').value;
        $('#korekcija_daljina_os').val(valueVos);
      });
    });

    //Traženje imena radnika na osnovu unesenog ID-a
    $(document).ready(function() {
      //Kada se polje promijeni, aktivira se triger koji poziva AJAX metod
      $("#sifra_radnika").on('change', function(e) {
        //Uzima se unesena vrijednost iz polja
        var sifra_radnika = document.getElementById('sifra_radnika').value;
        //Poziva se AJAX
        $.ajax({
          //AJAX metod je POST
          type: "POST",
          //Podaci se šalju prema getWorkersID.php
          url: "getWorkersID.php",
          dataType: "html",
          //Podaci koji se šalju
          data: {
            sifra_radnika: sifra_radnika
          },
          //Ukoliko je pronađena vrijednost, ime radnika se prikazuje u div elementu ime_radnika
          success: function(response) {
            $("#ime_radnika").html(response);
          }
        });
      });
    });
  </script>
</body>

</html>
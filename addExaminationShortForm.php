<!DOCTYPE html>
<html lang="en">

<?php
include '../pregled/modules/header.php';
?>

<!-- Including CSS file. -->
<style>
  .bs-example {
    margin-bottom: 20px;
  }

  .accordion .fas {
    margin-right: 0.5rem;
  }
</style>

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
          <h1 class="h3 mb-4 text-gray-800">Kratki pregled - naočare <i class="fas fa-glasses"></i></h1>
          <div class="row">
            <div class="workersLog">
              <div class="workers">
                <div class="form-group col-md-7">
                  <label><strong>ID radnika:</strong></label>
                  <input name="sifra_radnika" class="form-control" type="password" title="Unesite svoj ID" id="sifra_radnika" />
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
                  <button class="btn btn-danger" type="button" onclick=""><i class="fas fa-eye"></i>&nbsp;Kratki pregled - kontaktna sočiva</button>
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
                <input name="datum_pregleda" title="" type="text" class="form-control" id="datum_pregleda" value=<?php echo date("d.m.Y"); ?>>
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
              <input list="listaAnamneza" name="anamneza" title="" type="text" class="form-control" id="anamneza">
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
                  <input list="listaVod" name="vod" title="" type="text" class="form-control" id="vod">
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
                  <input list="listaVos" name="vos" title="" type="text" class="form-control" id="vos">
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
                <input name="vod" title="" type="text" class="form-control" id="vod1">
              </div>

              <div class="form-group col-md-12">
                <input name="vos" title="" type="text" class="form-control" id="vos1">
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
                  <input name="korekcija_daljina_od" title="" type="text" class="form-control" id="korekcija_daljina_od">
                </div>
                <div class="kor2">
                  <label id="labelKorDaljOd">OS:</label>
                  <input name="korekcija_daljina_os" title="" type="text" class="form-control" id="korekcija_daljina_os">
                </div>
              </div>
            </div>

            <div class="korekcijaBlizina">
              <strong> <label for="exampleFormControlSelect2">BLIZINA - korekcija:</label></strong>
              <div class="form-group col-md-7">
                <div class="kor3">
                  <label id="labelKorBlizOd">OD:</label>
                  <input name="korekcija_blizina_od" title="" type="text" class="form-control" id="korekcija_blizina_od">
                </div>
                <div class="kor4">
                  <label id="labelKorBlizOs">OS:</label>
                  <input name="korekcija_blizina_os" title="" type="text" class="form-control" id="korekcija_blizina_os">
                </div>
              </div>
            </div>
          </div>
          </br>
          <div class="row">
            <div class="form-group col-md-3">
              <strong><label for="exampleFormControlSelect2">PD:</label> </strong>
              <input name="pd" title="" type="text" class="form-control" id="pd">
            </div>
          </div>
          </br>

          <div class="row">
            <div class="form-group col-md-7">
              <strong><label for="exampleFormControlSelect2">KONTROLA:</label> </strong>
              <input list="listaKontrola" name="kontrola" title="" type="text" class="form-control" id="kontrola">
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
    //When page load set focus on field
    document.getElementById('sifra_radnika').focus();

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

    $(document).ready(function() {
      $("#sifra_radnika").on('change', function(e) {
        var sifra_radnika = document.getElementById('sifra_radnika').value;
        $.ajax({ //create an ajax request to display.php
          type: "POST",
          url: "getWorkersID.php",
          dataType: "html", //expect html to be returned 
          data: {
            sifra_radnika: sifra_radnika
          },
          success: function(response) {
            $("#ime_radnika").html(response);
          }
        });
      });
    });
  </script>





</body>

</html>
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
          <h1 class="h3 mb-4 text-gray-800">Radni nalog <i class="fas fa-clipboard-list"></i></i></h1>
          <div class="row">
            <div class="form-group col-md-8">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="naocare_rb" checked>
                <label class="form-check-label" for="naocare_rb">
                  Naočare
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="sociva_rb">
                <label class="form-check-label" for="sociva_rb">
                  Kontaktna sočiva
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="workersLog">
              <div class="workers">
                <div class="form-group col-md-8">
                  <label>Broj radnog naloga <strong>(№) </strong></label>
                  <input name="broj_radnog_naloga" maxlength='8' class="form-control" type="text" title="Unesite broj radnog naloga" id="broj_radnog_naloga" placeholder="" autocomplete="off" />
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="patientSearch">
              <div class="form-group col-md-10">
                <label for="#search">Pretraga klijenta</label>&nbsp;<i class="fas fa-search"></i>
                <input name="name" placeholder="npr. Nemanja (Milan) Lazarević 1996" title="Unesite ime,prezime ili godinu rođenja za pretragu klijenta" type="text" class="form-control" id="search" autocomplete="off" />
              </div>
              <div id="display"></div>
            </div>
            <div class="todayDate">
              <div class="form-group col-md-10">
                <label>Datum</label>
                <input id="datum" name="datum" maxlength='10' placeholder="DD.MM.YYYY" title="Unesite datum u formatu dam.mjesec.godina" />
                <script>
                  $('#datum').datepicker({
                    format: 'dd.mm.yyyy',
                    uiLibrary: 'bootstrap4'
                  });
                </script>
              </div>
              <input name="id_pacijenta" type="hidden" class="form-control" id="id_pacijenta">
            </div>
          </div>
          <hr>
          </br>
          <div class="row">
            <div class="korekcijaBlizina">
              <strong> <label for="exampleFormControlSelect2">OKO DESNO</label></strong>
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
                      <td><input name="desno_d_sph" maxlength='25' id="desno_d_sph" type="text" class="form-control" autocomplete="off"></td>
                      <td><input name="desno_d_cyl" maxlength='25' id="desno_d_cyl" type="text" class="form-control" autocomplete="off"></td>
                      <td><input name="desno_d_ax" maxlength='25' id="desno_d_ax" type="text" class="form-control" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <th scope="row">B</th>
                      <td><input name="desno_b_sph" maxlength='25' id="desno_b_sph" type="text" class="form-control" autocomplete="off"></td>
                      <td><input name="desno_b_cyl" maxlength='25' id="desno_b_cyl" type="text" class="form-control" autocomplete="off"></td>
                      <td><input name="desno_b_ax" maxlength='25' id="desno_b_ax" type="text" class="form-control" autocomplete="off"></td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="form-group col-md-5">
                    <label for="exampleFormControlSelect2">PD blizina u mm</label>
                    <input name="pd_blizina" maxlength='15' id="pd_blizina" title="Unesite pupilarnu distancu" type="text" class="form-control" autocomplete="off">
                  </div>
                </div>
              </div>
            </div>
            <div class="korekcijaDaljina">
              <strong> <label for="exampleFormControlSelect2">OKO LIJEVO</label></strong>
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
                      <td><input name="lijevo_d_sph" maxlength='25' id="lijevo_d_sph" type="text" class="form-control" autocomplete="off"></td>
                      <td><input name="lijevo_d_cyl" maxlength='25' id="lijevo_d_cyl" type="text" class="form-control" autocomplete="off"></td>
                      <td><input name="lijevo_d_ax" maxlength='25' id="lijevo_d_ax" type="text" class="form-control" autocomplete="off"></td>
                    </tr>
                    <tr>
                      <th scope="row">B</th>
                      <td><input name="lijevo_b_sph" maxlength='25' id="lijevo_b_sph" type="text" class="form-control" autocomplete="off"></td>
                      <td><input name="lijevo_b_cyl" maxlength='25' id="lijevo_b_cyl" type="text" class="form-control" autocomplete="off"></td>
                      <td><input name="lijevo_b_ax" maxlength='25' id="lijevo_b_ax" type="text" class="form-control" autocomplete="off"></td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  <div class="form-group col-md-5">
                    <label for="exampleFormControlSelect2">PD daljina u mm</label>
                    <input name="pd_daljina" maxlength='15' id="pd_daljina" title="Unesite pupilarnu distancu" type="text" class="form-control" autocomplete="off">
                  </div>
                </div>
              </div>
            </div>
          </div>
          </br>
          <div class="row">
            <div class="form-group col-md-10">
              <label>Napomena</label>
              <textarea name="napomena" placeholder="Upisati sve bitne stvari, ugrađena stakla, tretmane, dodatne usluge itd..." class="form-control" type="text" title="Unesite napomenu" id="napomena" row="9" style="height:100%;"></textarea>
            </div>
          </div>
          </br>
          </br>
          <div class="row">
            <div class="placanje">
              <div class="placanje_napomena">
                <div class="form-group col-md-12">
                  <input name="ukupno" class="form-control" type="text" title="Unesite ukupan iznos" id="ukupno">
                </div>
                <div class="form-group col-md-12">
                  <input name="akontacija" class="form-control" type="text" title="Unesite iznos akontacije" id="akontacija">
                </div>
                <div class="form-group col-md-12">
                  <input name="dug" class="form-control" type="text" title="Unesite iznos duga" id="dug">
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
          <hr>
          <div class="row">
            <button type='button' onclick="checkWorkOrderDocument()" id='dugmeDodajPregled' class='btn btn-success'><i class="fas fa-save"></i>&nbsp;<label class="labelSaveButton">Sačuvaj</label></button>
          </div>
          </br>
        </div>
      </div>
      <?php
      if (isset($_REQUEST['msg'])) {
        if ($_REQUEST['msg'] == '1') {
          echo "<script src=\"js/alertify.min.js\"></script>";
          echo "<script type=\"text/javascript\"> alertify.error('Greška! Pokušajte ponovo kreirati radni nalog');</script>";
          echo "<script type=\"text/javascript\">window.history.replaceState(null, null, window.location.pathname);</script>";
        } else if ($_REQUEST['msg'] == '0') {
          echo "<script src=\"js/alertify.min.js\"></script>";
          echo "<script type=\"text/javascript\">alertify.success('Radni nalog je kreiran');</script>";
          echo "<script type=\"text/javascript\">window.history.replaceState(null, null, window.location.pathname);</script>";
        }
      }
      ?>
      <!-- Footer -->
      <?php
      include '../pregled/modules/footer.php';
      ?>
      <!-- End of Footer -->

      <!-- /.container-fluid -->
    </div>
  </div>
</body>

<script type="text/javascript">
  //When page load set focus on field
  document.getElementById('broj_radnog_naloga').focus();

  //Copy text
  $(document).ready(function() {
    $('#akontacija').on('change', function(e) {
      var debt = (document.getElementById('ukupno').value) - (document.getElementById('akontacija').value);
      $('#dug').val(parseFloat(debt, 3));
    });
  });
</script>

</html>
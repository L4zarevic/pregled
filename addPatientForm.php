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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ulogovani ste kao <b>
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
          <h1 class="h3 mb-4 text-gray-800">Dodaj novog pacijenta</h1>
          <div class="generalijePacijenta">
            <div class='generalije1'>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="exampleFormControlSelect2">Ime </label><label class="obavezna_polja">*</label>
                  <input name="ime_pacijenta" placeholder="Unesite ime pacijenta" title="Unesite ime pacijenta" type="text" class="form-control" id="ime_pacijenta">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="exampleFormControlSelect2">Ime oca</label><label class="obavezna_polja">*</label>
                  <input name="ime_oca_pacijenta" placeholder="Unesite ime oca pacijenta" title="Unesite ime oca pacijenta" type="text" class="form-control" id="ime_oca_pacijenta">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="exampleFormControlSelect2">Prezime</label><label class="obavezna_polja" >*</label>
                  <input name="prezime_pacijenta" placeholder="Unesite prezime pacijenta" title="Unesite prezime pacijenta" type="text" class="form-control" id="prezime_pacijenta">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="exampleFormControlSelect2">Godina rođenja</label><label class="obavezna_polja">*</label>
                  <input name="godiste_pacijenta" placeholder="Unesite godinu rođenja pacijenta" title="Unesite godinu rođenja pacijenta" type="text" class="form-control" id="godiste_pacijenta">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="exampleFormControlSelect2">Kontakt</label><label class="obavezna_polja">*</label>
                  <input name="kontakt_pacijenta" placeholder="Unesite kontakt pacijenta" title="Unesite kontakt podatak pacijenta (telefon ili email)" type="text" class="form-control" id="kontakt_pacijenta">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="exampleFormControlSelect2">Napomena</label>
                  <textarea name="napomena_pacijenta" placeholder="Unesite napomenu vezanu za pacijenta" class="form-control" type="text" title="Unesite napomenu vezanu za pacijenta" id="napomena_pacijenta" row="4"></textarea>
                </div>

              </div>

            </div>
            <div class='generalije2'>
              <div class="row">
                <div class="form-group col-md-11">
                  <label for="exampleFormControlSelect2"><strong><u>Naočare - postojeće</u></strong></label>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-11">
                  <label for="exampleFormControlSelect2">Daljina: </label>
                  &nbsp; <label for="exampleFormControlSelect2">OD: </label>
                  <input name="naocare_daljina_od" title="" type="text" class="form-control" id="naocare_daljina_od">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-11">
                  <label for="exampleFormControlSelect2"></label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label id="daljinaOS" for="exampleFormControlSelect2">OS:</label>
                  <input name="naocare_daljina_os" type="text" class="form-control" id="naocare_daljina_os">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-11">
                  <label for="exampleFormControlSelect2">Blizina: </label>
                  &nbsp; <label for="exampleFormControlSelect2">OD: </label>
                  <input name="naocare_blizina_od" title="" type="text" class="form-control" id="naocare_blizina_od">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-11">
                  <label for="exampleFormControlSelect2"></label>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label id="blizinaOS" for="exampleFormControlSelect2">OS:</label>
                  <input name="naocare_blizina_os" title="" type="text" class="form-control" id="naocare_blizina_os">
                </div>
              </div>




              <div class="row">
                <div class="form-group col-md-11">
                  <label for="exampleFormControlSelect2"><strong><u>Kontaktna sočiva:</u></strong></label>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-11">
                  <label for="exampleFormControlSelect2">OD: </label>
                  <input name="sociva_od" title="" type="text" class="form-control" id="sociva_od">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-11">
                  <label id="blizinaOS" for="exampleFormControlSelect2">OS: </label>
                  <input name="sociva_os" title="" type="text" class="form-control" id="sociva_os">
                </div>
              </div>
              <hr>
              <button type='button' onclick="addPatientCheckForm()" id="dodajNovogPacijenta" title="Kreiraj karton pacijenta" class='btn btn-success'><i class="fas fa-save"></i>&nbsp;<label class="labelSaveButton">Sačuvaj pacijenta</label></button>
            </div>
            <label class="obavezna_polja">* Obavezna polja za unos</label>
          </div>

          <?php
          if (isset($_REQUEST['msg'])) {
            if ($_REQUEST['msg'] == '1') {
              echo "<script src=\"js/alertify.min.js\"></script>";
              echo "<script type=\"text/javascript\"> alertify.error('Greška prilikom sačuvavanja');</script>";
              echo "<script type=\"text/javascript\">window.history.replaceState(null, null, window.location.pathname);</script>";
            } else if ($_REQUEST['msg'] == '0') {
              echo "<script src=\"js/alertify.min.js\"></script>";
              echo "<script type=\"text/javascript\">alertify.success('Pacijent je dodat u bazu');</script>";
              echo "<script type=\"text/javascript\">window.history.replaceState(null, null, window.location.pathname);</script>";
            }
          }
          ?>

          <!-- /.container-fluid -->
        </div>

      </div> <!-- Footer -->
      <?php
      include '../pregled/modules/footer.php';
      ?>
      <!-- End of Footer -->

</body>

</html>
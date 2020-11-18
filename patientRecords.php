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

          <h1 class="h3 mb-4 text-gray-800">Karton pacijenta</h1>



          <div class="row">
            <div class="records">
              <div class="examinationHistory">

                <div class="form-group col-md-7">
                  <label>Pretraga pacijenta</label>&nbsp;<i class="fas fa-search"></i>
                  <input name="name" placeholder="npr. Nemanja (Milan) Lazarević 1996" title="Unesite ime,prezime ili godinu rođenja za pretragu pacijenta" type="text" class="form-control" id="search">
                </div>
                <div class="form-group col-md-2">
                  <input name="id_pacijenta" type="hidden" class="form-control" id="id_pacijenta">
                </div>
                <div id="display"></div>
                <div id="responsecontainer"></div>
              </div>
              <div class="patientGenerals">
                <h5 id="secondTitle" class="h5 mb-4 text-gray-800">Podaci o pacijentu</h5>

                <div class="form-group col-md-8">
                  <label>Ime (Ime oca) prezime, godina rođenja:</label>
                  <input name="patientGeneralsRecords" type="text" class="form-control" id="patientGeneralsRecords">
                </div>
                <div class="form-group col-md-5">
                  <label>Kontakt:</label>
                  <input name="contactPatientRecords" type="text" class="form-control" id="contactPatientRecords">
                </div>
                <div class="form-group col-md-8">
                  <label>Napomena:</label>
                  <input name="notePatientRecords" type="text" class="form-control" id="notePatientRecords">
                </div>
                <hr>
                <button type='button' onclick="updatePatientCheckForm()" id="updatePatient" title="Uredi karton pacijenta" class='btn btn-success'><i class="fas fa-edit"></i>&nbsp;<label class="labelSaveButton">Uredi pacijenta</label></button>
              </div>
            </div>
          </div>

          <?php
          if (isset($_REQUEST['msg'])) {
            if ($_REQUEST['msg'] == '1') {
              echo "<script src=\"js/alertify.min.js\"></script>";
              echo "<script type=\"text/javascript\"> alertify.error('Greška prilikom ažuriranja');</script>";
              echo "<script type=\"text/javascript\">window.history.replaceState(null, null, window.location.pathname);</script>";
            } else if ($_REQUEST['msg'] == '0') {
              echo "<script src=\"js/alertify.min.js\"></script>";
              echo "<script type=\"text/javascript\">alertify.success('Podaci o pacijentu su ažurirani');</script>";
              echo "<script type=\"text/javascript\">window.history.replaceState(null, null, window.location.pathname);</script>";
            }
          }
          ?>


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


  <script>
    document.getElementById('search').focus();
  </script>





</body>

</html>
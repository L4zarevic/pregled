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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ulogovani ste kao <b><?php echo $imeKorisnika; ?></b> <i class="fas fa-user"></i></span>
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

          <div class='tabelaSpecijala1'>
            <form action="../pregled/addPatientDB.php">
              <div class="rowSpec">
                <div class="form-group col-md-3">
                  <label for="exampleFormControlSelect2">Ime </label>
                  <input name="imePacijenta" title="Unesite ime pacijenta" type="text" class="form-control" id="imePacijenta" required>
                </div>
              </div>

              <div class="rowSpec">
                <div class="form-group col-md-3">
                  <label for="exampleFormControlSelect2">Prezime</label>
                  <input name="prezimePacijenta" title="Unesite prezime pacijenta" type="text" class="form-control" id="prezimePacijenta" required>
                </div>
              </div>

              <div class="rowSpec">
                <div class="form-group col-md-3">
                  <label for="exampleFormControlSelect2">Godina rođenja</label>
                  <input name="godistePacijenta" title="Unesite godinu rođenja pacijenta" type="text" class="form-control" id="godištePacijenta" required>
                </div>
              </div>

              <div class="rowSpec">
                <div class="form-group col-md-3">
                  <label for="exampleFormControlSelect2">Kontakt</label>
                  <input name="kontaktPacijenta" title="Unesite kontakt podatak pacijenta (telefon ili email)" type="text" class="form-control" id="kontaktPacijenta">
                </div>
              </div>

              <div class="rowSpec">
                <div class="form-group col-md-3">
                  <label for="exampleFormControlSelect2">Napomena</label>
                  <textarea name="napomenaPacijenta" class="form-control" type="text" title="Unesite napomenu vezanu za pacijenta" id="napomenaPacijenta" row="4"></textarea>
                </div>
              </div>


              <button type='submit' onclick="" id='dugmeDodaj' class='btn btn-success'>Sačuvaj</button>
            </form>

          </div>




          <!-- /.container-fluid -->
        </div>

      </div <!-- Footer -->
      <?php
      include '../pregled/modules/footer.php';
      ?>
      <!-- End of Footer -->

  

</body>

</html>
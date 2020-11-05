<!DOCTYPE html>
<html lang="en">

<?php
include '../pregled/modules/header.php';
?>

<!-- Including CSS file. -->


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
          <h1 class="h3 mb-4 text-gray-800">Pregled</h1>

          <div class='tabelaSpecijala1'>

            <div class="rowSpec">
              <div class="form-group col-md-3">
                <label for="exampleFormControlSelect2">Pretraga pacijenta</label>
                <input name="name" title="Unesite ime,prezime ili godinu rođenja za pretragu pacijenta" type="text" class="form-control" id="search">
              </div>
            </div>
            <div id="display"></div>

            <div class="rowSpec">
              <div class="form-group col-md-3">
                <label for="exampleFormControlSelect2">Datum</label>
                <input name="datum" title="" type="text" class="form-control" id="datum" value=<?php echo date("d.m.Y"); ?> disabled>
              </div>
            </div>

            <div class="rowSpec">
              <label for="exampleFormControlSelect2">ANAMNEZA</label>
            </div>

            <!-- Default unchecked -->
            <div class="amannezaGrupa1">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="a1">
                <label class="custom-control-label" for="a1">Slabije vidi na daljinu</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="a2">
                <label class="custom-control-label" for="a2">Slabije vidi na blizinu</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="a3">
                <label class="custom-control-label" for="a3">Dupla slika</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="a4">
                <label class="custom-control-label" for="a4">Izobličena slika</label>
              </div>
            </div>

            <div class="amannezaGrupa2">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="a5">
              <label class="custom-control-label" for="a5">Naglo slabi vid</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="a6">
              <label class="custom-control-label" for="a6">Glavobolja</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="a7">
              <label class="custom-control-label" for="a7">Očni napor</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="a8">
              <label class="custom-control-label" for="a8">Bol u oku</label>
            </div>
         </div>

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="a9">
              <label class="custom-control-label" for="a9">Suzenje</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="a10">
              <label class="custom-control-label" for="a10">Slabije vidi noću</label>
            </div>

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="a11">
              <label class="custom-control-label" for="a11">Oko je suvo i svrbi</label>
            </div>
            <div class="rowSpec">
              </br>
            </div>

            <div class="rowSpec">
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect2">VOD</label>
                <input name="datum" title="" type="text" class="form-control" id="vod">
              </div>
            </div>

            <div class="rowSpec">
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect2">VOS</label>
                <input name="datum" title="" type="text" class="form-control" id="vos">
              </div>
            </div>

            <div class="rowSpec">
              <div class="form-group col-md-4">
                <label for="exampleFormControlSelect2">Motelitet</label>
                <input list="motilitet" name="motelitet" title="" type="text" class="form-control" id="motelitet">
                <datalist id="motilitet">
                  <option value="Nalaz uredan">
                </datalist>

              </div>
            </div>

            <div class="rowSpec">
              <label for="exampleFormControlSelect2">BMS:</label>
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect2">OD:</label>
                <input name="bms_od" title="" type="text" class="form-control" id="bms_od">

                <label for="exampleFormControlSelect2">OS:</label>
                <input name="bms_os" title="" type="text" class="form-control" id="bms_os">
              </div>
            </div>

            <div class="rowSpec">
              <label for="exampleFormControlSelect2">TONUS:</label>
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect2">OD:</label>
                <input name="tonus_od" title="" type="text" class="form-control" id="tonus_od">

                <label for="exampleFormControlSelect2">OS:</label>
                <input name="tonus_os" title="" type="text" class="form-control" id="tonus_os">
              </div>
            </div>

            <div class="rowSpec">
              <label for="exampleFormControlSelect2">FUNDUS:</label>
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect2">OD:</label>
                <input name="fundus_od" title="" type="text" class="form-control" id="fundus_od">

                <label for="exampleFormControlSelect2">OS:</label>
                <input name="fundus_os" title="" type="text" class="form-control" id="fundus_os">
              </div>
            </div>

            <div class="rowSpec">
              <label for="exampleFormControlSelect2">DIJAGNOZA:</label>
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect2">OD:</label>
                <input name="dijagnoza_od" title="" type="text" class="form-control" id="dijagnoza_od">

                <label for="exampleFormControlSelect2">OS:</label>
                <input name="dijagnoza_os" title="" type="text" class="form-control" id="dijagnoza_os">
              </div>
            </div>

            <div class="rowSpec">
              <label for="exampleFormControlSelect2">KOREKCIJA:</label>
              <div class="form-group col-md-6">
                <label for="exampleFormControlSelect2">OD:</label>
                <input name="korekcija_od" title="" type="text" class="form-control" id="korekcija_od">

                <label for="exampleFormControlSelect2">OS:</label>
                <input name="korekcija_os" title="" type="text" class="form-control" id="korekcija_os">
              </div>
            </div>

            <hr>

            <div class="rowSpec">
              <label for="exampleFormControlSelect2">KOREKCIJA (kon. sočiva):</label>
              <div class="form-group col-md-2">
                <label for="exampleFormControlSelect2">OD:</label>
                <label for="exampleFormControlSelect2">Tip/vrsta:</label>
                <input name="tip_ks_od" title="" type="text" class="form-control" id="tip_ks_od">

                <label for="exampleFormControlSelect2">Jačina:</label>
                <input name="jacina_ks_od" title="" type="text" class="form-control" id="jacina_ks_od">

                <label for="exampleFormControlSelect2">BC:</label>
                <input name="bc_ks_od" title="" type="text" class="form-control" id="bc_ks_od">

                <label for="exampleFormControlSelect2">Veličina:</label>
                <input name="velicina_ks_od" title="" type="text" class="form-control" id="velicina_ks_od">

                <label for="exampleFormControlSelect2">Boja:</label>
                <input name="boja_ks_od" title="" type="text" class="form-control" id="boja_ks_od">

                <label for="exampleFormControlSelect2">OS:</label>
                <label for="exampleFormControlSelect2">Tip/vrsta:</label>
                <input name="tip_ks_os" title="" type="text" class="form-control" id="tip_ks_os">

                <label for="exampleFormControlSelect2">Jačina:</label>
                <input name="jacina_ks_os" title="" type="text" class="form-control" id="jacina_ks_os">

                <label for="exampleFormControlSelect2">BC:</label>
                <input name="bc_ks_os" title="" type="text" class="form-control" id="bc_ks_os">

                <label for="exampleFormControlSelect2">Veličina:</label>
                <input name="velicina_ks_os" title="" type="text" class="form-control" id="velicina_ks_os">

                <label for="exampleFormControlSelect2">Boja:</label>
                <input name="boja_ks_os" title="" type="text" class="form-control" id="boja_ks_os">

              </div>
            </div>
            <hr>


            <div class="rowSpec">
              <div class="form-group col-md-2">
                <label for="exampleFormControlSelect2">PD:</label>
                <input name="pd" title="" type="text" class="form-control" id="pd">
              </div>
            </div>

            <div class="rowSpec">
              <div class="form-group col-md-3">
                <label for="exampleFormControlSelect2">KONTROLA:</label>
                <input name="kontrola" title="" type="text" class="form-control" id="kontrola">
              </div>
            </div>

            <div class="rowSpec">
              <div class="form-group col-md-8">
                <label for="exampleFormControlSelect2">Napomena</label>
                <textarea name="napomenaPregled" class="form-control" type="text" title="Unesite napomenu vezanu za pregled" id="napomenaPregleda" row="8"></textarea>
              </div>
            </div>
          </div>

        </div>

        <!-- /.container-fluid -->
      </div>
      <hr>
      <hr>
    </div>

  </div> <!-- Footer -->
  <?php
  include '../pregled/modules/footer.php';
  ?>
  <!-- End of Footer -->
  <script type="text/javascript" src="../pregled/scripts.js"></script>



</body>

</html>
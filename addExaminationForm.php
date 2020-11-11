<!DOCTYPE html>
<html lang="en">

<?php
include '../pregled/modules/header.php';
?>


<!-- Including CSS file. -->
<style>
  .bs-example {
    margin: 20px;
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



          <div class="row">
            <div class="form-group col-md-3">
              <label for="exampleFormControlSelect2">Pretraga pacijenta</label>
              <input name="name" title="Unesite ime,prezime ili godinu rođenja za pretragu pacijenta" type="text" class="form-control" id="search">
            </div>

            <div class="form-group col-md-2">
              <label for="exampleFormControlSelect2">Današnji datum</label>
              <input name="datum_pregleda" title="" type="text" class="form-control" id="datum_pregleda" value=<?php echo date("d.m.Y"); ?> disabled>
            </div>
            <div class="form-group col-md-1">
              <input name="id_pacijenta" type="hidden" class="form-control" id="id_pacijenta">
            </div>
            <div class="form-group col-md-4">
              <label for="exampleFormControlSelect2">Napomena o pacijentu:</label>
              <div>
                <input class="form-control" id="ispis_napomene_pacijenta">
              </div>
            </div>
          </div>

          <div id="display"></div>


          <div class="row">
            <strong> <label for="exampleFormControlSelect2">ANAMNEZA</label></strong>
          </div>

          <!-- Default unchecked -->
          <div class="row1">
            <div class="form-group col-md-8">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a1" class="custom-control-input" id="a1" value="Slabije vidi na daljinu">
                <label class="custom-control-label" for="a1">Slabije vidi na daljinu</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a2" class="custom-control-input" id="a2" value="Slabije vidi na blizinu">
                <label class="custom-control-label" for="a2">Slabije vidi na blizinu</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a3" class="custom-control-input" id="a3" value="Dupla slika">
                <label class="custom-control-label" for="a3">Dupla slika</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a4" class="custom-control-input" id="a4" value="Izobličena slika">
                <label class="custom-control-label" for="a4">Izobličena slika</label>
              </div>
            </div>
          </div>


          <div class="row2">
            <div class="form-group col-md-8">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a5" class="custom-control-input" id="a5" value="Naglo slabi vid">
                <label class="custom-control-label" for="a5">Naglo slabi vid</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a6" class="custom-control-input" id="a6" value="Glavobolja">
                <label class="custom-control-label" for="a6">Glavobolja</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a7" class="custom-control-input" id="a7" value="Očni napor">
                <label class="custom-control-label" for="a7">Očni napor</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a8" class="custom-control-input" id="a8" value="Bol u oku">
                <label class="custom-control-label" for="a8">Bol u oku</label>
              </div>
            </div>
          </div>


          <div class="row3">
            <div class="form-group col-md-8">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a9" class="custom-control-input" id="a9" value="Suzenje">
                <label class="custom-control-label" for="a9">Suzenje</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a10" class="custom-control-input" id="a10" value="Slabije vidi noću">
                <label class="custom-control-label" for="a10">Slabije vidi noću</label>
              </div>

              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="a11" class="custom-control-input" id="a11" value="Oko je suvo i svrbi">
                <label class="custom-control-label" for="a11">Oko je suvo i svrbi</label>
              </div>
            </div>
          </div>



          <div class="row">
            <div class="form-group col-md-6">
              <strong><label for="exampleFormControlSelect2">VOD:</label></strong>
              <input name="vod" title="" type="text" class="form-control" id="vod">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <strong><label for="exampleFormControlSelect2">VOS:</label> </strong>
              <input name="vos" title="" type="text" class="form-control" id="vos">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-7">
              <strong><label for="exampleFormControlSelect2">MOTELITET:</label> </strong>
              <input list="motilitet2" name="motilitet" title="" type="text" class="form-control" id="motilitet">
              <datalist id="motilitet2">
                <option value="Nalaz uredan">
              </datalist>
            </div>
          </div>

          <div class="row">
            <strong><label for="exampleFormControlSelect2">BMS:</label></strong>
          </div>
          <div class="row">
            <div class="form-group col-md-6">

              <label for="exampleFormControlSelect2">OD:</label>
              <input name="bms_od" title="" type="text" class="form-control" id="bms_od">

              <label id="bms_os_label" for="exampleFormControlSelect2">OS:</label>
              <input name="bms_os" title="" type="text" class="form-control" id="bms_os">
            </div>
          </div>

          <div class="row">
            <strong><label for="exampleFormControlSelect2">TONUS:</label></strong>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="exampleFormControlSelect2">OD:</label>
              <input name="tonus_od" title="" type="text" class="form-control" id="tonus_od">

              <label for="exampleFormControlSelect2">OS:</label>
              <input name="tonus_os" title="" type="text" class="form-control" id="tonus_os">
            </div>
          </div>

          <div class="row">
            <strong><label for="exampleFormControlSelect2">FUNDUS:</label></strong>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="exampleFormControlSelect2">OD:</label>
              <input name="fundus_od" title="" type="text" class="form-control" id="fundus_od">

              <label for="exampleFormControlSelect2">OS:</label>
              <input name="fundus_os" title="" type="text" class="form-control" id="fundus_os">
            </div>
          </div>

          <div class="row">
            <strong><label for="exampleFormControlSelect2">DIJAGNOZA:</label>
            </strong>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="exampleFormControlSelect2">OD:</label>
              <input name="dijagnoza_od" title="" type="text" class="form-control" id="dijagnoza_od">

              <label for="exampleFormControlSelect2">OS:</label>
              <input name="dijagnoza_os" title="" type="text" class="form-control" id="dijagnoza_os">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <strong><label for="exampleFormControlSelect2">TERAPIJA:</label> </strong>
              <input name="terapija" title="" type="text" class="form-control" id="terapija">
            </div>
          </div>

          <div class="row">
            <strong> <label for="exampleFormControlSelect2">KOREKCIJA:</label></strong>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="exampleFormControlSelect2">OD:</label>
              <input name="korekcija_od" title="" type="text" class="form-control" id="korekcija_od">

              <label for="exampleFormControlSelect2">OS:</label>
              <input name="korekcija_os" title="" type="text" class="form-control" id="korekcija_os">
            </div>
          </div>

          <hr>

          <div class="bs-example">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fas fa-plus"></i>Pregled kontaktna sočiva</button>
                  </h2>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="row">
                      <strong> <label for="exampleFormControlSelect2">KOREKCIJA (kon. sočiva):</label></strong>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-8">
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
                  </div>
                </div>
              </div>
            </div>
          </div>



          <hr>


          <div class="row">
            <div class="form-group col-md-3">
              <strong><label for="exampleFormControlSelect2">PD:</label> </strong>
              <input name="pd" title="" type="text" class="form-control" id="pd">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-8">
              <strong><label for="exampleFormControlSelect2">KONTROLA:</label> </strong>
              <input name="kontrola" title="" type="text" class="form-control" id="kontrola">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-7">
              <label for="exampleFormControlSelect2">Napomena</label>
              <textarea name="napomena_pregleda" class="form-control" type="text" title="Unesite napomenu vezanu za pregled" id="napomena_pregleda" row="9"></textarea>
            </div>
          </div>
          <div class="row">
            <button type='button' onclick="checkFormExamination()" id='dugmeDodaj' class='btn btn-success'><i class="fas fa-save"></i>&nbsp;<label class="labelSaveButton">Sačuvaj</label></button>
          </div>
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
    $(document).ready(function() {
      // Add minus icon for collapse element which is open by default
      $(".collapse.show").each(function() {
        $(this).prev(".card-header").find(".fas").addClass("fa-minus").removeClass("fa-plus");
      });

      // Toggle plus minus icon on show hide of collapse element
      $(".collapse").on('show.bs.collapse', function() {
        $(this).prev(".card-header").find(".fas").removeClass("fa-plus").addClass("fa-minus");
      }).on('hide.bs.collapse', function() {
        $(this).prev(".card-header").find(".fas").removeClass("fa-minus").addClass("fa-plus");
      });
    });
  </script>
  <script type="text/javascript" src="../pregled/scripts.js"></script>




</body>

</html>
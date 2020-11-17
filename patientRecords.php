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
          <h1 class="h3 mb-4 text-gray-800">Karton pacijenta</h1>



          <div class="row">
            <div class="form-group col-md-3">
              <label for="exampleFormControlSelect2">Pretraga pacijenta</label>
              <input name="name" title="Unesite ime,prezime ili godinu rođenja za pretragu pacijenta" type="text" class="form-control" id="search">
            </div>

            <div class="form-group col-md-2">
              <input name="id_pacijenta" type="hidden" class="form-control" id="id_pacijenta">
            </div>

          </div>

          <div id="display"></div>
          <div id="responsecontainer"></div>
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
    // document.getElementById("id_pacijenta").addEventListener("input", getPatientRecord());
    // function getPatientRecords() {
    //   var id_pacijenta = id_pacijenta = $('input[name="id_pacijenta"]').val();
    //   document.getElementById("demo").innerHTML = "You wrote: " + id_pacijenta;
    // }
    // window.onload = function() {
    //   /* event listener */
    //   document.getElementsByName("id_pacijenta")[].addEventListener('change', doThing);

    //   /* function */
    //   function doThing() {
    //     alert('Horray! Someone wrote "' + this.value + '"!');
    //   }
    // }

    // $(document).ready(function() {
    //   $("#search").on('change', function() {
    //     $.ajax({ //create an ajax request to display.php
    //       type: "POST",
    //       url: "datePatientRecord.php",
    //       dataType: "html", //expect html to be returned    
    //       success: function(response) {
    //         $("#responsecontainer").html(response);
    //       }
    //     });
    //   });
    // });
  </script>





</body>

</html>
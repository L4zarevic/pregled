<!DOCTYPE html>
<html lang="en">
<?php include '../pregled/modules/header.php';

require_once 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$idKorisnika = $ar[0];
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");


function sumExamination($conn, $idKorisnika)
{
    $sql = "SELECT COUNT(ID) AS brojPregleda FROM pregledi WHERE ID_korisnika='$idKorisnika'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_object($result)) {
        echo $row->brojPregleda;
    }
}

function sumGlassesExamination($conn, $idKorisnika)
{
    $sql = "SELECT COUNT(ID) AS brojPregleda FROM pregledi WHERE ID_korisnika='$idKorisnika' AND vrsta_pregleda='naocare'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_object($result)) {
        echo $row->brojPregleda;
    }
}

function sumLensesExamination($conn, $idKorisnika)
{
    $sql = "SELECT COUNT(ID) AS brojPregleda FROM pregledi WHERE ID_korisnika='$idKorisnika' AND vrsta_pregleda='sociva'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_object($result)) {
        echo $row->brojPregleda;
    }
}

function sumMonthsExamination($conn, $idKorisnika)
{
    $todayDate = date("Y-m-d");
    $dateSplit = explode("-", $todayDate, 3);
    $dateSplit[1] = rtrim($dateSplit[1], "-");
    $startDate = $dateSplit[0] . "-" . $dateSplit[1] . "-01";
    $sql = "SELECT COUNT(ID) AS brojPregleda FROM pregledi WHERE datum_pregleda BETWEEN '$startDate' AND '$todayDate' AND ID_korisnika='$idKorisnika'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_object($result)) {
        echo $row->brojPregleda;
    }
}

function sumGlassesMonthsExamination($conn, $idKorisnika)
{
    $todayDate = date("Y-m-d");
    $dateSplit = explode("-", $todayDate, 3);
    $dateSplit[1] = rtrim($dateSplit[1], "-");
    $startDate = $dateSplit[0] . "-" . $dateSplit[1] . "-01";
    $sql = "SELECT COUNT(ID) AS brojPregleda FROM pregledi WHERE datum_pregleda BETWEEN '$startDate' AND '$todayDate' AND ID_korisnika='$idKorisnika' AND vrsta_pregleda ='naocare'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_object($result)) {
        echo $row->brojPregleda;
    }
}

function sumLensesMonthsExamination($conn, $idKorisnika)
{
    $todayDate = date("Y-m-d");
    $dateSplit = explode("-", $todayDate, 3);
    $dateSplit[1] = rtrim($dateSplit[1], "-");
    $startDate = $dateSplit[0] . "-" . $dateSplit[1] . "-01";
    $sql = "SELECT COUNT(ID) AS brojPregleda FROM pregledi WHERE datum_pregleda BETWEEN '$startDate' AND '$todayDate' AND ID_korisnika='$idKorisnika' AND vrsta_pregleda ='sociva'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_object($result)) {
        echo $row->brojPregleda;
    }
}





?>

<body id="page-top">
    <div id="wrapper">
        <?php include '../pregled/modules/menu.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"> <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"> <i class="fa fa-bars"></i> </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow"> <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ulogovani ste kao
                                    <b>
                                        <?php $korisnik = $_SESSION['prijavljen'];
                                        $ar = explode("#", $korisnik, 3);
                                        $ar[1] = rtrim($ar[1], "#");
                                        echo $imeKorisnika = $ar[1];
                                        ?>
                                    </b> <i class="fas fa-user"></i></span> </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Odjava </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                    </div>
                    <div class="row">
                        <div class="">

                        </div>
                        <div class="companyInfo"> <img id="logo" src="../pregled/images/MO.png">

                        </div>

                    </div>
                    </br>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Statistika obavljenih pregleda</h1>
                    </div>
                    <div class="statistic">
                        <div class="sumExamination">
                            <div class="col-xl-9 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Obavljenih pregleda (ovaj mjesec)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo sumMonthsExamination($conn, $idKorisnika); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sumGlasses">
                            <div class="col-xl-9 col-md-6 mb-6">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pregled - naočare (ovaj mjesec)</br></div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo sumGlassesMonthsExamination($conn, $idKorisnika); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-glasses fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sumLenses">
                            <div class="col-xl-9 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pregled - kontaktna sočiva (ovaj mjesec)</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo sumLensesMonthsExamination($conn, $idKorisnika); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    </br>
                    <div class="statistic">
                        <div class="sumExamination">
                            <div class="col-xl-9 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ukupno obavljenih pregleda</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo sumExamination($conn, $idKorisnika); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sumGlasses">
                            <div class="col-xl-9 col-md-6 mb-6">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pregled - naočare </br></div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo sumGlassesExamination($conn, $idKorisnika); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-glasses fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sumLenses">
                            <div class="col-xl-9 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pregled - kontaktna sočiva</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo sumLensesExamination($conn, $idKorisnika); ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><?php include '../pregled/modules/footer.php'; ?>
</body>

</html>
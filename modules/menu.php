<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"> <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15"></div>
        <div class="sidebar-brand-text mx-3"><?php $korisnik = $_SESSION['prijavljen'];
                                                $ar = explode('#', $korisnik, 4);
                                                $ar[1] = rtrim($ar[1], '#');
                                                echo $optika = $ar[1];
                                                ?></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active"> <a class="nav-link" href="index.php"> <i class="fas fa-home"></i> <span>Početna</span></a> </li>
    <hr class="sidebar-divider">

    <li class="nav-item">

        <a class="nav-link collapsed" href="addPatientForm.php" d data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <i class="fas fa-user-plus"></i> <span>Dodaj novog klijenta</span> </a>
        <a class="nav-link collapsed" href="addExaminationShortForm.php" d data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <i class="fas fa-glasses"></i> <span>Kratki pregled</span> </a>
        <a class="nav-link collapsed" href="addExaminationForm.php" d data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <i class="fas fa-glasses"></i> <span>Pregled</span> </a>
        <a class="nav-link collapsed" href="addWorkOrderDocumentForm.php" d data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <i class="fas fa-clipboard-list"></i></i> <span>Radni nalog</span> </a>
        <a class="nav-link collapsed" href="patientRecords.php" d data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <i class="fas fa-folder-open"></i> <span>Karton klijenta</span> </a>

    </li>
    <hr class="sidebar-divider">
    <div class="text-center d-none d-md-inline"> <button class="rounded-circle border-0" id="sidebarToggle"></button> </div>
</ul>
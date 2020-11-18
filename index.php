<!DOCTYPE html>
<html lang="en"><?php include '../pregled/modules/header.php'; ?>

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
                            <!--<h5>Uputstvo za narudžbenicu</h5>
                            <p>Da biste kreirali željenu narudžbenicu potrebno je:</p>
                            <p>U jezičku lijevo izabrati iz ponude Lagerska stakla ili Specijala</p>
                            <p>Kod Lagerska stakla" dobićete padajuću listu sa indexima i materijalima, nakon čega je potrebno izabrati željeni index.</p>
                            <p>Da biste definisali potrebnu količinu određene dioptrije, potrebno je u polje grafikona unijeti željenu količinu, nakon čega je potrebno pritisnuti ENTER na tastaturi radi potvrde.</p>
                            <p><strong>NAPOMENA: Stavke dodavati jednu po jednu</strong></p>
                            <p>Sve željene stavke koje potvrdite nakon unosa biće prikazane u tabeli NARUDŽBENICA koja se nalazi na dnu stranice.</p>
                            <p><strong>Unesene količine za stavke u tabeli NARUDŽBENICA nije moguće uređivati.</strong></p>
                            <p>U slučaju pogrešnog unosa, stavku iz tabele je potrebno ukloniti klikom na ikonicu kantice <i class='fas fa-trash'></i>, a nakon toga izvršiti ponovni unos iz grafikona.</p>
                            <p>Nakon što kreirate narudžbenicu, potrebno je kliknuti na dugme <i class='fas fa-paper-plane'></i> POŠALJI NARUDŽBU, nakog čega će Vaša narudžbenica biti poslata veleprodaji M-Optic</p>
                            <p>Za sve dodatne informacije u vezi aplikacije možete nas kontaktirati na email: <a href="mailto:info@mojaoptika.com">info@mojaoptika.com</a></p></br> !-->
                        </div>
                        <div class="companyInfo"> <img id="logo" src="../pregled/images/MO.png">
                            <!--<p>“M-Optic” d.o.o.</br> ul. Majevička br. 29, 76300 Bijeljina</br> <strong>Tel:</strong> +387 55 222 999, 222 990, 490 010</br> <strong>Fax:</strong> +387 55 222 998</br> <strong>Email:</strong> <a href="mailto:mopticvp@mojaoptika.com">mopticvp@mojaoptika.com</a></br> <a href="https://mojaoptika.com">www.mojaoptika.com</a></p>!-->
                        </div>
                    </div>
                </div>
            </div><?php include '../pregled/modules/footer.php'; ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<?php
include '../pregled/modules/header.php';

require_once 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");

//Metod za čitanje liste proizvođača sočiva i dodavanje rezultata u opcije select box-a proizvođača
function lensesManufactured($conn)
{
    $sql = "SELECT * FROM proizvodjaci_sociva";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_object($result)) {
        echo "<option value='$row->ID'>$row->naziv_proizvodjaca</option>";
    }
}

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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ulogovani ste kao
                                    <b>
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
                    <h1 class="h3 mb-4 text-gray-800">Kratki pregled - kontaktna sočiva <i class="fas fa-eye"></i></h1>
                    <div class="row">
                        <div class="workersLog">
                            <div class="workers">
                                <div class="form-group col-md-7">
                                    <label><strong>ID radnika:</strong></label>
                                    <input name="sifra_radnika" class="form-control" type="password" title="Unesite svoj ID" id="sifra_radnika" autocomplete="off" />
                                </div>
                            </div>
                            <div class="nameWorker">
                                <div class="form-group col-md-7">
                                    <label>Pregled obavlja:</br></label>
                                    <div id="ime_radnika"></div>
                                </div>
                            </div>
                            <div class='lenses'>
                                <div class="form-group col-md-7">
                                    <button class="btn btn-danger" type="button" onclick="window.location.href='../pregled/addExaminationShortForm.php';"><i class="fas fa-glasses"></i>&nbsp;Kratki pregled - naočare</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="patientSearch">
                            <div class="form-group col-md-10">
                                <label for="#search">Pretraga pacijenta</label>&nbsp;<i class="fas fa-search"></i>
                                <input name="name" placeholder="npr. Nemanja (Milan) Lazarević 1996" title="Unesite ime,prezime ili godinu rođenja za pretragu pacijenta" type="text" class="form-control" id="search" autocomplete="off" />
                            </div>
                            <div id="display"></div>
                        </div>

                        <div class="todayDate">
                            <div class="form-group col-md-10">
                                <label>Današnji datum</label>
                                <input name="datum_pregleda" title="" type="text" class="form-control" id="datum_pregleda" value=<?php echo date("d.m.Y"); ?> disabled>
                            </div>

                            <input name="id_pacijenta" type="hidden" class="form-control" id="id_pacijenta">
                        </div>

                        <div class="noteAboutPatient">
                            <div class="form-group col-md-10">
                                <label for="exampleFormControlSelect2">Podaci o pacijentu:</label>
                                <div>
                                    <textarea class="form-control" id="ispis_napomene_pacijenta" disabled> </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="form-group col-md-7">
                            <strong> <label id="labelAnamneza">ANAMNEZA:</label></strong>
                            <input list="listaAnamneza" name="anamneza" title="" type="text" class="form-control" id="anamneza" autocomplete="off">
                            <datalist id="listaAnamneza">
                                <option value="Slabije vidi na daljinu">
                                <option value="Slabije vidi na blizinu">
                                <option value="Dupla slika">
                                <option value="Izobličena slika">
                                <option value="Naglo slabi vid">
                                <option value="Glavobolja">
                                <option value="Očni napor">
                                <option value="Bol u oku">
                                <option value="Suzenje">
                                <option value="Slabije vidi noću">
                                <option value="Oko je suvo i svrbi">
                            </datalist>
                        </div>

                    </div>

                    <br>
                    <div class="row">
                        <strong> <label for="exampleFormControlSelect2">VIDNA OŠTRINA</label></strong>
                    </div>

                    <div class="vidnaOstrina">
                        <div class="vidnaOstrina_grupa1">
                            <div class="vod1">
                                <div class="form-group col-md-5">
                                    <label id="label_vod">VOD:</label>
                                    <input list="listaVod" name="vod" title="" type="text" class="form-control" id="vod" autocomplete="off">
                                    <datalist id="listaVod">
                                        <option value="0.1">
                                        <option value="0.2">
                                        <option value="0.3">
                                        <option value="0.4">
                                        <option value="0.5">
                                        <option value="0.6">
                                        <option value="0.7">
                                        <option value="0.8">
                                        <option value="0.9">
                                        <option value="1.0">
                                    </datalist>
                                </div>
                            </div>

                            <div class="vos1">
                                <div class="form-group col-md-5">
                                    <label id="label_vos">VOS:</label>
                                    <input list="listaVos" name="vos" title="" type="text" class="form-control" id="vos" autocomplete="off">
                                    <datalist id="listaVos">
                                        <option value="0.1">
                                        <option value="0.2">
                                        <option value="0.3">
                                        <option value="0.4">
                                        <option value="0.5">
                                        <option value="0.6">
                                        <option value="0.7">
                                        <option value="0.8">
                                        <option value="0.9">
                                        <option value="1.0">
                                    </datalist>
                                </div>
                            </div>
                        </div>

                        <div class="vidnaOstrina_grupa2">
                            <div class="sa_cc">
                                <label id="sa_cc">sa cc:</label>
                            </div>
                        </div>

                        <div class="vidnaOstrina_grupa3">
                            <div class="form-group col-md-12">
                                <input name="vod" title="" type="text" class="form-control" id="vod1" autocomplete="off">
                            </div>

                            <div class="form-group col-md-12">
                                <input name="vos" title="" type="text" class="form-control" id="vos1" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <strong> <label for="exampleFormControlSelect2">KOREKCIJA (kon. sočiva):</label></strong>
                    </div>

                    <div class="lensesCorrection">
                        <div class="lensesCorrectionOd">
                            <label>OD:</label>
                            <div class="row">
                                <div class="form-group col-md-12">

                                    <div class="proizvodjac">
                                        <label id='labelManufactured'>Proizvođač:</label>
                                        <select name='proizvodjacOd' class='form-control' id='proizvodjac_ks_od'>
                                            <option default></option>
                                            <?php lensesManufactured($conn); ?>
                                        </select>
                                    </div>

                                    <div class="period">
                                        <label id='labelPeriod'>Period:</label>
                                        <select name="period_ks_od" title="" type="text" class="form-control" id="period_ks_od">
                                            <option default></option>
                                            <option value="dnevna">Dnevna</option>
                                            <option value="15dana">15 dana</option>
                                            <option value="mjesec">Mjesec</option>
                                            <option value="3mjeseca">3 mjeseca</option>
                                            <option value="godina">Godina</option>
                                        </select>
                                    </div>

                                    <div class="tip">
                                        <label id='labelType'>Tip/vrsta:</label>
                                        <select name="tip_ks_od" title="" class="form-control" id="tip_ks_od">
                                            <option default></option>
                                        </select>
                                    </div>

                                    <div class="jacina">
                                        <label id='labelPower'>Jačina:</label>
                                        <input name="jacina_ks_od" title="" type="text" class="form-control" id="jacina_ks_od" autocomplete="off">
                                    </div>

                                    <div class="bc">
                                        <label id='labelBc'>BC:</label>
                                        <input list="ispisBc_od" name="bc_ks_od" title="" type="text" class="form-control" id="bc_ks_od" autocomplete="off">
                                        <datalist id="ispisBc_od"></datalist>
                                    </div>

                                    <div class="velicina">
                                        <label id='labelSize'>TD:</label>
                                        <input name="velicina_ks_od" title="" type="text" class="form-control" id="velicina_ks_od" autocomplete="off" />
                                    </div>

                                    <div class="boja">
                                        <label id='labelColor'>Boja:</label>
                                        <input name="boja_ks_od" title="" type="text" class="form-control" id="boja_ks_od" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="lensesCorrectionOs">
                            <label>OS:</label>
                            <div class="row">
                                <div class="form-group col-md-12">

                                    <div class="proizvodjac">
                                        <label id='labelManufactured'>Proizvođač:</label>
                                        <select name="proizvodjacOs" title="" class="form-control" id="proizvodjac_ks_os">
                                            <option default></option>
                                            <?php lensesManufactured($conn); ?>
                                        </select>
                                    </div>

                                    <div class="period">
                                        <label id='labelPeriod'>Period:</label>
                                        <select name="period_ks_os" title="" type="text" class="form-control" id="period_ks_os">
                                            <option default></option>
                                            <option value="dnevna">Dnevna</option>
                                            <option value="15dana">15 dana</option>
                                            <option value="mjesec">Mjesec</option>
                                            <option value="3mjeseca">3 mjeseca</option>
                                            <option value="godina">Godina</option>
                                        </select>
                                    </div>

                                    <div class="tip">
                                        <label id='labelType'>Tip/vrsta:</label>
                                        <select name="tip_ks_os" title="" type="text" class="form-control" id="tip_ks_os">
                                        </select>
                                    </div>

                                    <div class="jacina">
                                        <label id='labelPower'>Jačina:</label>
                                        <input name="jacina_ks_os" title="" type="text" class="form-control" id="jacina_ks_os" autocomplete="off">
                                    </div>

                                    <div class="bc">
                                        <label id='labelBc'>BC:</label>
                                        <input list="ispisBc_os" name="bc_ks_os" title="" type="text" class="form-control" id="bc_ks_os" autocomplete="off" />
                                        <datalist id="ispisBc_os"></datalist>
                                    </div>

                                    <div class="velicina">
                                        <label id='labelSize'>TD:</label>
                                        <input name="velicina_ks_os" title="" type="text" class="form-control" id="velicina_ks_os" autocomplete="off" />
                                    </div>

                                    <div class="boja">
                                        <label id='labelColor'>Boja:</label>
                                        <input name="boja_ks_os" title="" type="text" class="form-control" id="boja_ks_os" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>



                    <div class="row">
                        <div class="form-group col-md-7">
                            <strong><label for="exampleFormControlSelect2">KONTROLA:</label> </strong>
                            <input list="listaKontrola" name="kontrola" title="" type="text" class="form-control" id="kontrola">
                            <datalist id="listaKontrola">
                                <option>Kontrola za 7 dana</option>
                                <option>Kontrola za 1 mjesec</option>
                                <option>Kontrola za 3 mjeseca</option>
                                <option>Kontrola za 6 mjeseci</option>
                                <option>Kontrola za 1 godinu</option>
                                <option>Kontrola za 3 godine</option>
                                <option>Kontrola po potrebi</option>
                            </datalist>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-7">
                            <label>Napomena</label>
                            <textarea name="napomena_pregleda" class="form-control" type="text" title="Unesite napomenu vezanu za pregled" id="napomena_pregleda" row="9"></textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <button type='button' onclick="checkLensesFormExamination()" id='dugmeDodajPregledSociva' class='btn btn-success'><i class="fas fa-save"></i>&nbsp;<label class="labelSaveButton">Sačuvaj</label></button>
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
        //Postavljanje fokusa na polje za unos šifre radnika kada se stranica učita
        document.getElementById('sifra_radnika').focus();


        /*******************************************************************************/
        $(document).ready(function() {
            //Funkcija koja se poziva kada se polje za period OD sočiva promijeni
            $("#period_ks_od").change(function() {

                //Parametri potrebni za pretragu tipova sočiva (period i ID proizvođača sočiva) u tabeli sočiva
                var period_ks_od = $('#period_ks_od').val();
                var proizvodjac_ks_od = $('#proizvodjac_ks_od').val();

                if (period_ks_od != "") {
                    //Poziva se AJAX
                    $.ajax({
                        //AJAX metod je POST.
                        type: "POST",
                        //Podaci će biti poslati prema "ajaxTypeLenses.php".
                        url: "ajaxTypeLenses.php",
                        //Podaci koji će biti poslati
                        data: {
                            period_ks_od: period_ks_od,
                            proizvodjac_ks_od: proizvodjac_ks_od
                        },
                        //Ako je rezultat pronađen vrijednosti opcija se smiještaju u izbornik tipova sočiva OD.
                        success: function(html) {
                            $("#tip_ks_od").html(html).show();
                        }
                    });
                }
            });

            //Funkcija koja se poziva kada se polje za tip sočiva OD promijeni.
            $("#tip_ks_od").change(function() {

                //Čišćenje vrijednosti polja (starih vrijednosti) bazne krivine, datalist bazne krivine i velicine sočiva.
                document.getElementById("bc_ks_od").value = "";
                document.getElementById("velicina_ks_od").value = "";
                $('#ispisBc_od').find('option').remove().end();

                //Incijalizacija promjenljive koja uzima vrijednost ID-a koji referencira na ID zapisa u tabeli sočiva.
                var tip_ks_od = $("#tip_ks_od").val();

                if (tip_ks_od != "") {
                    //Poziva se AJAX.
                    $.ajax({
                        //AJAX metod je POST.
                        type: "POST",
                        //Podaci će biti poslati prema "ajaxTypeLenses.php".
                        url: "ajaxTypeLenses.php",
                        //Podaci koji će biti poslati
                        data: {
                            tip_ks_od: tip_ks_od
                        },
                        //Ako je rezultat pronađen, promjenljiva koja je vraćena iz ajaxTypeLenses.php sadrži baznu krivinu i veličinu sočiva pa je potrebno istu razdvojiti na dva dijela.
                        //Separator je @@@
                        success: function(html) {
                            var bcTd = html.split('@@@');
                            //Prvi element se dodaje kao opcija u datalist bazne krivine OD.
                            $("#ispisBc_od").append(bcTd[0]);
                            //Drugi element se dodjeljuje kao vrijednost polja za veličinu sočiva OD.
                            document.getElementById("velicina_ks_od").value = bcTd[1];
                        }
                    });
                }
            });

            //Funkcija koja se poziva kada se polje za period OS sočiva promijeni.
            $("#period_ks_os").change(function() {

                //Parametri potrebni za pretragu tipova sočiva (period i ID proizvođaca sočiva) u tabeli sočiva
                var period_ks_os = $('#period_ks_os').val();
                var proizvodjac_ks_os = $('#proizvodjac_ks_os').val();

                if (period_ks_os != "") {
                    //Poziva se AJAX
                    $.ajax({
                        //AJAX metod je POST.
                        type: "POST",
                        //Podaci će biti poslati prema "ajaxTypeLenses.php".
                        url: "ajaxTypeLenses.php",
                        //Podaci koji će biti poslati.
                        data: {
                            period_ks_os: period_ks_os,
                            proizvodjac_ks_os: proizvodjac_ks_os
                        },
                        //Ako je rezultat pronađen vrijednosti opcija se smiještaju u izbornik tipova sočiva OS.
                        success: function(html) {
                            $("#tip_ks_os").html(html).show();
                        }
                    });
                }
            });

            //Funkcija koja se poziva kada se polje za tip sočiva OS promijeni.
            $("#tip_ks_os").change(function() {

                //Čišćenje vrijednosti polja (starih vrijednosti) bazne krivine, datalist bazne krivine i veličine sočiva.
                document.getElementById("bc_ks_os").value = "";
                document.getElementById("velicina_ks_os").value = "";
                $('#ispisBc_os').find('option').remove().end();

                //Incijalizacija promjenljive koja uzima vrijednost ID-a koji referencira na ID zapisa u tabeli sočiva.
                var tip_ks_os = $("#tip_ks_os").val();


                if (tip_ks_os != "") {
                    //Poziva se AJAX.
                    $.ajax({
                        //AJAX metod je POST.
                        type: "POST",
                        //Podaci će biti poslati prema "ajaxTypeLenses.php".
                        url: "ajaxTypeLenses.php",
                        //Podaci koji će biti poslati.
                        data: {
                            tip_ks_os: tip_ks_os
                        },
                        //Ako je rezultat pronađen, promjenljiva koja je vraćena iz ajaxTypeLenses.php sadrži baznu krivinu i veličinu sočiva pa je potrebno istu razdvojiti na dva dijela.
                        //Separator je @@@
                        success: function(html) {
                            var bcTd = html.split('@@@');
                            //Prvi element se dodaje kao opcija u datalist bazne krivine OD.
                            $("#ispisBc_os").append(bcTd[0]);
                            //Drugi element se dodjeljuje kao vrijednost polja za velicinu sociva OD
                            document.getElementById("velicina_ks_os").value = bcTd[1];
                        }
                    });
                }
            });
        });

        //Čišćenje vrijednosti polja ukoliko dođe do promjene select option
        var $proizvodjac_ks_od = $('#proizvodjac_ks_od');
        $proizvodjac_ks_od.on('change', function() {
            $('#tip_ks_od').find('option').remove().end();
            $('#period_ks_od').val('');
            document.getElementById("bc_ks_od").value = "";
            document.getElementById("velicina_ks_od").value = "";
            document.getElementById("jacina_ks_od").value = "";
            document.getElementById("boja_ks_od").value = "";
            $('#ispisBc_od').find('option').remove().end();
        });

        var $period_ks_od = $('#period_ks_od');
        $period_ks_od.on('change', function() {
            document.getElementById("bc_ks_od").value = "";
            document.getElementById("velicina_ks_od").value = "";
            document.getElementById("jacina_ks_od").value = "";
            document.getElementById("boja_ks_od").value = "";
            $('#ispisBc_od').find('option').remove().end();
        });

        var $proizvodjac_ks_os = $('#proizvodjac_ks_os');
        $proizvodjac_ks_os.on('change', function() {
            $('#tip_ks_os').find('option').remove().end();
            $('#period_ks_os').val('');
            document.getElementById("bc_ks_os").value = "";
            document.getElementById("velicina_ks_os").value = "";
            document.getElementById("jacina_ks_os").value = "";
            document.getElementById("boja_ks_os").value = "";
            $('#ispisBc_os').find('option').remove().end();
        });

        var $period_ks_os = $('#period_ks_os');
        $period_ks_os.on('change', function() {
            document.getElementById("bc_ks_os").value = "";
            document.getElementById("velicina_ks_os").value = "";
            document.getElementById("jacina_ks_os").value = "";
            document.getElementById("boja_ks_os").value = "";
            $('#ispisBc_os').find('option').remove().end();
        });
        /*******************************************************************************/

        //Traženje imena radnika na osnovu unesenog ID-a
        $(document).ready(function() {
            //Kada se polje promijeni, aktivira se triger koji poziva AJAX metod
            $("#sifra_radnika").on('change', function(e) {
                //Uzima se vrijednost iz polja za unos
                var sifra_radnika = document.getElementById('sifra_radnika').value;
                //Poziva se AJAX
                $.ajax({
                    //AJAX metod je POST
                    type: "POST",
                    //Podaci se šalju prema getWorkersID.php
                    url: "getWorkersID.php",
                    dataType: "html",
                    //Podaci koji se šalju
                    data: {
                        sifra_radnika: sifra_radnika
                    },
                    //Ukoliko je pronađena vrijednost, ime radnika se prikazuje u div elementu ime_radnika
                    success: function(response) {
                        $("#ime_radnika").html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>
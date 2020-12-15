<?php
session_start();
if (is_null($_SESSION['prijavljen'])) {
   header('Location: ../pregled/login.php');
}
include 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode("#", $korisnik, 3);
$ar[1] = rtrim($ar[1], "#");
$dataBaseName = $ar[2];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, "utf8");

//Uzimanje vrijednosti iz polja search
if (isset($_POST['search'])) {
   //Dodjeljivanje prosljeđene vrijednosti promjenljivoj
   $Name = $_POST['search'];
   //String koji sadrži unesenu vrijednost sa znakom '%' umjesto razmaka. Ovo je dodatni parametar koji unaprijeđuje pretragu pacijenta
   $string = preg_replace('/\s+/', '%', $Name);
   //Upit za pretragu unesenog pojma
   $Query = "SELECT ID,generalije_pacijenta,kontakt,napomena,naocare_daljina_od,naocare_daljina_os,naocare_blizina_od,naocare_blizina_os,sociva_od,sociva_os FROM pacijenti WHERE generalije_pacijenta LIKE '%$Name%' OR generalije_pacijenta LIKE '$string' OR generalije_pacijenta LIKE '$string%' LIMIT 10";
   //Izvršavanje upita
   $ExecQuery = MySQLi_query($conn, $Query);
   //Kreiranje neuređena liste za prikaz rezultata
   echo '
    <ul>
       ';
   $numRow = 0;
   //Čitanje rezultata upita
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
      $numRow = 1;
      //Kreiranje stavki neuređene liste.
      //Stavki se dodjeljuje onclick triger koji na "kliknuti" rezultat isti prosljeđuje metodi "fill" koja se nalazi u "js/alertify.min.js"
?>
      <li id="ajaxResults" onclick='fill("<?php echo $Result['ID'] . "#" . $Result['generalije_pacijenta'] . "#" . $Result['kontakt'] . "#" . $Result['napomena'] . "#" . $Result['naocare_daljina_od'] . "#" . $Result['naocare_daljina_os'] . "#" . $Result['naocare_blizina_od'] . "#" . $Result['naocare_blizina_os'] . "#" . $Result['sociva_od'] . "#" . $Result['sociva_os']; ?>")'>
         <a value="<?php echo $Result['ID']; ?>">
            <?php echo $Result['generalije_pacijenta']; ?>
      </li></a>
<?php
   }

   //Uslov u kome se provjerava da li je bilo rezulta upita
   if ($numRow == 0) {
      echo "Nema rezultata pretrage";
   }
}
?>
</ul>
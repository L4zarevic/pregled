<?php
session_start();
if (is_null($_SESSION['prijavljen'])) {
   header('Location: ../pregled/login.php');
}
include 'connection.php';
$korisnik = $_SESSION['prijavljen'];
$ar = explode('#', $korisnik, 4);
$ar[1] = rtrim($ar[1], '#');
$dataBaseName = $ar[3];
$conn = OpenStoreCon($dataBaseName);
mysqli_set_charset($conn, 'utf8');

//Uzimanje vrijednosti iz polja search
if (isset($_POST['search'])) {
   //Dodjeljivanje prosljeđene vrijednosti promjenljivoj
   $Name = mysqli_real_escape_string($conn, $_POST['search']);
   //String koji sadrži unesenu vrijednost sa znakom '%' umjesto razmaka. Ovo je dodatni parametar koji unaprijeđuje pretragu pacijenta
   $string = preg_replace('/\s+/', '%', $Name);
   //Upit za pretragu unesenog pojma
   $sql = "SELECT ID,generalije_pacijenta,kontakt,napomena,naocare_daljina_od,naocare_daljina_os,naocare_blizina_od,naocare_blizina_os,sociva_od,sociva_os FROM pacijenti WHERE generalije_pacijenta LIKE '%$Name%' OR generalije_pacijenta LIKE '$string' OR generalije_pacijenta LIKE '$string%' LIMIT 10";
   //Izvršavanje upita
   $result = MySQLi_query($conn, $sql);
   //Kreiranje neuređena liste za prikaz rezultata
   echo '
    <ul>
       ';
   $numRow = 0;
   //Čitanje rezultata upita
   while ($row = MySQLi_fetch_array($result)) {
      $numRow = 1;
      //Kreiranje stavki neuređene liste.
      //Stavki se dodjeljuje onclick triger koji na "kliknuti" rezultat isti prosljeđuje metodi "fill" koja se nalazi u "js/alertify.min.js"
?>
      <li id="ajaxResults" onclick='fill("<?php echo $row['ID'] . '#' . $row['generalije_pacijenta'] . '#' . $row['kontakt'] . '#' . $row['napomena'] . '#' . $row['naocare_daljina_od'] . '#' . $row['naocare_daljina_os'] . '#' . $row['naocare_blizina_od'] . '#' . $row['naocare_blizina_os'] . '#' . $row['sociva_od'] . '#' . $row['sociva_os']; ?>")'>
         <a value="<?php echo $row['ID']; ?>">
            <?php echo $row['generalije_pacijenta']; ?>
      </li></a>
<?php
   }

   //Uslov u kome se provjerava da li je bilo rezulta upita
   if ($numRow == 0) {
      echo 'Nema rezultata pretrage';
   }
}
?>
</ul>
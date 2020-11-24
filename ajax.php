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
mysqli_set_charset($conn,"utf8");
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
   //Search box value assigning to $Name variable.
   $Name = $_POST['search'];
   //Search query.
   $Query = "SELECT ID,generalije_pacijenta,kontakt,napomena,naocare_daljina_od,naocare_daljina_os,naocare_blizina_od,naocare_blizina_os,sociva_od,sociva_os FROM pacijenti WHERE generalije_pacijenta LIKE '%$Name%' LIMIT 10";
   //Query execution
   $ExecQuery = MySQLi_query($conn, $Query);
   //Creating unordered list to display result.
   echo '
    <ul>
       ';

      $numRow = 0;
   //Fetching result from database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
      $numRow = 1;
?>
      <!-- Creating unordered list items.
            Calling javascript function named as "fill".
            By passing fetched result as parameter. -->
      <li id="ajaxResults" onclick='fill("<?php echo $Result['ID'] . "#" . $Result['generalije_pacijenta'] . "#" . $Result['kontakt'] . "#" . $Result['napomena'] . "#" . $Result['naocare_daljina_od'] . "#" . $Result['naocare_daljina_os'] . "#" . $Result['naocare_blizina_od'] . "#" . $Result['naocare_blizina_os'] . "#" . $Result['sociva_od'] . "#" . $Result['sociva_os']; ?>")'>

         <a value="<?php echo $Result['ID']; ?>">
            <!-- Assigning searched result in "Search box" in "addExaminationForm.php,addExaminationShortForm.php,patientRecord.php" file. -->
            <?php echo $Result['generalije_pacijenta']; ?>
      </li></a>
      <!-- Below php code is just for closing parenthesis. Don't be confused. -->
<?php
   }
   if ($numRow == 0) {
      echo "Nema rezultata pretrage";
   }
}
?>
</ul>
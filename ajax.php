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
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
   //Search box value assigning to $Name variable.
   $Name = $_POST['search'];
   //Search query.
   $Query = "SELECT ID,generalije_pacijenta,napomena FROM pacijenti WHERE generalije_pacijenta LIKE '%$Name%'";
   //Query execution
   $ExecQuery = MySQLi_query($conn, $Query);
   //Creating unordered list to display result.
   echo '
    <ul>
       ';
   //Fetching result from database.
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
?>
      <!-- Creating unordered list items.
            Calling javascript function named as "fill" found in "script.js" file.
            By passing fetched result as parameter. -->
      <li id="ajaxResults" onclick='fill("<?php echo $Result['ID'] . "#" . $Result['generalije_pacijenta'] . "#" . $Result['napomena']; ?>")'>

         <a  value="<?php echo $Result['ID']; ?>">
            <!-- Assigning searched result in "Search box" in "search.php" file. -->
            <?php echo $Result['generalije_pacijenta']; ?>
      </li></a>
      <!-- Below php code is just for closing parenthesis. Don't be confused. -->
<?php
   }
}
?>
</ul>
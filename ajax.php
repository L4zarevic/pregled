<?php
session_start();
if (is_null($_SESSION['prijavljen'])) {
   header('Location: ../pregled/login.php');
}
include 'connection.php';
$conn = OpenCon();
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
   //Search box value assigning to $Name variable.
   $Name = $_POST['search'];
   //Search query.
   $Query = "SELECT ID,imePacijenta,prezimePacijenta,godiste FROM pacijenti WHERE imePacijenta LIKE '%$Name%' OR prezimePacijenta LIKE '%$Name%' OR godiste LIKE '%$Name%' LIMIT 5";
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
      <li onclick='fill("<?php echo $Result['ID'] . "#" . $Result['imePacijenta'] . " " . $Result['prezimePacijenta'] . " " . $Result['godiste']; ?>")'>

         <a value="<?php echo $Result['ID']; ?>">
            <!-- Assigning searched result in "Search box" in "search.php" file. -->
            <?php echo $Result['imePacijenta']; ?>
            <?php echo $Result['prezimePacijenta']; ?>
            <?php echo $Result['godiste']; ?>
      </li></a>
      <!-- Below php code is just for closing parenthesis. Don't be confused. -->
<?php
   }
}
?>
</ul>
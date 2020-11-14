<?php session_start();
if (is_null($_SESSION['prijavljen'])) {
    header('Location: ../pregled/login.php');
}
include 'connection.php';
$conn = OpenCon();
$result=mysqli_query("select datum_pregleda from pregledi",$conn);


?>

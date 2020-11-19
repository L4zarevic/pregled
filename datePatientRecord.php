<!DOCTYPE html>
<html>

<body>

    <?php session_start();
    if (is_null($_SESSION['prijavljen'])) {
        header('Location: ../pregled/login.php');
    }

    require_once 'connection.php';
    $korisnik = $_SESSION['prijavljen'];
    $ar = explode("#", $korisnik, 3);
    $ar[1] = rtrim($ar[1], "#");
    $dataBaseName = $ar[2];
    $conn = OpenStoreCon($dataBaseName);

    $id_pacijenta = mysqli_real_escape_string($conn, $_REQUEST['id_pacijenta']);

    $sql = "SELECT ID,datum_pregleda,ID_korisnika FROM pregledi WHERE ID_pacijenta = '" . $id_pacijenta . "'";
    $result = mysqli_query($conn, $sql);

    echo " <table class='table table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'>#</th>";
    echo "<th scope='col'>Datum pregleda:</th>";
    echo "<th scope='col'>Radnja:</th>";
    echo "</tr>";
    echo "</thead>";
    $rb = 0;
    while ($row = mysqli_fetch_object($result)) {
        echo "<tr>";
        echo "<td>" . ($rb = $rb + 1) . "</td>";
        echo "<td><a href='examinationReportEdit.php?id=$row->ID'>$row->datum_pregleda</a></td>";
        echo "<td>$row->ID_korisnika</td>";
        echo "</tr>";
    }
    echo "</table>";
    CloseCon($conn);
    ?>
</body>

</html>
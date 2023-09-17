<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
    if (isset($_GET['del'])) {
        $uid = $_GET['del'];

        $sqlSelect = "SELECT * FROM tbladdpackage WHERE PackageType=:del";
        $stmtSelect = $dbh->prepare($sqlSelect);
        $stmtSelect->bindParam(':del', $uid);
        $stmtSelect->execute();

        $rowCount = $stmtSelect->rowCount();

        if ($rowCount > 0) {
            echo "<script>alert('This category used in Packages');</script>";
            echo "<script>window.location.href='add-package.php'</script>";

        } else {

            $sql = "delete from tblpackage WHERE  id=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id', $uid, PDO::PARAM_INT);
            $query->execute();
            echo "<script>alert('Category Delete successfully');</script>";
            echo "<script>window.location.href='add-package.php'</script>";
        }

    }}

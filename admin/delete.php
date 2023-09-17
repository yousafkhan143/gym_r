<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM tbluser WHERE id=:id LIMIT 1";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        if ($query->execute()) {
            echo "<script>alert('user Successfully deleted')</script>";
            echo "<script>window.location.href='totaluser.php'</script>";
        } else {
            echo "<script>alert('user not deleted')</script>" . "<script>window.location.href='totaluser.php'</script>";
        }

    } else {
        echo "<script>window.location.href='totaluser.php'</script>";

    }

}

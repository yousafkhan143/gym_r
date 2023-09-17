<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{

    if (isset($_GET['pid'])) {
        $id = $_GET['pid'];
        $sql = "DELETE FROM tbladdpackage WHERE id=$id";
        $query = $dbh->prepare($sql);
        if ($query->execute()) {
            echo "<script>alert('Package Successfully deleted')</script>";
            echo "<script>window.location.href='manage-post.php'</script>";
        } else {
            echo "<script>alert('not deleted')</script>" . "<script>window.location.href='manage-post.php'</script>";
        }
    }

}

<?php
session_start();
error_reporting(0);
include  'include/config.php'; 

if (isset($_GET['pid']) && isset($_GET['id'])) {

    
    $id = $_GET['id'];
// echo "id ".userid; 
        $pid = $_GET['pid'];
        $sql="INSERT INTO tblbooking(package_id,userid)  Values(:pid,:id)";
        $query = $dbh -> prepare($sql);
        
        $query->bindParam(':pid',$pid,PDO::PARAM_INT);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
       if ($query -> execute())
       {

           echo "<script>alert('Package has been booked.');</script>";
           echo "<script>window.location.href='totaluser.php'</script>";
        }else {
            echo "<script>alert('Package has not booked.');</script>";
            echo "<script>window.location.href='totaluser.php'</script>";
        }
        

    }
    ?>


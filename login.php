
<?php

session_start();
error_reporting(0);
require_once('include/config.php');

$msg = ""; 
if(isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = md5(($_POST['password']));
  if($email != "" && $password != "") {
    try {
      $query = "select id, fname, email, mobile, password, create_date from tbluser where email=:email and password=:password";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
        /******************** Your code ***********************/
        $_SESSION['uid']   = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['fname'];
        $snn= $_SESSION['name'];
      //  header("location: index.php?Error=Hi $snn you logged in Successfully");
       echo "<script>alert('Hi $snn you logged in Successfully');</script>";
       echo "<script>window.location.href='index.php'</script>";
       
      } else {
        header("location: index.php?Error=Email and Password is incorrect");
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }
  else if(empty($email))
  {
    header("location: index.php?Error=Email are required");
 
  }
  else if(empty($password))
  {
    header("location: index.php?Error=Password are required");
  }
  else if(empty($email) && empty($password))
  {
    header("location: index.php?Error=Email and Password are required");
 
  }
  else {
    header("location: index.php?Error=both fields are required");
  }
}
else {
  header("location: index.php");

}
?>

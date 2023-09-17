<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{

  
  if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
// $lname=$_POST['lname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
// $state=$_POST['state'];
    $city = $_POST['city'];
    $Password = $_POST['password'];
    $pass = md5($Password);
    $RepeatPassword = $_POST['RepeatPassword'];

// Email id Already Exit

    $usermatch = $dbh->prepare("SELECT mobile,email FROM tbluser WHERE (email=:usreml || mobile=:mblenmbr)");
    $usermatch->execute(array(':usreml' => $email, ':mblenmbr' => $mobile));
    while ($row = $usermatch->fetch(PDO::FETCH_ASSOC)) {
        $usrdbeml = $row['email'];
        $usrdbmble = $row['mobile'];
    }

    if (empty($fname)) {

        echo "<script>alert('Please Enter First Name')</script>";
        echo "<script>window.location.href='totaluser.php'</script>";

    } else if (empty($mobile)) {
        echo "<script>alert('Please Enter First Name')</script>";
        echo "<script>window.location.href='totaluser.php'</script>";
    } else if (empty($email)) {
        echo "<script>alert('Please Enter email')</script>";
        echo "<script>window.location.href='totaluser.php'</script>";

    } else if ($email == $usrdbeml || $mobile == $usrdbmble) {
        echo "<script>alert('Email Id or Mobile Number Already Exists!')</script>";
        echo "<script>window.location.href='totaluser.php'</script>";
    } else if ($Password == "" || $RepeatPassword == "") {

        echo "<script>alert('Password And Confirm Password Not Empty!')</script>";
        echo "<script>window.location.href='totaluser.php'</script>";

    } else if ($_POST['password'] != $_POST['RepeatPassword']) {

        echo "<script>alert('Password And Confirm Password Not Matched')</script>";
        echo "<script>window.location.href='totaluser.php'</script>";
    } else {
        $sql = "INSERT INTO tbluser (fname,email,mobile,city,password) Values(:fname,:email,:mobile,:city,:Password)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':Password', $pass, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId > 0) {
            echo "<script>alert('Registration successfully')</script>";
            echo "<script>window.location.href='totaluser.php'</script>";

        } else {
            echo "<script>alert('Registration Not successfully')</script>";
            echo "<script>window.location.href='totaluser.php'</script>";
        }
    }



  }



  } ?>
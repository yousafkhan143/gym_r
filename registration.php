<?php
error_reporting(0);
require_once 'include/config.php';

if (isset($_POST['reg'])) {
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

        header("location: index.php?Error=Please Enter First Name");
    } else if (empty($mobile)) {
        header("location: index.php?Error=Please Enter Mobile No");
    } else if (empty($email)) {
        header("location: index.php?Error=Please Enter Email");
    } else if ($email == $usrdbeml || $mobile == $usrdbmble) {
        header("location: index.php?Error=Email Id or Mobile Number Already Exists!");
    } else if ($Password == "" || $RepeatPassword == "") {

        header("location: index.php?Error=Password And Confirm Password Not Empty!");

    } else if ($_POST['password'] != $_POST['RepeatPassword']) {

        header("location: index.php?Error=Password And Confirm Password Not Matched");
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
            header("location: sign.php?Error=Registration successfully Please Login");

        } else {
            header("location: index.php?Error=Registration Not successfully");
        }
    }
}

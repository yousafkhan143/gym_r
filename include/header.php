<?php 
session_start();

include 'include/config.php';
error_reporting(0);
$uid=$_SESSION['uid'];

if(isset($_POST['submit']))
{ 
$pid=$_POST['pid'];


$sql="INSERT INTO tblbooking (package_id,userid) Values(:pid,:uid)";

$query = $dbh -> prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Package has been booked.');</script>";
echo "<script>window.location.href='booking-history.php'</script>";

}

?>
<!DOCTYPE html>
<html lang="eng">
<head>
	<title>Gym Management System</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Stylesheets -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/nice-select.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>

	<!-- Main Stylesheets -->

</head>
<body>
	<!-- Page Preloder -->
	

<header class="header-section" data-header>
		<div class="header-top">
			<div class="row m-0">
				<div class="col-md-6 d-none d-md-block p-0">
					<!-- <div class="header-info">
						<i class="material-icons">map</i>
						<p>184 Main Collins Street</p>
					</div>
					<div class="header-info">
						<i class="material-icons">phone</i>
						<p>(965) 436 3274</p>
					</div> -->
				</div>
				
					
				
				
				<div class="col-md-6 colll">
				<?php if(strlen($_SESSION['uid'])==0): ?>

				

					<?php else :?>

					
					<div class="header-info ">
						<i class="material-icons">account_circle</i>
						<a href="profile.php"><p>My Profile</p></a>
					</div>
					<div class="header-info ">
						<i class="material-icons">brightness_7</i>
						<a href="changepassword.php"><p>Change Password</p></a>
					</div>

					<div class="header-info ">
						<i class="material-icons">calendar_month</i>
						<a href="booking-history.php"><p>Booking History</p></a>
					</div>
				


					<div class="header-info ">
						<i class="material-icons">logout</i>
						<a href="logout.php"><p>Logout</p></a>
					</div>
					<?php endif;?>

				
				</div>
			
			</div>
		</div>
		<div class="header-bottom " id="headerr">
		<div class="logo">
				<a href="">Fitness <span>Club</span></a>
			</div>
			
			<div class="nav-bar">

					<ul class="main-menu ul">
						<li><a href="index.php#home">Home</a></li>
						<li><a href="index.php#service">Services</a></li>
						<li><a href="index.php#schedule">Schedule</a></li>
						<li><a href="index.php#Packages">Packages</a></li>
						<li><a href="index.php#about">About</a></li>
						<li><a href="index.php#contact">Contact</a></li>
						
				
						</ul>
				</div>
		
		</div>
	</header>
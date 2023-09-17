
<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["uid"])==0)
  {

 
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Gym Management System</title>
	<meta charset="UTF-8">
	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/nice-select.css"/>
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="css/style.css"/>

    <style>
.colom{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 35px;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
button, html [type="button"], [type="reset"], [type="submit"] {
    -webkit-appearance: button;
}
.btnn {
    cursor: pointer;
}
.btnn-primary {
    width: 400px;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    padding: 10px;
    border: 2px solid #007bff;
    border-radius: 5px;
}
/* .btnn-primary:hover {
    color: #FFF;
    background-color: #24a6ad;
    border-color: #24a6ad;
} */
.btnn {
    display: inline-block;
    font-weight: 700;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding: 10px;
 transition: 0.5s;

    }
.btnn:hover{
    color: #FFF;
    background-color: #24a6ad;
    border-color: #24a6ad;
    border-radius: 20px;
}


    </style>
</head>
<body>
	<!-- Page Preloder -->
	

	<!-- Header Section -->
	<?php include 'include/header.php';?>
	<!-- Header Section end -->

	                                                                              
	



	<!-- Pricing Section -->
	<section class="pricing-section spad">
		<div class="container">
			
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					
				</div>
				<div class="col-lg-6 col-sm-6">
					<div class="pricing-item entermediate">
						<div class="pi-top">

						</div>
						<div class="pi-price">
							<h3>User</h3>
							<p>Login</p>
						</div>
						 <?php if($error){?><div class="errorWrap" style="color:red;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap" style="color:red;"><strong>Error</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

						<form class="singup-form contact-form" method="post" action="index.php">
						<div class="row">
							<div class="col-md-12">
								<input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" required>
							</div>
							<div class="col-md-12">
								<input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
							</div>
							
							
						</div>
						<div class="row">
                        <div class="colom">
					<button type="submit" id="submit" name="login" value="Login" class="btnn btnn-primary">Login</button>
                        </div>

				</div>
	
</form>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					
				</div>
				
			</div>
		</div>
	</section>
	

	<!-- Footer Section end -->

	<div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

	<!-- Search model end -->

	<!--====== Javascripts & Jquery ======-->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
<script src="js/wow.min.js"></script>
	</body>
</html>
<?php
} 


else {
     
        header('location:index.php?Error=you are already login');
            
}
?>
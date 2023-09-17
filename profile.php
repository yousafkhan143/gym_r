<?php
session_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["uid"])==0)
    {   
header('location:login.php');
}
else{


if(isset($_POST['submit']))
{
$uid=$_SESSION['uid'];
$fname=$_POST['fname'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$city=$_POST['city'];
$address=$_POST['address'];
$sql="update tbluser set fname=:fname,mobile=:mobile,city=:city where id=:uid";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
//$msg="<script>toastr.success('Mobile info updated Successfully', {timeOut: 5000})</script>";

 

 header("location: index.php?Error=Profile has been updated");

}


 ?>


	<!-- Header Section -->
	<?php include 'include/header.php';?>
	<!-- Header Section end -->

	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<div class="row">
      <div class="col-lg-6 m-auto text-white">
	  <h3 class="text-center text-uppercase text-white">Profile</h3>
				</div>
			</div>
		</div>
	</section>
	                                                                            


</section>
	<!-- Page top Section end -->

	<!-- Contact Section -->
	<section class="contact-page-section spad overflow-hidden">
	
		<div class="container">
			
			<div class="row">
				<div class="col-lg-2">
				</div>
				<div class="col-lg-8">
					<form class="singup-form contact-form" method="post">
						<div class="row">
							<?php 
							$uid=$_SESSION['uid'];
							$sql ="SELECT id, fname, email, mobile, password,city, create_date from tbluser where id=:uid ";
							$query= $dbh -> prepare($sql);
							$query->bindParam(':uid',$uid, PDO::PARAM_STR);
							$query-> execute();
							$results = $query -> fetchAll(PDO::FETCH_OBJ);
							$cnt=1;
							if($query->rowCount() > 0)
							{
							foreach($results as $result)
							{				?>	
							<div class="col-md-6">
								<input type="text" name="fname" id="fname" placeholder="First Name" autocomplete="off" value="<?php echo $result->fname;?>">
							</div>
							
							<div class="col-md-6">
								<input type="text" name="email" id="email" placeholder="Your Email" autocomplete="off" value="<?php echo $result->email;?>" readonly>
							</div>
							<div class="col-md-6">
								<input type="text" name="mobile" id="mobile" placeholder="Mobile Number" autocomplete="off" value="<?php echo $result->mobile;?>">
							</div>
							
							<div class="col-md-6">
								<input type="text" name="city" id="city" placeholder="City" autocomplete="off" value="<?php echo $result->city;?>">
							</div>
							
							
							<div class="col-md-12">
						<input type="submit" id="submit" name="submit" value="Update" class="site-btn sb-gradient">
								
							</div>
							<?php }} ?>
						</div>
					</form>
				</div>
				<div class="col-lg-2">
				</div>
			</div>
		</div>
	</section>
	<!-- Trainers Section end -->
<?php include 'include/footer.php'; ?>
	<!-- Footer Section end -->
	
	
 <?php } ?>

  <style>
.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #dd3d36;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #5cb85c;
    color:#fff;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>

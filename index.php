
<?php
if (isset($_GET['Error'])) {
    ?>
	<div class="modal fade modal-auto-clear" id="error" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title text-center" id="exampleModalLabel"> <?php echo $_GET['Error']; ?></h5>

					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

			</div>
		</div>
	</div>
<?php }?>
<?php include 'include/header.php';?>

<?php

session_start();
error_reporting(0);
require_once('include/config.php');
$msg = ""; 
if(isset($_POST['login'])) {
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
?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">


				<h5 class="modal-title text-center" id="exampleModalLabel">Sign In</h5>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>


			<form  method="post" class="modal-body">


				<div class="mb-3">
					<label for="exampleInputEmail1" class="form-label">Email address</label>
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Password</label>
					<input type="password" name="password" class="form-control" id="exampleInputPassword1">
				</div>
				<div class="mb-3">
					<h6 class="text-center ">don't have an Account ?<a href="#" data-bs-toggle="modal" data-bs-target="#signupmodel" style="color : green; text-decoration : underline;">Register here</a></h6>
				</div>
				<div class="modal-footer ">
					<!-- <button type="button" class="btn btn-outline-primary ">Login</button> -->

					<button type="submit" name="login" class="btn btn-outline-primary">Login</button>
					<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">close</button>
				</div>
			</form>


		</div>
	</div>
</div>
<div class="modal fade" id="signupmodel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLabel">Registration</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="registration.php" method="post" class="modal-body">


				<div class="mb-3">
					<input type="text" placeholder="First Name" name="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
				</div>
				<!-- <div class="mb-3">
					<input type="text" placeholder="Last Name" name="lname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"required>
				</div> -->
				<div class="mb-3">
					<input type="text" name="email" id="email" placeholder="Your Email" class="form-control" autocomplete="off" required>
				</div>
				<div class="mb-3">
					<input type="text" name="mobile" id="mobile" class="form-control" maxlength="10" placeholder="Mobile Number" autocomplete="off" required>
				</div>
				<!-- <div class="mb-3">
					<input type="text" name="state" id="state" class="form-control" placeholder="Your State" autocomplete="off" required>
				</div> -->
				<div class="mb-3">
					<input type="text" name="city" id="city" class="form-control" placeholder="Your City" autocomplete="off" required>
				</div>
				<div class="mb-3">
					<input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="off" required>
				</div>
				<div class="mb-3">
					<input type="password" name="RepeatPassword" class="form-control" id="RepeatPassword" placeholder="Confirm Password" autocomplete="off" required>
				</div>
				<div class="mb-3">
					<h6 class="text-center">Already have an Account ? <a style=" color : green; text-decoration : underline;" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">login here</a></h6>
				</div>
				<div class="modal-footer ">
					<button type="submit" id="submit" name="reg" value="Register Now" class="btn btn-outline-primary">Register Now</button>
					<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">close</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Header Section -->

<!-- Header Section end -->

<!-- Start Home -->
<section class="home  flash" id="home">
	<div class="container-css">
		<br>
		<h1 class=" slideInLeft" data-wow-delay="1s">It's <span>gym</span> time. Let's go</h1>
		<h1 class=" slideInRight" data-wow-delay="1s">We are ready to <span>fit you</span></h1>
		<br>
		

<?php 

if(strlen( $_SESSION["uid"])==0)
    {   
		echo '<a href="#" class="getstart" data-bs-toggle="modal" data-bs-target="#exampleModal">Get Started</a>';
}
else{

}
?>
	</div>



</section>
<!-- End Home -->

<!-- Start Gallery -->
<section class="gallery" id="gallery">
	<h2>Workout Gallery</h2>
	<div class="content">
		<div class="box slideInLeft">
			<img src="images/gallery1.jpg" alt="gallery" />
		</div>
		<div class="box slideInRight">
			<img src="images/gallery2.jpg" alt="gallery" />
		</div>
		<div class="box slideInLeft">
			<img src="images/gallery3.jpg" alt="gallery" />
		</div>
		<div class="box slideInRight">
			<img src="images/gallery4.jpg" alt="gallery" />
		</div>
	</div>
</section>
<!-- End Gallery -->
<!--start Services -->
<section class="about" id="service">
	<div class="container">
		<h4 class="text-center">Our Services</h4>
		<div class="content">
			<div class="box  bounceInUp">
				<div class="inner">
					<div class="img">
						<img src="images/about1.jpg" alt="about" />
					</div>
					<div class="text">
						<h4>Free Consultation</h4>
						<p>Explain what you hope to achieve during the consultation.
							 Are you looking for guidance on creating a personalized workout plan,
							 understanding available classes, or discussing membership options?
							 Personalize the email with your specific fitness goals and preferences, 
							 and remember to follow up if you don't receive a response within a reasonable timeframe.</p>
					</div>
				</div>
			</div>
			<div class="box  bounceInUp" data-wow-delay="0.2s">
				<div class="inner">
					<div class="img">
						<img src="images/about2.jpg" alt="about" />
					</div>
					<div class="text">
						<h4>Best Training</h4>
						<p>Elevate Your Fitness Journey with Our Best Training Programs!
                         Discover Excellence in Fitness with Our Top-Rated Training.
						 Unlock Your Best Self: The Path to Optimal Fitness with Our Best Training Programs.
                          Achieve Your Goals with the Best Training at FAST FITNESS.</p>
					</div>
				</div>
			</div>
			<div class="box  bounceInUp" data-wow-delay="0.4s">
				<div class="inner">
					<div class="img">
						<img src="images/about3.jpg" alt="about" />
					</div>
					<div class="text">
						<h4>Build Perfect Body</h4>
						<p>Unleash your potential and transform your body with our comprehensive fitness programs,
							 personalized guidance, and state-of-the-art equipment.
							 Join us on a journey towards building the perfect body you've always envisioned.
							 Your fitness goals, our expertise - a winning combination for success!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--End Services -->


<!-- start-schedule -->
<section class="schedule section" id="schedule">
	<div class="container">
		<div class="row align-items-center col-lg-12 py-5 col-md-12 col-12"">
				<h2 class=" text-center">Classes Schedule</h2>
			<table class="table table-bordered table-responsive schedule-table aos-init" data-aos="fade-up" data-aos-delay="300">
				<thead class="thead-light">
					<tr class="text-center">
						<th><i class="fa fa-calendar"></i></th>
						<th>Mon</th>
						<th>Tue</th>
						<th>Wed</th>
						<th>Thu</th>
						<th>Fri</th>
						<th>Sat</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><small>7:00 am</small></td>
						<td>
							<strong>Cardio</strong>
							<span>7:00 am - 9:00 am</span>
						</td>
						<td>
							<strong>Power Fitness</strong>
							<span>7:00 am - 9:00 am</span>
						</td>
						<td></td>
						<td></td>
						<td>
							<strong>Yoga Section</strong>
							<span>7:00 am - 9:00 am</span>
						</td>
					</tr>

					<tr>
						<td><small>9:00 am</small></td>
						<td></td>
						<td></td>
						<td>
							<strong>Boxing</strong>
							<span>8:00 am - 9:00 am</span>
						</td>
						<td>
							<strong>Areobic</strong>
							<span>8:00 am - 9:00 am</span>
						</td>
						<td></td>
						<td>
							<strong>Cardio</strong>
							<span>8:00 am - 9:00 am</span>
						</td>
					</tr>

					<tr>
						<td><small>11:00 am</small></td>
						<td></td>
						<td>
							<strong>Boxing</strong>
							<span>11:00 am - 2:00 pm</span>
						</td>
						<td>
							<strong>Areobic</strong>
							<span>11:30 am - 3:30 pm</span>
						</td>
						<td></td>
						<td>
							<strong>Body work</strong>
							<span>11:50 am - 5:20 pm</span>
						</td>
					</tr>

					<tr>
						<td><small>2:00 pm</small></td>
						<td>
							<strong>Boxing</strong>
							<span>2:00 pm - 4:00 pm</span>
						</td>
						<td>
							<strong>Power lifting</strong>
							<span>3:00 pm - 6:00 pm</span>
						</td>
						<td></td>
						<td>
							<strong>Cardio</strong>
							<span>6:00 pm - 9:00 pm</span>
						</td>
						<td></td>
						<td>
							<strong>Crossfit</strong>
							<span>5:00 pm - 7:00 pm</span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>
<!-- End Schedule -->





<section class="price-package" id="Packages">
	<div class="container">
		<h2>Choose Your Package</h2>
		<p class="title-p">Practice Yoga to perfect physical beauty, take care of your soul and enjoy life more fully!</p>
		<div class="content">
			<?php

$sql = "SELECT id, category, titlename, PackageType, PackageDuratiobn, Price, uploadphoto, Description, create_date from tbladdpackage";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        ?>
					<div class="box  bounceInUp">
						<div class="inner">
							<div class="price-tag">
								<h3>$<?php echo htmlentities($result->Price);
        echo " / " . $result->PackageDuratiobn;
        ?></h3>

							</div>
							<div class="img">
								<img src="images/price1.jpg" alt="price" />
							</div>
							<br>
							<div class="text">
								<h4><?php echo $result->titlename; ?></h4>
								<div class="h7">

									<h7><?php echo $result->Description; ?></h7>
								</div>
									<?php if (strlen($_SESSION['uid']) == 0): ?>
									<a href="" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Join Now</a>
							<?php else: ?>
								<form method='post'>
									<input type='hidden' name='pid' value='<?php echo htmlentities($result->id); ?>'>
									<input class='btn' type='submit' name='submit' value='Booking Now' onclick="return confirm('Do you really want to book this package.');">


									</form>
							<?php endif;?>
							</div>
						</div>
					</div>

			<?php }
}?>
		</div>
	</div>
</section>
<!-- End Price -->
<section class="about section" id="about">
               <div class="container">
                    <div class="row">

                            <div class="mt-lg-5 mb-lg-0 mb-4 col-lg-5 col-md-10 mx-auto col-12">
                                <h3 class="mb-4">Hello, we are Gymso</h2>

                                <p data-aos="fade-up" data-aos-delay="400" class="aos-init">You are NOT allowed to redistribute this HTML template downloadable ZIP file on any template collection site. You are allowed to use this template for your personal or business websites.</p>

                                <p data-aos="fade-up" data-aos-delay="500" class="aos-init">If you have any question regarding Gymso Fitness HTML template</a>, you can contact Tooplate</a> immediately. Thank you.</p>

                            </div>

                            <div class="ml-lg-auto col-lg-3 col-md-6 col-12 aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                                <div class="team-thumb">
                                    <img src="img/trainer/1.png" class="img-fluid" alt="Trainer">

                                    <div class="team-info d-flex flex-column">

                                        <h3>Mary Yan</h3>
                                        <span>Yoga Instructor</span>

                                       
                                    </div>
                                </div>
                            </div>

                            <div class="mr-lg-auto mt-5 mt-lg-0 mt-md-0 col-lg-3 col-md-6 col-12 aos-init aos-animate" data-aos="fade-up" data-aos-delay="800">
                                <div class="team-thumb">
                                    <img src="img/trainer/2.png" class="img-fluid" alt="Trainer">

                                    <div class="team-info d-flex flex-column">

                                        <h3>Catherina</h3>
                                        <span>Body trainer</span>

                                       
                                    </div>
                                </div>
                            </div>

                    </div>
               </div>
     </section>

<!-- Footer Section -->
<?php include 'include/footer.php';?>
<!-- Footer Section end -->


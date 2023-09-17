<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
   <title>admin | Total users</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .add-user{
        display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    }
  </style>

</head>
<div class="modal fade" id="signupmodel" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" id="exampleModalLabel">Registration</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<form action="register.php" method="post" class="modal-body">


				<div class="mb-3">
					<input type="text" placeholder="First Name" name="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
				</div>
				
				<div class="mb-3">
					<input type="text" name="email" id="email" placeholder="Your Email" class="form-control" autocomplete="off" required>
				</div>
				<div class="mb-3">
					<input type="text" name="mobile" id="mobile" class="form-control" maxlength="10" placeholder="Mobile Number" autocomplete="off" required>
				</div>
				
				<div class="mb-3">
					<input type="text" name="city" id="city" class="form-control" placeholder="Your City" autocomplete="off" required>
				</div>
				<div class="mb-3">
					<input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="off" required>
				</div>
				<div class="mb-3">
					<input type="password" name="RepeatPassword" class="form-control" id="RepeatPassword" placeholder="Confirm Password" autocomplete="off" required>
				</div>
			
				<div class="modal-footer ">
					<button type="submit" id="submit" name="register" value="Register Now" class="btn btn-outline-primary">Register Now</button>
					<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">close</button>
				</div>
			</form>
		</div>
	</div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-body">
          <form method="post">
         <div class="row">
          <div class="col-md-12">
            <label>Payment Type</label>
            <select name="Paymenttype" id="Payment" class="form-control">
              <option value="">--select--</option>
              <option value="Partial Payment">Partial Payment</option>
              <option value="Full Payment">Full Payment</option>
            </select>
                <input type="hidden" name="bookingiid" id="bookingiid" value="<?php echo $bookindid; ?>">
            <br>
          </div>
           <div class="col-md-12" id="ParcialPay">
            <label>Partial Payment</label>
            <input type="text" name="ParcialPayment" id="ParcialPayment" class="form-control">
            <input type="hidden" name="totalpay" value="<?php echo $gpayment;?>">
          
            <input type="text" name="remain" id="remian" value="<?=$remain;  ?> ">
              <br>
          </div>
             <input type="hidden" name="fullamount" value="<?php echo $pricess-$gpayment;?>">
         </div>
         <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
       </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
   <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
     
      
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
                <div class="add-user">

                    <h3>Total users</h3>
                    <a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#signupmodel">Add user</a>
                </div>
              <hr />
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>Sr.No</th>
    
        <th> Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>city</th>
        <th>Create Date</th>
       <th>Action</th>
                    
                  </tr>
                </thead>
                <!-- // //    $sql ="SELECT id, name,email,mobile,create_date from tbladmin where id=:adminid "; -->
               <?php
                    $sql = 'SELECT * FROM tbluser';

                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>

                <tbody>
                  <tr>
                    <td><?php echo($cnt);?></td>
                    <td><?php echo htmlentities($result->fname);?></td>
                    <td><?php echo htmlentities($result->email);?></td>
                    <td><?php echo htmlentities($result->mobile);?></td>
                    <td><?php echo htmlentities($result->city);?></td>
                    <td><?php echo htmlentities($result->create_date);?></td>
                  
                  
                     <td>
                       <a  href="buy-pack.php?id=<?php echo htmlentities($result->id);?>"><button class="btn btn-success" type="button">Buy Package</button></a> 
                      <a   onclick="return confirm('Are you sure you want to delete this user ?')" href="delete.php?id=<?php echo htmlentities($result->id);?>"><button class="btn btn-danger" type="button">Delete</button></a> 

                    </td>
                  </tr>
                    <?php  $cnt=$cnt+1; } } ?>
              
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
     <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  
  </body>
</html>
<?php } ?>



<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
    
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $sql="SELECT * FROM tbluser WHERE id=:id";
      $query = $dbh -> prepare($sql);
      $query->bindParam(':id',$id,PDO::PARAM_STR);
      $query -> execute();
      $countriesList = $query->fetch(PDO::FETCH_ASSOC);
      $name = $countriesList['fname']; 
    
 
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive">
  
    <title>Admin | Buy Package </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
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
               <h3>Buy Packages</h3>
              <hr />
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                    <?php

                     $iid = $_GET['id'];

                    ?>
                  <tr>

                    <th>Sr.No</th>
                    <th>Category</th>
                    <th>Package Type</th>
                    <th>Title</th>
                    <th>Package Duratiobn</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
              
                   <?php
                   include  'include/config.php';
            
                  $sql="SELECT t1.id as packageid,tbluser.id,t2.*,t3.*,t1.* FROM tbladdpackage as t1
                  join tblcategory as t2
                  on t1.category=t2.id
                  join tblpackage as t3
                  on t1.PackageType=t3.id
                  JOIN tbluser WHERE tbluser.id=:id";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':id',$id,PDO::PARAM_STR);

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
                      <td><?php echo htmlentities($result->category_name);?></td>
                      <td><?php echo htmlentities($result->PackageName);?></td>
                      <td><?php echo htmlentities($result->titlename);?></td>
                      <td><?php echo htmlentities($result->PackageDuratiobn);?></td>
                      <td><?php echo htmlentities($result->Price);?></td>
                      <?php $id=$result->category_name;?>
                      <input type="hidden" name="userid" value="<?=$iid; ?>">
                      <td>

                   <a onclick="return confirm('Are you to buy this package ?')" href="buy-package.php?pid=<?php echo htmlentities($result->packageid);?>&id=<?php echo htmlentities($iid); ?>" class="btn btn-success">Buy</a>
                  
                  </td>

                  </tr>
                   
                 
                </tbody>

     <!--    // end modal popup code........ -->
                 <?php  $cnt=$cnt+1; } } ?>
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
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
   
  </body>
</html>
<?php } ?>
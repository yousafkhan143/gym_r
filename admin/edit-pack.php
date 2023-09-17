<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit'])){
$AddPackage = $_POST['addPackage'];
$category = $_POST['category'];
$sql="update tblpackage set PackageName:Package Values(:Package,:category)";
$query = $dbh -> prepare($sql);
$query->bindParam(':Package',$AddPackage,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query -> execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId>0)
{
$msg= "Package Add Successfully";
echo "<script>window.location.href='add-package.php'</script>";
 }
else {

$errormsg= "Data not insert successfully";
 }
}

//Delete Record Data

if(isset($_REQUEST['del']))
{
$uid=intval($_GET['del']);
$sql = "delete from tblpackage WHERE  id=:id";
$query = $dbh->prepare($sql);
$query-> bindParam(':id',$uid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Record Delete successfully');</script>";
echo "<script>window.location.href='add-package.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
   <title>Admin | Add Package Type</title>
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
     <h3>Edit Package</h3>
     <hr />
      <div class="row">
        
        <div class="col-md-6">
          <div class="tile">
          <!---Success Message--->  
          <?php if($msg){ ?>
          <div class="alert alert-success" role="alert">
          <strong>Well done!</strong> <?php echo htmlentities($msg);?>
          </div>
          <?php } ?>

          <!---Error Message--->
          <?php if($errormsg){ ?>
          <div class="alert alert-danger" role="alert">
          <strong>Oh snap!</strong> <?php echo htmlentities($errormsg);?></div>
          <?php } ?>

             
              <form class="row" method="post">
            <?php
              if (isset($_GET['cid'])) {
                        $id = $_GET['cid'];
              }
              ?>
                 <div class="form-group col-md-12">
                  <label class="control-label">Add Category</label>
                  <select class="form-control" name="category" id="category">
                <?php
                   $stmt = $dbh->prepare("SELECT * FROM tblcategory");
                   $stmt->execute();
                   $countriesList = $stmt->fetchAll();
                  foreach($countriesList as $country){
                  echo "<option value='".$country['id']."'>".$country['category_name']."</option>";
                  }
                  ?>  
                
                
                  </select>
                </div>
                <div class="form-group col-md-12">
                    <?php
                    if (isset($_GET['cid'])) {
                        $id = $_GET['cid'];
                     $sql = "SELECT * FROM tblpackage WHERE id=:cid limit 1";
                     $stmtSelect = $dbh->prepare($sql);
                     $stmtSelect->bindParam(':cid', $id);
                     $stmtSelect->execute();
                   $row =  $stmtSelect->fetch(PDO::FETCH_OBJ);
                        # code...
                    }


                   
                    ?>
                  <label class="control-label">Edit Package</label>
                  <input class="form-control" name="addPackage" id="addPackage" type="text" value="<?=$row->PackageName ?>" placeholder="Enter Add Package">
                </div>
                <div class="form-group col-md-4 align-self-end">
                  <input type="submit" name="submit" id="submit" class="btn btn-primary" value=" Submit">
                </div>
              </form>
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
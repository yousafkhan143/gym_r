<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['update'])){
    $id = $_GET['cid'];
$category = $_POST['category'];
$sql="UPDATE tblcategory SET category_name=:category WHERE id=:cid ";
$query = $dbh -> prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':cid',$id,PDO::PARAM_INT);

if($query -> execute())
{
// $msg= "Category Updated Successfully";
echo "<script>alert('Category Updated Successfully');</script>";
echo "<script>window.location.href='add-category.php'</script>";
 }
else {

// $errormsg= "Category not updated successfully";
echo "<script>alert('Category not updated successfully');</script>";
echo "<script>window.location.href='add-category.php'</script>";
 }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
   <title>Admin | Categories</title>
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
     <h3>Categories</h3>
     <hr />
      <div class="row">
        
        <div class="col-md-6">
          <div class="tile">
       

           
            <div class="tile-body">
            <?php 
                  if(isset($_GET['cid']))
                  {
                    $id = $_GET['cid'];
                    $sql = "SELECT * FROM tblcategory WHERE id=:cid ";
                     $stmtSelect = $dbh->prepare($sql);
                     $stmtSelect->bindParam(':cid', $id);
                     $stmtSelect->execute();
                   $row =  $stmtSelect->fetch(PDO::FETCH_OBJ);
                  }
                 ?>
              <form  method="post">
             
                <div class="form-group col-md-12">
                  <label class="control-label">Edit Category</label>
                  <input class="form-control" name="category" id="category" value="<?=$row->category_name; ?>" type="text" placeholder="Enter Add Category">
                </div>
                <div class="form-group col-md-4 align-self-end">
                
                  <input type="submit" name="update" id="submit" class="btn btn-primary" value=" Submit">
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
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  
  </body>
</html>
<?php } ?>
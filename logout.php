<?php
session_start();
require_once('include/config.php');
session_unset();
session_destroy();
// header("location: index.php?Error=you have Successfuly logout");
echo "<script>alert('you have Successfuly logout');</script>";
echo "<script>window.location.href='index.php'</script>";

exit();
?>    
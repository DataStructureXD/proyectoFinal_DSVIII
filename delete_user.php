<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
    if($_SESSION['user_data']['usertype']!=1){
        header("Location:student_home.php");
  }
  if(!isset($_REQUEST['id'])){
      header("Location:teacher_home.php?error=Please Enter ID");
  } 

  if(isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $query = "DELETE FROM users WHERE id = $id";
    $result = mysqli_query($con, $query);
    if(!$result) {
      die("Query Failed.");
    }
    else{
      header("Location:teacher_home.php?success=Delete Successfully");
    }
  }
  ?>

<?php
        }
        else{
            header("Location:index.php?error=UnAuthorized Access");
        }
?>
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
	$qr=mysqli_query($con,"select * from users where id='".$_REQUEST['id']."'");
	if(mysqli_num_rows($qr)==0){
		header("Location:teacher_home.php?error=Student ID Not Found");	
	}

	$data_id=$_REQUEST['id'];

	$nombre=$_REQUEST['nombre'];
	$telefono=$_REQUEST['telefono'];
	$correo=$_REQUEST['correo'];
	$contraseña=$_REQUEST['contraseña'];

	
	$qr_update="UPDATE users set 
	name='$nombre',
	phone='$telefono',
	email='$correo',
	password='$contraseña' WHERE id='$data_id'" ;
	
	$result = mysqli_query($con,$qr_update);

	if($result){
		header("Location:teacher_home.php?success=Edited Successfully");
	}else{
		header("Location:teacher_home.php?error=Edited Error");
	}
?>

<?php
}
else{
	header("Location:index.php?error=UnAuthorized Access");
}
?>
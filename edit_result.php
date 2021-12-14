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

	$is_result=false;
	$result_data=array();
	$result_qr=mysqli_query($con,"select * from users where id='".$_REQUEST['id']."'");
	if(mysqli_num_rows($result_qr)>0){

		$is_result=true;
		$row=mysqli_fetch_assoc($result_qr);

		$result_row=$row;

		$result_data_qr=mysqli_query($con,"select * from users where id='".$result_row['id']."'");
		
		while ($row=mysqli_fetch_assoc($result_data_qr)) {
			array_push($result_data,$row);
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Result</title>
	<?php include 'header.php'; ?>
</head>
<body>
	<div class="container">

		<form action="edit_result_post.php" method="post">
	
		<div class="row">
			<div col-lg-12>
				<a href="teacher_home.php" style="margin: 10px" class="btn btn-success">Home</a>
			</div>
		</div>

		<div class="row">
			<div col-lg-12>
				<h2 style="margin: 10px">Edit Result</h2>
			</div>
		</div>

		<?php if($is_result){ ?>

			<div class="row">

				<?php foreach($result_data as $result)  { ?>
					<div class="col-lg-12 form-group">
						<input type="hidden" name="id" value="<?php echo $result['id']; ?>">
						<label>Nombre</label>	
						<input type="text" name="nombre" value="<?php echo $result['name']; ?>" class="form-control">	
						<label>Telefono</label>	
						<input type="text" name="telefono" value="<?php echo $result['phone']; ?>" class="form-control">	
						<label>Correo Electronico</label>	
						<input type="text" name="correo" value="<?php echo $result['email']; ?>" class="form-control">	
						<label>Contraseña</label>	
						<input type="text" name="contraseña" value="<?php echo $result['password']; ?>" class="form-control">	
					</div>
				<?php }
				
				?>
			</div>
			<div class="row">

				<div class="col-lg-12">
					<button class="btn btn-success" type="submit" name="subir">Edit Result</button>
				</div>

			</div>	
				<?php			
				} else { ?>

				<div class="row">
					<div class="col-lg-12">
						No Result Found
					</div>
				</div>

				<?php } ?>	

		 </form>
	</div>
</body>
</html>
<?php
}
else{
	header("Location:index.php?error=UnAuthorized Access");
}
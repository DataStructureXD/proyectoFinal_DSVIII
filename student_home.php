<?php
session_start();
include 'connect.php';
if(isset($_SESSION['user_data'])){
	if($_SESSION['user_data']['usertype']!=2){
		header("Location:teacher_home.php");
	}

	$result_data=array();
	$is_result=false;
	$result=mysqli_query($con,"SELECT * from users WHERE id='".$_SESSION['user_data']['id']."'");
	if(mysqli_num_rows($result)>0){
		$is_result=true;
		$result_row=mysqli_fetch_assoc($result);

		$data_qr=mysqli_query($con,"select * from users where id='".$result_row['id']."'");

		while($row=mysqli_fetch_assoc($data_qr)){
			array_push($result_data,$row);
		}
		echo mysqli_error($con);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Result</title>
	<?php include 'header.php'; ?>
	<?php include 'css.php'; ?>
</head>
<body>
<div class="container">
	<div class="row">
	<div class="col-lg-12">
		<a href="logout.php" class="btn btn-success">Logout</a>
	</div>
	</div>
	<div class="row">
	<?php if($is_result) { ?>
		<div class="col-lg-12">
			<table class="table">
				<tr><th colspan="5">Result</th></tr>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Password</th>
				</tr>

				<?php foreach($result_data as $result){ ?>
					<tr>
					<td><?php echo $result['id']; ?></td>
				 	<td><?php echo $result['name']; ?></td>
				 	<td><?php echo $result['email']; ?></td>	
				 	<td><?php echo $result['phone']; ?></td>	
				 	<td><?php echo $result['password']; ?></td>	
				 	
					</tr>
				<?php } ?>
			</table>
		</div>
	<?php } else { ?>
		<div class="col-lg-12">
			<h2>Result Not Found!</h2>
		</div>
	<?php }	?>
</div>
</div>

<?php include 'footer.php';?>

</body>
</html>	
<?php	
}
else{
	header("Location:index.php?error=UnAuthorized Access");
}
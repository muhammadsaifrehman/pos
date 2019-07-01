<?php 
	include "../includes/connection.php";
	include "../includes/session.php";
	$id=$_GET["id"];
	
	if ($id==$user) {
		$_SESSION["error"]=" Cannot delete yourself";
		echo "<script>window.location='admin_record';</script>";
	}
	else
	{
		$sql_delete=mysqli_query($con,"DELETE FROM users WHERE id='$id'");
		if ($sql_delete) {
			$_SESSION["message"]="Record is deleted";
			echo "<script>window.location='admin_record';</script>";
		}
	}

?>
<?php include("../includes/connection.php"); ?>



<?php
	error_reporting(0); 
	session_start();
	$user=$_SESSION["user_name"];
	if ($user) {
	
	}
	else{
		echo "<script type='text/javascript'>window.location='../index/login'</script>";
	}
	function error_message(){
		if ($_SESSION["error"]) {
			$_SESSION["error"]='<div class="row" id="message"><div class="col-md-3"></div><div class="col-md-6"><div class="alert alert-danger" style="top:30px;text-align:center;" ><i class="fa fa-times"></i> '.$_SESSION["error"].'</div></div>';
			echo $_SESSION["error"];
		}
		$_SESSION["error"]="";

	}
	function welcome_message(){
		if ($_SESSION["welcome"]) {
			$_SESSION["welcome"]='<div class="alert alert-success" style="margin-top:30px;" id="message"><i class="fa fa-check"></i> '.$_SESSION["welcome"].'</div>';
			echo $_SESSION["welcome"];
		}
		$_SESSION["welcome"]="";

	}
	function session_message(){
		if ($_SESSION["message"]) {
			$_SESSION["message"]='<div class="row" id="message"><div class="col-md-3"></div><div class="col-md-6"><div class="alert alert-success" style="top:30px;text-align:center;" ><i class="fa fa-check"></i> '.$_SESSION["message"].'</div></div>';
			echo $_SESSION["message"];
		}
		$_SESSION["message"]="";

	}

?>

<script src="../jquery-1.12.4.min.js"></script>
        <script>
        //When the page has loaded.
        $( document ).ready(function(){
            $('#message').fadeIn(function(){
               $('#message').delay(3000).fadeOut(); 
            });
        });
        </script>
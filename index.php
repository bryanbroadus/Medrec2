<?php
session_start();
if(!include_once "config.php"){
           header("location:install.php");
 }
if (!defined('posnicEntry')) {
    define('posnicEntry', true);
}
if(isset($_SESSION['username'])) {
    if($_SESSION['usertype'] =='admin') // if session variable "username" does not exist.
	header("location:dashboard.php"); // Re-direct to index.php
}
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to MedRec | Medical Records Management System !</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
	
	<!-- Stylesheets -->
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/cmxform.css">
	<link rel="stylesheet" href="js/lib/validationEngine.jquery.css">
	
	<!-- Scripts -->
	<script src="js/lib/jquery.min.js" type="text/javascript"></script>
	<script src="js/lib/jquery.validate.min.js" type="text/javascript"></script>
	
	<script>
	/*$.validator.setDefaults({
		submitHandler: function() { alert("submitted!"); }
	});*/
	
	$(document).ready(function() {
		
		// validate signup form on keyup and submit
		$("#login-form").validate({
			rules: {
				username: {
					required: true,
					minlength: 3
				},
				password: {
					required: true,
					minlength: 3
				}
			},
			messages: {
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 3 characters"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 3 characters long"
				}
			}
		});
	
	});

	</script>

	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
</head>
<body>

<!--    Only Index Page for Analytics   -->
<?php include_once("analyticstracking.php") ?>
	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width">
		
			<!--<a href="#" class="round button dark ic-left-arrow image-left ">See shortcuts</a>-->

		</div> <!-- end full-width -->	
	
	</div> 
	<!-- end top-bar -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="login-page">
	  	<div class="container">
	  	
			  <form action="checklogin.php" method="POST" class="form-login" autocomplete="off">
			  <?php 
				
				if(isset($_REQUEST['msg']) && isset($_REQUEST['type']) ) {
					
					if($_REQUEST['type'] == "error")
						$msg = "<div class='error-box round'>".$_REQUEST['msg']."</div>";
					else if($_REQUEST['type'] == "warning")
						$msg = "<div class='warning-box round'>".$_REQUEST['msg']."</div>"; 
					else if($_REQUEST['type'] == "confirmation")
						$msg = "<div class='confirmation-box round'>".$_REQUEST['msg']."</div>"; 
					else if($_REQUEST['type'] == "information")
						$msg = "<div class='information-box round'>".$_REQUEST['msg']."</div>"; 	
						
					echo $msg;						
				}
				?>
		        <h2 style="padding:10px;" class="form-login-heading"><img src="upload/posnic.png" style="height: 60px;"></h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" placeholder="Enter Username" name="username" autofocus  />
		            <br>
					<input type="password" name="password" placeholder="Enter Password" class="form-control"  />
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>
		
		                </span>
		            </label>
		            <button class="btn btn-primary btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		<div class="registration">
		    <font color="#FF0000"><?php error_reporting (E_ALL ^ E_NOTICE);
					echo $_GET['msg']; ?></font>
		</div>
		
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your e-mail address below to reset your password.</p>
		                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
		
		                      </div>
		                      <div class="modal-footer">
								  <a href="forget_pass.php" class="btn btn-success">Submit</a>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		
		      </form>	  	
	  	
	  	</div>
	  </div>

     
	
	
	
	<!-- FOOTER -->
	<div id="footer">

	</div> <!-- end footer -->
        
 <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("images/doctor-5f_big_m.jpg", {speed: 500});
    </script>      
</body>
</html>
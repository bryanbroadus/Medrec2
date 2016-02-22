<?php session_start();?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - User</title>
	
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
				uname: {
					required: true,
					minlength: 5
				},
				password: {
					required: true,
					minlength: 5
				},
				answer: {
					required: true,
					minlength: 5
				}
			},
			messages: {
				uname: {
					required: "Please Enter The User Name",
					minlength: "Your User Name must consist of at least 5 characters"
				},
				password: {
					required: "Please Enter The Password",
					minlength: "Your Password must be at least 5 characters long"
				},
				answer: {
					required: "Please Enter Security Question Answer",
					minlength: "Your Security Question Answer must be at least 5 characters long"
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
	
	
	
	<!-- HEADER -->
	<div id="header" style="background: #004D8F;">
		
		<div class="page-full-width cf">
	
			<div id="login-intro" class="fl">
			
				<h1>User Details </h1>
				
			
			</div> <!-- login-intro -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 39px height. -->
			<a href="#" id="company-branding" class="fr"><img src="upload/posnic.png" alt="Medical Records Management System" /></a>
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	<?php
        	include("lib/db.class.php");
       
	       $host=$_SESSION['host'] ;
            $user=$_SESSION['user'];
            $pass=$_SESSION['pass'];
           $name=$_SESSION['db_name'];
	// Open the base (construct the object):
	$db = new DB($name, $host, $user, $pass);
	
	# Note that filters and validators are separate rule sets and method calls. There is a good reason for this. 

	require "lib/gump.class.php";
?>
  <?php
        if(isset($_POST['submit']) and isset($_POST['uname']) and isset($_POST['password']) and isset($_POST['answer']) ){
            $host=$_SESSION['host'] ;
            $user=$_SESSION['user'];
          $pass=$_SESSION['pass'];
           $name=$_SESSION['db_name'];
            $con=mysqli_connect("$host","$user","$pass","$name");
 $uname=$_POST['uname'];
 $password=$_POST['password'];
 $answer=$_POST['answer'];
           $db->query("UPDATE stock_user  SET username ='".$uname."',password='".$password."',answer='".$answer."'");
          header("location:next_store_details.php");
     // exit;
        }
        ?>
	
	<!-- MAIN CONTENT -->
	<div id="content">
	
		<form action="" method="POST" id="login-form" class="cmxform" autocomplete="off">
		
		<fieldset>
				
				<p>
                                    <label>UserName</label>
                                    <input type="text" name="uname" id="uname" class="round full-width-input"  placeholder="Enter User Name" autofocus  /> 
                                </p>
				<p>
                                    <label>Password</label>
                                    <input type="password" name="password" id="password" class="round full-width-input"  placeholder="Enter Password" autofocus  /> 
                                </p>
				<p>
                                    <label>Security Question</label>
                                    What's your favorite movie?
                                    <input type="text" name="answer" id="answer" class="round full-width-input"  placeholder="Enter Answer" autofocus  /> 
                                </p>
				
				<!--<a href="dashboard.php" class="button round blue image-right ic-right-arrow">LOG IN</a>-->
				<input type="submit" class="button round blue image-right ic-right-arrow" name="submit" value="Next" />
                                    &nbsp;</fieldset>
		</form>
		
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<?php include ("footer.php");?><!-- end footer -->

</body>
</html>


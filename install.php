<?php

?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - Login to Control Panel</title>
	
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
				host: {
					required: true,
					minlength: 3
				},
				username: {
					required: true,
					minlength: 3
				}
			},
			messages: {
				host: {
					required: "Please Enter The Host",
					minlength: "Your Host must consist of at least 3 characters"
				},
				username: {
					required: "Please Enter The User Name",
					minlength: "Your User Name must be at least 3 characters long"
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
			
				<h1>Installation </h1>
				
			
			</div> <!-- login-intro -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 39px height. -->
			<a href="#" id="company-branding" class="fr"><img src="<?php if(isset($_SESSION['logo'])) { echo "upload/".$_SESSION['logo'];}else{ echo "upload/posnic.png"; } ?>" alt="Medical Records Management System" /></a>
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
	
		<form action="database_install.php" method="POST" id="login-form" class="cmxform" autocomplete="off">
		
			<fieldset>
				<p> <?php 
				
				if(isset($_REQUEST['msg'])) {
					
					$msg=$_REQUEST['msg'];
					echo "<p style=color:red>$msg</p>";						
				}
				?>
				
				</p>
				<p>
					<label for="login-host">DataBase Host Name</label>
                                        <input type="text" id="host" class="round full-width-input" placeholder="ENTER DATABASE HOST NAME" name="host" autofocus  />
				</p>

				<p>
					<label for="login-user">DataBase User Name</label>
                                        <input type="text" id="username" name="username" placeholder="ENTER DATABASE USERNAME" class="round full-width-input"  />
				</p>
				<p>
					<label for="login-password">DataBase User Password</label>
					<input type="password" id="password" name="password" placeholder="ENTER DATABASE PASSWORD" class="round full-width-input"  />
				</p>
				
			
				
				<!--<a href="dashboard.php" class="button round blue image-right ic-right-arrow">LOG IN</a>-->
				<input type="submit" class="button round blue image-right ic-right-arrow" name="submit" value="INSTALL" />
			</fieldset>

		</form>
		
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<div id="footer">
		<p>Any Queries email to <a href="mailto:info@kazimeida.co?subject=MedRec%20Query">info@kazimedia.co</a>.</p>
		
	
	</div> <!-- end footer -->
<?php include ("footer.php");?><!-- end footer -->
</body>
</html>
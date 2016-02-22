<?php
include_once("init.php");

                                if(isset($_POST['old_pass']) and isset($_POST['new_pass']) and isset($_POST['confirm_pass'])){
                                    $username=$_SESSION['username'];
                                    $old_pass=$_POST['old_pass'];
                                 $count = $db->countOf("stock_user", "username='$username' and password='$old_pass'");
							if($count==0)
							{
                                                            $msg="<span class=\"danger\">Old Password for <b>". $_SESSION['username']."</b> does not match our Records</br> Please recheck your entry and try again</span>" ;
																header("Location:change_password.php?msg=$msg");
                                                        }else{
                                                            if(trim($_POST['new_pass'])==trim($_POST['confirm_pass'])){
                                                                $con=$_POST['confirm_pass'];
                                                                $db->query("update stock_user  SET password='$con' where username='$username'");
                                                                $msg="Password Details for ". $_SESSION['username']." Updated successfully" ;
																header("Location:change_password.php?msg=$msg");
                                                            }else{
                                                                 $msg="<span><i class=\"fa fa-info-circle\"></i></span> Error ". $_SESSION['username']." details could not be updated" ;
																header("Location:change_password.php?msg=$msg");
                                                            }
                                                        }
                                }
                                ?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - Change Password</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<?php include_once("tpl/common_js.php"); ?>
	<script src="js/script.js"></script>                
</head>
<body>

	<!-- TOP BAR -->
	<?php include_once("tpl/top_bar.php"); ?>
	<!-- end top-bar -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="side-menu fl">
				
				<h3>Quick Links</h3>
				<ul>
					<li><a href="add_sales.php">Add Invoice</a></li>
					<li><a href="view_payments.php">Add Payment</a></li>
					<li><a href="add_customer.php">Add Patient</a></li>
					<li><a href="add_product.php">Add Service / Product</a></li>
					<li><a href="view_report.php">Reports</a></li>
					<li><a href="add_treatment.php">Add New Treatment</a></li>
					<li><a href="view_treatment_book.php">View Treatment Book</a></li>
				</ul>
				
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Change Password</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">					
					<?php
					//Gump is libarary for Validatoin
					 if(isset($_GET['msg'])){
                     $data=$_GET['msg'];
                     $msg='<p style="color:#32AE2A;font-size:1.2em;font-family:Verdana, Times New Roman, Times, san-serif;">'.$data.'</p><p><a href="change_password.php"><i class="fa fa-2x fa-rotate-left"></i> Try Again</a></p><p> <a href="dashboard.php"><i class="fa fa-2x fa-home"></i>Go Back Home</a></p>';//
                                            ?>																		
					 <script  src="dist/js/jquery.ui.draggable.js"></script>
					<script src="dist/js/jquery.alerts.js"></script>
					<script src="dist/js/jquery.js"></script>
					<link rel="stylesheet"  href="dist/js/jquery.alerts.css" >
																	  
																<script type="text/javascript">
						
										jAlert('<?php echo  $msg; ?>', 'MedRec');
								
					</script>
                                                        <?php
                                        }
                      ?>
				 <form action="" method="post">
				<table style="width:600px; margin-left:50px; float:left;" border="0" cellspacing="0" cellpadding="0">
                                   
                                    <tr>
                                        <td>Old Password</td><td><input type="password" name="old_pass" ></td></tr>
                                  <tr>
                                      <td>New Password</td><td><input type="password" name="new_pass" ></td></tr>
                                      <tr>
                                      <td>Confirm Password</td><td><input type="password" name="confirm_pass"></td>
				  </tr>
                                 
                                  <tr><td>
                        <button type="submit" name="Submit" class="btn btn-success text-capitalize"><i class="fa fa-upload"></i> Submit</button>
							
                     </td>
					 <td>
						<button type="reset" name="Reset" class="btn btn-danger text-capitalize"><i class="fa fa-times-circle"></i> Reset</button>
					 </td></tr>
				
				</table>
				</form>		
				
					</div> <!-- end content-module-main -->
							
				
				</div> <!-- end content-module -->
				
				
		
		</div> <!-- end full-width -->
			
                </div>
            </div>

	
	<!-- FOOTER -->
	<?php include ("footer.php");?><!-- end footer -->

</body>
</html>
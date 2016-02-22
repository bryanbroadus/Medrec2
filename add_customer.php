<?php
include_once("init.php");

					//Gump is libarary for Validatoin
					
					if(isset($_POST['name'])){
					$_POST = $gump->sanitize($_POST);
					$gump->validation_rules(array(
						'name'    	  => 'required|max_len,100|min_len,3',
						'patient_id'    => 'required|alpha_numeric|max_len,20',
						'sex'    => 'required|max_len,6',
						'insurance'    => 'required|max_len,25',
						'address'     => 'max_len,200',
						'email'     => 'max_len,50',
						'contact1'    => 'alpha_numeric|max_len,20',
						'contact2'    => 'alpha_numeric|max_len,20'
					));
					
					$gump->filter_rules(array(
						'name'    	  => 'trim|sanitize_string|mysql_escape',
						'patient_id'  => 'trim|sanitize_string|mysql_escape',
						'sex'  => 'trim|sanitize_string|mysql_escape',
						'insurance'  => 'trim|sanitize_string|mysql_escape',
						'address'     => 'trim|sanitize_string|mysql_escape',
						'email'     => 'trim|sanitize_string|mysql_escape',
						'contact1'    => 'trim|sanitize_string|mysql_escape',
						'contact2'    => 'trim|sanitize_string|mysql_escape',
					));
				
					$validated_data = $gump->run($_POST);
					$name 		= "";
					$patient_id	= "";
					$sex	= "";
					$insurance	= "";
					$address 	= "";
					$email 	= "";
					$contact1	= "";
					$contact2 	= "";
					

					if($validated_data === false) {
							echo $gump->get_readable_errors(true);
					} else {
						
						
							$name=mysql_real_escape_string($_POST['name']);
							$patient_id=mysql_real_escape_string($_POST['patient_id']);
							$sex=mysql_real_escape_string($_POST['sex']);
							$insurance=mysql_real_escape_string($_POST['insurance']);
							$address=mysql_real_escape_string($_POST['address']);
							$email=mysql_real_escape_string($_POST['email']);
							$contact1=mysql_real_escape_string($_POST['contact1']);
							$contact2=mysql_real_escape_string($_POST['contact2']);							
							$selected_date=$_POST['date'];
							$selected_date=strtotime( $selected_date );
							$mysqldate = date( 'Y-m-d', $selected_date );
							$count = $db->countOf("customer_details", "customer_name='$name'");
							if($count==1)
							{

                                                                                                       $data='Duplicate Entry. Please Verify';
                                            $msg='<p style="color:red;font-family:Verdana, Times New Roman, Times, sans-serif;">'.$data.'</p>';//
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
							else
							{
								
									if($db->query("insert into customer_details (id,patient_id,customer_name,sex,patient_dob,insurance,customer_address,customer_contact1,customer_contact2,patient_email,balance) values(NULL,'$patient_id','$name','$sex','$mysqldate','$insurance','$address','$contact1','$contact2','$email',0)"))
                                                                        {
																		
                                                                             $msg=" $name Details Added " ;
				header("Location: add_customer.php?msg=$msg");
                                exit();
                                                                        }
									else
										echo "<div class='error-box round'>Problem in Adding !</div>" ;
							
							}
						}
				}
?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - Patient Management</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="js/date_pic/date_input.css">
	<link rel="stylesheet" href="lib/auto/css/jquery.autocomplete.css">
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<?php include_once("tpl/common_js.php"); ?>
	<script src="js/script.js"></script>  
	<script src="js/date_pic/jquery.date_input.js"></script>  
        <script src="lib/auto/js/jquery.autocomplete.js "></script> 
		<script>
	/*$.validator.setDefaults({
		submitHandler: function() { alert("submitted!"); }
	});*/
	$(document).ready(function() {
		 $('#test1').jdPicker();
		// validate signup form on keyup and submit
		$("#form1").validate({
			rules: {
				name: {
					required: true,
					minlength: 3,
					maxlength: 200
				},
				patient_id: {
					minlength: 3,
					maxlength: 10
				},
				address: {
					minlength: 3,
					maxlength: 500
				},
				contact1: {
					minlength: 3,
					maxlength: 20
				},
				contact2: {
					maxlength: 20
				}
			},
			messages: {
				name: {
					required: "Please enter a Patient Name",
					minlength: "Customer must consist of at least 3 characters"
				},
				patient_id: {
					required: "Please enter Patient ID",
					minlength: "Customer must consist of at least 3 characters"
				},
				address: {
					minlength: "Customer Address must be at least 3 characters long",
					maxlength: "Customer Address cant exceed 500 characters"
				}
			}
		});
	});

	</script>

</head>
<body>

	<!-- TOP BAR -->
	<?php include_once("tpl/top_bar.php"); ?>
	<!-- end top-bar -->
	
	
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="side-menu fl">
				
				<h3>Patient Management</h3>
				<ul>
					<li><a href="add_customer.php">Add Patient</a></li>
					<li><a href="view_customers.php">View Patients</a></li>
					<li><a href="add_treatment.php">Add New Treatment</a></li>
				</ul>
				                                    
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Add Patient</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
				
							
					<?php
						
				
					//Gump is libarary for Validatoin
					 if(isset($_GET['msg'])){
                                                                              $data=$_GET['msg'];
                                               $msg='<p style="color:#153450;font-size:1.2em;font-family:Verdana, Times New Roman, Times, san-serif;">'.$data.'</p><p><a href="add_customer.php"><i class="fa fa-3x fa-plus"></i> Add Another Patient</a></p><p> <a href="view_customers.php"><i class="fa fa-3x fa-eye"></i>View Patients</a></p>';//
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
				
				<form name="form1" method="post" id="form1" action="">
                  
                  
                  <table class="table"  border="0" cellspacing="0" cellpadding="0">
				  <tbody>
                    <tr>
                      <td><span class="man">*</span>Patient Name:</td>
                      <td><input name="name" placeholder="Enter Full Patient Name" type="text" id="name" maxlength="200"  class="round default-width-input" value="<?php echo $name; ?>" /></td>
					  <td><span class="man">*</span>Patient ID:</td>
                      <td><input name="patient_id" placeholder="Enter Patient ID" type="text" id="patient_id" maxlength="100"  class="round regular-width-input" value="<?php echo $patient_id; ?>" /></td>
					  <td><input type="radio" name="sex" id="female" value="F" >Female</td><td> <input type="radio" name="sex" id="male" value="M" >Male</td>
					  </tr>
					  <tr> 
					  <td>Patient DOB:</td>
                      <td><input  name="date" id="test1" placeholder="" value="<?php echo date('d-m-Y');?>" type="text" id="patient_dob" maxlength="200"  class="round regular-width-input"  /></td>				  
					  <td>Insurance:</td>
                      <td><input name="insurance" placeholder="Enter Insurance Info" type="text" id="insurance" maxlength="100"  class="round default-width-input" value="<?php echo $insurance; ?>" /></td>
					  </tr>
                    <tr>
                     <td>Contact 1 </td>
                      <td><input name="contact1" placeholder="Enter Contact 1"type="text" id="buyingrate" maxlength="20"   class="round default-width-input" 
					  value="<?php echo $contact1; ?>" /></td>
					<td>Contact 2 </td>
                      <td><input name="contact2" placeholder="Enter Contact 2"type="text" id="sellingrate" maxlength="20"  class="round default-width-input" 
					  value="<?php echo $contact2; ?>" /></td>
                    </tr>
                    <tr>
					<td>Email Address:</td>
                      <td><input name="email" placeholder="Enter Email Address" type="text" id="email" maxlength="100"  class="round default-width-input" value="<?php echo $email; ?>" /></td>
                      <td>Address</td>
                      <td><textarea name="address" placeholder="Enter Patient Address"cols="15" class="round full-width-textarea"><?php echo $address; ?></textarea></td>
                    
                    </tr>
					</tbody>
					</table>
                      <table>
						<tr>
                      <td>
					 &nbsp;
					  </td>
                      <td>
                        <input  class="button round green image-right ic-add text-capitalize" type="submit" name="Submit" value="Add">
                     </td>
					 <td>
						<input class="button round red image-right ic-cancel  text-capitalize"  type="reset" name="Reset" value="Reset"> 
					 </td>
                    </tr>
					  </table>
                </form>
						
				
					</div> <!-- end content-module-main -->
							
				
				</div> <!-- end content-module -->
				
				
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<?php include ("footer.php");?><!-- end footer -->

</body>
</html>
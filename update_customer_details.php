<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - Update Patient</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="js/date_pic/date_input.css">
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<?php include_once("tpl/common_js.php"); ?>
	<script src="js/date_pic/jquery.date_input.js"></script> 
	<script src="js/script.js"></script>  
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
				pid: {
					required: true
				},
				sex: {
					required: true
				},
				insurance: {
					required: true
				},
				address: {
					minlength: 3,
					maxlength: 200
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
					required: "Please enter the Patient Name",
					minlength: "Name must consist of at least 3 characters"
				},
				pid: {
					required: "Please enter the Patient ID"
				},
				sex: {
					required: "Please enter the sex of the Patient"
				},
				insurance: {
					required: "Please enter the Patient's Insurance Coverage"
				},
				address: {
					minlength: "Patient Address must be at least 3 characters long",
					maxlength: "Address has exceeded character limit"
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
					<li><a href="new_treatment.php">Add New Treatment</a></li>
					<li><a href="view_treatment_book.php">View Treatment Book</a></li>
				</ul>
				
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Update Patient</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
				<form name="form1" method="post" id="form1" action="">
                  <table class="form table"  border="0" cellspacing="0" cellpadding="0">
				  <?php
				if(isset($_POST['id']))

            {
			
			$id=mysql_real_escape_string($_POST['id']);
			$id2=mysql_real_escape_string($_POST['id2']);
			$pid=trim(mysql_real_escape_string($_POST['pid']));
			$sex=trim(mysql_real_escape_string($_POST['sex']));
			$insurance=trim(mysql_real_escape_string($_POST['insurance']));
			$name=trim(mysql_real_escape_string($_POST['name']));
			$address=trim(mysql_real_escape_string($_POST['address']));
			$email=trim(mysql_real_escape_string($_POST['email']));
			$contact1=trim(mysql_real_escape_string($_POST['contact1']));
			$contact2=trim(mysql_real_escape_string($_POST['contact2']));
			$selected_date=$_POST['date'];
			$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d', $selected_date );
				
			if($db->query("UPDATE customer_details  SET customer_name='$name',patient_id='$pid',sex='$sex',insurance='$insurance',customer_address='$address',patient_email='$email',customer_contact1='$contact1',patient_dob='$mysqldate',customer_contact2='$contact2' where id=$id"))
			{
					
                        $data=" $name  Details Updated" ;
				                                            $msg='<p style="color:#153450;font-size:1.2em;font-family:Verdana, Times New Roman, Times, sans-serif;">'.$data.'</p><p><a href="view_customers.php"><i class="fa fa-3x fa-rotate-left"></i> Back to Patients</a></p><p> <a href="dashboard.php"><i class="fa fa-3x fa-home"></i>Go Home</a></p>';//
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
			echo "<br><font color=red size=+1 >Problem in Updating !</font>" ;
			
			
			}
				
				?>	
				<?php 
				if(isset($_GET['sid']))
				$id=$_GET['sid'];
				
				$line = $db->queryUniqueObject("SELECT * FROM customer_details WHERE id=$id");
				?>
					<form name="form1" method="post" id="form1" action="">
                   <input name="id" type="hidden" value="<?php echo $_GET['sid']; ?>">  
                    <tr>
					<td>Name:</td>
                      <td><input name="name" type="text" id="name" maxlength="100"  class="round default-width-input" value="<?php echo $line->customer_name; ?> "/></td>
					  <td>Patient ID:</td>
                      <td><input name="pid" type="text" id="pid" maxlength="20"  class="round small-width-input" value="<?php echo $line->patient_id; ?> "/></td>
					  <td><input type="radio" name="sex" id="female" value="F" >Female</td><td> <input type="radio" name="sex" id="male" value="M" >Male</td>
                    </tr>
                    <tr>
                      <td>Phone# 1: </td>
                      <td><input name="contact1"  type="text" id="buyingrate" maxlength="20"   class="round regular-width-input" 
					  value="<?php echo $line->customer_contact1; ?>" /></td>
						
                     <td>Phone# 2: </td>
                      <td><input name="contact2"  type="text" id="sellingrate" maxlength="20"  class="round regular-width-input" 
					  value="<?php echo $line->customer_contact2; ?>" /></td>
					  					  	
                     <td>Insurance: </td>
                      <td><input name="insurance"  type="text" id="insurance" maxlength="40"  class="round regular-width-input" 
					  value="<?php echo $line->insurance; ?>" /></td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td><textarea name="address"  cols="15" class="round full-width-textarea"><?php echo $line->customer_address; ?>
					  </textarea></td>
					  <td>Email Address: </td>
                      <td><input name="email"  type="text" id="email" maxlength="200"   class="round default-width-input" 
					  value="<?php echo $line->patient_email; ?>" /></td>
					  <td>DOB: </td>
                      <td><input  name="date" id="test1" placeholder="" value="<?php echo $line->patient_dob;?>" type="text" id="patient_dob" maxlength="200"  class="round regular-width-input"  /></td>
					
                    </tr>
				</table>
                  <table> 
                    <tr>
                      <td>
					 &nbsp;
					  </td>
					  <td>
                        <input  class="button round green image-right ic-add text-capitalize" type="submit" name="Submit" value="Update">
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
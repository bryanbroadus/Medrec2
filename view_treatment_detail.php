<?php
include_once("init.php");

?>
			 
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - View Treatment Record</title>
	
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


</head>
<body>

	<!-- TOP BAR -->
	<?php include_once("tpl/top_bar.php"); ?>
	<!-- end top-bar -->
	
	
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="side-menu fl">
				
				<h3>Treatment Management</h3>
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
					
						<h3 class="fl">View Treatment Record</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
		
				<div class="col-lg-12">
				<?php 
				if(isset($_GET['sid']))
				$id=$_GET['sid'];
				
				$line = $db->queryUniqueObject("SELECT * FROM patient_treatment WHERE id=$id");
				?> 
				<div class="col-lg-6">
                      <p>Patient:  <?php echo $line->patient_name; ?></p>
                       <p>Patient ID:  <?php echo $line->patient_id; ?></p>
                     <p>Invoice ID:  <?php echo $line->invoice_id; ?></p>          
                      <p>Treatment Date:  <?php echo $line->trt_date;?></p>
					  <p>Treatment:  <?php echo $line->treatment;?></p>
				</div>
				<div class="col-lg-6">
					  <p>Doc:  <?php echo $line->doc;?></p>
                      <p>Bill:  <?php echo $line->cost;?></p>
					  <p>Paid:  <?php echo $line->paid;?></p>
					  <p>Balance:  <?php echo $line->balance;?></p>
					  <p>Next Appointment:  <?php echo $line->next_appointment;?></p>
				</div>		
					</div>
					</div> <!-- end content-module-main -->
							
				
				</div> <!-- end content-module -->
				
				
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<?php include ("footer.php");?><!-- end footer -->

</body>
</html>
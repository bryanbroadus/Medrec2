<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec MS - Dashboard</title>
	
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
	<?php include_once("analyticstracking.php") ?>
	
	
		
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">

			<div class="side-menu fl">
				
				<h3>Quick Links</h3>
				<ul>
					<li><a href="add_sales.php">Add Invoice</a></li>
					<li><a href="view_payments.php">Add Payment</a></li>
					<li><a href="add_customer.php">Add Patient</a></li>
					<li><a href="add_stock.php">Add Service / Product</a></li>
					<li><a href="view_report.php">Reports</a></li>
					<li><a href="new_treatment.php">Add New Treatment</a></li>
					<li><a href="view_treatment_book.php">View Treatment Book</a></li>
				</ul>
                                
                                 
			</div> <!-- end side-menu -->
                        
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Statistics</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					
					</div> <!-- end content-module-heading -->
					<div class="tab-pane" id="chartjs">
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
							  <h4><i class="fa fa-angle-right"></i> Insurance</h4>
                              <div class="panel-body text-center">
                                  <canvas id="doughnut" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
							  <h4><i class="fa fa-angle-right"></i> Income 2014 vs 2013</h4>
                              <div class="panel-body text-center">
                                  <canvas id="line" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row mt">
                      <div class="col-lg-6">
                          <div class="content-panel">
							  <h4><i class="fa fa-angle-right"></i> Patients 2015 vs 2014</h4>
                              <div class="panel-body text-center">
                                  <canvas id="bar" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
							  <h4><i class="fa fa-angle-right"></i> Highest Billing Services</h4>
                              <div class="panel-body text-center">
                                  <canvas id="pie" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row mt hidden">
                      <div class="col-lg-6">
                          <div class="content-panel">
							  <h4><i class="fa fa-angle-right"></i> Radar</h4>
                              <div class="panel-body text-center">
                                  <canvas id="radar" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="content-panel">
							  <h4><i class="fa fa-angle-right"></i> Polar Area</h4>
                              <div class="panel-body text-center">
                                  <canvas id="polarArea" height="300" width="400"></canvas>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
			  <div class="row mt">
				  <div class="col-lg-6">
				  <div class="content-panel">
					<! -- BADGES -->
						<div class="showback panel-body">
							<h4><i class="fa fa-angle-right"></i> Quick Summary</h4>
							<p>Total Number of Products & Services  <span class="badge bg-important pull-right"><?php echo  $count = $db->countOfAll("stock_details");?></span></p>
							<p>Tatal Number of Treatments  <span class="badge bg-important pull-right"><?php echo  $count = $db->countOfAll("patient_treatment");?></span></p>
							<p>Total Number of Patients  <span class="badge bg-important pull-right"><?php echo $count = $db->countOfAll("customer_details");?></span></p>
							<p>Total Number of Patients with Outstanding Balance  <span class="badge bg-important pull-right"><?php echo $count = $db->countOfAll("customer_details");?></span></p>
						</div>
						</div>
					</div>
				</div>
					<hr>	
							
				
				</div> <!-- end content-module -->
				
			    
		
		</div> <!-- end full-width -->
			
                </div>
            </div>
        <div>
     
        </div>
	
	<!-- FOOTER -->
	<?php include ("footer.php");?>
	  <!--script for this page-->
    <script src="assets/js/chart-master/Chart.js"></script>
    <script src="assets/js/chartjs-conf.js"></script>
</body>

</body>
</html>
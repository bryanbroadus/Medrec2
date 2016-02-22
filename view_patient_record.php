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
				
				<h3>Patient Management</h3>
				<ul>
					<li><a href="add_customer.php">Add Patient</a></li>
					<li><a href="view_customers.php">View Patients</a></li>
					<li><a href="add_treatment.php">Add New Treatment</a></li>
					<li><a href="view_treatment_book.php">View Treatment Book</a></li>
				</ul>
				
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">View Patient Record</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
		
				<div class="col-lg-12">
				<?php 
				if(isset($_GET['sid']))
				$id=$_GET['sid'];
				
				$line = $db->queryUniqueObject("SELECT * FROM customer_details WHERE id=$id");
				?> 
				<h2 style="font-size: 18px;border-left: 3px solid #00FFEC;padding: 4px; font-weight: 700;">Bio Data</h2>
				<div class="col-lg-6">
                      <p><label>Patient:</label>  <?php echo $line->customer_name; ?></p>
                       <p><label>Patient ID:</label>  <?php echo $line->patient_id; ?></p>
                     <p><label>Sex:</label>  <?php echo $line->sex; ?></p>          
                      <p><label>Age:</label> <?php echo $line->patient_dob;?></p>
				</div>
				<div class="col-lg-6">
					  <p><label>Insurance:</label>  <?php echo $line->insurance;?></p>
					  <p><label>Address:</label>  <?php echo $line->customer_address;?></p>
					  <p><label>Phone #1:</label>  <?php echo $line->customer_contact1;?></p>
					  <p><label>Phone #2:</label>  <?php echo $line->customer_contact2;?></p>
					  <p><label>Email:</label>  <?php echo $line->patient_email;?></p>
				</div>	
				<div class="col-lg-6">
					  <p><label>PC:</label>  <?php echo $line->patient_pc;?></p>
                      <p><label>HPC:</label>  <?php echo $line->patient_hpc;?></p>
					  <p><label>PMH:</label>  <?php echo $line->patient_pmh;?></p>
				</div>
				<div class="col-lg-6">
					  <p><label>OE:</label>  <?php echo $line->patient_oe;?></p>
					  <p><label>DX:</label>  <?php echo $line->patient_dx;?></p>
				</div>
				</div>
				<div class="col-lg-12">
				<h3 style="font-size: 18px;border-left: 3px solid #00FFEC;padding: 4px;font-weight: 700;">Medical Data</h3>
				<table class="table">
				 <form action="" method="get" name="limit_go">
					Records per Page<input name="limit" type="text" class="round my_text_box" id="search_limit" style="margin-left:5px;" value="<?php if(isset($_GET['limit'])) echo $_GET['limit']; else echo "50"; ?>" size="3" maxlength="3">
					<input name="go"  type="button" value="Go" class=" round blue my_button  text-upper" onclick="return confirmLimitSubmit()">
				</form>
				</table>										
				<form name="deletefiles" action="delete.php" method="post">

				<input type="hidden" name="table" value="patient_treatment">
				<input type="hidden" name="return" value="view_patient_record.php">
				<table class="table table-hover table-striped table-bordered">
				<?php 
				if(isset($_GET['pid']))
				$pid=$_GET['pid'];
				?>
				<?php 
				$SQL = "SELECT * FROM  patient_treatment WHERE patient_id=$pid";
				if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
				{

				$SQL = "SELECT * FROM  patient_treatment WHERE patient_name  LIKE '%".$_POST['searchtxt']."%' OR date LIKE '%".$_POST['searchtxt']."%' OR doc LIKE '%".$_POST['searchtxt']."%'";


				}

					$tbl_name="patient_treatment";		//your table name

					// How many adjacent pages should be shown on each side?

					$adjacents = 3;

					

					/* 

					   First get total number of rows in data table. 

					   If you have a WHERE clause in your query, make sure you mirror it here.

					*/

					$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE patient_id='$pid'";
					if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
				{

				$query = "SELECT COUNT(*) as num FROM  patient_treatment WHERE patient_name  LIKE '%".$_POST['searchtxt']."%' OR date LIKE '%".$_POST['searchtxt']."%' OR doc LIKE '%".$_POST['searchtxt']."%'";


				}


					$total_pages = mysql_fetch_array(mysql_query($query));

					$total_pages = $total_pages[num];
				 
					

					/* Setup vars for query. */

					$targetpage = "view_patient_record.php"; 	//your file name  (the name of this file)

					$limit = 50; 								//how many items to show per page
				if(isset($_GET['limit']) && is_numeric($_GET['limit'])){
					$limit=$_GET['limit'];
						$_GET['limit']=50;
				}

					$page = $_GET['page'];


					if($page) 

						$start = ($page - 1) * $limit; 			//first item to display on this page

					else

						$start = 0;								//if no page var is given, set start to 0

					

					/* Get data. */

					$sql = "SELECT * FROM patient_treatment WHERE patient_id='$pid' LIMIT $start, $limit ";
					if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
				{

					$sql= "SELECT * FROM  patient_treatment WHERE patient_name  LIKE '%".$_POST['searchtxt']."%' OR date LIKE '%".$_POST['searchtxt']."%' OR doc LIKE '%".$_POST['searchtxt']."%' ORDER BY date ASC LIMIT $start, $limit";


				}


					$result = mysql_query($sql);

					

					/* Setup page vars for display. */

					if ($page == 0) $page = 1;					//if no page var is given, default to 1.

					$prev = $page - 1;							//previous page is page - 1

					$next = $page + 1;							//next page is page + 1

					$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.

					$lpm1 = $lastpage - 1;						//last page minus 1

					

					/* 

						Now we apply our rules and draw the pagination object. 

						We're actually saving the code to a variable in case we want to draw it more than once.

					*/

					$pagination = "";

					if($lastpage > 1)

					{	

						$pagination .= "<div >";

						//previous button

						if ($page > 1) 

							$pagination.= "<a href=\"view_patient_record.php?page=$prev&limit=$limit\" class=my_pagination >Previous</a>";

						else

							$pagination.= "<span class=my_pagination>Previous</span>";	

						

						//pages	

						if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up

						{	

							for ($counter = 1; $counter <= $lastpage; $counter++)

							{

								if ($counter == $page)

									$pagination.= "<span class=my_pagination>$counter</span>";

								else

									$pagination.= "<a href=\"view_patient_record.php?page=$counter&limit=$limit\" class=my_pagination>$counter</a>";					

							}

						}

						elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some

						{

							//close to beginning; only hide later pages

							if($page < 1 + ($adjacents * 2))		

							{

								for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)

								{

									if ($counter == $page)

										$pagination.= "<span class=my_pagination>$counter</span>";

									else

										$pagination.= "<a href=\"view_patient_record.php?page=$counter&limit=$limit\" class=my_pagination>$counter</a>";					

								}

								$pagination.= "...";

								$pagination.= "<a href=\"view_patient_record.php?page=$lpm1&limit=$limit\" class=my_pagination>$lpm1</a>";

								$pagination.= "<a href=\"view_patient_record.php?page=$lastpage&limit=$limit\" class=my_pagination>$lastpage</a>";		

							}

							//in middle; hide some front and some back

							elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))

							{

								$pagination.= "<a href=\"view_patient_record.php?page=1&limit=$limit\" class=my_pagination>1</a>";

								$pagination.= "<a href=\"view_patient_record.php?page=2&limit=$limit\" class=my_pagination>2</a>";

								$pagination.= "...";

								for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)

								{

									if ($counter == $page)

										$pagination.= "<span  class=my_pagination>$counter</span>";

									else

										$pagination.= "<a href=\"view_patient_record.php?page=$counter&limit=$limit\" class=my_pagination>$counter</a>";					

								}

								$pagination.= "...";

								$pagination.= "<a href=\"view_patient_record.php?page=$lpm1&limit=$limit\" class=my_pagination>$lpm1</a>";

								$pagination.= "<a href=\"view_patient_record.php?page=$lastpage&limit=$limit\" class=my_pagination>$lastpage</a>";		

							}

							//close to end; only hide early pages

							else

							{

								$pagination.= "<a href=\"$view_patient_record.php?page=1&limit=$limit\" class=my_pagination>1</a>";

								$pagination.= "<a href=\"$view_patient_record.php?page=2&limit=$limit\" class=my_pagination>2</a>";

								$pagination.= "...";

								for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)

								{

									if ($counter == $page)

										$pagination.= "<span class=my_pagination >$counter</span>";

									else

										$pagination.= "<a href=\"$targetpage?page=$counter&limit=$limit\" class=my_pagination>$counter</a>";					

								}

							}

						}

						

						//next button

						if ($page < $counter - 1) 

							$pagination.= "<a href=\"view_patient_record.php?page=$next&limit=$limit\" class=my_pagination>Next</a>";

						else

							$pagination.= "<span class= my_pagination >Next</span>";

						$pagination.= "</div>\n";		

					}

				?>	
				<thead>
								<th>No</th>
								<th >Treatment Date</th>
								<th >Treatment</th>
								<th>Doc</th>
								<th>Next Appmt</th>
								<th>Bill</th>
								<th>Paid</th>
								<th>Balance</th>
								<th >Invoice ID</th>
							</thead>
													
			<?php $i=1; $no=$page-1; $no=$no*$limit;	while($row = mysql_fetch_array($result)) 
			{
			 ?> 
				<tr>
			   <td> <?php echo $no+$i; ?></td>
			   <td><?php echo $row['trt_date']; ?></td>
			   <td><?php echo $row['treatment']; ?></td>
			   <td><?php echo $row['doc']; ?></td>
			   <td> <?php echo $row['next_appointment']; ?></td>
			   <td> <?php echo $row['cost']; ?></td>
			   <td> <?php echo $row['paid']; ?></td>
			   <td> <?php echo $row['balance'];?></td>
			   <td><?php echo $row['invoice_id']; ?></td>

			</tr>
			<?php $i++; } ?>
			 <tr>

				   <td align="center"><div style="margin-left:20px;"><?php echo $pagination; ?></div></td>

				  </tr>
			</table>
		</form>
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
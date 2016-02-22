<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Medrec - Treatment Management</title>
	
	<!-- Stylesheets -->
	<!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>-->
	<link rel="stylesheet" href="css/style.css">
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<?php include_once("tpl/common_js.php"); ?>
	<script src="js/script.js"></script> 
 <script  src="dist/js/jquery.ui.draggable.js"></script>
<script src="dist/js/jquery.alerts.js"></script>
<link rel="stylesheet"  href="dist/js/jquery.alerts.css" >
        
        <script LANGUAGE="JavaScript">
<!--
// Nannette Thacker http://www.shiningstar.net
console.log();
function confirmSubmit(id,table,dreturn)
{ 	     jConfirm('Sure You Want To Delete Treatment Record?', 'Confirmation Dialog', function (r) {
           if(r){ 
               console.log();
                $.ajax({
  			url: "delete.php",
  			data: { id: id, table:table,return:dreturn},
  			success: function(data) {
    			window.location = "view_treatment_book.php";
    			
                        jAlert('Treatment Record has been Deleted', 'MedRec');
  			}
		});
            }
            return r;
        });
}


function confirmDeleteSubmit()
{
    var flag=0;
  var field=document.forms.deletefiles;
for (i = 0; i < field.length; i++){
    if(field[i].checked ==true){
        flag=flag+1;
        
    }
	
}
if (flag <1) {
  jAlert('You must check one and only one checkbox', 'MedRec');
return false;
}else{
 jConfirm('Sure You Want To Delete Treatment Record?', 'Confirmation Dialog', function (r) {
           if(r){ 
	
document.deletefiles.submit();}
else {
	return false ;
   
}
});
   
}
}
function confirmLimitSubmit()
{
    if(document.getElementById('search_limit').value!=""){

document.limit_go.submit();

    }else{
        return false;
    }
}


function checkAll()
{

	var field=document.forms.deletefiles;
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll()
{
	var field=document.forms.deletefiles;
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}
// -->
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
					
						<h3 class="fl">Treatment Book</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
				
		
					<table>
<form action="" method="post" name="search" >
    <input name="searchtxt" type="text" class="round my_text_box" placeholder="Search" > 
&nbsp;&nbsp;<input name="Search" type="submit" class="my_button round blue   text-upper" value="Search">
</form>
 <form action="" method="get" name="limit_go">
    Records per Page<input name="limit" type="text" class="round my_text_box" id="search_limit" style="margin-left:5px;" value="<?php if(isset($_GET['limit'])) echo $_GET['limit']; else echo "50"; ?>" size="3" maxlength="3">
    <input name="go"  type="button" value="Go" class=" round blue my_button  text-upper" onclick="return confirmLimitSubmit()">
</form>
                                            
<form name="deletefiles" action="delete.php" method="post">

<input type="hidden" name="table" value="patient_treatment">
<input type="hidden" name="return" value="view_treatment_book.php">
<input type="button" name="selectall" value="SelectAll" class="my_button round blue   text-upper" onClick="checkAll()"  style="margin-left:5px;"/>
<input type="button" name="unselectall" value="DeSelectAll" class="my_button round blue   text-upper" onClick="uncheckAll()" style="margin-left:5px;" />
<input name="dsubmit" type="button" value="Delete Selected" class="my_button round blue   text-upper" style="margin-left:5px;" onclick="return confirmDeleteSubmit()"/>
					
					
					
					<table class="table table-hover table-striped table-bordered">
		<?php 




$SQL = "SELECT DISTINCT(invoice_id) FROM  patient_treatment";
if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
{

$SQL = "SELECT DISTINCT(invoice_id) FROM  patient_treatment WHERE patient_name  LIKE '%".$_POST['searchtxt']."%' OR date LIKE '%".$_POST['searchtxt']."%' OR doc LIKE '%".$_POST['searchtxt']."%'";


}

	$tbl_name="patient_treatment";		//your table name

	// How many adjacent pages should be shown on each side?

	$adjacents = 3;

	

	/* 

	   First get total number of rows in data table. 

	   If you have a WHERE clause in your query, make sure you mirror it here.

	*/

	$query = "SELECT COUNT(*) as num FROM $tbl_name";
	if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
{

$query = "SELECT COUNT(*) as num FROM  patient_treatment WHERE patient_name  LIKE '%".$_POST['searchtxt']."%' OR date LIKE '%".$_POST['searchtxt']."%' OR doc LIKE '%".$_POST['searchtxt']."%'";


}


	$total_pages = mysql_fetch_array(mysql_query($query));

	$total_pages = $total_pages[num];
 
	

	/* Setup vars for query. */

	$targetpage = "view_treatment_book.php"; 	//your file name  (the name of this file)

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

	$sql = "SELECT DISTINCT(invoice_id) FROM patient_treatment ORDER BY trt_date DESC LIMIT $start, $limit ";
	if(isset($_POST['Search']) AND trim($_POST['searchtxt'])!="")
{

	$sql= "SELECT DISTINCT(invoice_id) FROM  patient_treatment WHERE patient_name  LIKE '%".$_POST['searchtxt']."%' OR date LIKE '%".$_POST['searchtxt']."%' OR doc LIKE '%".$_POST['searchtxt']."%' ORDER BY date DESC LIMIT $start, $limit";


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

			$pagination.= "<a href=\"view_treatment_book.php?page=$prev&limit=$limit\" class=my_pagination >Previous</a>";

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

					$pagination.= "<a href=\"view_treatment_book.php?page=$counter&limit=$limit\" class=my_pagination>$counter</a>";					

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

						$pagination.= "<a href=\"view_treatment_book.php?page=$counter&limit=$limit\" class=my_pagination>$counter</a>";					

				}

				$pagination.= "...";

				$pagination.= "<a href=\"view_treatment_book.php?page=$lpm1&limit=$limit\" class=my_pagination>$lpm1</a>";

				$pagination.= "<a href=\"view_treatment_book.php?page=$lastpage&limit=$limit\" class=my_pagination>$lastpage</a>";		

			}

			//in middle; hide some front and some back

			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))

			{

				$pagination.= "<a href=\"view_treatment_book.php?page=1&limit=$limit\" class=my_pagination>1</a>";

				$pagination.= "<a href=\"view_treatment_book.php?page=2&limit=$limit\" class=my_pagination>2</a>";

				$pagination.= "...";

				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)

				{

					if ($counter == $page)

						$pagination.= "<span  class=my_pagination>$counter</span>";

					else

						$pagination.= "<a href=\"view_treatment_book.php?page=$counter&limit=$limit\" class=my_pagination>$counter</a>";					

				}

				$pagination.= "...";

				$pagination.= "<a href=\"view_treatment_book.php?page=$lpm1&limit=$limit\" class=my_pagination>$lpm1</a>";

				$pagination.= "<a href=\"view_treatment_book.php?page=$lastpage&limit=$limit\" class=my_pagination>$lastpage</a>";		

			}

			//close to end; only hide early pages

			else

			{

				$pagination.= "<a href=\"$view_treatment_book.php?page=1&limit=$limit\" class=my_pagination>1</a>";

				$pagination.= "<a href=\"$view_treatment_book.php?page=2&limit=$limit\" class=my_pagination>2</a>";

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

			$pagination.= "<a href=\"view_treatment_book.php?page=$next&limit=$limit\" class=my_pagination>Next</a>";

		else

			$pagination.= "<span class= my_pagination >Next</span>";

		$pagination.= "</div>\n";		

	}

?>	
							<thead>
								<th>No</th>
								<th >Treatment Date</th>
								<th >Patient Name</th>
								<th>Doc</th>
								<th>Next Appmt</th>
								<th>Bill</th>
								<th>Paid</th>
								<th>Balance</th>
								<th >Invoice ID</th>
								<th>Edit /Delete</th>
                                <th>Select</th>
							</thead>
										
<?php $i=1; $no=$page-1; $no=$no*$limit;	while($row = mysql_fetch_array($result)) 
{
	$entryid=$row['invoice_id'];
	$line = $db->queryUniqueObject("SELECT * FROM patient_treatment WHERE invoice_id='$entryid' ");
 ?> 
	<tr>
   <td> <?php echo $no+$i; ?></td>
   <td><?php echo $line->trt_date; ?></td>
   <td><?php echo $line->patient_name; ?></td>
   <td><?php echo $line->doc; ?></td>
   <td> <?php echo $line->next_appointment; ?></td>
   <td> <?php echo $line->cost; ?></td>
   <td> <?php echo $line->paid; ?></td>
   <td> <?php echo $line->balance;?></td>
   <td><?php echo $line->invoice_id; ?></td>
    <td>	<a title="View Treatment Record" href="view_treatment_detail.php?sid=<?php echo $row['invoice_id'];?>&table=patient_treatment&return=view_treatment_book.php"><i class="btn btn-success btn-xs fa fa-eye"></i>
	</a><a title="Edit Treatment Record Details" href="update_treatment_details.php?sid=<?php echo $entryid;?>&table=patient_treatment&return=view_treatment_book.php"><i class="btn btn-primary btn-xs fa fa-pencil"></i>	</a>
	<a title="Delete Patient Details"  href="javascript:confirmSubmit(<?php echo $row['id'];?>,'patient_treatment','view_treatment_book.php')"><i class="btn btn-danger btn-xs fa fa-trash-o "></i></a>
	</td>
	<td><input type="checkbox" value="<?php echo $row['id']; ?>" name="checklist[]" id="check_box" /></td>

</tr>
<?php $i++; } ?>
 <tr>

       <td align="center"><div style="margin-left:20px;"><?php echo $pagination; ?></div></td>

      </tr>
</table>
</form>
				
				
		</div> 
	</div> </div> </div> </div>
		<?php include ("footer.php");?><!-- end footer -->

</body>
</html>
<?php
include_once("init.php"); // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){ // if session variable "username" does not exist.
header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
}
else
{
if(isset($_GET['from_purchase_date']) && isset($_GET['to_purchase_date']) && $_GET['from_purchase_date']!='' && $_GET['to_purchase_date']!='' )
{

	error_reporting (E_ALL ^ E_NOTICE);
			$selected_date=$_GET['from_purchase_date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d H:i:s', $selected_date );
$fromdate=$mysqldate;
			$selected_date=$_GET['to_purchase_date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d H:i:s', $selected_date );

$todate=$mysqldate;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>EZ Stock | Purchase Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/style.css">
</head>
<style type="text/css" media="print">
.hide{display:none}
</style>
<script type="text/javascript">
function printpage() {
document.getElementById('printButton').style.visibility="hidden";
window.print();
document.getElementById('printButton').style.visibility="visible";  
}
</script>
<body>
<input name="print" type="button" value="Print" id="printButton" onClick="printpage()">
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-content">
				<div class="col-xs-push-6 col-xs-6 text-right">
					<address>
					<?php $line4 = $db->queryUniqueObject("SELECT * FROM store_details "); ?>
						<strong><?php echo $line4->name; ?></strong><br>
						<?php echo $line4->address; ?><br>
						<?php echo $line4->place; ?><br>
						<?php echo $line4->city; ?><br>
						<abbr title="Phone">P:</abbr> <?php echo $line4->phone; ?><br>
						<abbr title="Email">@:</abbr> <?php echo $line4->email; ?><br>
						<abbr title="Website">Web:</abbr> <?php echo $line4->web; ?>
					</address>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12">
					<h2 class="text-center" style="font-size: 4em;">Purchase Report</h2>
					<p class="text-left">Total Purchase: <span class="text-danger"><?php echo  $age = $db->queryUniqueValue("SELECT sum(subtotal) FROM stock_entries where count1=1 AND type='entry' AND date BETWEEN '$fromdate' AND '$todate' ");?></span></p>
					<p class="text-left">Paid Amount: <span class="text-danger"><?php echo  $age = $db->queryUniqueValue("SELECT sum(payment) FROM stock_entries where count1=1 AND type='entry' AND date BETWEEN '$fromdate' AND '$todate' ");?></span></p>
					<p class="text-left">Pending Amount: <span class="text-danger"><?php echo  $age = $db->queryUniqueValue("SELECT sum(balance) FROM stock_entries where count1=1 AND type='entry' AND date BETWEEN '$fromdate' AND '$todate' ");?></span></p>
					<p class="text-right">Reporting From: <span class="text-success"><b><?php echo $_GET['from_purchase_date']; ?></b></span> - To: <span class="text-danger"><b><?php echo $_GET['to_purchase_date']; ?></b></span></p>
					<br/>
				  <table class="table table-hover">
						<thead>
							<tr>
								<th>Date</th>
								<th>Purchase ID</th>
								<th>Stock ID</th>
								<th>Supplier</th>
								<th>Paid</th>
								<th>Balance</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
						<?php 
				$result = $db->query("SELECT * FROM stock_entries where  type='entry' AND date BETWEEN '$fromdate' AND '$todate' ");
				while ($line = mysql_fetch_array($result)) {
						?>
							<tr>
							<td><?php  $entryid=$line['stock_id'];
							$newline = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE stock_id='$entryid' ");
							$mysqldate=$newline->date;
					$phpdate = strtotime( $mysqldate );
					$phpdate = date("d/m/Y",$phpdate);
					echo $phpdate; ?></td>
							<td><?php $pur_id=$line['id']; $pid="PR".$pur_id."";  echo $pid; ?></td>
							<td><?php echo $line['stock_id']; ?></td>
							<td><?php echo $line['stock_supplier_name'] ?></td>
							<td><?php echo $line['payment'] ?></td>
							<td><?php echo $line['balance'] ?></td>
							<td><?php echo $line['subtotal'] ?></td>
						  </tr>
					<?php }  
					?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
}
else
echo "Please enter from and to date to process report";
}
?>
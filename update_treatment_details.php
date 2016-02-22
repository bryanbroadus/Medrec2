<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - Update Treatment</title>
	
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
	function balance_amount(){
    if(document.getElementById('bill').value!="" && document.getElementById('payment').value!=""){
    data=parseFloat(document.getElementById('bill').value);
    document.getElementById('balance').value=data-parseFloat(document.getElementById('payment').value);
       
    }else{
        document.getElementById('balance').value="";
    }

    
}
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
					minlength: 3,
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
	function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=27 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
    }
    }

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
					<li><a href="add_treatment.php">Add New Treatment</a></li>
					<li><a href="view_treatment_book.php">View Treatment Book</a></li>
				</ul>
				
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Update Treatment Details</h3>
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
			$name=trim(mysql_real_escape_string($_POST['name']));
			$pid=trim(mysql_real_escape_string($_POST['pid']));
			$invoice_id=trim(mysql_real_escape_string($_POST['invoice_id']));
			$invoice_id=trim(mysql_real_escape_string($_POST['invoice_id']));
			$treatment=trim(mysql_real_escape_string($_POST['treatment']));
			$doc=trim(mysql_real_escape_string($_POST['doc']));
			$bill=trim(mysql_real_escape_string($_POST['bill']));
			$paid=trim(mysql_real_escape_string($_POST['paid']));
			$balance=trim(mysql_real_escape_string($_POST['balance']));
			$selected_date=$_POST['date'];
			$selected_date=strtotime( $selected_date );
			$mysqldate1 = date( 'Y-m-d H:i:s', $selected_date );
			$selected_date1=$_POST['duedate'];
            $selected_date1=strtotime( $selected_date1 );
            $mysqldate = date( 'Y-m-d H:i:s', $selected_date1 );
            $duedate=$mysqldate;
			
			if($db->query("UPDATE patient_treatment  SET date='$mysqldate1',username='$username',patient_name='$name',patient_id='$pid',treatment='$treatment',doc='$doc',next_appointment='$duedate',cost='$bill',paid='$paid',balance='$balance',invoice_id='$invoice_id' where id=$id"))
			{
					
                        $data=" Treatment Details for $name Updated" ;
				                                            $msg='<p style="color:#153450;font-size:1.2em;font-family:Verdana, Times New Roman, Times, sans-serif;">'.$data.'</p><p><a href="view_treatment_book.php"><i class="fa fa-3x fa-rotate-left"></i> Back to Treatment Book</a></p><p> <a href="dashboard.php"><i class="fa fa-3x fa-home"></i>Go Home</a></p>';//
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
				
				$line = $db->queryUniqueObject("SELECT * FROM patient_treatment WHERE invoice_id=$id");
				?>
					<form name="form1" method="post" id="form1" action="">
                   <input name="id" type="hidden" value="<?php echo $_GET['sid']; ?>">  
                    <tr>  
                      <td><span class="man">*</span>Patient:</td>
                      <td><input name="name" type="text" id="name"  maxlength="100"  class="round regular-width-input" value="<?php echo $line->patient_name; ?>"  /></td>
                       <td>Patient ID:</td>
                      <td><input name="pid" type="text" id="pid" maxlength="20"  class="round small-width-input" value="<?php echo $line->patient_id; ?> "  /></td>
                     <td>Invoice ID:</td>
                      <td><input name="invoice_id" type="text" id="invoice_id" maxlength="20"  class="round small-width-input" value="<?php echo $line->invoice_id; ?> "/></td>
                       
                    </tr>
					<tr>  
                      <td>Treatment Date:</td>
                      <td><input  name="date" id="test1" value="<?php echo $line->trt_date;?>" type="text" id="name" maxlength="100"  class="round regular-width-input"  /></td>
					  <td>Treatment:</td>
                      <td><textarea name="treatment" cols="15" class="round full-width-textarea"><?php echo $line->treatment;?></textarea></td>
					  <td>Doc:</td>
					  <td><input name="doc" type="text" id="doc"  maxlength="100"  class="round regular-width-input" value="<?php echo $line->doc;?>" /></td>
                    </tr>
					<tr> 
                      <td>Bill:</td>
                      <td><input type="text" name="bill" id="bill" class="round regular-width-input"  style="text-align:right;" value="<?php echo $line->cost;?>"></td>
					  <td>Paid:</td>
                      <td><input type="text"  class="round" onkeyup=" balance_amount(); " onkeypress="return numbersonly(event);" name="paid" id="payment" value="<?php echo $line->paid;?>"/></td>
					  <td>Balance:</td>
					  <td><input type="text"  class="round" readonly="readonly" id="balance" name="balance" value="<?php echo $line->balance;?>"/>
					  </tr>
					<tr>
					  <td>Next Appointment:</td>
					  <td><input type="text" name="duedate" id="test2" value="<?php echo $line->next_appointment;?>" class="round"></td>
                    </tr>
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
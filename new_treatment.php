<?php include_once("init.php");

if(isset($_POST['payment'])){
					$_POST = $gump->sanitize($_POST);
                                
					$gump->validation_rules(array(
						'payment'=> 'required|max_len,100|min_len,1',
						'pc'     => 'max_len,800',
						'hpc'     => 'max_len,800',
						'pmh'     => 'max_len,800',
						'oe'     => 'max_len,800',
						'dx'     => 'max_len,800',
						'doc'    => 'max_len,800'
						

					));
				
					$gump->filter_rules(array(
						'payment'    	  => 'trim|sanitize_string|mysql_escape',
						'pc'     => 'trim|sanitize_string|mysql_escape',
						'hpc'     => 'trim|sanitize_string|mysql_escape',
						'pmh'     => 'trim|sanitize_string|mysql_escape',
						'oe'     => 'trim|sanitize_string|mysql_escape',
						'dx'     => 'trim|sanitize_string|mysql_escape',
						'doc'    => 'trim|sanitize_string|mysql_escape'
					));
				
					$validated_data = $gump->run($_POST);
					$stock_name 	= "";
					$stockid 	= "";
					$payment     = "";
					$pc 	= "";
					$hpc 	= "";
					$pmh 	= "";
					$oe 	= "";
					$dx 	= "";
					$doc 	= "";

					if($validated_data === false) {
							echo $gump->get_readable_errors(true);
					} else {
                            $username = $_SESSION['username'];
							$customer=mysql_real_escape_string($_POST['supplier']);
							$address=mysql_real_escape_string($_POST['address']);
							$pc=mysql_real_escape_string($_POST['pc']);
							$hpc=mysql_real_escape_string($_POST['hpc']);
							$pmh=mysql_real_escape_string($_POST['pmh']);
							$oe=mysql_real_escape_string($_POST['oe']);
							$dx=mysql_real_escape_string($_POST['dx']);
							$contact=mysql_real_escape_string($_POST['contact']);			   
                                                     $count = $db->countOf("customer_details", "customer_name='$customer'");
							if($count==0)
							{
                                                         $db->query("insert into customer_details(customer_name,customer_address,customer_contact1) values('$customer','$address','$contact')");   
                                                        }
                                                        $stock_name=$_POST['stock_name'];
							$quty=$_POST['quty'];
							$date=mysql_real_escape_string($_POST['date']);
							$sell=$_POST['sell'];
							$total=$_POST['total'];
							$payable=$_POST['subtotal'];
							$doc=mysql_real_escape_string($_POST['doc']);
							$invoice_id=mysql_real_escape_string($_POST['transactionid']);
							$payment=mysql_real_escape_string($_POST['payment']);
														if($payment==""){
                                                            $payment=0;
                                                        }
							$discount=mysql_real_escape_string($_POST['discount']);
                                                        if($discount==""){
                                                            $discount=00;
                                                        }
							$dis_amount=mysql_real_escape_string($_POST['dis_amount']);
							if($dis_amount==""){
                                                            $dis_amount=00;
                                                        }
                                                        $subtotal=mysql_real_escape_string($_POST['payable']);
							$balance=mysql_real_escape_string($_POST['balance']);
							$mode=mysql_real_escape_string($_POST['mode']);
                                                        $temp_balance = $db->queryUniqueValue("SELECT balance FROM customer_details WHERE customer_name='$customer'");
                                                        $temp_balance = (int) $temp_balance +  (int) $balance;
                                                        $db->execute("UPDATE customer_details SET balance=$temp_balance WHERE customer_name='$customer'");
                                                        $appointment_date=$_POST['duedate'];
                                                        $appointment_date=strtotime( $appointment_date );
                                                        $mysqldate1 = date( 'Y-m-d H:i:s', $appointment_date );
                                            for($i=0;$i<count($stock_name);$i++)
                                            {
                        $name1=$stock_name[$i];
                        $quantity=$_POST['quty'][$i];
			$rate=$_POST['sell'][$i];
			$total=$_POST['total'][$i];
			
			
			$selected_date=$_POST['date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d H:i:s', $selected_date );
			$username = $_SESSION['username'];
		
			$count = $db->queryUniqueValue("SELECT selling_price FROM stock_details WHERE stock_name='$name1'");
	
			if($count >= 1)
			{
			  $line = $db->queryUniqueObject("SELECT * FROM stock_details  WHERE stock_name='$name1'");
							$stockid=$line->stock_id; 
							$cat=$line->category;
			  
			$db->query("insert into stock_sales (category,discount,dis_amount,grand_total,transactionid,stock_name,selling_price,quantity,amount,date,username,customer_id,subtotal,payment,balance,due,mode,count1) 
                            values('$cat',$discount,$dis_amount,$payable,'$invoice_id','$name1',$rate,$quantity,$total,'$mysqldate','$username','$customer',$subtotal,$payment,$balance,'$mysqldate','$mode',$i)");
				$line2 = $db->queryUniqueObject("SELECT * FROM customer_details  WHERE customer_name='$customer'");
				$patient_id=$line2->patient_id;
			$db->query("insert into patient_treatment (trt_date,username,patient_name,patient_id,treatment,doc,next_appointment,pc,hpc,pmh,oe,dx,cost,paid,balance,invoice_id) 
                            values('$mysqldate','$username','$customer','$patient_id','$name1','$doc','$mysqldate1','$pc','$hpc','$pmh','$oe','$dx','$subtotal','$payment','$balance','$invoice_id')");
				$amount = 0;
				$amount1 = 0;
			
			$db->query("insert into stock_entries (stock_id,stock_name,quantity,opening_stock,closing_stock,date,due,username,type,category,salesid,total,selling_price,count1,payment,balance) 
			values('$stockid','$name1',$quantity,0,0,'$mysqldate','$mysqldate','$username','sales','$cat','$invoice_id',$total,$rate,$i+1,$payment,$balance)");
			
			}                   
			}
			
			$msg="Treatment Details for ". $_POST['supplier']." Added successfully <br> Ref: ". $_POST['transactionid']."" ;
                          
			 header("Location:new_treatment.php?msg=$msg");
                        			echo "<script>window.open('add_sales_print.php?sid=$invoice_id','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
                                               
							}
						
                                        }
                                       
				?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - New Treatment</title>
	
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
	 
        <script type="text/javascript">
$(function() {
    
    	$("#supplier").autocomplete("customer1.php", {
		width: 160,
		autoFill: true,
		selectFirst: true
	});
    	$("#item").autocomplete("stock.php", {
		width: 160,
		autoFill: true,
		mustMatch: true,
		selectFirst: true
	});
        $("#item").blur(function()
			{
                          document.getElementById('total').value=document.getElementById('sell').value * document.getElementById('quty').value 
                        });
        $("#item").blur(function()
			{
			 
							
			 $.post('check_item_details.php', {stock_name1: $(this).val() },
				function(data){
                                                              
								$("#sell").val(data.sell);
								$("#stock").val(data.stock);
								$('#guid').val(data.guid);
								if(data.sell!=undefined)
								$("#0").focus();
								
								
							}, 'json');
											
					

			
			});
        $("#supplier").blur(function()
			{
			 
							
			 $.post('check_customer_details.php', {stock_name1: $(this).val() },
				function(data){
				
								$("#address").val(data.address);
								$("#contact1").val(data.contact1);
								
								if(data.address!=undefined)
								$("#0").focus();
								
							}, 'json');
											
					

			
			});
 $('#test1').jdPicker();
 $('#test2').jdPicker();
		


		var hauteur=0;
		$('.code').each(function(){
			if($(this).height()>hauteur) hauteur = $(this).height();
		});

		$('.code').each(function(){ $(this).height(hauteur); });
	});

        </script>
		<script>
	/*$.validator.setDefaults({
		submitHandler: function() { alert("submitted!"); }
	});*/
	$(document).ready(function() {
	document.getElementById('bill_no').focus();
		// validate signup form on keyup and submit
		$("#form1").validate({
			rules: {				
				grand_total: {
					required: true					
				},				
				supplier: {
					required: true,					
				},
				doc: {
					required: true,					
				},
				payment: {
					required: true,
				}
			},
			messages: {
				supplier: {
					required: "Please Enter Patient Name"					
				},
				payment: {
					required: "Please Enter Payment"
				},
				grand_total: {
					required: "Add Service / Treatment Items"
				},
				doc: {
					required: "Please Attending Doctor"
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
        <script type="text/javascript">
           function remove_row(o) {
    var p=o.parentNode.parentNode;
         p.parentNode.removeChild(p);
           }
     function add_values(){
         if(unique_check()){
    
         if(document.getElementById('edit_guid').value==""){
     if(document.getElementById('item').value!="" && document.getElementById('quty').value!="" &&  document.getElementById('total').value!="" ){
     
                    if(document.getElementById('quty').value!=0){
                        code=document.getElementById('item').value;
  
    quty=document.getElementById('quty').value;
    sell=document.getElementById('sell').value;
    disc=document.getElementById('stock').value;
    total=document.getElementById('total').value;
    item=document.getElementById('guid').value;
    main_total=document.getElementById('posnic_total').value;
    roll=parseInt(document.getElementById('roll_no').value);
 
    $('<tr id='+item+'><td><lable id='+item+'roll class=jibi007 >'+roll+'</label></td><td><input type=hidden value='+item+' id='+item+'id ><input type=text name="stock_name[]"  id='+item+'st style="width: 150px" class="round  my_with" readonly="readonly" ></td><td><input type=text name=quty[] readonly="readonly" value='+quty+' id='+item+'q class="round  my_with" style="text-align:right;" ></td><td><input type=text name=sell[] readonly="readonly" value='+sell+' id='+item+'s class="round  my_with" style="text-align:right;"  ></td><td><input type=text name=stock[] readonly="readonly" value='+item+' id='+item+'p class="round  my_with" style="text-align:right;" ></td><td><input type=text name=jibi[] readonly="readonly" value='+total+' id='+item+'to class="round  my_with" style="width: 120px;margin-left:20px;text-align:right;" ><input type=hidden name=total[] id='+item+'my_tot value='+main_total+'> </td><td><input type=button value="" id='+item+' style="width:30px;border:none;height:30px;background:url(images/edit_new.png)" class="round" onclick="edit_stock_details(this.id)"  ></td><td><input type=button value="" id='+item+' style="width:30px;border:none;height:30px;background:url(images/close_new.png)" class="round" onclick=reduce_balance("'+item+'");$(this).closest("tr").remove(); ></td></tr>').fadeIn("slow").appendTo('#item_copy_final');
    document.getElementById('quty').value="";
    document.getElementById('sell').value="";
    document.getElementById('stock').value="";
    document.getElementById('roll_no').value=roll+1;
    document.getElementById('total').value="";
    document.getElementById('item').value="";
    document.getElementById('guid').value="";
    if(document.getElementById('grand_total').value==""){
        document.getElementById('grand_total').value=main_total;
    }else{
    document.getElementById('grand_total').value=parseFloat(document.getElementById('grand_total').value)+parseFloat(main_total);
    }
     document.getElementById('main_grand_total').value=parseFloat(document.getElementById('grand_total').value);
    document.getElementById(item+'st').value=code;
    document.getElementById(item+'to').value=total;
}else{
     alert('No Stock Available For This Item');
}
}else{
     alert('Please Select An Item');
    }
    }else{
    id=document.getElementById('edit_guid').value;
    document.getElementById(id+'st').value=document.getElementById('item').value;  
    document.getElementById(id+'q').value=document.getElementById('quty').value;
    document.getElementById(id+'s').value=document.getElementById('sell').value;
    document.getElementById(id+'p').value=document.getElementById('stock').value;
    document.getElementById('grand_total').value=parseFloat(document.getElementById('grand_total').value)+parseFloat(document.getElementById('posnic_total').value)-parseFloat(document.getElementById(id+'my_tot').value);
    document.getElementById('main_grand_total').value=parseFloat(document.getElementById('grand_total').value);
    document.getElementById(id+'to').value=document.getElementById('total').value;
    document.getElementById(id+'id').value=id;

    document.getElementById(id+'my_tot').value=document.getElementById('posnic_total').value
    document.getElementById('quty').value="";
    document.getElementById('sell').value="";
    document.getElementById('stock').value="";
    document.getElementById('total').value="";
    document.getElementById('item').value="";
    document.getElementById('guid').value="";
    document.getElementById('edit_guid').value="";
    }
    }
    discount_amount();
    }
    function total_amount(){
    balance_amount();
               
        document.getElementById('total').value=document.getElementById('sell').value * document.getElementById('quty').value
    document.getElementById('posnic_total').value=document.getElementById('total').value;
      //  document.getElementById('total').value = '$ ' + parseFloat(document.getElementById('total').value).toFixed(2);
    if(document.getElementById('item').value===""){
       document.getElementById('item').focus();
   }
    }
   function edit_stock_details(id) {
     document.getElementById('item').value=document.getElementById(id+'st').value;
     document.getElementById('quty').value=document.getElementById(id+'q').value;
    document.getElementById('sell').value=document.getElementById(id+'s').value;
    document.getElementById('stock').value=document.getElementById(id+'').value;
    document.getElementById('total').value=document.getElementById(id+'to').value;
   
    document.getElementById('guid').value=id;
    document.getElementById('edit_guid').value=id;
     
   }
   function unique_check(){
      if(!document.getElementById(document.getElementById('guid').value) || document.getElementById('edit_guid').value==document.getElementById('guid').value){
            return true;
           
        }else{
           
            alert("This Item is already added In This Transaction");
            document.getElementById('item').focus();
             document.getElementById('quty').value="";
                document.getElementById('sell').value="";
                document.getElementById('stock').value="";
                document.getElementById('total').value="";
                document.getElementById('item').value="";
                document.getElementById('guid').value="";
                document.getElementById('edit_guid').value="";
                return false;
   }
   }
   function quantity_chnage(e){
         var unicode=e.charCode? e.charCode : e.keyCode
                if (unicode!=13 && unicode!=9){
        }
       else{
         add_values();
          
            document.getElementById("item").focus();
           
        }
         if (unicode!=27){
        }
       else{
               
             document.getElementById("item").focus();
        }
   }
    function formatCurrency(fieldObj)
{
    if (isNaN(fieldObj.value)) { return false; }
    fieldObj.value = '$ ' + parseFloat(fieldObj.value).toFixed(2);
    return true;
}
function balance_amount(){
    if(document.getElementById('payable_amount').value!="" && document.getElementById('payment').value!=""){
    data=parseFloat(document.getElementById('payable_amount').value);
    document.getElementById('balance').value=data-parseFloat(document.getElementById('payment').value);
        if(parseFloat(document.getElementById('payable_amount').value) >= parseFloat(document.getElementById('payment').value)){
       
    }else{
        if(document.getElementById('payable_amount').value!=""){
         document.getElementById('balance').value='000.00';
         document.getElementById('payment').value=parseFloat(document.getElementById('payable_amount').value);
        }else{
            document.getElementById('balance').value='000.00';
         document.getElementById('payment').value="";
        }
    }
    }else{
        document.getElementById('balance').value="";
    }

    
}
function stock_size(){
    if(parseFloat(document.getElementById('quty').value) > parseFloat(document.getElementById('stock').value)){
       document.getElementById('quty').value=parseFloat(document.getElementById('stock').value);
    
    console.log();
        }
}
function discount_amount(){
 
        if(document.getElementById('grand_total').value!=""){
            document.getElementById('disacount_amount').value=parseFloat(document.getElementById('grand_total').value)*(parseFloat(document.getElementById('discount').value))/100;
        
        }
        if(document.getElementById('discount').value==""){
             document.getElementById('disacount_amount').value="";
        }
        
        discont=parseFloat(document.getElementById('disacount_amount').value);
    if(document.getElementById('disacount_amount').value==""){
        discont=0;
    }
    document.getElementById('payable_amount').value=parseFloat(document.getElementById('grand_total').value)-discont;
    if(parseFloat(document.getElementById('payment').value)>parseFloat(document.getElementById('payable_amount').value)){
    document.getElementById('payment').value=parseFloat(document.getElementById('payable_amount').value);
         
        }
    
}
function discount_as_amount(){
      if(parseFloat(document.getElementById('disacount_amount').value) > parseFloat(document.getElementById('grand_total').value))
document.getElementById('disacount_amount').value="";

    if(document.getElementById('grand_total').value!=""){
        if(parseFloat(document.getElementById('disacount_amount').value) < parseFloat(document.getElementById('grand_total').value))
       { discont=parseFloat(document.getElementById('disacount_amount').value);
        
         document.getElementById('payable_amount').value=parseFloat(document.getElementById('grand_total').value)-discont;
    if(parseFloat(document.getElementById('payment').value)>parseFloat(document.getElementById('payable_amount').value)){
    document.getElementById('payment').value=parseFloat(document.getElementById('payable_amount').value);
   
    }
    }else{
      // document.getElementById('disacount_amount').value=parseFloat(document.getElementById('grand_total').value)-1;
    }
}
}
function reduce_balance(id){
 var minus=parseFloat(document.getElementById(id+"my_tot").value);
  document.getElementById('grand_total').value=parseFloat(document.getElementById('grand_total').value)-minus;
  document.getElementById('main_grand_total').value=parseFloat(document.getElementById('grand_total').value);
   discount_amount();
   var elements = document.getElementsByClassName('jibi007');
var j=1;
var my_id=id+'roll';
for (var i = 0; i < elements.length; i++) {
    elements[0].value=1;
   if(parseFloat(document.getElementById(my_id).innerHTML)==i){
     elements[i].innerHTML =parseFloat(elements[i-1].innerHTML)
   }else{
       if(i!=0){
         elements[i].innerHTML =parseFloat(elements[i-1].innerHTML)+1;
        j++;
       }
   }
     document.getElementById('roll_no').value=elements.length;
}
   //console.log(id);
}
function discount_type(){
    if(document.getElementById('round').checked){
        document.getElementById("discount").readOnly=true;
        document.getElementById("disacount_amount").readOnly=false;
        if(parseFloat(document.getElementById('grand_total'))!=""){
            document.getElementById('disacount_amount').value="";
            document.getElementById('discount').value="";
            discount_amount();
        }
    }else{
        document.getElementById("discount").readOnly=false;
        document.getElementById("disacount_amount").readOnly=true;  
    }
}
function discount_type_per(){
     if(document.getElementById('round').checked){
          document.getElementById("disacount_amount").value="";
    document.getElementById('discount').disabled=false;
    document.getElementById("discount").readOnly=false;
        document.getElementById("disacount_amount").readOnly=true;  
        document.getElementById("disacount_amount").style.background="#D9DBDD";
    
     }else{
         document.getElementById("disacount_amount").style.background='white';
         document.getElementById('discount').disabled=true;
          document.getElementById("discount").readOnly=true;
        document.getElementById("disacount_amount").readOnly=false;
        if(parseFloat(document.getElementById('grand_total'))!=""){
            document.getElementById('disacount_amount').value="";
            document.getElementById('discount').value="";
            discount_amount();
        }
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
					
						<h3 class="fl">Add New Treatment</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
				
							
					<?php
					//Gump is libarary for Validatoin
					 if(isset($_GET['msg'])){
                                                                              $data=$_GET['msg'];
                     $msg='<p style="color:#153450;font-size:1.2em;font-family:Verdana, Times New Roman, Times, san-serif;">'.$data.'</p><p><a href="new_treatment.php"><i class="fa fa-3x fa-plus"></i> Add New Treatment</a></p><p> <a href="view_treatment_book.php"><i class="fa fa-3x fa-eye"></i>View All Treatment Records</a></p>';//
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
                                    <input type="hidden" id="posnic_total" >
                                    <input type="hidden" id="roll_no" value="1" >
                 
                  <div class="mytable_row2 "><br>
                  <table class="form "  border="0" cellspacing="0" cellpadding="0">
                    <tr>  <td>&nbsp; </td> <td>&nbsp; </td>
                      <td><span class="man">*</span>Patient:</td>
                      <td><input name="supplier" placeholder="Enter Patient Name" type="text" id="supplier"  maxlength="200"  class="round regular-width-input" /></td>
                       
                      <td>Address:</td>
                      <td><input name="address" placeholder="Enter Address" type="text" id="address" maxlength="200"  class="round regular-width-input"  /></td>
					  <td >Contact:&nbsp; &nbsp; &nbsp; </td>
                      <td><input name="contact" placeholder="Enter Contact" type="text" id="contact1" maxlength="200"  class="round regular-width-input" onkeypress="return numbersonly(event)"/></td>
					  <td>Insurance Status: &nbsp;</td>
					  <td>
						  <select name="mode">
						  <option value="Self">Self</option>
						  <option value="Jubilee">Jubilee</option>
						  <option value="Sanlam">Sanlam</option>
						  <option value="Resolution Health">Resolution Health</option>
						  </select>
					   </td>
                       
                    </tr>
                    <tr>  <td>&nbsp; </td> <td>&nbsp; </td>
                      <td>Date:</td>
                      <td><input  name="date" id="test1" placeholder="" value="<?php echo date('d-m-Y');?>" type="text" id="name" maxlength="200"  class="round regular-width-input"  /></td>
					  <td>Doc:</td>
					  <td><input name="doc" placeholder="Attending Doc" type="text" id="doc"  maxlength="200"  class="round regular-width-input" /></td>
					  <?php
					  $max = $db->maxOfAll("id","stock_sales");
					  $max=$max+1;
					  $autoid="00".$max."";
					  ?>
                      <td>Invoice ID:</td>
                       <td><input name="transactionid" type="text" id="transactionid" maxlength="200"  class="round regular-width-input" value="<?php echo $autoid; ?>" /></td>
                 <td>Next Appointment:</td>
					  <td><input type="text" name="duedate" id="test2"  class="round regular-width-input"></td>
					  
                    </tr>
                  </table>
				  <div class="col-lg-6" style="margin:2% 0;">
						<label for="pc" class="col-sm-2 control-label">P/C</label>
							<textarea name="pc" id="pc" class="col-sm-10 round" rows="3"></textarea>
						<label for="hpc" class="col-sm-2 control-label">HPC</label>
							<textarea name="hpc" id="hpc" class="col-sm-10 round" rows="3"></textarea>
						<label for="pmh" class="col-sm-2 control-label">PMH</label>
							<textarea name="pmh" id="pmh" class="col-sm-10 round" rows="3"></textarea>
					</div>
					<div class="col-lg-5" style="margin:2% 0;">
						<label for="oe" class="col-sm-2 control-label">OE</label>
							<textarea name="oe" id="oe" class="col-sm-10 round" rows="3"></textarea>
						<label for="dx" class="col-sm-2 control-label">DX</label>
							<textarea name="dx" id="dx" class="col-sm-10 round" rows="3"></textarea>
					</div>
                  </div>
				  <div class="col-lg-12" align="center">
                  <input type="hidden" id="guid">
                  <input type="hidden" id="edit_guid">
                        
                  <table class="form table" >
                      <tr>
                          <td>Treatment / Service:</td>
                          <td>Quantity:</td>
                          <td>Price:</td>
                           <td><!--Available Stock:--></td>
                          <td>Total</td>
                           <td> &nbsp;</td>
                      </tr>
                        <tr>
                        <td><input name=""  type="text" id="item"  maxlength="200"  class="round regular-width-input " /></td>
                        <td><input name=""  type="text" id="quty"  maxlength="200"   class="round regular-width-input my_with" onKeyPress="quantity_chnage(event);return numbersonly(event)" onkeyup="total_amount();unique_check();stock_size();"    /></td>
						<td><input name=""  type="text" id="sell" readonly="readonly" maxlength="200"  class="round regular-width-input my_with"   /></td>            
						<td><input name=""  type="text" id="stock" readonly="readonly" maxlength="200"  class="round  my_with hidden"   /></td>
						<td><input name=""  type="text" id="total" maxlength="200"  class="round regular-width-input " style="margin-left: 20px"  /></td>
						<td><input type="button" onclick="add_values()" onkeyup=" balance_amount();" id="add_new_code"  style="margin-left:30px; width:30px;height:30px;border:none;background:url(images/add_new.png)" class="round"> </td>
                     
                    </tr>
                  </table>
                          
                       <div style="overflow:auto ;max-height:300px;  ">
                           <table class="form" id="item_copy_final" style="margin-left:45px ">
                    
                    </table>
                   </div>
                     </div>
                  
                       <div class="mytable_row2 ">
                  <table class="form">
                      <tr>
                           <td> &nbsp;</td> <td> <input type="checkbox" id="round" onclick="discount_type_per()" >Discount As Percentage</td>
                           <td></td> </tr>
                    <tr> 
                        <td> &nbsp;</td>
                        <td>Discount %<input type="text"  disabled class="round" onkeyup=" discount_amount(); " onkeypress="return numbersonly(event);" name="discount" id="discount" >
                      </td>
                 
                    <td>Discount Amount:<input type="text"  onkeypress="return numbersonly(event);"  onkeyup=" discount_as_amount(); "  class="round" id="disacount_amount" name="dis_amount" >               
                      </td>
                    
                        <td>Grand Total:<input type="hidden" readonly="readonly" id="grand_total" name="subtotal" > 
                        <input type="text" id="main_grand_total" readonly="readonly" class="round regular-width-input"  style="text-align:right;" >
                    </td>  <td> &nbsp;</td>
                  </tr> 
                      <tr> 
                        <td> &nbsp;</td>
                        <td>Payment:<input type="text"  class="round" onkeyup=" balance_amount(); " onkeypress="return numbersonly(event);" name="payment" id="payment" >
                      </td>
                     
                      <td>Balance:<input type="text"  class="round" readonly="readonly" id="balance" name="balance" >               
                      </td>
                    
                   
                       <td>Payable Amount:<input type="hidden" readonly="readonly" id="grand_total"  > 
                        <input type="text" id="payable_amount" readonly="readonly" name="payable" class="round regular-width-input"  style="text-align:right;" >
                    </td>  <td> &nbsp;</td>  <td> &nbsp;</td>  <td> &nbsp;</td>
                  </tr> 
                  <tr> 
                
                  <td> &nbsp;</td>
                  <td> &nbsp;</td>
                  </tr>
                  </table>
                  <table class="form">
                    <tr>
                     <td>
                        <input  class="button round green image-right ic-add text-capitalize" type="submit" name="Submit" value="Add">
                     </td>
					 <td>
						<input class="button round red image-right ic-cancel  text-capitalize"  type="reset" name="Reset" value="Reset"> 
					 </td>
                     <td> &nbsp;</td> <td> &nbsp;</td>
                    </tr>
                </table>
                       </div>
                </form>
						
				
					</div> <!-- end content-module-main -->
							
				
				</div> <!-- end content-module -->
				
				
		
		</div></div> <!-- end full-width -->
			
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<?php include ("footer.php");?> <!-- end footer -->

</body>
</html>
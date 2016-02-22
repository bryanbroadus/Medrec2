<?php
include_once("init.php");

					//Gump is libarary for Validatoin
					
					if(isset($_POST['name'])){
					$_POST = $gump->sanitize($_POST);
					$gump->validation_rules(array(
						'name'    	  => 'required|max_len,100|min_len,3',
						'stockid'     => 'required|max_len,200',
						'sell'     => 'required|max_len,200',

					));
				
					$gump->filter_rules(array(
						'name'    	  => 'trim|sanitize_string|mysql_escape',
						'stockid'     => 'trim|sanitize_string|mysql_escape',
						'sell'     => 'trim|sanitize_string|mysql_escape'

					));
				
					$validated_data = $gump->run($_POST);
					$name 		= "";
					$stockid 	= "";
					$sell           = "";
					$type           = "";
			

					if($validated_data === false) {
							echo $gump->get_readable_errors(true);
					} else {
						
						
							$name=mysql_real_escape_string($_POST['name']);
							$stockid=mysql_real_escape_string($_POST['stockid']);
							$sell=mysql_real_escape_string($_POST['sell']);
							$type=mysql_real_escape_string($_POST['type']);
							
						
						$count = $db->countOf("stock_details", "stock_name ='$name'");
		if($count>1)
			{
	        $data='Duplicate Entry. Please Verify';
                                            $msg='<p style="color:red;font-size:1.2em;font-family:Verdana, Times New Roman, Times, san-serif;">'.$data.'</p>';//
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
				
			if($db->query("insert into stock_details(stock_id,stock_name,stock_quatity,selling_price,category) values('$stockid','$name',0,$sell,'$type')"))
			{ 
				$db->query("insert into stock_avail(name,quantity) values('$name',0)");
                                  $msg=" $name Details Added" ;
				header("Location: add_stock.php?msg=$msg");
                        }else
			echo "<br><font color=red size=+1 >Problem in Adding !</font>" ;
			
			}
			
			
			}
							
							}				
				?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - Add Services / Products</title>
	
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
		$("#supplier").autocomplete("supplier1.php", {
		width: 160,
		autoFill: true,
		selectFirst: true
	});
		$("#category").autocomplete("category.php", {
		width: 160,
		autoFill: true,
		selectFirst: true
	});
		// validate signup form on keyup and submit
		$("#form1").validate({
			rules: {
				name: {
					required: true,
					minlength: 3,
					maxlength: 200
				},
				stockid: {
					required: true,
					minlength: 3,
					maxlength: 200
				},
				sell: {
					required: true,
					
				}
			},
			messages: {
				name: {
					required: "Please Enter Service Name",
					minlength: "Name must consist of at least 3 characters"
				},
				stockid: {
					required: "Please Enter Service / Product ID",
					minlength: "ID must consist of at least 3 characters"
				},
				sell: {
					required: "Please Enter Selling Price",
				},
		});
	
	});
function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=9){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
    }
    }
	</script>
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
				
				<h3>Services & Products Management</h3>
				<ul>
					<li><a href="add_stock.php">Add Service / Product</a></li>
					<li><a href="view_product.php">View Services / Products</a></li>
                </ul>
                               
                                
			</div> <!-- end side-menu -->
                        
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">					
						<h3 class="fl">Add Service / Product</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>				
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
				<?php
						if(isset($_GET['msg'])){
                                             $data=$_GET['msg'];
                                            $msg='<p style="color:#153450;font-size:1.2em;font-family:Verdana, Times New Roman, Times, san-serif;">'.$data.'</p><p><a href="add_stock.php"><i class="fa fa-3x fa-plus"></i> Add Another Service/Product</a></p><p> <a href="dashboard.php"><i class="fa fa-3x fa-home"></i>Go Home</a></p>';//
                                            ?>
                                                    
 <script  src="dist/js/jquery.ui.draggable.js"></script>
<script src="dist/js/jquery.alerts.js"></script>
<script src="dist/js/jquery.js"></script>
<link rel="stylesheet"  href="dist/js/jquery.alerts.css" >
                                                  
                                            <script type="text/javascript">
	
					jAlert('<?php echo  $msg ?>', 'MedRec');
			
</script>
                                                        <?php
                                         }	
					?>
				
				<form name="form1" method="post" id="form1" action="">
                  
                
                  <table class="form table"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span class="man">*</span>Stock ID:</td>
                      <td><input name="stockid" type="text" id="stockid" maxlength="200"  class="round default-width-input" placeholder="Enter Service ID" /></td>
                       
                      <td><span class="man">*</span>Name:</td>
                      <td><input name="name"placeholder="Enter Name of Service" type="text" id="name" maxlength="200"  class="round default-width-input" value="<?php echo $name; ?>" /></td>
                       
                    </tr>
                    <tr>                       
                      <td><span class="man">*</span>Price:</td>
                      <td><input name="sell" placeholder="Enter Selling Price" type="text" id="sell" maxlength="200"  class="round default-width-input" onkeypress="return numbersonly(event)" value="<?php echo $sell; ?>" /></td>
					  <td><input type="radio" name="type" id="service" value="Service" >Service</td> 
					  <td><input type="radio" name="type" id="product" value="Product" >Product</td>
                       
                    </tr>
                   
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    
                    
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
	<?php include ("footer.php");?> <!-- end footer -->

</body>
</html>
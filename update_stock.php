<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - Update Services / Products</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<?php include_once("tpl/common_js.php"); ?>
	<script src="js/script.js"></script>  
		<script>
	/*$.validator.setDefaults({
		submitHandler: function() { alert("submitted!"); }
	});*/
	$(document).ready(function() {
	
		// validate signup form on keyup and submit
		$("#form1").validate({
			rules: {
				name: {
					required: true,
					minlength: 3,
					maxlength: 200
				},
				
				sell: {
                                        required: true
					
				},
				Category: {
                                        required: true
					
				}
			},
			messages: {
				name: {
					required: "Please enter the Service or Product Name",
					minlength: "Name must consist of at least 3 characters"
				},
				sell: {
					required: "Please enter the Selling Price"
				},
				Category: {
					required: "Please select whether Service or Product"
				}
			}
		});
	
	});
function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
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
				
				<h3>Services & Products Management</h3>
				<ul>
					<li><a href="add_stock.php">Add Service / Product</a></li>
					<li><a href="view_product.php">View Services / Product</a></li>              
				</ul>
				                            
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Update Service / Product</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
				<form name="form1" method="post" id="form1" action="">
                  <p><strong>Update Service / Product Details </strong> - ( Control + U)</p>
                  <table class="form table"  border="0" cellspacing="0" cellpadding="0">
				  <?php
				if(isset($_POST['id']))

            {
			
			$id=mysql_real_escape_string($_POST['id']);
			$name=  trim(mysql_real_escape_string($_POST['name']));
			$sell=trim(mysql_real_escape_string($_POST['sell']));
			$Category=trim(mysql_real_escape_string($_POST['Category']));
			$date=trim(mysql_real_escape_string($_POST['date']));
			
			
				
			if($db->query("UPDATE stock_details  SET stock_name ='$name',selling_price='$sell',category='$Category',date='$date'  where id=$id"))
			{ 
						$db->query("insert into stock_avail(name) values('$name')");
                        $data=" $name Details Updated" ;
				                                            $msg='<p style="color:#153450;font-size:1.2em;font-family:Verdana, Times New Roman, Times, sans-serif;">'.$data.'</p><p><a href="view_product.php"><i class="fa fa-3x fa-rotate-left"></i> Back to Services&Products</a></p><p> <a href="dashboard.php"><i class="fa fa-3x fa-home"></i>Go Home</a></p>';//
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
			
				$line = $db->queryUniqueObject("SELECT * FROM stock_details WHERE id=$id");
				?>
		<form name="form1" method="post" id="form1" action="">
                    
                   <input name="id" type="hidden" value="<?php echo $_GET['sid']; ?>">  
                   <tr><td>&nbsp;</td>
                       <td>Stock ID</td>
                       <td><input name="stock_id" type="text" readonly="readonly" id="name" maxlength="200"  class="round default-width-input" value="<?php echo $line->stock_id ; ?> "/>
                      </td>
                   <td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td>
					<td>Name</td>
                      <td><input name="name" type="text" id="name" maxlength="200"  class="round default-width-input" value="<?php echo $line->stock_name ; ?> "/></td>
                   <td>Type: </td>
                      <td><input name="CurrentCategory"  type="text" id="category" maxlength="20"   class="round regular-width-input" 
					  value="<?php echo $line->category ; ?>" disabled/></td>
					  <td><input type="radio" name="Category" id="service" value="Service" >Service</td> 
					  <td><input type="radio" name="Category" id="product" value="Product" >Product</td>
                    </tr>
                    
                    <tr><td>&nbsp;</td>
                             <!--<td>Cost  </td>
                      <td><input name="cost"  type="text" id="cost" maxlength="20"  class="round default-width-input" 
                                 value="<?php echo $line->company_price; ?>"onkeypress="return numbersonly(event)" /></td>-->
                    <td>Selling Price </td>
                      <td><input name="sell"  type="text" id="selling" maxlength="20"  class="round default-width-input" 
                                 value="<?php echo $line->selling_price ; ?>"onkeypress="return numbersonly(event)" /></td>
								 <td><input name="date"  type="hidden" id="date"  value="<?php echo $line->date  ; ?>" /></td>
                    </tr>
                   
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>
                        <input  class="button round green image-right ic-add text-capitalize" type="submit" name="Submit" value="Update">
                     </td>
					 <td>
						<input class="button round red image-right ic-cancel  text-capitalize"  type="reset" name="Reset" value="Reset"> 
					 </td>
			<td>&nbsp;</td>		
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
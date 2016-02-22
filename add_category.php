<?php
include_once("init.php");

?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EZ Stock - Add Stock Category</title>
	
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
				address: {
					minlength: 3,
					maxlength: 500
				}
			},
			messages: {
				name: {
					required: "Please enter a Category Name",
					minlength: "Category Name must consist of at least 3 characters"
				},
				address: {
					minlength: "Category Discription must be at least 3 characters long",
					maxlength: "Category Discription must be at least 3 characters long"
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
				
				<h3>supplier Management</h3>
				<ul>
					<li><a href="add_stock.php">Add Stock/Product</a></li>
					<li><a href="view_product.php">View Stock/Product</a></li>
					<li><a href="add_category.php">Add Stock Category</a></li>
					<li><a href="view_category.php">view Stock Category</a></li>
				</ul>
			                                          
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
			
				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">Add Stock Category</h3>
						<span class="fr expand-collapse-text">Click to collapse</span>
						<span class="fr expand-collapse-text initial-expand">Click to expand</span>
					
					</div> <!-- end content-module-heading -->
					
						<div class="content-module-main cf">
				
							
					<?php
					//Gump is libarary for Validatoin
					
					if(isset($_POST['name'])){
					$_POST = $gump->sanitize($_POST);
					$gump->validation_rules(array(
						'name'    	  => 'required|max_len,100|min_len,3',
						'address'     => 'max_len,200',

					));
				
					$gump->filter_rules(array(
						'name'    	  => 'trim|sanitize_string|mysql_escape',
						'address'     => 'trim|sanitize_string|mysql_escape',

					));
				
					$validated_data = $gump->run($_POST);
					$name 		= "";
					$address 	= "";
			

					if($validated_data === false) {
							echo $gump->get_readable_errors(true);
					} else {
						
						
							$name=mysql_real_escape_string($_POST['name']);
							$address=mysql_real_escape_string($_POST['address']);
							
						
						$count = $db->countOf("category_details", "category_name='$name'");
		if($count==1)
			{
		echo "<font color=red> Dublicat Entry. Please Verify</font>";
			}
			else
			{
				
			if($db->query("insert into category_details values(NULL,'$name','$address')")){
			
                           $msg="  $name  Category Details Added" ;
				header("Location: add_category.php?msg=$msg");  
                        }
			else
			echo "<br><font color=red size=+1 >Problem in Adding !</font>" ;
			
			}
			
			
			}
							
							}
						
				  if(isset($_GET['msg'])){
                                             $data=$_GET['msg'];
                                            $msg='<p style=color:#153450;font-family:gfont-family:Georgia, Times New Roman, Times, serif>'.$data.'</p>';//
                                            ?>
                                                    
 <script  src="dist/js/jquery.ui.draggable.js"></script>
<script src="dist/js/jquery.alerts.js"></script>
<script src="dist/js/jquery.js"></script>
<link rel="stylesheet"  href="dist/js/jquery.alerts.css" >
                                                  
                                            <script type="text/javascript">
	
					jAlert('<?php echo  $msg; ?>', 'POSNIC');
			
</script>
                                                        <?php
                                         }
				
				?>
				
				<form name="form1" method="post" id="form1" action="">
                  
                  <p><strong>Add New Product Category </strong> - Add New ( Control +A)</p>
                  <table class="form table"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span class="man">*</span>Name:</td>
                      <td><input name="name"placeholder="Enter Category Name" type="text" id="name" maxlength="200"  class="round default-width-input" value="<?php echo $name; ?>" /></td>
                       
                    </tr>
                    <tr>
                      <td>Description</td>
                      <td><textarea name="address" placeholder="Enter Description"cols="8" class="round full-width-textarea"><?php echo $address; ?></textarea></td>
                      
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
	<?php include ("footer.php");?><!-- end footer -->

</body>
</html>
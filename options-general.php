<?php include_once("init.php");
 if(isset($_POST['submit']) and $_POST['submit']==='Submit'){
    
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 30000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    $upload= $_FILES["file"]["name"] ;
    $type=$_FILES["file"]["type"];


  
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
        
       unlink($upload);
      }
   
       
        $name=$_FILES["file"]["name"] ;
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $name);
      //echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
    $upload;
   $_SESSION['logo']=$upload;
	
	# Note that filters and validators are separate rule sets and method calls. There is a good reason for this. 

            $db->query("UPDATE store_details  SET log ='".$upload."',type='".$type."'");
         ?>
<script type="text/javascript">
    setTimeout("window.location.reload();",4000);
    </script>
        <?php
            header("location:options-general.php");
      
    }
  }
else
  {
  $msg="<span class=\"danger\"><i class=\"fa fa-2x fa-info-circle\"></i> Error: Invalid File format </br> Make sure image file ends with \'.jpeg\', \'.jpg\', \'.gif\' or \'.png\'</span>" ;
			header("Location:options-general.php?msg=$msg");
        }}
      
?>
	<?php        
        if(isset($_POST['submit']) and isset($_POST['sname']) and isset($_POST['address']) and $_POST['submit']=='Update'){
    $name=mysql_real_escape_string($_POST['sname']);
    $address=mysql_real_escape_string($_POST['address']);
    $place=mysql_real_escape_string($_POST['place']);
    $city=mysql_real_escape_string($_POST['city']);
    $phone=mysql_real_escape_string($_POST['phone']);
    $web=mysql_real_escape_string($_POST['website']);
    $email=mysql_real_escape_string($_POST['email']);
    $pin=mysql_real_escape_string($_POST['pin']);
  if($db->query("UPDATE store_details  SET pin='".$pin."',city='".$city."',name='".$name."',email='".$email."',web='".$web."',address='".$address."',place='".$place."',phone='".$phone."' ")){
			$msg="<span><i class=\"fa fa-2x fa-info-check-circle\"></i> General Settings Updated successfully</span>";
			header("Location:options-general.php?msg=$msg");
		}else{
             $msg="<span class=\"danger\"><i class=\"fa fa-2x fa-info-circle\"></i> Error: General Settings details could not be updated. Please double check your entries </span>" ;
			 header("Location:options-general.php?msg=$msg");
              }	
          // header("location:logo_set.php");
    //  exit;
        }
        ?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MedRec - General Settings</title>
	
	<!-- Stylesheets -->
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="js/lib/validationEngine.jquery.css">
	
	<!-- Scripts -->
	<?php include_once("tpl/common_js.php"); ?>
	<script src="js/script.js"></script>  
	
	<script>
	/*$.validator.setDefaults({
		submitHandler: function() { alert("submitted!"); }
	});*/
	
	$(document).ready(function() {
		
		// validate signup form on keyup and submit
		$("#login-form").validate({
			rules: {
				sname: {
					required: true,
					minlength: 3
				},
				address: {
					required: true,
					minlength: 3
				},
				place: {
					required: true,
					minlength: 3
				},
				website: {
					required: true,
					minlength: 3
				},
				email: {
					required: true,
					minlength: 3
				},
				phone: {
					required: true,
					minlength: 10,
                                        maxlength:12
				},
				city: {
					required: true,
					minlength: 3
				}
			},
			messages: {
				sname: {
					required: "Please enter your Business or Organisation Name",
					minlength: "Your Store Name must consist of at least 3 characters"
				},
				address: {
					required: "Please Enter Box Address",
					minlength: "Your Address must be at least 3 characters long"
				},
				place: {
					required: "Please Enter The Physical Address",
					minlength: "Your place must be at least 3 characters long"
				},
				website: {
					required: "Please Enter The Website",
					minlength: "Your Website must be at least 3 characters long"
				},
				email: {
					required: "Please Enter The email",
					minlength: "Your Email must be at least 3 characters long"
				},
				phone: {
					required: "Please Enter your Phone number",
					minlength: "Your Phone must be at least 10 characters long",
					maxlength: "Your Phone must be at Less than 13 characters long"
				},
				city: {
					required: "Please Enter The city",
					minlength: "Your city must be at least 3 characters long"
				}
			}
		});
	
	});

	</script>

	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
</head>
<body>
	<!-- TOP BAR -->
	<div id="top-bar">
	<?php include_once("tpl/top_bar.php"); ?>	
	</div> 
	<!-- end top-bar -->
	
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="page-full-width cf">
			<div class="side-menu fl">
				<h3>Quick Links</h3>
				<ul>
					<li><a href="options-general.php">General Settings</a></li>
					<li><a href="change_password.php">Password Settings</a></li>
					<li><a href="options-update.php">Update Settings</a></li>
					<li><a href="options-users.php">User Settings</a></li>
					<li><a href="options-personnel.php">Personnel Settings</a></li>
				</ul>
				
			</div> <!-- end side-menu -->
			
			<div class="side-content fr">
				<div class="content-module">
					<div class="content-module-heading cf">
						<h3 class="fl">General Settings</h3>
						<span class="fr expand-collapse-text"><i class="fa fa-3x fa-thumb-tack"></i></span>
						<span class="fr expand-collapse-text initial-expand"><i class="fa fa-3x tilt-left fa-thumb-tack"></i></span>
					</div> <!-- end content-module-heading -->
				<div class="content-module-main cf">
					<?php
					//Gump is library for Validation
					 if(isset($_GET['msg'])){
                     $data=$_GET['msg'];
                     $msg='<p style="color:#32AE2A;font-size:1.2em;font-family:Verdana, Times New Roman, Times, san-serif;">'.$data.'</p><p><a href="options-general.php"><i class="fa fa-2x fa-rotate-left"></i> Back To Settings</a></p><p> <a href="dashboard.php"><i class="fa fa-2x fa-home"></i>Go Back Home</a></p>';//
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
		<div class="col-lg-12">
		<form action="" method="POST" class="cmxform" autocomplete="off">
		<?php 
                $line = $db->queryUniqueObject("SELECT * FROM store_details ");
                ?>
			<table class="table">
				<tr>
					<td>
						<p>
						<label>Business or Organisation Name</label>
                         <input type="text" name="sname" id="name" class="round full-width-input"  value="<?php echo $line->name ?>" autofocus  /> 
                         </p>
					</td>
                    <td>
						<p>
                         <label>Box Address</label>
                         <input type="text" name="address" id="address" class="round full-width-input" value="<?php echo $line->address ?>"  autofocus  /> 
                         </p>
					</td>
                </tr>
                <tr>
					<td>
						<p>
                        <label>Physical Address</label>
                        <input type="text" name="place" id="place" class="round full-width-input" value="<?php echo $line->place ?>"   autofocus  /> 
                        </p>
                    </td>
					<td>
						<p>
                         <label>City</label>
                         <input type="text" name="city" id="city" class="round full-width-input" value="<?php echo $line->city ?>"  autofocus  /> 
                        </p>
					</td>
				</tr>
				<tr>
                    <td>
						<p>
                        <label>Pin</label>
                         <input type="text" name="pin" id="pin" class="round full-width-input" value="<?php echo $line->pin ?>"   autofocus  /> 
                         </p>
                    </td>
                    <td>
						<p>
                        <label>Phone</label>
                        <input type="text" name="phone" id="phone" class="round full-width-input" value="<?php echo $line->phone ?>"   autofocus  /> 
                        </p>
					</td>
				</tr>
				<tr>
					<td>
						<p>
                        <label>Website</label>
                        <input type="text" name="website" id="website" class="round full-width-input" value="<?php echo $line->web ?>"   autofocus  /> 
                        </p>
					</td>
					<td>
						<p>
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="round full-width-input" value="<?php echo $line->email ?>"  autofocus  /> 
                        </p>
				    </td>
				</tr>
				<tr></tr>
                <tr>
					<td>
						<button type="submit" name="submit" class="btn btn-success text-capitalize" value="Update"><i class="fa fa-upload"></i> Update</button>
                    </td>
					<td>
						<button type="reset" name="Reset" class="btn btn-danger text-capitalize"><i class="fa fa-times-circle"></i> Reset</button>
					</td>
				</tr>
			</table>
		</form>
		</div>
            <div class="col-md-4 col-md-push-2">
				<form action="" method="POST" class="cmxform" enctype="multipart/form-data">
					<p>
					<label>Upload Logo</label>
						<input type="file" name="file" id="file" class="round full-width-input"><br>
						<button type="submit" name="submit" class="btn btn-success text-capitalize" value="Submit"><i class="fa fa-cloud-upload"></i> Upload</button>
					</p>
				</form>
			</div>
			<div class="col-md-4 col-md-push-2">
			<p class="red" style="padding:4px;">* Ideal logo height should be 60px</p>
			<p class="red" style="padding:4px;">* Logo file format should be '.jpeg', '.jpg', '.gif' or '.png'</p>
			</div>			
			</div><!--end content-module-main -->
			</div><!--end content-module -->
			</div><!--end side-content -->
			</div><!--end page-full-width -->
	</div> <!-- end content -->
        
	
	
	<!-- FOOTER -->
	<?php include ("footer.php");?><!-- end footer -->

</body>
</html>


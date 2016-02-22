<!-- HEADER -->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 30px height. -->
                         <?php $line = $db->queryUniqueObject("SELECT * FROM store_details ");
			$_SESSION['logo']=$line->log; 
			 ?>
                        <a href="#" id="company-branding-small" class="fl"><img src="<?php if(isset($_SESSION['logo'])) { echo "upload/".$_SESSION['logo'];}else{ echo "upload/posnic.png"; } ?>" alt="Point of Sale" /></a>
			<ul id="tabs" class="fl">
				<li><a href="dashboard.php"><i class="fa fa-dashboard fa-1x"></i> Dashboard</a></li>
				<li><a href="view_customers.php"><i class="fa fa-users fa-1x"></i> Patients</a></li>
				<li><a href="view_product.php"><i class="fa fa-cubes fa-1x"></i> Services / Products</a>
					<!--<ul><li><a href="view_treatment_book.php"><i class="fa fa-cubes fa-1x"></i> Treatment Book</a></li></ul>-->
				</li>
				<li><a href="view_sales.php"><i class="fa fa-shopping-cart fa-1x"></i> Invoices</a></li>
				<li><a href="view_receipts.php"><i class="fa fa-credit-card fa-1x"></i> Receipts</a></li>
				<li><a href="view_payments.php"><i class="fa fa-money fa-1x"></i> Payments / Outstandings</a></li>
				<li><a href="view_report.php"><i class="fa fa-bar-chart-o fa-1x"></i> Reports</a></li>
			</ul> <!-- end tabs -->
			<ul class="nav navbar-nav">
				<li class="dropdown pull-right"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?php echo $POSNIC['username'] ?> ! <b class="caret"></b></a>
                <ul class="dropdown-menu">
					<li><a href="options-general.php"><i class="fa fa-1x fa-gear fa-spin"></i> Settings</a></li>
					<li class="divider"></li>
					<li class="v-sep"><a href="javascript:void(0);" onclick="javascript:window.open('shortcuts.html','myNewWinsr','width=600,height=110,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes');"><i class="fa fa-1x fa-bookmark"></i>  Show Shortcuts</a></li>
					<li class="divider"></li>
						<li><a href="change_password.php"><i class="fa fa-1x fa-exchange"></i> Change Password</a></li>
					<li class="divider"></li>
						<li><a href="logout.php"><i class="fa fa-1x fa-power-off"></i> Log out</a></li>
                </ul>
           </li>
		   </ul><!--
			<ul id="nav" class="fr">
				<li><a href="#" class="round button dark menu-user image-left">Hi, <strong><?php echo $POSNIC['username'] ?></strong></a>
					<ul>
						<li><a href="update_details.php">Update Store Details</a></li>
						<li class="v-sep"><a href="javascript:void(0);" onclick="javascript:window.open('shortcuts.html','myNewWinsr','width=600,height=110,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no,scrollbars=yes');">Show Shortcuts</a></li>
						<li><a href="change_password.php">Change Password</a></li>
						<li><a href="logout.php">Log out</a></li>
					</ul> 
				</li>
			
				<li></li>
				
			</ul>  end nav -->
			
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
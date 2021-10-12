
<div id="header">
	<div>
	<h1><img src="../Resources/designimages/logo.png" width="350" height="90"></h1>
	</div>
	</div>
	<div class="navigationbar">
	<ul>
    <li><a href="manageorders.php">Manage Orders</a></li>
    <li><a href="manageusers.php">Manage Users</a></li>
    <li><a href="manageproducts.php">Manage Products</a></li>
    <li><a href="managecategory.php">Manage Category</a></li>
	</ul>
    </div>
    
    <?php
	session_start();
require('db.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Login page related .php////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['updateorder'])) {
	
		foreach ($_POST['selectedvalues'] as $idx => $trackingid) {
				$update_tracking        = "UPDATE tblordertrack SET Status='" . $_POST['newstatus'][$idx] . "' WHERE TrackID='" . $trackingid . "'";
				$result_update_tracking = mysqli_query($con, $update_tracking);
		} 
		header("Location: manageorders.php");
} 
?>

    <?php
require('db.php');
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Login page related .php////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////Select Categories/////////////////////////////
$select_category        = "SELECT * FROM `tblcategory`";
$result_select_category = mysqli_query($con, $select_category);
/////////////////////////////Add new products/////////////////////////////
if (isset($_POST['addnewproduct'])) {
	$MESSAGE_PRODUCTS = '';
	$IMAGE = $_FILES['image']['name'];
  	// image file directory
  	$DIRECTORY = "Resources/products/".basename($IMAGE);
	
	$INITIAL_PRODUCT_PRICE = $_POST['InitialPrice'];
	$DISCOUNT = $_POST['Discount'];
	$PRODUCT_PRICE = $INITIAL_PRODUCT_PRICE - ($INITIAL_PRODUCT_PRICE * ($DISCOUNT/ 100));
								
$insert_to_products        = "INSERT INTO `tblproducts`(`ProductName`, `ProductPrice`, `InitialProductPrice`, `ProductImage`, `CategoryID`, `ProductBrand`, `Colour`, `Dimensions`, `ProductDesignType`, `ProductDiscountAmount`, `ProductBikeType`, `ProductAvailability`) VALUES ('".$_POST['Name']."','".$PRODUCT_PRICE."','".$INITIAL_PRODUCT_PRICE."','".$DIRECTORY."','".$_POST['CategoryID']."','".$_POST['Brand']."','".$_POST['Colour']."','".$_POST['Dimensions']."','".$_POST['DesignType']."','".$DISCOUNT."','".$_POST['BikeType']."','".$_POST['Availability']."')";
								$result_l_insert_to_products = mysqli_query($con, $insert_to_products);
								if($insert_to_products){
								
								$MESSAGE_PRODUCTS = 'Succssfully Added!';
								}else{
									$MESSAGE_PRODUCTS = 'Unsuccessful!';
									}
								
} 
?>
<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Logout page related .php///////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST["logout"])) {
		session_start();
		if (session_destroy()) {
				header("Location: login.php");
		} //session_destroy()
} //isset($_POST["logout"])
?>

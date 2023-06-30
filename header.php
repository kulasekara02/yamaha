<div id="header">
	<div>
	<h1><img src="Resources/designimages/logo.png" width="350" height="90"></h1>
	</div>
	</div>
	<div class="navigationbar">
	<ul>
	<li><a href="Home.php">Home</a></li>
	<li><a href="pnb.php">Products</a></li>
	<li><a href="promotions.php">Promotions</a></li>
	<li><a href="aboutus.php">About Us</a></li>
	<li><a href="contactus.php">Contact Us</a></li>
	<li><a href="cart.php">Cart</a></li>
	<li><a href="myprofile.php">My Profile</a></li>
	</ul>
    </div>
    
    <?php
require ('db.php');
session_start();
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Login page related .php////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////Variables to store data/////////////////////////////
$MESSAGE_LOGIN = '';
$PRODUCT_ID    = '';
/////////////////////////////Login/////////////////////////////
if (isset($_POST['login'])) {
		if (!isset($_POST['username']) || !isset($_POST['password'])) {
				$MESSAGE_LOGIN = "Username or Password Empty";
		} //!isset($_POST['username']) || !isset($_POST['password'])
		else {
				$USER                   = $_POST['username'];
				$USERNAME               = mysqli_real_escape_string($con, $USER);
				$PASS                   = $_POST['password'];
				$PASSWORD               = mysqli_real_escape_string($con, $PASS);
				$l_select_user          = "SELECT Username,Password FROM tblusers WHERE Username ='$USER' AND Password = '".md5($PASS)."' LIMIT 1";
				$results_l_select_user  = mysqli_query($con, $l_select_user);
				$l_select_admin         = "SELECT Username,Password FROM tbladmins WHERE Username='$USER' AND Password = '".md5($PASS)."' LIMIT 1";
				$results_l_select_admin = mysqli_query($con, $l_select_admin);
				if (mysqli_num_rows($results_l_select_user) > 0) {
						$_SESSION['username']        = $USERNAME;
						$l_insert_to_log_user        = "INSERT into `tbluserlog` (Username,LoginTime,Logout,Status) VALUES ('$USER','0',date('Y-m-d H:i:s'),'1')";
						$result_l_insert_to_log_user = mysqli_query($con, $l_insert_to_log_user);
						if (!isset($_SESSION['selectedproduct'])) {
								header('location: myprofile.php');
						} //!isset($_SESSION['selectedproduct'])
						else {
								$PRODUCT_ID              = $_SESSION['selectedproduct'];
								$PRODUCT_QUANTITY        = $_SESSION['selectedquantity'];
								$l_insert_to_cart        = "INSERT into `tblcart` (ProductID,Username,Quantity) VALUES (" . $PRODUCT_ID . ",'$USER'," . $PRODUCT_QUANTITY . ")";
								$result_l_insert_to_cart = mysqli_query($con, $l_insert_to_cart);
								header('location: cart.php');
						}
				} //mysqli_num_rows($results_l_select_user) > 0
				else if (mysqli_num_rows($results_l_select_admin) > 0) {
						$_SESSION['username']         = $USERNAME;
						$l_insert_to_log_admin        = "INSERT into `tbluserlog` (Username,LoginTime,Logout,Status) VALUES ('$USER','0',date('Y-m-d H:i:s'),'1')";
						$result_l_insert_to_log_admin = mysqli_query($con, $l_insert_to_log_admin);
						header('location: admin/manageorders.php');
				} //mysqli_num_rows($results_l_select_admin) > 0
				else {
						$MESSAGE_LOGIN = "Username or Password is Invalid";
				}
		}
} //isset($_POST['login'])
/////////////////////////////Continue as a guest/////////////////////////////
if (isset($_POST['continueguest'])) {
		$PRODUCT_ID                        = $_SESSION['selectedproduct'];
		$PRODUCT_QUANTITY                  = $_SESSION['selectedquantity'];
		$_SESSION['totalproducts']         = $PRODUCT_QUANTITY;
		$generate_delivery_id_guest        = mysqli_query($con, "SELECT delivery_id FROM (SELECT FLOOR(RAND() * 99999) AS delivery_id  UNION SELECT FLOOR(RAND() * 99999) AS random_num) AS numbers_mst_plus_1 WHERE `delivery_id` NOT IN (SELECT DeliveryID FROM tblorder) LIMIT 1");
		$result_generate_delivery_id_guest = mysqli_fetch_assoc($generate_delivery_id_guest);
		$DELIVERY_ID_GUEST                 = $result_generate_delivery_id_guest['delivery_id'];
		$_SESSION['deliveryid']            = $DELIVERY_ID_GUEST;
		$l_select_total_price              = "SELECT ProductPrice FROM `tblproducts` WHERE ProductID='" . $PRODUCT_ID . "' ";
		$result_l_select_total_price       = mysqli_query($con, $l_select_total_price);
		$total_price                       = mysqli_fetch_assoc($result_l_select_total_price);
		$PRICE                             = $total_price['ProductPrice'];
		$TOTAL_PRICE                       = $PRICE * $PRODUCT_QUANTITY;
		$_SESSION['totalprice']            = $TOTAL_PRICE;
		$l_insert_order                    = "INSERT into `tblorder` (ProductID,Quantity,Username,DeliveryID) VALUES (" . $PRODUCT_ID . "," . $PRODUCT_QUANTITY . ",'Guest'," . $DELIVERY_ID_GUEST . ")";
		$result_l_insert_ordert            = mysqli_query($con, $l_insert_order);
		header("Location: checkout.php");
} //isset($_POST['continueguest'])
?>

<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Register page related .php////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
require('db.php');
/////////////////////////////Variables to store data/////////////////////////////
$MESSAGE_REGISTER = '';
/////////////////////////////Regster/////////////////////////////
if (isset($_POST["register"])) {
		$USERNAME           = $_POST['username'];
		$USERNAME           = mysqli_real_escape_string($con, $USERNAME);
		$FIRST_NAME         = stripslashes($_POST['firstname']);
		$FIRST_NAME         = mysqli_real_escape_string($con, $FIRST_NAME);
		$LAST_NAME          = stripslashes($_POST['lastname']);
		$LAST_NAME          = mysqli_real_escape_string($con, $LAST_NAME);
		$E_MAIL             = stripslashes($_POST['email']);
		$E_MAIL             = mysqli_real_escape_string($con, $E_MAIL);
		$PHONE_NUMBER       = stripslashes($_POST['phonenumber']);
		$PHONE_NUMBER       = mysqli_real_escape_string($con, $PHONE_NUMBER);
		$PASSWORD           = stripslashes($_POST['password']);
		$PASSWORD           = mysqli_real_escape_string($con, $PASSWORD);
		$RE_TYPE_PASSWORD   = stripslashes($_POST['retypepassword']);
		$RE_TYPE_PASSWORD   = mysqli_real_escape_string($con, $RE_TYPE_PASSWORD);
		$SECURITY_QUESTION  = stripslashes($_POST['securityquestion']);
		$SECURITY_QUESTION  = mysqli_real_escape_string($con, $SECURITY_QUESTION);
		$SECURITY_ANSWER    = stripslashes($_POST['securityanswer']);
		$SECURITY_ANSWER    = mysqli_real_escape_string($con, $SECURITY_ANSWER);
		$select_user        = "SELECT * FROM tblusers WHERE Username='$USERNAME' OR EmailAddress='$E_MAIL' LIMIT 1";
		$result_select_user = mysqli_query($con, $select_user);
		$USER               = mysqli_fetch_assoc($result_select_user);
		// if user exists
		if ($USER) {
				if ($USER['Username'] = $USERNAME) {
						$MESSAGE_REGISTER = "OOPS! Username Is Already Taken!";
				} //$USER['Username'] = $USERNAME
				if ($USER['EmailAddress'] = $E_MAIL) {
						$MESSAGE_REGISTER = "OOPS! Email Is Already Taken";
				} //$USER['EmailAddress'] = $E_MAIL
		} //$USER
		// if fields are filled
		else if (!empty($USERNAME) || !empty($FIRST_NAME) || !empty($LAST_NAME) || !empty($E_MAIL) || !empty($PHONE_NUMBER) || !empty($PASSWORD) || !empty($RE_TYPE_PASSWORD)) {
				$MESSAGE_REGISTER = "OOPS! Fill Mandatory Fields!";
		} //!isset($USERNAME) || !isset($FIRST_NAME) || !isset($LAST_NAME) || !isset($E_MAIL) || !isset($PHONE_NUMBER) || !isset($PASSWORD) || !isset($RE_TYPE_PASSWORD)
		// if password matches
		else if ($PASSWORD != $RE_TYPE_PASSWORD) {
				$MESSAGE_REGISTER = "Password doesnt match!";
		} //$PASSWORD != $RE_TYPE_PASSWORD
		else if (strlen($PASSWORD) < '8') {
        $MESSAGE_REGISTER= "Password Must Contain At Least 8 Characters!";
    	}
		else if (!filter_var($E_MAIL, FILTER_VALIDATE_EMAIL)) {
  $MESSAGE_REGISTER = "Invalid Email";
		}
		
		// enter user to database
		else {
				$insert_user        = "INSERT INTO `tblusers`(`Username`, `FirstName`, `LastName`, `EmailAddress`, `PhoneNumber`, `Password`, `SecurityQuestion`, `SecurityAnswer`) VALUES ('$USERNAME','$FIRST_NAME','$LAST_NAME','$E_MAIL','$PHONE_NUMBER','" . md5($PASSWORD) . "','$SECURITY_QUESTION','$SECURITY_ANSWER')";
				$result_insert_user = mysqli_query($con, $insert_user);
				if ($result_insert_user) {
						$MESSAGE_REGISTER = "successful";
				} //$result_insert_user
				else {
						$MESSAGE_REGISTER = "Registration unsuccessful!";
				}
		}
		mysqli_close($con); // Closing connection
} //isset($_POST["register"])
?>

<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////View Products page related .php////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
require('db.php');
///////////////////////Add products to cart///////////////////////
$MESSAGE_REVIEW = '';
if (isset($_POST['addtocart'])) {
		if (!isset($_SESSION['username'])) {
				$_SESSION['selectedproduct']  = $_POST['productid'];
				$_SESSION['selectedquantity'] = $_POST['quantity'];
				$_SESSION['crumbs']           = "1";
				header("location: login.php");
		} //!isset($_SESSION['username'])
		else {
				$PRODUCT_ID              = $_POST['productid'];
				$PRODUCT_QUANTITY        = $_POST['quantity'];
				$USERNAME                = $_SESSION['username'];
				$v_insert_to_cart        = "INSERT into`tblcart` (ProductID, Username, Quantity) VALUES ('" . $PRODUCT_ID . "','" . $USERNAME . "','" . $PRODUCT_QUANTITY . "')";
				$result_v_insert_to_cart = mysqli_query($con, $v_insert_to_cart);
				header('location: cart.php');
		}
} //isset($_POST['addtocart'])
///////////////////////Add a review///////////////////////
if (isset($_POST['addreview'])) {
	if (!isset($_POST['productid']) || !isset($_POST['review'])) {
		$MESSAGE_REVIEW = "Unable to Place Review!";
	} else {
		$PRODUCT_ID = $_POST['productid'];
		$USERNAME = $_SESSION['username'];
		$PRODUCT_REVIEW = $_POST['review'];

		$insert_review = "INSERT INTO `tblproductreviews`(`ProductID`, `Username`, `Review`) VALUES (?, ?, ?)";
		$stmt = mysqli_prepare($con, $insert_review);
		mysqli_stmt_bind_param($stmt, 'iss', $PRODUCT_ID, $USERNAME, $PRODUCT_REVIEW);

		if (mysqli_stmt_execute($stmt)) {
			$MESSAGE_REVIEW = "Thank you for your review!";
			header('location: #.php');
		} else {
			$MESSAGE_REVIEW = "Unable to Place Review!";
			header('location: #.php');
		}

		mysqli_stmt_close($stmt);
	}
}
?>


<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Products page related .php/////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
require('db.php');
/////////////////////////////Strings to Store Variables/////////////////////////////
$CATEGORY               = '';
$CATEGORY_ID            = '';
$MESSAGE                = '';
$SORT_TYPE              = 'ASC';
$SORT_COLUMN            = 'ProductPrice';
$_SESSION['bikeselected']='';
$BIKE_TYPE              = $_SESSION['bikeselected'];
/////////////////////////////Select Categories/////////////////////////////
$select_category        = "SELECT * FROM `tblcategory`";
$result_select_category = mysqli_query($con, $select_category);
/////////////////////////////Query Product Bike Type to Display/////////////////////////////
$select_productbiketype = "SELECT DISTINCT ProductBikeType FROM `tblproducts`";
$result_productbiketype = mysqli_query($con, $select_productbiketype);
/////////////////////////////Select or Change Product Bike Type /////////////////////////////
if (isset($_POST['productbiketype'])) {
		$SELECT_BIKE              = $_POST['selectproductbiketype'];
		$EXPLODED_VALUE2          = explode(",", $SELECT_BIKE);
		$_SESSION['bikeselected'] = $EXPLODED_VALUE2[0];
		$BIKE_TYPE                = $_SESSION['bikeselected'];
} //isset($_POST['productbiketype'])
if (isset($_POST['productbiketypechange'])) {
		$_SESSION['bikeselected'] = '';
		$BIKE_TYPE                = $_SESSION['bikeselected'];
} //isset($_POST['productbiketypechange'])
/////////////////////////////Identify type of sorting selected/////////////////////////////
if (isset($_POST['sort'])) {
		$SORT           = $_POST['sort'];
		$EXPLODED_VALUE = explode(",", $SORT);
		$SORT_TYPE      = $EXPLODED_VALUE[0];
		$SORT_COLUMN    = $EXPLODED_VALUE[1];
} //isset($_POST['sort'])
/////////////////////////////Filter products based on category/////////////////////////////
if (isset($_POST['categoryvalues'])) {
		$CATEGORY_VALUES   = $_POST['categoryvalues'];
		$CATEGORY_SELECTED = implode(",", $CATEGORY_VALUES);
		$BIKE_TYPE                = $_SESSION['bikeselected'];
		if ($BIKE_TYPE == "") {
				$select_specific_products = "SELECT tblproducts.ProductID, tblproducts.ProductName, tblproducts.ProductPrice, tblproducts.ProductImage, tblproducts.ProductBikeType, tblproducts.ProductDiscountAmount, tblcategory.CategoryName FROM `tblproducts` INNER JOIN tblcategory ON tblproducts.CategoryID=tblcategory.CategoryID WHERE tblcategory.CategoryName = '" . $CATEGORY_SELECTED . "' ORDER BY " . $SORT_COLUMN . " " . $SORT_TYPE . "";
				$result_products          = mysqli_query($con, $select_specific_products);
				$CATEGORY                 = $CATEGORY_SELECTED;
		} //$BIKE_TYPE == ''
		else {
				$select_specific_products2 = "SELECT tblproducts.ProductID, tblproducts.ProductName, tblproducts.ProductPrice, tblproducts.ProductImage, tblproducts.ProductBikeType, tblproducts.ProductDiscountAmount, tblcategory.CategoryName FROM `tblproducts` INNER JOIN tblcategory ON tblproducts.CategoryID=tblcategory.CategoryID WHERE tblproducts.ProductBikeType = '" . $BIKE_TYPE . "' AND tblcategory.CategoryName = '" . $CATEGORY_SELECTED . "' ORDER BY " . $SORT_COLUMN . " " . $SORT_TYPE . "";
				$result_products           = mysqli_query($con, $select_specific_products2);
				$CATEGORY                  = $CATEGORY_SELECTED;
		}
} //isset($_POST['categoryvalues'])
/////////////////////////////Select All products/////////////////////////////
else {
		if ($BIKE_TYPE == '') {
				$select_all_product1 = "SELECT * FROM `tblproducts`";
				$result_products     = mysqli_query($con, $select_all_product1);
				$MESSAGE             = "All Available Products!";
		} //$BIKE_TYPE == ''
		else {
				$select_all_product2 = "SELECT * FROM `tblproducts` WHERE ProductBikeType = '" . $BIKE_TYPE . "'";
				$result_products     = mysqli_query($con, $select_all_product2);
				$MESSAGE             = "All Available Products of the Selected Bike!";
		}
}
/////////////////////////////Search Products////////////////////////////
if (isset($_POST['search'])) {
	$BIKE_TYPE = $_SESSION['bikeselected'];
	$SEARCHED_VALUE = $_POST['searchproduct'];

	$search_query = "SELECT * FROM `tblproducts` WHERE CONCAT(`ProductName`) LIKE '%" . $SEARCHED_VALUE . "%'";
	if ($BIKE_TYPE !== '') {
		$search_query .= " AND ProductBikeType = '" . $BIKE_TYPE . "'";
	}

	$result_products = mysqli_query($con, $search_query);
	$ROWS = mysqli_num_rows($result_products);

	if ($ROWS > 0) {
		$MESSAGE = "We have found ('" . $ROWS . "') that matches:'" . $SEARCHED_VALUE . "' ";
		$CATEGORY_SELECTED = '5';
	} else {
		$MESSAGE = "No matching products found.";
		$CATEGORY_SELECTED = ''; // Reset the category selection if no results found
	}
}
?>

<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Cart page related .php/////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
require('db.php');
/////////////////////////////Update products in cart/////////////////////////////
if (isset($_POST['updateitem'])) {
		foreach ($_POST['selectedvalues'] as $idx => $selectionid) {
				$update_cart        = "UPDATE tblcart SET Quantity='" . $_POST['quantity'][$idx] . "' WHERE SelectionID='" . $selectionid . "'";
				$result_update_cart = mysqli_query($con, $update_cart);
		} //$_POST['selectedvalues'] as $idx => $selectionid
		header("Location: cart.php");
} //isset($_POST['updateitem'])
/////////////////////////////checkout products from cart/////////////////////////////
if (isset($_POST['checkout'])) {
		$generate_delivery_id        = mysqli_query($con, "SELECT delivery_id FROM (SELECT FLOOR(RAND() * 99999) AS delivery_id  UNION SELECT FLOOR(RAND() * 99999) AS random_num) AS numbers_mst_plus_1 WHERE `delivery_id` NOT IN (SELECT DeliveryID FROM tblorder) LIMIT 1");
		$result_generate_delivery_id = mysqli_fetch_assoc($generate_delivery_id);
		$DELIVERY_ID                 = $result_generate_delivery_id['delivery_id'];
		$USER                        = $_SESSION['username'];
		$insert_order                = "INSERT INTO tblorder (`ProductID`, `Quantity`, `Username`, `DeliveryID`) SELECT `ProductID`, `Quantity`, `Username`, '" . $DELIVERY_ID . "' FROM tblcart WHERE `Username` = '" . $USER . "' ";
		$_SESSION['deliveryid']      = $DELIVERY_ID;
		$result_insert_order         = mysqli_query($con, $insert_order);
		header("Location: checkout.php");
} //isset($_POST['checkout'])
/////////////////////////////Removal of products from cart/////////////////////////////
if (isset($_POST["removeitem"])) {
		$IMPLODE_VALUES           = $_POST['checkedvalues'];
		$CHECKED_VALUES_REMOVE    = implode(",", $IMPLODE_VALUES);
		$remove_cart_items        = "DELETE FROM `tblcart` WHERE SelectionID in ($CHECKED_VALUES_REMOVE)";
		$result_remove_cart_items = mysqli_query($con, $remove_cart_items);
		header("Location: cart.php");
} //isset($_POST["removeitem"])

if (isset($_POST["continueshopping"])) {
		header("Location: pnb.php");
} //isset($_POST["continueshopping"])

?>


<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Checkout page related .php/////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
require('db.php');
if (isset($_POST['placeorder'])) {
		if (!isset($_SESSION['username'])) {
				$DELIVERY_ID         = $_SESSION['deliveryid'];
				$RECIPIENT_NAME      = $_POST['recipientname'];
				$RECIPIENT_PHONE     = $_POST['recipientphone'];
				$DELIVERY_ADDRESS    = $_POST['deliveryaddress'];
				$DELIVERY_CITY       = $_POST['deliverycity'];
				$LOCATION_TYPE       = $_POST['locationtype'];
				$SHIPPING_CHARGE     = $_POST['shippingtype'];
				$TOTAL_PRICE         = $_SESSION['totalprice'];
				$USERNAME            = 'Guest';
				$place_order1        = "INSERT into `tbldelivery` (`DeliveryID`,`RecipientName`,`RecipientPhone`,`DeliveryAddress`,`DeliveryCity`,`LocationType`,`ShippingCharge`,`Username`,`TotalPrice`) VALUES ('" . $DELIVERY_ID . "','" . $RECIPIENT_NAME . "','" . $RECIPIENT_PHONE . "','" . $DELIVERY_ADDRESS . "','" . $DELIVERY_CITY . "','" . $LOCATION_TYPE . "','" . $SHIPPING_CHARGE . "','" . $USERNAME . "','" . $TOTAL_PRICE . "')";
				$result_place_order1 = mysqli_query($con, $place_order1);
		} //!isset($_SESSION['username'])
		else {
				$DELIVERY_ID         = $_SESSION['deliveryid'];
				$RECIPIENT_NAME      = $_POST['recipientname'];
				$RECIPIENT_PHONE     = $_POST['recipientphone'];
				$DELIVERY_ADDRESS    = $_POST['deliveryaddress'];
				$DELIVERY_CITY       = $_POST['deliverycity'];
				$LOCATION_TYPE       = $_POST['locationtype'];
				$SHIPPING_CHARGE     = $_POST['shippingtype'];
				$TOTAL_PRICE         = $_SESSION['totalprice'];
				$USERNAME            = $_SESSION['username'];
				$place_order2        = "INSERT into `tbldelivery` (`DeliveryID`,`RecipientName`,`RecipientPhone`,`DeliveryAddress`,`DeliveryCity`,`LocationType`,`ShippingCharge`,`Username`,`TotalPrice`) VALUES ('" . $DELIVERY_ID . "','" . $RECIPIENT_NAME . "','" . $RECIPIENT_PHONE . "','" . $DELIVERY_ADDRESS . "','" . $DELIVERY_CITY . "','" . $LOCATION_TYPE . "','" . $SHIPPING_CHARGE . "','" . $USERNAME . "','" . $TOTAL_PRICE . "')";
				$result_place_order2 = mysqli_query($con, $place_order2);
		}
		if ($result_place_order2 || $result_place_order1) {
				$remove_cart        = "DELETE FROM `tblcart` WHERE Username = '" . $USERNAME . "'";
				$result_remove_cart = mysqli_query($con, $remove_cart);
				if ($result_place_order2 || $result_place_order1 || $remove_cart) {
						$ORDER_STATUS                 = "Pending";
						$ORDER_REMARK                 = "Orders Has Been Received And Is Currently Being Processed";
						$insert_to_track_order        = "INSERT INTO tblordertrack (`OrderID`,`DeliveryID`,`Status`,`Remark`) SELECT `OrderID`,'" . $DELIVERY_ID . "','" . $ORDER_STATUS . "','" . $ORDER_REMARK . "'  FROM tblorder WHERE `DeliveryID` = '" . $DELIVERY_ID . "' ";
						$result_insert_to_track_order = mysqli_query($con, $insert_to_track_order);
						header("Location: ordersuccessful.php");
				} //$result_place_order2 || $result_place_order1 || $remove_cart
				else {
						header("Location: cart.php");
				}
		} //$result_place_order2 || $result_place_order1
		else {
				die("Couldnt Place Order! Contact Us!");
		}
} //isset($_POST['placeorder'])
?>

<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////My Profile page related .php////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
require('db.php');
/////////////////////////////Variables to store data/////////////////////////////
$MESSAGE_MYPROFILE = '';
/////////////////////////////Update Username/////////////////////////////

if (isset($_POST["updatename"])) {
		$USERNAME           = $_SESSION['username'];
		$FIRST_TNAME       = $_POST['firstname'];
		$FIRST_TNAME       = mysqli_real_escape_string($con, $FIRST_TNAME);
		$LAST_NAME       = $_POST['lastname'];
		$LAST_NAME       = mysqli_real_escape_string($con, $LAST_NAME);
		$PASSWORD       = $_POST['password'];
		$PASSWORD       = mysqli_real_escape_string($con, $PASSWORD);
		
		
		$select_user = mysqli_query($con, "SELECT * FROM tblusers WHERE Username='".$USERNAME."' LIMIT 1");
		$result_select_user = mysqli_fetch_assoc($select_user);
		$PASS              = $result_select_user['Password'] ;
		
		// if user exists
		if ($result_select_user) {
				 if ($PASS != md5($PASSWORD)) {
						$MESSAGE_MYPROFILE = "Wrong Password!";
				} 
	
				else {
				$update_username = "UPDATE `tblusers` SET `FirstName`='".$FIRST_TNAME."',`LastName`='".$LAST_NAME."' WHERE `Username`='".$USERNAME."'";
				$result_update_username = mysqli_query($con, $update_username);
				if ($result_update_username) {
						$MESSAGE_MYPROFILE = "Successfully Updated";
				} 
				else {	
						$MESSAGE_MYPROFILE = " Please contact Us!";
				}

}		}
} 
/////////////////////////////Update password/////////////////////////////
if (isset($_POST["updatepassword"])) {
		$USERNAME           = $_SESSION['username'];
		$NEW_PASSWORD       = $_POST['newpassword'];
		$NEW_PASSWORD       = mysqli_real_escape_string($con, $NEW_PASSWORD);
		$PASSWORD       = $_POST['password'];
		$PASSWORD       = mysqli_real_escape_string($con, $PASSWORD);
		
		
		$select_user = mysqli_query($con, "SELECT * FROM tblusers WHERE Username='".$USERNAME."' LIMIT 1");
		$result_select_user = mysqli_fetch_assoc($select_user);
		$PASS              = $result_select_user['Password'] ;
		
		// if user exists
		if ($result_select_user) {
				 if ($PASS != md5($PASSWORD)) {
						$MESSAGE_MYPROFILE = "Wrong Password!";
				} 
				else if (!isset($NEW_PASSWORD) || !isset($PASSWORD) ) {
					
					$MESSAGE_MYPROFILE = "Fill Mandatory Fields!";
					}
					
					else     if (strlen($NEW_PASSWORD) <= '8') {
        $MESSAGE_MYPROFILE= "Password Must Contain At Least 8 Characters!";
    							}
	
				else {
				$update_password= "UPDATE `tblusers` SET `Password`='".md5($NEW_PASSWORD)."' WHERE `Username`='".$USERNAME."'";
				$result_update_password = mysqli_query($con, $update_password);
				if ($result_update_password) {
						$MESSAGE_MYPROFILE = "Successfully Updated";
				} 
				else {	
						$MESSAGE_MYPROFILE = " Please contact Us!";
				}

}		}
} 

/////////////////////////////Update Username/////////////////////////////

if (isset($_POST["updateemailaddress"])) {
		$USERNAME        = $_SESSION['username'];
		$E_MAIL       = $_POST['email'];
		$E_MAIL       = mysqli_real_escape_string($con, $E_MAIL);
		$PASSWORD       = $_POST['password'];
		$PASSWORD       = mysqli_real_escape_string($con, $PASSWORD);
		
		
		$select_user = mysqli_query($con, "SELECT * FROM tblusers WHERE Username='".$USERNAME."' LIMIT 1");
		$result_select_user = mysqli_fetch_assoc($select_user);
		$PASS              = $result_select_user['Password'] ;
		
		// if user exists
		if ($result_select_user) {
				 if ($PASS != md5($PASSWORD)) {
						$MESSAGE_MYPROFILE = "Wrong Password!";
				} 
				else if (!filter_var($E_MAIL, FILTER_VALIDATE_EMAIL)) {
 					 $MESSAGE_MYPROFILE = "Invalid Email";
						}
				else {
				$update_email = "UPDATE `tblusers` SET `EmailAddress` = '".$E_MAIL."' WHERE `Username`='".$USERNAME."'";
				$result_update_email = mysqli_query($con, $update_email);
				if ($result_update_email) {
						$MESSAGE_MYPROFILE = "Successfully Updated";
				} 
				else {	
						$MESSAGE_MYPROFILE = " Please contact Us!";
				}

}		}
} 
?>

<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////Forgot password page related .php///////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////
$MESSAGE_RECOVER = '';
$DISPLAY_CONTENT = '';
if (isset($_POST["recoveraccount"])) {

		$USERNAME       = $_POST['username'];
		$E_MAIL       = $_POST['email'];
		$SECURITY_QUESTION       = $_POST['securityquestion'];
		$SECURITY_ANSWER       = $_POST['securityanswer'];
		
		$select_user = mysqli_query($con, "SELECT * FROM tblusers WHERE Username='".$USERNAME."' OR EmailAddress='".$E_MAIL."' LIMIT 1");
		$result_select_user = mysqli_fetch_assoc($select_user);
		$QUESTION              = $result_select_user['SecurityQuestion'] ;
		$ANSWER              = $result_select_user['SecurityAnswer'] ;
		
		if ($result_select_user) {
				
				 if ($QUESTION != $SECURITY_QUESTION || $ANSWER != $SECURITY_ANSWER)
				 	 {
						$MESSAGE_RECOVER = "Please Enter A Correct Security Question And Answer!";
					} 
				else if (!isset($SECURITY_QUESTION) || !isset($SECURITY_ANSWER) || !isset($E_MAIL)|| !isset($USERNAME)  )
					 {
					
					$MESSAGE_RECOVER = "Please Fill Mandatory Fields!";
					}
					
					else{
						$DISPLAY_CONTENT = "Display";
						$_SESSION['tempusername'] = $USERNAME;
						}
		
					} 
					else{ $MESSAGE_RECOVER = "Please Enter A Valid Username Or Email"; }
}

if (isset($_POST["resetpassword"])) {
		$USERNAME           = $_SESSION['tempusername'];
		$NEW_PASSWORD       = $_POST['newpassword'];
		$NEW_PASSWORD       = mysqli_real_escape_string($con, $NEW_PASSWORD);
		
		$select_user = mysqli_query($con, "SELECT * FROM tblusers WHERE Username='".$USERNAME."' LIMIT 1");
		$result_select_user = mysqli_fetch_assoc($select_user);
		
		// if user exists
		if ($result_select_user) {
				  if (!isset($NEW_PASSWORD)) {
					
					$MESSAGE_RECOVER = "Fill Mandatory Fields!";
					$DISPLAY_CONTENT = "Display";
					}
					
					else     if (strlen($NEW_PASSWORD) <= '8') {
        $MESSAGE_RECOVER= "Password Must Contain At Least 8 Characters!";
		$DISPLAY_CONTENT = "Display";
    							}
	
				else {
				$recover_password= "UPDATE `tblusers` SET `Password`='".md5($NEW_PASSWORD)."' WHERE `Username`='".$USERNAME."'";
				$result_recover_password = mysqli_query($con, $recover_password);
				if ($result_recover_password) {
						$MESSAGE_RECOVER = "Successfully Updated";
						$DISPLAY_CONTENT = "Display";
				} 
				else {	
						$MESSAGE_RECOVER = " Please contact Us!";
				}

}		}
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

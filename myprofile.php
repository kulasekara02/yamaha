
	<!DOCTYPE html>
	<html>
	<head>
	<title>Yamaha</title>
	<link href="Resources/css.css" rel="stylesheet" type="text/css">
	</head>
	<body>
    
	<!-----------------Wrapper----------------->
    
	<div id="wrapper"> 
    
	<!-----------------Header & Navigation Bar----------------->
    
<?php
	include('header.php');
	if(!isset($_SESSION["username"])){
	header("Location: login.php");
	unset($_SESSION['crumbs']);
	}
	else
{
    $USER = $_SESSION["username"];
    $select_track_orders = "SELECT tblordertrack.TrackID, tblordertrack.`Status`, tblorder.OrderDate, tbldelivery.RecipientName FROM tblordertrack join tblorder ON tblordertrack.`OrderID` = tblorder.`OrderID` join tbldelivery ON tblorder.`DeliveryID` = tbldelivery.`DeliveryID` WHERE tblorder.Username = '" . $USER . "'";
    $result_track_orders = mysqli_query($con, $select_track_orders);
}
	
?>
     <!----------------- main frame----------------->
	<div id="mainframe">
 	<div class="sub_framefullpage" style="width:100%">
    <h3>My Profile - <?php echo $_SESSION["username"] ?></h3>
	<p>
    <div class="row"> 
	<div class="col_3">
	<h3> Account Settings</h3>
    <!----------------- Update username----------------->
  <?php if(empty($MESSAGE_MYPROFILE)){ } else {?>
  <label class = "labelhome"> <?php echo $MESSAGE_MYPROFILE ?></label>
  
 <?php }?> 
    
<button type="button" class="collapsible">Update Name</button>
<div class="content">
  <form method="post">
  <p>
  <label>First Name</label>
  <br>
  <input name="firstname" type="text">
  </p>
    <p>
  <label>Last Name</label>
  <br>
  <input name="lastname" type="text">
  </p>
    <p>
    <label>Your Password</label>
    <br>
  <input name="password" type="password">
  </p>
    <p>
<input name="updatename" type="submit" value="Update">
  </p>
  </form>
</div>

<!----------------- Update password----------------->
<button type="button" class="collapsible">Update Password</button>
<div class="content">
<form method="post">
  <p>
  <label>New Password</label>
  <br>
  <input name="newpassword" type="password">
  </p>
  <p>
    <label>Currrent Password</label>
    <br>
  <input name="password" type="password">
  </p>
    <p>
<input name="updatepassword" type="submit" value="Update">
  </p>
  </form>
</div>
<!----------------- Update email address----------------->
<button type="button" class="collapsible">Update Email Address</button>
<div class="content">
<form method="post">
    <p>
  <label>New Email Address</label>
  <br>
  <input name="email" type="text">
  </p>
  <p>
    <label>Your Password</label>
    <br>
  <input name="password" type="password">
  </p>
    <p>
<input name="updateemailaddress" type="submit" value="Update">
  </p>
   </form>
</div>
<!----------------- Update email address----------------->
	
	<form method="POST">
    <input name="logout" class="cart_btn" type="submit" value="Log Out">
	</form>
    
    </div>
    
    
    
       	<div class="col_3">
      	<h3>Track Orders</h3>
            <table width="200" border="1">
  <tr>	
    <th scope="col">Tracking ID</th>
    <th scope="col">Recipient Name</th>
    <th scope="col">Order Date</th>
    <th scope="col">Status</th>
  </tr>
       <?php
//Count number of rows
	$no_of_track_orders=mysqli_num_rows($result_track_orders);
	if($no_of_track_orders>0)
	{
	///////////Fetch products from variavle and display
	while($tracking_data = mysqli_fetch_array($result_track_orders))
	{
?> 
      
      

   <tr>
   <td width="16%"><?php echo  $tracking_data['TrackID']; ?></td>
   <td width="50%"><?php echo  $tracking_data['RecipientName']; ?></td>
   <td width="16%"><?php echo  date("Y-m-d",strtotime($tracking_data['OrderDate'])); ?></td>
   <td width="13%"><?php echo  $tracking_data['Status']; ?></td>
   </tr>


	<?php } } else {?>
     <td>Oops! No Orders Have Been Placed!</td>
	<?php } ?>
    </table>
    </p>
</div> 

    
        </div>
	</div>
    <div class="clear"></div>
	<!-----------------Footer----------------->
	<?php include('Resources/footer.php');?>
	</div>
	</div>	
</body>
	</html>
<?php
//Database Connection
require 'db.php';
//Get ID from Database

//Update Information
if(isset($_POST['btn-update'])){
	$ProductName = $_POST['ProductName'];
	$ProductPrice = $_POST['ProductPrice'];
	$ProductDesignType = $_POST['ProductDesignType'];
	$ProductBrand = $_POST['ProductBrand'];
	$Colour = $_POST['Colour'];
	$Dimensions = $_POST['Dimensions'];
	$update_tracking        = "UPDATE tblordertrack SET Status='" . $_POST['newstatus'][$idx] . "' WHERE TrackID='" . $trackingid . "'";
	$result_update_tracking = mysqli_query($con, $update_tracking);
	if(!isset($sql)){
		die ("Error $sql" .mysqli_connect_error());
	}
	else
	{
		header("location: admin.php");
	}
}
?>
<!--Create Edit form -->
<!doctype html>
<html>
<body>
<form method="post">
<h1>Edit Employee Information</h1>
<label>Name:</label><input type="text" name="ProductName" placeholder="Name" value="<?php echo $row['ProductName']; ?>"><br/><br/>
<label>Price:</label><input type="text" name="ProductPrice" placeholder="Price" value="<?php echo $row['ProductPrice']; ?>"><br/><br/>
<label>Design Type:</label><input type="text" name="ProductDesignType" placeholder="Design Type" value="<?php echo $row['ProductDesignType']; ?>"><br/><br/>
<label>Brand:</label><input type="text" name="ProductBrand" placeholder="Brand" value="<?php echo $row['ProductBrand']; ?>"><br/><br/>
<label>Colours:</label><input type="text" name="Colour" placeholder="Colours" value="<?php echo $row['Colour']; ?>"><br/><br/>
<label>Dimensions:</label><input type="text" name="Dimensions" placeholder="Dimensions" value="<?php echo $row['Dimensions']; ?>"><br/><br/>
<button type="submit" name="btn-update" id="btn-update" onClick="update()"><strong>Update</strong></button>
<a href="disp.php"><button type="button" value="button">Cancel</button></a>
</form>
<!-- Alert for Updating -->
<script>
function update(){
	var x;
	if(confirm("Updated tblproducts Sucessfully") == true){
		x= "update";
	}
}
</script>
</body>
</html>
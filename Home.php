	<!DOCTYPE html>
	<html>
	<head>
	<title>Yamaha</title>
    <!-----------------CSS sheet----------------->
    
	<link href="Resources/css.css" rel="stylesheet" type="text/css">
    
	</head>
	<body>
    
	<!-----------------Wrapper----------------->
    
	<div id="wrapper"> 
    
	<!-----------------Header & Navigation Bar----------------->
    
	<?php include('header.php');
	///////////////////////Display reviews///////////////////////
	    $select_recently_reviewed_products = "SELECT DISTINCT (tblproductreviews.ProductID), tblProducts.ProductName, tblProducts.ProductImage, tblProducts.ProductPrice, tblProducts.ProductDiscountAmount FROM tblproductreviews INNER JOIN tblProducts ON tblproductreviews.ProductID=tblProducts.ProductID ORDER BY tblproductreviews.ReviewDate DESC LIMIT 5";
    $result_recently_reviewed_products = mysqli_query($con, $select_recently_reviewed_products);
			$select_latest_products = "SELECT * FROM `tblproducts` ORDER BY CreatedDate ASC LIMIT 5";
        $result_latest_products = mysqli_query($con, $select_latest_products);

	
	
	?>
    
	<!-----------------Main Frame----------------->
    
	<div id="mainframe">
     <div class="sub_framefullpage">
	<!-----------------Products Frame----------------->
	<h3>Welcome</h3>
    <p><div class="row"> 
  <div class="col_3">
  <img src="Resources/designimages/BF.png" style="width:100%">
  <img src="Resources/designimages/Electrical.png" style="width:100%">
  </div>
  <div class="col_3">
  <img src="Resources/designimages/Fuel And Air.png" style="width:100%">
  <img src="Resources/designimages/Browse.jpg" style="width:100%">
  </div></p>
	</div>
    </div>
    
    <!-----------------Latest Products----------------->
    	<div class="sub_framefullpage">
        <h3>Latest Products</h3>
    	<div class="productframe">
 <?php
//Count number of rows
	$no_of_rows=mysqli_num_rows($result_latest_products);
	if($no_of_rows>0)
	{
	///////////Fetch products from variavle and display
	while($data = mysqli_fetch_array($result_latest_products))
	{
?>
         <!-----------------Products----------------->
         <div class="product" style="width:18%">
         <?php if ($data['ProductDiscountAmount']!="0"){ ?> 
         <span class="product-discount-label">-<?php echo  $data['ProductDiscountAmount'];?> %</span>
         <?php } else  {?>  <span class="product-discount-label" style="background-color:#FFF; color:#FFF">-<?php echo  $data['ProductDiscountAmount'];?> %</span>
         <?php } ?>
         
         <img src="<?php echo $data['ProductImage']; ?>" >
         <br>
         <br>
         <div class="product_name">
         <?php echo  $data['ProductName']; ?>
         </div>
         <div class="product_price">
         LKR:<?php echo $data['ProductPrice']; ?>
         </div>
         <a href="viewproduct.php?pid=<?php echo $data['ProductID']; ?>"><input name="" type="button" value="See Details"></a>
         </form> 
         </div>
         <?php } } else {?>
         <h3>Oops! No Products Found!</h3>
         <?php } ?>	
	</div>
    </div>
    
    
    
        <!-----------------Recently Reviewed Products----------------->
        <div class="sub_framefullpage">
    	<h3>Recently Reviewed Products</h3>
    	<div class="productframe">
 <?php
//Count number of rows
	$no_of_rows=mysqli_num_rows($result_recently_reviewed_products);
	if($no_of_rows>0)
	{
	///////////Fetch products from variavle and display
	while($data = mysqli_fetch_array($result_recently_reviewed_products))
	{
?>
         <div class="product" style="width:18%">
         <?php if ($data['ProductDiscountAmount']!="0"){ ?> 
         <span class="product-discount-label">-<?php echo  $data['ProductDiscountAmount'];?> %</span>
         <?php } else  {?>  <span class="product-discount-label" style="background-color:#FFF; color:#FFF">-<?php echo  $data['ProductDiscountAmount'];?> %</span>
         <?php } ?>
         
         <img src="<?php echo $data['ProductImage']; ?>" >
         <br>
         <br>
         <div class="product_name">
         <?php echo  $data['ProductName']; ?>
         </div>
         <div class="product_price">
         LKR:<?php echo $data['ProductPrice']; ?>
         </div>
         <a href="viewproduct.php?pid=<?php echo $data['ProductID']; ?>"><input name="" type="button" value="See Details"></a>
         </form> 
         </div>
         <?php } } else {?>
         <h3>Oops! No Products Found!</h3>
         <?php } ?>	
	</div>
</div>
    
	<div class="clear"></div>
    
	<!-----------------Footer----------------->
	<?php include('Resources/footer.php');?>
    
	</div>
	</div>
	</body>
	</html>
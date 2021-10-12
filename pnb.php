

<!DOCTYPE html>
<html>
   <head>
      <title>Explorer Style</title>
      <link href="Resources/css.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <!-----------------Wrapper----------------->
      <div id="wrapper">
         <!-----------------Header & Navigation Bar----------------->
         <?php include('header.php');?>
         <!-----------------Side Bar----------------->
         <div class="sidebar">
            <div class="col_1">
               <!-----------------Search Products----------------->
               <h2>Search Products</h2>
               <div class="box">
                  <ul>
                     <form method="post">
                        <li><input type="text" name="searchproduct" required></li>
                        <li><input id="5" type="submit" name="search" value="Search"></li>
                     </form>
                  </ul>
               </div>
               <!-----------------Display Category And Filter By Category----------------->
               <h2>Categories</h2>
               <div class="box">
                  <ul>
                     <form action="" method="post">
                        <?php
                           //Count number of rows
                           	$no_of_categories=mysqli_num_rows($result_select_category);
                           	if($no_of_categories > 0)
                           	{
                           	///////////Fetch products from variavle and display
                           	while($category = mysqli_fetch_array($result_select_category))
                           	{
                           ?>    
                        <li><input id="<?php echo $category['CategoryName']; ?>" type="submit" name="categoryvalues[]" value="<?php echo $category['CategoryName']; ?>" class="category_btn"></li>
                        <?php } } else {?>
                        <h3>Oops! Category Unavailable!</h3>
                        <?php } ?>    
               </div>
               </ul>	
            </div>
         </div>
         <!-----------------Main Frame----------------->
         <div id="mainframe">
         <div class="sub_frame">
         <label class = "labelhome">Your Bike Type</label>
         <?php
            if(!isset($_SESSION['bikeselected']))
            {
            	 $_SESSION['bikeselected']='';
            }
            else
            	{
            	 echo $_SESSION['bikeselected'];
            	}
             ?>
         <?php if($_SESSION['bikeselected'] ==''){ ?>
         <select name="selectproductbiketype" id="mySelect" style="width:75%">
         <?php
            //Count number of rows
            	$no_of_bikes=mysqli_num_rows($result_productbiketype);
            	if($no_of_bikes>0)
            	{
            	///////////Fetch products from variavle and display
            	while($bike_data = mysqli_fetch_array($result_productbiketype))
            	{
            ?> 
         <option value="<?php echo $bike_data['ProductBikeType']; ?>"><?php echo $bike_data['ProductBikeType']; ?></option>
         <?php } } else {?>
         <h3>Oops! No Bikes!</h3>
         <?php } ?>
         </select>
         <input name="productbiketype" type="submit" value="Select" >
         <?php  } else {?>
         <input name="productbiketypechange" type="submit" value="X">
         <?php } ?>
         <!-----------------Sorting Products Options----------------->
         <h3><?php echo $CATEGORY; ?> <?php echo $MESSAGE; ?></h3>
         <?php 
            //if category variable is empty dont display sort option
            if($CATEGORY != '')
            {
            ?>
         <!-----------------Filter Products by bike----------------->
         Sort By: <select name="sort" onChange="AutoClickCategory()">
         <option value="ASC,ProductName">----</option>
         <option value="ASC,ProductName">Product Name: A-Z</option>
         <option value="DESC,ProductName">Product Name: Z-A</option>
         <option value="ASC,ProductPrice">Price: Low to High</option>
         <option value="DESC,ProductPrice">Price: High to Low</option>
         </select>
         <?php }?>
         <br>
         <br>
         <!-----------------Display Products And View Products----------------->
         <div class="productframe">
         <?php
            //Count number of rows
            	$no_of_rows=mysqli_num_rows($result_products);
            	if($no_of_rows>0)
            	{
            	///////////Fetch products from variavle and display
            	while($data = mysqli_fetch_array($result_products))
            	{
            ?>
         <!-----------------Products----------------->
         <div class="product">
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
         <!-----------------Products----------------->
         <!-----------------Footer----------------->
         <div class="footer">
         <div class="col_2">
         <h2>About Yamaha</h2>
         <ul>
         <li><a href="aboutus.php">About us</a></li>
         <li><a href="aboutus.php">Privacy Policy</a></li>
         <li><a href="aboutus.php">Terms of use</a></li>
         </ul>
         </div>
         <div class="col_2">
         <h2>Information</h2>
         <ul>
         <li><a href="aboutus.php">Help & FAQs</a></li>
         <li><a href="aboutus.php">Shipping and delivery</a></li>
         </ul>
         </div>
         <div class="col_2">
         <h2>Contact Us</h2>   
         <ul>
         <li>Hotline:</li>
         <li>Email:</li>
         <li>Services</li>
         </ul>
         </div>
         </div> 
         </div>
      </div>
      <script>
         function AutoClickCategory(){
         document.getElementById('<?php echo $CATEGORY; ?>').click();
         }
      </script>
   </body>
</html>


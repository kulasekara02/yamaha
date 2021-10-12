

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
         <?php 
            include('header.php');
            if(!isset($_GET["pid"])){header("location: pnb.php");}else{
            ///////////////////////Display product///////////////////////
            	$PRODUCTID=$_GET["pid"];
            $query7 = "SELECT * FROM `tblproducts` WHERE `ProductID` LIKE '%".$PRODUCTID."%' LIMIT 1";
               $single_product = mysqli_query($con, $query7);
            
            ///////////////////////Display reviews///////////////////////
            
            $select_reviews = "SELECT * FROM `tblproductreviews` WHERE `ProductID` LIKE '%".$PRODUCTID."%' ORDER BY ReviewDate ASC";
            $result_reviews = mysqli_query($con, $select_reviews);
            
            ///////////////////////Display related products///////////////////////
            
            $select_category_of_product = mysqli_query($con, "SELECT CategoryID as categoryid FROM `tblproducts`  WHERE `ProductID`='".$PRODUCTID."' LIMIT 1");
            $result_select_category_of_product = mysqli_fetch_assoc($select_category_of_product);
            $CATEGORY_ID = $result_select_category_of_product["categoryid"];
            
            $select_random_products = "SELECT * FROM tblproducts WHERE CategoryID LIKE '%".$CATEGORY_ID."%'  ORDER BY RAND() LIMIT 4;";
            $result_select_random_products = mysqli_query($con, $select_random_products);
            
            
            }
            ?>
         <!-----------------Side Bar----------------->
         <div class="sidebar"  style=" border-style:solid; border-width:1px; border-color:
         #099;">
            <div class="col_1">
               <h2>Similar Products</h2>
               <div class="box" style="background-color:#FFF;">
                   <?php
                      //Count number of rows
                      	$no_of_select_random_products = mysqli_num_rows($result_select_random_products);
                      	if($no_of_select_random_products>0)
                      	{
                       	///////////Fetch products from variavle and display
                      	while($data = mysqli_fetch_array($result_select_random_products))
                      	{
                      ?>
                      	<p>
     <div class="row"> 
                         <div class="col_3">
                            <img src="<?php echo $data['ProductImage']; ?>" width="80" height="80">
                         </div>
                         <div class="col_3" style="color:#000;">
                            <?php echo  $data['ProductName']; ?>
                            <br>
                            LKR:<?php echo $data['ProductPrice']; ?>
                         </div>
                         </div>
                   </p>
                         <a href="viewproduct.php?pid=<?php echo $data['ProductID']; ?>"><input type="button" value="See  Details"></a>
                      </form> 
                   <?php } } else {?>
                   <h3>Oops! No Products Found!</h3>
                   <?php } ?>	
                </div>
               </div>
        </div>
            <!-----------------Main Frame----------------->
          <div id="mainframe">
              <div class="sub_frame">
                 <form method="post">
                    <?php
                      //Count number of rows
                       	$no_of_rows=mysqli_num_rows($single_product);
                       	if($no_of_rows>0)
                      	{
                         	///////////Fetch products from variavle and display
                        	while($data = mysqli_fetch_array($single_product))
                       	{
                        ?>
                   <!-----------------Products----------------->
                   <div class="col_3">
                      <?php echo "<input type='hidden' name='productid' value=".$data['ProductID']." />" ?>
                     <img    src="<?php echo $data['ProductImage']; ?>" width="270" height="270" >
                   </div>  
                   <div c lass="col_3">
                      <d iv  class="product_description">
                          <s pan><?php echo $data['ProductBrand']; ?></span>
                          <h3 ><?php echo $data['ProductName']; ?></h3>
                        <hr> 
                        <p>De sign type: <?php echo $data['ProductDesignType']; ?></p>
                        <p>Bik e Type: <?php echo $data['ProductBikeType']; ?></p>
                        <p>Avai lability: <?php echo $data['ProductAvailability'];?></p>
                         <p>Discount: <?php echo $data['ProductDiscountAmount'];?>%</p>
                       </div> 
                          <div cl ass="product_note">Note: This item is a universal custom fit component, and is not a direct fitment for your machine. These parts may require modification and we recommend installation by a certified mechanic. Please have machine specifications ready when you call.</div>
                      <p>Quantity: <input type="number" value="1" name="quantity" min="1" step="1" class="input_quantity"   required></p>
                      <div class="product_price">
                         <span>LKR:<?php echo $data['ProductPrice']; ?></span>
                         <a href="cart.php"><input name="addtocart" type="submit" value="Add to cart" class="cart_btn"></a>
                       </div>
                      <span><s><?php echo $data['InitialProductPrice'];?></s></span>
                      <?php } } else {?>
                      <h3>Oops! Product Unavailable!</h3>
                      <?php } ?>
                   </div>
                    <br>
                   <br>
                </form>
                <form method="post">
                   <table>
                       <tr>
                         <th><b>Product Reviews</b> </th>
                      </tr>
                      <?php echo "<input type='hidden' name='productid' value=".$PRODUCTID." />" ?>
                       <?php
                         //Count number of rows
                        	$no_of_reviews=mysqli_num_rows($result_reviews);
                        	if($no_of_reviews>0)
                        	{
                        
                        	///////////Fetch products from variavle and display
                        	while($data = mysqli_fetch_array($result_reviews))
                        	{
                        ?>
                     <tr>
                        <td><b>Reviewed On: </b><?php echo $data['ReviewDate']; ?></td>
                     </tr>
                     <tr>
                        <td><b>Reviewed By: </b><?php echo $data['Username']; ?></td>
                     </tr>
                     <tr>
                        <td><b>Review: </b><?php echo $data['Review']; ?></td>
                     </tr>
                     <tr>
                        <td>
                           <hr color="#00CCCC">
                        </td>
                     </tr>
                     <?php } } else {?>
                     <tr>
                        <td>'0' Reviews for this product</td>
                     </tr>
                     <?php } ?>
                  </table>
                  <br>
                  <?php if(isset($_SESSION['username'])){?>
                  <table>
                     <tr>
                        <th>Leave a Review</th>
                     </tr>
                     <tr>
                        <td><b>Review*</b> <textarea name="review" required></textarea></td>
                     </tr>
                  </table>
                  <table>
                     <tr>
                        <td ><?php echo $MESSAGE_REVIEW; ?></td>
                        <td colspan="6" class="tf"><input type="submit" name="addreview" class="cart_btn" value="Add Review"></td>
                     </tr>
                  </table>
                  <?php }?>
               </form>
            </div>
            <div class="clear"></div>
            <!-----------------Footer----------------->
            <?php include('Resources/footer.php'); ?>
         </div>
      </div>
   </body>
</html>


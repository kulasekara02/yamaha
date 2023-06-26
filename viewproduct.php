

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

if(!isset($_GET["pid"])){
    header("location: pnb.php");
} else {
    $PRODUCTID = $_GET["pid"];

    ///////////////////////Display product///////////////////////

    $query7 = "SELECT * FROM `tblproducts` WHERE `ProductID` = ? LIMIT 1";
    $stmt_product = mysqli_prepare($con, $query7);
    mysqli_stmt_bind_param($stmt_product, "s", $PRODUCTID);
    mysqli_stmt_execute($stmt_product);
    $single_product = mysqli_stmt_get_result($stmt_product);

    ///////////////////////Display reviews///////////////////////

    $select_reviews = "SELECT * FROM `tblproductreviews` WHERE `ProductID` = ? ORDER BY ReviewDate ASC";
    $stmt_reviews = mysqli_prepare($con, $select_reviews);
    mysqli_stmt_bind_param($stmt_reviews, "s", $PRODUCTID);
    mysqli_stmt_execute($stmt_reviews);
    $result_reviews = mysqli_stmt_get_result($stmt_reviews);

    ///////////////////////Display related products///////////////////////

    $select_category_of_product = "SELECT CategoryID as categoryid FROM `tblproducts` WHERE `ProductID` = ? LIMIT 1";
    $stmt_category = mysqli_prepare($con, $select_category_of_product);
    mysqli_stmt_bind_param($stmt_category, "s", $PRODUCTID);
    mysqli_stmt_execute($stmt_category);
    $result_select_category_of_product = mysqli_stmt_get_result($stmt_category);
    $CATEGORY_ID = mysqli_fetch_assoc($result_select_category_of_product)["categoryid"];

    $select_random_products = "SELECT * FROM tblproducts WHERE CategoryID = ? ORDER BY RAND() LIMIT 4";
    $stmt_related = mysqli_prepare($con, $select_random_products);
    mysqli_stmt_bind_param($stmt_related, "s", $CATEGORY_ID);
    mysqli_stmt_execute($stmt_related);
    $result_select_random_products = mysqli_stmt_get_result($stmt_related);
}
            ?>
         <!-----------------Side Bar----------------->
<div class="sidebar" style="border: 1px solid #099;">
    <div class="col_1">
        <h2>Similar Products</h2>
        <div class="box" style="background-color:#FFF;">
            <?php
                // Count number of rows
                $no_of_select_random_products = mysqli_num_rows($result_select_random_products);
                if ($no_of_select_random_products > 0) {
                    // Fetch products from variable and display
                    while ($data = mysqli_fetch_array($result_select_random_products)) {
            ?>
                <p>
                    <div class="row"> 
                        <div class="col_3">
                            <img src="<?php echo $data['ProductImage']; ?>" width="80" height="80">
                        </div>
                        <div class="col_3" style="color:#000;">
                            <?php echo $data['ProductName']; ?><br>
                            LKR:<?php echo $data['ProductPrice']; ?>
                        </div>
                    </div>
                </p>
                <a href="viewproduct.php?pid=<?php echo $data['ProductID']; ?>"><input type="button" value="See Details"></a>
            <?php } } else { ?>
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
  $no_of_rows = mysqli_num_rows($single_product);
  if ($no_of_rows > 0) {
    while ($data = mysqli_fetch_array($single_product)) { ?>
      <div class="col_3">
        <?= '<input type="hidden" name="productid" value="' . $data['ProductID'] . '" />' ?>
        <img src="<?= $data['ProductImage'] ?>" width="270" height="270" alt="<?= $data['ProductName'] ?>">
      </div>
      <div class="col_3">
        <div class="product_description">
          <span><?= $data['ProductBrand'] ?></span>
          <h3><?= $data['ProductName'] ?></h3>
          <hr>
          <p>Design type: <?= $data['ProductDesignType'] ?></p>
          <p>Bike type: <?= $data['ProductBikeType'] ?></p>
          <p>Availability: <?= $data['ProductAvailability'] ?></p>
          <p>Discount: <?= $data['ProductDiscountAmount'] ?>%</p>
        </div>
        <div class="product_note">Note: This item is a universal custom fit component, and is not a direct fitment for your machine. These parts may require modification and we recommend installation by a certified mechanic. Please have machine specifications ready when you call.</div>
        <p>Quantity: <input type="number" value="1" name="quantity" min="1" step="1" class="input_quantity" required></p>
        <div class="product_price">
          <span>LKR:<?= $data['ProductPrice'] ?></span>
          <a href="cart.php"><input name="addtocart" type="submit" value="Add to cart" class="cart_btn"></a>
        </div>
        <span><s><?= $data['InitialProductPrice'] ?></s></span>
      </div>
    <?php } } else {?>
      <h3>Oops! Product Unavailable!</h3>
  <?php } ?>
</form>
<form method="post">
    <table>
        <tr>
            <th><b>Product Reviews</b></th>
        </tr>
        <input type="hidden" name="productid" value="<?= $PRODUCTID ?>">
        <?php if ($no_of_reviews > 0): ?>
            <?php while ($data = mysqli_fetch_array($result_reviews)): ?>
                <tr>
                    <td><b>Reviewed On: </b><?= $data['ReviewDate'] ?></td>
                </tr>
                <tr>
                    <td><b>Reviewed By: </b><?= $data['Username'] ?></td>
                </tr>
                <tr>
                    <td><b>Review: </b><?= $data['Review'] ?></td>
                </tr>
                <tr>
                    <td><hr color="#00CCCC"></td>
                </tr>
            <?php endwhile ?>
        <?php else: ?>
            <tr>
                <td>'0' Reviews for this product</td>
            </tr>
        <?php endif ?>
    </table>
    <br>
    <?php if(isset($_SESSION['username'])): ?>
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
                <td><?= $MESSAGE_REVIEW ?></td>
                <td colspan="6" class="tf"><input type="submit" name="addreview" class="cart_btn" value="Add Review"></td>
            </tr>
        </table>
    <?php endif ?>
</form>
            </div>
            <div class="clear"></div>
            <!-----------------Footer----------------->
            <?php include('Resources/footer.php'); ?>
         </div>
      </div>
   </body>
</html>

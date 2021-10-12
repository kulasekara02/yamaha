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
         
<?php include ('header.php');
if (!isset($_SESSION["username"]))
{
    header("Location: login.php");
}
else
{
    $USER = $_SESSION["username"];
    $select_cart_details = "SELECT tblcart.SelectionID,tblcart.Quantity , tblProducts.ProductAvailability, tblProducts.ProductName, tblProducts.ProductImage, tblProducts.ProductPrice, tblProducts.ProductDiscountAmount FROM `tblcart` INNER JOIN tblProducts ON tblcart.ProductID=tblProducts.ProductID WHERE tblcart.Username ='" . $USER . "'";
    $result_cart_details = mysqli_query($con, $select_cart_details);
    $count_products = mysqli_query($con, "SELECT SUM(Quantity) as totalproducts FROM tblcart WHERE Username='" . $USER . "'");
    $result_count_products = mysqli_fetch_assoc($count_products);
	$_SESSION['totalproducts'] = $result_count_products['totalproducts'];
	
	$total_price = mysqli_query($con, "SELECT h.SelectionID, r.ProductID, sum(r.ProductPrice * h.Quantity) AS totalprice FROM tblcart h INNER JOIN tblproducts r ON h.ProductID = r.ProductID WHERE h.Username ='" . $USER . "'");
	$result_total_price = mysqli_fetch_assoc($total_price);
	$_SESSION['totalprice'] = $result_total_price['totalprice'];


    
    $result_total_price = mysqli_fetch_assoc($total_price);
	
}
?>

         <!-----------------Side Bar----------------->
<form method="post">
            <?php
//Count number of rows
$no_of_items = mysqli_num_rows($result_cart_details);
if ($no_of_items > 0)
{
?>

            <div class="sidebar">
               <h2>Cart Summary</h2>
               <div class="col_1">
                  <div class="box">
                     <ul>
                        <li><b>Total Products:</b> <?php echo $_SESSION['totalproducts']; ?></li>
                        <li><b>Tax:</b> 0 LKR</li>
                        <li><b>Total Price:</b> <?php echo $_SESSION['totalprice']; ?>.00 LKR </li>
                        <li><sub> *Excluding Shipping Charges</sub></li>
                     </ul>
                  </div>
               </div>
               <div class="col_1">
                  <div class="box">
                     <ul>
                        <li><input type="submit" name="checkout"  value="Checkout"></li>
                        <li><input type="submit" name="continueshopping" value="Continue Shopping"</li>
                     </ul>
                  </div>
               </div>
            </div>
            <?php } else{}?> 
            <!----------------- main frame----------------->
            <div id="mainframe">
               <div class="sub_frame">
                  <h3>Shopping Cart</h3>
                  <hr>
                  <?php
                     	$no_of_items=mysqli_num_rows($result_cart_details);
                     	if($no_of_items > 0){ 
                     	?> 
                  <table>
                     <tr>
                        <th width="5%">Product Image</th>
                        <th width="30%">Product Name</th>
                        <th width="11%">Quantity</th>
                        <th width="2%">Discount</th>
                        <th width="2%">Availability</th>
                        <th width="6%">Sub Total</th>
                        <th width="5%">Check All:<input type="checkbox" onClick="checkAll(this)"></th>
                     </tr>
                     <?php
                        while($data = mysqli_fetch_array($result_cart_details))
                        {
                        ?>
                     <tr>
                        <td><img src="<?php echo $data['ProductImage']; ?>" width="80" height="80"></td>
                        <td><?php echo  $data['ProductName']; ?></td>
                        <td><input name="quantity[]"  id="11" type="number" min="0" step="1" value="<?php echo $data['Quantity']; ?>" ></td>
                        <td><?php echo  $data['ProductDiscountAmount']; ?></td>
                        <td><?php echo  $data['ProductAvailability']; ?></td>
                        <td class="ppqprice"><?php echo "LKR ".$data["ProductPrice"]*$data["Quantity"]; ?></td>
                        <td><input name="checkedvalues[]" type="checkbox" value="<?php echo  $data['SelectionID'];?>" class="check_box" onChange="checkCount();" ><input name="selectedvalues[]" type="hidden" value="<?php echo $data['SelectionID'];?>"></td>
                     </tr>
                     <?php } ?>
                  </table>
                  <table>
                     <tr>
                        <td ><input type="submit" name="updateitem" class="cart_btn" value="Update The Cart"></td>
                        <td colspan="6" class="tf"><input type="submit" name="removeitem" class="cart_btn" value="Remove Selected"></td>
                     </tr>
                  </table>
         </form>
         <?php } else { ?>
         <h3>The cart is empty!</h3>
         <?php } ?> 
         <script>
            function checkCount(elm) {
                  var checkboxes = document.getElementsByClassName("check_box");
                  var selected = [];
                  for (var i = 0; i < checkboxes.length; ++i) {
                    if(checkboxes[i].checked){
                        selected.push(checkboxes[i].value);
                    }
                    }
                }
            function checkAll(source) {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] != source)
                        checkboxes[i].checked = source.checked;
                }
            }
         </script>
         </div>
         <div class="clear"></div>
         <!-----------------Footer----------------->
         <?php include('Resources/footer.php');?>
         </div>
      </div>
   </body>
</html>


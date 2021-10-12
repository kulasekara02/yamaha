<!DOCTYPE html>
<html>
  <head>
    <title>Yamaha</title>
    <link href="../Resources/css.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <!-----------------Wrapper----------------->
    <div id="wrapper">
    
      <!-----------------Header & Navigation Bar----------------->
      <?php
        include('header.php');
		        if(!isset($_SESSION["username"])){
        header("Location: login.php");
        }else{
           $select_products = "SELECT *FROM `tblproducts` ORDER BY `CreatedDate` DESC";
           $result_select_products = mysqli_query($con, $select_products);
		}
        ?>
      <!----------------- main frame----------------->
      <div id="mainframe">
        <div class="sub_framefullpage" style="width:100%">
          <button type="button" class="collapsible">View And Manage Products</button>
          <div class="content">
          <form method="post">
          <table width="200" border="1">
            <tr>
              <th scope="col">Product Name</th>
              <th scope="col">Price</th>
              <th scope="col">Design Type</th>
              <th scope="col">Brand</th>
              <th scope="col">Colour</th>
              <th scope="col">Dimensions</th>
              <th scope="col">Action</th>
            </tr>
            <?php
              //Count number of rows
              	$no_of_select_products=mysqli_num_rows($result_select_products);
              	if($no_of_select_products>0)
              	{
              	///////////Fetch products from variable and display
              	while($product_data = mysqli_fetch_array($result_select_products))
              	{
              ?> 
              
            <tr>
        <td><?php echo $product_data['ProductName']; ?></td>
        <td><?php echo $product_data['ProductPrice']; ?></td>
        <td><?php echo $product_data['ProductDesignType']; ?></td>
        <td><?php echo $product_data['ProductBrand']; ?></td>
        <td><?php echo $product_data['Colour']; ?></td>
        <td><?php echo $product_data['Dimensions']; ?></td>
        <!--Edit option -->
        <td><a href="editorders.php?edit_id=<?php echo $product_data['ProductID']; ?>" alt="edit" >Edit</a></td>            </tr>
            <?php } } else {?>
            <td>Oops! No Orders Have Been Placed!</td>
            <?php } ?>
          </table>
          <input id="1" name="updateorder" type="submit" value="Update" style="visibility:hidden;">
          </form>
          </div>
          
          <button type="button" class="collapsible">Add New Product</button>
          <div class="content">
          <div class="col_3">
          <form method="post" enctype="multipart/form-data">
          <p>
          <label>Product Name</label>
                    <br>
          <input name="Name" type="text" required>
          </p>
 <p>
          <label>Product Price</label>
                    <br>
			<input name="InitialPrice" type="number" required>
            </p>
             <p>
          <label>Category</label>
                    <br>
                    
                   <select name="CategoryID">                   
                     <?php
//Count number of rows
	$no_of_categories=mysqli_num_rows($result_select_category);
	if($no_of_categories > 0)
	{
	///////////Fetch products from variavle and display
	while($category_data = mysqli_fetch_array($result_select_category))
	{
?>    
    <option value="<?php echo $category_data['CategoryID']; ?>"><?php echo $category_data['CategoryName']; ?></option>
    
	<?php } } else {?>
	<option value="">No Categories</option>
	<?php } ?>  
	</select>  
            </p>
                       <p>
            <label>Brand</label>
                      <br>
          <input name="Brand" type="text" required>
          </p>
           <p>
          <label>Colour</label>
                    <br>
			<input name="Colour" type="text" required>
            </p>
            
             <p>
            <label>Dimensions</label>
                      <br>
			<input name="Dimensions" type="text"required>
            </p>
                        </div>
            <div class="col_3">
             <p>
            <label>Design Type</label>
                      <br>
          <input name="DesignType" type="text" required>
          </p>
           <p>
          <label>Discount Amount</label>
                    <br>
			<input name="Discount" type="number"required>
            </p>
             <p>
            <label>Bike Type</label>
                      <br>
			<input name="BikeType" type="text"required>
            </p>
             <p>
            <label>Availability</label>
                      <br>
          <input name="Availability" type="text" required>
          </p>
           <p>
			<label>Image</label>
                      <br>
          <input type="file" name="image" required>
          </p>
          </div>
          <p>
			<input name="addnewproduct" type="submit" value="Add Product">
            </p>
          </form>
          </div>
            <?php if(empty($MESSAGE_PRODUCTS)){ } else {?>
  <label class = "labelhome"> <?php echo $MESSAGE_PRODUCTS ?></label>
  
 <?php }?> 
          
        </div>
        <div class="clear"></div>
        <!-----------------Footer----------------->
        <?php include('footer.php');?>
      </div>
    </div>
    	<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
	</script>
  </body>
</html>
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
        }
        else
        {
if(isset($_GET['edit_id'])){
	$sql = "SELECT * FROM tblproducts WHERE ProductID =" .$_GET['edit_id'];
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
}
        }
        
        ?>
      <!----------------- main frame----------------->
      <div id="mainframe">
        <div class="headingspacefullpage" style="width:100%">
          <h3>Track And Manage Orders</h3>
          <form method="post">
          <table width="200" border="1">
            <tr>
              <th scope="col">Tracking ID</th>
              <th scope="col">Recipient Name</th>
              <th scope="col">Order Date</th>
              <th scope="col">Action</th>
            </tr>
            <?php
              //Count number of rows
              	$no_of_track_orders=mysqli_num_rows($result_track_orders);
              	if($no_of_track_orders>0)
              	{
              	///////////Fetch products from variable and display
              	while($tracking_data = mysqli_fetch_array($result_track_orders))
              	{
              ?> 
              
            <tr>
              <td width="5%"><?php echo $tracking_data['TrackID'];?> <input name="selectedvalues[]" type="hidden" value="<?php echo $tracking_data['TrackID'];?>"></td>
              <td width="40%"><?php echo  $tracking_data['RecipientName']; ?></td>
              <td width="16%"><?php echo  date("Y-m-d",strtotime($tracking_data['OrderDate'])); ?></td>
              <td width="20%">
              <select name="newstatus[]" onChange="AutoClickUpdate()">
              <option selected="selected" style="color:#09F"><?php echo  $tracking_data['Status']; ?></option>
              <option value="In Progress">In Progress</option>
              <option value="Reject">Reject</option>
              <option value="Completed">Completed</option>
              <option value="On Hold">On Hold</option>
              </select>
            </tr>
            <?php } } else {?>
            <td>Oops! No Orders Have Been Placed!</td>
            <?php } ?>
          </table>
          <input id="1" name="updateorder" type="submit" value="Update" style="visibility:hidden;">
          </form>
        </div>
        <div class="clear"></div>
        <!-----------------Footer----------------->
        <?php include('footer.php');?>
      </div>
    </div>
    	<script>
	function AutoClickUpdate(){
	document.getElementById('1').click();
	}
	</script>
  </body>
</html>
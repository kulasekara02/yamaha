<?php
//Connection for tblproductsbase
require 'db.php';
//Select Database
$sql = "SELECT * FROM tblproducts";
$result = $con->query($sql);
$_SESSION =''
?>
<!doctype html>
<html>
<body>
<h1 align="center">Employee Details</h1>
<table border="1" align="center" style="line-height:25px;">
<tr>
<th>Employee ID</th>
<th>ProductName</th>
<th>Gender</th>
<th>Department</th>
<th>Address</th>
<th>Mobile Number</th>
<th>Email</th>
</tr>
<?php
//Fetch Data form tblproductsbase
if($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		?>
		<tr>
        <td><?php echo $row['ProductID']; ?></td>
        <td><?php echo $row['ProductName']; ?></td>
        <td><?php echo $row['ProductPrice']; ?></td>
        <td><?php echo $row['ProductDesignType']; ?></td>
        <td><?php echo $row['ProductBrand']; ?></td>
        <td><?php echo $row['Colour']; ?></td>
        <td><?php echo $row['Dimensions']; ?></td>
        <!--Edit option -->
        <td><a href="editorders.php?edit_id=<?php echo $row['ProductID']; ?>" alt="edit"" >Edit</a></td>
        </tr>
        <?php
	}
}
else
{
	?>
	<tr>
    <th colspan="2">There's No tblproducts found!!!</th>
    </tr>
    <?php
}
?>
</table>
</body>
</html>
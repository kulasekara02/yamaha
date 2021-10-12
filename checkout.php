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

	?>
     
	<!-----------------Main Frame----------------->
    
	<div id="mainframe">
	<div class="sub_frame">
    <h3>Checkout</h3>
	<hr>
    <form method="post">
    
    
    
    
                       <div class="col_3">
                       
                  <table>
                     <tr>
                        <th>Delivery Address</th>
                     </tr>
                     <tr>
                        <td>Recipient Name: <input name="recipientname" type="text" value="" required> </td>
                         </tr>
                         <tr>
                        <td>Recipient Phone: <input name="recipientphone" type="text" value="" required> </td>
                        <tr>
                        </tr>
                        <td>Delivery Address: <input name="deliveryaddress" type="text" value="" required> </td>
                        <tr>
                        </tr>
                        <td>Delivery City: <select name="deliverycity">
                        <option value="Colombo">Colombo</option>
                        <option value="Dehiwala">Dehiwala</option>
<option value="Moratuwa">Moratuwa</option>
<option value="Sri Jayawardenapura Kotte">Sri Jayawardenapura Kotte</option>
<option value="Negombo">Negombo</option>
<option value="Kandy">Kandy</option>
<option value="Galle">Galle</option>
<option value="Trincomalee">Trincomalee</option>
<option value="Batticaloa">Batticaloa</option>
<option value="Jaffna">Jaffna</option>
<option value="Katunayake">Katunayake</option>
<option value="Dambulla">Dambulla</option>
<option value="Kolonnawa">Kolonnawa</option>
<option value="Kurunegala">Kurunegala</option>
<option value="Wattala">Wattala</option>
<option value="Avissawella">Avissawella</option>
<option value="Weligama">Weligama</option>
<option value="Ambalangoda">Ambalangoda</option>
<option value="Kegalle">Kegalle</option>
<option value="Hambantota">Hambantota</option>
<option value="Tangalle">Tangalle</option>
<option value="Gampaha">Gampaha</option>
<option value="Horana">Horana</option>
<option value="Wattegama">Wattegama</option>
<option value="Minuwangoda">Minuwangoda</option>

                        </select>
                        </td>
                        </tr>
                        <tr>
                        <td>Location Type: <select name="locationtype">
                        <option value="home">Home</option>
                        <option value="workplace">Workplace</option>
                        <option value="other">Other</option>
                        </select> </td>
                        </tr>
						<tr>
                        <td>Shipping Type: <select name="shippingtype">
                        
                        <option value="0">Free Shipping: 0.00 LKR (7 Days)</option>
                        <option value="200">Standard Shipping: 200.00 LKR (2 Days)</option>
                        <option value="500">Express Shipping: 500.00 LKR (1 Days)</option>
                        </select>
                        </td>
                        </tr>
                     </tr>
                  </table>
                  </div>
                   <div class="col_3">
                   
                  <table>
                     <tr>
                        <th>Billing Summary</th>
                     </tr>
                     <tr>
                        <td><b>Total Products:</b> <?php echo $_SESSION['totalproducts']; ?></td>
                     </tr>
                     <tr>
                        <td><b>Total Price:</b> <?php echo $_SESSION['totalprice']; ?>.00 LKR <sub>*Excluding Shipping Charges</sub></td>
                        
                     </tr>
                     <tr>
                        <td><b>Tax:</b> 0 LKR</li>
                     </tr>
                  </table>   
                  <table>
                     <tr>
                        <td ></td>
                        <td colspan="6" class="tf"><input type="submit" name="placeorder" class="cart_btn" value="Place Order"></td>
                     </tr>
                  </table>
                  

                  
                  </div>

    </form>
	</div>    
	<div class="clear"></div>
	<!-----------------Footer----------------->
	<?php include('Resources/footer.php');?>
	</div>
    </div>
	</body>
	</html>
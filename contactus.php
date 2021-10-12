
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
    
<?php
	include('header.php');
?>
     <!----------------- main frame----------------->
	<div id="mainframe">
 	<div class="sub_frame" style="width:100%">
    <h3Contact Us</h3>
	<p>
    <div class="row"> 
	<div class="col_3">
	

	<!-----------------Contact us form----------------->
    
	<div class="container" >
	<h3>Message Us</h3>
    <hr>
	<form name="ContactForm" method="post">
	<br>
	<input type="text" name="txtFullname" id="txtFullname" placeholder="Full name" required>
	<br>
	<br>
	<input type="text" name="txtemail" id="txtemail" placeholder="Email Address" required>
	<br>
    <br>
	<input type="text" name="txtSubject" id="txtSubject" placeholder="Subject" required>
	<br>
	<br>
	<textarea name="txtaMessage" id="txtaMessage" placeholder="Your Message...." required minlength="100" maxlength="800"></textarea>
	<br>
	<br>
	<p><input name="Send Message" type="submit" id="Send Message" value="Send Message"  onClick="checkEmail();"></p>
	</form>
	</div>
    
    </div>
       	<div class="col_3">
        <h3> Our Place</h3>
        
        <img src="Resources/designimages/Service_Center.jpg" alt="Colombo Store " style="width:550px;height:400px">
</div> 

    
        </div>
	</div>
    <div class="clear"></div>
	<!-----------------Footer----------------->
	<?php include('Resources/footer.php');?>
	</div>
	</div>
    <script src="Resources/js.js"></script>	
</body>
	</html>
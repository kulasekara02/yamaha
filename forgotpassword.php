

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
         <?php include('header.php');?>
         <!-----------------Main Frame----------------->
         <div id="mainframe">
            <div class="sub_framefullpage">
               <!-----------------Products Frame----------------->
               <h3>Forgot Password</h3>
               <hr>
               <p>
               <div class="row">
                  <div class="col_3">
                     <h3>Account Benifits</h3>
                     <hr>
                     <p>If you create an account with us, you will get additional benefits such as order history, prioritised delivery and much more.</p>
                  </div>
                  <div class="col_3">
                     <h3>Recover Your Password Here</h3>
                     <hr>
                     <form method="POST">
                        <p>Recover your account here with the simplest steps.</p>
                        <p><?php echo $MESSAGE_RECOVER; ?></p>
                        <?php if($DISPLAY_CONTENT != "Display"){ ?> 
                        <label>Username</label><br>
                        <input name="username" type="text"><br>
                        <label>Email Address</label><br>
                        <input name="email" type="text" ><br>
                        <label>Security Question</label><br>
                        <select name="securityquestion">
<option value="1">What was the name of your primary school?</option>
<option value="2"> What is the name of the company of your first job?</option>
<option value="3"> What was your favorite place to visit as a child?</option>
<option value="4"> What is your spouse's mother's maiden name?</option>
<option value="5"> What is the country of your ultimate dream vacation?</option>
<option value="6"> What is the name of your favorite childhood teacher?</option>
<option value="7"> To what city did you go on your honeymoon?</option>
<option value="8"> What time of the day were you born?</option>
<option value="9"> What was your dream job as a child?</option>
<option value="10"> What is the street number of the house you grew up in? </option>
<option value="11"> What is the license plate of your dad's first car? </option>
                      </select>
                       <br>
                       
                        <label>Security Answer</label><br>
                        <input name="securityanswer" type="text"><br>
                        <p>
                        <input name="recoveraccount" type="submit" value="Recover">
                        </p>
                        </form>
                        
                        <?php } else{ ?> 
                        <form method="post">
                        <label>Please Enter A New Password</label><br>
                        <input name="newpassword" type="password"><br>
                        <p>
                        <input name="resetpassword" type="submit" value="Reset Password">
                        </p>
                        </form>
                        <?php } ?>
                     
                  </div>
               </div>
               </p>
            </div>
            <div class="clear"></div>
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
   </body>
</html>
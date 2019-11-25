<?php include 'inc/header.php'; ?>
<?php 
// It use For Registration
  if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])) {
  	  $customerRegister=$customer->customerRegistration($_POST);	 
   }
?>

<?php 
// It use For Login
  if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login'])) {
  	  $customerLogin=$customer->customerLogin($_POST);	 
   }
?>
<!-- Registration r login hoye gele oi login page thekar r dorkar ni tai a method (Session toh set age ase) -->
<?php 
 $login=Session::get("customerLogin");
  if ($login==true) {
  	header("Location:orderdetails.php");
  }
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
    <?php 
     if (isset($customerLogin)) {
     	echo $customerLogin;
     }
     ?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
                	<input name="email" type="text" placeholder="Enter Your Valid Email"/>
                    <input name="pass" type="password" placeholder="Enter Your Password"/>
                
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                    </div>
             </form>

    	<div class="register_account">
    	<?php 
         if (isset($customerRegister)) {
         	echo $customerRegister;
         }
    	 ?>
    		<h3>Register New Account</h3>
    		<form action="" method="post"/>
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							  <input type="text" name="name" placeholder="Enter Your Name"/>
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter Your City"/>
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Enter Your Zip-Code"/>
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter Your Email"/>
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter Your Address"/>
						</div>
		    		    <div>
							<input type="text" name="country" placeholder="Enter Your Country"/>
						</div>	        
		           <div>
		             <input type="text" name="phone" placeholder="Enter Your Phone Number"/>
		          </div>
				  
				  <div>
					<input type="text" name="pass" placeholder="Enter Your Password"/>
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="submit">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>


<?php include "header.php" ?>
<?php
$email=$pass="";
$error_message="";
$salt="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{

	$email=$_POST["email"];
	$pass=$_POST["password"];

	if(empty($email) && empty($pass))
	{
		$error_message="Username/Password not correct";
	}

	else
	{
		if(empty($email))
		{
			$error_message="Username/Password not correct";
		}

		if (empty($pass)) 
		{
		$error_message="Username/Password not correct";
		}
	}

	if( empty($email_error) && empty($pass_error) )
	{

		include 'connection.php';
		$sql="SELECT * from `users` where email='$email'";//humlog user ko uske email id through check karte hai ki wo database me exits karta hai ki nh.yadi wo exits karta hai to uska sara info humko milega.
		$result=mysqli_query($conn,$sql);
		//print_r($result); yaha humlog database me jo query bhejte hai uska answer mila hai.

		if(mysqli_num_rows($result)>0)//yadi wo user database me exits karta hai to uska name ka ek row hmko dikhega.
        {
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $password=md5($row['salt'].$pass);
            //print_r( $password);
            print_r($password);
            // print_r( $row['password'] );
            if($row['password']==$password)
            {
            	header('Location:index.php');
            }
            $error_message="Username/Password not correct"; 
        }
        else
        {
        	$error_message="Email id doesn't exists";
        }

	}





}

?>



<div class="container1">
   <div class="container2">
   	<div class="error"><?php echo $error_message ?></div>
   		<div class="header">
   			 <h3 class="active">Sign in</h3>
   			 <h3><a href="signup.php">Sign up</a></h3>
   		</div>
      <div class="login">
		   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
			    <h6>Email</h6>
			    <input type="text" name="email" id="email"   required><br>
			    <h6 class="pass">Password</h6>
			    <input type="Password" name="password" id="password" required><br>
			    <label><input type="checkbox" name="sign-in">Keep me sign in</label><br><br>
			    <input type="submit" value="Sign-In" id="sign-in">
 	       </form>
 	      	 <hr>
 	      	 <h6 style="text-align: center;">Forgot Password?</h6>
 	   </div>

 	 
       
   </div>

</div>






<?php include "footer.php" ?>




<?php include "header.php" ?>
<?php 
$success_message="";
$error_message="";
$error=$first_name_error=$last_name_error=$email_error=$password_error=$confrmpass_error="";

$fname=$lname=$pass=$cnfrm_password=$email="";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $pass=$_POST['pass1'];
    $cnfrm_password=$_POST['pass2'];
    $email=$_POST['email'];


    if(empty($fname)&& empty($lname) && empty($pass) && empty($cnfrm_password) && empty($email))
    {
        $error="All fields are mandatory.";
    }
    else
    {
        if (empty($_POST["fname"])) 
        {

            $first_name_error="Name is must";
        }
        else
        {
            $fname=test_input($_POST["fname"]);
            if (!preg_match("/^[a-zA-Z]*$/", $fname)) 
            {
              
              $first_name_error="only character are valid"; 
            }
        }

        if(empty($_POST["lname"]))
        {
            $last_name_error="Name is must";
        }

        else
        {
            $lname=test_input($_POST["lname"]);

            if(!preg_match("/^[a-zA-Z]*$/", $lname))
            {
                $last_name_error="only character are valid";
            }

        }

        if(empty($_POST["pass1"]))
        {
            $password_error="Password is must";
        }
        else
        { 
            $pass=test_input($_POST["pass1"]);

            if(!preg_match("/^[a-zA-Z@_0-9]{7,16}$/",$pass))
            {
                $password_error="Password must ";
            }
        }

        if(empty($_POST["pass2"]))
        {
            $confrmpass_error="Confirm pass must";
        }
        else if($pass!=$cnfrm_password)
        {

            $confrmpass_error="Password must be same";

        }

       if(empty($_POST["email"]))
        {
            $email_error="Email is must";
        }
        else
        {
            $email=test_input($_POST["email"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
                $email_error = "Invalid email format"; 
            }
        }
    }
    if( empty($error) && empty($first_name_error) && empty($last_name_error)&& empty($email_error)&& empty($password_error) && empty($confrmpass_error)){
        include 'connection.php';

       $sql="SELECT email from `users` where email='$email'";
        
        $result=mysqli_query($conn,$sql);
        
        if(mysqli_num_rows($result)>0)
        {
            $error_message="Email id already exists.";
             mysqli_close($conn);
        }
        else
        {     $salt = uniqid(mt_rand(), true);
              $md5=md5($salt.$pass);
              $sql="INSERT INTO users (firstname,lastname,password,email,salt)
              values('$fname','$lname','$md5','$email','$salt')";
              if(mysqli_query($conn,$sql))
              {
                $success_message="Account created succesfully";
                $fname="";
                $lname="";
                $email="";
              }
              else
              {
                $error_message="Error: ".mysqli_error($conn);
              }

              mysqli_close($conn);

              
        }

      
        
    }
}



function test_input($data)
{
  $data=trim($data);
  $data=stripslashes($data);
    $data=htmlspecialchars($data);
  return $data;
}

?>



<div class="container1">
   <div class="container2">
    <div class="success"><?php echo $success_message ?></div>
    <div class="error"><?php echo $error_message ?></div>

   		<div class="header">
   			 <h3><a href="signin.php"> Sign in</a></h3>
   			 <h3 class="active">Sign up</h3>
   		</div>
  

 	   <div class="signup">
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
       			<h6>First Name  <span class="error">*</span></h6>  
            	<input type="text" name="fname" value="<?php echo $fname ?>" id="fname" required>
            <span class="error"><?php echo $first_name_error ?></span>
            	<h6>Last Name <span class="error">*</span></h6>
            	<input type="text" name="lname" value="<?php echo $lname ?>" id="lname" required>
            <span class="error"> <?php echo $last_name_error ?></span>
            	<h6>Password <span class="error">*</span></h6>
            	<input type="Password" name="pass1" id="pass1" required>
            <span class="error"> <?php echo $password_error ?></span>	
            	<h6>Confirm Password <span class="error">*</span></h6>
            	<input type="Password" name="pass2"  id="pass2"  required>
            <span class="error"> <?php echo $confrmpass_error ?></span>	
            <h6>Email id <span class="error">*</span></h6>
            	<input type="text" name="email" value="<?php echo $email ?>"  id="email" required>
              <span class="error"> <?php echo $email_error ?></span>	

            	<input type="submit" value="Register" id="register">

            </form>
		</div>
       
   </div>

</div>






<?php include "footer.php" ?>




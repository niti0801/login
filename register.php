<?php 
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
    	if(!preg_match("/^[a-zA-Z@_0-9]*$/",$pass))
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

    else
    {
    	$cnfrm_password=test_input($_POST["pass2"]);
    	if (!preg_match("/^[a-zA-Z@_0-9]*$/", $cnfrm_password)) 
    	{
    		 $confrmpass_error=" confirm Password must be ";
    	}
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
}



function test_input($data)
{
	$data=trim($data);
	$data=stripslashes($data);
    $data=htmlspecialchars($data);
	return $data;
}
session_start();
$_SESSION['error']=$error;
$_SESSION['first_name_error']=$first_name_error;
$_SESSION['last_name_error']=$last_name_error;
$_SESSION['password_error']=$password_error;
$_SESSION['confirm_password_error']=$confrmpass_error;
$_SESSION['fname']=$fname;
$_SESSION['lname']=$lname;
$_SESSION['pass']=$pass;
$_SESSION['cnfrm_password']=$cnfrm_password;
$_SESSION['email']=$email;
$_SESSION['action']='register';
// print_r($_SESSION);
header('location: index.php');
exit();
?>
<!-- ليلى سعود السعيدي 436010954 -->

<?php 
session_set_cookie_params(10,"/");

session_start();
if(isset($_SESSION["USERNAME"]))
{
 header("location: profile.php");
}
 // it will never let you open index(login) page if session is set
 
 
 $error = false;
 $errors = array();
$_SESSION['success'] = "";
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'layla alsaede');


if(isset($_POST["log_user"])) 
{
	if(!empty($_POST["USERNAME"]) && !empty($_POST["password"]))
 {
// Assigning POST values to variables.
$username = $_POST['USERNAME'];
$password = $_POST['password'];

// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `users` WHERE USERNAME='$username' and PASSWORD_='$password'";
 

    
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = mysqli_num_rows($result);

if ($count == 1){
    
if(!empty($_POST["remember"]))   
   {  
    setcookie ("member_login",$username,time()+ (10 * 365 * 24 * 60 * 60));  
    setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
    $_SESSION["USERNAME"] = $username;
    
} 


    
   else  
   {  
    if(isset($_COOKIE["member_login"]))   
    {  
     setcookie ("member_login","");  
    }  
    if(isset($_COOKIE["password"]))   
    {  
     setcookie ("password","");  
    }  
   }  
   session_start(); 
        $_SESSION["USERNAME"] = $username;
 header("location: profile.php");  } 
        
  else  
  {   
echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
//echo "Invalid Login Credentials";
}}
 else
 {
      $error = true;
  $errMSG = "Both are Required Fields";
 }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>homepage</title>
 <link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
<style>
</style>
</head>

<body>
 
    
              <?php if($error) { ?>
              <div role="alert" class="alert  alert-danger  text-center">
            <?php 
              if(isset($passError)) { echo $passError; }
              if(isset($errMSG)) { echo $errMSG; } 
              if(isset($usernameError)) { echo $usernameError; }
            ?>
          </div>
      <?php } ?>
    
    <div class="login-clean">
  	<form action="login.php" method="POST">
		
		<input type="text" placeholder="Enter your username" name="USERNAME" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
		<input type="password" placeholder="and password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">

         <input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />  
     <label for="remember-me">Remember me</label> 
        <br/>
		<input type="submit" name="log_user">

	</form>
    </div>

</body>

</html>
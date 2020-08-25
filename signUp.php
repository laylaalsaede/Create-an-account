<!-- ليلى سعود السعيدي 436010954 -->
<?php
session_start();


// initializing variables
$username = "";
$phone    = "";
$password_1="";
$errors = array(); 
 $error = false;
$_SESSION['success'] = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'layla alsaede');

// REGISTER USER

if (isset($_POST['reg-user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['USERNAME']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
     if(empty($username)){
     array_push($errors, "Please enter ");
       $error = true;
          $userError = " ادخل اسم المستخدم ";}
    
    
      if(empty($phone)){
           array_push($errors, "Please enter your phone ");
           $error = true;
          $departmentError = " ادخل رقم الجوال ";
    }
     
    
    if(empty($password_1)){
     array_push($errors, "Please enter password");
    $error = true;
    $passError = " ادخل كلمة المرور";
  }
    
    
  /*   if(empty($password_2)){
          array_push($errors,"Please enter confirm password.");
          $error = true;
         
    $confirm_password_err = " قم بتأكيد كلمة المرور";
         
  } else{
        $password_2 = trim($password_2);
        if(empty($passError) && ($password_1 != $password_2)){
             array_push($errors, "The two passwords do not match");
             $error = true;
            $confirm_password_err = " كلمة المرور غير متطابقة.";
     
            
        }
    }   */
      
    
    
    
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE USERNAME='$username' LIMIT 10";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['USERNAME'] === $username) {
         array_push($errors, "Username already exists");
          $error = true;
      $usernameError = "اسم المستخدم مستخدم بالفعل. جرب اسم مستخدم آخر";
        
    }
  }
if( isset($_POST['USERNAME']) && isset( $_POST['password_1'] ) )
 {
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    
  	$query = "INSERT INTO users (USERNAME, PASSWORD_, PHONE) 
  			  VALUES('$username','$password_1', '$phone')";
  	mysqli_query($db, $query);
  	$_SESSION['USERNAME'] = $username;
  	$_SESSION['success'] = "You are now logged in";
     header("Location: profile.php");
      exit;
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
    <link rel="stylesheet" href="assets/css/contactus.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
 

     <style>

</style>
</head>

<body>

    	<h1>Register</h1>
	<span>or <a href="login.php">login here</a></span>
    
    <div class="contact-clean">
	<form action="signUp.php" method="POST">        
            <?php if($error) { ?>
              <div role="alert" class="alert  alert-danger  text-center">
            <?php 
              if(isset($emailError)) { echo $emailError; }  
              if(isset($passError)) { echo $passError; }
              if(isset($errMSG)) { echo $errMSG; } 
              if(isset($usernameError)) { echo $usernameError; } 
              if(isset($confirm_password_err)) { echo $confirm_password_err; } 
              if(isset($emailExistError)) { echo $emailExistError; } 
             if(isset($emailemptyError)) { echo $emailemptyError; } 
             if(isset($userError)) { echo $userError; } 
             if(isset($departmentError)) { echo $departmentError; }
             
            ?>
          </div>
      <?php } ?>
        
        
     

		
		<input type="text" placeholder="Enter your username" name="USERNAME">
		<input type="text" placeholder="and phone" name="phone">
		<input type="password" placeholder="your password" name="password_1">
		<input type="submit" name="reg-user">

	</form>
</div>
  
</body>
</html>
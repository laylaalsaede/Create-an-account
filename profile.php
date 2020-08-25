<!-- ليلى سعود السعيدي 436010954 -->

<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['USERNAME'])) {
	header('Location: login.php');
	
}

$db = mysqli_connect('localhost', 'root', '', 'layla alsaede');

if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $db->prepare('SELECT  USERNAME, PASSWORD_, PHONE FROM  users WHERE USERNAME = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('s', $_SESSION['USERNAME']);
$stmt->execute();
$stmt->bind_result($username, $password, $phone);
$stmt->fetch();
$stmt->close();
?>


<!DOCTYPE html>
<html>
	<head>    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
           <link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <title>homepage</title>
        
        <style>
            .button {
  background-color: #aec9eb;
  border: none;
  color: white;
  padding: 16px 16px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
  text-decoration: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.button:hover {opacity: 1}
  .login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 12px;
  box-sizing: border-box;
  font-size: 14px;
}
.form .btn {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 47%;
  border: 0;
  padding: 9px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
  text-align:center;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}

</style>
</head>

<body>
    <div class="login-page">
        <div class="form">
<?php   $USER = $_SESSION['USERNAME'];
     print("<h2>Welcome back, $USER!</h2>"); ?>
            
			<form  class="login-form"  method="GET" action="updateForm.php">

 <table>
      <tr> 
        <th ><h5>name  : </h5></th>
    <td ><h5><?=$username?></h5>  </td>
      </tr>
     
      <tr> 
               <th ><h5>phone  :</h5></th>
     <td ><h5 class=""><?=$phone?></h5>  </td>
      </tr>
     
     <tr> 
          <th ><h5>password  :</h5></th>
   <td ><h5 class=""><?=$password?></h5>  </td>
      </tr> 
     
     
     <tr>
			
			<td>
              
			<button class="button">	<a href="updateForm.php" class="edit_btn" >Reset password</a> </button>

			</td>
			<td><button class="button"><a href="login.php" class="edit_btn" >log out</a>
                <?php session_unset (); ?>
                </button></td>

		</tr>
    

   </table>



				
				</form>
    </div>    </div>

    

   <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
		


 
	</body>

</html>
<?php 




$_SESSION['success'] = "";
$db = mysqli_connect('localhost', 'root', '', 'layla alsaede');

if (isset($_POST['update'])) {	
// Assigning POST values to variables.
$username = $_POST['username'];
$password = $_POST['oldPassword'];
$newPassword1 = $_POST['newPassword1'];

// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `users` WHERE USERNAME='$username' and PASSWORD_='$password'";
   
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = mysqli_num_rows($result);

if ($count == 1){
    $query = "UPDATE users SET PASSWORD_ ='{$_POST['newPassword1']}' WHERE USERNAME='{$_POST['username']}'";
                    mysqli_query($db, $query) or
                            die("Insert failed. " . mysqli_error($db));
                    $successa = "<p class='message'>Your password has been changed!</p>";
                    // Process further here 
                    is_iterable($count); } 
    
    
    
                     else{
    
echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
//echo "Invalid Login Credentials";
}
                } 


?>
<!DOCTYPE html>
<html>
<head>
	<title>update personal page</title>

    <style>

        
</style>
</head>
<body> 


   <?php if(isset($successa)){ ?>
    
             <div class="alert alert-success" role="alert">
            <?php
            if(isset($successa)) { echo $successa; }
             ?></div>
            <?php } ?>
    
         
<form action="updateForm.php" method="post">
     <h1 style="width: 400px; margin: 0 auto;">Reset the password</h1>
    <br>
<br>
<table style="width: 400px; margin: 0 auto;">
    
<tr><th>Username:</th><td><input name="username" type="text" size="20px" autocomplete="off" /></td></tr>
<tr><th>Current password:</th><td><input name="oldPassword" size="20px" type="password" /></td></tr>
<tr><th>New password:</th><td><input name="newPassword1" size="20px" type="password" /></td></tr>
<tr><td colspan="2" style="text-align: center;" >
<input name="update" type="submit" value="Change Password"/>
<button onclick="$('frm').action='changepassword.php';$('frm').submit();">Cancel</button>
</td></tr>
</table>
</form>
</body>
</html>
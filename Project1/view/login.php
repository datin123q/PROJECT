<?php
   date_default_timezone_set('Asia/Ho_Chi_Minh');
   include '../Security/login.php';
   include '../model/db.php';
   session_start();
   if(isset($_SESSION['uid'])){
    unset($_SESSION['uid']);
   }
   if(isset($_SESSION['aid'])){
    unset($_SESSION['aid']);
   }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>		
<link rel="stylesheet" href="../css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
	<div class="screen">
		<div class="screen__content">
            <?php
                echo "<form method='POST' class='login' action='".getLogin($conn)."'>
                <div class='login__field'>
                    <i class='login__icon fas fa-user'></i>
                    <input type='text' class='login__input'name='usn' placeholder='User name / Email' required>
                </div>
                <div class='login__field'>
                    <i class='login__icon fas fa-lock'></i>
                    <input type='password' class='login__input' name='pwd' placeholder='Password' required>
                </div>
                <button class='button login__submit' name='loginSubmit'>
                    <span class='button__text'>Log In Now</span>
                    <i class='button__icon fas fa-chevron-right'></i>
                </button>
                </form>";
                ?>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
<!-- partial -->
  
</body>
</html>

<?php include_once("layout.php") ?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Sidebar 02</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">


  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
                    <?php
                    echo"<form method = 'POST' action = '".setUser($conn)."'>
                        <input type='hidden' name='uinfo' value='1'>
                        <button style='background-color:#866ec7 ; border: none; width:160px ; color: #FFF;' class='nav-link collapsed' name = 'setuinfo' style='border: none;'>
                            <span>".$_SESSION['name']."</span>
                        </button>
                    </form>";
                    ?>
                  <?php
                getNameAssignmentsGv($conn);
                ?>
                

                    <a href="login.php" style="color: #FFF;">Log out</a>

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>

	      </div>
    	</nav>

        <div class='container'>
            <div class='container-body'>
                <div class ='assignment'>
                    <?php
                        if(isset($_SESSION['uinfo'])){
                            getUserinfo($conn);
                        }
                        if(isset($_SESSION['aid'])){
                        getAssignments($conn);

                        echo "<form method= 'POST' action='".setComments($conn)."'>
                            <input type='hidden' name='uid' value='".$_SESSION['uid']."'>
                            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
                            <textarea name= 'message'> </textarea></br>
                            <button type='submit' style='margin-left: 88%;' name = 'commentSubmit'>Bình luận</button>
                        
                        </form> ";
                        getComments($conn);
                    }
                        ?>
                        <?php
                        if(isset($_SESSION['dssv'])){
                          unset($_SESSION['uinfo']);
                            getDSSV($conn);
                        }
                        ?>
                    </div>
                <div class='submit'>
                    <?php
                    if(isset($_SESSION['aid'])){
                        getWorkGv($conn);
                        }
                    ?>

                </div>
                <div class="loginPopup">
                    <div class="formPopup" id="popupForm">
                      
                      <?php
                        
                      getUserName($conn);
                        
                        ?>

                    </div>
                  </div>
                  <div class="loginPopup2">
                    <div class="formPopup2" id="popupForm2">
                      
                      <?php
                        
                      getProName($conn);
                        
                        ?>

                    </div>
                  </div> 
                  <div class="loginPopup4">
                    <div class="formPopup4" id="popupForm4">
                      
                      <?php
                        
                      addsvName($conn);
                        
                        ?>

                    </div>
                  </div> 
            </div>
        </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>\
    <script src="../js/main2.js"></script>
  </body>
</html>
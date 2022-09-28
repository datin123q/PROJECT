<?php
    require_once('../Security/auth.php');
   date_default_timezone_set('Asia/Ho_Chi_Minh');
   require('../model/assignments.inc.php');
   require('../model/comments.inc.php');
   require('../model/user.inc.php'); 
   require('../model/work.inc.php');
   require('../model/project.inc.php');
   include_once("../model/db.php") ;
   session_start();
?>

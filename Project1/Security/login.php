<?php

function getLogin($conn) {
    if(isset($_POST['loginSubmit'])){
        $usn = $_POST['usn'];
        $pwd = $_POST['pwd'];

        $sql = "SELECT * from user WHERE usn = '$usn' AND pwd = '$pwd'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result)){
            if($row = $result->fetch_assoc()){
                $_SESSION['usn'] = $row['usn'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['uinfo'] = 1;
                if($row['role'] == 0){
                    header("Location: ../view/student.php");
                exit();
                }
                else {
                    header("Location: ../view/teacher.php");
                exit();
                }
            }
        } else{
            header("Location: login.php?loginfailed");
                exit();
        }
    }
}
?>
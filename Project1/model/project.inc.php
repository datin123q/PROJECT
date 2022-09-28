<?php
function getProName($conn){
    echo"<form action='".addPro($conn)."' method='POST' class='formContainer2'>";
    echo"Tên PROJECT: <input type='text' required name ='proname'</input><br><br>";
    echo"
    <button type='submit' name='addpro'>Thêm</button>
    <button type='button' onclick='closeForm2()'>Close</button>";
    echo"</form>";
  }
function addPro($conn){
    if(isset($_POST['addpro'])){
        $ptitle = $_POST['proname'];
        $sql = "INSERT into project (ptitle ) VALUES ('$ptitle')";
        $result = $conn->query($sql);
        $sql3 = "SELECT * from project";
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
function addTL($conn){
    if(isset($_POST['addTL'])){
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $path = "../files/".$fileName;
        $uid= $_SESSION['uid'] ;
        $aid= $_SESSION['aid'] ;
        $wid = $_SESSION['wid'];
        $date = $_POST['date'];
        // $query = "INSERT INTO filedownload(filename) VALUES ('$fileName')";
        // $query = "INSERT INTO user_ass (wid, uid, aid, result, file, date) VALUES (NULL, '$uid', '$aid', 0, '$fileName', '$date');";
        $query = "INSERT INTO ass_file (aid, file) VALUES ('$aid', '$fileName');";
        if($fileName != ''){
        $run = mysqli_query($conn,$query);
            if($run){
                move_uploaded_file($fileTmpName,$path);
                echo "success";
            }
            else{
                echo "error".mysqli_error($conn);
            }
        }
        mark($conn, $uid, $aid);
        echo "<meta http-equiv='refresh' content='0'>"; 
    }
}
?>
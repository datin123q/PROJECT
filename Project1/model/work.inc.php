<?php
function submitWork($conn){
    if(isset($_POST['submitW'])){
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $path = "../files/".$fileName;
        $uid= $_SESSION['uid'] ;
        $aid= $_SESSION['aid'] ;
        $wid = $_SESSION['wid'];
        $date = $_POST['date'];
        // $query = "INSERT INTO filedownload(filename) VALUES ('$fileName')";
        // $query = "INSERT INTO user_ass (wid, uid, aid, result, file, date) VALUES (NULL, '$uid', '$aid', 0, '$fileName', '$date');";
        $query = "INSERT INTO work_file (wid, file) VALUES ('$wid', '$fileName');";
        $sql2 = "UPDATE user_ass SET date = '$date' WHERE uid = '$uid' and aid = '$aid'";
        if($fileName != ''){
        $run = mysqli_query($conn,$query);
            if($run){
                $result = $conn->query($sql2);
                move_uploaded_file($fileTmpName,$path);
                echo "success";
            }
            else{
                echo "error".mysqli_error($conn);
            }
        }
        echo "<meta http-equiv='refresh' content='0'>"; 
    }
}
function getWork($conn){
    $uid= $_SESSION['uid'] ;
    $aid= $_SESSION['aid'] ;
    $query2 = "SELECT * from user_ass,assignments WHERE uid = '$uid' and assignments.aid = '$aid' and user_ass.aid = '$aid' ";
    $run2 = mysqli_query($conn,$query2);  
    while($row = mysqli_fetch_assoc($run2)){
    if($row['date']>$row['ftime']){
    $muon = "   Nộp muộn";
    }
    else $muon = "   Đúng hạn";
    echo"<a href='../model/download.php?file=".$row['file']."'>".$row['file']."</a>
    Điểm: ".$row['result']."/10
    <br>";
    echo" ".$row['date']."  "   .$muon."<br>";
    if($row['result']==0){
        echo "
        <form  method = 'POST' action = '".deleteWork($conn)."'>
            <input type='hidden' name='wid' value='".$row['wid']."'>
            <button name ='deleteWork'>Xóa</button>
        </form>
        </div>";
    }
  }
}
function getmyWork($conn){
    $uid= $_SESSION['uid'] ;
    $aid= $_SESSION['aid'] ;
    $wid= $_SESSION['wid'] ;
    $query2 = "SELECT * from user_ass,assignments,work_file WHERE uid = '$uid' and assignments.aid = '$aid' and user_ass.aid = '$aid' and work_file.wid = '$wid' ";
    $run2 = mysqli_query($conn,$query2);  
    while($row = mysqli_fetch_assoc($run2)){

    echo"<a href='../model/download.php?file=".$row['file']."'>".$row['file']."</a><br>";
    // echo"Điểm: ".$row['result']."/10
    // <br>";
    // echo" ".$row['date']."  "   .$muon."<br>";
    // if($row['result']==0){
    //     echo "
    //     <form  method = 'POST' action = '".deleteWork($conn)."'>
    //         <input type='hidden' name='wid' value='".$row['wid']."'>
    //         <button name ='deleteWork'>Xóa</button>
    //     </form>
    //     </div>";
    // }
  }

}
function getWorkGv($conn){
    $aid= $_SESSION['aid'] ;
    $sql  = "Select * from user, user_ass,assignments WHERE user.uid = user_ass.uid and user_ass.aid = '$aid' and user.role =0 and assignments.aid='$aid' ";
    $result = $conn->query($sql);
    echo"<div style='width: 350px;height:100%; background-color:#fff; margin-top:20px'>";
    echo"<div style='text-align: center; font-size:19px'>Danh sách bài tập</div>";
    while($row = $result->fetch_assoc()){
        echo"<button class='workGv'><span>".$row['name']."</span>";
        echo"</button>";
        $sql2 = "SELECT * from user_ass,assignments,work_file WHERE assignments.aid = '$aid' and user_ass.aid = '$aid' and work_file.wid = user_ass.wid ";
        $result2 = $conn->query($sql2); 
        $n =0;
        echo"<div class='panel'>";
        while($row2 = $result2->fetch_assoc()){
            if($row2['uid'] == $row['uid']){
                $n = 1;
                    echo"<a href='../model/download.php?file=".$row2['file']."'>".$row2['file']."</a><br>";
            }
        }
        if($n ==1){
        if($row['date']>$row['ftime']){
            $muon = "   Nộp muộn";
            }
            else $muon = "   Đúng hạn";
        echo"<form  method = 'POST' action = '".markWork($conn)."'>";
        echo" ".$row['date']."  "   .$muon."   <br>";
        echo"Điểm: <input type='number' required step='0.01' name ='point' style='width:50px' value='".$row['result']."'>/10
                    <br>";
                    echo "<br>
                        <input type='hidden' name='wid' value='".$row['wid']."'>
                        <button name ='markWork'>Chấm điểm</button>
                    </form>";
        }
        if($n ==0){
            echo "Chưa nộp";
        }
        echo"</div>";
    }
    echo"<button class='workGv'onclick='openForm()'>+Thêm Sinh Viên</button>";
    echo"</div>";
    echo"<script>
    var acc = document.getElementsByClassName('workGv');
    var i;
    
    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener('click', function() {
        this.classList.toggle('active');
        var panel = this.nextElementSibling;
        if (panel.style.display === 'block') {
          panel.style.display = 'none';
        } else {
          panel.style.display = 'block';
        }
      });
    }
    function selects(){  
                    var ele=document.getElementsByName('color[]');  
                    for(var i=0; i<ele.length; i++){  
                        if(ele[i].type=='checkbox')  
                            ele[i].checked=true;  
                    }  
                }  
    function deSelect(){  
                    var ele=document.getElementsByName('color[]');  
                    for(var i=0; i<ele.length; i++){  
                        if(ele[i].type=='checkbox')  
                            ele[i].checked=false;  
                          
                    }  
                }      
    </script>";

}

function markWork($conn){
    if(isset($_POST['markWork'])){
        $point = $_POST['point'];
        $wid = $_POST['wid'];
        $sql = "UPDATE user_ass SET result = '$point'  WHERE wid = '$wid'";
        $result = $conn->query($sql);
        echo "<meta http-equiv='refresh' content='0'>";
    }

}
function deleteWork($conn){
    if(isset($_POST['deleteWork'])){
        $wid = $_POST['wid'];
        $sql = "DELETE from work_file WHERE wid = '$wid'";
        $result = $conn->query($sql);
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

?>
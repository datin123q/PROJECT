<?php
function getNameAssignments($conn) {
    $uid = $_SESSION['uid'];
    $sql = "SELECT title, assignments.aid, pid from assignments, user_ass WHERE user_ass.uid = '$uid' AND  user_ass.aid = assignments.aid  ";
    $sql2 = "SELECT ptitle, project.pid from project, user_ass,assignments WHERE user_ass.uid = '$uid' AND  user_ass.aid = assignments.aid and assignments.pid= project.pid  ";
    $result2 = $conn->query($sql2);
    while($row2 = $result2->fetch_assoc()){
            echo "
            <ul class='list-unstyled components mb-5'>
                <li class='active'>
                    <a href='#".$row2['ptitle']."' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'>".$row2['ptitle']."</a>
                <ul class='collapse list-unstyled' id='".$row2['ptitle']."'>";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
                    if($row['pid'] == $row2['pid']){
                        echo "  
                                <li>
                                    <form method = 'POST' action = '".setAssignmentid($conn)."'>
                                        <input type='hidden' name='aid' value='".$row['aid']."'>
                                        <button class='ass_button' name = 'setassid' style='
                                            background-color: #866ec7; 
                                            color: #fff;
                                            border: none;
                                            text-align: center;
                                            text-decoration: none;
                                            cursor: pointer'>
                                            <span>".$row['title']."</span>
                                            ".isMark($conn, $uid, $row['aid'])."
                                        </button>
                                    </form>
                                </li>";
                    }
                }
                echo"                                
                </ul>
                </li>
              </ul>";
    }
}
function isMark($conn, $uid, $aid){
    $sql = "SELECT* from user_ass WHERE uid='$uid' and aid = '$aid'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        if($row['mark']==1){
            echo"<i class='fa fa-exclamation-circle' style='color:yellow ;'></i>";
        }
    }
}

function mark($conn, $uid, $aid){
    $sql = " UPDATE user_ass SET mark =1 WHERE uid<>'$uid' and aid = '$aid'";
    $result = $conn->query($sql);
}
function unmark($conn, $uid, $aid){
    $sql = " UPDATE user_ass SET mark =0 WHERE uid='$uid' and aid = '$aid'";
    $result = $conn->query($sql);
}

function getNameAssignmentsGv($conn) {   
    $uid = $_SESSION['uid'];
    $sql2 = "SELECT * from Project ";
    $sql = "SELECT *from assignments ";
    $result2 = $conn->query($sql2);
    while($row2 = $result2->fetch_assoc()){
            echo "
            <ul class='list-unstyled components mb-5'>
                <li class='active'>
                    <a href='#".$row2['ptitle']."' data-toggle='collapse' aria-expanded='false' class='dropdown-toggle'>".$row2['ptitle']."</a>
                <ul class='collapse list-unstyled' id='".$row2['ptitle']."'>";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
                    if($row['pid'] == $row2['pid']){
                        echo "  
                                <li>
                                    <form method = 'POST' action = '".setAssignmentid($conn)."'>
                                        <input type='hidden' name='aid' value='".$row['aid']."'>
                                        <button class='ass_button' name = 'setassid' style='
                                            width: 160px;
                                            background-color: #866ec7; 
                                            color: #fff;
                                            border: none;
                                            text-align: center;
                                            text-decoration: none;
                                            cursor: pointer'>
                                            <span>".$row['title']."</span>
                                            ".isMark($conn, $uid, $row['aid'])."
                                        </button>
                                    </form>
                                </li>";
                    }
                    
                }
                echo "
                <div>
                        <li class='nav-item'>

                            <button onclick='openForm3(".$row2['pid'].")' style='background-color:#866ec7 ; border: none; width:160px ; color: #FFF;' name = 'addass' style='border: none;'>
                                <span>+ Thêm</span>
                            </button>
                        </li>
                </div>";
                echo"                                
                </ul>
                </li>
              </ul>";
              echo"<div class='loginPopup3'>
              <div class='formPopup3' id='".$row2['pid']."'>
                  <form method = 'POST' class='formContainer3' action = '".addass($conn)."'>
                    <ul>
                      <li>
                          <label>Tiêu đề: </label>
                          <input type='text' name='title'required>
                      </li>
                      <br>
                      <li>
                          <label>Nội dung:</label><br><br>
                          <textarea name= 'content' required> </textarea>
                      </li>
                      <br>
                      <li>
                          <label>Thời gian kết thúc</label>
                          <input type='date'  name='ftime' required>
                      </li>
                    </ul>
                    <input type='hidden' name='pid' value='".$row2['pid']."'>
                    <input type='hidden' name='stime' value='".date('Y-m-d H:i:s')."'>
                    <Button type='submit' name='addass'>Thêm </button>
                    <button type='button' onclick='closeForm3(".$row2['pid'].")'>Đóng</button>';
                  <br>  
                </form>
                
              </div>
            </div>";
    }
    echo "
    <div>
                <button onclick='openForm2()' style='background-color:#866ec7 ; border: none; width:160px ; color: #FFF;text-align: left;font-size:18px' name = 'addpro'>
                    + Thêm 
                </button>
    </div>";
    echo "
    <div>
                <form method = 'POST' action = '".setdssv($conn)."'>
                <button style='background-color:#866ec7 ; border: none; width:160px ; color: #FFF;text-align: left;font-size:16px; margin-left:-10px' name = 'dssv'>
                    Danh sách SV 
                </button>
            </form>
    </div>";
}
function addass($conn){
    if(isset($_POST['addass'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $stime = $_POST['stime'];
        $ftime = $_POST['ftime'];
        $pid = $_POST['pid'];
        $sql = "INSERT into assignments (title, content, stime, ftime, pid ) VALUES ('$title', '$content', '$stime', '$ftime', '$pid')";
        $sql2 = "SELECT * from assignments WHERE pid = '$pid'";
        $result2 = $conn->query($sql2);
        $n = 0;
        while($row2 = $result2->fetch_assoc()){
            if(!strcmp($title, $row2['title'])){
                $n = 1;
            }
        }
        if($n ==0){
            $result = $conn->query($sql);
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }

}
function setAssignmentid($conn){

    if(isset($_POST['setassid'])){
        $_SESSION['aid'] = $_POST['aid'];
        $aid = $_SESSION['aid'];
        $uid = $_SESSION['uid'];
        $sql = "SELECT * from user_ass WHERE aid = '$aid' and uid = '$uid'";
        $result = $conn->query($sql);
            if($row = $result->fetch_assoc()){
                $_SESSION['wid']= $row['wid'];
            }
        if(isset($_SESSION['uinfo'])){
            unset($_SESSION['uinfo']);
        }
        if(isset($_SESSION['dssv'])){
            unset($_SESSION['dssv']);
        }
        unmark($conn, $uid, $aid);
    }
}
function getAssignments($conn){

    if(isset($_SESSION['aid'])){
        $aid = $_SESSION['aid'];
        $sql = "SELECT * from assignments WHERE aid = '$aid'";
        $result = $conn->query($sql);
            if($row = $result->fetch_assoc()){
                echo "<div class = 'assignment-box'>";
                echo"<h2 class='mb-4'>".$row['title']."</h2>";
                echo"<div style='font-size:12px; margin-top:-25px'>Đến hạn ".$row['ftime']."</div><br>";
                echo"Hướng dẫn";
                echo "<h5>".nl2br($row['content']."<br><br>")."</h5>";
            }
        $sql2 = "SELECT * from ass_file WHERE aid = '$aid'";
        $result = $conn->query($sql2);
        echo"Tài liệu<br>";
        while($row2 = $result->fetch_assoc()){
            echo"<a href='../model/download.php?file=".$row2['file']."'>".$row2['file']."</a><br>";
            
        }
        if($_SESSION['role']==0){
        echo"Công việc của tôi<br>";
        echo"".getmyWork($conn)."";
        }
        if($_SESSION['role']==1){
            echo "<form action='".addTL($conn)."' method='post' enctype='multipart/form-data'>
                            <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
                            <input type='file' required name='file' >
                            <button type='submit' name='addTL'> Thêm tài liệu</button>
                            </form>";
        }
        echo "</div>";

    }
}

?>
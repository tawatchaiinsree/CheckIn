<?php 
    session_start();
    require_once('../config/mysql_connect.php');
    // print_r($_POST);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `user` 
    INNER JOIN `user_type` ON user.type = user_type.id 
    WHERE username = '$username' AND password = '$password'" ;
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $_SESSION['username'] = $row['username'];
                                    $_SESSION['pname'] = $row['pname'];
                                    $_SESSION['fname'] = $row['fname'];
                                    $_SESSION['lname'] = $row['lname'];
                                    $_SESSION['position'] = $row['position'];
                                    $_SESSION['type'] = $row['title'];
                                    $_SESSION['email'] = $row['email'];
                                    $_SESSION['phone'] = $row['phone'];
                                    $_SESSION['permission'] = $row['permission'];
                                    $_SESSION['picture'] = $row['picture'];
                                    $_SESSION['session_id'] = rand(100000,999999);
                                    echo "<script>location.replace(\"/index.php\");</script>";
                                }
                            }else{
                                echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!!');window.history.back();</script>";
                            }
                        

?>
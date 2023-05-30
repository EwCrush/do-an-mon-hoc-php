<?php
    
    include("../../admin/config/config.php");
    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }

    if(isset($_POST['check'])){
        $check = $_POST['check'];
    }

    $query_login = "Select * from nguoidung where TaiKhoan = '$username' and MatKhau = '$password'";
    $stmt_login = $conn->prepare($query_login);
    $stmt_login->execute();
    $tonghang_login = $stmt_login->rowCount();
    $row = $stmt_login->fetch();
    if($tonghang_login > 0){
        $iduser = $row['MaNguoiDung'];
        $query_check_ban = "Select * from hanchenguoidung where MaNguoiDung = '$iduser' and MaHanChe = 2";
        $stmt_check_ban = $conn->prepare($query_check_ban);
        $stmt_check_ban->execute();
        $tonghang_check_ban = $stmt_check_ban->rowCount();
        $rowban = $stmt_check_ban->fetch();
        if($tonghang_check_ban < 1){
            $data = 1;
            // setcookie("TaiKhoan", $username, (time()+(60*60*24*365)), "/", "", 0);
            // setcookie("MaQuyen", $row['MaQuyen'], (time()+(60*60*24*365)), "/", "", 0);
            $_SESSION['TaiKhoan'] = $username;
            $_SESSION['MaQuyen'] = $row['MaQuyen'];
            if($check=="true"){
                setcookie("username", $username, (time()+(60*60*24*365)), "/", "", 0);
                setcookie("password", $password, (time()+(60*60*24*365)), "/", "", 0);
            }
            else{
                setcookie("username", $username, (time()-(60*60*24*365)), "/", "", 0);
                setcookie("password", $password, (time()-(60*60*24*365)), "/", "", 0);
            }
        }
        else{
            if(strtotime($rowban['ThoiGianKetThuc'])>time()){
                $data = date("G:i:s - d.m.Y", strtotime($rowban['ThoiGianKetThuc']));
            }
            else{
                $data = 1;
                // setcookie("TaiKhoan", $username, (time()+(60*60*24*365)), "/", "", 0);
                // setcookie("MaQuyen", $row['MaQuyen'], (time()+(60*60*24*365)), "/", "", 0);
                $_SESSION['TaiKhoan'] = $username;
                $_SESSION['MaQuyen'] = $row['MaQuyen'];
                if($check=="true"){
                    setcookie("username", $username, (time()+(60*60*24*365)), "/", "", 0);
                    setcookie("password", $password, (time()+(60*60*24*365)), "/", "", 0);
                }
                else{
                    setcookie("username", $username, (time()-(60*60*24*365)), "/", "", 0);
                    setcookie("password", $password, (time()-(60*60*24*365)), "/", "", 0);
                }
            }
        }
    }
    else{
        $data = 0;
    }
    

    echo json_encode($data);
    
?>
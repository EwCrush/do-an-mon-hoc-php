<?php 
    include("../../admin/config/config.php");
      
    if(isset($_POST['MaTraLoi'])){
        $MaTraLoi = $_POST['MaTraLoi'];
    }

    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if(!$username || $username == "root"){
        $data = 0;
    }

    else{
        //lay ra thong tin nguoi dung tu session
        $sql_check_user_from_ss = "SELECT * FROM nguoidung where TaiKhoan = '$username'";
        $stmt_check_user_from_ss = $conn->prepare($sql_check_user_from_ss);
        $stmt_check_user_from_ss->execute();
        $row_ss = $stmt_check_user_from_ss->fetch();
        $MaNguoiDung = $row_ss['MaNguoiDung'];
        $Quyen = $row_ss['MaQuyen'];

        //lay ra thong tin nguoi dung tu reply
        $sql_check_user_from_reply = "SELECT * FROM TraLoiBinhLuan where MaTraLoi = $MaTraLoi";
        $stmt_check_user_from_reply = $conn->prepare($sql_check_user_from_reply);
        $stmt_check_user_from_reply->execute();
        $row_reply = $stmt_check_user_from_reply->fetch();
        $MaNguoiTraLoi = $row_reply['MaNguoiDung'];

        if($MaNguoiDung == $MaNguoiTraLoi || $Quyen == 1){
            $data = 1;
            $sql_xoalike= "DELETE from thichtraloibinhluan where MaTraLoi = $MaTraLoi";
            $stmt_xoalike = $conn->prepare($sql_xoalike);
            $stmt_xoalike->execute();

            $sql_xoareply= "DELETE from traloibinhluan where MaTraLoi = $MaTraLoi";
            $stmt_xoareply = $conn->prepare($sql_xoareply);
            $stmt_xoareply->execute();
        }
        else{
            $data = 0;
        }
    }

    echo json_encode($data)

?>
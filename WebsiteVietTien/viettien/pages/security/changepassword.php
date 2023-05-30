<?php 
    include("../../admin/config/config.php");

    // if(isset($_POST['id'])){
    //     $id = $_POST['id'];
    // }

    if(isset($_POST['oldPW'])){
        $oldPW = $_POST['oldPW'];
    }

    if(isset($_POST['newPW'])){
        $newPW = $_POST['newPW'];
    }

    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if($username && $username != "root"){

        //lay ra thong tin nguoi dung tu session
        $sql_check_user_from_ss = "SELECT * FROM nguoidung where TaiKhoan = '$username'";
        $stmt_check_user_from_ss = $conn->prepare($sql_check_user_from_ss);
        $stmt_check_user_from_ss->execute();
        $row_ss = $stmt_check_user_from_ss->fetch();
        $id = $row_ss['MaNguoiDung'];

        $query_check = "SELECT * from nguoidung where MatKhau = '$oldPW' and MaNguoiDung = $id";
        $stmt_check = $conn->prepare($query_check);
        $stmt_check->execute();
        $row_check = $stmt_check->rowCount();
        if($row_check<1){
            $data = 0;
        }
        else{
            $data = 1;
            $query = "UPDATE nguoidung SET MatKhau = '$newPW' where MaNguoiDung = $id";
            $stmt = $conn->prepare($query);
            $stmt->execute();
        }

        echo json_encode($data);
    }

?>
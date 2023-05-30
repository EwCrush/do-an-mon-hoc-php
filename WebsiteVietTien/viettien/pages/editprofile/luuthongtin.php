<?php 

    include("../../admin/config/config.php");
    if(isset($_POST['Ten'])){
        $Ten = $_POST['Ten'];
    }

    if(isset($_POST['SDT'])){
        $SDT = $_POST['SDT'];
    }

    if(isset($_POST['Email'])){
        $Email = $_POST['Email'];
    }

    if(isset($_POST['DiaChi'])){
        $DiaChi = $_POST['DiaChi'];
    }

    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    //lay ra thong tin nguoi dung tu session
    $sql_check_user_from_ss = "SELECT * FROM nguoidung where TaiKhoan = '$username'";
    $stmt_check_user_from_ss = $conn->prepare($sql_check_user_from_ss);
    $stmt_check_user_from_ss->execute();
    $row_ss = $stmt_check_user_from_ss->fetch();
    $ID = $row_ss['MaNguoiDung'];

    if($DiaChi==""){
        $query = "UPDATE nguoidung SET TenNguoiDung = '$Ten', SDT = '$SDT', Email = '$Email' where MaNguoiDung = $ID";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    }
    else{
        $query = "UPDATE nguoidung SET TenNguoiDung = '$Ten', SDT = '$SDT', Email = '$Email', DiaChi = '$DiaChi' where MaNguoiDung = $ID";
        $stmt = $conn->prepare($query);
        $stmt->execute();
    }

    $data = 1;

    echo json_encode($data)

?>
<?php 
    include("../../admin/config/config.php");
    if(isset($_POST['fullname'])){
        $fullname = $_POST['fullname'];
    }

    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }

    //$query = "INSERT INTO nguoidung (TenNguoiDung, Email, TaiKhoan, MatKhau) VALUES ('$fullname', '$email', '$username', '$password')";
    $query = "Select * from nguoidung where TaiKhoan = '$username'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $tonghang = $stmt->rowCount();
    if($tonghang>0){
        $data = 0;
    }
    else{
        $data = 1;
        $query_them = "INSERT INTO nguoidung (TenNguoiDung, Email, TaiKhoan, MatKhau, Avatar, MaQuyen, TrangThai) VALUES ('$fullname', '$email', '$username', '$password', 'couple.png', 2, 'Bình thường')";
        $stmt_them = $conn->prepare($query_them);
        $stmt_them->execute();
    }

    echo json_encode($data);

?>
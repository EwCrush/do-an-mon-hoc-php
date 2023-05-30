<?php 
    include("../../admin/config/config.php");

    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }

    $query = "Select * from nguoidung where TaiKhoan = '$username' and Email = '$email'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $tonghang = $stmt->rowCount();
    
    if($tonghang>0){
        $data = 1;
        $query_change = "UPDATE nguoidung SET MatKhau = '$password' where TaiKhoan = '$username' and Email = '$email'";
        $stmt_change = $conn->prepare($query_change);
        $stmt_change->execute();
    }
    else{
        $data = 0;
    }

    //$query = "INSERT INTO nguoidung (TenNguoiDung, Email, TaiKhoan, MatKhau) VALUES ('$fullname', '$email', '$username', '$password')";
     
    //$data = 1;

    

    echo json_encode($data);

?>
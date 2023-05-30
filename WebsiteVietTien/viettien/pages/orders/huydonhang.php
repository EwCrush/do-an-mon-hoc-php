<?php 

    include("../../admin/config/config.php");

    if(isset($_POST['MaDonHang'])){
        $MaDonHang = $_POST['MaDonHang'];
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


    //lay ra thong tin gio hang can huy 
    $sql_get_order = "SELECT * FROM donhang where MaDonHang = $MaDonHang";
    $stmt_get_order = $conn->prepare($sql_get_order);
    $stmt_get_order->execute();
    $row_order = $stmt_get_order->fetch();
    $user_order = $row_order['MaNguoiDung'];
    $trangthai_order = $row_order['TrangThaiDonHang'];

    if($ID != $user_order || $trangthai_order != 'Đang chờ xác nhận'){
        $data = 0;
    }
    else{
        $data = 1;
        //update don hang
        $sql_update_order = "UPDATE donhang set TrangThaiDonHang = 'Đã hủy' where MaDonHang = $MaDonHang";
        $stmt_update_order = $conn->prepare($sql_update_order);
        $stmt_update_order->execute();
    }

    echo json_encode($data);
?>
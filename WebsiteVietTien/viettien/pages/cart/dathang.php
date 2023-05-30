<?php 
    include("../../admin/config/config.php");
    
    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    //lay ra thong tin nguoi dung tu session
    $sql_get_info = "SELECT * from nguoidung where TaiKhoan = '$username'";
    $stmt_get_info = $conn->prepare($sql_get_info);
    $stmt_get_info->execute();
    $row_get_info = $stmt_get_info->fetch();
    $MaNguoiDung = $row_get_info['MaNguoiDung'];

    //lay gio hang gan nhat cua nguoi dung
    $sql_get_cart = "SELECT * FROM donhang where MaNguoiDung = $MaNguoiDung and TrangThaiDonHang = 'Giỏ hàng' ORDER BY NgayLap DESC LIMIT 1";
    $stmt_cart = $conn->prepare($sql_get_cart);
    $stmt_cart->execute();
    $row_cart = $stmt_cart->fetch();
    $cartid = $row_cart['MaDonHang'];

    $sql_check_item_cart = "SELECT * FROM chitietdonhang where MaDonHang = $cartid";
    $stmt_check_item_cart = $conn->prepare($sql_check_item_cart);
    $stmt_check_item_cart->execute();
    $row_item_cart = $stmt_check_item_cart->fetch();
    $row_item_cart_count = $stmt_check_item_cart->rowCount();

    if($row_item_cart_count < 1){
        $data = 0;
    }

    else{
        $data = 1;
        $sql_update = "UPDATE donhang set TrangThaiDonHang = 'Đang chờ xác nhận' where MaDonHang = $cartid";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute();
    }

    echo json_encode($data)
?>
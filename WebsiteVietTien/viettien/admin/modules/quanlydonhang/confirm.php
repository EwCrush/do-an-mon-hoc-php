<?php 

    include("../../config/config.php");

    if(isset($_POST['MaDonHang'])){
        $MaDonHang = $_POST['MaDonHang'];
    }

    $sql_update = "UPDATE donhang SET TrangThaiDonHang = 'Đã xác nhận đơn hàng' where MaDonHang = $MaDonHang";
    $stmt = $conn->prepare($sql_update);
    $stmt->execute();

    $data = $MaDonHang;
    echo json_encode($data);
?>
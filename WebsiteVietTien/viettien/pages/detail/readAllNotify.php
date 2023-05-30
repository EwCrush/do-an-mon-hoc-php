<?php 

    include("../../admin/config/config.php");
      
    if(isset($_POST['MaNguoiDung'])){
        $id = $_POST['MaNguoiDung'];
    }

    $sql= "UPDATE thongbao set TrangThai = 'Đã xem' where MaNguoiDung = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

?>
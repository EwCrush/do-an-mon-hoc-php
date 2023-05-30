<?php 
    include("../../admin/config/config.php");
      
    if(isset($_POST['MaThongBao'])){
        $id = $_POST['MaThongBao'];
    }

    $sql= "UPDATE thongbao set TrangThai = 'Đã xem' where MaThongBao = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if($sql){
        $data = 1;
    }

    echo json_encode($data); 
?>
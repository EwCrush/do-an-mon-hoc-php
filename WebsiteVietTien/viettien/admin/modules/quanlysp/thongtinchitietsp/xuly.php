<?php 
ob_start();

include("./config/config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_GET['idct'])){
    $idct = $_GET['idct'];
}


$sql_xoa = "DELETE FROM chitietsp WHERE MaChiTietSP = $idct";
$stmt = $conn->prepare($sql_xoa);
$stmt->execute();
// mysqli_query($conn, $sql_xoa_loaisp_null);
  
// header("Location:index.php?action=thongtinchitiet&trang=1&id=$id&xoa=1");
echo '<script> window.location.href="index.php?action=thongtinchitiet&trang=1&id='.$id.'&xoa=1";</script>';

ob_end_flush();


?>
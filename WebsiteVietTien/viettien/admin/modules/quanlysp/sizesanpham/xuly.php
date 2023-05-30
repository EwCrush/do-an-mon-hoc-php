<?php 
ob_start();

include("./config/config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_GET['size'])){
    $size = $_GET['size'];
}


$sql_xoa_size = "DELETE FROM size WHERE SizeSP = '$size' and MaSP = $id";
$stmt = $conn->prepare($sql_xoa_size);
$stmt->execute();

echo '<script> window.location.href="index.php?action=sizesanpham&trang=1&id='.$id.'&xoa=1";</script>';


ob_end_flush();


?>
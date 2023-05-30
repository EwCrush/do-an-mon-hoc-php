<?php 
ob_start();

include("./config/config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_GET['hinhanh'])){
    $mahinhanh = $_GET['hinhanh'];
}

if(isset($_GET['filename'])){
    $filename = $_GET['filename'];
}


$sql_xoa_anh = "DELETE FROM thuvien WHERE MaHinhAnh = $mahinhanh";
$stmt = $conn->prepare($sql_xoa_anh);
$stmt->execute();
unlink('modules/quanlysp/uploads/'.$filename);

echo '<script> window.location.href="index.php?action=thuvienanh&trang=1&id='.$id.'&xoa=1";</script>';


ob_end_flush();


?>
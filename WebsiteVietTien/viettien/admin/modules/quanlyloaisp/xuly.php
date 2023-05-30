<?php 
ob_start();

include("./config/config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
}


$sql_xoa_loaisp_null = "DELETE FROM loaisp WHERE MaLoaiSP = $id";
$stmt = $conn->prepare($sql_xoa_loaisp_null);
$stmt->execute();
//mysqli_query($conn, $sql_xoa_loaisp_null);


ob_end_flush();
    
//header("Location:index.php?action=quanlyloaisanpham&trang=1&xoa=1");

echo '<meta http-equiv="refresh" content="0;url=index.php?action=quanlyloaisanpham&trang=1&xoa=1">';

?>
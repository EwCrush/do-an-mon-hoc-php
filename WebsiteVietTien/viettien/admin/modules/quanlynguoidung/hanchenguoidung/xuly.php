<?php 
ob_start();

include("./config/config.php");

if(isset($_GET['idnguoidung'])){
    $idnguoidung = $_GET['idnguoidung'];
}

if(isset($_GET['idhanche'])){
    $idhanche = $_GET['idhanche'];
}


$sql_xoa = "DELETE FROM hanchenguoidung WHERE manguoidung = $idnguoidung and mahanche = $idhanche";
$stmt = $conn->prepare($sql_xoa);
$stmt->execute();
//mysqli_query($conn, $sql_xoa_loaisp_null);


ob_end_flush();
    
//header("Location:index.php?action=quanlyloaisanpham&trang=1&xoa=1");

echo '<meta http-equiv="refresh" content="0;url=index.php?action=hanchenguoidung&id='.$idnguoidung.'&trang=1&xoa=1">';

?>
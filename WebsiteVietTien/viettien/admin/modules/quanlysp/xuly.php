<?php 
ob_start();

include("./config/config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_GET['action'])){
    $act = $_GET['action'];
}

if(isset($_GET['hinhanh'])){
    $hinhanh = $_GET['hinhanh'];
}

if(isset($_GET['trang'])){
    $trang = $_GET['trang'];
}

if($act == "xoasanpham"){
    //xoa size
    $sql_xoa_size = "DELETE FROM size WHERE MaSP = $id";
    $stmt_size = $conn->prepare($sql_xoa_size);
    $stmt_size->execute();
    //xoa anh
    $ds_anh = "SELECT * FROM thuvien where MaSP = $id";
    $stmt_dsanh =  $conn->prepare($ds_anh);
    $stmt_dsanh->execute();
    while($row = $stmt_dsanh->fetch()){
        unlink('modules/quanlysp/uploads/'.$row['HinhAnh']);
    }
    $sql_xoa_anh = "DELETE FROM thuvien WHERE MaSP = $id";
    $stmt_anh = $conn->prepare($sql_xoa_anh);
    $stmt_anh->execute();
    //xoa chi tiet san pham
    $sql_xoa_ctsp = "DELETE FROM chitietsp WHERE MaSP = $id";
    $stmt_ctsp = $conn->prepare($sql_xoa_ctsp);
    $stmt_ctsp->execute();
    //xoa san pham
    $sql_xoa_sp_null = "DELETE FROM sanpham WHERE MaSP = $id";
    $stmt_sp = $conn->prepare($sql_xoa_sp_null);
    $stmt_sp->execute();
    unlink('modules/quanlysp/uploads/'.$hinhanh);
    echo '<script> window.location.href="index.php?action=quanlysanpham&trang=1&xoa=1";</script>';
}

elseif($act=="ansanpham"){
    $sql_an_sp = "UPDATE sanpham set TrangThai = 'Ẩn' where MaSP = $id";
    $stmt_an = $conn->prepare($sql_an_sp);
    $stmt_an->execute();
    //mysqli_query($conn, $sql_an_sp);
    echo '<script> window.location.href="index.php?action=quanlysanpham&trang='.$trang.'";</script>';
    
}
else{
    $sql_kichhoat_sp = "UPDATE sanpham set TrangThai = 'Kích hoạt' where MaSP = $id";
    // mysqli_query($conn, $sql_kichhoat_sp);
    $stmt_kh = $conn->prepare($sql_kichhoat_sp);
    $stmt_kh->execute();
    echo '<script> window.location.href="index.php?action=quanlysanpham&trang='.$trang.'";</script>';
}

    
//header("Location:index.php?action=quanlyloaisanpham&trang=1&trangthai=1");
ob_end_flush();


?>

<h1>hello</h1>


<?php 
ob_start();

if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
}
else $keyword = '';

    header("Location:../../index.php?action=quanlynguoidung&trang=1&keyword=$keyword");
    ob_end_flush();
?>
<?php 
    // $currentpage = "";
    // $currentpage = $_GET["action"];
    ob_start();
    if(isset($_GET['action'])){
        $currentpage = $_GET['action'];
    }
    else{
        $currentpage = '';
    }
    ob_end_flush();
?>
<div class="grid__column-2">
                    <nav class="category">
                            <h3 class="category-heading">
                                <i class="category-heading-icon fa-solid fa-list"></i>
                                DANH MỤC QUẢN LÝ
                            </h3>
                            <!-- category-item-active -->
                            <ul class="category-list">
                                <li class="category-item <?php ob_start(); echo ($currentpage == 'quanlyloaisanpham' || $currentpage == 'timkiemloaisanpham' || $currentpage == 'xoaloaisanpham' || $currentpage == 'themloaisanpham' || $currentpage == 'sualoaisanpham') ? 'category-item-active':''; ob_end_flush();?>">
                                    <a href="index.php?action=quanlyloaisanpham&trang=1" class="category-item-link">
                                        <i class="fa-sharp fa-solid fa-person-circle-question"></i>
                                        LOẠI SẢN PHẨM
                                    </a>
                                </li>
                                <li class="category-item <?php ob_start(); echo ($currentpage == 'thuvienanh' || $currentpage == 'themanh' || $currentpage == 'suaanh' || $currentpage == 'suasize' || $currentpage == 'themsize' || $currentpage == 'sizesanpham' || $currentpage == 'suathongtinchitiet' || $currentpage == 'themthongtinchitiet' || $currentpage == 'quanlysanpham' || $currentpage == 'thongtinthem' || $currentpage == 'thongtinchitiet' || $currentpage == 'themsanpham' || $currentpage == 'suasanpham') ? 'category-item-active':''; ob_end_flush();?>">                                    
                                    <a href="index.php?action=quanlysanpham&trang=1" class="category-item-link">
                                        <i class="fa-solid fa-shirt"></i>
                                        SẢN PHẨM
                                    </a>
                                </li>
                                <li class="category-item <?php ob_start(); echo ($currentpage == 'suahanche' || $currentpage == 'themhanche' || $currentpage == 'quanlynguoidung' || $currentpage == 'hanchenguoidung') ? 'category-item-active':''; ob_end_flush();?>">
                                    <a href="index.php?action=quanlynguoidung&trang=1" class="category-item-link">
                                        <i class="fa-solid fa-user-group"></i>
                                        NGƯỜI DÙNG
                                    </a>
                                </li>
                                <!-- <li class="category-item">
                                    <a href="index.php?action=quanlynguoidung&trang=1" class="category-item-link">
                                        <i class="fa-brands fa-shopify"></i>
                                        VOUCHER
                                    </a>
                                </li> -->
                                <li class="category-item <?php ob_start(); echo ($currentpage == 'capnhatdonhang' || $currentpage == 'quanlydonhang' || $currentpage == 'thongtinthemdonhang' || $currentpage == 'sanphamgiohang' || $currentpage == 'xacnhandonhang') ? 'category-item-active':''; ob_end_flush();?>">
                                    <a href="index.php?action=quanlydonhang&trang=1" class="category-item-link">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                        ĐƠN HÀNG
                                    </a>
                                </li>
                                <li class="category-item <?php ob_start(); echo ($currentpage == 'quanlybinhluan' || $currentpage == 'quanlyphanhoi') ? 'category-item-active':''; ob_end_flush();?>">
                                    <a href="index.php?action=quanlybinhluan&trang=1" class="category-item-link">
                                        <i class="fa-sharp fa-solid fa-comments"></i>
                                        BÌNH LUẬN
                                    </a>
                                </li>
                                <li class="category-item <?php ob_start(); echo ($currentpage == 'quanlybaocao') ? 'category-item-active':''; ob_end_flush();?>">
                                    <a href="index.php?action=quanlybinhluan&trang=1" class="category-item-link">
                                        <i class="fa-solid fa-flag"></i>
                                        BÁO CÁO
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
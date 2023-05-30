<?php 
    if(isset($_GET['danhmuc'])){
        $danhmuc = $_GET['danhmuc'];
    }
    else{
        $danhmuc = '';
    }
?>

<nav class="category">
    <h3 class="category-heading">
        <i class="category-heading-icon fa-solid fa-list"></i>
        DANH MỤC
    </h3>
    <ul class="category-list">
        <li class="category-item <?php if($danhmuc == "tatcasanpham") echo 'category-item-active' ?>">
            <a href="index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1" class="category-item-link">TẤT CẢ SẢN PHẨM</a>
        </li>
        
        <?php
            $sql_danhsach_loaisp = "SELECT MaLoaiSP, TenLoaiSP FROM loaisp";
            $stmt = $conn->prepare($sql_danhsach_loaisp);
            $stmt->execute();
            $i = 0;
            while($row = $stmt->fetch()){
                $i++;
        ?>
            <li class="category-item <?php if($danhmuc == $row['MaLoaiSP']) echo 'category-item-active' ?>">
                <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $row['MaLoaiSP'] ?>&filter=tatca&order=desc&trang=1" class="category-item-link"><?php echo mb_strtoupper($row['TenLoaiSP'], 'UTF-8') ?></a>
            </li>
            
        <?php
            }
        ?>
    </ul>
</nav>
<?php 
    if(isset($_GET['danhmuc'])){
        $id = $_GET['danhmuc'];
    }
    else{
        $id = '';
    } 
    
    if($id!='' && $id!='tatcasanpham'){
        $sql_danhsach_loaisp = "select * from loaisp where maloaisp = $id";
        $stmt = $conn->prepare($sql_danhsach_loaisp);
        $stmt->execute();
        $row = $stmt->fetch();
        $tenloaisp = $row['TenLoaiSP'];
    }
    
?>

<div class="app_container">
    <div class="grid">
    <div class="maps">
        <a href="" class="maps-link">
            <i class="fa-solid fa-house"></i>
            Trang chủ
        </a>
        <span class="maps-link current-link"><?php if($id!=''&&$id!='tatcasanpham') echo '<i class="current-link-none-css fa-solid fa-caret-right"></i> '.$tenloaisp; elseif($id=='tatcasanpham') echo '<i class="current-link-none-css fa-solid fa-caret-right"></i>'.' Tất cả sản phẩm' ?></a>
        
    </div>
        <div class="grid__row">
            <div class="grid__column-2">
                <?php 
                    include("pages/sidebar/sidebar.php");
                ?>
            </div>          
                <?php
                    if(isset($_GET['action'])){
                        $act = $_GET['action'];
                    }
                    else{
                        $act = '';
                    }
                    if($act=="danhsachsanpham"){
                        if(isset($_GET['danhmuc'])){
                            $danhmuc = $_GET['danhmuc'];
                        }
                        if($danhmuc=='tatcasanpham'){
                            include("pages/product/allproducts.php");
                        }
                        else{
                            include("pages/product/product.php");
                        }
                        
                    }
                    
                ?>
        </div>
    </div>
</div>
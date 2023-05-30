<?php   
    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
    }
    else $keyword = '';

    if(isset($_GET['danhmuc'])){
        $danhmuc = $_GET['danhmuc'];
    }
    else{
        $danhmuc = '1';
    }
    if(isset($_GET['order'])){
        $order = $_GET['order'];
    }
    else{
        $order = 'desc';
    }

    if(isset($_GET['filter'])){
        $filter = $_GET['filter'];
    }
    else{
        $filter = 'tatca';
    }
    if($filter=='danggiamgia'){
        $filter_query = "AND giaban != giasale";
    }
    else{
        $filter_query = '';
    }

    $test = "AND giaban != giasale";

    $tranghientai = 0;
    $tonghang = 0;
    $trangcuoi = "";
    // $tranghientai = $_GET['trang'];
    if(isset($_GET['trang'])){
        $tranghientai = $_GET['trang'];
    }
    else{
        $trang = 1;
    }
    $offset = ($tranghientai-1)*10;
    $trangtiep = 0;
    $trangtruoc = 0;
    
    $sql_danhsach_sp_limit = "SELECT * from sanpham where MaLoaiSP = $danhmuc and TrangThai = 'Kích hoạt' $filter_query and TenSP like '%$keyword%' ORDER BY giasale $order";
    $stmt_limit = $conn->prepare($sql_danhsach_sp_limit);
    $stmt_limit->execute();
    $tonghang = $stmt_limit->rowCount();
    $trangcuoi = ceil($tonghang/10);

    if($tranghientai==1){
        $trangtruoc=$trangcuoi;
    }
    else $trangtruoc=$tranghientai-1;


    if($tranghientai==$trangcuoi){
        $trangtiep=1;
    }
    else $trangtiep=$tranghientai+1;
?>
<div class="grid__column-10">
    <div class="home-filter">
        <span class="home-filter-label">Sắp xếp theo</span>
        <ul class="home-filter-list">
            <li class="home-filter-item">
                <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $danhmuc ?>&filter=tatca&order=<?php echo $order ?>&trang=1&keyword=<?php echo $keyword ?>" class="home-filter-btn <?php if($filter=="tatca") echo 'home-filter-list-selected'?>">Tất cả</a>
            </li>
            <!-- <li class="home-filter-item">
                <a href="" class="home-filter-btn">Mới nhất</a>
            </li> -->
            <li class="home-filter-item">
                <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $danhmuc ?>&filter=danggiamgia&order=<?php echo $order ?>&trang=1&keyword=<?php echo $keyword ?>" class="home-filter-btn <?php if($filter=="danggiamgia") echo 'home-filter-list-selected'?>">Đang giảm giá</a>
            </li>
        </ul>
        <!-- <button class="btn home-filter-btn btn-primary">Tất cả</button>
        <button class="btn home-filter-btn">Mới nhất</button>
        <button class="btn home-filter-btn">Đang giảm giá</button> -->
        <div class="select-price">
            <span class="select-price-label">Giá</span>
            <i class="select-price-icon fa-solid fa-angle-down"></i>
            <div class="select-price-option">
                <ul class="select-price-list">
                    <li class="select-price-item">
                        <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $danhmuc ?>&filter=<?php echo $filter ?>&order=desc&trang=<?php echo $tranghientai ?>&keyword=<?php echo $keyword ?>" class="select-price-item-link <?php if($order=='desc') echo 'price-selected' ?>">Giá cao đến thấp</a>
                        <i class="select-price-item-link-icon fa-solid fa-check"></i>
                    </li>
                    <li class="select-price-item">
                        <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $danhmuc ?>&filter=<?php echo $filter ?>&order=asc&trang=<?php echo $tranghientai ?>&keyword=<?php echo $keyword ?>" class="select-price-item-link <?php if($order=='asc') echo 'price-selected' ?>">Giá thấp đến cao</a>
                        <i class="select-price-item-link-icon fa-solid fa-check"></i>
                    </li>
                </ul>
            </div>
        </div>
        <div class="select-page">
            <div class="select-page-num">
                <span class="current-page"><?php echo $tranghientai?></span>/<span class="last-page"><?php echo $trangcuoi ?></span>
            </div>
            <div class="page-control">
            <!-- page-control-btn-disable -->
                <a href="index.php?action=danhsachsanpham&filter=<?php echo $filter ?>&danhmuc=<?php echo $danhmuc ?>&order=<?php echo $order ?>&trang=<?php echo $trangtruoc ?>&keyword=<?php echo $keyword ?>" class="page-control-btn">
                    <i class="select-page-icon fa-solid fa-angle-left"></i>
                </a>
                <a href="index.php?action=danhsachsanpham&filter=<?php echo $filter ?>&danhmuc=<?php echo $danhmuc ?>&order=<?php echo $order ?>&trang=<?php echo $trangtiep ?>&keyword=<?php echo $keyword ?>" class="page-control-btn">
                    <i class="select-page-icon fa-solid fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="home-product">
        <div class="grid__row">
        <?php   
            $sql_danhsach_sp = "SELECT * from sanpham where MaLoaiSP = $danhmuc and TrangThai = 'Kích hoạt' $filter_query and TenSP like '%$keyword%' ORDER BY giasale $order LIMIT 10 OFFSET $offset";
            $stmt = $conn->prepare($sql_danhsach_sp);
            $stmt->execute();
            if($stmt){
            while($row = $stmt->fetch()){
        ?>
            <div class="grid_column-10-2">
                <!-- product item -->
                <div class="home-product-item">
                    <a href="index.php?detail=<?php echo $row['MaSP']?>" class="home-product-item-link">
                        <div class="home-product-item-img" style="background-image: url(/admin/modules/quanlysp/uploads/<?php echo $row['HinhAnh'] ?>);">
                        </div>
                        <h4 class="home-product-item-name"><?php echo $row['TenSP'] ?></h4>
                        <div class="home-product-item-price">
                            <span class="home-product-item-new-price <?php if($row['GiaBan']==$row['GiaSale']) echo 'display_none'?>"><?php echo number_format($row['GiaSale'],0,',','.').'₫' ?></span>
                            <span class="home-product-item-old-price <?php if($row['GiaBan']==$row['GiaSale']) echo 'price-without-sale'?>"><?php echo number_format($row['GiaBan'],0,',','.').'₫' ?></span>
                        </div>
                        <div class="home-product-item-fav <?php if($row['GiaBan']==$row['GiaSale']) echo 'display_none'?>">
                            <i class="home-product-item-fav-icon fa-sharp fa-solid fa-burst"></i>
                            <span class="home-product-item-fav-label">SALE OFF <?php echo ceil(($row['GiaBan']-$row['GiaSale'])/$row['GiaBan']*100) ?>%</span>
                        </div>
                    </a>
                </div>
            </div>
            <?php 
                }
            }
            ?>
        </div>
    </div>

    <ul class="home-pagination mainpage-pagination">
        <li class="home-pagination-item">
            <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $danhmuc ?>&filter=<?php echo $filter ?>&order=<?php echo $order ?>&trang=<?php echo $trangtruoc ?>&keyword=<?php echo $keyword ?>" class="home-pagination-item-link">
                <i class="home-pagination-item-icon fa-solid fa-angle-left"></i>
            </a>
        </li>
        <?php 
            for($i=1; $i<=$trangcuoi;$i++){     
        ?>  
            <li class="home-pagination-item  <?php if($tranghientai == $i) echo 'home-pagination-item-active' ?>">
                <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $danhmuc ?>&filter=<?php echo $filter ?>&order=<?php echo $order ?>&trang=<?php echo $i ?>&keyword=<?php echo $keyword ?>" class="home-pagination-item-link">
                    <?php echo $i ?>
                </a>
            </li>
        <?php      
            }
        ?>
        
        <li class="home-pagination-item">
            <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $danhmuc ?>&filter=<?php echo $filter ?>&order=<?php echo $order ?>&trang=<?php echo $trangtiep ?>&keyword=<?php echo $keyword ?>" class="home-pagination-item-link">
                <i class="home-pagination-item-icon fa-solid fa-angle-right"></i>
            </a>
        </li>
    </ul>
</div>
<?php 
    ob_start();
    include("./config/config.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    if(isset($_GET['trang'])){
        $tranghientai = $_GET['trang'];
    }
    else{
        $tranghientai = 1;
    }

    $tonghang = 0;
    $trangcuoi = "";
    $offset = ($tranghientai-1)*10;
    $trangtiep = 0;
    $trangtruoc = 0;

    $sql_danhsach_loaisp_limit = "SELECT * from chitietdonhang where MaDonHang = $id";
    $stmt_limit = $conn->prepare($sql_danhsach_loaisp_limit);
    $stmt_limit->execute();
    $tonghang = $stmt_limit->rowCount();
    
    $sql_getback = "SELECT * from donhang where MaDonHang = $id and TrangThaiDonHang = 'Đang chờ xác nhận'";
    $stmt_getback = $conn->prepare($sql_getback);
    $stmt_getback->execute();
    $rowcheck = $stmt_getback->rowCount();

    if($rowcheck>0){
        $back = "xacnhandonhang";
    }
    else{
        $back = "quanlydonhang";
    }

   
    $trangcuoi = ceil($tonghang/10);

    if($tranghientai==1){
        $trangtruoc=$trangcuoi;
    }
    else $trangtruoc=$tranghientai-1;


    if($tranghientai==$trangcuoi){
        $trangtiep=1;
    }
    else $trangtiep=$tranghientai+1;

    ob_end_flush();
?>
<div class="grid__column-10">
                        <div class="content">
                        <div class="heading-content">
                                <div class="heading-content-back">
                                    <div class="pagination-other-features">
                                        <a href="index.php?action=<?php echo $back ?>&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Danh sách sản phẩm trong đơn hàng <?php echo $id ?></div>
                                </div>
                            </div> 
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_loaisp = "SELECT madonhang, hinhanh, tensp, size, dongia, soluongdatmua, thanhtien from chitietdonhang, sanpham where sanpham.masp = chitietdonhang.masp and madonhang = $id LIMIT 10 OFFSET $offset";
                                $stmt = $conn->prepare($sql_danhsach_loaisp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-40 table-heading-content">Tên sản phẩm</th>
                                    <th class="row-10 table-heading-content">Hình ảnh</th>
                                    <th class="row-10 table-heading-content">Size</th>
                                    <th class="row-15 table-heading-content">Đơn giá</th>
                                    <th class="row-10 table-heading-content">Số lượng</th>
                                    <th class="row-15 table-heading-content">Thành tiền</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content">
                                    <td class="row-40 table_info"><?php echo $row['tensp'] ?></td>
                                    <td class="row-10 table_info"><img class="table-content-img" src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>"></td>
                                    <td class="row-10 table_info"><?php echo $row['size'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['dongia'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['soluongdatmua'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['thanhtien'] ?></td>
                                </tr>
                                <?php
                                    
                                    } 
                                ?>
                            </table>
                            <div class="pagination-wrapper pagination-wrapper-no-features">
                                <div class="pagination">
                                    <a href="index.php?action=sanphamgiohang&id=<?php echo $id ?>&trang=<?php echo $trangtruoc?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=sanphamgiohang&id=<?php echo $id ?>&trang=<?php echo $trangtiep ?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-right" title="Trang tiếp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
<?php 
    ob_start();
    include("./config/config.php");

    $tranghientai = 0;
    $tonghang = 0;
    $trangcuoi = "";
    $tranghientai = $_GET['trang'];
    $offset = ($tranghientai-1)*10;
    $trangtiep = 0;
    $trangtruoc = 0;

    $sql_danhsach_donhang_limit = "SELECT * from donhang where TrangThaiDonHang != 'Giỏ hàng' and TrangThaiDonHang != 'Đang chờ xác nhận'";
    $stmt_limit = $conn->prepare($sql_danhsach_donhang_limit);
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

    $sql_danhsach_donhang_check = "SELECT * from donhang where TrangThaiDonHang = 'Đang chờ xác nhận'";
    $stmt_check = $conn->prepare($sql_danhsach_donhang_check);
    $stmt_check->execute();
    $tonghang_check = $stmt_check->rowCount();

    // header("Location:index.php?action=quanlyloaisanpham&trang=1");
    ob_end_flush();

    
    
?>
<div class="grid__column-10">
                        <div class="content">
                            <div class="heading-content heading-content-has-notify">
                                <a href="index.php?action=xacnhandonhang&trang=<?php echo $trangtruoc?>" class="bill-need-to-check">
                                    <i class="pagination-item fa-solid fa-bell" title="Trang trước"></i>
                                    <span class="bill-need-to-check-count <?php if($tonghang_check==0) echo "no-bill-need-to-check" ?>"><?php echo $tonghang_check ?></span>
                                </a>
                                <div class="heading-content-text">Danh sách đơn hàng</div>
                            </div>
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_loaisp = "SELECT madonhang, donhang.manguoidung, tennguoidung, trangthaidonhang, ngaylap, phiship, tongtien from donhang, nguoidung where donhang.manguoidung = nguoidung.manguoidung and trangthaidonhang != 'Giỏ hàng' and TrangThaiDonHang != 'Đang chờ xác nhận' order by ngaylap desc LIMIT 10 OFFSET $offset";
                                $stmt = $conn->prepare($sql_danhsach_loaisp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-10 table-heading-content">Mã đơn hàng</th>
                                    <th class="row-20 table-heading-content">Tên người dùng</th>
                                    <th class="row-15 table-heading-content">Trạng thái</th>
                                    <th class="row-15 table-heading-content">Ngày lập</th>
                                    <th class="row-10 table-heading-content">Phí ship</th>
                                    <th class="row-15 table-heading-content">Tổng tiền</th>
                                    <th class="row-15 table-heading-content">Thao tác</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content">
                                    <td class="row-10 table_info"><?php echo $row['madonhang'] ?></td>
                                    <td class="row-20 table_info"><?php echo $row['tennguoidung'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['trangthaidonhang'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['ngaylap'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['phiship'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['tongtien'] ?></td>
                                    <td class="row-15 table_info">
                                        <a href='index.php?action=capnhatdonhang&id=<?php echo $row["madonhang"]?>' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-pen' title='Sửa'></i>
                                        </a>
                                        <a href='index.php?action=thongtinthemdonhang&id=<?php echo $row["madonhang"]?>' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-circle-info' title='Thông tin thêm về đơn hàng'></i>
                                        </a>
                                        <a href='index.php?action=sanphamgiohang&id=<?php echo $row["madonhang"]?>' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-brands fa-shopify' title='Xem giỏ hàng'></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    
                                    } 
                                ?>
                            </table>
                            <div class="pagination-wrapper pagination-wrapper-no-features">
                                <div class="pagination">
                                    <a href="index.php?action=quanlydonhang&trang=<?php echo $trangtruoc?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=quanlydonhang&trang=<?php echo $trangtiep ?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-right" title="Trang tiếp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
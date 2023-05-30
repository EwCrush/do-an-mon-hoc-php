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

    $sql_danhsach_donhang_limit = "SELECT * from donhang where TrangThaiDonHang = 'Đang chờ xác nhận'";
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

    // header("Location:index.php?action=quanlyloaisanpham&trang=1");
    ob_end_flush();

    
    
?>
<div class="grid__column-10">
                        <div class="content">
                            <div class="heading-content heading-content-has-notify">
                                <div class="pagination-other-features">
                                    <a href="index.php?action=quanlydonhang&trang=1" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                    </a>
                                </div>
                                <div class="heading-content-text">Danh sách đơn hàng đang chờ xác nhận</div>
                            </div>
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_loaisp = "SELECT madonhang, donhang.manguoidung, tennguoidung, trangthaidonhang, ngaylap, phiship, tongtien from donhang, nguoidung where donhang.manguoidung = nguoidung.manguoidung and TrangThaiDonHang = 'Đang chờ xác nhận' order by ngaylap desc LIMIT 10 OFFSET $offset";
                                $stmt = $conn->prepare($sql_danhsach_loaisp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-10 table-heading-content">Mã đơn hàng</th>
                                    <th class="row-20 table-heading-content">Tên người dùng</th>
                                    <th class="row-20 table-heading-content">Ngày lập</th>
                                    <th class="row-10 table-heading-content">Phí ship</th>
                                    <th class="row-15 table-heading-content">Tổng tiền</th>
                                    <th class="row-15 table-heading-content">Xác nhận</th>
                                    <th class="row-10 table-heading-content">Xem thêm</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content" id="check-bill-<?php echo $row['madonhang'] ?>">
                                    <td class="row-10 table_info"><?php echo $row['madonhang'] ?></td>
                                    <td class="row-20 table_info"><?php echo $row['tennguoidung'] ?></td>
                                    <td class="row-20 table_info"><?php echo $row['ngaylap'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['phiship'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['tongtien'] ?></td>
                                    <td class="row-10 table_info">
                                        <a href='javascript:XacNhanDonHang(<?php echo $row["madonhang"]?>)' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-circle-info' title='Thông tin thêm về đơn hàng'></i>
                                        </a>
                                    </td>
                                    <td class="row-10 table_info">
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
                                    <a href="index.php?action=xacnhandonhang&trang=<?php echo $trangtruoc?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=xacnhandonhang&trang=<?php echo $trangtiep ?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-right" title="Trang tiếp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

<script>
    function XacNhanDonHang(MaDonHang){
        $(`#check-bill-${MaDonHang}`).slideUp()
        $.post("/admin/modules/quanlydonhang/confirm.php", {
            "MaDonHang": MaDonHang
        })
        swal({
            title: "Success!",
            text: "Xác nhận đơn hàng thành công!",
            icon: "success",
        });
    }
</script>
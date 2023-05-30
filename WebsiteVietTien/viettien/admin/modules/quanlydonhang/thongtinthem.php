<?php 
    ob_start();
    include("./config/config.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

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
                                    <div class="heading-content-text">Thông tin thêm về đơn hàng <?php echo $id ?></div>
                                </div>
                            </div> 
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_thongtinthem_donhang = "SELECT * from donhang where MaDonHang = $id";
                                $stmt = $conn->prepare($sql_danhsach_thongtinthem_donhang);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-15 table-heading-content">Tên người nhận</th>
                                    <th class="row-15 table-heading-content">SDT</th>
                                    <th class="row-45 table-heading-content">Địa chỉ giao hàng</th>
                                    <th class="row-25 table-heading-content">Note</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content">
                                    <td class="row-15 table_info"><?php echo $row['TenNguoiNhan'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['SDTNhanHang'] ?></td>
                                    <td class="row-45 table_info"><?php echo $row['DiaChiGiaoHang'] ?></td>
                                    <td class="row-25 table_info"><?php echo $row['Note'] ?></td>
                                </tr>
                                <?php
                                    
                                    } 
                                ?>
                            </table>
                        </div>
                    </div>
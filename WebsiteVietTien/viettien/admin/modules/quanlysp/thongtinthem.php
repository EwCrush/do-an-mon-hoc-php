<?php 
    ob_start();
    include("./config/config.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $sql_tensp = "SELECT TenSP from SanPham where MaSP = $id";
    $stmt_tensp = $conn->prepare($sql_tensp);
    $stmt_tensp->execute();
    $rowten = $stmt_tensp->fetch();
    $tensp = $rowten["TenSP"];
    // header("Location:index.php?action=quanlyloaisanpham&trang=1");
    ob_end_flush();

    
    
?>
<div class="grid__column-10">
                        <div class="content">
                            <div class="heading-content">
                                <div class="heading-content-back">
                                    <div class="pagination-other-features">
                                        <a href="index.php?action=quanlysanpham&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thông tin thêm về sản phẩm <?php echo $tensp?></div>
                                </div>
                            </div> 
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_thongtinthem_sp = "SELECT * from sanpham where MaSP = $id";
                                //$query_danhsach_thongtinthem_sp = mysqli_query($conn, $sql_danhsach_thongtinthem_sp); 
                                $stmt = $conn->prepare($sql_danhsach_thongtinthem_sp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-10 table-heading-content">Màu sắc</th>
                                    <th class="row-25 table-heading-content">Chất liệu</th>
                                    <th class="row-20 table-heading-content">Kiểu dáng</th>
                                    <th class="row-10 table-heading-content">Họa tiết</th>
                                    <th class="row-10 table-heading-content">Ngày tạo</th>
                                    <th class="row-10 table-heading-content">Ngày cập nhật</th>
                                    <th class="row-15 table-heading-content">Xem thêm</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content">
                                    <td class="row-10 table_info"><?php echo $row['MauSac'] ?></td>
                                    <td class="row-25 table_info"><?php echo $row['ChatLieu'] ?></td>
                                    <td class="row-20 table_info"><?php echo $row['KieuDang'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['HoaTiet'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['NgayTao'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['NgayCapNhat'] ?></td>
                                    <td class="row-15 table_info">
                                        <a href='index.php?action=sizesanpham&trang=1&id=<?php echo $row["MaSP"]?>' class='btn-delete tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-solid fa-ruler' title='Size sản phẩm'></i>
                                        </a>
                                        <a href='index.php?action=thuvienanh&trang=1&id=<?php echo $row["MaSP"]?>' class='btn-delete tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-solid fa-images' title='Thư viện ảnh'></i>
                                        </a>
                                        <a href='index.php?action=thongtinchitiet&trang=1&id=<?php echo $row["MaSP"]?>' class='btn-delete tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-circle-question' title='Xem chi tiết'></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    
                                    } 
                                ?>
                            </table>
                        </div>
                    </div>
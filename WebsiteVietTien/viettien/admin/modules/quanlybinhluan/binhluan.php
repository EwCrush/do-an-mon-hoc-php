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

    $sql_danhsach_binhluan_limit = "SELECT * from binhluan";
    $stmt_limit = $conn->prepare($sql_danhsach_binhluan_limit);
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
                            <div class="heading-content">
                                <div class="heading-content-text no-icon-link">Danh sách bình luận</div>
                            </div>
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_loaisp = "SELECT maquyen, mabinhluan, noidungbinhluan, ngaybinhluan, binhluan.masp, binhluan.manguoidung, tennguoidung, tensp from binhluan, sanpham, nguoidung where binhluan.masp = sanpham.masp and binhluan.manguoidung = nguoidung.manguoidung order by masp asc, ngaybinhluan desc LIMIT 10 OFFSET $offset";
                                $stmt = $conn->prepare($sql_danhsach_loaisp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-15 table-heading-content">Người dùng</th>
                                    <th class="row-60 table-heading-content">Nội dung</th>
                                    <th class="row-15 table-heading-content">Thời gian</th>
                                    <th class="row-10 table-heading-content">Thao tác</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content" id='comment-manager-<?php echo $row['mabinhluan']?>'>
                                    <td class="row-15 table_info"><a href="<?php if($row['maquyen']!='1') echo "index.php?action=hanchenguoidung&id=".$row["manguoidung"]."&trang=1"; else echo "" ?>" class="go-to-block-user"><?php echo $row['tennguoidung'] ?></a></td>
                                    <td class="row-60 table_info"><?php echo $row['noidungbinhluan'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['ngaybinhluan'] ?></td>
                                    <td class="row-10 table_info">
                                        <a href='index.php?action=quanlyphanhoi&id=<?php echo $row["mabinhluan"]?>' class='btn-delete tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-solid fa-reply' title='Xem phản hồi'></i>
                                        </a>
                                        <a href='javascript:QuanLyBinhLuan(<?php echo $row["mabinhluan"]?>)' class='btn-delete tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-trash' title='Xóa'></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    
                                    } 
                                ?>
                            </table>
                            <div class="pagination-wrapper pagination-wrapper-no-features">
                                <div class="pagination">
                                    <a href="index.php?action=quanlybinhluan&trang=<?php echo $trangtruoc?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=quanlybinhluan&trang=<?php echo $trangtiep ?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-right" title="Trang tiếp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

<script>
    function QuanLyBinhLuan(MaBinhLuan){
        swal({
            title: "Bạn muốn tiếp tục chứ?",
            text: "Dữ liệu sẽ bị xóa vĩnh viễn!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((result) => {
                $(`#comment-manager-${MaBinhLuan}`).slideUp()
                $.post("/admin/modules/quanlybinhluan/xoabinhluan.php", {
                    "MaBinhLuan": MaBinhLuan
                });
                swal({
                    title: "Success!",
                    text: "Xác nhận đơn hàng thành công!",
                    icon: "success",
                });
            });
    }
</script>
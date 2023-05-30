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

    $sql_danhsach_binhluan_limit = "SELECT * from traloibinhluan where MaBinhLuan = $id";
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
                                <div class="heading-content-back">
                                    <div class="pagination-other-features">
                                        <a href="index.php?action=quanlybinhluan&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Danh sách phản hồi của bình luận <?php echo $id ?></div>
                                </div>
                            </div> 
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_loaisp = "SELECT traloibinhluan.manguoidung, matraloi, maquyen, noidungtraloi, ngaytraloi, traloibinhluan.mabinhluan, tennguoidung from traloibinhluan, binhluan, nguoidung where traloibinhluan.manguoidung = nguoidung.manguoidung and traloibinhluan.mabinhluan = binhluan.mabinhluan and traloibinhluan.mabinhluan = $id LIMIT 10 OFFSET $offset";
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
                                <tr class="table-row-content" id='reply-manager-<?php echo $row['matraloi']?>'>
                                    <td class="row-15 table_info"><a href="<?php if($row['maquyen']!='1') echo "index.php?action=hanchenguoidung&id=".$row["manguoidung"]."&trang=1"; else echo "" ?>" class="go-to-block-user"><?php echo $row['tennguoidung'] ?></a></td>
                                    <td class="row-60 table_info"><?php echo $row['noidungtraloi'] ?></td>
                                    <td class="row-15 table_info"><?php echo $row['ngaytraloi'] ?></td>
                                    <td class="row-10 table_info">
                                        <a href='javascript:QuanLyPhanHoi(<?php echo $row["matraloi"]?>)' class='btn-delete tb_thaotac_link'>
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
                                    <a href="index.php?action=quanlyphanhoi&id=<?php echo $id ?>&trang=<?php echo $trangtruoc?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=quanlyphanhoi&id=<?php echo $id ?>&trang=<?php echo $trangtiep ?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-right" title="Trang tiếp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

<script>
    function QuanLyPhanHoi(MaTraLoi){
        swal({
            title: "Bạn muốn tiếp tục chứ?",
            text: "Dữ liệu sẽ bị xóa vĩnh viễn!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((result) => {
                $(`#reply-manager-${MaTraLoi}`).slideUp()
                $.post("/admin/modules/quanlybinhluan/xoaphanhoi.php", {
                    "MaTraLoi": MaTraLoi
                });
                swal({
                    title: "Success!",
                    text: "Xác nhận đơn hàng thành công!",
                    icon: "success",
                });
            });
    }
</script>
<?php 
    ob_start();
    include("./config/config.php");

    if(isset($_GET['xoa'])){
        $xoa = $_GET['xoa'];
        echo '<div class="flash-data" data-flashdata="'.$xoa.'"></div>';
    }
    else {
        $xoa = '';
    }

    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
    }
    else $keyword = '';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $tranghientai = 0;
    $tonghang = 0;
    $trangcuoi = "";
    $tranghientai = $_GET['trang'];
    $offset = ($tranghientai-1)*10;
    $trangtiep = 0;
    $trangtruoc = 0;

    $sql_danhsach_user_limit = "select hanchenguoidung.MaNguoiDung, hanchenguoidung.MaHanChe, TenNguoiDung, TenHanChe, ThoiGianKetThuc, LiDo from nguoidung, hanchenguoidung, hanche WHERE nguoidung.MaNguoiDung = hanchenguoidung.MaNguoiDung and hanchenguoidung.MaHanChe = hanche.MaHanChe and hanchenguoidung.MaNguoiDung = $id";
    $stmt_limit = $conn->prepare($sql_danhsach_user_limit);
    $stmt_limit->execute();
    $tonghang = $stmt_limit->rowCount();
    // $query_danhsach_loaisp_limit = mysqli_query($conn, $sql_danhsach_loaisp_limit); 
    // while($row_dslsp = mysqli_fetch_array($query_danhsach_loaisp_limit)){
    //     $tonghang++;
    // }
   
    $trangcuoi = ceil($tonghang/10);

    if($tranghientai==1){
        $trangtruoc=$trangcuoi;
    }
    else $trangtruoc=$tranghientai-1;


    if($tranghientai==$trangcuoi){
        $trangtiep=1;
    }
    else $trangtiep=$tranghientai+1;

    $sql_get_ten = "SELECT * FROM nguoidung WHERE MaNguoiDung = $id";
    $stmt_tennguoidung = $conn->prepare($sql_get_ten);
    $stmt_tennguoidung->execute();
    //$query_danhsach_loaisp = mysqli_query($conn, $sql_danhsach_loaisp);  
    $rowten = $stmt_tennguoidung->fetch();
    $tenfromid = $rowten["TenNguoiDung"];
   
    // header("Location:index.php?action=quanlyloaisanpham&trang=1");
    ob_end_flush();

    
    
?>
<div class="grid__column-10">
                        <div class="content">
                            
                            <div class="heading-content">
                                <div class="heading-content-back">
                                    <div class="pagination-other-features">
                                        <a href="index.php?action=quanlynguoidung&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Danh sách hạn chế của người dùng <?php echo $tenfromid ?></div>
                                </div>
                            </div>
                            
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_loaisp = "select hanchenguoidung.MaNguoiDung, hanchenguoidung.MaHanChe, TenNguoiDung, TenHanChe, ThoiGianKetThuc, LiDo from nguoidung, hanchenguoidung, hanche WHERE nguoidung.MaNguoiDung = hanchenguoidung.MaNguoiDung and hanchenguoidung.MaHanChe = hanche.MaHanChe and hanchenguoidung.MaNguoiDung = $id LIMIT 10 OFFSET $offset";
                                $stmt = $conn->prepare($sql_danhsach_loaisp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-20 table-heading-content">Tên hạn chế</th>
                                    <th class="row-20 table-heading-content">Thời gian kết thúc</th>
                                    <th class="row-50 table-heading-content">Lí do</th>
                                    <th class="row-10 table-heading-content">Thao tác</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content">
                                    <td class="row-20 table_info"><?php echo $row['TenHanChe'] ?></td>
                                    <td class="row-20 table_info"><?php echo $row['ThoiGianKetThuc'] ?></td>
                                    <td class="row-50 table_info"><?php echo $row['LiDo'] ?></td>
                                    <td class="row-10 table_info">
                                        <a href='index.php?action=suahanche&idhanche=<?php echo $row["MaHanChe"]?>&idnguoidung=<?php echo $row["MaNguoiDung"]?>' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-pen' title='Sửa'></i>
                                        </a>
                                        <a href='index.php?action=xoahanche&idhanche=<?php echo $row["MaHanChe"]?>&idnguoidung=<?php echo $row["MaNguoiDung"]?>' class='btn-delete tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-trash' title='Xóa'></i>
                                        </a>
                                </tr>
                                <?php
                                    
                                    } 
                                ?>
                            </table>
                            <div class="pagination-wrapper">
                                <div class="pagination-other-features">
                                    <a href="index.php?action=themhanche&id=<?php echo $id ?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-circle-plus" title="Thêm"></i>
                                    </a>
                                </div>
                                <div class="pagination">
                                    <a href="index.php?action=hanchenguoidung&trang=<?php echo $trangtruoc?>&id=<?php echo $id ?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=hanchenguoidung&trang=<?php echo $trangtiep ?>&id=<?php echo $id ?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-right" title="Trang tiếp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


<script>
    $('.btn-delete').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
            title: "Bạn muốn tiếp tục chứ?",
            text: "Dữ liệu sẽ bị xóa vĩnh viễn!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            }).then((result) => {
            if (result) {
                document.location.href = href;
                // swal({
                //     title: "Success!",
                //     text: "Xóa dữ liệu thành công!",
                //     icon: "success",
                //     });
            } 
            // else {
            //     swal("Dữ liệu đã được giữ lại!");
            // }
            });
    })

    const flashdata = $('.flash-data').data('flashdata')
    if(flashdata){
        swal({
                    title: "Success!",
                    text: "Xóa dữ liệu thành công!",
                    icon: "success",
                    });
    }
</script>
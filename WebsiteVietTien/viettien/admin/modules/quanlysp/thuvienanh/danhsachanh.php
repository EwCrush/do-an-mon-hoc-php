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

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    

    $sql_tensp = "SELECT TenSP from SanPham where MaSP = $id";
    // $query_tensp = mysqli_query($conn, $sql_tensp); 
    // $rowten = mysqli_fetch_array($query_tensp);
    // $tensp = $rowten["TenSP"];
    $stmt_tensp = $conn->prepare($sql_tensp);
    $stmt_tensp->execute();
    $rowten = $stmt_tensp->fetch();
    $tensp = $rowten["TenSP"];

    $tranghientai = 0;
    $tonghang = 0;
    $trangcuoi = "";
    $tranghientai = $_GET['trang'];
    $offset = ($tranghientai-1)*10;
    $trangtiep = 0;
    $trangtruoc = 0;
    $sql_danhsach_anh_limit = "SELECT * FROM thuvien where MaSP = $id";
    $stmt_limit = $conn->prepare($sql_danhsach_anh_limit);
    $stmt_limit->execute();
    $tonghang = $stmt_limit->rowCount();
    // $query_danhsach_anh_limit = mysqli_query($conn, $sql_danhsach_anh_limit); 
    // // while($row_ctsp = mysqli_fetch_array($query_danhsach_anh_limit)){
    // //     $tonghang++;
    // // }

    // $tonghang = mysqli_num_rows($query_danhsach_anh_limit);
   
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
                                        <a href="index.php?action=thongtinthem&id=<?php echo $id?>" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thư viện ảnh của sản phẩm <?php echo $tensp?></div>
                                </div>
                            </div>
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_anh_sp = "SELECT * from thuvien where MaSP = $id LIMIT 10 OFFSET $offset";
                                //$query_danhsach_anh_sp = mysqli_query($conn, $sql_danhsach_anh_sp); 
                                $stmt = $conn->prepare($sql_danhsach_anh_sp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-20 table-heading-content">Mã hình ảnh</th>
                                    <th class="row-30 table-heading-content">Tên hình ảnh</th>
                                    <th class="row-30 table-heading-content">Hình ảnh</th>
                                    <th class="row-20 table-heading-content">Thao tác</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content">
                                    <td class="row-20 table_info"><?php echo $row['MaHinhAnh'] ?></td>
                                    <td class="row-30 table_info"><?php echo $row['HinhAnh'] ?></td>
                                    <td class="row-30 table_info"><img class="table-content-img" src="modules/quanlysp/uploads/<?php echo $row['HinhAnh'] ?>"></td>
                                    <td class="row-20 table_info">
                                        <a href='index.php?action=suaanh&hinhanh=<?php echo $row["MaHinhAnh"]?>&id=<?php echo $row["MaSP"]?>' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-pen' title='Sửa'></i>
                                        </a>
                                        <a href='index.php?action=xoaanh&hinhanh=<?php echo $row["MaHinhAnh"]?>&id=<?php echo $row["MaSP"]?>&filename=<?php echo $row["HinhAnh"] ?>' class='btn-delete tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-trash' title='Xóa'></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    
                                    } 
                                ?>
                            </table>
                            <div class="pagination-wrapper">
                                <div class="pagination-other-features">
                                    <a href="index.php?action=themanh&id=<?php echo $id?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-circle-plus" title="Thêm"></i>
                                    </a>
                                </div>
                                <div class="pagination">
                                    <a href="index.php?action=thuvienanh&trang=<?php echo $trangtruoc?>&id=<?php echo $id?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=thuvienanh&trang=<?php echo $trangtiep ?>&id=<?php echo $id?>" class="ThemMoi">
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
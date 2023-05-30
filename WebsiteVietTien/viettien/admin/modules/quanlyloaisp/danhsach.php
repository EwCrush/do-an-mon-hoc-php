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

    $tranghientai = 0;
    $tonghang = 0;
    $trangcuoi = "";
    $tranghientai = $_GET['trang'];
    $offset = ($tranghientai-1)*10;
    $trangtiep = 0;
    $trangtruoc = 0;

    $sql_danhsach_loaisp_limit = "SELECT MaLoaiSP, TenLoaiSP FROM loaisp where TenLoaiSp like '%$keyword%'";
    $stmt_limit = $conn->prepare($sql_danhsach_loaisp_limit);
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

   
    // header("Location:index.php?action=quanlyloaisanpham&trang=1");
    ob_end_flush();

    
    
?>
<div class="grid__column-10">
                        <div class="content">
                            <div class="heading-content">
                                <div class="heading-content-text no-icon-link">Danh sách loại sản phẩm</div>
                                <form action="modules/quanlyloaisp/timkiem.php" method="get">
                                    <div class="heading-content-search">
                                        <input type="text" class="heading-search-input" name="keyword" value="<?php echo $keyword ?>">
                                        <button type="submit" class="heading-content-search-link">
                                            <i class="heading-content-search-icon fa-solid fa-magnifying-glass" title="Tìm kiếm"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <?php
                                include("./config/config.php");
                                $sql_danhsach_loaisp = "SELECT MaLoaiSP, TenLoaiSP FROM loaisp where TenLoaiSp like '%$keyword%' LIMIT 10 OFFSET $offset";
                                $stmt = $conn->prepare($sql_danhsach_loaisp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-20 table-heading-content">Mã</th>
                                    <th class="row-60 table-heading-content">Tên</th>
                                    <th class="row-20 table-heading-content">Thao tác</th>
                                </tr>
                                <?php
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                        $i++;
                                ?>
                                <tr class="table-row-content">
                                    <td class="row-20 table_info"><?php echo $row['MaLoaiSP'] ?></td>
                                    <td class="row-60 table_info"><?php echo $row['TenLoaiSP'] ?></td>
                                    <td class="row-20 table_info">
                                        <a href='index.php?action=sualoaisanpham&id=<?php echo $row["MaLoaiSP"]?>' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-pen' title='Sửa'></i>
                                        </a>
                                        <a href='index.php?action=xoaloaisanpham&id=<?php echo $row["MaLoaiSP"]?>' class='btn-delete tb_thaotac_link'>
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
                                    <a href="index.php?action=themloaisanpham" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-circle-plus" title="Thêm"></i>
                                    </a>
                                </div>
                                <div class="pagination">
                                    <a href="index.php?action=quanlyloaisanpham&trang=<?php echo $trangtruoc?>&keyword=<?php echo $keyword?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=quanlyloaisanpham&trang=<?php echo $trangtiep ?>&keyword=<?php echo $keyword?>" class="ThemMoi">
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
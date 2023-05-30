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
    $sql_danhsach_sp_limit = "SELECT MaSP, TenSP, TenLoaiSP, GiaBan, GiaSale, SoLuong, HinhAnh, TrangThai FROM loaisp, sanpham where SanPham.MaloaiSP = LoaiSP.MaLoaiSP and TenSP like '%$keyword%' ORDER BY MaSP";
    // $query_danhsach_sp_limit = mysqli_query($conn, $sql_danhsach_sp_limit); 
    // while($row_dssp = mysqli_fetch_array($query_danhsach_sp_limit)){
    //     $tonghang++;
    // }
    $stmt_limit = $conn->prepare($sql_danhsach_sp_limit);
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
                                <div class="heading-content-text no-icon-link">Danh sách sản phẩm</div>
                                <form action="modules/quanlysp/timkiem.php" method="get">
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
                                $sql_danhsach_sp = "SELECT MaSP, TenSP, TenLoaiSP, GiaBan, GiaSale, SoLuong, HinhAnh, TrangThai FROM loaisp, sanpham where SanPham.MaloaiSP = LoaiSP.MaLoaiSP and TenSP like '%$keyword%' ORDER BY MaSP LIMIT 10 OFFSET $offset";
                                //$query_danhsach_sp = mysqli_query($conn, $sql_danhsach_sp); 
                                $stmt = $conn->prepare($sql_danhsach_sp);
                                $stmt->execute();
                            ?>
                            <table class="table-content">
                                <tr class="table-row-content">
                                    <th class="row-5 table-heading-content">Mã</th>
                                    <th class="row-20 table-heading-content">Tên</th>
                                    <th class="row-10 table-heading-content">Loại</th>
                                    <th class="row-10 table-heading-content">Giá bán</th>
                                    <th class="row-10 table-heading-content">Giá sale</th>
                                    <th class="row-10 table-heading-content">Số lượng</th>
                                    <th class="row-10 table-heading-content">Trạng thái</th>
                                    <th class="row-10 table-heading-content">Hình ảnh</th>
                                    <th class="row-15 table-heading-content">Thao tác</th>
                                </tr>
                                <?php
                                    while($row = $stmt->fetch()){
                                ?>
                                <tr class="table-row-content">
                                    <td class="row-5 table_info"><?php echo $row['MaSP'] ?></td>
                                    <td class="row-20 table_info"><?php echo $row['TenSP'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['TenLoaiSP'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['GiaBan'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['GiaSale'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['SoLuong'] ?></td>
                                    <td class="row-10 table_info"><?php echo $row['TrangThai'] ?></td>
                                    <td class="row-10 table_info"><img class="table-content-img" src="modules/quanlysp/uploads/<?php echo $row['HinhAnh'] ?>"></td>
                                    <td class="row-15 table_info">
                                        <?php 
                                            if($row['TrangThai']=='Kích hoạt'){
                                                echo "<a href='index.php?action=ansanpham&id=".$row["MaSP"]."&trang=".$tranghientai."' class='tb_thaotac_link'>
                                                        <i class='tb_thaotac_link_icon fa-solid fa-eye-slash' title='Ẩn'></i>
                                                    </a>";
                                            }
                                            else{
                                                echo "<a href='index.php?action=kichhoatsanpham&id=".$row["MaSP"]."&trang=".$tranghientai."' class='tb_thaotac_link'>
                                                        <i class='tb_thaotac_link_icon fa-solid fa-eye' title='Kích hoạt'></i>
                                                    </a>";
                                            }
                                        ?>
                                        <a href='index.php?action=thongtinthem&id=<?php echo $row["MaSP"]?>' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-solid fa-circle-info' title='Xem thêm thông tin'></i>
                                        </a>
                                        <a href='index.php?action=suasanpham&id=<?php echo $row["MaSP"]?>' class='tb_thaotac_link'>
                                            <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-pen' title='Sửa'></i>
                                        </a>
                                        <a href='index.php?action=xoasanpham&id=<?php echo $row["MaSP"]?>&hinhanh=<?php echo $row["HinhAnh"]?>' class='btn-delete tb_thaotac_link'>
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
                                    <a href="index.php?action=themsanpham" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-circle-plus" title="Thêm"></i>
                                    </a>
                                </div>
                                <div class="pagination">
                                    <a href="index.php?action=quanlysanpham&trang=<?php echo $trangtruoc?>&keyword=<?php echo $keyword?>" class="ThemMoi">
                                        <i class="pagination-item fa-solid fa-chevron-left" title="Trang trước"></i>
                                    </a>
                                    <div class="pagination-item no-hover">Trang <?php echo $tranghientai ?>/<?php echo $trangcuoi ?></div>
                                    <a href="index.php?action=quanlysanpham&trang=<?php echo $trangtiep ?>&keyword=<?php echo $keyword?>" class="ThemMoi">
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
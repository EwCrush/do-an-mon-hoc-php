<?php 
    
    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    $sql_get_info_of_user_from_ss = "SELECT * from nguoidung where TaiKhoan = '$username'";
    $stmt_ioufs = $conn->prepare($sql_get_info_of_user_from_ss);
    $stmt_ioufs->execute();
    $row_ioufs = $stmt_ioufs->fetch();
    $userID_ioufs = $row_ioufs['MaNguoiDung'];

    //echo $username;

    if(!$username || $username == 'root'){
        echo '<script> window.location.href="index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1";</script>';
    }

    else{
            $sql_check_before_load = "SELECT * FROM donhang where TrangThaiDonHang = 'Giỏ hàng' and MaNguoiDung = $userID_ioufs";
            $stmt_check_before_load = $conn->prepare($sql_check_before_load);
            $stmt_check_before_load->execute();
            //$row_check_before_load = $stmt_check_before_load->fetch();
            $row_check_before_load_count = $stmt_check_before_load->rowCount();

            if($row_check_before_load_count < 1){
                //lay ra don hang gan nhat cua nguoi dung
                $sql_find_old_cart = "SELECT * FROM donhang where TrangThaiDonHang = 'Đã hoàn tất' and MaNguoiDung = $userID_ioufs order by NgayLap desc limit 1";
                $stmt_find_old_cart = $conn->prepare($sql_find_old_cart);
                $stmt_find_old_cart->execute();
                $row_find_old_cart = $stmt_find_old_cart->fetch();
                $row_find_old_cart_count = $stmt_find_old_cart->rowCount();

                if($row_find_old_cart_count>0){
                    $ten_create_cart = $row_find_old_cart['TenNguoiNhan'];
                    $sdt_create_cart = $row_find_old_cart['SDTNhanHang'];
                    $diachi_create_cart = $row_find_old_cart['DiaChiGiaoHang'];
                }
                else{
                    $ten_create_cart = $row_ioufs['TenNguoiDung'];
                    $sdt_create_cart = $row_ioufs['SDT'];
                    $diachi_create_cart = $row_ioufs['DiaChi'];
                }
                //tao gio hang moi cho nguoi dung
                $sql_create_cart = "INSERT INTO donhang (MaNguoiDung, TenNguoiNhan, SDTNhanHang, DiaChiGiaoHang, TrangThaiDonHang, NgayLap, PhiShip, TongTien) values ($userID_ioufs, '$ten_create_cart', '$sdt_create_cart', '$diachi_create_cart', 'Giỏ hàng', CURRENT_TIMESTAMP(), 0, 0)";
                $stmt_create_cart = $conn->prepare($sql_create_cart);
                $stmt_create_cart->execute();
            }

        //lay gio hang gan nhat cua nguoi dung
        $sql_get_cart = "SELECT madonhang, nguoidung.MaNguoiDung, TenNguoiDung, TaiKhoan, SDTNhanHang, SDT, DiaChi, TenNguoiNhan, PhiShip, tongtien, DiaChiGiaoHang FROM nguoidung, donhang where nguoidung.MaNguoiDung = donhang.MaNguoiDung and TaiKhoan = '$username' and TrangThaiDonHang = 'Giỏ hàng' ORDER BY NgayLap DESC LIMIT 1";
        $stmt_cart = $conn->prepare($sql_get_cart);
        $stmt_cart->execute();
        $row_cart = $stmt_cart->fetch();
        $isEmpty = $stmt_cart->rowCount();

        if($isEmpty>0){

            $madonhang = $row_cart['madonhang'];

            //lay tat ca san pham trong gio hang
            $sql_get_cart = "SELECT MaDonHang, chitietdonhang.MaSP, Size, DonGia, SoLuong, ThanhTien, TenSP, GiaBan, GiaSale, MauSac, SoLuongDatMua, HinhAnh from ChiTietDonHang, sanpham where chitietdonhang.MaSP = sanpham.MaSP and MaDonHang = $madonhang";
            $stmt_cart = $conn->prepare($sql_get_cart);
            $stmt_cart->execute();
            $tonghang = $stmt_cart->rowCount();
        }
    }
?>
<div class="app_container">
    <div class="grid">
        <div class="maps">
            <a href="index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1" class="maps-link">
                <i class="fa-solid fa-house"></i>
                Trang chủ
            </a>
            <span class="maps-link current-link"><i class="current-link-none-css fa-solid fa-caret-right"></i> Giỏ hàng</a>
        </div>
        <div class="grid__row cart-page">
            <div class="cart-page-list-product">
                <table class="table-content" id="table-content-cart" value="<?php echo $row_cart['madonhang'] ?>">
                    <tr class="table-row-content">
                        <th class="row-35 table-heading-content">Sản phẩm</th>
                        <th class="row-25 table-heading-content">Đơn giá</th>
                        <th class="row-15 table-heading-content">Số lượng</th>
                        <th class="row-20 table-heading-content">Thành tiền</th>
                        <th class="row-5 table-heading-content">Xóa</th>
                    </tr>
                    <?php
                        $i = 0;
                        while($row = $stmt_cart->fetch()){
                            $i++;
                    ?>
                    <tr class="table-row-content" value="<?php echo $row['MaSP'] ?>" id="cart-item-<?php echo $row['MaSP'] ?>-<?php echo $row['Size'] ?>">
                        <td class="row-35 table_info table-info-product-row">
                            <div class="table-info-product-row-item table-info-product-row-item-img">
                                <img src="/admin/modules/quanlysp/uploads/<?php echo $row['HinhAnh'] ?>" alt="" class="cart-table-img">
                            </div>
                            <div class="table-info-product-row-item">
                                <div class="table-info-product-row-item-name">
                                    <?php echo $row['TenSP'] ?>
                                </div>
                                <div class="table-info-product-row-item-size">
                                    <b>Kích cỡ: </b><?php echo $row['Size'] ?> 
                                </div>
                                <div class="table-info-product-row-item-color">
                                <b>Màu sắc: </b><?php echo $row['MauSac'] ?> 
                                </div> 
                            </div>
                        </td>
                        <td class="row-25 table_info">
                            <span class="table-info-new-price-row" value="<?php echo $row['DonGia'] ?>"><?php echo number_format($row['GiaSale'],0,',','.').'₫' ?></span>
                            <span class="table-info-old-price-row"><?php echo number_format($row['GiaBan'],0,',','.').'₫' ?></span>
                        </td>
                        <td class="row-15 table_info">
                            <div class="cart-soluong">
                                <div class="cart-soluong-input" value="<?php echo $row['SoLuong']?>">
                                    <div class="cart-soluong-tru" onmousedown='return false;' onselectstart='return false;'>-</div>
                                        <input disabled type="text" class="cart-soluong-value" value="<?php echo $row['SoLuongDatMua']?>">
                                    <div class="cart-soluong-cong" onmousedown='return false;' onselectstart='return false;'>+</div>
                                </div>
                            </div>
                        </td>
                        <td class="row-20 table_info">
                            <div class="table-info-total-fee-row">
                                <?php echo number_format($row['ThanhTien'],0,',','.').'₫' ?>
                            </div>
                        </td>
                        <td class="row-5 table_info">
                            <a href='javascript:XoaSanPhamKhoiGioHang(<?php echo $row["MaSP"]?>,"<?php echo $row['Size'] ?>")' class='btn-delete tb_thaotac_link delete-product-from-cart'>
                                <i class='tb_thaotac_link_icon fa-sharp fa-solid fa-trash' title='Xóa'></i>
                            </a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    ?>
                </table>
            </div>
            <div class="cart-page-address-and-bill">
                <div class="cart-page-address-shipping-info-shipping">
                    <div class="cart-page-address-shipping-info-shipping-heading">
                        <div class="cart-page-address-shipping-info-shipping-heading-ship-to">
                            Giao tới
                        </div>
                        <div class="cart-page-address-shipping-info-shipping-heading-change-info">
                            Thay đổi
                        </div>
                    </div>
                    <div class="cart-page-address-shipping-info-shipping-name-and-contact">
                        <div class="cart-page-address-shipping-info-shipping-name">
                            <?php echo $row_cart['TenNguoiNhan'] ?>
                        </div>
                        <div class="cart-page-address-shipping-info-shipping-contact">
                            <?php echo $row_cart['SDTNhanHang'] ?>
                        </div>
                    </div>
                    <div class="cart-page-address-shipping-info-shipping-address">
                        <?php echo $row_cart['DiaChiGiaoHang'] ?>
                    </div>
                </div>
                <div class="cart-page-bill">
                    <div class="cart-page-bill-initial-fee">
                        <div class="cart-page-bill-initial-fee-label">
                            Tạm tính
                        </div>
                        <div class="cart-page-bill-initial-fee-price">
                            <?php echo number_format($row_cart['tongtien']-$row_cart['PhiShip'],0,',','.').'₫' ?>
                        </div>
                    </div>
                    <div class="cart-page-bill-shipping-fee">
                        <div class="cart-page-bill-shipping-fee-label">
                            Phí ship
                        </div>
                        <div class="cart-page-bill-shipping-fee-price">
                            <?php echo number_format($row_cart['PhiShip'],0,',','.').'₫' ?>
                        </div>
                    </div>
                    <div class="cart-page-bill-total-fee">
                        <div class="cart-page-bill-total-fee-label">
                            Tổng tiền
                        </div>
                        <div class="cart-page-bill-total-fee-price">
                            <?php echo number_format($row_cart['tongtien'],0,',','.').'₫' ?>
                        </div>
                    </div>
                </div>
                <a href="javascript:DatHang()" class="cart-page-pay">
                    Đặt hàng (<?php echo $tonghang ?>)
                </a>
            </div>
        </div>
    </div>
</div>
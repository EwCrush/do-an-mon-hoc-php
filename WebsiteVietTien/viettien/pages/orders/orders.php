<?php 
    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if(!$username || $username == 'root'){
        echo '<script> window.location.href="index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1";</script>';
    }
    
    $sql_get_info_of_user_from_ss = "SELECT * from nguoidung where TaiKhoan = '$username'";
    $stmt_ioufs = $conn->prepare($sql_get_info_of_user_from_ss);
    $stmt_ioufs->execute();
    $row_ioufs = $stmt_ioufs->fetch();
    $userID_ioufs = $row_ioufs['MaNguoiDung'];

    //lay ra tat ca don hang dang cho xac nhan cua nguoi dung
    $sql_get_order_dangchoxacnhan = "SELECT * from donhang where MaNguoiDung = $userID_ioufs and TrangThaiDonHang = 'Đang chờ xác nhận' order by NgayLap desc";
    $stmt_get_order_dangchoxacnhan = $conn->prepare($sql_get_order_dangchoxacnhan);
    $stmt_get_order_dangchoxacnhan->execute();

    //lay ra tat ca don hang dang van chuyen cua nguoi dung
    $sql_get_order_dangvanchuyen = "SELECT * from donhang where MaNguoiDung = $userID_ioufs and TrangThaiDonHang = 'Đang vận chuyển' order by NgayLap desc";
    $stmt_get_order_dangvanchuyen = $conn->prepare($sql_get_order_dangvanchuyen);
    $stmt_get_order_dangvanchuyen->execute();

    //lay ra tat ca don hang da hoan tat cua nguoi dung
    $sql_get_order_dahoantat = "SELECT * from donhang where MaNguoiDung = $userID_ioufs and TrangThaiDonHang = 'Đã hoàn tất' order by NgayLap desc";
    $stmt_get_order_dahoantat = $conn->prepare($sql_get_order_dahoantat);
    $stmt_get_order_dahoantat->execute();

    //lay ra tat ca don hang da huy hoac giao hang that bai cua nguoi dung
    $sql_get_order_khac = "SELECT * from donhang where MaNguoiDung = $userID_ioufs and TrangThaiDonHang = 'Đã hủy' OR TrangThaiDonHang = 'Giao hàng thất bại' order by NgayLap desc";
    $stmt_get_order_khac = $conn->prepare($sql_get_order_khac);
    $stmt_get_order_khac->execute();
?>
<div class="app_container">
    <div class="grid">
        <div class="maps">
            <a href="index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1" class="maps-link">
                <i class="fa-solid fa-house"></i>
                Trang chủ
            </a>
            <span class="maps-link current-link"><i class="current-link-none-css fa-solid fa-caret-right"></i> Đơn hàng của bạn</a>
        </div>
        <div class="orders">
            <div class="type-of-orders">
                <div onmousedown='return false'; class="type-of-order-items order-label-active" id="dangchoxacnhan">Đang chờ xác nhận</div>
                <div onmousedown='return false'; class="type-of-order-items" id="dangvanchuyen">Đang vận chuyển</div>
                <div onmousedown='return false'; class="type-of-order-items" id="dahoantat">Đã hoàn tất</div>
                <div onmousedown='return false'; class="type-of-order-items" id="khac">Khác</div>
            </div>
            <div class="order-tables">
                <div class="order-table order-table-active order-table-dangchoxacnhan">
                    <table class="table-content" id="table-content-cart" value="">
                        <tr class="table-row-content">
                            <th class="row-10 table-heading-content-order">Mã đơn hàng</th>
                            <th class="row-20 table-heading-content-order">Tên người nhận</th>
                            <th class="row-10 table-heading-content-order">SDT nhận hàng</th>
                            <th class="row-25 table-heading-content-order">Địa chỉ giao hàng</th>
                            <th class="row-10 table-heading-content-order">Phí ship</th>
                            <th class="row-10 table-heading-content-order">Tổng tiền</th>
                            <th class="row-15 table-heading-content-order">Thao tác</th>
                        </tr>
                        <?php
                            // $i = 0;
                            // while($row = $stmt_cart->fetch()){
                            //     $i++;
                            while($row_get_order_dangchoxacnhan = $stmt_get_order_dangchoxacnhan->fetch()){
                                $MaDonHang_dangchoxacnhan = $row_get_order_dangchoxacnhan['MaDonHang'];
                        ?>
                        <tr class="table-row-content" id="row-order-<?php echo $row_get_order_dangchoxacnhan['MaDonHang'] ?>">
                            <td class="row-10 table_info-order"><?php echo $row_get_order_dangchoxacnhan['MaDonHang'] ?></td>
                            <td class="row-20 table_info-order"><?php echo $row_get_order_dangchoxacnhan['TenNguoiNhan'] ?></td>
                            <td class="row-10 table_info-order"><?php echo $row_get_order_dangchoxacnhan['SDTNhanHang'] ?></td>
                            <td class="row-25 table_info-order"><?php echo $row_get_order_dangchoxacnhan['DiaChiGiaoHang'] ?></td>
                            <td class="row-10 table_info-order"><?php echo number_format($row_get_order_dangchoxacnhan['PhiShip'],0,',','.').'₫' ?></td>
                            <td class="row-10 table_info-order"><?php echo number_format($row_get_order_dangchoxacnhan['TongTien'],0,',','.').'₫' ?></td>
                            <td class="row-15 table_info-order">
                                <a href='javascript:HuyDonHang(<?php echo $row_get_order_dangchoxacnhan['MaDonHang'] ?>)' class='tb_thaotac_link delete-product-from-cart order-action'>
                                    <i class='tb_thaotac_link_icon fa-solid fa-xmark' title='Hủy đơn hàng'></i>
                                </a>
                                <a href='javascript:ShowAllProduct(<?php echo $row_get_order_dangchoxacnhan['MaDonHang'] ?>)' class='tb_thaotac_link delete-product-from-cart order-action order-action-show-product'>
                                    <i class='tb_thaotac_link_icon fa-solid fa-angle-down' title='Xem sản phẩm trong giỏ hàng'></i>
                                </a>
                            </td>
                        </tr>
                        
                        <tr class="">
                            <!-- <div class="all-product-from-order"></div> -->
                            <td colspan="7" class="td-product td-product-hiding td-product-<?php echo $row_get_order_dangchoxacnhan['MaDonHang'] ?>">
                                <div class="all-product-from-order">
                                    <table class="table-content" id="table-content-cart" value="">
                                        <tr class="table-row-content">
                                            <th class="row-30 table-heading-content-order">Tên sản phẩm</th>
                                            <th class="row-20 table-heading-content-order">Hình ảnh</th>
                                            <th class="row-10 table-heading-content-order">Size</th>
                                            <th class="row-10 table-heading-content-order">Đơn giá</th>
                                            <th class="row-10 table-heading-content-order">Số lượng</th>
                                            <th class="row-20 table-heading-content-order">Thành tiền</th>
                                        </tr>
                                        <?php
                                            $sql_get_product_dangchoxacnhan = "SELECT tensp, hinhanh, size, dongia, soluongdatmua, thanhtien from chitietdonhang, sanpham where chitietdonhang.masp = sanpham.masp and madonhang = $MaDonHang_dangchoxacnhan";
                                            $stmt_get_product_dangchoxacnhan = $conn->prepare($sql_get_product_dangchoxacnhan);
                                            $stmt_get_product_dangchoxacnhan->execute();
                                            while($row_get_product_dangchoxacnhan = $stmt_get_product_dangchoxacnhan->fetch()){
                                        ?>
                                        <tr class="table-row-content">
                                            <td class="row-30 table_info-order"><?php echo $row_get_product_dangchoxacnhan['tensp'] ?></td>
                                            <td class="row-20 table_info-order"><img class="table-content-product-img" src="/admin/modules/quanlysp/uploads/<?php echo $row_get_product_dangchoxacnhan['hinhanh'] ?>"></td>
                                            <td class="row-10 table_info-order"><?php echo $row_get_product_dangchoxacnhan['size'] ?></td>
                                            <td class="row-10 table_info-order"><?php echo number_format($row_get_product_dangchoxacnhan['dongia'],0,',','.').'₫' ?></td>
                                            <td class="row-10 table_info-order"><?php echo $row_get_product_dangchoxacnhan['soluongdatmua'] ?></td>
                                            <td class="row-20 table_info-order"><?php echo number_format($row_get_product_dangchoxacnhan['thanhtien'],0,',','.').'₫' ?></td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </table>
                </div>
                <div class="order-table order-table-dangvanchuyen">
                    <table class="table-content" id="table-content-cart" value="">
                        <tr class="table-row-content">
                            <th class="row-10 table-heading-content-order">Mã đơn hàng</th>
                            <th class="row-20 table-heading-content-order">Tên người nhận</th>
                            <th class="row-10 table-heading-content-order">SDT nhận hàng</th>
                            <th class="row-25 table-heading-content-order">Địa chỉ giao hàng</th>
                            <th class="row-10 table-heading-content-order">Phí ship</th>
                            <th class="row-10 table-heading-content-order">Tổng tiền</th>
                            <th class="row-15 table-heading-content-order">Thao tác</th>
                        </tr>
                        <?php
                            // $i = 0;
                            // while($row = $stmt_cart->fetch()){
                            //     $i++;
                            while($row_get_order_dangvanchuyen = $stmt_get_order_dangvanchuyen->fetch()){
                                $MaDonHang_dangvanchuyen = $row_get_order_dangvanchuyen['MaDonHang'];
                        ?>
                        <tr class="table-row-content" id="row-order-<?php echo $row_get_order_dangvanchuyen['MaDonHang'] ?>">
                            <td class="row-10 table_info-order"><?php echo $row_get_order_dangvanchuyen['MaDonHang'] ?></td>
                            <td class="row-20 table_info-order"><?php echo $row_get_order_dangvanchuyen['TenNguoiNhan'] ?></td>
                            <td class="row-10 table_info-order"><?php echo $row_get_order_dangvanchuyen['SDTNhanHang'] ?></td>
                            <td class="row-25 table_info-order"><?php echo $row_get_order_dangvanchuyen['DiaChiGiaoHang'] ?></td>
                            <td class="row-10 table_info-order"><?php echo number_format($row_get_order_dangvanchuyen['PhiShip'],0,',','.').'₫' ?></td>
                            <td class="row-10 table_info-order"><?php echo number_format($row_get_order_dangvanchuyen['TongTien'],0,',','.').'₫' ?></td>
                            <td class="row-15 table_info-order">
                                <a href='javascript:ShowAllProduct(<?php echo $row_get_order_dangvanchuyen['MaDonHang'] ?>)' class='tb_thaotac_link delete-product-from-cart order-action order-action-show-product'>
                                    <i class='tb_thaotac_link_icon fa-solid fa-angle-down' title='Xem sản phẩm trong giỏ hàng'></i>
                                </a>
                            </td>
                        </tr>
                        
                        <tr class="">
                            <!-- <div class="all-product-from-order"></div> -->
                            <td colspan="7" class="td-product td-product-hiding td-product-<?php echo $row_get_order_dangvanchuyen['MaDonHang'] ?>">
                                <div class="all-product-from-order">
                                    <table class="table-content" id="table-content-cart" value="">
                                        <tr class="table-row-content">
                                            <th class="row-30 table-heading-content-order">Tên sản phẩm</th>
                                            <th class="row-20 table-heading-content-order">Hình ảnh</th>
                                            <th class="row-10 table-heading-content-order">Size</th>
                                            <th class="row-10 table-heading-content-order">Đơn giá</th>
                                            <th class="row-10 table-heading-content-order">Số lượng</th>
                                            <th class="row-20 table-heading-content-order">Thành tiền</th>
                                        </tr>
                                        <?php
                                            $sql_get_product_dangvanchuyen = "SELECT tensp, hinhanh, size, dongia, soluongdatmua, thanhtien from chitietdonhang, sanpham where chitietdonhang.masp = sanpham.masp and madonhang = $MaDonHang_dangvanchuyen";
                                            $stmt_get_product_dangvanchuyen = $conn->prepare($sql_get_product_dangvanchuyen);
                                            $stmt_get_product_dangvanchuyen->execute();
                                            while($row_get_product_dangvanchuyen = $stmt_get_product_dangvanchuyen->fetch()){
                                        ?>
                                        <tr class="table-row-content">
                                            <td class="row-30 table_info-order"><?php echo $row_get_product_dangvanchuyen['tensp'] ?></td>
                                            <td class="row-20 table_info-order"><img class="table-content-product-img" src="/admin/modules/quanlysp/uploads/<?php echo $row_get_product_dangvanchuyen['hinhanh'] ?>"></td>
                                            <td class="row-10 table_info-order"><?php echo $row_get_product_dangvanchuyen['size'] ?></td>
                                            <td class="row-10 table_info-order"><?php echo number_format($row_get_product_dangvanchuyen['dongia'],0,',','.').'₫' ?></td>
                                            <td class="row-10 table_info-order"><?php echo $row_get_product_dangvanchuyen['soluongdatmua'] ?></td>
                                            <td class="row-20 table_info-order"><?php echo number_format($row_get_product_dangvanchuyen['thanhtien'],0,',','.').'₫' ?></td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </table>
                </div>
                <div class="order-table order-table-dahoantat">
                    <table class="table-content" id="table-content-cart" value="">
                        <tr class="table-row-content">
                            <th class="row-10 table-heading-content-order">Mã đơn hàng</th>
                            <th class="row-20 table-heading-content-order">Tên người nhận</th>
                            <th class="row-10 table-heading-content-order">SDT nhận hàng</th>
                            <th class="row-25 table-heading-content-order">Địa chỉ giao hàng</th>
                            <th class="row-10 table-heading-content-order">Phí ship</th>
                            <th class="row-10 table-heading-content-order">Tổng tiền</th>
                            <th class="row-15 table-heading-content-order">Thao tác</th>
                        </tr>
                        <?php
                            // $i = 0;
                            // while($row = $stmt_cart->fetch()){
                            //     $i++;
                            while($row_get_order_dahoantat = $stmt_get_order_dahoantat->fetch()){
                                $MaDonHang_dahoantat = $row_get_order_dahoantat['MaDonHang'];
                        ?>
                        <tr class="table-row-content" id="row-order-<?php echo $row_get_order_dahoantat['MaDonHang'] ?>">
                            <td class="row-10 table_info-order"><?php echo $row_get_order_dahoantat['MaDonHang'] ?></td>
                            <td class="row-20 table_info-order"><?php echo $row_get_order_dahoantat['TenNguoiNhan'] ?></td>
                            <td class="row-10 table_info-order"><?php echo $row_get_order_dahoantat['SDTNhanHang'] ?></td>
                            <td class="row-25 table_info-order"><?php echo $row_get_order_dahoantat['DiaChiGiaoHang'] ?></td>
                            <td class="row-10 table_info-order"><?php echo number_format($row_get_order_dahoantat['PhiShip'],0,',','.').'₫' ?></td>
                            <td class="row-10 table_info-order"><?php echo number_format($row_get_order_dahoantat['TongTien'],0,',','.').'₫' ?></td>
                            <td class="row-15 table_info-order">
                                <a href='javascript:ShowAllProduct(<?php echo $row_get_order_dahoantat['MaDonHang'] ?>)' class='tb_thaotac_link delete-product-from-cart order-action order-action-show-product'>
                                    <i class='tb_thaotac_link_icon fa-solid fa-angle-down' title='Xem sản phẩm trong giỏ hàng'></i>
                                </a>
                            </td>
                        </tr>
                        
                        <tr class="">
                            <!-- <div class="all-product-from-order"></div> -->
                            <td colspan="7" class="td-product td-product-hiding td-product-<?php echo $row_get_order_dahoantat['MaDonHang'] ?>">
                                <div class="all-product-from-order">
                                    <table class="table-content" id="table-content-cart" value="">
                                        <tr class="table-row-content">
                                            <th class="row-30 table-heading-content-order">Tên sản phẩm</th>
                                            <th class="row-20 table-heading-content-order">Hình ảnh</th>
                                            <th class="row-10 table-heading-content-order">Size</th>
                                            <th class="row-10 table-heading-content-order">Đơn giá</th>
                                            <th class="row-10 table-heading-content-order">Số lượng</th>
                                            <th class="row-20 table-heading-content-order">Thành tiền</th>
                                        </tr>
                                        <?php
                                            $sql_get_product_dahoantat = "SELECT tensp, hinhanh, size, dongia, soluongdatmua, thanhtien from chitietdonhang, sanpham where chitietdonhang.masp = sanpham.masp and madonhang = $MaDonHang_dahoantat";
                                            $stmt_get_product_dahoantat = $conn->prepare($sql_get_product_dahoantat);
                                            $stmt_get_product_dahoantat->execute();
                                            while($row_get_product_dahoantat = $stmt_get_product_dahoantat->fetch()){
                                        ?>
                                        <tr class="table-row-content">
                                            <td class="row-30 table_info-order"><?php echo $row_get_product_dahoantat['tensp'] ?></td>
                                            <td class="row-20 table_info-order"><img class="table-content-product-img" src="/admin/modules/quanlysp/uploads/<?php echo $row_get_product_dahoantat['hinhanh'] ?>"></td>
                                            <td class="row-10 table_info-order"><?php echo $row_get_product_dahoantat['size'] ?></td>
                                            <td class="row-10 table_info-order"><?php echo number_format($row_get_product_dahoantat['dongia'],0,',','.').'₫' ?></td>
                                            <td class="row-10 table_info-order"><?php echo $row_get_product_dahoantat['soluongdatmua'] ?></td>
                                            <td class="row-20 table_info-order"><?php echo number_format($row_get_product_dahoantat['thanhtien'],0,',','.').'₫' ?></td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </table>
                </div>
                <div class="order-table order-table-khac">
                    <table class="table-content" id="table-content-cart" value="">
                        <tr class="table-row-content">
                            <th class="row-10 table-heading-content-order">Mã đơn hàng</th>
                            <th class="row-20 table-heading-content-order">Tên người nhận</th>
                            <th class="row-10 table-heading-content-order">SDT nhận hàng</th>
                            <th class="row-25 table-heading-content-order">Địa chỉ giao hàng</th>
                            <th class="row-10 table-heading-content-order">Phí ship</th>
                            <th class="row-10 table-heading-content-order">Tổng tiền</th>
                            <th class="row-15 table-heading-content-order">Thao tác</th>
                        </tr>
                        <?php
                            // $i = 0;
                            // while($row = $stmt_cart->fetch()){
                            //     $i++;
                            while($row_get_order_khac = $stmt_get_order_khac->fetch()){
                                $MaDonHang_khac = $row_get_order_khac['MaDonHang'];
                        ?>
                        <tr class="table-row-content" id="row-order-<?php echo $row_get_order_khac['MaDonHang'] ?>">
                            <td class="row-10 table_info-order"><?php echo $row_get_order_khac['MaDonHang'] ?></td>
                            <td class="row-20 table_info-order"><?php echo $row_get_order_khac['TenNguoiNhan'] ?></td>
                            <td class="row-10 table_info-order"><?php echo $row_get_order_khac['SDTNhanHang'] ?></td>
                            <td class="row-25 table_info-order"><?php echo $row_get_order_khac['DiaChiGiaoHang'] ?></td>
                            <td class="row-10 table_info-order"><?php echo number_format($row_get_order_khac['PhiShip'],0,',','.').'₫' ?></td>
                            <td class="row-10 table_info-order"><?php echo number_format($row_get_order_khac['TongTien'],0,',','.').'₫' ?></td>
                            <td class="row-15 table_info-order">
                                <a href='javascript:ShowAllProduct(<?php echo $row_get_order_khac['MaDonHang'] ?>)' class='tb_thaotac_link delete-product-from-cart order-action order-action-show-product'>
                                    <i class='tb_thaotac_link_icon fa-solid fa-angle-down' title='Xem sản phẩm trong giỏ hàng'></i>
                                </a>
                            </td>
                        </tr>
                        
                        <tr class="">
                            <!-- <div class="all-product-from-order"></div> -->
                            <td colspan="7" class="td-product td-product-hiding td-product-<?php echo $row_get_order_khac['MaDonHang'] ?>">
                                <div class="all-product-from-order">
                                    <table class="table-content" id="table-content-cart" value="">
                                        <tr class="table-row-content">
                                            <th class="row-30 table-heading-content-order">Tên sản phẩm</th>
                                            <th class="row-20 table-heading-content-order">Hình ảnh</th>
                                            <th class="row-10 table-heading-content-order">Size</th>
                                            <th class="row-10 table-heading-content-order">Đơn giá</th>
                                            <th class="row-10 table-heading-content-order">Số lượng</th>
                                            <th class="row-20 table-heading-content-order">Thành tiền</th>
                                        </tr>
                                        <?php
                                            $sql_get_product_khac = "SELECT tensp, hinhanh, size, dongia, soluongdatmua, thanhtien from chitietdonhang, sanpham where chitietdonhang.masp = sanpham.masp and madonhang = $MaDonHang_khac";
                                            $stmt_get_product_khac = $conn->prepare($sql_get_product_khac);
                                            $stmt_get_product_khac->execute();
                                            while($row_get_product_khac = $stmt_get_product_khac->fetch()){
                                        ?>
                                        <tr class="table-row-content">
                                            <td class="row-30 table_info-order"><?php echo $row_get_product_khac['tensp'] ?></td>
                                            <td class="row-20 table_info-order"><img class="table-content-product-img" src="/admin/modules/quanlysp/uploads/<?php echo $row_get_product_khac['hinhanh'] ?>"></td>
                                            <td class="row-10 table_info-order"><?php echo $row_get_product_khac['size'] ?></td>
                                            <td class="row-10 table_info-order"><?php echo number_format($row_get_product_khac['dongia'],0,',','.').'₫' ?></td>
                                            <td class="row-10 table_info-order"><?php echo $row_get_product_khac['soluongdatmua'] ?></td>
                                            <td class="row-20 table_info-order"><?php echo number_format($row_get_product_khac['thanhtien'],0,',','.').'₫' ?></td>
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

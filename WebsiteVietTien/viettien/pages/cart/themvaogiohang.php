<?php 

    include("../../admin/config/config.php");

    if(isset($_POST['MaSanPham'])){
        $MaSanPham = $_POST['MaSanPham'];
    }
    if(isset($_POST['SoLuong'])){
        $SoLuong = $_POST['SoLuong'];
    }
    if(isset($_POST['Size'])){
        $Size = $_POST['Size'];
    }

    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    $Price = 0;

    if(!$username || $username == "root"){
        $data = 0;
    }

    else{
        $sql_get_sp = "SELECT * from SanPham where MaSP = $MaSanPham";
        $stmt_get_sp = $conn->prepare($sql_get_sp);
        $stmt_get_sp->execute();
        $row_get_sp = $stmt_get_sp->fetch();
        $row_get_sp_count = $stmt_get_sp->rowCount();
        $Price = $row_get_sp['GiaSale'];

        //check size 
        $sql_check_size = "SELECT * from size where SizeSP = '$Size' and MaSP = $MaSanPham";
        $stmt_check_size = $conn->prepare($sql_check_size);
        $stmt_check_size->execute();
        $row_check_size = $stmt_check_size->fetch();
        $row_check_size_count = $stmt_check_size->rowCount();
        $soluongcondu = 0;
        if($row_check_size_count<1){
            $data = 3;
        }
        else{
            $soluongcondu = $row_check_size['SoLuong'];
            if($soluongcondu<$SoLuong){
                $data = 4;
            }
            else{
                $data = 1;
            
                $sql_get_info = "SELECT * from nguoidung where TaiKhoan = '$username'";
                $stmt_get_info = $conn->prepare($sql_get_info);
                $stmt_get_info->execute();
                $row_get_info = $stmt_get_info->fetch();
                $MaNguoiDung = $row_get_info['MaNguoiDung'];
        
                //check 
                $sql_check_before_load = "SELECT * FROM donhang where TrangThaiDonHang = 'Giỏ hàng' and MaNguoiDung = $MaNguoiDung";
                $stmt_check_before_load = $conn->prepare($sql_check_before_load);
                $stmt_check_before_load->execute();
                //$row_check_before_load = $stmt_check_before_load->fetch();
                $row_check_before_load_count = $stmt_check_before_load->rowCount();
        
                if($row_check_before_load_count < 1){
                    //lay ra don hang gan nhat cua nguoi dung
                    $sql_find_old_cart = "SELECT * FROM donhang where TrangThaiDonHang = 'Đã hoàn tất' and MaNguoiDung = $MaNguoiDung order by NgayLap desc limit 1";
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
                        $ten_create_cart = $row_get_info['TenNguoiDung'];
                        $sdt_create_cart = $row_get_info['SDT'];
                        $diachi_create_cart = $row_get_info['DiaChi'];
                    }
                    //tao gio hang moi cho nguoi dung
                    $sql_create_cart = "INSERT INTO donhang (MaNguoiDung, TenNguoiNhan, SDTNhanHang, DiaChiGiaoHang, TrangThaiDonHang, NgayLap, PhiShip, TongTien) values ($MaNguoiDung, '$ten_create_cart', '$sdt_create_cart', '$diachi_create_cart', 'Giỏ hàng', 'CURRENT_TIMESTAMP()', 0, 0)";
                    $stmt_create_cart = $conn->prepare($sql_create_cart);
                    $stmt_create_cart->execute();
                }
        
                //lay gio hang gan nhat cua nguoi dung
                $sql_get_cart = "SELECT * FROM donhang where MaNguoiDung = $MaNguoiDung and TrangThaiDonHang = 'Giỏ hàng' ORDER BY NgayLap DESC LIMIT 1";
                $stmt_cart = $conn->prepare($sql_get_cart);
                $stmt_cart->execute();
                $row_cart = $stmt_cart->fetch();
                $cartid = $row_cart['MaDonHang'];
        
                $sql_check_item_cart = "SELECT * FROM chitietdonhang where MaDonHang = $cartid and MaSP = $MaSanPham and Size = '$Size'";
                $stmt_check_item_cart = $conn->prepare($sql_check_item_cart);
                $stmt_check_item_cart->execute();
                $row_item_cart = $stmt_check_item_cart->fetch();
                $row_item_cart_count = $stmt_check_item_cart->rowCount();
                $soluongdatmua = 0;
        
                if($row_item_cart_count>0){
                    $soluongdatmua = $row_item_cart['SoLuongDatMua'] + $SoLuong;
        
                    $sql_update_item_cart = "UPDATE chitietdonhang SET SoLuongDatMua = $soluongdatmua, DonGia = $Price where MaDonHang = $cartid and MaSP = $MaSanPham and Size = '$Size'";
                    $stmt_update_item_cart = $conn->prepare($sql_update_item_cart);
                    $stmt_update_item_cart->execute();
                }
                else{
                    $sql_add_item_cart = "INSERT INTO chitietdonhang (MaDonHang, MaSP, Size, DonGia, SoLuongDatMua, ThanhTien) values ($cartid, $MaSanPham, '$Size', $Price, $SoLuong, 0)";
                    $stmt_add_item_cart = $conn->prepare($sql_add_item_cart);
                    $stmt_add_item_cart->execute();
                }
        
                $sql_update_soluong = "UPDATE Size set SoLuong = (SoLuong - $soluongdatmua) where SizeSP = '$Size' and MaSP = $MaSanPham ";
                $stmt_update_soluong = $conn->prepare($sql_update_soluong);
                $stmt_update_soluong->execute();
        
                $sql_update_thanhtien = "update chitietdonhang set ThanhTien = DonGia*SoLuongDatMua";
                $stmt_thanhtien = $conn->prepare($sql_update_thanhtien);
                $stmt_thanhtien->execute();
        
                $sql_update_phiship = "update donhang set PhiShip = 15000*(SELECT COUNT(masp) from chitietdonhang WHERE donhang.MaDonHang = chitietdonhang.MaDonHang)";
                $stmt_phiship = $conn->prepare($sql_update_phiship);
                $stmt_phiship->execute();
        
                $sql_update_tongtien = "update donhang set tongtien = (select sum(ThanhTien) from chitietdonhang where donhang.MaDonHang = chitietdonhang.MaDonHang)+PhiShip";
                $stmt_tongtien = $conn->prepare($sql_update_tongtien);
                $stmt_tongtien->execute();
        
            }
        }
    }

    
    


    echo json_encode($data);
?>
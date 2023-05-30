<?php
    require __DIR__ . './../../vendor/autoload.php';
    include("../../admin/config/config.php");
    if(isset($_POST['MaSanPham'])){
        $masp = $_POST['MaSanPham'];
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

    $options = array(
      'cluster' => 'ap1',
      'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
      '30ed1f7e3335254a038d',
      '3f789f38bc3fac9103e7',
      '1585283',
      $options
    );
    
    //lay ra thong tin nguoi dung tu session
    $sql_get_info = "SELECT * from nguoidung where TaiKhoan = '$username'";
    $stmt_get_info = $conn->prepare($sql_get_info);
    $stmt_get_info->execute();
    $row_get_info = $stmt_get_info->fetch();
    $MaNguoiDung = $row_get_info['MaNguoiDung'];

    //lay ra gio hang cua nguoi dung
    $sql_get_cart = "SELECT * FROM donhang where MaNguoiDung = $MaNguoiDung and TrangThaiDonHang = 'Giỏ hàng' ORDER BY NgayLap DESC LIMIT 1";
    $stmt_cart = $conn->prepare($sql_get_cart);
    $stmt_cart->execute();
    $row_cart = $stmt_cart->fetch();
    $madonhang = $row_cart['MaDonHang'];
    
    
    $sql_xoa = "DELETE FROM chitietdonhang WHERE masp = $masp and madonhang = $madonhang and size = '$Size'";
    $stmt = $conn->prepare($sql_xoa);
    $stmt->execute();

    $sql_update_soluong = "UPDATE Size set SoLuong = (SoLuong + $SoLuong) where MaSP = $masp and SizeSP = '$Size'";
    $stmt_update_soluong = $conn->prepare($sql_update_soluong);
    $stmt_update_soluong->execute();
    
    $sql_update_phiship = "update donhang set PhiShip = 15000*(SELECT COUNT(masp) from chitietdonhang WHERE donhang.MaDonHang = chitietdonhang.MaDonHang)";
    $stmt_phiship = $conn->prepare($sql_update_phiship);
    $stmt_phiship->execute();

    $sql_update_thanhtien = "update chitietdonhang set ThanhTien = DonGia*SoLuongDatMua";
    $stmt_thanhtien = $conn->prepare($sql_update_thanhtien);
    $stmt_thanhtien->execute();

    $sql_update_tongtien = "update donhang set tongtien = (select sum(ThanhTien) from chitietdonhang where donhang.MaDonHang = chitietdonhang.MaDonHang)+PhiShip";
    $stmt_tongtien = $conn->prepare($sql_update_tongtien);
    $stmt_tongtien->execute();
      
    $sql_callback = "select tongtien, phiship from donhang where madonhang = $madonhang";
    $stmt_callback = $conn->prepare($sql_callback);
    $stmt_callback->execute();
    $row = $stmt_callback->fetch();

    $sql_count_product_callback = "select * from chitietdonhang where madonhang = $madonhang";
    $stmt_count_product_callback = $conn->prepare($sql_count_product_callback);
    $stmt_count_product_callback->execute();
    $tongsanpham = $stmt_count_product_callback->rowCount();

    $tamtinh = number_format(($row['tongtien']-$row['phiship']),0,',','.').'₫';
    $phiship = number_format($row['phiship'],0,',','.').'₫';
    $tongtien = number_format($row['tongtien'],0,',','.').'₫';

    $sql_databack = "select thanhtien from chitietdonhang where madonhang = $madonhang and masp = $masp";
    $stmt_databack = $conn->prepare($sql_databack);
    $stmt_databack->execute();
    $row_databack = $stmt_databack->fetch();

    // $databack = number_format($row_databack['thanhtien'],0,',','.');
    
    // echo json_encode($databack);


    $data['message'] = array(
        'tamtinh' => $tamtinh,
        'phiship' => $phiship,
        'tongtien' => $tongtien,
        'tongsanpham' => $tongsanpham,
        'masp' => $masp,
        'size' => $Size
    );
  
  $pusher->trigger('viettien', 'xoakhoigiohang', $data);
    
?>
<?php
  require __DIR__ . './../../vendor/autoload.php';
  include("../../admin/config/config.php");

  if(isset($_POST['masanpham'])){
    $masanpham = $_POST['masanpham'];
  }
  if(isset($_POST['madonhang'])){
    $madonhang = $_POST['madonhang'];
  }
  if(isset($_POST['soluong'])){
    $soluong = $_POST['soluong'];
  }
  if(isset($_POST['size'])){
    $size = $_POST['size'];
  }
  if(isset($_POST['thaotac'])){
    $thaotac = $_POST['thaotac'];
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

    $sql_check_soluong = "SELECT * FROM chitietdonhang WHERE masp = $masanpham and madonhang = $madonhang and size = '$size'";
    $stmt_check_soluong = $conn->prepare($sql_check_soluong);
    $stmt_check_soluong->execute();
    $row_check_soluong = $stmt_check_soluong->fetch();
    if($row_check_soluong['SoLuongDatMua']!=$soluong){
      if($thaotac=="tru"){
        $sql_update_soluong = "UPDATE Size set SoLuong = (SoLuong + 1) where MaSP = $masanpham and SizeSP = '$size'";
        $stmt_update_soluong = $conn->prepare($sql_update_soluong);
        $stmt_update_soluong->execute();
      }
      else{
        $sql_update_soluong = "UPDATE Size set SoLuong = (SoLuong - 1) where MaSP = $masanpham and SizeSP = '$size'";
        $stmt_update_soluong = $conn->prepare($sql_update_soluong);
        $stmt_update_soluong->execute();
      }
    }

    $sql_sua = "UPDATE chitietdonhang SET SoLuongDatMua = $soluong WHERE masp = $masanpham and madonhang = $madonhang and size = '$size'";
    $stmt = $conn->prepare($sql_sua);
    $stmt->execute();

    $sql_update_thanhtien = "update chitietdonhang set ThanhTien = DonGia*SoLuongDatMua";
    $stmt_thanhtien = $conn->prepare($sql_update_thanhtien);
    $stmt_thanhtien->execute();

    $sql_update_phiship = "update donhang set PhiShip = 15000*(SELECT COUNT(masp) from chitietdonhang WHERE donhang.MaDonHang = chitietdonhang.MaDonHang)";
    $stmt_phiship = $conn->prepare($sql_update_phiship);
    $stmt_phiship->execute();

    $sql_update_tongtien = "update donhang set tongtien = (select sum(ThanhTien) from chitietdonhang where donhang.MaDonHang = chitietdonhang.MaDonHang)+PhiShip";
    $stmt_tongtien = $conn->prepare($sql_update_tongtien);
    $stmt_tongtien->execute();

    $sql_callback = "select tongtien, phiship from donhang where madonhang = $madonhang";
    $stmt_callback = $conn->prepare($sql_callback);
    $stmt_callback->execute();
    $row = $stmt_callback->fetch();

    $tamtinh = number_format(($row['tongtien']-$row['phiship']),0,',','.').'₫';
    $phiship = number_format($row['phiship'],0,',','.').'₫';
    $tongtien = number_format($row['tongtien'],0,',','.').'₫';

    $sql_databack = "select thanhtien from chitietdonhang where madonhang = $madonhang and masp = $masanpham";
    $stmt_databack = $conn->prepare($sql_databack);
    $stmt_databack->execute();
    $row_databack = $stmt_databack->fetch();

    $databack = number_format($row_databack['thanhtien'],0,',','.');
    
    echo json_encode($databack);


    $data['message'] = array(
        'tamtinh' => $tamtinh,
        'phiship' => $phiship,
        'tongtien' => $tongtien
  );
  
  $pusher->trigger('viettien', 'my-event', $data);


?>
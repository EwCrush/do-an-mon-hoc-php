<?php 
    include("../../admin/config/config.php");
    require __DIR__ . './../../vendor/autoload.php';

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
      
    if(isset($_POST['fullname'])){
        $fullname = $_POST['fullname'];
    }

    if(isset($_POST['numberphone'])){
        $numberphone = $_POST['numberphone'];
    }

    if(isset($_POST['address'])){
        $address = $_POST['address'];
    }

    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }

    $sql_update = "update donhang set TenNguoiNhan = '$fullname', SDTNhanHang = '$numberphone', DiaChiGiaoHang = '$address' where MaDonHang = $id";
    $stmt = $conn->prepare($sql_update);
    $stmt->execute();

    $data['message'] = array(
        'fullname' => $fullname,
        'numberphone' => $numberphone,
        'address' => $address
  );
  
  $pusher->trigger('viettien', 'changeaddress', $data);
?>
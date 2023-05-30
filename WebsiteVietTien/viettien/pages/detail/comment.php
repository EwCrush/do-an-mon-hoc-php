<?php 
    include("../../admin/config/config.php");
    //require __DIR__ . './../../vendor/autoload.php';

    // $options = array(
    //     'cluster' => 'ap1',
    //     'useTLS' => true
    //   );
    //   $pusher = new Pusher\Pusher(
    //     '30ed1f7e3335254a038d',
    //     '3f789f38bc3fac9103e7',
    //     '1585283',
    //     $options
    //   );
      
    // if(isset($_POST['MaNguoiDung'])){
    //     $MaNguoiDung = $_POST['MaNguoiDung'];
    // }

    if(isset($_POST['MaSanPham'])){
        $MaSanPham = $_POST['MaSanPham'];
    }

    if(isset($_POST['NoiDung'])){
        $NoiDung = $_POST['NoiDung'];
    }

    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if(!$username || $username == "root"){
        $data = 0;
    }

    else{
        $data = 1;
        $sql_check= "SELECT * FROM nguoidung where TaiKhoan = '$username'";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute();
        $row = $stmt_check->fetch();
        $MaNguoiDung = $row['MaNguoiDung'];

        $sql_themcmt= "INSERT INTO binhluan (NoiDungBinhLuan, NgayBinhLuan, MaNguoiDung, MaSP) values ('$NoiDung', CURRENT_TIMESTAMP(), $MaNguoiDung, $MaSanPham)";
        $stmt = $conn->prepare($sql_themcmt);
        $stmt->execute();
    }

//     $data['message'] = array(
//         'fullname' => $fullname,
//         'numberphone' => $numberphone,
//         'address' => $address
//   );
  
//   $pusher->trigger('viettien', 'changeaddress', $data);

    echo json_encode($data)
?>
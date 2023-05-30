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
      
    if(isset($_POST['MaTraLoi'])){
        $MaTraLoi = $_POST['MaTraLoi'];
    }

    if(isset($_POST['NoiDung'])){
        $NoiDung = $_POST['NoiDung'];
    }

    if(isset($_SESSION['TaiKhoan'])){
      $username = $_SESSION['TaiKhoan'];
    } 

    
    if($username && $username!="root"){
      //lay ra thong tin nguoi dung tu session
      $sql_check_user_from_ss = "SELECT * FROM nguoidung where TaiKhoan = '$username'";
      $stmt_check_user_from_ss = $conn->prepare($sql_check_user_from_ss);
      $stmt_check_user_from_ss->execute();
      $row_ss = $stmt_check_user_from_ss->fetch();
      $MaNguoiDung = $row_ss['MaNguoiDung'];
      $Quyen = $row_ss['MaQuyen'];

      //lay ra thong tin nguoi dung tu reply
      $sql_check_user_from_reply = "SELECT * FROM TraLoiBinhLuan where MaTraLoi = $MaTraLoi";
      $stmt_check_user_from_reply = $conn->prepare($sql_check_user_from_reply);
      $stmt_check_user_from_reply->execute();
      $row_reply = $stmt_check_user_from_reply->fetch();
      $MaNguoiTraLoi = $row_reply['MaNguoiDung'];

      if($MaNguoiDung==$MaNguoiTraLoi){
        $sql_update = "UPDATE traloibinhluan SET NoiDungTraLoi = '$NoiDung' where MaTraLoi = $MaTraLoi";
        $stmt = $conn->prepare($sql_update);
        $stmt->execute();


        $data['message'] = array(
            'noidung' => $NoiDung,
            'id' => $MaTraLoi,
        );
      
        $pusher->trigger('viettien', 'editreply', $data);
      }
    }
?>
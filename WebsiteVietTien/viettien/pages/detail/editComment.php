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
      
    if(isset($_POST['MaBinhLuan'])){
        $MaBinhLuan = $_POST['MaBinhLuan'];
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

      //lay ra thong tin nguoi dung tu comment
      $sql_check_user_from_comment = "SELECT * FROM BinhLuan where MaBinhLuan = $MaBinhLuan";
      $stmt_check_user_from_comment = $conn->prepare($sql_check_user_from_comment);
      $stmt_check_user_from_comment->execute();
      $row_comment = $stmt_check_user_from_comment->fetch();
      $MaNguoiBinhLuan = $row_comment['MaNguoiDung'];

      if($MaNguoiDung==$MaNguoiBinhLuan){
        $sql_update = "UPDATE binhluan SET NoiDungBinhLuan = '$NoiDung' where MaBinhLuan = $MaBinhLuan";
        $stmt = $conn->prepare($sql_update);
        $stmt->execute();
        
        $data['message'] = array(
            'noidung' => $NoiDung,
            'id' => $MaBinhLuan,
        );
      
        $pusher->trigger('viettien', 'editcomment', $data);
      }
    }
?>
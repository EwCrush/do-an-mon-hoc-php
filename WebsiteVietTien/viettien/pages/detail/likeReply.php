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

    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if(!$username || $username == "root"){
        $databack = 0;
    }

    else{

        $databack = 1;
        //lay ra thong tin nguoi dung tu session
        $sql_check_user_from_ss = "SELECT * FROM nguoidung where TaiKhoan = '$username'";
        $stmt_check_user_from_ss = $conn->prepare($sql_check_user_from_ss);
        $stmt_check_user_from_ss->execute();
        $row_ss = $stmt_check_user_from_ss->fetch();
        $MaNguoiDung = $row_ss['MaNguoiDung'];

        //lay ra thong tin nguoi dung va ma san pham tu reply
        $sql_check_user_from_reply = "SELECT TraLoiBinhLuan.MaNguoiDung, MaSP FROM TraLoiBinhLuan, BinhLuan where BinhLuan.MaBinhLuan = TraLoiBinhLuan.MaBinhLuan and MaTraLoi = $MaTraLoi";
        $stmt_check_user_from_reply = $conn->prepare($sql_check_user_from_reply);
        $stmt_check_user_from_reply->execute();
        $row_reply = $stmt_check_user_from_reply->fetch();
        $MaSanPham = $row_reply['MaSP'];
        $MaNguoiNhanThongBao = $row_reply['MaNguoiDung'];

        $sql_check = "SELECT * FROM thichtraloibinhluan where MaTraLoi = $MaTraLoi and MaNguoiDung = $MaNguoiDung";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute();
        $liked = $stmt_check->rowCount();

        if($liked > 0){
            $sql_unlike = "DELETE FROM thichtraloibinhluan where MaTraLoi = $MaTraLoi and MaNguoiDung = $MaNguoiDung";
            $stmt_unlike = $conn->prepare($sql_unlike);
            $stmt_unlike->execute();
        }
        else{
            $sql_like = "INSERT INTO thichtraloibinhluan (MaTraLoi, MaNguoiDung) values ($MaTraLoi, $MaNguoiDung)";
            $stmt_like = $conn->prepare($sql_like);
            $stmt_like->execute();
        }

        if($MaNguoiDung != $MaNguoiNhanThongBao){
            $sql_check_notify = "SELECT * FROM thongbao where MaLoaiThongBao = 2 and MaNguoiDung = $MaNguoiNhanThongBao and MaNguoiTuongTac = $MaNguoiDung and MaSP = $MaSanPham and MaNguon = $MaTraLoi and LoaiNguon = 'Trả lời'";
            $stmt_check_notify = $conn->prepare($sql_check_notify);
            $stmt_check_notify->execute();
            $row_check_notify = $stmt_check_notify->rowCount();
            if($row_check_notify>0){
                $sql_update_notify = "UPDATE thongbao SET trangthai = 'Chưa xem', ThoiGian = CURRENT_TIMESTAMP() where MaLoaiThongBao = 2 and MaNguoiDung = $MaNguoiNhanThongBao and MaNguoiTuongTac = $MaNguoiDung and MaSP = $MaSanPham and MaNguon = $MaTraLoi and LoaiNguon = 'Trả lời'";
                $stmt_update_notify = $conn->prepare($sql_update_notify);
                $stmt_update_notify->execute();
            }
            else{
                $sql_add_notify = "INSERT INTO thongbao (maloaithongbao, manguoidung, manguoituongtac, masp, manguon, loainguon, trangthai, thoigian) values (2, $MaNguoiNhanThongBao, $MaNguoiDung, $MaSanPham, $MaTraLoi, 'Trả lời', 'Chưa xem',  CURRENT_TIMESTAMP())";
                $stmt_add_notify = $conn->prepare($sql_add_notify);
                $stmt_add_notify->execute();
            }
        }

        $sql_count = "SELECT * FROM thichtraloibinhluan where MaTraLoi = $MaTraLoi";
        $stmt_count = $conn->prepare($sql_count);
        $stmt_count->execute();
        $count = $stmt_count->rowCount();


        $data['message'] = array(
            'count' => $count,
            'id' => $MaTraLoi,
        );
    
        $pusher->trigger('viettien', 'likereply', $data);
    }

    echo json_encode($databack);

    
?>
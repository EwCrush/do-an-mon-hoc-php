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

        //lay ra thong tin nguoi dung tu comment
        $sql_check_user_from_comment = "SELECT * FROM BinhLuan where MaBinhLuan = $MaBinhLuan";
        $stmt_check_user_from_comment = $conn->prepare($sql_check_user_from_comment);
        $stmt_check_user_from_comment->execute();
        $row_comment = $stmt_check_user_from_comment->fetch();
        $MaSanPham = $row_comment['MaSP'];
        $MaNguoiNhanThongBao = $row_comment['MaNguoiDung'];

        //kiem tra xem nguoi dung da thich binh luan chua 
        $sql_check = "SELECT * FROM thichbinhluan where MaBinhLuan = $MaBinhLuan and MaNguoiDung = $MaNguoiDung";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute();
        $liked = $stmt_check->rowCount();

        if($liked > 0){
            $sql_unlike = "DELETE FROM thichbinhluan where MaBinhLuan = $MaBinhLuan and MaNguoiDung = $MaNguoiDung";
            $stmt_unlike = $conn->prepare($sql_unlike);
            $stmt_unlike->execute();
        }
        else{
            $sql_like = "INSERT INTO thichbinhluan (MaBinhLuan, MaNguoiDung) values ($MaBinhLuan, $MaNguoiDung)";
            $stmt_like = $conn->prepare($sql_like);
            $stmt_like->execute();
        }

        if($MaNguoiDung != $MaNguoiNhanThongBao){
            $sql_check_notify = "SELECT * FROM thongbao where MaLoaiThongBao = 1 and MaNguoiDung = $MaNguoiNhanThongBao and MaNguoiTuongTac = $MaNguoiDung and MaSP = $MaSanPham and MaNguon = $MaBinhLuan and LoaiNguon = 'Bình luận'";
            $stmt_check_notify = $conn->prepare($sql_check_notify);
            $stmt_check_notify->execute();
            $row_check_notify = $stmt_check_notify->rowCount();
            if($row_check_notify>0){
                $sql_update_notify = "UPDATE thongbao SET trangthai = 'Chưa xem', ThoiGian = CURRENT_TIMESTAMP() where MaLoaiThongBao = 1 and MaNguoiDung = $MaNguoiNhanThongBao and MaNguoiTuongTac = $MaNguoiDung and MaSP = $MaSanPham and MaNguon = $MaBinhLuan and LoaiNguon = 'Bình luận'";
                $stmt_update_notify = $conn->prepare($sql_update_notify);
                $stmt_update_notify->execute();
            }
            else{
                $sql_add_notify = "INSERT INTO thongbao (maloaithongbao, manguoidung, manguoituongtac, masp, manguon, loainguon, trangthai, thoigian) values (1, $MaNguoiNhanThongBao, $MaNguoiDung, $MaSanPham, $MaBinhLuan, 'Bình luận', 'Chưa xem',  CURRENT_TIMESTAMP())";
                $stmt_add_notify = $conn->prepare($sql_add_notify);
                $stmt_add_notify->execute();
            }
        }

        $sql_count = "SELECT * FROM thichbinhluan where MaBinhLuan = $MaBinhLuan";
        $stmt_count = $conn->prepare($sql_count);
        $stmt_count->execute();
        $count = $stmt_count->rowCount();


        $data['message'] = array(
            'count' => $count,
            'id' => $MaBinhLuan,
        );
    
        $pusher->trigger('viettien', 'likecomment', $data);
    }

    echo json_encode($databack)
?>
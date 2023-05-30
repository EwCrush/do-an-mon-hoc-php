<?php 
    include("../../admin/config/config.php");

    if(isset($_POST['MaBinhLuan'])){
        $MaBinhLuan = $_POST['MaBinhLuan'];
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

        $sql_themreply= "INSERT INTO traloibinhluan (NoiDungTraLoi, NgayTraLoi, MaNguoiDung, MaBinhLuan) values ('$NoiDung', CURRENT_TIMESTAMP(), $MaNguoiDung, $MaBinhLuan)";
        $stmt = $conn->prepare($sql_themreply);
        $stmt->execute();

        //tao thong bao cho nguoi dung
        if($MaNguoiDung != $MaNguoiNhanThongBao){ 
            $sql_check_notify = "SELECT * FROM thongbao where MaLoaiThongBao = 3 and MaNguoiDung = $MaNguoiNhanThongBao and MaNguoiTuongTac = $MaNguoiDung and MaSP = $MaSanPham and MaNguon = $MaBinhLuan and LoaiNguon = 'Bình luận'";
            $stmt_check_notify = $conn->prepare($sql_check_notify);
            $stmt_check_notify->execute();
            $row_check_notify = $stmt_check_notify->rowCount();
            if($row_check_notify>0){
                $sql_update_notify = "UPDATE thongbao SET trangthai = 'Chưa xem', ThoiGian = CURRENT_TIMESTAMP() where MaLoaiThongBao = 3 and MaNguoiDung = $MaNguoiNhanThongBao and MaNguoiTuongTac = $MaNguoiDung and MaSP = $MaSanPham and MaNguon = $MaBinhLuan and LoaiNguon = 'Bình luận'";
                $stmt_update_notify = $conn->prepare($sql_update_notify);
                $stmt_update_notify->execute();
            }
            else{
                $sql_add_notify = "INSERT INTO thongbao (maloaithongbao, manguoidung, manguoituongtac, masp, manguon, loainguon, trangthai, thoigian) values (3, $MaNguoiNhanThongBao, $MaNguoiDung, $MaSanPham, $MaBinhLuan, 'Bình luận', 'Chưa xem',  CURRENT_TIMESTAMP())";
                $stmt_add_notify = $conn->prepare($sql_add_notify);
                $stmt_add_notify->execute();
            }
        }
    }

    // if(isset($_POST['MaSanPham'])){
    //     $MaSanPham = $_POST['MaSanPham'];
    // }

    // if(isset($_POST['MaNguoiNhanThongBao'])){
    //     $MaNguoiNhanThongBao = $_POST['MaNguoiNhanThongBao'];
    // }

    echo json_encode($data)

?>
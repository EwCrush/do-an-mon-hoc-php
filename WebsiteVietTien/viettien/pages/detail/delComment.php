<?php 
    include("../../admin/config/config.php");

    if(isset($_POST['MaBinhLuan'])){
        $MaBinhLuan = $_POST['MaBinhLuan'];
    }

    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if(!$username || $username == "root"){
        $data = 0;
    }
    else{

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

        if($MaNguoiDung == $MaNguoiBinhLuan || $Quyen == 1){
            $data = 1;
            $sql_checklikereply= "SELECT matraloi from traloibinhluan where mabinhluan = $MaBinhLuan";
            $stmt = $conn->prepare($sql_checklikereply);
            $stmt->execute();

            while($row_reply = $stmt->fetch()){
                $reply_ID = $row_reply['matraloi'];

                $sql_xoa_like_reply = "DELETE FROM thichtraloibinhluan where matraloi = $reply_ID";
                $stmt_xoa_like_reply = $conn->prepare($sql_xoa_like_reply);
                $stmt_xoa_like_reply->execute();
            }

            $sql_xoa_reply = "DELETE FROM traloibinhluan where mabinhluan = $MaBinhLuan";
            $stmt_xoa_reply = $conn->prepare($sql_xoa_reply);
            $stmt_xoa_reply->execute();

            $sql_xoa_like_cmt = "DELETE FROM thichbinhluan where mabinhluan = $MaBinhLuan";
            $stmt_xoa_like_cmt = $conn->prepare($sql_xoa_like_cmt);
            $stmt_xoa_like_cmt->execute();

            $sql_xoa_cmt = "DELETE FROM binhluan where mabinhluan = $MaBinhLuan";
            $stmt_xoa_cmt = $conn->prepare($sql_xoa_cmt);
            $stmt_xoa_cmt->execute();
        }
        else{
            $data = 0;
        }

        
    }

    echo json_encode($data)

    


    // $sql_themcmt= "INSERT INTO binhluan (NoiDungBinhLuan, NgayBinhLuan, MaNguoiDung, MaSP) values ('$NoiDung', CURRENT_TIMESTAMP(), $MaNguoiDung, $MaSanPham)";
    // $stmt = $conn->prepare($sql_themcmt);
    // $stmt->execute();

//     $data['message'] = array(
//         'fullname' => $fullname,
//         'numberphone' => $numberphone,
//         'address' => $address
//   );
  
//   $pusher->trigger('viettien', 'changeaddress', $data);
?>
<?php 
    include("../../config/config.php");

    if(isset($_POST['MaBinhLuan'])){
        $MaBinhLuan = $_POST['MaBinhLuan'];
    }

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

    
    echo json_encode($data);
?>
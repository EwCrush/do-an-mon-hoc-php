<?php 
    include("../../config/config.php");
      
    if(isset($_POST['MaTraLoi'])){
        $MaTraLoi = $_POST['MaTraLoi'];
    }


    $sql_xoalike= "DELETE from thichtraloibinhluan where MaTraLoi = $MaTraLoi";
    $stmt_xoalike = $conn->prepare($sql_xoalike);
    $stmt_xoalike->execute();

    $sql_xoareply= "DELETE from traloibinhluan where MaTraLoi = $MaTraLoi";
    $stmt_xoareply = $conn->prepare($sql_xoareply);
    $stmt_xoareply->execute();

    echo json_encode($data);
?>
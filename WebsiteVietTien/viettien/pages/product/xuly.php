<h1>hello</h1>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if(isset($_GET['size'])){
        $size = $_GET['size'];
    }
    if(isset($_GET['soluong'])){
        $soluong = $_GET['soluong'];
    }
    if(isset($_GET['giaban'])){
        $giaban = $_GET['giaban'];
    }

    echo $size;
    echo '</br>';
    echo $id;
    echo '</br>';
    echo $soluong;
    echo '</br>';
    echo 'gia ban '.$giaban;
    echo '</br>';
    echo 'thanh tien '.($giaban*$soluong);
?>
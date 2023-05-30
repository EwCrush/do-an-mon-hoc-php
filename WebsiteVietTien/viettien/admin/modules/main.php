<?php 
    if(isset($_GET['action'])){
        $act = $_GET['action'];
    }
    else{
        $act = '';
    }

    switch($act){
        case 'quanlyloaisanpham':
            include("quanlyloaisp/danhsach.php");
            break;
        case 'sualoaisanpham':
            include("quanlyloaisp/sua.php");
            break;
        case 'themloaisanpham':
            include("quanlyloaisp/them.php");
            break;
        case 'xoaloaisanpham':
            include("quanlyloaisp/xuly.php");
            break;
        case 'timkiemloaisanpham':
            include("quanlyloaisp/timkiem.php");
            break;
        case 'quanlysanpham':
            include("quanlysp/danhsach.php");
            break;
        case 'suasanpham':
            include("quanlysp/sua.php");
            break;
        case 'themsanpham':
            include("quanlysp/them.php");
            break;
        case 'xoasanpham':
            include("quanlysp/xuly.php");
            break;
        case 'ansanpham':
            include("quanlysp/xuly.php");
            break;
        case 'kichhoatsanpham':
            include("quanlysp/xuly.php");
            break;
        case 'thongtinthem':
            include("quanlysp/thongtinthem.php");
            break;
        case 'thongtinchitiet':
            include("quanlysp/thongtinchitietsp/thongtinchitiet.php");
            break;
        case 'suathongtinchitiet':
            include("quanlysp/thongtinchitietsp/sua.php");
            break;
        case 'themthongtinchitiet':
            include("quanlysp/thongtinchitietsp/them.php");
            break;
        case 'xoathongtinchitiet':
            include("quanlysp/thongtinchitietsp/xuly.php");
            break;   
        case 'sizesanpham':
            include("quanlysp/sizesanpham/danhsachsize.php");
            break;  
        case 'themsize':
            include("quanlysp/sizesanpham/them.php");
            break;
        case 'suasize':
            include("quanlysp/sizesanpham/sua.php");
            break;
        case 'xoasize':
            include("quanlysp/sizesanpham/xuly.php");
            break;
        case 'thuvienanh':
            include("quanlysp/thuvienanh/danhsachanh.php");
            break;  
        case 'themanh':
            include("quanlysp/thuvienanh/them.php");
            break;
        case 'suaanh':
            include("quanlysp/thuvienanh/sua.php");
            break;
        case 'xoaanh':
            include("quanlysp/thuvienanh/xuly.php");
            break;
        case 'quanlynguoidung':
            include("quanlynguoidung/danhsach.php");
            break;
        case 'hanchenguoidung':
            include("quanlynguoidung/hanchenguoidung/danhsach.php");
            break;
        case 'themhanche':
            include("quanlynguoidung/hanchenguoidung/them.php");
            break;
        case 'suahanche':
            include("quanlynguoidung/hanchenguoidung/sua.php");
            break;
        case 'xoahanche':
            include("quanlynguoidung/hanchenguoidung/xuly.php");
            break;
        case 'quanlydonhang':
            include("quanlydonhang/danhsach.php");
            break;
        case 'thongtinthemdonhang':
            include("quanlydonhang/thongtinthem.php");
            break;
        case 'sanphamgiohang':
            include("quanlydonhang/sanphamgiohang.php");
            break;
        case 'xacnhandonhang':
            include("quanlydonhang/xacnhandonhang.php");
            break;
        case 'capnhatdonhang':
            include("quanlydonhang/capnhatdonhang.php");
            break;
        case 'quanlybinhluan':
            include("quanlybinhluan/binhluan.php");
            break;
        case 'quanlyphanhoi':
            include("quanlybinhluan/phanhoi.php");
            break;
        // case 'quanlybaocao':
        //     include("quanlybaocao/danhsach.php");
        //     break;
    }
    // elseif($act=='timkiemsanpham'){
    //     include("quanlysp/timkiem.php");
    // }

    
    
    
?>
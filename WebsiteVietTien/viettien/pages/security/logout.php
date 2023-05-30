<?php
    // setcookie("TaiKhoan", $username, (time()-(60*60*24*365)), "/", "", 0);
    // setcookie("MaQuyen", $row['MaQuyen'], (time()-(60*60*24*365)), "/", "", 0);
    unset($_SESSION['TaiKhoan']);
    unset($_SESSION['MaQuyen']);
    echo '<script> window.location.href="../../index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1";</script>';
?>
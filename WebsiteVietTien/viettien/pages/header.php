<?php
    // if( empty(session_id()) && !headers_sent()){
    //     session_start();
    // }
    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if(isset($_SESSION['MaQuyen'])){
        $role = $_SESSION['MaQuyen'];
    }

    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
    }
    else $keyword = '';

    if(isset($_GET['danhmuc'])){
        $danhmuc = $_GET['danhmuc'];
    }
    else $danhmuc = '';

    if($danhmuc!="tatcasanpham" && $danhmuc!=""){
        $sql_danhsach_loaisp_getlabel = "SELECT * FROM loaisp where MaLoaiSP = $danhmuc";
        $stmt_label = $conn->prepare($sql_danhsach_loaisp_getlabel);
        $stmt_label->execute();
        $rowlabel = $stmt_label->fetch();
        $label = $rowlabel["TenLoaiSP"];
    }
    else {
        $label = 'Tất cả';
    }
    if($username && $username!="root"){
        $sql_user_ss = "SELECT * from nguoidung where TaiKhoan = '$username'";
        $stmt_ss = $conn->prepare($sql_user_ss);
        $stmt_ss->execute();
        $row_ss = $stmt_ss->fetch();
        $userid_from_ss = $row_ss['MaNguoiDung'];

        //lay gio hang gan nhat cua nguoi dung
        $sql_get_cart = "SELECT madonhang, nguoidung.MaNguoiDung, TenNguoiDung, TaiKhoan, SDTNhanHang, SDT, DiaChi, TenNguoiNhan, PhiShip, tongtien, DiaChiGiaoHang FROM nguoidung, donhang where nguoidung.MaNguoiDung = donhang.MaNguoiDung and TaiKhoan = '$username' and TrangThaiDonHang = 'Giỏ hàng' ORDER BY NgayLap DESC LIMIT 1";
        $stmt_cart = $conn->prepare($sql_get_cart);
        $stmt_cart->execute();
        $row_cart = $stmt_cart->fetch();
        $rowcount_getcart = $stmt_cart->rowCount();

        if($rowcount_getcart>0){

        
        $madonhang = $row_cart['madonhang'];

        //lay tat ca san pham trong gio hang
        $sql_get_cart = "SELECT MaDonHang, chitietdonhang.MaSP, Size, DonGia, SoLuong, ThanhTien, TenSP, GiaBan, GiaSale, MauSac, SoLuongDatMua, HinhAnh from ChiTietDonHang, sanpham where chitietdonhang.MaSP = sanpham.MaSP and MaDonHang = $madonhang";
        $stmt_cart = $conn->prepare($sql_get_cart);
        $stmt_cart->execute();
        $sptronggio = $stmt_cart->rowCount();
        //echo $username;
        }
    }

?>
<header class="header">
            <div class="grid">
                <nav class="navbar">
                    <ul class="navbar-list">
                        <li class="navbar-item navbar-item-qr navbar-item--wall">
                            Vào cửa hàng trên ứng dụng Việt Tiến Estore
                            <div class="qr">
                                <img src="../img/qrcode.png" alt="" class="qr-img">
                                <div class="app">
                                    <a href="https://apps.apple.com/us/app/vi%E1%BB%87t-ti%E1%BA%BFn/id1449352643" target ="_blank" class="app-link">
                                        <img src="../img/appstore.png" alt="" class="app-img">
                                    </a>
                                    <a href="https://play.google.com/store/apps/details?id=com.viettien.app&hl=vi&gl=US&pli=1" target ="_blank" class="app-link">
                                        <img src="../img/ggplay.png" alt="" class="app-img">
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="navbar-item">
                            <span class="navbar-item--nopointer">Kết nối</span>
                            <a href="https://www.facebook.com/viettien/" target ="_blank" class="navbar-item-icon">
                                <i class="navbar-icon fa-brands fa-facebook"></i>
                            </a>
                            <a href="https://www.instagram.com/viettienfashioninternational/" target ="_blank" class="navbar-item-icon">
                                <i class="navbar-icon fa-brands fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-list">
                        <li class="navbar-item navbar-item-notify <?php if(!$username || $username=="root") echo 'navbar-item-notify-no-user' ?>">
                            <a href="" class="navbar-item-link">
                                <?php 
                                    if($username && $username!="root"){
                                        $sql_newnotify = "SELECT * from thongbao where TrangThai = 'Chưa xem' and MaNguoiDung = $userid_from_ss";
                                        $stmt_newnotify = $conn->prepare($sql_newnotify);
                                        $stmt_newnotify->execute();
                                        $rownewnotify = $stmt_newnotify->rowCount();
                                    }
                                ?>
                                <i class="navbar-icon fa-solid fa-bell <?php if($rownewnotify > 0 ) echo 'has-new-notify' ?>"></i>
                                Thông báo
                                <div class="notify">
                                    <header class="notify-header">
                                        <label class="new-notify">Thông báo</label>
                                    </header>
                                    <ul class="notify-list">
                                        <?php 
                                        if(!$username || $username!="root"){
                                            $sql_notify = "SELECT thongbao.maloaithongbao, mathongbao, avatar, tensp, tenloai, tennguoidung, thongbao.masp, manguon, loainguon, thongbao.trangthai, thoigian from nguoidung, loaithongbao, thongbao, sanpham WHERE sanpham.masp = thongbao.masp and nguoidung.MaNguoiDung = thongbao.manguoituongtac and thongbao.maloaithongbao = loaithongbao.maloaithongbao and thongbao.MaNguoiDung = $userid_from_ss order by thoigian desc";
                                            $stmt_notify = $conn->prepare($sql_notify);
                                            $stmt_notify->execute();
                                            while($row_notify = $stmt_notify->fetch()){

                                                $datediff = abs(time() - strtotime($row_notify['thoigian']));
                                                if($datediff < 60){
                                                    $thoigian = 'Vừa xong';
                                                }
                                                elseif($datediff < 3600 && $datediff >= 60){
                                                    $thoigian = floor($datediff /(60)).' phút trước';
                                                }
                                                elseif($datediff < 86400 && $datediff >= 3600){
                                                    $thoigian = floor($datediff /(3600)).' giờ trước';
                                                }
                                                elseif($datediff < 2678400 && $datediff >= 86400){
                                                    $thoigian = floor($datediff /(86400)).' ngày trước';
                                                }
                                                elseif($datediff < 31536000  && $datediff >= 2678400){
                                                    $thoigian = floor($datediff /(2678400)).' tháng trước';
                                                }
                                                else{
                                                    $thoigian = floor($datediff /(2678400)).' năm trước';
                                                }
                                                
                                                if($row_notify['loainguon']=="Bình luận"){
                                                    $link = 'index.php?detail='.$row_notify['masp'].'#comment-'.$row_notify['manguon'].'';
                                                }
                                                else {
                                                    $link = 'index.php?detail='.$row_notify['masp'].'#reply-'.$row_notify['manguon'].'';
                                                }
                                        ?>
                                        <li class="notify-item <?php if($row_notify['trangthai']=='Chưa xem') echo 'notify-item-unread' ?>">
                                            <a value="<?php echo $row_notify["mathongbao"] ?>" href="<?php echo $link ?>" class="notify-link">
                                                <img src="../admin/modules/quanlynguoidung/uploads/<?php echo $row_notify['avatar'] ?>" alt="" class="notify-img">
                                                <div class="notify-info">
                                                    <span class="notify-description"><b class="notify-description-name"><?php echo $row_notify['tennguoidung'] ?></b> đã <?php echo $row_notify['tenloai'] ?> của bạn về <?php if($row_notify['maloaithongbao']==2) echo 'bình luận trong' ?> sản phẩm <b class="notify-description-name"><?php echo $row_notify['tensp'] ?></b>.</span>
                                                    <span class="notify-info-time"><?php echo $thoigian ?></span>
                                                </div>
                                            </a>
                                        </li>
                                        <?php 
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <footer class="notify-footer">
                                        <a href="javascript:ReadAll(<?php echo $userid_from_ss ?>)" class="notify-footer-btn">Đánh dấu tất cả là đã đọc</a>
                                    </footer>
                                </div>
                            </a>
                        </li>
                        <li class="navbar-item">
                            <a href="" class="navbar-item-link">
                                <i class="navbar-icon fa-solid fa-circle-question"></i>
                                Trợ giúp
                            </a>
                        </li>
                        <li class="navbar-item navbar-language">
                            <i class="fa-solid fa-earth-asia"></i>
                            Tiếng việt
                            <i class="fa-solid fa-angle-down"></i>
                            <div class="select-language">
                                <ul class="language-list">
                                    <li class="language-item">
                                        <div class="language-item-flag-country">
                                            <img class="language-item-flag" src="/img/vietnam.png" alt="">
                                            <span class="language-item-name">Tiếng Việt</span>
                                        </div>
                                        <i class="language-item-icon fa-solid fa-check"></i>
                                    </li>
                                    <!-- <li class="language-item">Tiếng anh (English)</li> -->
                                </ul>
                            </div>
                        </li>

                        <li class="navbar-item navbar-item--bold navbar-item--wall signinlabel <?php if($username &&$username!="root") echo "user-logged-in" ?>">Đăng ký</li>
                        <li class="navbar-item navbar-item--bold loginlabel <?php if($username && $username!="root") echo "user-logged-in" ?>">Đăng nhập</li>
                        <li class="navbar-item navbar-user <?php if(!$username || $username=="root") echo "not-login"?>">
                            <img src="../admin/modules/quanlynguoidung/uploads/<?php echo $row_ss['Avatar'] ?>" alt="" class="user-avatar">
                            <!-- <span class="user-name">Nguyễn Thành Văn</span> -->
                            <div class="user-info">
                                <div class="user-info-heading">
                                    <div class="user-info-avatar">
                                        <img src="../admin/modules/quanlynguoidung/uploads/<?php echo $row_ss['Avatar'] ?>" alt="" class="user-info-avatar-img">
                                    </div>
                                    <div class="user-info-name-setting">
                                        <span class="user-name"><?php echo $row_ss['TenNguoiDung']?></span>
                                        <span class="user-setting-link">@<?php echo $row_ss['TaiKhoan']?></span>
                                    </div>
                                </div>
                                <div class="user-info-option">
                                    <ul class="user-info-option-list">
                                        <li class="user-info-option-item">
                                            <a href="index.php?profile" class="user-info-option-list-link">
                                                <i class="fa-solid fa-pen-to-square header-user-logout"></i>
                                                Chỉnh sửa thông tin cá nhân
                                            </a>
                                        </li>
                                        <li class="user-info-option-item">
                                            <a href="javascript:OpenChangePassword()" class="user-info-option-list-link">
                                                <i class="fa-solid fa-lock header-user-logout"></i>
                                                Đổi mật khẩu
                                            </a>
                                        </li>
                                        <li class="user-info-option-item">
                                            <a href="index.php?orders" class="user-info-option-list-link">
                                                <i class="fa-solid fa-truck-fast header-user-logout"></i>
                                                Đơn hàng của bạn
                                            </a>
                                        </li>
                                        <li class="user-info-option-item <?php if($role!="1") echo "not-admin-ss" ?>">
                                            <a href="../admin/index.php?action=quanlyloaisanpham&trang=1" class="user-info-option-list-link">
                                                <i class="fa-solid fa-wrench header-user-logout"></i>
                                                Đến trang quản lý
                                            </a>
                                        </li>
                                        <li class="user-info-option-item">
                                            <a href="../pages/security/logout.php" class="user-info-option-list-link user-logout">
                                                <i class="fa-solid fa-arrow-right-from-bracket header-user-logout"></i>    
                                                Đăng xuất
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="logo-search-cart">
                    <div class="logo">
                        <img src="../img/logoviettien.png" alt="" class="logo-img">
                    </div>
                    <div class="search">
                        <div class="search-input-wrap">
                            <input type="text" placeholder="Nhập vào sản phẩm cần tìm kiếm" class="search-input" value="<?php echo $keyword ?>">
                            <div class="search-history">
                                <h3 class="history-heading">Lịch sử tìm kiếm</h3>
                                <ul class="history-list">
                                    <li class="history-item">
                                        <a href="" class="history-item-link">giày Vans Old Skool</a>
                                    </li>
                                    <li class="history-item">
                                        <a href="" class="history-item-link">giày Adidas</a>
                                    </li>
                                    <li class="history-item">
                                        <a href="" class="history-item-link">tất Vans</a>
                                    </li>
                                    <li class="history-item">
                                        <a href="" class="history-item-link">balo Vans caro</a>
                                    </li>
                                    <li class="history-item">
                                        <a href="" class="history-item-link">giày Converse</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="search-select" value="<?php if($danhmuc=="tatcasanpham" || $danhmuc=="") echo "all"; else echo $danhmuc ?>">
                            <span class="search-select-label"><?php echo $label ?></span>
                            <i class="fa-solid fa-angle-down search-select-icon"></i> 
                            <ul class="search-option">
                                <li class="search-option-item item-checked" value="all">
                                    <span class="search-option-item-span">Tất cả</span>
                                    <i class="fa-solid fa-check"></i>
                                </li>
                                <?php 
                                    $sql_danhsach_loaisp = "SELECT MaLoaiSP, TenLoaiSP FROM loaisp";
                                    $stmt = $conn->prepare($sql_danhsach_loaisp);
                                    $stmt->execute(); 
                                    $i = 0;
                                    while($row = $stmt->fetch()){
                                ?>
                                <li class="search-option-item" value="<?php echo $row['MaLoaiSP'] ?>">
                                    <span class="search-option-item-span"><?php echo $row['TenLoaiSP']?></span>
                                    <i class="fa-solid fa-check"></i>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <button class="search-btn">
                            <i class="fa-solid fa-magnifying-glass search-btn-icon"></i>
                        </button>
                    </div>
                    <div class="cart">
                        <div class="cart-wrap no-item-found">
                            <div class="cart-list-no-item <?php if(!$username || $sptronggio==0) echo 'cart-active'?>">
                                <img src="../img/cart.svg" alt="" class="cart-list-no-item-img">
                                <div class="cart-list-no-item-text-container">
                                    <span class="cart-list-no-item-text">Không có sản phẩm nào trong giỏ hàng của bạn.</span> <br> <span>Vui lòng mua gì đó và quay lại sau!</span>
                                </div>
                            </div>
                            <i class="fa-sharp fa-solid fa-cart-shopping cart-icon"></i>
                            <span class="cart-notify <?php if($sptronggio==0) echo 'no-item-cart'?>"><?php echo $sptronggio ?></span>
                            <div class="cart-list <?php if($username && $sptronggio>0) echo 'cart-active'?>">
                                <h4 class="cart-heading">Sản phẩm đã thêm</h4>
                                <ul class="cart-list-item">
                                    <?php 
                                        if($username){
                                            while($row = $stmt_cart->fetch()){
                                    ?>
                                    <li class="cart-item" id="header-cart-<?php echo $row['MaSP']?>-<?php echo $row['Size'] ?>">
                                        <img src="/admin/modules/quanlysp/uploads/<?php echo $row['HinhAnh'] ?>" alt="" class="cart-img">
                                        <div class="cart-item-info">
                                            <div class="cart-item-info-heading">
                                                <span class="cart-item-name"><?php echo $row['TenSP'] ?></span>
                                                <div class="cart-item-total">
                                                    <span class="cart-item-price"><?php echo number_format($row['DonGia'],0,',','.').'₫' ?></span>
                                                    <span class="x">x</span>
                                                    <span class="amount"><?php echo $row['SoLuongDatMua'] ?></span>
                                                </div>
                                            </div>
                                            <div class="cart-item-info-body">
                                                <span class="type">Size: <?php echo $row['Size']?></span>
                                                <span class="cart-item-price-in-cart"><?php echo number_format($row['ThanhTien'],0,',','.').'₫' ?></span>
                                            </div>
                                        </div>
                                    </li>
                                    <?php 
                                        }
                                    }
                                    ?>
                                </ul>
                                <button class="btn btn-primary cart-view">
                                    <a href="index.php?cart" class="btn-go-to-cart">Xem giỏ hàng</a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="bar-tablet-mobile">
                        <i class="bar-tablet-mobile-icon fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>
        </header>    
        
<script>
    const label = document.querySelector(".search-select-label")
    const optiontext = document.querySelector(".search-option-item-span");
    const option = document.querySelector(".search-option-item")
    const optionContainer = document.querySelector(".search-select")
    const AllNotifies = document.querySelectorAll('.notify-item.notify-item-unread')

        $('.search-option .search-option-item').click(function() {
        $('.search-option .search-option-item.item-checked').removeClass('item-checked');
        $(this).closest('.search-option-item').addClass('item-checked');
        
        label.innerText = this.querySelector(".search-option-item-span").innerText;
        optionContainer.setAttribute('value', this.getAttribute('value'))
});

        const tukhoa = document.querySelector('.search-input')
              btntim = document.querySelector(".search-btn")
              link = ''
              
        
        btntim.addEventListener("click", function(){
            keyword = tukhoa.value
            if(optionContainer.getAttribute('value')==='all'){
                link = `index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1&keyword=${keyword}`
            }
            else{
                id = optionContainer.getAttribute('value')
                link = `index.php?action=danhsachsanpham&danhmuc=${id}&filter=tatca&order=desc&trang=1&keyword=${keyword}`
            }
            document.location.href = link
        });

        const logout = document.querySelector(".user-logout")

        function ReadAll(MaNguoiDung){
            // $('.notify-item .notify-item-unread').removeClass('notify-item-unread')
            for(const Notify of AllNotifies){
                Notify.classList.remove('notify-item-unread')
                $.post("../pages/detail/readAllNotify.php", {
                    "MaNguoiDung": MaNguoiDung
                })
            }
        }

        for(const Notify of AllNotifies){
            Notify.addEventListener("click", function(e){
                e.preventDefault();
                Notify.classList.remove("notify-item-unread")
                const notifyLink = Notify.querySelector(".notify-link")
                const idNotify = notifyLink.getAttribute("value")
                $.post("../pages/detail/readNotify.php", {
                    "MaThongBao": idNotify
                },function(data, status){
                    if(data==1){
                        window.location = notifyLink.href
                    }
                })
                //console.log(notifyLink)
            })
        }



        
</script>
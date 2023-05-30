<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <title>Việt Tiến</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/base.css">
    <!-- <link rel="stylesheet" href="../css/responsive.css"> -->
    <link href = "https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('30ed1f7e3335254a038d', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('viettien');
        channel.bind('my-event', function(data) {
            const tamtinh = data['message']['tamtinh'];
            const phiship = data['message']['phiship'];
            const tongtien = data['message']['tongtien'];
            const tamtinhText = document.querySelector(".cart-page-bill-initial-fee-price")
            const phishipText = document.querySelector(".cart-page-bill-shipping-fee-price")
            const tongtienText = document.querySelector(".cart-page-bill-total-fee-price")

            tamtinhText.innerText = tamtinh
            phishipText.innerText = phiship
            tongtienText.innerText = tongtien
        });

        channel.bind('xoakhoigiohang', function(data) {
            const tamtinh = data['message']['tamtinh'];
            const phiship = data['message']['phiship'];
            const tongtien = data['message']['tongtien'];
            const tongsanpham = data['message']['tongsanpham'];
            const masp = data['message']['masp'];
            const size = data['message']['size'];
            const tamtinhText = document.querySelector(".cart-page-bill-initial-fee-price")
            const phishipText = document.querySelector(".cart-page-bill-shipping-fee-price")
            const tongtienText = document.querySelector(".cart-page-bill-total-fee-price")
            const productCount = document.querySelector(".cart-page-pay")
            const headerProductCount = document.querySelector(".cart-notify")
            tamtinhText.innerText = tamtinh
            phishipText.innerText = phiship
            tongtienText.innerText = tongtien
            productCount.innerText = `Thanh toán (${tongsanpham})`
            headerProductCount.innerText = tongsanpham
            $(`#header-cart-${masp}-${size}`).slideUp()
        });

        // var channel = pusher.subscribe('viettien');
        channel.bind('changeaddress', function(data) {
            const fullname = data['message']['fullname'];
            const numberphone = data['message']['numberphone'];
            const address = data['message']['address'];
            const fullnameText = document.querySelector(".cart-page-address-shipping-info-shipping-name")
            const numberphoneText = document.querySelector(".cart-page-address-shipping-info-shipping-contact")
            const addressText = document.querySelector(".cart-page-address-shipping-info-shipping-address")

            fullnameText.innerText = fullname
            numberphoneText.innerText = numberphone
            addressText.innerText = address
            
        });

        channel.bind('likecomment', function(data) {
            const id = data['message']['id'];
            const count = data['message']['count'];

            const countText = document.querySelector(`#comment-${id} .detail-comments-about-product-like .detail-comments-about-product-like-count`)
            
            countText.innerText = `${count} lượt thích`
            
        });

        channel.bind('likereply', function(data) {
            const id = data['message']['id'];
            const count = data['message']['count'];

            const countText = document.querySelector(`#reply-${id} .detail-reply-comments-about-product-like .detail-comments-about-product-like-count`)
            
            countText.innerText = `${count} lượt thích`
            
        });

        channel.bind('editcomment', function(data) {
            const id = data['message']['id'];
            const noidung = data['message']['noidung'];

            const commentText = document.querySelector(`#comment-${id} .detail-comments-about-product-text`)
            
            commentText.innerText = noidung
            
        });

        channel.bind('editreply', function(data) {
            const id = data['message']['id'];
            const noidung = data['message']['noidung'];

            const commentText = document.querySelector(`#reply-${id} .detail-comments-about-product-text`)
            
            commentText.innerText = noidung
            
        });
    </script>
</head>
<?php 
   
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    include("./admin/config/config.php");
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
    if($username){
        $sql_user_ss = "SELECT * from nguoidung where TaiKhoan = '$username'";
        $stmt_ss = $conn->prepare($sql_user_ss);
        $stmt_ss->execute();
        $row_ss = $stmt_ss->fetch();

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

        //lay ra ten, sdt va dia chi cua nguoi nhan da tung su dung
        // $sql_get_info_from_bills = "SELECT tennguoinhan, diachigiaohang, sdtnhanhang from donhang, nguoidung where donhang.MaNguoiDung = nguoidung.MaNguoiDung and taikhoan = '$username'";
        // $stmt_get_info_from_bills = $conn->prepare($sql_get_info_from_bills);
        // $stmt_get_info_from_bills->execute();
        // while($row = $stmt_get_info_from_bills->fetch()){
        //     echo $row['tennguoinhan'];
        // }

        //lay ra ten, sdt, diachi cua nguoi nhan 
        // $sql_get_info = "SELECT * from nguoidung where taikhoan = '$username'";
        // $stmt_get_info = $conn->prepare($sql_get_info);
        // $stmt_get_info->execute();
        // $row_info = $stmt_get_info->fetch();
        }

        
    }
    
?>
<body>
    <div class="main">
        <?php
            include("admin/config/config.php");
            include("pages/header.php");
            if(isset($_GET['detail'])){
                include("pages/product/detail.php");
            }
            elseif(isset($_GET['cart'])){
                include("pages/cart/cart.php");
            }
            elseif(isset($_GET['profile'])){
                include("pages/editprofile/editprofile.php");
            }
            elseif(isset($_GET['orders'])){
                include("pages/orders/orders.php");
            }
            else{
                include("pages/main.php");
            }
            
            // <!-- include("pages/main.php"); -->
            include("pages/footer.php");
        ?>
    </div>
    <!-- modal -->
    <div class="modal">
        <div class="modal__overlay">

        </div>
        <div class="modal__body">
            <div class="bs-auth-form-container">
                <div class="bs-auth-forms">
                    <div class="bs-auth-form login">
                        <span class="bs-auth-form-title">Login</span>

                        <form action="#">
                            <div class="input-field">
                                <input type="text" placeholder="Enter your username" required class="login-username-value" value="<?php if(isset($_COOKIE["username"])) echo $_COOKIE["username"]; ?>">
                                <i class="uil uil-user bs-auth-form-icon"></i>></i>
                            </div>
                            <div class="input-field">
                                <input type="password" class="bs-auth-form-password login-password-value" placeholder="Enter your password" required value="<?php if(isset($_COOKIE["password"])) echo $_COOKIE["password"]; ?>">
                                <i class="uil uil-lock bs-auth-form-icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>

                            <div class="checkbox-text">
                                <div class="checkbox-content">
                                    <input type="checkbox" id="logCheck" value="checked" <?php if(isset($_COOKIE["username"])) echo "checked" ?>>
                                    <label for="logCheck" class="bs-auth-form-text">Remember me</label>
                                </div>
                                <a href="#" class="bs-auth-form-text bs-auth-form-forgetpassword">Forgot password?</a>
                            </div>

                            <div class="input-field bs-auth-form-button">
                                <input type="submit" value="Login" class="loginSubmit">
                            </div>
                        </form>

                        <div class="login-signup">
                            <span class="bs-auth-form-text">Not a member?
                                <a href="#" class="bs-auth-form-text signup-link">Signup Now</a>
                            </span>
                        </div>
                    </div>

                    <!-- Registration Form -->
                    <div class="bs-auth-form signup">
                        <span class="bs-auth-form-title">Registration</span>
                        <form action="">
                            <div class="input-field">
                                <input type="text" placeholder="Enter your name" class="signup-name-value" required>
                                <!-- <i class="uil uil-user icon"></i> -->
                                <i class="fa-regular fa-id-card bs-auth-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="text" placeholder="Pick a username" class="signup-username-value" required>
                                <i class="uil uil-user bs-auth-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="email" placeholder="Enter your email" class="signup-email-value" required>
                                <i class="uil uil-envelope bs-auth-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" class="bs-auth-form-password signup-password-value" placeholder="Create a password" required>
                                <i class="uil uil-lock bs-auth-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" class="bs-auth-form-password signup-confirm-value" placeholder="Confirm a password" required>
                                <i class="uil uil-lock bs-auth-form-icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>

                            <div class="checkbox-text">
                                <div class="checkbox-content">
                                    <input type="checkbox" id="termCon">
                                    <label for="termCon" class="bs-auth-form-text">I accepted all terms and conditions</label>
                                </div>
                            </div>

                            <div class="input-field bs-auth-form-button">
                                <input type="submit" value="Signup" class="signupSubmit">
                            </div>
                        </form>

                        <div class="login-signup">
                            <span class="bs-auth-form-text">Already a member?
                                <a href="#" class="bs-auth-form-text login-link">Login Now</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="forget-password-form-container">
                <div class="forget-password-forms">
                    <!-- Find Account Form -->
                    <div class="forget-password-form find-password">
                        <span class="forget-password-form-title">Find Your Account</span>

                        <form action="#">
                            <div class="input-field">
                                <input type="text" placeholder="Enter your username" required class="forgetpassword-username-value">
                                <i class="uil uil-user forget-password-form-icon"></i>></i>
                            </div>
                            <div class="input-field">
                                <input type="email" placeholder="Enter your email" class="forgetpassword-email-value" required>
                                <i class="uil uil-envelope forget-password-form-icon"></i>
                            </div>
                            <div class="input-field forget-password-form-button">
                                <input type="submit" value="Check" class="find-account-submit">
                            </div>
                        </form>
                        <div class="findPW-resetPW">
                            <span class="forget-password-form-text">Back to
                                <a href="#" class="forget-password-form-text forgetpassword-login-link">Login</a>
                            </span>
                        </div>
                    </div>

                    <!-- Reset Password Form -->
                    <div class="forget-password-form reset-password">
                        <span class="forget-password-form-title">Reset Your Password</span>
                        <form action="">
                            <div class="input-field">
                                <input type="password" class="forget-password-form-password bs-auth-form-password forgetpassword-password-value" placeholder="Create a new password" required>
                                <i class="uil uil-lock forget-password-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" class="forget-password-form-password bs-auth-form-password forgetpassword-confirm-value" placeholder="Confirm a password" required>
                                <i class="uil uil-lock forget-password-form-icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>
                            <div class="input-field forget-password-form-button">
                                <input type="submit" value="Reset" class="reset-password-submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="change-address-form-container" value="<?php echo $madonhang ?>">
                <div class="change-address-forms">
                    <!-- New Address Form -->
                    <div class="change-address-form find-address">
                        <span class="change-address-form-title">Use New Address</span>

                        <form action="#">
                        <div class="input-field">
                                <input type="text" placeholder="Enter your name" class="change-address-name-value" required>
                                <!-- <i class="uil uil-user icon"></i> -->
                                <i class="fa-regular fa-id-card bs-auth-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="text" placeholder="Enter your number phone" class="change-address-sdt-value" required>
                                <i class="uil uil-phone change-address-form-icon"></i>
                            </div>
                            <div class="input-field address-field">
                                <div class="">
                                    <select name="" id="province" class="address-selection"></select>
                                </div>
                                <i class="fa fa-location-dot change-address-form-icon"></i>
                            </div>
                            <div class="input-field address-field">
                                <div class="">
                                    <select name="" id="district" class="address-selection">
                                        <option  value="">Chọn quận huyện</option>
                                    </select>   
                                </div>
                                <i class="fa fa-location-dot change-address-form-icon"></i>
                            </div>
                            <div class="input-field address-field">
                                <div class="">
                                    <select name="" id="ward" class="address-selection">
                                        <option   value="">Chọn xã phường</option>
                                    </select>
                                </div>
                                <i class="fa fa-location-dot change-address-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="text" placeholder="Enter specific address" class="more-detail-about-address" required>
                                <i class="fa fa-location-dot change-address-form-icon"></i>
                            </div>
                            <div class="input-field change-address-form-button">
                                <input type="submit" value="Change" class="use-new-address-submit">
                            </div>
                            
                        </form>

                        <div class="new-old-address">
                            <span class="change-address-form-text">Use
                                <a href="#"  id="go-to-use-old-address" class="change-address-form-text forgetaddress-login-link">Old Address</a>
                            </span>
                        </div>
                    </div>

                    <!-- Old Address Form -->
                    <?php 
                        $sql_get_name_from_bills = "SELECT DISTINCT tennguoinhan from donhang, nguoidung where donhang.MaNguoiDung = nguoidung.MaNguoiDung and taikhoan = '$username'";
                        $stmt_get_name_from_bills = $conn->prepare($sql_get_name_from_bills);
                        $stmt_get_name_from_bills->execute();

                        $sql_get_sdt_from_bills = "SELECT DISTINCT sdtnhanhang from donhang, nguoidung where donhang.MaNguoiDung = nguoidung.MaNguoiDung and taikhoan = '$username'";
                        $stmt_get_sdt_from_bills = $conn->prepare($sql_get_sdt_from_bills);
                        $stmt_get_sdt_from_bills->execute();

                        $sql_get_address_from_bills = "SELECT DISTINCT diachigiaohang from donhang, nguoidung where donhang.MaNguoiDung = nguoidung.MaNguoiDung and taikhoan = '$username'";
                        $stmt_get_address_from_bills = $conn->prepare($sql_get_address_from_bills);
                        $stmt_get_address_from_bills->execute();
                        //$row = $stmt_get_info_from_bills->fetch();
                            
                        
                    ?>
                    <div class="change-address-form reset-address">
                        <span class="change-address-form-title">Use Old Address</span>
                        <form action="">
                            <div class="input-field address-field">
                                <div class="">
                                    <select name="" id="old-info-name" class="address-selection">
                                        <option value="">Chọn tên người nhận</option>
                                        <?php while($row_ten = $stmt_get_name_from_bills->fetch()){
                                        ?>
                                            <option value="<?php echo $row_ten['tennguoinhan'] ?>"><?php echo $row_ten['tennguoinhan'] ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>   
                                </div>
                                <i class="fa-regular fa-id-card bs-auth-form-icon"></i>
                            </div>
                            <div class="input-field address-field">
                                <div class="">
                                    <select name="" id="old-info-number" class="address-selection">
                                        <option value="">Chọn SDT nhận hàng</option>
                                        <?php while($row_sdt = $stmt_get_sdt_from_bills->fetch()){
                                        ?>
                                            <option value="<?php echo $row_sdt['sdtnhanhang'] ?>"><?php echo $row_sdt['sdtnhanhang'] ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>   
                                </div>
                                <i class="uil uil-phone bs-auth-form-icon"></i>
                            </div>
                            <div class="input-field address-field">
                                <div class="">
                                    <select name="" id="old-info-address" class="address-selection">
                                        <option value="">Chọn địa chỉ giao hàng</option>
                                        <?php while($row_address = $stmt_get_address_from_bills->fetch()){
                                        ?>
                                            <option value="<?php echo $row_address['diachigiaohang'] ?>"><?php echo $row_address['diachigiaohang'] ?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>   
                                </div>
                                <i class="fa fa-location-dot bs-auth-form-icon"></i>
                                
                            </div>
                            <div class="input-field change-address-form-button">
                                <input type="submit" value="Change" class="use-old-address-submit">
                            </div>
                            <div class="new-old-address">
                                <span class="change-address-form-text">Use
                                    <a href="#" id="go-to-use-new-address" class="change-address-form-text forgetaddress-login-link">New Address</a>
                                </span>
                            </div>
                        </form>  
                    </div>
                    
                </div>
            </div>

            <div class="change-password-form-container">
                <div class="change-password-forms">
                    <!-- Find Account Form -->
                    <div class="change-password-form find-password">
                        <span class="change-password-form-title">Change Password</span>

                        <form action="#">
                            <div class="input-field">
                                <input type="password" class="change-password-form-password bs-auth-form-password cp-old-password-value" placeholder="Enter your password" required>
                                <i class="uil uil-lock change-password-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" class="change-password-form-password bs-auth-form-password cp-new-password-value" placeholder="Create a new password" required>
                                <i class="uil uil-lock change-password-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" class="change-password-form-password bs-auth-form-password cp-confirm-password-value" placeholder="Confirm a password" required>
                                <i class="uil uil-lock change-password-form-icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>
                            <div class="input-field change-password-form-button">
                                <input type="submit" value="Change" class="cp-change-password-submit">
                            </div>
                        </form>
                        <div class="findPW-resetPW">
                            <span class="change-password-form-text">
                                <a href="#" class="change-password-form-text cp-forgetpassword-link">Forget password?</a>
                            </span>
                        </div>
                    </div>

                    <!-- Reset Password Form -->
                    <!-- <div class="change-password-form reset-password">
                        <span class="change-password-form-title">Reset Your Password</span>
                        <form action="">
                            <div class="input-field">
                                <input type="password" class="change-password-form-password bs-auth-form-password changepassword-password-value" placeholder="Create a new password" required>
                                <i class="uil uil-lock change-password-form-icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" class="change-password-form-password bs-auth-form-password changepassword-confirm-value" placeholder="Confirm a password" required>
                                <i class="uil uil-lock change-password-form-icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>
                            <div class="input-field change-password-form-button">
                                <input type="submit" value="Reset" class="reset-password-submit">
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
            

            <div class="edit-comment-container">
                <textarea value="" oninput="auto_grow(this)" rows="1" placeholder="Viết gì đó..." type="text" class="edit-comment-input"></textarea>
                <a href="#" class="edit-comment-button-edit">Thay đổi</a>
            </div>
        </div>
    </div>

    <script src="./js/main.js"></script>
    <script src="./js/detail.js"></script>
    <script src="./js/orders.js"></script>
</body>
</html>


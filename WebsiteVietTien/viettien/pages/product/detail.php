<?php 
    if(isset($_GET['detail'])){
        $detail = $_GET['detail'];
    }   
    
    $sql_danhsach_sp = "SELECT MaSP, TenSP, TenLoaiSP, SanPham.MaLoaiSP, GiaBan, GiaSale, MauSac, ChatLieu, KieuDang, SoLuong, HinhAnh, HoaTiet from SanPham, LoaiSP where SanPham.MaLoaiSP = LoaiSP.MaLoaiSP and MaSP = $detail";
    $stmt_tensp = $conn->prepare($sql_danhsach_sp);
    $stmt_tensp->execute();
    $row = $stmt_tensp->fetch();
    $tenloaisp = $row['TenLoaiSP'];
    $tensp = $row['TenSP'];
    $maloaisp = $row['MaLoaiSP'];

    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if($username && $username != "root"){
        $sql_getuser = "SELECT * from nguoidung where TaiKhoan = '$username'";
        $stmt_getuser = $conn->prepare($sql_getuser);
        $stmt_getuser->execute();
        $rowUser = $stmt_getuser->fetch();
        $userID_from_ss = $rowUser['MaNguoiDung'];
        $userRole_from_ss = $rowUser['MaQuyen'];

        $sql_check_watched = "SELECT * from sanphamdaxem where MaSP = $detail and MaNguoiDung = $userID_from_ss";
        $stmt_check_watched = $conn->prepare($sql_check_watched);
        $stmt_check_watched->execute();
        $row_check_watched = $stmt_check_watched->rowCount();
        if($row_check_watched > 0){
            $sql_update_watched = "UPDATE sanphamdaxem set ngayxem = CURRENT_TIMESTAMP() where MaSP = $detail and MaNguoiDung = $userID_from_ss";
            $stmt_update_watched = $conn->prepare($sql_update_watched);
            $stmt_update_watched->execute();
        }
        else{
            $sql_add_watched = "INSERT INTO sanphamdaxem (masp, manguoidung, ngayxem) values ($detail, $userID_from_ss, CURRENT_TIMESTAMP())";
            $stmt_add_watched = $conn->prepare($sql_add_watched);
            $stmt_add_watched->execute();
        }
    }
?>
<div class="app_container">
    <div class="grid">
        <div class="maps">
            <a href="" class="maps-link">
                <i class="fa-solid fa-house"></i>
                Trang chủ
            </a>
            <a href="index.php?action=danhsachsanpham&danhmuc=<?php echo $maloaisp ?>&filter=tatca&order=desc&trang=1" class="maps-link">
                <i class="current-link-none-css fa-solid fa-caret-right"></i>
                <?php echo $tenloaisp?>
            </a>
            <span class="maps-link current-link"><?php if($detail!='') echo '<i class="current-link-none-css fa-solid fa-caret-right"></i> '.$tensp ?></a>
        </div>
        <div class="grid__row detail">
            <div class="detail-images">
                <div class="detail-list-images">
                    <ul class="list-images">
                        <li class="list-images-item img-select">
                            <img class="list-images-item-src " src="/admin/modules/quanlysp/uploads/<?php echo $row['HinhAnh'] ?>">
                        </li>
                        <?php
                            $sql_danhsach_anh = "SELECT * from thuvien where masp = $detail";
                            $stmt_anh = $conn->prepare($sql_danhsach_anh);
                            $stmt_anh->execute();                            
                            while($rowanh = $stmt_anh->fetch()){
                            ?>
                                <li class="list-images-item">
                                    <img class="list-images-item-src" src="/admin/modules/quanlysp/uploads/<?php echo $rowanh["HinhAnh"]?>">
                                </li>   
                        <?php
                        }
                        ?>
                        <!-- <li class="list-images-item">
                            <img class="list-images-item-src " src="/admin/modules/quanlysp/uploads/aosomi_caro.jpg">
                        </li>
                        <li class="list-images-item">
                            <img class="list-images-item-src" src="/admin/modules/quanlysp/uploads/ao3lo_den.png">
                        </li> -->
                    </ul>
                </div>
                <div class="detail-selected-image">
                    <img class="detail-selected-image-src" src="/admin/modules/quanlysp/uploads/<?php echo $row['HinhAnh'] ?>">
                </div>
            </div>
            <div class="detail-info">
                <div class="detail-name">
                    <?php echo $row['TenSP'] ?>
                </div>
                <div class="detail-id">
                    Mã sản phẩm: <?php echo $detail ?>
                </div>
                <div class="detail-price">
                    <div class="detail-new-price">
                        <?php echo number_format($row['GiaSale'],0,',','.').'₫' ?>
                    </div>
                    <div class="detail-old-price <?php if($row['GiaBan']==$row['GiaSale']) echo 'no-sale-off' ?>">
                        <div class="detail-old-price-value">
                            <?php echo number_format($row['GiaBan'],0,',','.').'₫' ?>
                        </div>
                        <div class="detail-price-saleoff">
                            -<?php echo ceil(($row['GiaBan']-$row['GiaSale'])/$row['GiaBan']*100) ?>%
                        </div>
                    </div>
                </div>
                <div class="detail-size">
                    <span class="detail-size-title">Size:</span>
                    <ul class="detail-size-list">
                        <?php
                            $i = 0;
                            $sql_danhsach_size_sp = "SELECT * from size where masp = $detail";
                            $stmt = $conn->prepare($sql_danhsach_size_sp);
                            $stmt->execute();                            
                            while($rowsize = $stmt->fetch()){
                                if($rowsize['SoLuong']=='0'){
                                    echo "<li onmousedown='return false;' onselectstart='return false;' class='detail-size-item-cant-select'>".$rowsize['SizeSP']."</li>";
                                }
                                else{
                                    $i++;
                                    $select;
                                    if($i=='1'){
                                        $select = 'detail-size-item-selected';
                                    }
                                    else{
                                        $select = '';
                                    }
                                    echo "<li value='".$row['SoLuong']."' onmousedown='return false;' onselectstart='return false;' class='detail-size-item $select'>".$rowsize['SizeSP']."</li>";
                                }
                            }
                        ?>
                        <!-- <li onmousedown='return false;' onselectstart='return false;' class="detail-size-item detail-size-item-selected" >41</li>
                        
                        <li onmousedown='return false;' onselectstart='return false;' class="detail-size-item">42</li>
                        <li onmousedown='return false;' onselectstart='return false;' class="detail-size-item">43</li>
                        <li onmousedown='return false;' onselectstart='return false;' class="detail-size-item detail-size-item-cant-select">44</li> -->
                    </ul>
                </div>
                <div class="detail-soluong">
                    <span class="detail-soluong-title">Số lượng:</span>
                    <div class="detail-soluong-input">
                        <div class="detail-soluong-tru" onmousedown='return false;' onselectstart='return false;'>-</div>
                        <input type="text" class="detail-soluong-value" value="1">
                        <div class="detail-soluong-cong" onmousedown='return false;' onselectstart='return false;'>+</div>
                    </div>
                </div>
                <a href="javascript:ThemVaoGioHang()" class="detail-themgiohang">
                    <i class="fa-sharp fa-solid fa-cart-shopping detail-themgiohang-icon"></i>
                    <span class="detail-themgiohang-label">Thêm vào giỏ hàng</span>
                </a>
            </div>
            <div class="detail-more-info-and-comments">
                <div class="detail-comments">
                    <div class="detail-comments-heading">
                        BÌNH LUẬN VỀ SẢN PHẨM
                    </div>
                    <div class="detail-comment-login <?php if(!$username || $username=="root") echo "detail-comment-login-no-user" ?>">
                        <span>Đăng nhập để có thể bình luận về sản phẩm này. <b class="detail-comment-go-to-login">Đăng nhập tại đây.</b></span>
                    </div>
                    <div class="detail-comments-typing <?php if(!$username || $username=="root") echo "no-user-to-cmt" ?>">
                        <img src="../admin/modules/quanlynguoidung/uploads/<?php if(!$username || $username=="root") echo "couple.png"; else echo $rowUser['Avatar']; ?>" alt="" class="detail-comments-typing-avatar">
                        <textarea value="" oninput="auto_grow(this)" rows="1" placeholder="Viết bình luận..." type="text" class="detail-comments-typing-input"></textarea>
                        <a href="javascript:ThemBinhLuan()" class="detail-comments-typing-button">Đăng</a>
                    </div>
                    <div class="detail-comments-about-product-container">
                        <?php 
                            $sql_getcmt = "SELECT maquyen, mabinhluan, taikhoan, binhluan.manguoidung, tennguoidung, avatar, noidungbinhluan, ngaybinhluan from binhluan, nguoidung where binhluan.manguoidung = nguoidung.manguoidung and masp = $detail ORDER BY ngaybinhluan desc";
                            $stmt_cmt = $conn->prepare($sql_getcmt);
                            $stmt_cmt->execute();
                            while($row_cmt = $stmt_cmt->fetch()){
                                $userid = $row_cmt['manguoidung'];
                                $userloginname = $row_cmt['taikhoan'];
                                $cmtid = $row_cmt['mabinhluan'];
                                $sql_bought = "SELECT masp from donhang, chitietdonhang where donhang.MaDonHang = chitietdonhang.MaDonHang and trangthaidonhang = 'Đã hoàn tất' and MaSP = $detail and MaNguoiDung = $userid ";
                                $stmt_bought = $conn->prepare($sql_bought);
                                $stmt_bought->execute();
                                $damua = $stmt_bought->rowCount();
                                
                                $datediff = abs(time() - strtotime($row_cmt['ngaybinhluan']));
                                if($datediff < 60){
                                    $ngaycmt = 'Vừa xong';
                                }
                                elseif($datediff < 3600 && $datediff >= 60){
                                    $ngaycmt = floor($datediff /(60)).' phút trước';
                                }
                                elseif($datediff < 86400 && $datediff >= 3600){
                                    $ngaycmt = floor($datediff /(3600)).' giờ trước';
                                }
                                elseif($datediff < 2678400 && $datediff >= 86400){
                                    $ngaycmt = floor($datediff /(86400)).' ngày trước';
                                }
                                elseif($datediff < 31536000  && $datediff >= 2678400){
                                    $ngaycmt = floor($datediff /(2678400)).' tháng trước';
                                }
                                else{
                                    $ngaycmt = floor($datediff /(2678400)).' năm trước';
                                }
                                   
                                $sql_count_like_cmt = "SELECT thichbinhluan.manguoidung, tennguoidung from thichbinhluan, nguoidung where nguoidung.manguoidung = thichbinhluan.manguoidung and mabinhluan = $cmtid";
                                $stmt_count_like_cmt = $conn->prepare($sql_count_like_cmt);
                                $stmt_count_like_cmt->execute();
                                $rowLikeCmt = $stmt_count_like_cmt->fetch();
                                $total_row_cmt = $stmt_count_like_cmt->rowCount();
                                if($total_row_cmt > 0){
                                    $luotthichcmt = $total_row_cmt;
                                    if(!$username || $username != "root"){
                                        $sql_user_ss_liked = "SELECT * from thichbinhluan where manguoidung = $userID_from_ss and mabinhluan = $cmtid";
                                        $stmt_user_ss_liked = $conn->prepare($sql_user_ss_liked);
                                        $stmt_user_ss_liked->execute();
                                        $userSSliked = $stmt_user_ss_liked->rowCount();
                                
                                        if($total_row_cmt < 2){
                                            if($userSSliked > 0){
                                                $titlelikecmt = 'Bạn đã thích bình luận này';
                                            }
                                            else{
                                                $titlelikecmt = $rowLikeCmt['tennguoidung'].' đã thích bình luận này';
                                            }
                                        }
                                        else{
                                            $othersliked = $total_row_cmt - 1;
                                            if($userSSliked > 0){
                                                $titlelikecmt ="Bạn và $othersliked người khác đã thích bình luận này";
                                            }
                                            else{
                                                $titlelikecmt = $rowLikeCmt['tennguoidung']." và $othersliked người khác đã thích bình luận này";
                                            }
                                        }
                                    }
                                    else{
                                        if($total_row_cmt < 2){
                                            $titlelikecmt = $rowLikeCmt['tennguoidung'].' đã thích bình luận này';
                                        }
                                        else{
                                            $othersliked = $total_row_cmt - 1;
                                            $titlelikecmt = $rowLikeCmt['tennguoidung']." và $othersliked người khác đã thích bình luận này";
                                        }
                                    }
                                }
                                else{
                                    $luotthichcmt = 0;
                                    $titlelikecmt = "Chưa có lượt thích nào";
                                }
                                

                                $sql_user_like_cmt = "SELECT thichbinhluan.manguoidung from nguoidung, thichbinhluan where nguoidung.manguoidung = thichbinhluan.manguoidung and mabinhluan = $cmtid and TaiKhoan = '$username'";
                                $stmt_user_like_cmt = $conn->prepare($sql_user_like_cmt);
                                $stmt_user_like_cmt->execute();
                                $dalikecmt = $stmt_user_like_cmt->rowCount();
                        ?>
                        <div class="detail-comments-about-product-content" id="comment-<?php echo $row_cmt['mabinhluan'] ?>">
                            <img src="../admin/modules/quanlynguoidung/uploads/<?php echo $row_cmt['avatar'] ?>" alt="" class="detail-comments-about-product-avatar">
                            <div class="detail-comments-about-product">
                                    <div class="detail-comments-about-product-heading-and-comment">
                                        <div class="detail-comments-about-product-heading">
                                            <div class="detail-comments-about-product-username"><?php echo $row_cmt['tennguoidung'] ?></div>
                                            <div class="detail-comments-about-product-label <?php if($damua > 0) echo "detail-comments-about-product-label-active" ?>">
                                            <!-- <i class="fa-solid fa-circle-check"></i> -->
                                            <i class="fa-solid fa-medal"></i>
                                                Đã mua hàng
                                            </div>
                                            <div class="detail-comments-about-product-label <?php if($row_cmt['maquyen'] == 1) echo "detail-comments-about-product-label-active" ?>">
                                            <!-- <i class="fa-solid fa-circle-check"></i> -->
                                            <i class="fa-solid fa-circle-check"></i>
                                                Admin
                                            </div>
                                        </div>
                                        <div class="detail-comments-about-product-text">
                                            <?php echo $row_cmt['noidungbinhluan'] ?>
                                        </div>
                                        <!-- <div class="detail-comments-about-product-count-like">
                                            <i class="detail-comments-about-product-count-like-icon fa-solid fa-heart"></i>
                                            <div onmousedown='return false;' class="detail-comments-about-product-count-like-label">24</div>
                                        </div> -->
                                    </div>
                                    <div class="detail-comments-about-product-action" id="cmt">
                                        <div id="" onmousedown='return false;' class="detail-comments-about-product-like">
                                            <a href="javascript:ThichBinhLuan(<?php echo $row_cmt['mabinhluan'] ?>)">
                                                <i class="detail-comments-about-product-like-icon fa-solid fa-heart <?php if($dalikecmt > 0) echo "comment-liked"?>"></i>
                                            </a>
                                            <span title="<?php echo $titlelikecmt ?>" class="detail-comments-about-product-like-count"><?php echo $luotthichcmt ?> lượt thích</span>
                                        </div>
                                        <div onmousedown='return false;' class="detail-comments-about-product-reply <?php if(!$username || $username=="root") echo "no-user-to-cmt" ?>">Phản hồi</div>
                                        <div onmousedown='return false;' class="detail-comments-about-product-time" title="<?php echo $row_cmt['ngaybinhluan'] ?>"><?php echo $ngaycmt ?></div>
                                        <a href="javascript:SuaBinhLuan(<?php echo $row_cmt['mabinhluan'] ?>)" onmousedown='return false;' class="detail-comments-about-product-edit <?php if(strtolower($username) == strtolower($userloginname)) echo "cmt-of-user" ?>">Sửa</a>
                                        <a href="javascript:XoaBinhLuan(<?php echo $row_cmt['mabinhluan'] ?>)" onmousedown='return false;' class="detail-comments-about-product-delete <?php if(strtolower($username) == strtolower($userloginname) || strtolower($username)=="admin") echo "cmt-of-user" ?>">Xóa</a>
                                        
                                    </div>
                                    <?php 
                                        $binhluanid = $row_cmt['mabinhluan'];
                                        $sql_getreply = "SELECT maquyen, matraloi, taikhoan, traloibinhluan.manguoidung, tennguoidung, avatar, noidungtraloi, ngaytraloi from binhluan, traloibinhluan, nguoidung where binhluan.mabinhluan = traloibinhluan.mabinhluan and traloibinhluan.manguoidung = nguoidung.manguoidung and traloibinhluan.mabinhluan = $binhluanid ORDER BY ngaytraloi asc";
                                        $stmt_reply = $conn->prepare($sql_getreply);
                                        $stmt_reply->execute();
                                        while($row_reply = $stmt_reply->fetch()){
                                            $userid = $row_reply['manguoidung'];
                                            $userloginname_reply = $row_reply['taikhoan'];
                                            $replyid = $row_reply['matraloi'];
                                            $sql_bought_reply = "SELECT masp from donhang, chitietdonhang where donhang.MaDonHang = chitietdonhang.MaDonHang and trangthaidonhang = 'Đã hoàn tất' and MaSP = $detail and MaNguoiDung = $userid ";
                                            $stmt_bought_reply = $conn->prepare($sql_bought_reply);
                                            $stmt_bought_reply->execute();
                                            $damua_reply = $stmt_bought_reply->rowCount();
                                            
                                            $datediff = abs(time() - strtotime($row_reply['ngaytraloi']));
                                            if($datediff < 60){
                                                $ngayreply = 'Vừa xong';
                                            }
                                            elseif($datediff < 3600 && $datediff >= 60){
                                                $ngayreply = floor($datediff /(60)).' phút trước';
                                            }
                                            elseif($datediff < 86400 && $datediff >= 3600){
                                                $ngayreply = floor($datediff /(3600)).' giờ trước';
                                            }
                                            elseif($datediff < 2678400 && $datediff >= 86400){
                                                $ngayreply = floor($datediff /(86400)).' ngày trước';
                                            }
                                            elseif($datediff < 31536000  && $datediff >= 2678400){
                                                $ngayreply = floor($datediff /(2678400)).' tháng trước';
                                            }
                                            else{
                                                $ngayreply = floor($datediff /(2678400)).' năm trước';
                                            }
                                            
                                            $sql_count_like_reply = "SELECT thichtraloibinhluan.manguoidung, tennguoidung from thichtraloibinhluan, nguoidung where nguoidung.manguoidung = thichtraloibinhluan.manguoidung and matraloi = $replyid";
                                            $stmt_count_like_reply = $conn->prepare($sql_count_like_reply);
                                            $stmt_count_like_reply->execute();
                                            $total_row_reply = $stmt_count_like_reply->rowCount();
                                            $rowLikeReply = $stmt_count_like_reply->fetch();
                                            
                                            if($total_row_reply > 0){
                                                $luotthichreply = $total_row_reply;
                                                if(!$username || $username != "root"){
                                                    $sql_user_ss_reply_liked = "SELECT * from thichtraloibinhluan where manguoidung = $userID_from_ss and matraloi = $replyid";
                                                    $stmt_user_ss_reply_liked = $conn->prepare($sql_user_ss_reply_liked);
                                                    $stmt_user_ss_reply_liked->execute();
                                                    $userSSReplyliked = $stmt_user_ss_reply_liked->rowCount();
                                                    if($total_row_reply < 2){
                                                        if($userSSReplyliked > 0){
                                                            $titlelikereply = 'Bạn đã thích phản hồi này';
                                                        }
                                                        else{
                                                            $titlelikereply = $rowLikeReply['tennguoidung'].' đã thích phản hồi này';
                                                        }
                                                    }
                                                    else{
                                                        $othersliked_reply = $total_row_reply - 1;
                                                        if($userSSReplyliked > 0){
                                                            $titlelikereply ="Bạn và $othersliked_reply người khác đã thích phản hồi này";
                                                        }
                                                        else{
                                                            $titlelikereply = $rowLikeReply['tennguoidung']." và $othersliked_reply người khác đã thích phản hồi này";
                                                        }
                                                    }
                                                }
                                                else{
                                                    if($total_row_reply < 2){
                                                            $titlelikereply = $rowLikeReply['tennguoidung'].' đã thích phản hồi này';
                                                    }
                                                    else{
                                                        $othersliked_reply = $total_row_reply - 1;
                                                        $titlelikereply = $rowLikeReply['tennguoidung']." và $othersliked_reply người khác đã thích phản hồi này";
                                                    }
                                                }
                                            }
                                            else{
                                                $luotthichreply = 0;
                                                $titlelikereply = "Chưa có lượt thích nào";
                                            }

                                            $sql_user_like_reply = "SELECT thichtraloibinhluan.manguoidung from nguoidung, thichtraloibinhluan where nguoidung.manguoidung = thichtraloibinhluan.manguoidung and matraloi = $replyid and TaiKhoan = '$username'";
                                            $stmt_user_like_reply = $conn->prepare($sql_user_like_reply);
                                            $stmt_user_like_reply->execute();
                                            $dalikereply = $stmt_user_like_reply->rowCount();
                                    ?>
                                    <div class="detail-reply-about-product-content" id="reply-<?php echo $row_reply['matraloi'] ?>">
                                        <img src="../admin/modules/quanlynguoidung/uploads/<?php echo $row_reply['avatar'] ?>" alt="" class="detail-comments-about-product-avatar">
                                        <div class="detail-comments-about-product">
                                                <div class="detail-comments-about-product-heading-and-comment">
                                                    <div class="detail-comments-about-product-heading">
                                                        <div class="detail-comments-about-product-username"><?php echo $row_reply['tennguoidung'] ?></div>
                                                        <div class="detail-comments-about-product-label <?php if($damua_reply > 0) echo "detail-comments-about-product-label-active" ?>">
                                                        <i class="fa-solid fa-medal"></i>
                                                            Đã mua hàng
                                                        </div>
                                                        <div class="detail-comments-about-product-label <?php if($row_reply['maquyen'] == 1) echo "detail-comments-about-product-label-active" ?>">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                            Admin
                                                        </div>
                                                    </div>
                                                    <div class="detail-comments-about-product-text">
                                                        <?php echo $row_reply['noidungtraloi'] ?>
                                                    </div>
                                                </div>
                                                <div class="detail-comments-about-product-action">
                                                    <div id="" onmousedown='return false;' class="detail-reply-comments-about-product-like">
                                                        <a href="javascript:ThichTraLoi(<?php echo $row_reply['matraloi']?>)">
                                                            <i class="detail-comments-about-product-like-icon fa-solid fa-heart <?php if($dalikereply > 0) echo "comment-liked"?>"></i>
                                                        </a>
                                                        <span title="<?php echo $titlelikereply ?>" class="detail-comments-about-product-like-count"><?php echo $luotthichreply ?> lượt thích</span>
                                                    </div>
                                                    <div onmousedown='return false;' class="detail-comments-about-product-reply <?php if(!$username || $username=="root") echo "no-user-to-cmt" ?>">Phản hồi</div>
                                                    <div onmousedown='return false;' class="detail-comments-about-product-time" title="<?php echo $row_reply['ngaytraloi'] ?>"><?php echo $ngayreply ?></div>
                                                    <a href="javascript:SuaTraLoi(<?php echo $row_reply['matraloi'] ?>)" onmousedown='return false;' class="detail-comments-about-product-edit <?php if(strtolower($username) == strtolower($userloginname_reply)) echo "cmt-of-user" ?>">Sửa</a>
                                                    <a href="javascript:XoaTraLoi(<?php echo $row_reply['matraloi'] ?>)" onmousedown='return false;' class="detail-comments-about-product-delete <?php if(strtolower($username) == strtolower($userloginname_reply) || strtolower($username)=="admin") echo "cmt-of-user" ?>">Xóa</a>
                                                    
                                                </div>
                                        </div>
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                    <div class="detail-replies-typing <?php if(!$username || $username=="root") echo "no-user-to-cmt" ?>">
                                        <img src="../admin/modules/quanlynguoidung/uploads/<?php if(!$username || $username=="root") echo "couple.png"; else echo $rowUser['Avatar']; ?>" alt="" class="detail-comments-typing-avatar">
                                        <textarea oninput="auto_grow(this)" rows="1" cols="100" placeholder="Viết phản hồi của bạn tại đây..." type="text" class="detail-reply-typing-input"></textarea>
                                        <a href="javascript:ThemTraLoi(<?php echo $row_cmt['mabinhluan'] ?>)" class="detail-comments-typing-button">Đăng</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="detail-more-info">
                    <div class="detail-more-info-heading">MÔ TẢ SẢN PHẨM</div>
                    <div class="detail-more-info-description">
                        <div class="detail-more-info-description-label">KIỂU DÁNG: </div>
                        <div class="detail-more-info-description-text"><?php echo $row['KieuDang']?></div>
                    </div>
                    <div class="detail-more-info-description">
                        <div class="detail-more-info-description-label">CHẤT LIỆU: </div>
                        <div class="detail-more-info-description-text"><?php echo $row['ChatLieu']?></div>
                    </div>
                    <div class="detail-more-info-description">
                        <div class="detail-more-info-description-label">MÀU SẮC: </div>
                        <div class="detail-more-info-description-text"><?php echo $row['MauSac']?></div>
                    </div>
                    <div class="detail-more-info-description">
                        <div class="detail-more-info-description-label">SIZE: </div>
                        <div class="detail-more-info-description-text">
                            <?php
                            $i=0;
                            $sql_danhsach_size_sp_description = "SELECT * from size where masp = $detail";
                            $stmt_size_des = $conn->prepare($sql_danhsach_size_sp_description);
                            $stmt_size_des->execute();
                            while($rowsize_description = $stmt_size_des->fetch()){
                                $i++;
                                if($i=='1'){
                                    echo $rowsize_description['SizeSP'];
                                }
                                else{
                                    echo ' - '.$rowsize_description['SizeSP'];
                                }
                        }
                            ?>
                        </div>
                    </div>
                    
                    <div class="detail-more-info-description-label detail-more-info-description-list-label">CHI TIẾT: </div>
                    <ul class="detail-more-info-description-list">
                        <?php 
                            $sql_danhsach_chitiet_sp = "SELECT * from chitietsp where masp = $detail";
                            $stmt_ctsp_des = $conn->prepare($sql_danhsach_chitiet_sp);
                            $stmt_ctsp_des->execute();
                            while($row_ctsp = $stmt_ctsp_des->fetch()){
                        ?>
                            <li class="detail-more-info-description-item">
                                - <?php echo $row_ctsp['ChiTietSP']; ?>
                            </li>
                        <?php 
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="detail-watched <?php if(!$username || $username=="root") echo 'detail-watched-no-user' ?>">
                <span class="detail-watched-heading">SẢN PHẨM ĐÃ XEM GẦN ĐÂY</span>
            <?php   
                if($username && $username!="root"){
                    $sql_danhsach_sp_daxem = "SELECT TrangThai, sanphamdaxem.MaSP, TenSP, GiaSale, GiaBan, HinhAnh, NgayXem, MaNguoiDung FROM sanphamdaxem, sanpham WHERE sanphamdaxem.MaSP = sanpham.MaSP and MaNguoiDung = $userID_from_ss and TrangThai = 'Kích hoạt' ORDER by ngayxem DESC limit 12";
                    $stmt_watched = $conn->prepare($sql_danhsach_sp_daxem);
                    $stmt_watched->execute();
                    while($row_watched = $stmt_watched->fetch()){
            ?>
                <div class="detail-watched-product">
                    <div class="home-product-item">
                        <a href="index.php?detail=<?php echo $row_watched['MaSP']?>" class="home-product-item-link">
                            <div class="home-product-item-img" style="background-image: url(/admin/modules/quanlysp/uploads/<?php echo $row_watched['HinhAnh'] ?>);">
                            </div>
                            <h4 class="home-product-item-name"><?php echo $row_watched['TenSP'] ?></h4>
                            <div class="home-product-item-price">
                                <span class="home-product-item-new-price <?php if($row_watched['GiaBan']==$row_watched['GiaSale']) echo 'display_none'?>"><?php echo number_format($row_watched['GiaSale'],0,',','.').'₫' ?></span>
                                <span class="home-product-item-old-price <?php if($row_watched['GiaBan']==$row_watched['GiaSale']) echo 'price-without-sale'?>"><?php echo number_format($row_watched['GiaBan'],0,',','.').'₫' ?></span>
                            </div>
                            <div class="home-product-item-fav <?php if($row_watched['GiaBan']==$row_watched['GiaSale']) echo 'display_none'?>">
                                <i class="home-product-item-fav-icon fa-sharp fa-solid fa-burst"></i>
                                <span class="home-product-item-fav-label">SALE OFF <?php echo ceil(($row_watched['GiaBan']-$row_watched['GiaSale'])/$row_watched['GiaBan']*100) ?>%</span>
                            </div>
                        </a>
                    </div>
                </div>
                <?php 
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
			$('.detail-soluong-tru').click(function () {
				var $input = $(this).parent().find('.detail-soluong-value');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.detail-soluong-cong').click(function () {
				var $input = $(this).parent().find('.detail-soluong-value');
                var count = parseInt($input.val()) + 1;
                var $soluong = parseInt(document.querySelector('.detail-size-list .detail-size-item.detail-size-item-selected').value);
				$input.val(parseInt($input.val()) + 1);
                $count = count > $soluong ? $soluong : count;
                $input.val($count);
				$input.change();
				//return false;
			});
		});

        $('.detail-size-list .detail-size-item').click(function() {
            $('.detail-size-list .detail-size-item.detail-size-item-selected').removeClass('detail-size-item-selected');
            $(this).closest('.detail-size-item').addClass('detail-size-item-selected');
        });

        $('.list-images .list-images-item').click(function() {
            $('.list-images .list-images-item.img-select').removeClass('img-select');
            $(this).closest('.list-images-item').addClass('img-select');
            document.querySelector('.detail-selected-image .detail-selected-image-src').src = this.querySelector(".list-images-item-src").src;
            //console.log(this.querySelector(".list-images-item-src").src);  
        });

        // $('.detail-themgiohang').on('click', function(e){
        // e.preventDefault();
        // var $size = document.querySelector('.detail-size-list .detail-size-item.detail-size-item-selected').innerText;
        // var $soluong = document.querySelector('.detail-soluong-value').value;
        // var $sizeVaSoLuong = `&size=${$size}&soluong=${$soluong}`
        // this.href = '/pages/product/xuly.php?id=&giaban='
        // document.location.href = this.href+$sizeVaSoLuong;
        // });

       $('.detail-reply-comments-about-product-like#2 .detail-comments-about-product-like-icon').on('click', function(e){
            $('.detail-reply-comments-about-product-like#2 .detail-comments-about-product-like-icon').toggleClass('comment-liked')
            // $(this).addClass('border-color-icon');   
            //console.log(this)
       })

       $('.detail-comments-about-product-like#3 .detail-comments-about-product-like-icon').on('click', function(e){
            $('.detail-comments-about-product-like#3 .detail-comments-about-product-like-icon').toggleClass('comment-liked')
       })

    function auto_grow(element) {
        element.style.height = "5px";
        element.style.height = (element.scrollHeight)+"px";
    }
        
</script>
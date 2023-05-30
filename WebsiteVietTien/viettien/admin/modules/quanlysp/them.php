<?php 
    include("./config/config.php");
    //set values
    $tensp = '';
    $tenloaisp = '';
    $giaban = '';
    $giasale = '';
    $color ='';
    $chatlieu = '';
    $kieudang ='';
    $chatlieu ='';
    $hoatiet ='';
    $soluong ='';
    $hinhanh = '';
    $hinhanh_tmp = '';
    $trangthai = '';

    //get values
    if(isset($_POST['form-input-name'])){
        $tensp = $_POST['form-input-name'];
    }
    else{
        $tensp = '';
    }
    if(isset($_POST['form-input-name-loaisp'])){
        $tenloaisp = $_POST['form-input-name-loaisp'];
    }
    else{
        $tenloaisp = '';
    }
    if(isset($_POST['form-input-price'])){
        $giaban = $_POST['form-input-price'];
    }
    else{
        $giaban = '';
    }
    if(isset($_POST['form-input-price-sale-off'])){
        $giasale = $_POST['form-input-price-sale-off'];
    }
    else{
        $giasale = '';
    }
    if(isset($_POST['form-input-color'])){
        $color = $_POST['form-input-color'];
    }
    else{
        $color = '';
    }
    if(isset($_POST['form-input-chatlieu'])){
        $chatlieu = $_POST['form-input-chatlieu'];
    }
    else{
        $chatlieu = '';
    }
    if(isset($_POST['form-input-kieudang'])){
        $kieudang = $_POST['form-input-kieudang'];
    }
    else{
        $kieudang = '';
    }
    if(isset($_POST['form-input-hoatiet'])){
        $hoatiet = $_POST['form-input-hoatiet'];
    }
    else{
        $hoatiet = '';
    }
    if(isset($_POST['form-input-soluong'])){
        $soluong = $_POST['form-input-soluong'];
    }
    else{
        $soluong = '';
    }
    if(isset($_FILES['form-input-img']['name'])){
        $hinhanh = $_FILES['form-input-img']['name'];
    }
    else{
        $hinhanh = '';
    }
    if(isset($_FILES['form-input-img']['tmp_name'])){
        $hinhanh_tmp = $_FILES['form-input-img']['tmp_name'];
    }
    else{
        $hinhanh_tmp = '';
    }
    if(isset($_POST['form-input-status'])){
        $trangthai = $_POST['form-input-status'];
    }
    else{
        $trangthai = '';
    }
    $hinhanh = time().'_'.$hinhanh;


    //submit event
    if(isset($_POST["submit"])){
        $errors = [];
        //validate ten san pham
        if(empty(trim($tensp))){
            $errors['fullname']['required'] = 'Tên sản phẩm không được để trống';
        }
        else{
            if(strlen(trim($tensp))<4){
                $errors['fullname']['min'] = 'Tên sản phẩm độ dài tối thiểu 4 ký tự';
            }
        }
        //validate gia ban
        if(empty(trim($giaban))){
            $errors['price']['required'] = 'Giá bán của sản phẩm không được để trống';
        }
        else{
            if((trim($giaban))<trim($giasale)){
                $errors['price']['logic'] = 'Giá bán của sản phẩm phải lớn hơn hoặc bằng giá sale';
            }
            elseif(trim($giaban)<0){
                $errors['price']['min'] = 'Giá bán của sản phẩm phải lớn hơn hoặc bằng 0';
            }
        }
        //validate color
        if(empty(trim($color))){
            $errors['color']['required'] = 'Màu sắc của sản phẩm không được để trống';
        }
        //validate chat lieu
        if(empty(trim($chatlieu))){
            $errors['chatlieu']['required'] = 'Chất liệu của sản phẩm không được để trống';
        }
        //validate kieu dang
        if(empty(trim($kieudang))){
            $errors['kieudang']['required'] = 'Kiểu dáng của sản phẩm không được để trống';
        }
        //validate so luong 
        if(empty($soluong)){
            $errors['soluong']['required'] = 'Số lượng của sản phẩm không được để trống';
        }
        else{
            if($soluong<0){
                $errors['soluong']['min'] = 'Số lượng của sản phẩm phải lớn hơn hoặc bằng 0';
            }
        }
        //validate hinh anh
        if(empty(trim($hinhanh))){
            $errors['hinhanh']['required'] = 'Hình ảnh của sản phẩm không được để trống';
        }
        //khong error
        if(empty($errors)){
                if($giasale==""){
                    $sql_them_sp = "INSERT INTO SanPham (TenSP, MaLoaiSP, GiaBan, GiaSale, MauSac, ChatLieu, KieuDang, SoLuong, HinhAnh, NgayTao, NgayCapNhat, TrangThai, HoaTiet) 
                                        VALUES ('".$tensp."', '".$tenloaisp."', '".$giaban."', '".$giaban."', '".$color."', '".$chatlieu."', '".$kieudang."', '".$soluong."', '".$hinhanh."', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '".$trangthai."', '".$hoatiet."')";
                }
                else{
                    $sql_them_sp = "INSERT INTO SanPham (TenSP, MaLoaiSP, GiaBan, GiaSale, MauSac, ChatLieu, KieuDang, SoLuong, HinhAnh, NgayTao, NgayCapNhat, TrangThai, HoaTiet) 
                                        VALUES ('".$tensp."', '".$tenloaisp."', '".$giaban."', '".$giasale."', '".$color."', '".$chatlieu."', '".$kieudang."', '".$soluong."', '".$hinhanh."', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP(), '".$trangthai."', '".$hoatiet."')";
                }
                $stmt = $conn->prepare($sql_them_sp);
                $stmt->execute();
                move_uploaded_file($hinhanh_tmp, 'modules/quanlysp/uploads/'.$hinhanh);
                if($sql_them_sp){
                    ?>
                    <script>
                        swal({
                            title: "Success!",
                            text: "Thêm dữ liệu thành công!",
                            icon: "success",
                            });
                    </script>
                    <?php  
                }
        
    }
        
    }

    
    

    
?>

<div class="grid__column-10">
                        <div class="content">
                            <div class="heading-content">
                                <div class="heading-content-back">
                                    <div class="pagination-other-features">
                                        <a href="index.php?action=quanlysanpham&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thêm loại sản phẩm mới</div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-label">Tên sản phẩm</div>
                                <input type="text" name="form-input-name" class="form-input" value="<?php echo (!empty($tensp))?$tensp:false;?>">
                                <?php 
                                    echo (!empty($errors['fullname']['required'])) ? '<span class="span-error">'.$errors['fullname']['required'].'</span>':false;
                                    echo (!empty($errors['fullname']['min'])) ? '<span class="span-error">'.$errors['fullname']['min'].'</span>':false;
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Tên loại sản phẩm</div>
                                <select name="form-input-name-loaisp" class="form-input" >
                                    <?php 
                                        $sql_danhsach_loaisp = "SELECT * FROM loaisp";
                                        $stmt_loaisp = $conn->prepare($sql_danhsach_loaisp);
                                        $stmt_loaisp->execute();
                                        // $query_danhsach_loaisp = mysqli_query($conn, $sql_danhsach_loaisp);
                                        while($row = $stmt_loaisp->fetch()){
                                    ?>
                                    <option value="<?php echo $row["MaLoaiSP"] ?>"><?php echo $row["TenLoaiSP"] ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                                <?php 
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Giá bán</div>
                                <input type="number" name="form-input-price" class="form-input" value="<?php echo (!empty($giaban))?$giaban:false;?>">
                                <?php 
                                    echo (!empty($errors['price']['required'])) ? '<span class="span-error">'.$errors['price']['required'].'</span>':false;
                                    echo (!empty($errors['price']['logic'])) ? '<span class="span-error">'.$errors['price']['logic'].'</span>':false;
                                    echo (!empty($errors['price']['min'])) ? '<span class="span-error">'.$errors['price']['min'].'</span>':false;
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Giá sale</div>
                                <input type="number" name="form-input-price-sale-off" class="form-input" value="<?php echo (!empty($giasale))?$giasale:false;?>">
                            </div>
                            <div class="form-group">
                                <div class="form-label">Màu sắc</div>
                                <input type="text" name="form-input-color" class="form-input" value="<?php echo (!empty($color))?$color:false;?>">
                                <?php 
                                    echo (!empty($errors['color']['required'])) ? '<span class="span-error">'.$errors['color']['required'].'</span>':false;
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Chất liệu</div>
                                <input type="text" name="form-input-chatlieu" class="form-input" value="<?php echo (!empty($chatlieu))?$chatlieu:false;?>">
                                <?php 
                                    echo (!empty($errors['chatlieu']['required'])) ? '<span class="span-error">'.$errors['chatlieu']['required'].'</span>':false;
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Kiểu dáng</div>
                                <input type="text" name="form-input-kieudang" class="form-input" value="<?php echo (!empty($kieudang))?$kieudang:false;?>">
                                <?php 
                                    echo (!empty($errors['kieudang']['required'])) ? '<span class="span-error">'.$errors['kieudang']['required'].'</span>':false;
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Họa tiết</div>
                                <select name="form-input-hoatiet" class="form-input" >
                                    <option value="Màu trơn">Màu trơn</option>
                                    <option value="Hoa văn">Hoa văn</option>
                                    <option value="Sọc">Sọc</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Hình ảnh</div>
                                <input type="file" name="form-input-img" class="form-input" value="<?php echo (!empty($hinhanh))?$hinhanh:false;?>">
                                <?php 
                                    echo (!empty($errors['hinhanh']['required'])) ? '<span class="span-error">'.$errors['hinhanh']['required'].'</span>':false;
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Số lượng</div>
                                <input type="number" name="form-input-soluong" class="form-input" value="<?php echo (!empty($soluong))?$soluong:false;?>">
                                <?php 
                                    echo (!empty($errors['soluong']['required'])) ? '<span class="span-error">'.$errors['soluong']['required'].'</span>':false;
                                    echo (!empty($errors['soluong']['min'])) ? '<span class="span-error">'.$errors['soluong']['min'].'</span>':false;
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Trạng thái</div>
                                <select name="form-input-status" class="form-input" >
                                    <option value="Kích hoạt">Kích hoạt</option>
                                    <option value="Ẩn">Ẩn</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
<?php 
    include("./config/config.php");

    $size = '';
    $soluong = '';
    $id = '';

    if(isset($_POST['form-input-size'])){
        $size = $_POST['form-input-size'];
    }
    else{
        $size = '';
    }

    if(isset($_POST['form-input-soluong'])){
        $soluong = $_POST['form-input-soluong'];
    }
    else{
        $soluong = '';
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $sql_tensp = "SELECT TenSP from SanPham where MaSP = $id";
    $stmt_tensp = $conn->prepare($sql_tensp);
    $stmt_tensp->execute();
    $rowten = $stmt_tensp->fetch();
    $tensp = $rowten["TenSP"];


    if(isset($_POST["submit"])){
        $errors = [];
        //validate size
        if(empty($size)){
            $errors['size']['required'] = 'Size của sản phẩm không được để trống';
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
        if(empty($errors)){
            $sql_danhsach_sizesp = "SELECT * from size where SizeSP = '$size' and MaSP = $id";
            // $query_danhsach_sizesp = mysqli_query($conn, $sql_danhsach_sizesp); 
            $stmt_sizesp = $conn->prepare($sql_danhsach_sizesp);
            $stmt_sizesp->execute();
            $count = $stmt_sizesp->rowCount();
            if($count>0){
                ?>
                <script>
                    swal("Sản phẩm <?php echo $tensp ?> đã có size <?php echo $size ?> vui lòng chọn một size khác");
                </script>
                <?php
            }
            else {
                $sql_them_sizesp = "INSERT INTO size (SizeSP, SoLuong, MaSP) VALUES ('$size', $soluong, $id)";
                //mysqli_query($conn, $sql_them_sizesp);
                $stmt = $conn->prepare($sql_them_sizesp);
                $stmt->execute();
                if($sql_them_sizesp){
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
    }
    

    
?>

<div class="grid__column-10">
                        <div class="content">
                            <div class="heading-content">
                                <div class="heading-content-back">
                                    <div class="pagination-other-features">
                                        <a href="index.php?action=sizesanpham&trang=1&id=<?php echo $id ?>" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thêm size cho sản phẩm <?php echo $tensp ?></div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form">
                            <div class="form-group">
                                <div class="form-label">Size</div>
                                <input type="text" name="form-input-size" class="form-input" value="<?php echo (!empty($size))?$size:false;?>">
                                <?php 
                                    echo (!empty($errors['size']['required'])) ? '<span class="span-error">'.$errors['size']['required'].'</span>':false;
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
                                <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
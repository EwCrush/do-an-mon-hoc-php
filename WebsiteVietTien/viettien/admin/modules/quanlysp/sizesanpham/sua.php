<?php 
    include("./config/config.php");

    $size = '';
    $soluong = '';
    $id = '';

    if(isset($_GET['size'])){
        $size = $_GET['size'];
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $sql_danhsach_ctsp_from_id_size = "SELECT * FROM size where MaSP = $id and SizeSP = '$size'";
    $stmt_size = $conn->prepare($sql_danhsach_ctsp_from_id_size);
    $stmt_size->execute();
    $rowsoluong = $stmt_size->fetch();

    if(isset($_POST['form-input-soluong'])){
        $soluong = $_POST['form-input-soluong'];
    }
    else{
        $soluong = $rowsoluong['SoLuong'];
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
            
                $sql_sua_sizesp = "UPDATE SIZE set SOLUONG = $soluong where SizeSP = '$size' and MaSP = $id";
                $stmt = $conn->prepare($sql_sua_sizesp);
                $stmt->execute();
                
                if($sql_sua_sizesp){
                    ?>
                    <script>
                        swal({
                            title: "Success!",
                            text: "Cập nhật dữ liệu thành công!",
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
                                        <a href="index.php?action=sizesanpham&trang=1&id=<?php echo $id ?>" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Cập nhật số lượng cho size <?php echo $size ?> của sản phẩm <?php echo $tensp ?></div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form">
                            <div class="form-group">
                                <div class="form-label">Số lượng</div>
                                <input type="number" name="form-input-soluong" class="form-input" value="<?php echo (!empty($soluong))?$soluong:false;?>">
                                <?php 
                                    echo (!empty($errors['soluong']['required'])) ? '<span class="span-error">'.$errors['soluong']['required'].'</span>':false;
                                    echo (!empty($errors['soluong']['min'])) ? '<span class="span-error">'.$errors['soluong']['min'].'</span>':false;
                                ?> 
                            </div>
                                <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
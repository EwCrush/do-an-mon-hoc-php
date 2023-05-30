<?php 
    include("./config/config.php");

    $hinhanh = '';
    $hinhanh_tmp = '';
    $id = '';

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

    $hinhanh = time().'_'.$hinhanh;

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
        //validate hinh anh
        if(empty(trim($hinhanh))){
            $errors['hinhanh']['required'] = 'Hình ảnh của sản phẩm không được để trống';
        }

        if(empty($errors)){
                $sql_them_thuvien = "INSERT INTO thuvien (HinhAnh, MaSP) VALUES ('$hinhanh', $id)";
                $stmt = $conn->prepare($sql_them_thuvien);
                $stmt->execute();  
                move_uploaded_file($hinhanh_tmp, 'modules/quanlysp/uploads/'.$hinhanh);
                if($sql_them_thuvien){
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
                                        <a href="index.php?action=thuvienanh&trang=1&id=<?php echo $id ?>" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thêm hình ảnh cho sản phẩm <?php echo $tensp ?></div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-label">Hình ảnh</div>
                                <input type="file" name="form-input-img" class="form-input" value="<?php echo (!empty($hinhanh))?$hinhanh:false;?>">
                                <?php 
                                    echo (!empty($errors['hinhanh']['required'])) ? '<span class="span-error">'.$errors['hinhanh']['required'].'</span>':false;
                                ?> 
                            </div>
                                <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
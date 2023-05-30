<?php 
    include("./config/config.php");

    $chitietsanpham = '';
    $id = '';

    if(isset($_POST['form-input-name'])){
        $chitietsanpham = $_POST['form-input-name'];
    }
    else{
        $chitietsanpham = '';
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
        if(empty(trim($chitietsanpham))){
            $errors['fullname']['required'] = 'Chi tiết sản phẩm không được để trống';
        }
        else{
            if(strlen(trim($chitietsanpham))<3){
                $errors['fullname']['min'] = 'Chi tiết sản phẩm độ dài tối thiểu 3 ký tự';
            }
        }
        if(empty($errors)){
            
            $sql_them_ctsp = "INSERT INTO chitietsp (ChitietSP, MaSP) VALUES ('".$chitietsanpham."', '".$id."')";
            $stmt = $conn->prepare($sql_them_ctsp);
            $stmt->execute();            
            if($sql_them_ctsp){
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
                                        <a href="index.php?action=thongtinchitiet&trang=1&id=<?php echo $id ?>" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thêm chi tiết cho sản phẩm <?php echo $tensp ?></div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form">
                            <div class="form-group">
                                <div class="form-label">Chi tiết sản phẩm</div>
                                <input type="text" name="form-input-name" class="form-input" value="<?php echo (!empty($chitietsanpham))?$chitietsanpham:false;?>">
                                <?php 
                                    echo (!empty($errors['fullname']['required'])) ? '<span class="span-error">'.$errors['fullname']['required'].'</span>':false;
                                    echo (!empty($errors['fullname']['min'])) ? '<span class="span-error">'.$errors['fullname']['min'].'</span>':false;
                                ?> 
                            </div>
                                <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
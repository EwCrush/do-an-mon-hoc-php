<?php 
    include("./config/config.php");

    $tenloaisp = '';

    if(isset($_POST['form-input-name'])){
        $tenloaisp = $_POST['form-input-name'];
    }
    else{
        $tenloaisp = '';
    }

    if(isset($_POST["submit"])){
        $errors = [];
        if(empty(trim($tenloaisp))){
            $errors['fullname']['required'] = 'Tên loại sản phẩm không được để trống';
        }
        else{
            if(strlen(trim($tenloaisp))<2){
                $errors['fullname']['min'] = 'Tên loại sản phẩm độ dài tối thiểu 2 ký tự';
            }
        }
        if(empty($errors)){
            
            $sql_them_loaisp = "INSERT INTO loaisp (TenLoaiSP) VALUES ('".$tenloaisp."')";
            //mysqli_query($conn, $sql_them_loaisp);
            $stmt = $conn->prepare($sql_them_loaisp);
            $stmt->execute();
            
            if($sql_them_loaisp){
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
                                        <a href="index.php?action=quanlyloaisanpham&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thêm loại sản phẩm mới</div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-label">Tên loại sản phẩm</div>
                                <input type="text" name="form-input-name" class="form-input" value="<?php echo (!empty($tenloaisp))?$tenloaisp:false;?>">
                                <?php 
                                    echo (!empty($errors['fullname']['required'])) ? '<span class="span-error">'.$errors['fullname']['required'].'</span>':false;
                                    echo (!empty($errors['fullname']['min'])) ? '<span class="span-error">'.$errors['fullname']['min'].'</span>':false;
                                ?> 
                            </div>
                                <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
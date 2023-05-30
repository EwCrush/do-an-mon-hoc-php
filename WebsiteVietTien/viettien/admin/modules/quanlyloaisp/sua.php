<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    
    include("./config/config.php"); 
    $sql_danhsach_loaisp = "SELECT MaLoaiSP, TenLoaiSP FROM loaisp WHERE MaLoaiSP = $id";
    $stmt_tenloaisp = $conn->prepare($sql_danhsach_loaisp);
    $stmt_tenloaisp->execute();
    //$query_danhsach_loaisp = mysqli_query($conn, $sql_danhsach_loaisp);  
    $row = $stmt_tenloaisp->fetch();
    $tenfromid = $row["TenLoaiSP"];

    
    
    $tenloaisp = '';
    $link = '';

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
            
            $sql_sua_loaisp = "UPDATE loaisp SET TenLoaiSP = '".$tenloaisp."' WHERE MaLoaiSP = '".$id."'";
            //mysqli_query($conn, $sql_sua_loaisp);
            $stmt = $conn->prepare($sql_sua_loaisp);
            $stmt->execute();
            if($sql_sua_loaisp){
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
                                        <a href="index.php?action=quanlyloaisanpham&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Cập nhật thông tin loại sản phẩm</div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="<?php echo $link?>" method="post" class="content-form">
                            <div class="form-group">
                                <div class="form-label">Tên loại sản phẩm</div>
                                <input placeholder="Dữ liệu hiện tại: <?php echo $tenfromid ?>" type="text" name="form-input-name" class="form-input" value="<?php echo (!empty($tenloaisp))?$tenloaisp:false;?>">
                                <?php 
                                    echo (!empty($errors['fullname']['required'])) ? '<span class="span-error">'.$errors['fullname']['required'].'</span>':false;
                                    echo (!empty($errors['fullname']['min'])) ? '<span class="span-error">'.$errors['fullname']['min'].'</span>':false;
                                ?> 
                            </div>
                                <button name="submit" type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
<?php 
    include("./config/config.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    if(isset($_POST['form-input-hanche'])){
        $mahanche = $_POST['form-input-hanche'];
    }
    else $mahanche = '';

    if(isset($_POST['form-input-thoigianketthuc'])){
        $thoigianketthuc = $_POST['form-input-thoigianketthuc'];
    }

    if(isset($_POST['form-input-lido'])){
        $lido = $_POST['form-input-lido'];
    }

    $sql_tennguoidung = "SELECT * from nguoidung where MaNguoiDung = $id";
    $stmt_tennguoidung = $conn->prepare($sql_tennguoidung);
    $stmt_tennguoidung->execute();
    $rowten = $stmt_tennguoidung->fetch();
    $tennguoidung = $rowten["TenNguoiDung"];

    if(isset($_POST["submit"])){  
        $errors = [];
        if(strtotime($thoigianketthuc)<time()){
            $errors['time']['logic'] = 'Thời gian kết thúc hạn chế phải lớn hơn hoặc bằng thời gian hiện tại';
        }
        if(empty($errors)){
            $sql_checkAdmin = "SELECT * FROM nguoidung where manguoidung = $id";
            $stmt_checkAdmin = $conn->prepare($sql_checkAdmin);
            $stmt_checkAdmin->execute();
            $row_checkAdmin = $stmt_checkAdmin->fetch();

            if($row_checkAdmin['MaQuyen']=="1"){
                ?>
                    <script>
                        swal("Không thể áp đặt hạn chế lên Admin");
                    </script>
                <?php
            }
            
            else{
                $sql_isExist = "SELECT * FROM hanchenguoidung where manguoidung = $id and mahanche = $mahanche";
                $stmt_isExist = $conn->prepare($sql_isExist);
                $stmt_isExist->execute();
                $tonghang = $stmt_isExist->rowCount();
                if($tonghang>0){
                    ?>
                        <script>
                            swal("Hạn chế này đã được sử dụng đối với người dùng này");
                        </script>
                    <?php
                }
                else{
                    $sql_them_hanche = "INSERT INTO hanchenguoidung (MaNguoiDung, MaHanChe, ThoiGianKetThuc, LiDo) VALUES ($id, $mahanche, '$thoigianketthuc', '$lido')";
                    $stmt = $conn->prepare($sql_them_hanche);
                    $stmt->execute();
                    
                    if($sql_them_hanche){
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
    }
    

    
?>

<div class="grid__column-10">
                        <div class="content">
                            <div class="heading-content">
                                <div class="heading-content-back">
                                    <div class="pagination-other-features">
                                        <a href="index.php?action=hanchenguoidung&id=<?php echo $id ?>&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thêm hạn chế đối với người dùng <?php echo $tennguoidung ?></div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-label">Tên hạn chế</div>
                                <select name="form-input-hanche" class="form-input" >
                                    <?php 
                                        $sql_danhsach_hanche = "SELECT * FROM hanche";
                                        $stmt_hanche = $conn->prepare($sql_danhsach_hanche);
                                        $stmt_hanche->execute();
                                        // $query_danhsach_loaisp = mysqli_query($conn, $sql_danhsach_loaisp);
                                        while($row = $stmt_hanche->fetch()){
                                    ?>
                                    <option <?php if($mahanche==$row['MaHanChe']) echo 'selected' ?> value="<?php echo $row["MaHanChe"] ?>"><?php echo $row["TenHanChe"] ?></option>
                                    <?php 
                                        }
                                    ?>
                                </select>
                                <?php 
                                ?> 
                            </div>
                            <div class="form-group">
                                <div class="form-label">Thời gian kết thúc</div>
                                <input type="datetime-local" name="form-input-thoigianketthuc" class="form-input" value="<?php echo (!empty($thoigianketthuc))?$thoigianketthuc:false;?>">
                                <?php 
                                    echo (!empty($errors['time']['logic'])) ? '<span class="span-error">'.$errors['time']['logic'].'</span>':false;
                                ?>  
                            </div>
                            <div class="form-group">
                                <div class="form-label">Lí do</div>
                                <input type="text" name="form-input-lido" class="form-input" value="<?php echo (!empty($lido))?$lido:false;?>"> 
                            </div>
                                <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
                            </form>
                        </div>
                    </div>
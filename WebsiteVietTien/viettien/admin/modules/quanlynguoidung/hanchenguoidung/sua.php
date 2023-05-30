<?php 
    include("./config/config.php");

    if(isset($_GET['idnguoidung'])){
        $manguoidung = $_GET['idnguoidung'];
    }

    if(isset($_GET['idhanche'])){
        $mahanche = $_GET['idhanche'];
    }

    $sql_danhsach_hanche_from_id = "SELECT tenhanche, hanchenguoidung.mahanche, tennguoidung, hanchenguoidung.manguoidung, lido, thoigianketthuc FROM hanchenguoidung, nguoidung, hanche where nguoidung.manguoidung = hanchenguoidung.manguoidung and hanchenguoidung.mahanche = hanche.mahanche and hanchenguoidung.manguoidung = $manguoidung and hanchenguoidung.mahanche = $mahanche";
    $stmt_info_hanche = $conn->prepare($sql_danhsach_hanche_from_id);
    $stmt_info_hanche->execute();
    $rowhanche = $stmt_info_hanche->fetch();

    if(isset($_POST['form-input-thoigianketthuc'])){
        $thoigianketthuc = $_POST['form-input-thoigianketthuc'];
    }
    else {
        $thoigianketthuc = $rowhanche['thoigianketthuc'];
    }

    if(isset($_POST['form-input-lido'])){
        $lido = $_POST['form-input-lido'];
    }
    else $lido = $rowhanche['lido'];

    // $sql_tennguoidung = "SELECT * from nguoidung where MaNguoiDung = $id";
    // $stmt_tennguoidung = $conn->prepare($sql_tennguoidung);
    // $stmt_tennguoidung->execute();
    // $rowten = $stmt_tennguoidung->fetch();
    // $tennguoidung = $rowten["TenNguoiDung"];

    if(isset($_POST["submit"])){  
        $errors = [];
        if(strtotime($thoigianketthuc)<time()){
            $errors['time']['logic'] = 'Thời gian kết thúc hạn chế phải lớn hơn hoặc bằng thời gian hiện tại';
        }
        if(empty($errors)){
            $sql_them_hanche = "UPDATE hanchenguoidung SET thoigianketthuc = '$thoigianketthuc', lido = '$lido' where manguoidung = $manguoidung and mahanche = $mahanche";
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
    

    
?>

<div class="grid__column-10">
                        <div class="content">
                            <div class="heading-content">
                                <div class="heading-content-back">
                                    <div class="pagination-other-features">
                                        <a href="index.php?action=hanchenguoidung&id=<?php echo $manguoidung ?>&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Thay đổi hạn chế <?php echo $rowhanche['tenhanche'] ?> đối với người dùng <?php echo $rowhanche['tennguoidung'] ?></div>
                                </div>
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form" enctype="multipart/form-data">
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
                                <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
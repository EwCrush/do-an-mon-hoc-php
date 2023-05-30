<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    include("./config/config.php"); 


    if(isset($_POST['form-input-status'])){
        $status = $_POST['form-input-status'];
    }

    if(isset($_POST["submit"])){
        $errors = [];
        if($status==""){
            $errors['status']['required'] = 'Vui lòng chọn trạng thái của đơn hàng';
        }

        if(empty($errors)){
            
            $sql_update_status = "UPDATE donhang SET TrangThaiDonHang = '$status' WHERE MaDonHang = $id";
            $stmt = $conn->prepare($sql_update_status);
            $stmt->execute();
            if($sql_update_status){
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
                                        <a href="index.php?action=quanlydonhang&trang=1" class="ThemMoi">
                                            <i class="pagination-item fa-solid fa-circle-chevron-left" title="Quay lại"></i>
                                        </a>
                                    </div>
                                    <div class="heading-content-text">Cập nhật thông tin đơn hàng <?php echo $id ?></div>
                                </div> 
                            </div> 
                            <!-- ./modules/quanlyloaisp/xuly.php -->
                            <form action="" method="post" class="content-form">
                            <div class="form-group">
                                <div class="form-label">Trạng thái đơn hàng</div>
                                <select name="form-input-status" class="form-input" >
                                    <option selected  value="">Chọn trạng thái hiện tại của đơn hàng</option>
                                    <option value="Đã hoàn tất">Đã hoàn tất</option>
                                    <option value="Giao hàng thất bại">Giao hàng thất bại</option>
                                    <option value="Đang vận chuyển">Đang vận chuyển</option>
                                </select>
                                <?php 
                                    echo (!empty($errors['status']['required'])) ? '<span class="span-error">'.$errors['status']['required'].'</span>':false;
                                ?> 
                            </div>
                                <button name="submit" type="submit" class="btn btn-primary">Cập nhật</button>
                            </form>
                        </div>
                    </div>
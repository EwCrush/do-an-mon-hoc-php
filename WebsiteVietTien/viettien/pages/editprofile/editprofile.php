<?php 
    if(isset($_SESSION['TaiKhoan'])){
        $username = $_SESSION['TaiKhoan'];
    }

    if(!$username || $username == "root"){
        echo '<script> window.location.href="index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1";</script>';
    }
    else{
        $sql_get_info_of_user_from_ss = "SELECT * from nguoidung where TaiKhoan = '$username'";
        $stmt = $conn->prepare($sql_get_info_of_user_from_ss);
        $stmt->execute();
        $row = $stmt->fetch();
        $userID = $row['MaNguoiDung'];
    }

    if(isset($_FILES['ep-img']['name'])){
        $hinhanh = $_FILES['ep-img']['name'];
    }
    else{
        $hinhanh = '';
    }
    if(isset($_FILES['ep-img']['tmp_name'])){
        $hinhanh_tmp = $_FILES['ep-img']['tmp_name'];
    }
    else{
        $hinhanh_tmp = '';
    }

    $hinhanh = time().'_'.$hinhanh;

    if(isset($_POST["submit"])){
        if($hinhanh !="" || $hinhanh_tmp!=""){
            $sql_get_hinhanh = "SELECT * from NguoiDung where MaNguoiDung = $userID";
            $stmt_hinhanh = $conn->prepare($sql_get_hinhanh);
            $stmt_hinhanh->execute();  
            $row_thuvien = $stmt_hinhanh->fetch();
            if($row_thuvien['Avatar']!="couple.png"){
                unlink('./admin/modules/quanlynguoidung/uploads/'.$row_thuvien['Avatar']);
            }
            $sql_sua = "UPDATE nguoidung SET Avatar = '$hinhanh' where MaNguoiDung = $userID";
            $stmt = $conn->prepare($sql_sua);
            $stmt->execute();  
            move_uploaded_file($hinhanh_tmp, './admin/modules/quanlynguoidung/uploads/'.$hinhanh); 
            echo("<meta http-equiv='refresh' content='1'>");
        }
    }
    
?>
<div class="app_container">
    <div class="grid">
        <div class="maps">
            <a href="index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1" class="maps-link">
                <i class="fa-solid fa-house"></i>
                Trang chủ
            </a>
            <span class="maps-link current-link"><i class="current-link-none-css fa-solid fa-caret-right"></i> Cập nhật thông tin</a>
        </div>
        <div class="grid__row">
            <div class="grid__column-3">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="edit-profile-upload-image">
                        <img src="/admin/modules/quanlynguoidung/uploads/<?php echo $row['Avatar'] ?>" alt="" class="edit-profile-upload-image-src">
                        <span class="edit-profile-upload-image-username">@<?php echo $username ?></span>
                        <input type="file" name="ep-img" id="ep_image_select" accept="image/*">
                        <div class="upload-img-btn-option">
                            <label for="ep_image_select" class="upload-image-btn"><i class="fa-solid fa-cloud-arrow-up"></i></label>
                            <button class="save-image-btn" name="submit" type="submit">Save image</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="grid__column-9">
                <div class="edit-profile-user-info">
                    <span class="edit-profile-heading">Personal Details</span>
                    <div class="edit-profile-groupbox">
                        <i class="fa-regular fa-id-card edit-profile-icon"></i>
                        <input value="<?php echo $row['TenNguoiDung'] ?>" type="text" class="edit-profile-input edit-profile-input-name" placeholder="Enter your name">
                    </div>
                    <div class="edit-profile-groupbox">
                        <i class="fa-solid fa-envelope edit-profile-icon"></i>
                        <input value="<?php echo $row['Email'] ?>" type="text" class="edit-profile-input edit-profile-input-email" placeholder="Enter your email">
                    </div>
                    <div class="edit-profile-groupbox">
                        <i class="fa-solid fa-phone edit-profile-icon"></i>
                        <input value="<?php echo $row['SDT'] ?>" type="number" class="edit-profile-input edit-profile-input-phone" placeholder="Enter your number phone">
                    </div>
                </div>
                <div class="edit-profile-user-address">
                    <span class="edit-profile-heading">Address</span>
                    <div class="edit-profile-groupbox">
                        <i class="fa fa-location-dot edit-profile-icon"></i>
                        <select name="" id="province" class="ep_address-selection"></select>
                    </div>
                    <div class="edit-profile-groupbox">
                        <i class="fa fa-location-dot edit-profile-icon"></i>
                        <select name="" id="district" class="ep_address-selection">
                            <option  value="">Chọn quận huyện</option>
                        </select>
                    </div>
                    <div class="edit-profile-groupbox">
                        <i class="fa fa-location-dot edit-profile-icon"></i>
                        <select name="" id="ward" class="ep_address-selection">
                            <option   value="">Chọn xã phường</option>
                        </select>
                    </div>
                    <div class="edit-profile-groupbox">
                        <i class="fa fa-location-dot edit-profile-icon"></i>
                        <input type="text" class="edit-profile-input edit-profile-input-address" placeholder="Enter specific address">
                    </div>
                </div>
                <div class="edit-profile-save-changes">
                    <a href="javascript:LuuThongTin()" class="edit-profile-save-changes-button">Save changes</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const profileImageEP = document.querySelector(".edit-profile-upload-image-src")
    const inputImageEP = document.querySelector("#ep_image_select")
    const inputName = document.querySelector(".edit-profile-input-name")

    inputImageEP.addEventListener("change", function(){
        profileImageEP.src = URL.createObjectURL(inputImageEP.files[0])
    })

    inputName.addEventListener("change", function(){
        inputName.value = removeFullName(inputName.value)
    })

    function LuuThongTin(MaNguoiDung){
        const Ten = document.querySelector(".edit-profile-input-name").value
        const SDT = document.querySelector(".edit-profile-input-phone").value
        const Email = document.querySelector(".edit-profile-input-email").value
        const diachichitiet = document.querySelector(".edit-profile-input-address").value
        if ($("#district").val() == "" || $("#province").val() == "" || $("#ward").val() == "" || diachichitiet.trim() == ""){
                var ep_address = "";
        }
        else{
            var ep_address = `${diachichitiet.trim()}, ${$("#ward option:selected").text()}, ${$("#district option:selected").text()}, ${$("#province option:selected").text()}`
        }
        if(Ten.trim()=="" || SDT.trim()=="" || Email.trim()==""){
            swal("Vui lòng nhập đầy đủ thông tin")
        }
        else{
            if(ep_address.trim()==""){
                swal({
                    text: "Việc không nhập địa chỉ mới đồng nghĩa với việc sẽ giữ lại địa chỉ cũ, bạn đồng ý chứ?",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willChange) => {
                    if (willChange) {
                        $.post("./pages/editprofile/luuthongtin.php", {
                            "Ten": Ten,
                            "SDT": SDT,
                            "Email": Email,
                            "DiaChi": ep_address
                        })
                    } 
                });
            }
            else{
                $.post("./pages/editprofile/luuthongtin.php", {
                    "ID": MaNguoiDung,
                    "Ten": Ten,
                    "SDT": SDT,
                    "Email": Email,
                    "DiaChi": ep_address
                })
            }
        }
    }

</script>

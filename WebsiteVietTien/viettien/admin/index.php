<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />
    <title>Admin - Việt Tiến</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../admin/css/main.css">
    <link rel="stylesheet" href="../admin/css/base.css">
    <!-- <link rel="stylesheet" href="../admin/js/main.js"> -->
    <!-- <link rel="stylesheet" href="../css/responsive.css"> -->
    <link href = "https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=vietnamese" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
</head>
<?php 
    if(isset($_SESSION['MaQuyen'])){
        $role = $_SESSION['MaQuyen'];
    }

    if(!$role || $role!='1'){
        echo '<script> window.location.href="../index.php?action=danhsachsanpham&danhmuc=tatcasanpham&filter=tatca&order=desc&trang=1";</script>';
    }
?>
<body>
    <div class="main">
        <?php 
            include("./modules/header.php");
        ?>

        <div class="app_container">
        <div class="grid">
                <div class="grid__row app_content">
                    <?php 
                        include("./modules/sidebar.php");
                        include("./modules/main.php");
                    ?>
                    
                </div>
            </div>
        </div>

        <?php 
            include("./modules/footer.php");
        ?>
    </div>
</body>
</html>



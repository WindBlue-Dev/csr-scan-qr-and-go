<?php session_start() ;

$_SESSION['success'] = 'test';

?>
<hr>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="icon" sizes="64x64" type="image/png" href="../images/logo.ico">
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <title>Beger ลดไม่ต้องรอ</title>
</head>

<body>
    <div class="container">
        <div class="row wb-flex">
            <div class="mar-t text-c">
                <img src='../images/header.png' class='logo'>
            </div>
        </div>
        <div class="row wb-flex">
            <div class="col">
                <div class="wb-flex-box justify-content-center wb-container blue">
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        echo '</div>';
                    }
                        ?>
                        <div class="d-flex justify-content-center">
                            <a href="/dealer">สแกนเพิ่ม</a>
                        </div>
                        </div>
                </div>
            </div>
        </div>
</body>

</html>
<?php
session_start();

require_once "assets/db.php";
require_once "assets/util.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="icon" sizes="64x64" type="image/png" href="../images/logo.ico">
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
    <title>Beger ลดไม่ต้องรอ</title>
</head>

<body>
    <?php if (!isset($_COOKIE['loged'])) {
        echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL='http://crm.beger.co.th/dealer'>";
    } else { ?>
        <div class="container">
            <div class="wb-flex">
                <div class="mar-t text-c">
                    <img src='../images/header.png' class='logo'>
                </div>
                <div class="col">
                    <div id="reader"></div>
                </div>
            </div>
            <div class="wb-flex">
                <div class="wb-flex justify-content-center wb-w-box">
                    <h5 class=blue>STEP 1 รายละเอียดผู้รับสิทธิ์</h5>

                    <form action="insert.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="dealer" value="<?php echo $_SESSION['dealer']; ?>">
                        <table class=wb_table>
                            <tbody>
                                <?php
                                if (!empty($_POST['userPhone']) && !empty($_POST['dealerPhone'])) {
                                    $user = $_POST['userPhone'];
                                    $dealer = $_POST['dealerPhone'];
                                    $users = $user;
                                }

                                $output = '';

                                if (!empty($users)) {
                                    $db = new Database();
                                    $result = $db->readphone($users);

                                    if ($result && is_array($result)) {
                                        foreach ($result as $row) {
                                            $output .= '<tr><th>ชื่อผู้ใช้ </th> <td class="border0">' . $row['fullname'] . '</td> </tr>';
                                            $output .= '<tr><th>เบอร์โทร </th> <td><input type=text name="member" value=' . $row['phone'] . ' readonly class="border0"></td> </tr>';
                                            echo $output;
                                        }
                                    } else {
                                        echo "ไม่พบข้อมูลผู้ใช้";
                                    }
                                } else {
                                    echo "no phone";
                                }
                                ?>
                            </tbody>
                        </table>
                        <h5 class=blue>STEP 2 ถ่ายบิลใบเสร็จ</h5>
                        <label for="img" class="col-form-label">ถ่ายใบเสร็จที่มีรายการสินค้า Beger รวมมูลค่ามากกว่า 1,500 บาท</label>
                        <input type="file" required class="form-control" id="imgInput" name="img">
                        <img loading="lazy" width="100%" id="previewImg" alt="">
                        <div class="mb-3">
                            <input type="submit" name="submit" value="ส่งข้อมูลการใช้โปรโมชั่น" class="btn btn-primary btn-block btn-lg wb_btn ">
                        </div>
                        <div class="col-lg-12">
                            <div id="showAlert"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="assets/js/main.js"></script>
        
        <script>
            let imgInput = document.getElementById('imgInput');
            let previewImg = document.getElementById('previewImg');

            imgInput.onchange = evt => {
                const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
                }
            }
        </script>
    <?php } ?>
</body>

</html>
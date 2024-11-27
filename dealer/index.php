<?php
session_start();
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
    <script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
    <div class="wb_cover">

        <?php if (!isset($_COOKIE['loged'])) { ?>
            <!-- Register-->
            <div class="modal fade" tabindex="-1" id="addNewUserModal">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="add-user-form" method="POST" class="p-2">
                                <div class="row mb-3 gx-3">
                                    <div class="mb-3">
                                        <input type="text" name="sname" class="form-control form-control-lg mb-2" placeholder="ชื่อร้านค้า" required>
                                        <div class="invalid-feedback">จำเป็นต้องกรอก</div>

                                        <input type="text" name="branch" class="form-control form-control-lg mb-2" placeholder="สาขา (หากมี)">
                                        <div class="invalid-feedback">จำเป็นต้องกรอก</div>

                                        <input type="text" name="phone" id="dealerPhone" class="form-control form-control-lg wb-phone" maxlength="10" placeholder="เบอร์มือถือ" pattern="[0-9]{10}" autocomplete="off" required />
                                        <div class="invalid-feedback">จำเป็นต้องกรอก</div>
                                        <input type="hidden" name="login" value="1">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="submit" value="เข้าร่วม" class="btn btn-primary btn-block btn-lg wb_btn " id="add-user-btn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Register End -->

            <script>
                const addModal = new bootstrap.Modal(document.getElementById("addNewUserModal"));
            </script>
            <div class="container">
                <div class="row wb-flex">
                    <div class="mar-t text-c">
                        <img src='../images/header.png' class='logo'>
                    </div>
                </div>
                <div class="row wb-flex">
                    <div class="col">
                        <div class="wb-flex-box justify-content-center wb-container blue">
                            <div class="col-lg-12">
                                <div id="showAlert"></div>
                            </div>
                            <p>ร่วมแผนส่งเสริมการขายง่ายๆ เพียงแค่กรอกรายละเอียดร้านค้า</p>
                            <div class="d-flex justify-content-center">
                                <button class="wb_btn" id="addBtn" type="button" data-bs-toggle="modal" data-bs-target="#addNewUserModal">เข้าร่วมแผนส่งเสริมการขาย</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wb_consen">
                <a href="https://www.beger.co.th/th/consent" target="_blank">นโยบายการใช้คุกกี้ และนโยบายความเป็นส่วนตัว</a> @ 2021 by Beger Co., Ltd. All Right Reserved.
            </div>
        <?php } else { ?>
            <!-- สแกน QR -->
            <div class="container">
                <div class="row wb-flex">
                    <div class="mar-t text-c">
                        <img src='../images/header.png' class='logo'>
                    </div>
                    <div class="col">
                        <div id="reader"></div>

                    </div>
                </div>
                <div class="row wb-flex">
                    <div class="col">
                        <input type=hidden id='mydealer' value=<?php echo $_SESSION['dealer'] ?>>
                        <div id="dataForm" class="wb-flex justify-content-center wb-container">
                        </div>
                    </div>
                </div>
            </div>

            <script src="assets/js/html5qrcode.min.js"></script>
            <script type="text/javascript">
                const dataForm = document.querySelector('#dataForm');
                const bodyForm = document.querySelector('#bodyForm');
                const endForm = document.querySelector('#endForm');

                function onScanSuccess(qrCodeMessage) {
                    const inputValue = document.getElementById("mydealer").value;
                    dataForm.innerHTML = '<form action="summery.php?p"  method="POST" class="w100" ><input type=hidden name=userPhone class="wb_result wb_input w100" value=' + qrCodeMessage + ' required><input type=hidden name=dealerPhone class="wb_result wb_input w100" value=' + inputValue +'><input type="submit" value="ตรวจสอบสิทธิ์" class="w100 btn btn-primary btn-block btn-lg wb_btn" id="add-user-btn" required></form>';
                }

                function onScanError(errorMessage) {
                    document.getElementById('btn').innerHTML = 'ไม่สามารถสแกนได้ในขณะนี้';
                }

                const html5QrCode = new Html5Qrcode("reader");

                const config = {
                    fps: 10,
                    qrbox: 250,
                    rememberLastUsedCamera: true,
                    aspectRatio: 1.0
                };
                html5QrCode.start({
                    facingMode: "environment"
                }, config, onScanSuccess);
                html5QrcodeScanner.render(onScanSuccess, onScanError);
            </script>
            <!-- สแกน QR -->
        <?php } ?>
        <script src="assets/js/main.js"></script>

    </div>
</body>

</html>
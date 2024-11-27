<?php
session_start();
require_once "assets/util.php";
?>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/windblue.css" rel="stylesheet">
    <link rel="icon" sizes="64x64" type="image/png" href="/images/logo.ico">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
    <title>Beger Cool ลดไม่ต้องรอ</title>
</head>

<body>

    <?php if (isset($_COOKIE['member'])) { ?>

        <div class="container">
            <div class="row">
                <div class="mar-t text-c">
                    <img src='images/header.png' class='logo'>
                </div>
                <div class="col-lg-12 d-flex justify-content-center">
                    <div>
                        <h1 class="text-center text-shadow">Beger ลดเลยไม่ต้องรอ</h1>
                        <h6>ขั้นตอนการรับสิทธิ์</h6>
                        <ol>
                            <li>กดสร้างโค้ดส่วนลด</li>
                            <li>กรอกชื่อสกุลและหมายเลขโทรศัพท์</li>
                            <li>นำ QR Code ให้ร้านค้าแสกน</li>
                            <li>รับส่วนลดทันที 100 บาท</li>
                        </ol>
                    </div>
                </div>

                <!-- แจ้งเตือน -->
                <div class="qr-container" style="display:none;">
                    <div id="showAlert" class="t-primary kanit"></div>
                    <div class="qr-box"></div>
                </div>
                <div id="add-user-form"></div>
                <div class="msg small-text">
                    <h6>เงื่อนไข</h6>
                    <ul>
                        <li>เริ่มตั้งแต่วันที่ 1 พฤศจิกายน - 31 ธันวาคม 2567 </li>
                        <li>คูปองนี้เป็นส่วนลดไม่สามารถแลกเป็นเงินสดได้ และสามารถใช้กับกลุ่มสินค้าเบเยอร์ได้ทุกรายการ</li>
                        <li>สามารถใช้คูปอง 1 ใบ ต่อยอดซื้อทุกๆ 1,500 บาท</li>
                        <li>การใช้คูปอง ต้องให้คูปองแก่พนักงานเก็บเงินเพื่อทำรายการก่อนชำระค่าสินค้า</li>
                        <li>คูปองสามารถใช้ได้กับร้านค้าที่ร่วมรายการเท่านั้น</li>
                        <li>บริษัทฯขอสงวนสิทธิ์ในการเปลี่ยนแปลง หรือยกเลิกเงื่อนไขโดยมิต้องแจ้งให้ทราบล่วงหน้า</li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
    <?php } else { ?>
        <!--OTP-->
        <div id="otp-overlay" class="otp-overlay" style="display:none;">
            <div id="vertify-otp" class="container">
                <form id="verify-otp-form" class="p-2">
                    <input type="text" name="otp" class="form-control form-control-lg wb-otp" maxlength="6" placeholder="OTP" pattern="[0-9]{6}" required />
                    <input type="submit" value="ยืนยัน OTP" class="btn btn-primary btn-block btn-lg wb_btn" id="verify-otp-btn">
                </form>
            </div>
        </div>
        <!-- Register-->
        <div class="modal fade" tabindex="-1" id="addNewUserModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="blue mar0">ลงทะเบียน</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="add-user-form" method="POST" class="p-2">
                            <div class="row mb-3 gx-3">
                                <div class="mb-3">
                                    <input type="text" name="fname" class="form-control form-control-lg mb-2" placeholder="ชื่อ-สกุล" required>
                                    <div class="invalid-feedback">จำเป็นต้องกรอก</div>
                                    <input type="text" name="phone" class="form-control form-control-lg wb-phone" maxlength="10" placeholder="เบอร์มือถือ" pattern="[0-9]{10}" required />
                                    <div class="invalid-feedback">จำเป็นต้องกรอก</div>
                                    <div class="bg-chk">
                                        <h4 class="t-primary">ท่านรับงานประเภทใด</h4>
                                        <div class="chk-box">
                                            <input type="checkbox" name="mtype[]" value="1">
                                            <label class="lable">งานปูน</label>
                                        </div>
                                        <div class="chk-box">
                                            <input type="checkbox" name="mtype[]" value="2">
                                            <label class="lable">งานเหล็ก</label>
                                        </div>
                                        <div class="chk-box">
                                            <input type="checkbox" name="mtype[]" value="3">
                                            <label class="lable">งานหลังคา</label>
                                        </div>
                                        <div class="chk-box">
                                            <input type="checkbox" name="mtype[]" value="4">
                                            <label class="lable">งานไม้</label>
                                        </div>
                                        <div class="chk-box">
                                            <input id="otherskill" type="checkbox" name="mtype[]" value="5">
                                            <label class="lable">อื่นๆ</label>
                                        </div>
                                    </div>
                                    <div class="skillbox" style="display:none">
                                        <input type="text" name="skills" class="form-control form-control-lg mb-2" placeholder="เจ้าของบ้าน ผู้รับเหมา สถาปนิก" id="skills">
                                    </div>
                                    <div class="terms">
                                        <input type="checkbox" name="termchk" id="termchk" value="1">
                                        <label class="lable-term">คุณเข้าใจและยอมรับข้อตกลงเงื่อนไขการใช้งานและ<a href="https://www.beger.co.th/th/consent" target="_blank">นโยบายความเป็นส่วนตัว</a>ของ บริษัท เบเยอร์ จำกัด
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="รับส่วนลด" class="btn btn-primary btn-block btn-lg wb_btn " id="add-user-btn" disabled>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Register End -->

        <div class="container">
            <div class="row">
                <div class="mar-t text-c">
                    <img src='images/header.png' class='logo'>
                </div>
                <div class="col-lg-12 d-flex justify-content-center">
                    <div>
                        <h1 class="text-center text-shadow">Beger ลดเลยไม่ต้องรอ</h1>
                        <h6>ขั้นตอนการรับสิทธิ์</h6>
                        <ol>
                            <li>กดสร้างโค้ดส่วนลด</li>
                            <li>กรอกชื่อสกุลและหมายเลขโทรศัพท์</li>
                            <li>นำ QR Code ให้ร้านค้าแสกน</li>
                            <li>รับส่วนลดทันที 100 บาท</li>
                        </ol>
                    </div>
                </div>

                <!-- แจ้งเตือน -->
                <div class="qr-container" style="display:none;">
                    <div id="showAlert" class="t-primary kanit"></div>
                    <div class="qr-box"></div>
                </div>
                <!-- จบแจ้งเตือน -->
                <div class="d-flex justify-content-center">
                    <button class="wb_btn" id="addBtn" type="button" data-bs-toggle="modal" data-bs-target="#addNewUserModal">สร้างโค้ดส่วนลด</button>
                </div>
                <div class="msg small-text">
                    <h6>เงื่อนไข</h6>
                    <ul>
                        <li>เริ่มตั้งแต่วันที่ 1 พฤศจิกายน - 31 ธันวาคม 2567 </li>
                        <li>คูปองนี้เป็นส่วนลดไม่สามารถแลกเป็นเงินสดได้ และสามารถใช้กับกลุ่มสินค้าเบเยอร์ได้ทุกรายการ</li>
                        <li>สามารถใช้คูปอง 1 ใบ ต่อยอดซื้อทุกๆ 1,500 บาท</li>
                        <li>การใช้คูปอง ต้องให้คูปองแก่พนักงานเก็บเงินเพื่อทำรายการก่อนชำระค่าสินค้า</li>
                        <li>คูปองสามารถใช้ได้กับร้านค้าที่ร่วมรายการเท่านั้น</li>
                        <li>บริษัทฯขอสงวนสิทธิ์ในการเปลี่ยนแปลง หรือยกเลิกเงื่อนไขโดยมิต้องแจ้งให้ทราบล่วงหน้า</li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>

    <?php } ?>

    <script src="assets/js/main.js"></script>
</body>

</html>
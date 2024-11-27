<?php
session_start();
require_once "assets/config.php";
require_once "assets/util.php";

// สร้างการเชื่อมต่อฐานข้อมูล
$config = new Config();
$conn = $config->getConnection();

if (isset($_POST['submit'])) {
    $member = $_POST['member'];
    $dealer = $_POST['dealer'];
    $ref = '';
    $img = $_FILES['img'];

    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode('.', $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt; // สร้างชื่อไฟล์ใหม่โดยใช้ rand
    $filePath = 'uploads/' . $fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath)) {
                $sql = $conn->prepare("INSERT INTO promo_usage(member_usage, dealer_match, ref_code, img) VALUES(:member_usage, :dealer_match, :ref_code, :img)");
                $sql->bindParam(":member_usage", $member);
                $sql->bindParam(":dealer_match", $dealer);
                $sql->bindParam(":ref_code", $ref);
                $sql->bindParam(":img", $fileNew);
                $sql->execute();

                if ($sql) {
                    $_SESSION['success'] = "Data has been inserted successfully";
                    header("location: thanks.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Data has not been inserted successfully";
                    // header("location: index.php");
                }
            }
        }
    }
}
?>

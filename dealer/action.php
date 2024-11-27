<?php

require_once "assets/db.php";
require_once "assets/util.php";

$db = new Database();
$util = new Util();

function getqrData()
{
    $db = new Database();
    if (isset($_POST['p'])) {
        $id = $_POST['p']; // ใช้ $_POST แทน $_GET
        $user = $db->readOne($id);
        $userJson = json_encode($user, JSON_UNESCAPED_UNICODE);

        $output = "<tr>";
        $output .= "<th>ชื่อผู้รับสิทธิ์</th>";
        $output .= "<td>" . $user['fullname'] . "</td></tr>";
        $output .= "<tr><th>โทรศัพท์</th>";
        $output .= "<td>" . $user['phone'] . "</td></tr>";

        return $output;
    }
}

if (isset($_GET['login'])) {
    $sname = $util->testInput($_POST['sname']);
    $phone = $_POST['phone'];
    $branch = $_POST['branch'];
    
    if ($db->chkDealer($phone)) {
        if ($db->insdealer($sname, $phone, $branch)) {
            $_SESSION['dealer'] = $phone;
            $cookie_name = "loged";
            $cookie_value = "1";
            setcookie($cookie_name, $cookie_value, time() + (864000 * 30), "/"); // 864000 วินาทีคือ 10 วัน
            echo $util->showMessage("success", "ลงทะเบียนเสร็จสิ้น");
        } else {
            echo $util->showMessage("danger", "ลงทะเบียนไม่สำเร็จ");
        }
    } else {
        echo $util->showMessage("success", "ท่านเคยลงทะเบียนไว้แล้ว");
    }
}
?>

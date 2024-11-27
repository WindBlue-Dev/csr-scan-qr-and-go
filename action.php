<?php

require_once "assets/db.php";
require_once "assets/util.php";

$db = new Database();
$util = new Util();

if (isset($_POST['add'])) {
    $fname = $util->testInput($_POST['fname']);
    $phone = $_POST['phone'];

    if (!empty($_POST['skills'])) {
        $skills = $_POST['skills'];
    } else {
        $skills = '';
    }

    if (!empty($_POST['mtype'])) {
        $gm = '';
        $group = $_POST['mtype'];
        foreach ($group as $row) {
            $gm .= $row . ", ";
        }
    } else {
        $gm = '0';
    }

    if ($db->chkPhone($phone)) {
        $userId = $db->insert($fname, $phone, $gm, $skills);
        if ($userId) {
            $cookie_name = "member";
            $cookie_value = $userId;
            setcookie($cookie_name, $cookie_value, time() + (864000 * 30), "/"); // 864000 วินาทีคือ 10 วัน
            echo json_encode([
                "status" => "success",
                "message" => "ลงทะเบียนเสร็จสิ้นท่านสามารถเซฟหน้าจอไว้ใช้ในครั้งถัดไป",
                "id" => $userId
            ]);
        } else {
            echo json_encode([
                "status" => "danger",
                "message" => "ลงทะเบียนไม่สำเร็จ"
            ]);
        }
    } else {
        $cookie_name = "member";
        $cookie_value = $userId;
        setcookie($cookie_name, $cookie_value, time() + (864000 * 30), "/"); // 864000 วินาทีคือ 10 วัน
        echo json_encode([
            "status" => "success",
            "message" => "ท่านเคยลงทะเบียนแล้ว ท่านสามารถใช้ QR CODE นี้รับส่วนลดได้เลย",
            "id" => $userId
        ]);
    }
}



if (isset($_GET['read'])) {
    $users = $db->read();
    $output = '';
    if ($users) {
        // var_dump($users);
        foreach ($users as $row) {
            $output .= '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['fullname'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['membertype'] . '</td>
                            <td>
                                <a style="display:none" href="#" id="' . $row['id'] . '" class="btn btn-success btn-sm rounded-pull py-0 editlink" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</a>
                                <a style="display:none" href="#" id="' . $row['id'] . '" class="btn btn-danger btn-sm rounded-pull py-0 deletelink">Delete</a>
                            </td>
                </tr>';
        }
        echo $output;
    } else {
        echo '<tr>
                <td colspan="6">No users found in the Database</td>
            </tr>';
    }
}

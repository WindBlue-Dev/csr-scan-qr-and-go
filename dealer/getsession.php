<?php
// เริ่ม session
session_start();
// ส่งข้อมูล session กลับมาในรูปแบบ JSON
echo json_encode(array("dealerdata" => $_SESSION["dealer"]));
?>
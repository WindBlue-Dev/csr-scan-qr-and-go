<?php
require_once "config.php";

// สร้างออบเจ็กต์ Config และรับการเชื่อมต่อฐานข้อมูล
$config = new Config();
$conn = $config->getConnection();

// SQL ดึงข้อมูลจากตาราง
$sql = "SELECT * FROM members"; // ตรวจสอบชื่อโต๊ะให้ถูกต้อง
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ส่งข้อมูลเป็น JSON
echo json_encode($result);
?>

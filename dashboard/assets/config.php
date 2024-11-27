<?php
// config.php ควรมีการเชื่อมต่อฐานข้อมูลเช่นเดียวกับในตัวอย่างก่อนหน้า
require_once "../assets/config.php";

$config = new Config();
$conn = $config->getConnection();

$sql = "SELECT * FROM table_name"; // เปลี่ยน 'table_name' เป็นชื่อตารางของคุณ
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>

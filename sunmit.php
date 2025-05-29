<?php
session_start();

$conn = new mysqli("localhost", "root", "", "student_db");
if ($conn->connect_error) {
  die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}


$student_name = $_POST['student_name'];
$class_level = $_POST['class_level'];
$class_room = $_POST['class_room'];
$student_number = $_POST['student_number'];
$visit_purpose = $_POST['visit_purpose'];


$stmt = $conn->prepare("INSERT INTO home_visit (student_name, class_level, class_room, student_number, visit_purpose, status) VALUES (?, ?, ?, ?, ?, 'รออนุมัติ')");
$stmt->bind_param("sssis", $student_name, $class_level, $class_room, $student_number, $visit_purpose);
$stmt->execute();


$_SESSION['student_data'] = [
  'student_name' => $student_name,
  'class_level' => $class_level,
  'class_room' => $class_room,
  'student_number' => $student_number,
  'visit_purpose' => $visit_purpose,
  'status' => 'รออนุมัติ'
];

$stmt->close();
$conn->close();

header("Location: student_view.php");
exit();
?>

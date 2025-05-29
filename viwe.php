<?php
session_start();

$data = $_SESSION['student_data'] ?? null;
if (!$data) {
  echo "ไม่พบข้อมูล";
  exit();
}

$is_editable = $data['status'] === 'รออนุมัติ';
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ข้อมูลการเยี่ยมบ้าน</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>ข้อมูลการเยี่ยมบ้าน</h2>

  <p><strong>ชื่อนักเรียน:</strong> <?= htmlspecialchars($data['student_name']) ?></p>
  <p><strong>ชั้น:</strong> <?= htmlspecialchars($data['class_level']) ?> / <?= htmlspecialchars($data['class_room']) ?></p>
  <p><strong>เลขที่:</strong> <?= htmlspecialchars($data['student_number']) ?></p>
  <p><strong>วัตถุประสงค์:</strong> <?= htmlspecialchars($data['visit_purpose']) ?></p>

  <p><strong>สถานะ:</strong>
    <span style="color:<?= $data['status'] == 'รออนุมัติ' ? 'orange' : 'green' ?>">
      <?= $data['status'] ?>
    </span>
  </p>

  <?php if ($is_editable): ?>
    <a href="edit_form.php">[ แก้ไขข้อมูล ]</a>
  <?php else: ?>
    <p style="color: gray;">ไม่สามารถแก้ไขได้เนื่องจากได้รับการอนุมัติแล้ว</p>
  <?php endif; ?>
</body>
</html>

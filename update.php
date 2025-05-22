<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = (int)$_POST['id'];

  if (isset($_POST['task'])) {
    $task = trim($_POST['task']);
    if ($task !== '') {
      $stmt = $conn->prepare("UPDATE tasks SET task = ? WHERE id = ?");
      $stmt->bind_param("si", $task, $id);
      $stmt->execute();
      $stmt->close();
    }
  } elseif (isset($_POST['done'])) {
    $done = (int)$_POST['done'];
    $stmt = $conn->prepare("UPDATE tasks SET done = ? WHERE id = ?");
    $stmt->bind_param("ii", $done, $id);
    $stmt->execute();
    $stmt->close();
  }
}
echo "OK";
?>

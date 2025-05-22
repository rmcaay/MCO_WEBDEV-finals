<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $task = trim($_POST['task']);
  if ($task !== '') {
    $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    $stmt->close();
  }
}
echo "OK";
?>
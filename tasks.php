<?php
require 'db.php';
$order = "created_at ASC";
$where = "1=1";

if (isset($_GET['sort'])) {
  if ($_GET['sort'] === 'date_desc') $order = "created_at DESC";
  if ($_GET['sort'] === 'status') $order = "done ASC, created_at ASC";
}
if (isset($_GET['filter']) && $_GET['filter'] === 'undone') {
  $where = "done = 0";
}

$result = $conn->query("SELECT * FROM tasks WHERE $where ORDER BY $order");
while($row = $result->fetch_assoc()): ?>
  <li class="<?php echo $row['done'] ? 'crossed' : ''; ?>">
    <input type="checkbox" onchange="toggleDone(<?php echo $row['id']; ?>, this.checked)" <?php echo $row['done'] ? 'checked' : ''; ?>>
    <?php echo htmlspecialchars($row['task']); ?>
    <br>
    <form onsubmit="updateTask(event, <?php echo $row['id']; ?>)" style="display:inline">
      <input type="text" name="task" placeholder="Edit ..." required>
      <button type="submit">Update</button>
    </form>
    <button onclick="deleteTask(<?php echo $row['id']; ?>)">Delete</button>
  </li>
<?php endwhile; ?>
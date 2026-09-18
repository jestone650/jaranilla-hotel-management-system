<?php
include 'db.php';
$result = $conn->query("SELECT * FROM rooms ORDER BY room_number ASC");
?>
<!DOCTYPE html>
<html>
<head><title>Hotel Rooms</title></head>
<body>
    <h1>Rooms</h1>
    <a href="create.php">+ Add New Room</a>
    <table border="1" cellpadding="8">
        <tr><th>Room #</th><th>Type</th><th>Price</th><th>Status</th><th>Actions</th></tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['room_number']); ?></td>
            <td><?php echo htmlspecialchars($row['room_type']); ?></td>
            <td><?php echo number_format($row['price'], 2); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this room?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
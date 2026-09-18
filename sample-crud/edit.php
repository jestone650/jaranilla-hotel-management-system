<?php
include 'db.php';
$id = intval($_GET['id'] ?? $_POST['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("UPDATE rooms SET room_number = ?, room_type = ?, price = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $_POST['room_number'], $_POST['room_type'], $_POST['price'], $_POST['status'], $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();

function selected($value, $current) {
    return $value === $current ? 'selected' : '';
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Room</title></head>
<body>
    <h1>Edit Room</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Room Number: <input type="text" name="room_number" value="<?php echo htmlspecialchars($row['room_number']); ?>" required><br><br>
        Room Type:
        <select name="room_type" required>
            <option value="Single" <?php echo selected('Single', $row['room_type']); ?>>Single</option>
            <option value="Double" <?php echo selected('Double', $row['room_type']); ?>>Double</option>
            <option value="Suite" <?php echo selected('Suite', $row['room_type']); ?>>Suite</option>
            <option value="Deluxe" <?php echo selected('Deluxe', $row['room_type']); ?>>Deluxe</option>
        </select><br><br>
        Price per Night: <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required><br><br>
        Status:
        <select name="status" required>
            <option value="Available" <?php echo selected('Available', $row['status']); ?>>Available</option>
            <option value="Occupied" <?php echo selected('Occupied', $row['status']); ?>>Occupied</option>
            <option value="Maintenance" <?php echo selected('Maintenance', $row['status']); ?>>Maintenance</option>
        </select><br><br>
        <button type="submit">Update</button>
    </form>
    <a href="index.php">Back to list</a>
</body>
</html>
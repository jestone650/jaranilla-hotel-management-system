<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO rooms (room_number, room_type, price, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $_POST['room_number'], $_POST['room_type'], $_POST['price'], $_POST['status']);
    $stmt->execute();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Room</title></head>
<body>
    <h1>Add New Room</h1>
    <form method="POST">
        Room Number: <input type="text" name="room_number" required><br><br>
        Room Type:
        <select name="room_type" required>
            <option value="Single">Single</option>
            <option value="Double">Double</option>
            <option value="Suite">Suite</option>
            <option value="Deluxe">Deluxe</option>
        </select><br><br>
        Price per Night: <input type="number" step="0.01" name="price" required><br><br>
        Status:
        <select name="status" required>
            <option value="Available">Available</option>
            <option value="Occupied">Occupied</option>
            <option value="Maintenance">Maintenance</option>
        </select><br><br>
        <button type="submit">Save</button>
    </form>
    <a href="index.php">Back to list</a>
</body>
</html>
<?php

require_once '../../app/Classes/VehicleBase.php';
require_once '../../app/Classes/FileHandler.php';
require_once '../../app/Classes/VehicleManager.php';

// Initialize variables
$id = $_GET['id'] ?? null;
$vehicles = [];
$currentVehicle = null;

// Load existing vehicles
$manager = new VehicleManager('', '', '', '');
$vehicles = $manager->readFromFile();

// Get the vehicle to edit
if ($id !== null && isset($vehicles[$id])) {
    $currentVehicle = $vehicles[$id];
} else {
    die('Invalid vehicle ID.');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $type = $_POST['type'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? '';

    // Update vehicle details
    $vehicles[$id] = [
        'name' => $name,
        'type' => $type,
        'price' => $price,
        'image' => $image
    ];

    // Save updated data to file
    $manager->writeToFile($vehicles);

    // Redirect to the index page
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Vehicle</h1>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($currentVehicle['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" id="type" name="type" class="form-control" value="<?= htmlspecialchars($currentVehicle['type']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" id="price" name="price" class="form-control" value="<?= htmlspecialchars($currentVehicle['price']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" id="image" name="image" class="form-control" value="<?= htmlspecialchars($currentVehicle['image']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>

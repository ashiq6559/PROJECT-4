

<?php

require_once '../../app/Classes/VehicleBase.php';
require_once '../../app/Classes/FileHandler.php';
require_once '../../app/Classes/VehicleManager.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $type = $_POST['type'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? '';

    $manager = new VehicleManager($name, $type, $price, $image);

    $vehicles = $manager->readFromFile();
    $vehicles[] = $manager->getDetails(); // Add new vehicle
    $manager->writeToFile($vehicles);

    echo "Vehicle added successfully!";

    header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Vehicle</h1>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" id="type" name="type" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" id="image" name="image" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Vehicle</button>
        </form>
    </div>
</body>
</html>

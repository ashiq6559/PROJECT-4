<?php

// Required classes and trait
require_once '../../app/Classes/VehicleBase.php';
require_once '../../app/Classes/FileHandler.php';
require_once '../../app/Classes/VehicleManager.php';

// Initialize VehicleManager to handle operations
$manager = new VehicleManager('', '', '', '');
$vehicles = $manager->getVehicles(); // Fetch all vehicles from the JSON file

require_once 'header.php'; // Include navigation header
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Vehicle List</h1>
    
    <?php if (!empty($vehicles)): ?>
        <div class="row">
            <?php foreach ($vehicles as $index => $vehicle): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($vehicle['image'] ?? 'placeholder.jpg') ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($vehicle['name'] ?? 'No Image') ?>" 
                             style="height: 200px; object-fit: cover;">
                        
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($vehicle['name'] ?? 'Unknown') ?></h5>
                            <p class="card-text">
                                Type: <?= htmlspecialchars($vehicle['type'] ?? 'Unknown') ?><br>
                                Price: $<?= htmlspecialchars($vehicle['price'] ?? '0.00') ?>
                            </p>
                            <a href="edit.php?id=<?= $index ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $index ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Are you sure you want to delete this vehicle?');">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            No vehicles found. <a href="add.php" class="btn btn-primary btn-sm">Add New Vehicle</a>
        </div>
    <?php endif; ?>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

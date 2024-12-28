<?php

require_once '../../app/Classes/VehicleManager.php';

$manager = new VehicleManager('', '', '', '');

if (!isset($_GET['id'])) {
    die('Vehicle ID not provided.');
}

$id = $_GET['id'];
$manager->deleteVehicle($id);
header('Location: index.php');
exit;
?>

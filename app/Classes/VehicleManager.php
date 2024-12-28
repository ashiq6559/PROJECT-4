<?php

require_once 'VehicleBase.php'; // Include the VehicleBase file
require_once 'FileHandler.php'; // Include the FileHandler trait

class VehicleManager extends VehicleBase
{
    use FileHandler;

    public function __construct($name, $type, $price, $image)
    {
        parent::__construct($name, $type, $price, $image);
    }



    public function addVehicle($data)
    {
        $vehicles = $this->readFile();
        // $vehicles[] = $data;
        $newVehicles = array_merge($vehicles,$data);
        $this->writeFile($newVehicles);
    }

    public function editVehicle($id, $data)
    {
        $vehicles = $this->readFile();
        foreach ($vehicles as &$vehicle) {
            if ($vehicle['id'] == $id) {
                $vehicle = array_merge($vehicle, $data);
                break;
            }
        }
        $this->writeFile($vehicles);
    }

    public function deleteVehicle($index)
    {
        // Read existing vehicles from the file
        $vehicles = $this->readFile();
    
        // Check if the index exists in the array
        if (isset($vehicles[$index])) {
            // Remove the vehicle at the specified index
            unset($vehicles[$index]);
    
            // Re-index the array after deletion to avoid gaps in the array keys
            $this->writeFile(array_values($vehicles));
    
            echo "Vehicle at index $index has been deleted.";
        } else {
            echo "No vehicle found at index $index.";
        }
    }
    
    

    public function getVehicles()
    {
        return $this->readFile();
    }

    public function getDetails()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'price' => $this->price,
            'image' => $this->image,
        ];
    }
}

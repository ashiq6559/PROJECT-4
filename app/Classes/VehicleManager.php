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
        $data['id'] = count($vehicles) + 1;
        $vehicles[] = $data;
        $this->writeFile($vehicles);
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

    public function deleteVehicle($id)
    {
        $vehicles = $this->readFile();
        $vehicles = array_filter($vehicles, fn($v) => $v['id'] != $id);
        $this->writeFile(array_values($vehicles));
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

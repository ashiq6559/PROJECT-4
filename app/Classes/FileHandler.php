<?php

trait FileHandler
{
    protected $filePath = __DIR__ . '/../../data/vehicles.json';

    protected function readFile()
    {
        if (!file_exists($this->filePath)) {
            return [];
        }
        $content = file_get_contents($this->filePath);
        return json_decode($content, true) ?? [];
    }

    protected function writeFile($data)
    {
        // file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->filePath, $jsonData);
    }

    // private $filePath = '../data/vehicles.json';

    // Read data from the JSON file
    public function readFromFile()
    {
        if (file_exists($this->filePath)) {
            $jsonData = file_get_contents($this->filePath);
            return json_decode($jsonData, true) ?? [];
        }
        return [];
    }

    // Write data to the JSON file
    public function writeToFile(array $data)
    {
        $jsonData = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->filePath, $jsonData);
    }
}

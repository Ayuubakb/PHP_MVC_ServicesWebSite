<?php
class Services extends Model
{
    public function __construct(){
        self::getModel();
    }

    public function getAllServices()
    {
        $query = self::$instance->prepare("SELECT * FROM services");
        $query->execute();
        $services = $query->fetchAll();

        return $services;
    }
}


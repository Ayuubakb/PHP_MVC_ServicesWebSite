<?php
class Reservation extends Model
{
    public function __construct(){
        self::getModel();
    }

    public function getAllReservations()
    {
        $query = self::$instance->prepare("SELECT * FROM reservation");
        $query->execute();
        $reservations = $query->fetchAll();

        return $reservations;
    }
}

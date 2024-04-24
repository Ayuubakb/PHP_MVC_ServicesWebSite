<?php

require_once 'Model.php'; // Include the base Model class

class Admindash extends Model {
    // Constructor
    public function __construct() {
        // No need to set $this->table in the constructor
    }

    // Method to fetch statistics from the database
    public function getStats() {
        $pdo = $this->getModel(); // Get PDO instance

        // Query for total clients
        $sql_clients = "SELECT COUNT(*) AS total_clients FROM client";
        $stmt_clients = $pdo->query($sql_clients);
        $total_clients = $stmt_clients->fetch(PDO::FETCH_ASSOC)['total_clients'];

        // Query for total partners
        $sql_partners = "SELECT COUNT(*) AS total_partners FROM Partenaire";
        $stmt_partners = $pdo->query($sql_partners);
        $total_partners = $stmt_partners->fetch(PDO::FETCH_ASSOC)['total_partners'];

        // Query for comments by time (example query, adjust as per your database schema)
        $sql_comments_by_time = "SELECT DATE_FORMAT(Date_post, '%Y-%m') AS post_month, COUNT(*) AS comment_count FROM commentaire GROUP BY post_month";
        $stmt_comments_by_time = $pdo->query($sql_comments_by_time);
        $comments_by_time = $stmt_comments_by_time->fetchAll(PDO::FETCH_ASSOC);

        // Query for reservations by status (example query, adjust as per your database schema)
        $sql_reservations_by_status = "SELECT Statuts, COUNT(*) AS reservation_count FROM reservation GROUP BY Statuts";
        $stmt_reservations_by_status = $pdo->query($sql_reservations_by_status);
        $reservations_by_status = $stmt_reservations_by_status->fetchAll(PDO::FETCH_ASSOC);

        return [
            'total_clients' => $total_clients,
            'total_partners' => $total_partners,
            'comments_by_time' => $comments_by_time,
            'reservations_by_status' => $reservations_by_status
        ];
    }
}

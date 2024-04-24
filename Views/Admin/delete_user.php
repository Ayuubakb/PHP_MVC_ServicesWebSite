<?php
// Include the database connection file
require_once 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if id and role are set
    if(isset($_POST['id']) && isset($_POST['role'])){
        // Retrieve id and role from the POST data
        $id = $_POST['id'];
        $role = $_POST['role'];
        
        // Define the table name based on the role
        $tableName = $role ;// Assuming table names are plural
        
        // SQL query to delete the user based on ID
        $sql = "DELETE FROM $tableName WHERE id = :id";
        
        try {
            // Prepare the SQL statement
            $stmt = $pdo->prepare($sql);
            
            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            
            // Execute the SQL statement
            $stmt->execute();
            
            // Check if any rows were affected
            $rowCount = $stmt->rowCount();
            
            if($rowCount > 0) {
                // User deleted successfully
                echo "User with ID: $id deleted successfully from $role table.";
                header("Location: http://localhost/web/bricolini/admin/users");

            } else {
                // No user found with the provided ID
                echo "No user found with ID: $id in $role table.";
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Handle if id or role are not set
        echo "Error: ID or role not set.";
    }
} else {
    // Handle if the form is not submitted
    echo "Error: Form not submitted.";
}
?>

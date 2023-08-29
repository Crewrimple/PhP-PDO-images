<?php
try {
    
    require('dbConnection.php');

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];

        
        $query = "INSERT INTO users (name, age, email) VALUES (:name, :age, :email)";
        $stmt = $pdo->prepare($query);

      
        
        if ($stmt->execute()) {
            header('location: index.php');
            
        } else {
            echo "Failed to insert data into the database.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

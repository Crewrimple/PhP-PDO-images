<?php
try {
    $databaseHost = 'localhost';
    $databaseName = 'pdo';
    $databaseUsername = 'root';
    $databasePassword = '';

    $pdo = new PDO("mysql:host=$databaseHost;dbname=$databaseName", $databaseUsername, $databasePassword);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!$pdo) {
        die('Не удалось подключиться к базе данных...');
    }

   

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];

        
        $query = "INSERT INTO users (name, age, email) VALUES (:name, :age, :email)";
        $stmt = $pdo->prepare($query);

        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':email', $email);

       
        if ($stmt->execute()) {
            header('location: index.php');
            
        } else {
            echo "Не удалось вставить данные в базу данных.";
        }
    }
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>


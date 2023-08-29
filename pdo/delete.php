<?php
try {
    require_once("dbConnection.php");

    $id = $_GET['id'];

    
    $query = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);

    
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

  
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Не удалось удалить данные из базы данных.";
    }
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>

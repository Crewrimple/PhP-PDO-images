<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        
        $uploadDir = "uploads/";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true); 
        }

        
        $fileName = $_FILES["image"]["name"];
        $fileTmpName = $_FILES["image"]["tmp_name"];
        $fileType = $_FILES["image"]["type"];
        $fileSize = $_FILES["image"]["size"];

        $uniqueFileName = uniqid() . "_" . $fileName;

        $allowedTypes = array("image/jpeg", "image/png", "image/gif");

        if (in_array($fileType, $allowedTypes)) {
          
            if (move_uploaded_file($fileTmpName, $uploadDir . $uniqueFileName)) {
              
                require_once("dbConnection.php"); 

                
                if (!$pdo) {
                    die("Database connection failed.");
                }

                $insertQuery = "INSERT INTO uploaded_images (file_name, file_path) VALUES (:file_name, :file_path)";
                $stmt = $pdo->prepare($insertQuery);

                if ($stmt) {
                    $stmt->bindParam(':file_name', $uniqueFileName);
                    $stmt->bindParam(':file_path', $uploadDir);

                    if ($stmt->execute()) {
                        echo "Файл успешно загружен и информация сохранена в базе данных!";
                    } else {
                        echo "Ошибка при сохранении информации в базе данных: " . $stmt->errorInfo()[2];
                    }

                    $stmt = null; 
                } else {
                    echo "Ошибка при подготовке запроса: " . $pdo->errorInfo()[2];
                }

                
            } else {
                echo "Ошибка при загрузке файла.";
            }
        } else {
            echo "Недопустимый тип файла. Разрешены файлы JPEG, PNG и GIF.";
        }
    } else {
        echo "Ошибка: " . $_FILES["image"]["error"];
    }
}
?>

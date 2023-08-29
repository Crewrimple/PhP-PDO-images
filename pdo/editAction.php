<?php
require_once("dbConnection.php");

if (isset($_POST['update'])) {
    try {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];

        if (empty($name) || empty($age) || empty($email)) {
            if (empty($name)) {
                echo "<font color='red'>Поле 'Имя' пусто.</font><br/>";
            }

            if (empty($age)) {
                echo "<font color='red'>Поле 'Возраст' пусто.</font><br/>";
            }

            if (empty($email)) {
                echo "<font color='red'>Поле 'Email' пусто.</font><br/>";
            }
        } else {
          
            $query = "UPDATE users SET `name` = :name, `age` = :age, `email` = :email WHERE `id` = :id";
            $stmt = $pdo->prepare($query);

           
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                echo "<p><font color='green'>Данные успешно обновлены!</p>";
            } else {
                echo "<font color='red'>Не удалось обновить данные в базе данных.</font>";
            }
        }
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>    
    <title>Edit Data</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            background-color: #333; 
            color: #fff; 
            padding: 10px;
        }
        p {
            margin-top: 10px;
        }
        form {
            background-color: #fff; 
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #333; 
            color: #fff; 
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555; 
        }
        
        a.button {
            background-color: #333; 
            color: #fff; 
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
        }
        a.button:hover {
            background-color: #555; 
        }
    </style>
</head>
<body>
    <h2>Edit Data</h2>
    <p>
        <a href="index.php" class="button">View Result</a>
    </p>
    
    <form name="edit" method="post" action="editAction.php">
        <table border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr> 
                <td>Age</td>
                <td><input type="text" name="age" value="<?php echo $age; ?>"></td>
            </tr>
            <tr> 
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>


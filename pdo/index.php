<?php
require_once("dbConnection.php");

try {
    
    $query = "SELECT * FROM users ORDER BY id DESC";
    $query_image = "SELECT * FROM uploaded_images";
    $stmt = $pdo->query($query);
    $stmt_image = $pdo->query($query_image);
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $resultImage = $stmt_image->fetchAll(PDO::FETCH_ASSOC); 
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


        table th, table td {
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #333;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }


        table tr:hover {
            background-color: #ddd;
        }

        .action-links a {
            text-decoration: none;
            margin-right: 10px;
        }

        .action-links a.edit {
            color: #007bff;
        }

        .action-links a.delete {
            color: #dc3545;
        }

        .add-button {
            display: block;
            text-align: center;
            margin: 20px;
        }

        .add-btn {
            background-color: #333; 
            color: #f2f2f2; 
            padding: 10px 20px; 
            border: none; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        .add-btn:hover {
            background-color: #999; 

            background-color: #ccc; 
            color: #fff; 
            padding: 10px 20px; 
            border: none; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        
        }
    </style>
</head>
<body>
    <h2>Homepage</h2>
    <p class="add-button">
        <a href="add.php">
            <button class="add-btn">Add New Data</button>
        </a>
    </p>
    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($result as $res) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($res['name']) . "</td>";
            echo "<td>" . htmlspecialchars($res['age']) . "</td>";
            echo "<td>" . htmlspecialchars($res['email']) . "</td>";
            echo "<td>";
            echo "<a class='edit' href=\"edit.php?id=" . $res['id'] . "\">Edit</a> | ";
            echo "<a class='delete' href=\"delete.php?id=" . $res['id'] . "\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <div style="text-align: center;">
    <h2>Загрузить изображение</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="image" style="font-weight: bold;">Выберите изображение:</label>
        <input type="file" name="image" id="image" accept="image/*" required style="display: none;">
        <label for="image" style="cursor: pointer; background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px;">Выбрать файл</label>
        <span id="selected-file-name" style="margin-left: 10px;"></span>
        <input type="submit" value="Загрузить" style="margin-top: 10px; background-color: #28a745; color: #fff; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    </form>

    <div>
        <!-- <?php foreach($resultImage as $img){ ?>

            <img src="<?php echo $img['file_path'] . $img['file_name'] ?>" alt="">
            <?php } ?> -->
            <img src="<?php echo $resultImage[1]['file_path'] . $resultImage[1]['file_name'] ?>" alt="">

    </div>
</div>

<script>
   
    document.getElementById("image").addEventListener("change", function() {
        var fileName = this.files[0].name;
        document.getElementById("selected-file-name").textContent = fileName;
    });
</script>
</body>
</html>

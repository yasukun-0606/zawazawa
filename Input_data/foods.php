<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>摂取カロリー登録</title>
</head>

<style>
    body{
        background:linear-gradient(110deg,skyblue,yellow);
    }
    
</style>

<body>
    
    <?php

        $dsn = 'mysql:host=localhost;dbname=zawazawadb;charset=utf8';  
        $user = 'root';
        $password = '';
        $pdo = new PDO($dsn, $user, $password);

        $foods = $_POST['foods'];                                       
        $calories = $_POST['calories'];
        
        $sql = "insert into foods(foods, calories) values(?, ?)"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$foods, $calories]);
        
        http_response_code(301);
        header("Location:foods.html");
        exit;
    ?>
</body>
</html>


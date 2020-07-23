
<?php
    //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
    require_once __DIR__ .'/config.php';

    //セッションの引継ぎ    
    session_start();
    $name =$_SESSION['user_name'];
    //ログイン情報の保持
    $chosesql="select * from user where user_name = ?";
    //$databasesql="select * table user_name";
    $stmt=$pdo->prepare($chosesql);
    $stmt->execute([$name]);
    //$result = $stmt->fetch(PDO::FETCH_ASSOC);
    foreach($stmt as $row){
        $username =$row['user_name'];
        $userid=$row['user_id'];
    }
    //echo $name;
    //echo $username;
    //echo $userid;

    //入力内容の保持    
    $age = $_POST['age'];  //年齢
    $gender = $_POST['gender']; //性別  
    $height = $_POST['height']; //身長
    $weight = $_POST['weight']; //体重
    $moment = $_POST['moment']; //運動強度  
    $eight = $_POST['target']; //目標

    //男女別の代謝計算用の値の判別
    if($gender==1){ //男
        $heightvalue=5;
        $weightvalue=13.8;
        $agevalue=6.8;
    }else{ //女
        $heightvalue=1.7;
        $weightvalue=9.6;
        $agevalue=7;
    }
    //代謝計算
    $metabo=66.5+($weight*$weightvalue)+($height*$heightvalue)+($age*$agevalue);
    
    
    echo $metabo;
    //データの登録
    $sql = "insert into user_table(id,name,height,weight,age, movement, gender, metabolism, target) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";   //valuesで値を受け取る。カラムに値を格納できるようにする 
    $stmt = $pdo->prepare($sql); //SQL文をセットしてデータベースに接続
    $stmt->execute([$userid, $username, $age, $height, $weight, $gender, $moment, $metabo, $eight]); 
     
    header('Location:calendar.php');
?>

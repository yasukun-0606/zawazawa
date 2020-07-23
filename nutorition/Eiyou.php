<?php

    //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
    require_once __DIR__ .'/config.php';

    //セッションの引継ぎ    
    session_start();
    
    //ログイン情報の保持
    
    $datasql="select * table user";
    $stmt2=$pdo->prepare($datasql);
    $result = $stmt2->fetch(PDO::FETCH_ASSOC);

    $id=$result['user_id'];
    $name=$result['user_name'];

    //入力内容の保持    
    $age = $_POST['age'];  //年齢
    $gender = $_POST['gender']; //性別  
    $height = $_POST['height']; //身長
    $weight = $_POST['weight']; //体重
    $moment = $_POST['moment']; //運動強度  
    $eight = $_POST['target']; //目標
    
    $sql = "insert into user_table(id,name,age,height,weight,moment,eight) values(?, ?, ?, ?, ?, ?, ?)";   //valuesで値を受け取る。カラムに値を格納できるようにする 
    $stmt = $pdo->prepare($sql); //SQL文をセットしてデータベースに接続
    $stmt->execute([$id, $name, $age, $height, $weight, $moment, $eight]); 
    
    header('Location:calendar.php');
?>

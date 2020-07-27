<!--
********************************************
*This is update code
*Name: Kazuya Miyagawa
*CreateDate: 2020/07/10 11:40:00
*Version: 1.00
*Update: 2020/07/20
*What to do:　
*******************************************
-->

<?php
    //データベース接続情報ファイル
    require_once('../config.php');

    //セッションの引継ぎ    
    session_start();
    $name =$_SESSION['user_name'];
    //ログイン情報の保持
    $chosesql="select * from user where user_name = ?";
    $stmt=$pdo->prepare($chosesql);
    $stmt->execute([$name]);
    //
    foreach($stmt as $row){
        $username =$row['user_name'];
        $userid=$row['user_id'];
        $_SESSION['user_id']=$userid;
    }

    //入力内容の保持 
    $height = $_POST['height']; //身長
    $weight = $_POST['weight']; //体重
    $age = $_POST['age'];  //年齢
    $moment = $_POST['moment']; //運動強度 
    $gender = $_POST['gender']; //性別  
    $eight = $_POST['target']; //目標

    //男女別の代謝計算用の値の判別
    if($gender==1){
        //男
        $heightvalue=5;
        $weightvalue=13.8;
        $agevalue=6.8;
    }else{ 
        //女
        $heightvalue=1.7;
        $weightvalue=9.6;
        $agevalue=7;
    }

    //代謝計算
    $metabo=66.5+($weight*$weightvalue)+($height*$heightvalue)+($age*$agevalue);
    
    //データの登録　id、名前、身長、体重、年齢、運動強度、性別、代謝、目標
    $sql = "insert into user_table(id,name,height,weight,age, movement, gender, metabolism, target) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";   //valuesで値を受け取る。カラムに値を格納できるようにする 
    $stmt = $pdo->prepare($sql); //SQL文をセットしてデータベースに接続
    $stmt->execute([$userid,$username,$height,$weight,$age,$moment,$gender,$metabo,$eight]); 

    //カレンダー画面への遷移
    header('Location:calendar.php');
?>

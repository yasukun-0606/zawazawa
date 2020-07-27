<!--
********************************************
*This is update code
*Name: Kazuya Miyagawa
*CreateDate: 2020/07/10 11:40:00
*Version: 1.00
*Update: 2020/07/27
*What to do:　データベース上のデータの保持を行い、データが入力されているか確認する
入力されたデータがあれば更新用の変数に代入する
入力されたデータがあってもなくてもデータベースを更新する

*******************************************
-->

<?php
    //データベース接続情報ファイル
    require_once('../config.php');

    //セッションの引継ぎ    
    session_start();
    $name =$_SESSION['user_name'];
    //元のデータ保持
    $chosesql="select * from user_table where name = ?";
    $stmt=$pdo->prepare($chosesql);
    $stmt->execute([$name]);
    //保持したデータを更新用変数に格納
    foreach($stmt as $row){
        $height2=$row['height'];
        $weight2=$row['weight'];
        $age2=$row['age'];
        $gender2=$row['gender'];
        $moment2=$row['movement'];
        $metabo2=$row['metabolism'];
        $target2=$row['target'];
    }
    /*
    //入力内容の保持    
    送られてきたデータが空なら元のデータを保持
    
    更新用変数
    $height 身長
    $weight　体重
    $age　年齢
    $moment　運動強度
    $gender　性別
    $metabo　代謝
    $target　目標
    */ 
    
    //年齢 
    if(empty($_POST['age'])){
        $age=$age2;
    }else{
        $age=$_POST['age'];
    }

    //性別
    if(empty($_POST['gender'])){
        $gender = $gender2 ; 
    }else{
        $gender = $_POST['gender'];
    }
    
    //身長
    if(empty($_POST['height'])){
        $height=$height2;
    }else{
        $height=$_POST['height'];
    }

    //体重
    if(empty($_POST['weight'])){
        $weight=$weight2;
    }else{
        $weight=$_POST['weight'];
    }
    
    //運動強度
    if(empty($_POST['moment'])){
        $moment = $moment2; 
    }else{
        $moment = $_POST['moment'];
    }
    
    //目標
    //$target = $_POST['target']; 
    if(empty($_POST['target'])){
        $target=$target2;
    }else{
        $target=$_POST['target'];
    }
  

   //男女別の代謝計算用の値の判別
    if($_POST['gender'] != $gender2){
        //男女判別 gender　1:男  2:女
        if($gender2==1){ 
            //男
            $heightvalue=5; //身長計算用変数
            $weightvalue=13.8;  //体重計算用変数
            $agevalue=6.8;  //年齢計算用変数
        }else{ 
            //女
            $heightvalue=1.7;   //身長計算用変数
            $weightvalue=9.6;   //体重計算用変数
            $agevalue=7;    //年齢計算用変数
        }
        //代謝計算
        $metabo=66.5+($weight*$weightvalue)+($height*$heightvalue)+($age*$agevalue);

    }

    //idとname以外のデータの更新
    $sql = "UPDATE user_table SET height = ?, weight = ?, age = ?, movement = ?, gender = ?, metabolism = ?, target = ? where name= ?";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$height,$weight,$age,$moment,$gender,$metabo,$target,$name]); 
    //(ここまで)

    //基本情報画面への遷移
    header('Location:user_information.php');
?>h

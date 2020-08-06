<?php
    //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
    require_once('../config.php');

    //セッションの引継ぎ    
    session_start();
    $name =$_SESSION['user_name'];
    //ログイン情報の保持 user_tableの情報の保持
    $chosesql="select * from user_table where name = ?";
    $stmt=$pdo->prepare($chosesql);
    $stmt->execute([$name]);
    //元のデータ保持
    foreach($stmt as $row){
        $height2=$row['height'];
        $weight2=$row['weight'];
        $age2=$row['age'];
        $gender2=$row['gender'];
        $moment2=$row['movement'];
        $metabo2=$row['metabolism'];
        $target2=$row['target'];
    }

    //入力内容の保持    
    //送られてきたデータが空なら元のデータを保持

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
        if($gender2==1){ 
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

        // 代謝更新
        /*$sql = "UPDATE user_table SET metabolism = ?";
        $stmt = $pdo->prepare($sql); 
        $stmt->execute($metabo); */
    }
    echo $metabo;
    //データの登録
    $sql = "UPDATE user_table SET height = ?, weight = ?, age = ?, movement = ?, gender = ?, metabolism = ?, target = ? where name= ?";
    $stmt = $pdo->prepare($sql); 
    $stmt->execute([$height,$weight,$age,$moment,$gender,$metabo,$target,$name]); 
    
    //(ここまで)

    header('Location:user_information.php');
?>h

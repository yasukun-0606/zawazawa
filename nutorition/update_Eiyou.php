<?php
    //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
    require_once('../config.php');

    //セッションの引継ぎ    
    session_start();
    $name =$_SESSION['user_name'];
    //ログイン情報の保持
    $chosesql="select * from user where user_name = ?";
    $stmt=$pdo->prepare($chosesql);
    $stmt->execute([$name]);
    //元のデータ保持
    foreach($stmt as $row){
        $age2=$row['age'];
        $height2=$row['height'];
        $weight2=$row['weight'];
        $gender2=$row['gender'];
    }

    //入力内容の保持    
    
    //年齢
    if($_POST['age']==0){
        $age=$age2;
        $sql = "UPDATE user_table SET age = ? where = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$age,$name]);
    }

    if(isset($_POST['gender'])){
        $gender = $_POST['gender']; //性別
    }else{
        $gender = $gender2;
    }

    //身長
    if($_POST['height']==0){
        $height=$height2;
        $sql = "UPDATE user_table SET height = ? where = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$height,$name]);
    }

    //体重
    if($_POST['weight']==0){
        $weight=$weight2;
        $sql = "UPDATE user_table SET weight = ? where = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$weight,$name]);
    }
    
    //運動強度
    if(isset($_POST['gender'])){
        $moment = $_POST['moment']; 
    }else{
        $moment = "";
    }

    $target = $_POST['target']; //目標

    //空白でなければ更新(ここから)
    if(isset($age)){        
       
    }

    if(isset($gender)){
        $sql = "UPDATE user_table SET gender = ? where = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$gender,$name]);
    }

    if(isset($moment)){
        $sql = "UPDATE user_table SET moment =  where = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$moment,$name]);
    }

    if(isset($target)){
        $sql = "UPDATE user_table SET target = ? where = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$target,$name]);
    }
    //(ここまで)


    //男女別の代謝計算用の値の判別
    if($age != $age2 || $height != $height2 || $weight != $weight2 || $gender != $gender2){
        if(empty($gender)){
            if($gender2==1){ //男
                $heightvalue=5;
                $weightvalue=13.8;
                $agevalue=6.8;
            }else{ //女
                $heightvalue=1.7;
                $weightvalue=9.6;
                $agevalue=7;
            }
        }else{
            if($gender==1){ //男
                $heightvalue=5;
                $weightvalue=13.8;
                $agevalue=6.8;
            }else{ //女
                $heightvalue=1.7;
                $weightvalue=9.6;
                $agevalue=7;
            }
        }
        if(isset($height)){
            $height2 = $height;
        }
        if(isset($weight)){
            $weight2 = $weight;
        }
        if(isset($age)){
            $age2 = $age;
        }
    //代謝計算

        $metabo=66.5+($weight2*$weightvalue)+($height2*$heightvalue)+($age2*$agevalue);

        // 代謝更新
        $sql = "UPDATE user_table SET metabolism = ?";
        $stmt = $pdo->prepare($sql); 
        $stmt->execute($metabo); 
    }
    echo $metabo;
    //データの登録
     
    header('Location:user_information.php');
?>h

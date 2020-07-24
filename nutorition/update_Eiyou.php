<?php
    //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
    require_once('config.php');

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

    if(isset($post['gender'])){
        $gender = $_POST['gender']; //性別
    }else{
        $gender = "";
    }

    $height = $_POST['height']; //身長
    $weight = $_POST['weight']; //体重

    if(isset($post['gender'])){
        $moment = $_POST['moment']; //運動強度
    }else{
        $moment = "";
    }

    $target = $_POST['target']; //目標

    //空白でなければ更新(ここから)
    if(isset($age)){        
        $sql = "UPDATE user_table SET age = $age";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }

    if(isset($gender)){
        $sql = "UPDATE user_table SET gender = $gender";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }

    if(isset($height)){
        $sql = "UPDATE user_table SET height = $height";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }

    if(isset($weight)){
        $sql = "UPDATE user_table SET weight = $weight";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }

    if(isset($moment)){
        $sql = "UPDATE user_table SET moment = $moment";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }

    if(isset($target)){
        $sql = "UPDATE user_table SET target = $target";
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }
    //(ここまで)

    //DBから引っ張ってくる
    $sql ="select * from user_table where name =?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name']);

    foreach($stmt as $row){
        $age2=$row['age'];
        $height2=$row['height'];
        $weight2=$row['weight'];
        $gender2=$row['gender'];
    }


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
        $sql = "UPDATE user_table SET metabolism = $metabo";
        $stmt = $pdo->prepare($sql); 
        $stmt->execute(); 
    }
    echo $metabo;
    //データの登録
     
    header('Location:user_information.php');
?>
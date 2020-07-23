<?php
    /**
     * 2020/07/13 川上恭輝　更新
     * ※ほんとにソースコード触らないで
     * 機能ログイン情報を保持しログインを行う。
     * 備考：login/htmlからの情報を受取る。
     * 備考：home.phpにセッションを保持したまま遷移できる
     */
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ようこそ</title>
        <link rel="stylesheet" href="login.css">
    </head>

    <body>
        <div id="main">
    <?php

        //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
        require_once('../config.php');
        
        //セッション開始
        session_start();
        $id = $_POST['login_id'];                                                   //ログイン情報をIDだけ受け取る
        //$pass = password_hash($_POST['login_pass'], PASSWORD_DEFAULT);
        //$pass = $_POST['login_pass'];
        $name = "";

        $error_code = 0;

        if(empty($id)/* || empty($pass)*/){                                         //ユーザーIDの空白を確認
            $error_code = 100;                                                      //未入力エラーへ
        } else {
            // and pass = ?
            try{
                $sql = "select * from user where user_id = ?";                      //SQL文を記載
                $stmt = $pdo->prepare($sql);                                        //SQL文をセットしデータベースに接続
                $stmt->execute([$id]);                                              //実行結果を格納する
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                //$row = $stmt->fetch(PDO::FETCH_ASSOC);
                //$result = "Hello";

                if(empty($result['user_id'])){                                      //ユーザーIDの空白チェック
                    echo $result;
                    echo "コード200処理通るよ";
                    $error_code = 200;
                } else {
                    //echo "コード0処理通るよ";
                    $name = $result['user_name'];                                   //ユーザー名をセット
                }

                if(password_verify($_POST['login_pass'], $result['pass'])){         //ハッシュ化されたパスワードと一致するかを確認
                    //session_regenerate_id(true); //session_idを新しく生成し、置き換える
                    //$_SESSION['user_id'] = $result['user_id'];
                    $error_code = 50;                                               //表示画面へ
                   
                } else {
                    echo "<br>" . $result['pass'] . "<br>";
                    //$test = password_hash($_POST['login_pass'], PASSWORD_DEFAULT);
                    //echo $test . "<br>";
                    echo $_POST['login_pass'] . "<br>";
                    echo 'エラー';
                }

                
            }catch(Exception $e){
                $error_code = 900;
            }
            $pdo = null;
        }

       

        if($error_code == 0){
            echo "エラー1";

           /* echo "<h2>ようこそ</h2>";
            echo "<hr><br>";
            echo $id."<br>";
            echo $name;
            echo "こんにちは、" .h($name). "さん！<br><br>";
            echo "<a href='login.html'>ログインページへ</a>";*/
        } else if($error_code == 50){
            //echo "<div class='ansForm'>";
            session_regenerate_id(true); //session_idを新しく生成し、置き換える
            $_SESSION['user_name'] = $result['user_name'];
            /*echo "<h2 style='text-align:center;'>ようこそ</h2>";
            echo "<hr><br>";
            echo "<p style='text-align:center;'>こんにちは、" .h($name). "さん！</p>";
            echo "<p class='p_center'><a href='home.php'>トップページ</a></p>";*/
            header('Location: home.php');
            exit();
            //echo "</div>";
        }
         else if($error_code == 100){
            echo "<h2>未入力項目があります。</h2>";
            echo "<hr><br>";
            echo "<a href='login.html'>ログインページ</a>";
        } else if($error_code == 200){
            echo "<h2>入力内容が違います</h2>";
            echo "<hr><br>";
            echo "<a href='login.html'>ログインページ</a>";   
        } else if($error_code == 900){
            echo "データベースエラーです";
            echo "<a href='login.html'>ログインページ</a>";
        }
    
    ?>

    <br><br>
    <hr>
    </div>
   </body>
</html>

<?php

    /**
     * 2020/07/13 川上恭輝　更新
     * 機能：新規登録機能
     * 備考：register.phpからのデータを受け取る
     * 注意：CSSファイルは書き替えないでください。
     */
    

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ユーザー登録</title>
        <link rel="stylesheet" href="register.css">
    </head>

    <body>
        <div id="main">
    <?php

        //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
        require_once('../config.php');

        //入力フォームから入力されたデータを受け取る
        $id = $_POST['input_id'];                                       //ユーザーID
        $name = $_POST['input_name'];                                   //ユーザー名
        $pass = password_hash($_POST['input_pass'], PASSWORD_DEFAULT);  //パスワード（受け取ってからハッシュ化する）
        //$pass = $_POST['input_pass'];

        $error_code = 0;                                                //エラーメッセージ用変数初期化

        if(empty($id) || empty($pass) || empty($name)){                 //入力フォームに空白がないかを確認
            $error_code = 100;                                          //未入力エラーへ
        } else {

            try{
                //ユーザーIDがあるかないかを検索する
                $sql = "select * from user where user_id = ?";          //SQL文
                $stmt = $pdo->prepare($sql);                            //SQL文のセットとデータベースへ接続
                $stmt->execute([$id]);                                  //フォーム情報をSQL文にセットし実行
                $result = $stmt->fetch();                               //実行結果を変数に保存

                //ユーザーIDがデータベース上になかったら
                if(empty($result['user_id'])){                  
                    $sql = "insert into user(user_id, user_name, pass) values(?, ?, ?)";   //valuesで値を受け取る。カラムに値を格納できるようにする 
                    $stmt = $pdo->prepare($sql);                         //SQL文をセットしてデータベースに接続
                    $stmt->execute([$id, $name, $pass]);                 //入力フォームの情報を使用しSQL文を実行する
                }else {
                    $error_code = 200;                                   //既にユーザーIDがあった場合
                }
            }catch(Exception $e){
                $error_code = 900;                                       //データベースに接続できなかった場合
            }
            $pdo = null;                                                 //データベース情報を削除
       }

        if($error_code == 0){
            //echo "<div class='ansForm'>";
            echo "<h2 style='text-align:center;'>ユーザー登録が完了しました。</h2>";
            echo "<hr><br>";
            echo "<table class='centerForm'>";
            echo "<tr><th>ユーザーID</th><td>". h($id). "</td></tr>";           //h()で表示させること。ファンクションはconfig.phpにある
            echo "<tr><th>ユーザー名</th><td>". h($name). "</td></tr>";
            echo "</table>";
            echo "<p class='p_center'><a class='button' href='login.html'>ログインページ</a></p>";
            //echo "</div>";
        } else if($error_code == 100){
            echo "<h2>未入力項目があります。</h2>";
            echo "<hr><br>";
            echo "<a href='register.html'>新規ユーザー登録</a>";
        } else if($error_code == 200){
            echo "<h2>ユーザーIDは登録済みです</h2>";
            echo "<hr><br>";
            echo "<a href='register.html'>新規ユーザー登録</a>";
        } else if($error_code == 900){
            echo "<h2>データベースエラー</h2>";
            echo "<hr><br>";
            echo "<a href='login/html'>ログインページ</a>";
        }
    ?>
    <br><br>
    </div>
    </body>
</html>

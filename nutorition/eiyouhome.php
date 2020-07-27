<!--
********************************************
*This is update code
*Name: Kazuya Miyagawa
*CreateDate: 2020/07/10 11:40:00
*Version: 1.00
*Update: 2020/07/20
*What to do:　データベース上にログインしたユーザーの情報があるかを確認し、
あればカレンダー画面へ送り、なければ登録画面に飛ばす
*******************************************
-->

<?php
    //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
    require_once('../config.php');

    //セッションスタート
    session_start();
    //セッションの保持
    //$id=$_SESSION['user_id'];
    $name=$_SESSION['user_name'];
    //ログイン済みの場合
   /* if (isset($_SESSION['user_name'])) {
        echo 'ようこそ' .  h($_SESSION['user_name']) . "さん<br>";
        echo "<a href='logout.php'>ログアウトはこちら。<br></a>";
    } else {
        echo 'ようこそ ゲストさん　ログインしてください';
        echo "<a href='login.html'>ログインページへ</a>";
    }*/

    //ユーザーIDがあるかないかを検索する
    $sql = "select * from user_table where name = ?";          //SQL文
    $stmt = $pdo->prepare($sql);                            //SQL文のセットとデータベースへ接続
    $stmt->execute([$name]);                                  //フォーム情報をSQL文にセットし実行
    $result = $stmt->fetch();                               //実行結果を変数に保存

    //ユーザーIDの空白チェック
    if(empty($result['id'])){ 
        //登録画面に移動
        header('Location:EiyouLogin.html');
    } else {
        //カレンダー画面に移動
        header('Location:calendar.php');
        //echo "<a href='index.php'>ホームページ<br></a>";
    }
?>

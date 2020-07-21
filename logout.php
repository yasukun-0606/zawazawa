<?php
    /**
     * 2020/07/13 川上恭輝　新規作成
     * 機能：ログアウト機能
     * 備考：ログアウトの際、セッション情報を全て消している
     * 注意：CSSファイルは書き替えないでください。
     */

     //セッションスタート
    session_start();

    //セッションの存在を確認
    if(isset($_SESSION['user_name'])){
        //echo 'ログアウトしました。';
        header('Location: home.php');
        //echo "<p><a href='home.php'>トップページ</a></p>";
    } else {
        echo 'Sessionがタイムアウトしました。';
    }

    //セッション変数をすべて削除
    $_SESSION = array();
        if(isset($_COOKIE["PHPSESSID"])){
            setcookie("PHPSESSID", '', time() - 1800, '/');
        }
    
    //セッションの登録情報を削除
    session_destroy();
?>

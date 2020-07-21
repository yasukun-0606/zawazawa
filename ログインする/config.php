<?php
    /**
     * 2020/07/13 川上恭輝 更新
     * 機能：データベースへの接続とエスケープ処理
     * ホスト名：localhost
     * DB名：zawazawadb
     * ユーザー名：root
     * パスワード：なし
     */


    //PDOオブジェクトの作成
    $dsn = 'mysql:host=localhost;dbname=zawazawadb;charset=utf8';  
    $user = 'root';
    $password = '';
    $pdo = new PDO($dsn, $user, $password);

    //とりあえず書いとけPHP側で文字を表示させる際に使用する事
    //エスケープ処理
    function h($data){
        return htmlspecialchars($data, ENT_QUOTES, "UTF-8");
    }
?>
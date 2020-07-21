<?php
    /**
     * 2020/07/20 川上恭輝　更新
     * 機能：セッション情報があればユーザー名でトップページを開く
     * 機能：セッション情報がなければゲストさんで表示しログインページへ
     * 機能：登録済みの音楽ファイルを再生できるようになった
     * 注意：CSSファイルは書き替えないでください。
     * ****************************************************************
     * 備考：各画面先へのセッション情報の保持は各グループで行ってください。
     * 備考：現在セッション保持されている情報はusernameだけです
     * 備考：homeのファイル場所はこのままで使用するので、変えずに保存してください。
     * ****************************************************************
     */

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>トップページ</title>
        <link rel="stylesheet" href="home.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes">
        <script src="JS/audio.min.js"></script> <!--オーディオ用JSファイル-->
        <script src="JS/music.js"></script>     <!--音楽コントロール用JSファイル-->
    </head>

    <body>
    <header>
    <h1 class="title">体調・栄養管理アプリ</h1>
    </header>
    <div class="menu">
    <?php
    //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
    require_once __DIR__ .'/config.php';

    //セッションスタート
    session_start();
    //ログイン済みの場合
    if (isset($_SESSION['user_name'])) {
        echo '<p>ようこそ' .  h($_SESSION['user_name']) . "さん</p><br>";
        echo "<a href='logout.php' class='log'>ログアウト</a>";
        echo "<br><br>";
        echo "<br><a href='test.html' class='button'>栄養管理</a>";
        echo "<br><br><br><br>";
        echo "<a href='#' class='sub_button'>体調管理</a>";
        echo "<br><br>";
        echo "<p>流す曲を選択してください。</p>";
        echo "<select id='music_name'>";                        //曲の選択（リストボックス）
        echo "<option value='BH'>Burning Heart</option>";
        echo "<option value='moon'>月と狼</option>";
        echo "<option value='star'>シャイニングスター</option>";
        echo "<option value='you'>where you are</option>";
        echo "</select>";
        echo "<br><br>";
        echo "<input class='music_button' type='button' value='スタート' onclick='music_start()'>"; //音楽再生ファンクション実行
        echo "<input class='music_button' type='button' value='ストップ' onclick='stop()'>";        //音楽停止ファンクション実行
        echo "<input class='music_button' type='button' value='ループ' onclick='loop()'>";          //ループ再生ファンクション実行
    } else {
        //ログインしてなかった場合
        echo 'ようこそ ゲストさん<br>ログインしてください';
        echo "<br><br>";
        echo "<br><a class='log' href='login.html'>ログイン</a>";
        echo "<br><br><br><br>";
        echo "<br><a class='log' href='How_To_Use.html'>このアプリの使い方</a>";
    }

    ?>
    </div>


</body>
</html>
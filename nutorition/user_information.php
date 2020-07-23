<!--
********************************************
*This is Login display
*Name: Katsuaki Matsushima
*CreateDate: 2020/07/10 11:40:00
*Version: 1.00
*Update: 2020/07/20
*******************************************
-->

<!DOCTYPE html>
<html>
<head>
    <!--<meta charset="UTF-8">-->
    <title>ユーザー情報画面</title>
    <link rel="stylesheet" href = "user_information.css">

</head>

<header>
      <h1 class="head">ユーザー情報</h1>            <!--ヘッダー指定-->
</header>

<body background ="back.png">       <!--背景の画像設定-->
    <br>
    <div class="user_t1">           <!--ユーザー情報の表示くくり-->
        <p class="user_title">現在のユーザー情報</p>        <!--タイトル-->
        <p>名前：

        </p>
        <p>年齢：

        </p>
        <p>身長：

        </p>
        <p>体重：

        </p>
        <p>性別：

        </p>
        <p>普段の運動強度：

        </p>
        <p>目標：
        </p>
    </div>


    <!--今日の日付(PHP)-->
    <?php
    session_start();
    
    $_month=$_SESSION['Month'];
    $_day=$_SESSION['Day'];

    echo "<div class='text'>＿人人人人人＿<br>";    //取得した日付を表示
    echo "＞&nbsp;日付&emsp;＜<br>";
    
    //echo "$_month<br>";
    //echo "$_day<br>";

    //$month = $_POST["month"];       //カレンダーで取得した月を取得
    echo "＞&nbsp;&nbsp;";          //空白挿入
    echo "$_month";                  //月を表示
    echo "月";                      //「月」を表示
    //$day = $_POST["day"];           //カレンダーで取得した日を取得
    echo "$_day";                    //日を表示
    echo "日&nbsp;＜<br>";          //「日」を表示
    echo "￣Y^Y^Y^Y^￣<br></div>";    //下側を表示
    ?>
    <br>
    <br>

    <!--行先ボタン-->
        <div>
            <button class="margin1" type="submit" onclick="location.href='http://localhost/zawazawa/Login.HTML'" > <?php echo "$_month 月$_day 日";?>の結果    <!--結果画面に遷移-->
            <button class="margin1">カロリー入力　　<!--カロリー入力画面に遷移-->
            <button class="margin1">今日の運動情報　<!--今日の運動情報に遷移-->
        </div>
        <br>
        <br>
        <div>
            
            <button class="margin1" type="submit" onclick="location.href='http://localhost/zawazawa/update.php'" >登録画面更新　<!--登録更新画面へ遷移-->
        </div>

</body>
</html>
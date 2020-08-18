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
    <a href="../login/home.php"><img class="roll float" src="../login/img/まちおさん3.jpg" alt="サンプル画像" width=100px height=48px></a>
    <h1 class="head">ユーザー情報</h1>            <!--ヘッダー指定-->
</header>

<body background ="back.png">       <!--背景の画像設定-->
    <br>
    <div class="user_t1">           <!--ユーザー情報の表示くくり-->
        <p class="user_title">現在のユーザー情報</p>        <!--タイトル-->
        <p>
        <?php
        require_once('../config.php');
        session_start();

        $name=$_SESSION['user_name'];

        $sql="select * from user_table where name = ?";
        $stmt = $pdo->prepare($sql);                            //SQL文のセットとデータベースへ接続
        $stmt->execute([$name]);   //フォーム情報をSQL文にセットし実行
        //$result = $stmt->fetch();
        
        foreach($stmt as $row){
            $name2=$row['name'];
            $age=$row['age'];
            $height=$row['height'];
            $weight=$row['weight'];
            $gender=$row['gender'];
            $movement=$row['movement'];
            $target=$row['target'];
        }
         
        echo"名前：$name2<br>"; 

        echo "年齢：$age 才<br>";

        echo "身長：$height cm<br>";
        
        echo "体重：$weight kg<br>";

        if($gender==1){
        echo "性別：男<br>";
        }else{
        echo "性別：女<br>";
        }
            
        echo "普段の運動強度：$movement<br>";

        echo "目標：$target<br><br>";
        ?>

        </p>
        </p>
        <div class="information">日常生活の運動強度についての説明<br>
        &emsp;1.生活の大部分が座っている(例：デスクワークが多い人)<br>
        &emsp;2.座位中心だが移動することが多い。あるいは軽いスポーツ等を<br>
        &emsp;&emsp;している人(例：営業等で移動が多い人)<br>
        &emsp;3.移動や肉体労働が多い人(例：工事現場で作業している人)<br>
        </div>
    </div>


    <!--今日の日付(PHP)-->
    <?php
    
    
    

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
            <button class="margin1" type="submit" onclick="location.href='./results.php'" > <?php echo "$_month 月$_day 日";?>の結果    <!--結果画面に遷移-->
            <button class="margin1" type="submit" onclick="location.href='./registnutrition.php'">カロリー入力　　<!--カロリー入力画面に遷移-->
            <button class="margin1" type="submit" onclick="location.href='./registexercise.php'">今日の運動情報　<!--今日の運動情報に遷移-->
        </div>
        <br>
        <br>
        <div>
            <button class="margin1" type="submit" onclick="location.href='./update.php'" >登録画面更新　<!--登録更新画面へ遷移-->
            <button class="margin1" type="submit" onclick="location.href='./calendar.php'">カレンダーに戻る<!--カレンダー画面へ戻る-->
        </div>
        <br>
        <br>
        <div>
            <!--<button class="margin1" type="submit" onclick="location.href='../login/home.php'" >ホームへ--><!--ホーム画面へ遷移-->
        </div>


</body>
</html>

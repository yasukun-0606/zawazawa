<?php
  /**
    * 2020/07/16 坂井香月 更新
    * 機能：登録内容の角煮
  */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>体調管理</title>
</head>
<header>
  <link rel="stylesheet" href="check.css">
  <a href="../login/home.php"><img class="roll float" src="../login/img/まちおさん3.jpg" alt="サンプル画像" width=100px height=48px></a>
  <h1 class="title">確認画面</h1>
</header>
<body>
<div class="container">
<span class="target" >
<?php
    session_start();
    $name = $_SESSION['user_name'];
    $date = '';

    $input_day = '';                                              //日の初期化
    $input_month = $_POST['month'];                               //月の値を受け取る
    $input_year = $_POST['year'];                                 //年の値を受け取る
    if(!empty($_POST['day'])){
      $input_day = $_POST['day'];                                   //日の値を受け取る
    }
    $input_date = $input_year . '-' . $input_month . '-' . $input_day;      //受け取った月日を合わせる
    $date = date('Y-m-d',strtotime($input_date));                 //date型に変換
    $temp = $_POST['temp_n'];                                     //体温を受け取る

    //未入力箇所がある場合
    if($date == '' || $temp == '') 
    {
        echo '<form method="post" action="register.php">';
        echo '<p><font size="5"> 未入力箇所があります</font></p>';
        echo '<br>';
        echo '<input style="width:100px " type="button" value="戻る" onClick="history.back()">';
    } else 
    //未入力箇所がない場合
    {
        echo '<form method="post" action="submit.php">';          //登録画面へのフォーム
        echo '<font size="10">'. $name . 'さん</p>';
        echo '<p> <font size="10"> こちらの内容でよろしいですか？ <br /> <br /> </font> </p>';
        echo '<div style="display:inline-block; padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">';
        echo '<input type="hidden" name="date_n" value="' . $date . '">';
        echo '<input type="hidden" name="temp_n" value="' . $temp . '">';
        echo '<p>' . '<font size="6">' . '日付　'  .$date. '</font>' . '</p>';                          //入力された日付の表示
        echo '<p>' . '<font size="6">' . '体温&nbsp&nbsp　' .$temp. '℃　　' . '</font>' . '</p>';      //入力された体温の表示
        echo '</div>';
        //登録画面へ
        echo '　　　　　　　　　　<input type="submit" value="登録" background-color:"red" ; style="font-size:30px;　width:300px; height:80px">　';
        echo '<input type="button" value="修正" onClick="history.back()" style="font-size:30px;　width:300px; height:80px">';
        echo '</form>';
    }
?>
  </span>
  </div>
  <!-- 中央揃えにする -->
  <style>
  body{
  background-color:#F0E7B3;
}
  .container{
    display:table;
    width:100%;
    height:500px;
    text-align:center;
  }
  .container .target{
    display:table-cell;
    vertical-align:middle;
  }
  </style>
</body>
</html>

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
<body bgcolor="skyblue">
<div class="container">
<span class="target" >
<?php

    $date = '';

    //データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
    require_once __DIR__ .'/config.php';

    $input_month = $_POST['month'];
    $input_day = $_POST['day'];
    $input_date = '2020-' . $input_month . '-' . $input_day;
    $date = date('Y-m-d',strtotime($input_date));
    $temp = $_POST['temp_n'];

    //未入力箇所がある場合
    if($date == '' || $temp == '') 
    {
        echo '<form method="post" action="register.php">';
        echo '<p> 未入力</p>';
        echo '<input type="button" value="戻る" onClick="history.back()">';
    } else //未入力箇所がない場合
    {
        echo '<form method="post" action="submit.php">';
        echo '<p> <font size="10"> こちらの内容でよろしいですか？ <br /> <br /> </font> </p>';
        echo '<div style="display:inline-block; padding: 10px; margin-bottom: 10px; border: 1px solid #333333;">';
        echo '<input type="hidden" name="date_n" value="' . $date . '">';
        echo '<input type="hidden" name="temp_n" value="' . $temp . '">';
        echo '<p>' . '<font size="6">' . '日付　'  .$date. '</font>' . '</p>';                          //入力された日付の表示
        echo '<p>' . '<font size="6">' . '体温&nbsp&nbsp　' .$temp. '℃　　' . '</font>' . '</p>';      //入力された体温の表示
        echo '</div>';
        echo '　　　　　　　　　　<input type="submit" value="登録" background-color:"red" ; style="font-size:30px;　width:300px; height:80px">　';
        echo '<input type="button" value="修正" onClick="history.back()" style="font-size:30px;　width:300px; height:80px">';
        echo '</form>';
    }
?>
  </span>
  </div>
  <!-- 中央揃えにする -->
  <style>
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
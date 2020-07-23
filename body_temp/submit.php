<?php
  /**
    * 2020/07/16 坂井香月 更新
    * 機能：日付と体温をDBに登録
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
<font size="7">登録完了しました。</font><br><br><br><br><br>
<input type="button" value="戻る" style="font:20pt MS ゴシック; width:8%; height:12%" onClick="location.href='./select.php'">

<?php

//データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
require_once __DIR__ .'/config.php';

    $date = $_POST['date_n'];     //日付
    $temp = $_POST['temp_n'];     //体温

    //echo '<p style="position: absolute; right: 0px; top: 0px">' . '<font size="5">' .$date. '</font>' .'</p>';
    $sqls = "select * from body_temp where date = $date";
    $stmts = $pdo->prepare($sqls);
    $result = $stmts->fetch(PDO::FETCH_ASSOC);
    if(empty($result['date'])){
      try {
        //echo 'fkaifubaijhif';
        $sqld = "DELETE FROM body_temp WHERE date = :date";
        $stmts = $pdo->prepare($sqld);
        $stmts->bindValue(':date', $date);
        $stmts->execute();
      } catch (Exception $e) {
        echo $e->getMessage();
        die();
      }
    }

    $sql = "insert into body_temp(date, temp) values(?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$date, $temp]);         //DBに登録

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
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
<header>
      <link rel="stylesheet" href="Booom.css">
      <a href="../login/home.php"><img class="roll float" src="../login/img/まちおさん3.jpg" alt="サンプル画像" width=100px height=48px></a>
      <h1 class="title">登録完了画面</h1>
</header>
<body>
<div class="container">
<span class="target" >
<font size="7">登録完了しました。</font><br><br><br><br><br>
<input type="button" value="戻る" style="font:20pt MS ゴシック; width:8%; height:12%" onClick="location.href='./select.php'">

<?php
session_start();

//データベース接続情報ファイル（ログイン用）※ログインフォルダから動かさないでください。
require_once('../config.php');
    //$_SESSION['user_name'] = 'いんぐ';
    $name = $_SESSION['user_name'];
    $date = $_POST['date_n'];     //日付
    $day = $_POST['day'];     //日
    $month = $_POST['month'];     //月
    $year = $_POST['year'];     //年
    $time = $_POST['time'];   //時間帯
    $temp = $_POST['temp_n'];     //体温

    $sqls = "select * from body_temp where date = ?";
    $stmts = $pdo->prepare($sqls);
    $stmts->execute([$date]);
    $result = $stmts->fetch(PDO::FETCH_ASSOC);
    if(empty($result['date'])){
      //Nothing
    }else{
      try{
        $sqld = "delete from body_temp where date = :date and time = :time";
        $stmts = $pdo->prepare($sqld);
        $stmts->bindvalue(':date',$date);
        $stmts->bindvalue(':time',$time);
        $stmts->execute();
      }catch(Exception $e){
        echo $e->getMessege();
        die();
      }
    }
    
    $sql = "insert into body_temp(user_name, date, year, month, day, time, temp) values(?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $date, $year, $month, $day, $time, $temp]);                             //DBに登録

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

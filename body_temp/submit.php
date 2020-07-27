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
  <h1 class="title" align="center">登録完了画面</h1>
</header>
<body bgcolor="skyblue">
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
    $temp = $_POST['temp_n'];     //体温

    //echo '<p style="position: absolute; right: 0px; top: 0px">' . '<font size="5">' .$date. '</font>' .'</p>';
    $sqls = "select * from body_temp where date = ?";           //SQL文を記載
    $stmts = $pdo->prepare($sqls);                              //SQL文をセットしデータベースに接続
    $stmts->execute([$date]);                                   //実行結果を格納する    
    $result = $stmts->fetch(PDO::FETCH_ASSOC);
    if(empty($result['date'])){                                 //DBに指定した体温があるかチェック
        //echo 'kjdghaafebj';
    } else {
      try {
        $sqld = "DELETE FROM body_temp WHERE date = :date";     //前のデータを削除
        $stmts = $pdo->prepare($sqld);
        $stmts->bindValue(':date', $date);
        $stmts->execute();
      } catch (Exception $e) {
        echo $e->getMessage();
        die();
      }
    }

    $sql = "insert into body_temp(user_name, date, temp) values(?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $date, $temp]);                              //DBに登録

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

<?php
  /**
    * 2020/07/17 坂井香月 更新
    * 機能：登録か記録一覧の選択
  */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>体調管理</title>
</head>
<header >
    <link rel="stylesheet" href = "select.css">
    <h1 class="title">体調管理</h1>
</header>
<body>
<div class="container">
<span class="target" >
<br><br><br><br><br>
<button type="button" size="5" onclick="location.href='./register.php'" style="font:15pt MS ゴシック; width:10%; height:10%">登録</button>    <!-- 登録ボタン -->
<button type="button" size="5" onclick="location.href='./templist.php'" style="font:15pt MS ゴシック; width:10%; height:10%">記録一覧</button>  <!-- 記録一覧ボタン -->
<br><br><br><br>
<!--ホーム画面へ-->
<button type="button" size="5" onclick="location.href='../login/home.php'" style="font:13pt MS ゴシック; width:10%; height:10%">ホーム画面へ</button>  
<img src="temp.png" style="position: absolute; left: 130px; top: 208px;" width="20%" height="40%">
<img src="temp.png" style="position: absolute; left: 950px; top: 208px;" width="20%" height="40%">  
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

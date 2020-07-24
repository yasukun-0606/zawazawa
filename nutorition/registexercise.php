<!DOCTYPE html>
<?php
include 'config.php';
?>
<html lang="ja">
<head>
<h1 class="title">消費カロリー登録画面</h1>
<meta charset="UTF-8">
  <title>運動データ登録</title>
<script src="EX_pushdata.js"></script>
<link href="http://localhost/test/styleform.css" rel="stylesheet">
<link href="http://localhost/test/inputmaterial.css" rel="stylesheet">
<link href="http://localhost/test/inputmenu.css" rel="stylesheet">
<link href="http://localhost/test/inputother.css" rel="stylesheet">
<link href="http://localhost/test/inputexercise.css" rel="stylesheet">
<link href="http://localhost/test/registdata.css" rel="stylesheet">
<link href="http://localhost/test/jumpsite.css" rel="stylesheet">
</head>

<body>

  </div>
</body>
                                   
<div style="float:left;" class="inputformat">
<br>

<label for="name" class="MA_biglabel">  トレーニング内容  </label> 
<p><label for="name" class="MA_selectnamelabel">内容選択</label> </p>
<!-- 食品名のプルダウン作成 -->
<?php
// DB接続しSQLを発行してデータを取得
$sql= "select * from exercise";
$stmt = $pdo -> prepare($sql);
$stmt->execute();

//プルダウン作成
echo "<select id='EX_name' name='EX_Name' class='MA_selectnamebox'>";
while( $res = $stmt->fetch(PDO::FETCH_ASSOC) ){  // 実行結果から1レコード取ってくる
  	   $names = $res['exercise'];
  	   $kcal =  $res['calories'];
echo "<option value='$names'>$names</option>";
}	
echo "</select>"; 
?>
</p>

<p><label for="name"class="MA_numlabel">時間</label>
<label for="name"class="MA_attention">(※分単位の入力をお願いします)</label>
<input type="text" id="EX_num" name="EX_Num"placeholder="分"class="MA_numbox">
</p>
<input type="button" class="EX_registbutton"  name="add" value="決定!" onclick="EX_clickgo()"><br>
</div>
<?php
//決定を押したときに、リザルトで表示するDBへのデータ挿入
if(isset($_POST['add'])) {//決定が押された時！
	echo "<script>alert('テスト');</script>"; 
	echo $checkradio=3;//id
	echo $checkname=$_POST['EX_Name'];//名前
	echo $checknum=$_POST['EX_Num'];//個数
	$sql="select calories from exercise where exercise = :names ";
	$stmt = $pdo -> prepare($sql);
	$stmt->bindParam(':names', $checkname, PDO::PARAM_STR,30);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$resultkcal=$checkname*$checknum;//総カロリー


		if(!empty($checkname) && !empty($checknum)){
		//空白データのチェック
			$sql="INSERT INTO results(names,num,kcal) VALUE(?,?,?)";//　結合時ユーザーIDと日付データも挿入すること正しいカラム名に変更すること
			$stmt = $pdo -> prepare($sql);
			$stmt->execute($checkname,$checknum,$resultkcal);//本来もう少し増える
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		}
	 
		
}	


  ?>

<div style="float:left;"class="displayformat">
<input type="text" id="registfield" name="regist" class="registbox" placeholder="登録情報">
<form action="registnutrition.php" method="post">
<input type="submit" class="jumpnutrition"  name="add" value="栄養データ登録へ" ><br>
</form>
<form action="results.php" method="post">
<input type="submit" class="jumpresult"  name="add" value="結果表示へ" ><br>
</form>


</html>
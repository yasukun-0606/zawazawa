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
<!-- <link href="http://localhost/test/styleform.css" rel="stylesheet">
<link href="http://localhost/test/inputmaterial.css" rel="stylesheet">
<link href="http://localhost/test/inputmenu.css" rel="stylesheet">
<link href="http://localhost/test/inputother.css" rel="stylesheet">
<link href="http://localhost/test/inputexercise.css" rel="stylesheet">
<link href="http://localhost/test/registdata.css" rel="stylesheet">
<link href="http://localhost/test/jumpsite.css" rel="stylesheet"> -->
<link href="http://localhost/zawazawadb/styleform.css" rel="stylesheet">
<link href="http://localhost/zawazawadb/inputmaterial.css" rel="stylesheet">
<link href="http://localhost/zawazawadb/inputmenu.css" rel="stylesheet">
<link href="http://localhost/zawazawadb/inputother.css" rel="stylesheet">
<link href="http://localhost/zawazawadb/inputexercise.css" rel="stylesheet">
<link href="http://localhost/zawazawadb/registdata.css" rel="stylesheet">
<link href="http://localhost/zawazawadb/jumpsite.css" rel="stylesheet">
</head>

<body>

  </div>
</body>
                                   
<div style="float:left;" class="inputformat">
<br>

<label for="name" class="MA_biglabel">  トレーニング内容  </label> 
<p><label for="name" class="MA_selectnamelabel">内容選択</label> </p>
<!-- 運動のプルダウン作成 -->
<?php
// DB接続しSQLを発行してデータを取得
$sql= "select * from exercise";
$stmt = $pdo -> prepare($sql);
$stmt->execute(); 

//プルダウン作成+
echo "<form action='registexercise.php' method='post'>";
echo "<select id='EX_name' name='EX_Name' class='EX_selectnamebox'>";
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  // 実行結果から1レコード取ってくる
  	$names=$res['exercise'];
  	$kcal=$res['calories'];
  	echo "<option value='$names'>$names</option>";
}	
  echo "</select>"; 
  echo "<input type='text' id='EX_num' name='EX_Num'placeholder='個'class='EX_numbox'>";
  echo "<button class='EX_registbutton'type='submit' name='EX_add' value='ボタン' onclick='EX_clickgo()'>決定</button>";
  echo "</form>";
?>
</p>

<p><label for="name"class="MA_numlabel">時間</label>
<label for="name"class="MA_attention">(※分単位の入力をお願いします)</label>
</p>
<?php
//決定を押したときに、リザルトで表示するDBへのデータ挿入
if(isset($_POST['EX_add'])) {//決定が押された時！
	$checkname=$_POST['EX_Name'];//名前
	$checknum=$_POST['EX_Num'];//個数
	if(!empty($_POST['EX_Name']) && !empty($_POST['EX_Num'])){//空白チェック
		
		$sql="select calories from exercise where exercise = ? ";
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$checkname]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);//1分毎のカロリー抽出
		$resultkcal=$result['calories']*$checknum;//総カロリー
		//ここで重複チェック
		$repeat=false;	
		$sql="SELECT * FROM momentreg_table WHERE UserID = 'abc' AND Date = '2020-07-01' AND Method = ? limit 1";//UserIDとDateはセッションから持ってくる
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$checkname]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($result > 0){
			$repeat=true;	
		}
		if($repeat==false){
			$sql="INSERT INTO momentreg_table(UserID,Date,Method,Calorie,WorkTime) VALUE('abc','2020-07-01',?,?,?)";//　結合時ユーザーIDと日付データも挿入すること正しいカラム名に変更すること
			$stmt = $pdo -> prepare($sql);
			$stmt->execute([$checkname,$resultkcal,$checknum]); 
		}
	}
	else{
		//空白があるなら何も行わない
	}
	
}
?>

<?php 
//ひとつもどるを押したときに、リザルトで表示するDBへのデータ挿入
if(isset($_POST['back'])) {//modoruが押された時！
	if(empty($_POST['back'])){	 
	}
	else{
		$day='2020-07-01';//本来はユーザーIDと日付をもらう
		$sql="DELETE FROM momentreg_table ORDER BY Number DESC LIMIT 1";//　結合時ユーザーIDと日付データも挿入すること正しいカラム名に変更すること
		$stmt = $pdo -> prepare($sql);
		$stmt->execute();
	}
}
?>



<?php
			echo "<div style='float:left;'class='displayexerciseformat'>";
			$sql="select * from momentreg_table where UserID = 'abc' and Date = '2020-07-01'";
			$stmt = $pdo -> prepare($sql);
			$stmt->execute();
	
		while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
			echo $name=$res['Method'];
			echo "×";
			echo $num=$res['WorkTime'];
			echo "分＝";
			echo $kcal=$res['Calorie'];
			echo "kcal<br/>";
		 }
	echo "<form action='registexercise.php' method='post'>";
	echo "<input type='submit' class='backbutton' name='back' value='データを1つ取り消す' onclick='clickback()'><br>";
	echo "</form>";
	echo "<form action='registnutrition.php' method='post'>";
	echo "<input type='submit' class='jumpnutrition' name='button' value='栄養データ登録へ' ><br>";
	echo "</form>";
	echo "<form action='results.php' method='post'>";
	echo "<input type='submit' class='jumpresult' name='button' value='結果表示へ' ><br>";
	echo "</form>";
	echo "</div>";	
	
?>
</html>
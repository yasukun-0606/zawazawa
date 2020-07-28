<!DOCTYPE html>
<?php
require_once('../config.php');
session_start();
 $_month=$_SESSION['Month'];
 $_date=$_SESSION['Day'];
 $_name=$_SESSION['user_name'];
 $_year=$_SESSION['Year'];
 $sql="select * from user where user_name=?";//user_idの取得
 $stmt=$pdo->prepare($sql);
 $stmt->execute([$_name]);
 $res=$stmt->fetch(PDO::FETCH_ASSOC);
 $_id=$res['user_id'];

 if(strlen($_month)==1){//月を2桁表示にする
	$_month='0'.$_month;
 }	
 if(strlen($_date)==1){//日を2桁表示にする
	$_date='0'.$_date;
 }
 $ymd=$_year.'-'.$_month.'-'.$_date //date型をつくるための文字列

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
<link href="http://localhost/zawazawa/nutorition/styleform.css" rel="stylesheet">
<link href="http://localhost/zawazawa/nutorition/inputmaterial.css" rel="stylesheet">
<link href="http://localhost/zawazawa/nutorition/inputmenu.css" rel="stylesheet">
<link href="http://localhost/zawazawa/nutorition/inputother.css" rel="stylesheet">
<link href="http://localhost/zawazawa/nutorition/inputexercise.css" rel="stylesheet">
<link href="http://localhost/zawazawa/nutorition/registdata.css" rel="stylesheet">
<link href="http://localhost/zawazawa/nutorition/jumpsite.css" rel="stylesheet">
</head>

<body>

  </div>
</body>
                                   
<div style="float:left;" class="inputformatexe">
<br>

<label for="name" class="MA_biglabel">  トレーニング内容  </label> 
<p><label for="name" class="MA_selectnamelabel">内容選択</label> </p>
<!-- 運動のプルダウン作成 -->
<?php
// DB接続しSQLを発行してデータを取得
$sql= "select * from exercise";//データベースの情報取得
$stmt = $pdo -> prepare($sql);
$stmt->execute(); 

//プルダウン作成
echo "<form action='registexercise.php' method='post'>";
echo "<select id='EX_name' name='EX_Name' class='EX_selectnamebox'>";
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  // 実行結果から1レコード取ってくる
  	$names=$res['exercise'];//運動名取得
  	$kcal=$res['calories'];//カロリー取得
  	echo "<option value='$names'>$names</option>";
}	
  echo "</select>"; 
  echo "<input type='text' id='EX_num' name='EX_Num'placeholder='分'class='EX_numbox'>";
  echo "<button class='EX_registbutton'type='submit' name='EX_add' value='ボタン' onclick='EX_clickgo()'>決定</button>";
  echo "</form>";
?>
</p>

<p><label for="name"class="MA_numlabel">時間</label>
<label for="name"class="MA_attention">(※分単位の入力をお願いします)</label>
</p>
<?php

/**決定を押したときに、リザルトで表示するDBへのデータ挿入**/

if(isset($_POST['EX_add'])) {//決定が押された時！
	$checkname=$_POST['EX_Name'];//名前
	$checknum=$_POST['EX_Num'];//個数
	if(!empty($_POST['EX_Name']) && !empty($_POST['EX_Num'])){//空白チェック
		
		$sql="select calories from exercise where exercise = ? ";//選択したトレーニングに対するカロリー取得
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$checkname]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);//1分毎のカロリー抽出
		$resultkcal=$result['calories']*$checknum;//総カロリー
		//ここで重複チェック
		$repeat=false;	
		$sql="SELECT * FROM momentreg_table WHERE UserID = ? AND Date = ? AND Method = ? limit 1";//重複チェック
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$_id,$ymd,$checkname]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($result > 0){//重複があればフラグを建てる
			$repeat=true;	
		}
		if($repeat==false){//重複がなければ
			$sql="INSERT INTO momentreg_table(UserID,Date,Method,Calorie,WorkTime) VALUE(?,?,?,?,?)";//　結合時ユーザーIDと日付データも挿入すること正しいカラム名に変更すること
			$stmt = $pdo -> prepare($sql);
			$stmt->execute([$_id,$ymd,$checkname,$resultkcal,$checknum]); 
		}
	}
	else{
		//空白があるなら何も行わない
	}
	
}
?>

<?php

/**ひとつもどるを押したときに、最新データをひとつ消す**/

if(isset($_POST['back'])) {//ひとつ戻るが押された時！
	if(empty($_POST['back'])){	 
	}
	else{
		$sql="DELETE FROM momentreg_table where UserID = ? AND Date = ? ORDER BY Number DESC LIMIT 1";//　降順に並び替えて一番上のデータつまり最新データをひとつ削除する
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$_id,$ymd]);
	}
}
?>



<?php
			echo "<div style='float:left;'class='displayexerciseformat'>";
			$sql="select * from momentreg_table where UserID = ? and Date = ?";
			$stmt = $pdo -> prepare($sql);
			$stmt->execute([$_id,$ymd]);
	
			/** 運動方法×分=消費カロリー　という形式で表示**/
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
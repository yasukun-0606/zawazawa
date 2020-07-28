<?php
require_once('../config.php');
session_start();
 $_month=$_SESSION['Month'];
 $_date=$_SESSION['Day'];
 $_name=$_SESSION['user_name'];//
 $_year=$_SESSION['Year'];
 ?>
<?php
	if(strlen($_month)==1){//月を2桁表示
		$_month='0'.$_month;
	}
	if(strlen($_date)==1){//日を2桁表示
		$_date='0'.$_date;
	}
	$ymd=$_year.'-'.$_month.'-'.$_date //date型をつくるための文字列
?>

<!DOCTYPE html>
<?php
 $sql="select * from user where user_name=?";
 $stmt=$pdo->prepare($sql);
 $stmt->execute([$_name]);
 $res=$stmt->fetch(PDO::FETCH_ASSOC);
 $_id=$res['user_id'];
?>
<html lang="ja">
<head>
<h1 class="title">摂取カロリー登録画面</h1>
<meta charset="UTF-8">
<script src="MA_pushdata.js"></script> 

<!-- <link href="http://localhost/test/styleform.css" rel="stylesheet">
<link href="http://localhost/test/inputmaterial.css" rel="stylesheet">
<link href="http://localhost/test/inputmenu.css" rel="stylesheet">
<link href="http://localhost/test/inputother.css" rel="stylesheet">
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
</body>

<?php
//新規登録処理
	if(isset($_POST['dataregist'])) {//新規登録のボタンが押された時
		 $checkradio=$_POST['OT_radio'];//ラジオボタンで登録場所の選択
		 $checkname=$_POST['OT_name'];//登録名取得
		 $checkkcal=$_POST['OT_kcal'];//登録カロリー取得
		 $repeat=false;//重複チェック変数
		
			if(!empty($checkname) && !empty($checkkcal)){
			//空白データのチェック
				switch ($checkradio){
	 			//チェックラジオを用いてテーブル名の選択、変数を用いて後で代入する予定でしたが、うまくいかなかったので許してください
					case 1:
						$sql="SELECT * FROM materials WHERE materials = :names limit 1";//重複データチェック用クエリ
						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':names', $checkname, PDO::PARAM_STR,30);
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_ASSOC);
						if($result > 0){//重複データが1つ以上あるならばフラグを建てる
							$repeat=true;
						break;
						}
						$sql= "INSERT INTO materials(materials,calories) VALUES(?,?)";
						break;
					case 2:
						$sql="SELECT * FROM dishes WHERE dishes = :names limit 1";//重複データチェック用クエリ
						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':names', $checkname, PDO::PARAM_STR,30);
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_ASSOC);
						if($result > 0){//重複データが1つ以上あるならばフラグを建てる
							$repeat=true;
						break;
						}
						$sql= "INSERT INTO dishes(dishes,calories) VALUES(?,?)";
						break;
					case 3:
						$sql="SELECT * FROM foods WHERE foods = :names limit 1";//重複データチェック用クエリ
						$stmt = $pdo -> prepare($sql);
						$stmt->bindParam(':names', $checkname, PDO::PARAM_STR,30);
						$stmt->execute();
						$result = $stmt->fetch(PDO::FETCH_ASSOC);
						if($result > 0){//重複データが1つ以上あるならばフラグを建てる
							$repeat=true;
						break;
						}
						$sql= "INSERT INTO foods(foods,calories) VALUES(?,?)";
						break;
					default:
						echo "ラジオボタンに変な値はいってる";

				}
				if($repeat==false){//データの重複がなければデータを追加する
					$stmt = $pdo -> prepare($sql);
					$stmt->execute([$checkname,$checkkcal]);
				}
		}
	}
?>





 <!----------------------------------食品名のブロック----------------------------------->                                  
<div style="float:left;" class="inputformat">
<br>
<label for="name" class="MA_biglabel">  食品名  </label> 
<p><label for="name" class="MA_selectnamelabel">食品名選択</label> </p>



<!-- 食品名のプルダウン作成 -->
<?php
// DB接続しSQLを発行してデータを取得
$sql= "select * from materials";
$stmt = $pdo -> prepare($sql);
$stmt->execute(); 

//プルダウン作成+
echo "<form action='registnutrition.php' method='post'>";
echo "<select id='MA_name' name='MA_Name' class='MA_selectnamebox'>";
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  // 実行結果から1レコード取ってくる
  	$names=$res['materials'];
  	$kcal=$res['calories'];
  	echo "<option value='$names'>$names</option>";
}	
  echo "</select>"; 
  echo "<input type='text' pattern='[\d.]*' title='数字かドットで入力してください' id='MA_num' name='MA_Num'placeholder='個'class='MA_numbox'>";
  echo "<button class='MA_registbutton'type='submit' name='MA_add' value='ボタン' onclick='MA_clickgo()'>決定</button>";
  echo "</form>";
?>

<form method="post">
<p><label for="name"class="MA_numlabel">個数</label>
<label for="name"class="MA_attention">(※肉類は100gで1個として扱います)</label>
</p>

</form>




 <!----------------------------------料理名のブロック----------------------------------->                                  
</div>	
<div style="float:left;" class="inputformat">
<br>


<label for="name" class="ME_biglabel">  料理名  </label>   
<p><label for="name" class="ME_selectnamelabel">料理名選択</label> </p>
</p>
<p><label for="name" class="ME_numlabel">個数</label>

<!-- 料理名のプルダウン作成 -->
<?php
$sql= "select * from dishes";
$stmt = $pdo -> prepare($sql);
$stmt->execute(); 
echo "<form action='registnutrition.php' method='post'>";
echo "<select id='ME_name' name='ME_Name' class='ME_selectnamebox'>";
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  // 実行結果から1レコード取ってくる
  	$names=$res['dishes'];
  	$kcal=$res['calories'];
  	echo "<option value='$names'>$names</option>";
}	
  echo "</select>"; 
  echo "<input type='text' pattern='[\d.]*' title='数字かドットで入力してください'　id='ME_num' name='ME_Num'placeholder='個'class='ME_numbox'>";
  echo "<button class='ME_registbutton'type='submit' name='ME_add' value='ボタン' onclick='ME_clickgo()'>決定</button>";
  echo "</form>";
?>

</p>



 <!----------------------------------その他のブロック----------------------------------->                                  

</div>
<div style="float:left;"class="inputformat">

<br>

<label for="name" class="OT_biglabel">  その他  </label>   
<p><label for="name" class="OT_selectnamelabel">品目名選択</label> </p>
<label for="name" class="OT_label1">登録場所</label>
<label for="name" class="OT_label2">登録名</label>
<label for="name" class="OT_label3">カロリー</label>
<label for='name' class='OT_numlabel'>個数</label>


<?php
// DB接続しSQLを発行してデータを取得
$sql= "select * from foods";
$stmt = $pdo -> prepare($sql);
$stmt->execute(); 

//プルダウン作成+
echo "<form action='registnutrition.php' method='post'>";
echo "<select id='OT_name' name='OT_Name' class='OT_selectnamebox'>";
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  // 実行結果から1レコード取ってくる
  	$names=$res['foods'];
  	$kcal=$res['calories'];
  	echo "<option value='$names'>$names</option>";
}	
  echo "</select>"; 
  echo "<input type='text' pattern='[\d.]*' title='数字かドットで入力してください'　id='OT_num' name='OT_Num'placeholder='個'class='OT_numbox'>";
  echo "<button class='OT_registbutton'type='submit' name='OT_add' value='ボタン' onclick='OT_clickgo()'>決定</button>";
  echo "</form>";
?>

<form method="post">
<p class = OT_ppos>
<input type="radio" name="OT_radio" value="1" checked>食品名<br>
<input type="radio" name="OT_radio" value="2" checked>料理名<br>
<input type="radio" name="OT_radio" value="3" checked>その他<br>
</p>
<input id="OT_registname"type="text" name="OT_name" class="OT_box1"placeholder="名前">
<input type="text" pattern="[\d.]*" title="数字かドットで入力してください"　id="OT_registkcal" name="OT_kcal" class="OT_box2"placeholder="kcal">
<button class="OT_dataregistbutton"type="submit" name="dataregist" value="ボタン" onclick="window.location.reload(true);" >新規登録</button>
</form>
</div>

<!-- 決定を押したときに、リザルトで表示するDBへのデータ挿入 -->
<?php
if(isset($_POST['MA_add'])||isset($_POST['ME_add'])||isset($_POST['OT_add'])) {//いずれかの決定ボタンが押された時
	if(isset($_POST['MA_add'])){//押されたのが食品名のとき
		if(($_POST['MA_Num']!="")&&($_POST['MA_Name'])!=""){//個数と名前の空白チェック
	 		$checkradio=1;//id
			$checkname=$_POST['MA_Name'];//名前
			$checknum=$_POST['MA_Num'];//個数
			$sql="select * from materials where materials = ?";
		 	}
		}
	else if(isset($_POST['ME_add'])){//押されたのが料理名のとき
		if(($_POST['ME_Num']!="")&&($_POST['ME_Name'])!=""){//個数と名前の空白チェック
			$checkradio=2;//id
	    	$checkname=$_POST['ME_Name'];//名前
	    	$checknum=$_POST['ME_Num'];//個数
	    	$sql="select * from dishes where dishes = ? ";
		}
	}
	else if(isset($_POST['OT_add'])){//押されたのがその他のとき
		if(($_POST['OT_Num']!="")&&($_POST['OT_Name'])!=""){//個数と名前の空白チェック
			$checkradio=3;//id
	    	$checkname=$_POST['OT_Name'];//名前
	    	$checknum=$_POST['OT_Num'];//個数
	    	$sql="select * from foods where foods = ? ";
	 	}
	}
	if(!empty($checkname)&&!empty($checknum)){//名前と個数が入力されているか確認
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$checkname]);
		$hit=$stmt->fetch(PDO::FETCH_ASSOC);
		$resultkcal=$hit['calories']*$checknum;//総カロリー
		//ここから重複チェック
		$repeat=false;	
		$sql="SELECT * FROM nutritionreg_table WHERE UserID = ? AND Date = ? AND DetaName = ? limit 1";//重複チェッククエリ
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$_id,$ymd,$checkname]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result > 0){//重複が見つかればフラグを建てる
			$repeat=true;	
		}
		//ここまで
	}
	if($repeat==false){//重複データがなければ
		$sql="INSERT INTO nutritionreg_table(UserID,Date,DetaName,Calorie,Items) VALUE(?,?,?,?,?)";//データの挿入
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$_id,$ymd,$checkname,$resultkcal,$checknum]);
		
	}
}
	

?>
<?php 
//ひとつもどるを押したときに、最新レコードを削除する関数
if(isset($_POST['back'])) {//戻るが押された時！
	if(empty($_POST['back'])){	 //念のため
	}
	else{
		$sql="DELETE FROM nutritionreg_table WHERE UserID = ? AND Date = ? ORDER BY Number DESC LIMIT 1";//　最新レコードを降順で一番上に持ってきて上から1行削除
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$_id,$ymd]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
  ?>



<?php
			echo "<div style='float:left;'class='displayformat'>";
			//データベースから該当カラムのデータを抽出
			$sql="select * from nutritionreg_table where UserID = ? and Date = ?";//データベースの値取得
			$stmt = $pdo -> prepare($sql);
			$stmt->execute([$_id,$ymd]);
		
		while($res=$stmt->fetch(PDO::FETCH_ASSOC)){
			//料理名×個数＝総カロリー　の形式で表示
			echo $name=$res['DetaName'];//
			echo "×";
			echo $num=$res['Items'];
			echo "個＝";
			echo $kcal=$res['Calorie'];
			echo "kcal<br/>";
		 }
	echo "<form action='registnutrition.php' method='post'>";
	echo "<input type='submit' class='backbutton' name='back' value='データを1つ取り消す' onclick='clickback()'><br>";
	echo "</form>";
	echo "<form action='registexercise.php' method='post'>";
	echo "<input type='submit' class='jumpexercise'  name='button' value='運動データ登録へ' ><br>";
	echo "</form>";
	echo "</div>";	
?>
</html>
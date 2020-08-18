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
<a href="../login/home.php"><img class="roll float" src="../login/img/まちおさん3.jpg" alt="サンプル画像" width=100px height=48px></a>
<h1 class="title">摂取カロリー登録画面</h1>
<meta charset="UTF-8">
<script src="MA_pushdata.js"></script> 
<title>摂取カロリー登録</title>

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
<label for="name" class="tlabel">時間選択</label>


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
  echo "<input type='text' pattern='[\d.]*' title='正の数値で入力してください' id='MA_num' name='MA_Num'placeholder='個'class='MA_numbox'>";
  echo "<button class='MA_registbutton'type='submit' name='MA_add' value='ボタン' onclick='MA_clickgo()'>決定</button>";
  echo "<p class = tpos>";
  echo "<input type='radio' name='t1' value='1' checked>朝";
  echo "<input type='radio' name='t1' value='2' >昼";
  echo "<input type='radio' name='t1' value='3' >夜";
  echo "</p>";
  echo "</form>";
 ?>

<form method="post">
<p><label for="name"class="MA_numlabel">個数</label>
<label for="name"class="MA_attention">(※食品は100gで1個として扱います)</label>
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
<label for="name" class="tlabel">時間選択</label>

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
  echo "<input type='text' pattern='[\d.]*' title='正の数値で入力してください' id='ME_num' name='ME_Num'placeholder='個'class='ME_numbox'>";  
  echo "<button class='ME_registbutton'type='submit' name='ME_add' value='ボタン' onclick='ME_clickgo()'>決定</button>";
  echo "<p class = tpos>";
  echo "<input type='radio' name='t2' value='1' checked>朝";
  echo "<input type='radio' name='t2' value='2'>昼";
  echo "<input type='radio' name='t2' value='3'>夜";
  echo "</p>";
  echo "</form>";

?>

</p>



 <!----------------------------------その他のブロック----------------------------------->                                  

</div>
<div style="float:left;"class="inputformat">

<br>

<label for="name" class="OT_biglabel">  その他  </label>   
<p><label for="name" class="OT_selectnamelabel">品目名選択</label> </p>
<label for='name' class='OT_numlabel'>個数</label>
<label for="name" class="tlabel">時間選択</label>


<?php
// DB接続しSQLを発行してデータを取得
$sql= "select * from foods";
$stmt = $pdo -> prepare($sql);
$stmt->execute(); 

//プルダウン作成+
echo "<form action='registnutrition.php' method='post'>";
echo "<select id='OT_dname' name='OT_Name' class='OT_selectnamebox'>";
while($res = $stmt->fetch(PDO::FETCH_ASSOC)){  // 実行結果から1レコード取ってくる
  	$names=$res['foods'];
  	$kcal=$res['calories'];
  	echo "<option value='$names'>$names</option>";
}	
  echo "</select>"; 
  echo "<input type='text' pattern='[\d.]*' title='正の数値で入力してください' id='OT_dnum' name='OT_Num'placeholder='個'class='OT_numbox'>";
  echo "<button class='OT_registbutton'type='submit' name='OT_add' value='ボタン' onclick='OT_clickgo()'>決定</button>";
  echo "<p class = tpos>";
  echo "<input type='radio' name='t3' value='1' checked>朝";
  echo "<input type='radio' name='t3' value='2'>昼";
  echo "<input type='radio' name='t3' value='3'>夜";
  echo "</p>";
  echo "</form>";
?>

</div>
<!-- 新規登録のブロック -->
<div style="float:left;"class="inputformat">
<br>

<label for="name" class="NE_biglabel">新規登録</label>   
<label for="name" class="OT_label2">登録名</label>
<label for="name" class="OT_label3">カロリー</label>
<label for="name" class="OT_label1">登録場所</label>

<form method="post">
<p class = OT_ppos>
<input type="radio" name="OT_radio" value="1">食品名<br>
<input type="radio" name="OT_radio" value="2">料理名<br>
<input type="radio" name="OT_radio" value="3" checked>その他<br>
</p>
<input id="OT_registname"type="text" name="OT_name" class="OT_box1"placeholder="名前">
<input type="text" pattern="[\d.]*" title="数字かドットで入力してください"　id="OT_registkcal" name="OT_kcal" class="OT_box2"placeholder="kcal">
<button class="OT_dataregistbutton"type="submit" name="dataregist" value="ボタン" onclick="window.location.reload(true);" >新規登録</button>
</form>
</div>

<!-- 決定を押したときに、リザルトで表示するDBへのデータ挿入 -->
<?php
if(isset($_POST['MA_add'])||isset($_POST['ME_add'])||isset($_POST['OT_add'])) {
	$j=false;
	//いずれかの決定ボタンが押された時
	if(isset($_POST['MA_add'])){//押されたのが食品名のとき
		if(($_POST['MA_Num']!="")&&($_POST['MA_Name'])!=""){//個数と名前の空白チェック
			 $checkradio=1;//id
			 $time=$_POST['t1'];
			$checkname=$_POST['MA_Name'];//名前
			$checknum=$_POST['MA_Num'];//個数
			$sql="select * from materials where materials = ?";
			$j=true;
		 	}
		}
	else if(isset($_POST['ME_add'])){//押されたのが料理名のとき
		if(($_POST['ME_Num']!="")&&($_POST['ME_Name'])!=""){//個数と名前の空白チェック
			$checkradio=2;//id
			$time=$_POST['t2'];
	    	$checkname=$_POST['ME_Name'];//名前
	    	$checknum=$_POST['ME_Num'];//個数
			$sql="select * from dishes where dishes = ? ";
			$j=true;
		}
	}
	else if(isset($_POST['OT_add'])){//押されたのがその他のとき
		if(($_POST['OT_Num']!="")&&($_POST['OT_Name'])!=""){//個数と名前の空白チェック
			$checkradio=3;//id
			$time=$_POST['t3'];
	    	$checkname=$_POST['OT_Name'];//名前
	    	$checknum=$_POST['OT_Num'];//個数
			$sql="select * from foods where foods = ? ";
			$j=true;
	 	}
	}
	if($j==true){
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$checkname]);
		$hit=$stmt->fetch(PDO::FETCH_ASSOC);
		$resultkcal=$hit['calories']*$checknum;//総カロリー
		//ここから重複チェック
		$repeat=false;	
		$sql="SELECT * FROM nutritionreg_table WHERE UserID = ? AND Date = ? AND DetaName = ? AND Time_Zone = ? limit 1";//重複チェッククエリ
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$_id,$ymd,$checkname,$time]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result > 0){//重複が見つかればフラグを建てる
			$repeat=true;	
		}
		//ここまで
	
	if($repeat==false){//重複データがなければ
		$sql="INSERT INTO nutritionreg_table(UserID,Date,DetaName,Calorie,Items,Time_Zone) VALUE(?,?,?,?,?,?)";//データの挿入
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$_id,$ymd,$checkname,$resultkcal,$checknum,$time]);
		
	}
}
}
	

?>
<?php 
//ひとつもどるを押したときに、最新レコードを削除する関数
if(isset($_POST['back'])) {//戻るが押された時！
	if(empty($_POST['back'])){	 //念のため
	}
	else{
		$button=$_POST['del'];
		$sql="DELETE FROM nutritionreg_table WHERE UserID = ? AND Date = ? and Time_Zone = ? ORDER BY Number DESC LIMIT 1";//　最新レコードを降順で一番上に持ってきて上から1行削除
		$stmt = $pdo -> prepare($sql);
		$stmt->execute([$_id,$ymd,$button]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	}
}
  ?>



<?php
			/*************朝の登録カロリー**************/
			echo "<div style='float:left;'class='tinputformat'>";
			echo "<label for='name' class='tbiglabel'>朝</label>";
			echo "<br>";

			//データベースから該当カラムのデータを抽出
			$sql="select * from nutritionreg_table where UserID = ? and Date = ? and Time_Zone = 1";//データベースの値取得
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

		 echo "</div>";

		 /*************昼の登録カロリー**************/
		 echo "<div style='float:left;'class='tinputformat'>";
		 echo "<label for='name' class='tbiglabel'>昼</label>";
		 echo "<br>";
		 //データベースから該当カラムのデータを抽出
		 $sql="select * from nutritionreg_table where UserID = ? and Date = ? and Time_Zone = 2";//データベースの値取得
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
		 echo "</div>";
		 /*************夜**************/
		 echo "<div style='float:left;'class='tinputformat'>";
		 echo "<label for='name' class='tbiglabel'>夜</label>";
		 echo "<br>";
		 //データベースから該当カラムのデータを抽出
		 $sql="select * from nutritionreg_table where UserID = ? and Date = ? and Time_Zone = 3";//データベースの値取得
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
		 echo "</div>";
		 
		 
		 echo "<div style='float:left;'class='tinputformat'>";
		 echo "<form action='registnutrition.php' method='post'>";
		 //朝昼夜の消すデータをラジオボタンで選択する
		 echo "<p class = dpos>";
		 echo "<label for='name'>時間選択</label><br>";
		 echo "<input type='radio' name='del' value='1' checked>朝";
		 echo "<input type='radio' name='del' value='2'>昼";
		 echo "<input type='radio' name='del' value='3'>夜";
		 echo "</p>";
		 echo "<input type='submit' class='backbutton' name='back' value='データを1つ取り消す' onclick='clickback()'><br>";
		 echo "</form>";
		 echo "<form action='registexercise.php' method='post'>";
		 echo "<input type='submit' class='jumpexercise'  name='button' value='運動データ登録へ' ><br>";
		 echo "</form>";
		 echo "</div>";
?>
</html>
<!DOCTYPE html>
<!--
********************************************
*This is templist
*Name: ryousuke nishizawa
*CreateDate: 2020/07/17 09:30:00
*Version: 1.01
*Update: 2020/07/22
*******************************************
-->

<html>
<head>
    <meta charset="UTF-8">
    <title>体温カレンダー</title>
</head>
<header >
    <link rel="stylesheet" href = "temp.css">
    <h1 class="title">体温カレンダー</h1>
</header>

<!--中央ぞろえ、背景色スカイブルー-->
<body bgcolor ="skyblue" align = "center" >
<!--体温確認画面へ-->
<form action="templist.php" method="post" name="form1" id="form1">
確認したい日付を選択してください


<?php
session_start();
//ユーザーネームの呼び出し
$name = $_SESSION['user_name'];
//表示月の初期化
$monmon = "";
//名前を表示
if(isset($name)){
    echo $name . 'さん';
} else {
    //echo 'no--------------------u';
}
// 現在の年月を取得
$year = date('Y');
if(empty($_POST['nowmonth'])) {
    $month = date('m');
} 
else {
    $month = $_POST['nowmonth'];
}

//月の増減用変数
$mon = '0';
echo   '<form action="templist.php" method="post" name="form1" id="form1">';
echo    '<input type="hidden" name="nowmonth" value="' . $month . '">';
echo    '<input type="submit" name="month" value="先月" size="5"  style="font:15pt MS ゴシック; width:5%; height:7%">';
echo    '<input type="submit" name="month" value="来月" size="5"  style="font:15pt MS ゴシック; width:5%; height:7%">';

//受け取った値によって月の増減と表示月を変更
if(empty($_POST['month'])) {
    $monmon = $month + $mon;
} 
else if($_POST['month']=='先月') {
    $mon = -1;
    $monmon = $month + $mon;
}
else if($_POST['month']=='来月') {
    $mon = 1;
    $monmon = $month + $mon;
} else {
    $monmon = $_POST['month'];
    if($monmon[0]=='0') $monmon = substr($monmon, 1, 2);
}
if($monmon == '0'){
    $monmon = 12;
}
$today = date('d');
 
// 月末日を取得
$last_day = date('j', mktime(0, 0, 0, $monmon + 1, 0, $year));
 
$calendar = array();
$j = 0;
 
// 月末日までループ
for ($i = 1; $i < $last_day + 1; $i++) {
 
    // 曜日を取得
    $week = date('w', mktime(0, 0, 0, $monmon, $i, $year));
 
    // 1日の場合
    if ($i == 1) {
 
        // 1日目の曜日までをループ
        for ($s = 1; $s <= $week; $s++) {
 
            // 前半に空文字をセット
            $calendar[$j]['day'] = '';
            $j++;
 
        }
       // a{ text-decoration: none;}
    }
 
    // 配列に日付をセット
    if($i != $today){
        $calendar[$j]['day'] = $i;
        $j++;
    }
    else{
        $calendar[$j]['day'] = $i;
        $j++;
        
    }
 
    // 月末日の場合
    if ($i == $last_day) {
 
        // 月末日から残りをループ
        for ($e = 1; $e <= 6 - $week; $e++) {
 
            // 後半に空文字をセット
            $calendar[$j]['day'] = '';
            $j++;
 
        }
    }
 
}
?>
<br>


<!--中央ぞろえのカレンダー表示-->
<table bgcolor="#99ffff" align = "center" style ="font-size:35px" >
    <tr>
        <th colspan="7" class="text"><?php echo $year; ?>年<?php echo '<input type="text" size="1" style="border:none;background-color:transparent; font-size:20px" name="nowmonth" readonly value="' . $monmon . '">'?> 月 </th>
    </form>
    <tr>
        <th> 日</th>
        <th> 月</th>
        <th> 火</th>
        <th> 水</th>
        <th> 木</th>
        <th> 金</th>
        <th> 土</th>
    </tr>

    <tr>
    <?php 
        $cnt = 0; 
        $day = 0;
    ?>
    <!--体温確認画面へ-->
    <form action="temp.php" method="post" name="form1" id="form1">
    <?php foreach ($calendar as $key => $value): ?>
        
        <td>
        <?php $cnt++;
        //echo $value["day"];
        if($value['day'] != "") {
            if($value['day'] < 10) {
                $day = '0' . $value['day'];
            }
            else $day = $value['day'];
            //print $day;

        $datedata = $year . "-" . $month . "-" . $day;

        print '<input type="hidden" name="month" value="' . $monmon . '">';
        print '<input  name="day" type="submit" value='.$value["day"].' 
                style="border:none;background-color:transparent; color:coral; font-size:50px">';
        }
        ?>
        
        </td>
        

    <?php if ($cnt == 7): ?>
    </tr>
    



    <tr>
    <?php $cnt = 0; ?>
    <?php endif; ?>
 
    <?php endforeach; ?>
    </tr>
</table>
<br>
<!-- 戻るボタン -->
<input class="" type="button" value="選択画面に戻る" onClick="location.href='./select.php'" >
<br>
    
<?php
//echo "<script>alert('ようこそ！！！！');</script>";
?> 
    
    
</form>
</body>
</html>


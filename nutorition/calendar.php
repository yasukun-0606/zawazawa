<!DOCTYPE html>
<!--
********************************************
*This is Login display
*Name: Katsuaki Matsushima
*CreateDate: 2020/07/10 16:10:00
*Version: 0.5
*Update: 2020/07/13
*******************************************
-->

<html>
<head>
    <meta charset="UTF-8">
    <title>日付選択</title>
    <link rel="stylesheet" href = "calendar.css">

    <script type="text/javascript"> 

    function check(){
        var flag = 0;
        var year = document.forms.today.year.value;   //入力された西暦を取得
        var month = document.today.month.value;       //入力された月を取得
        var day = document.today.day.value;           //入力された日付を取得
        // 設定開始（必須にする項目を設定してください）

        if(month < 13　&& day < 32 && year > 1926 && year < 2100){          //ありえない数値をチェック
            if((month == 4 || month == 6 || month == 9 || month == 11) && day == 31){
                flag = 1;       //4,6,9,11月　チェック
            }
            else if(month == 2){  //うるう年チェック
                if((year % 4 == 0 && year % 100 != 0) || year % 400 == 0){      //うるう年の場合
                    if( day > 29){
                        flag = 1;
                    }
                }
                else if(day > 28){         //うるう年じゃない場合
                    flag = 1;
                }
            }
        }
        else {
            flag = 1;
        }

        //項目未入力チェック
        if(month == ""){        //月」の入力をチェック
            flag = 2;
        }
        else if(day == ""){     //「日」の入力をチェック
            flag = 2;
        }
        else if(year == ""){    //「年」の入力チェック
            flag = 2;
        }
        
        // 設定終了
        if(flag　== 1){
            window.alert('入力した年月日は存在しないか対応していません。'); // 入力ミスがあれば警告ダイアログを表示
            return false; // 送信を中止
        }
        else if(flag == 2){
            window.alert('未入力の項目ありました。'); // 入力漏れがあれば警告ダイアログを表示
            return false; // 送信を中止
        }
        else{
            return true; // 送信を実行
        }
    }
    </script>

</head>
<header>
      <h1 class="head">日付選択</h1>
</header>

<body background ="back.png">

<?php
 
// 現在の年月を取得
$year = date('Y');
$month = date('n');
$today = date('d');
 
// 月末日を取得
$last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));
 
$calendar = array();
$j = 0;
 
// 月末日までループ
for ($i = 1; $i < $last_day + 1; $i++) {
 
    // 曜日を取得
    $week = date('w', mktime(0, 0, 0, $month, $i, $year));
 
    // 1日の場合
    if ($i == 1) {
 
        // 1日目の曜日までをループ
        for ($s = 1; $s <= $week; $s++) {
 
            // 前半に空文字をセット
            $calendar[$j]['day'] = '';
            $j++;
 
        }
 
    }
 
    // 配列に日付をセット
    if($i == $today){
        $calendar[$j]['day'] ="@".$i."@";       //今日の日付は＠
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
<br>
<table bgcolor="#ffffff">
    <tr>
        <th colspan="7" class="text"><?php echo $year; ?>年<?php echo $month; ?>月のカレンダー </th>
    <tr>
        <th>日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th>土</th>
    </tr>
 
    <tr>
    <?php $cnt = 0; ?>
    <?php foreach ($calendar as $key => $value): ?>
 
        <td>
        <?php $cnt++;
        if($value==$today){
            ECHO "<FONT COLOR='BLUE'>$value/FONT>";
        }else{
            echo $value["day"];
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
<form action="session.php" method="post" name="today" onsubmit="return check()">
    <p class="date_C"><br>
    
    日付選択<br>
    <input class="input_C" type = "text" name ="year">年
    <input class="input_C" type = "text" name ="month">月
    <input class="input_C" type = "text" name ="day">日<br>
    <br>
    ※今日の日付は@で挟んでいる日付<br>
    </p>
    <input class="send_C" type="submit" value="ユーザー登録画面へ">
</form>
</body>


</html>


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
    <header >
   
    <h1 style ="font-size:400%"  class="title" align = "center"　>体温カレンダー</h1>
    </header>

    <link rel="stylesheet" href = "templist.css">

</head>

<!--中央ぞろえ、背景色スカイブルー-->
<body bgcolor ="skyblue" align = "center" >

<!--体温確認画面へ-->
<form action="temp.php" method="post" name="form1" id="form1">

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
確認したい日付を選択してください
<br>


<!--中央ぞろえのカレンダー表示-->
<table bgcolor="#99ffff" align = "center" style ="font-size:35px" >
    <tr>
        <th colspan="7" class="text"><?php echo $year; ?>年<?php echo  $month; ?>月 </th>
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
    <?php foreach ($calendar as $key => $value): ?>
        
        <td>
        <?php $cnt++;
        //echo $value["day"];
        $year = date('Y');
        $month = date('m');
        if($value['day'] != "") {
            if($value['day'] < 10) {
                $day = '0' . $value['day'];
            }
            else $day = $value['day'];
            //print $day;

        $datedata = $year . "-" . $month . "-" . $day;
        //echo $datedata;
        //$dadada = date('Y-m-d',strtotime($datedata));
        //print '<input type="hidden" name="date" value=' . $datedata . '>';


        //print '<a style="color:coral"  href="JavaScript:document.form1.submit();">'.$value["day"].'</a>';
        //print '<button type="submit" name="action" value='.$value["day"].'>' .$value["day"]. '</button>';
        print '<input  name="day" style="color:coral" type="submit" value='.$value["day"].' style="border:none;background-color:transparent;">';
        //print '<a  style="color:coral"  href="temp.php">'.$value['day'].'</a>';
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


<?php
  /**
    * 2020/07/16 坂井香月 更新
    * 機能：日付と体温の入力
  */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>体調管理</title>
    <link rel="stylesheet" href="register.css">
</head>

<header>
  <h1 class="title" align="center">登録画面</h1>
</header>

<style>
body{
  background-color:#F0E7B3;
}
</style>
<body bgcolor='skyblue'>
  <div class='parent'>
    <form action='register.php' method='post'>
      <font size='7'>日付と体温を入力してください</font><br><br><br><br><br>
      <font size='6'>日付　月</font>
      <select name='month' style='width:5%; font-size:28px' id='relative5' onClick='functionName()'>
      <?php
        for($month = 1; $month <= 12; $month++){
          echo '<option value='.$month.'>'.$month.'</option>';
        }
      ?>
      </select><br>
      <font size='6' id='relativeday'> 日 </font>
      <select name='day' style='width:5%; font-size:28px' id='relativeday'>
      </select>

<?php
  $month = "";
  echo 
    ("
        <script type = 'text/javascript'>
          function functionName(){
            alert('Button is clicked');
              var select1 = document.forms.formName.month;
              var select2 = document.forms.formName.day;
              select2.options.length = 0;
              var i=1;
              var date=1;  
              if(select1.options[select1.selectedIndex].value == '2') date = 28;
              else if(select1.selectedIndex].value== '4' || select1.selectedIndex].value== '6' ||
                      select1.selectedIndex].value== '9' || select1.selectedIndex].value== '11' ) date = 30;
              else {
                date = 31;
                alert('Button is clicked');
              }
              while(i<=31){
                  select2.options[i-1] = new Option(i);             //日のリストボックス表示
                  i++;
              }
          }
        </script>
    ")
  ?>

        <font size='6' id='relativetemp'>体温</font>
        <input id='temptext' type='text' name='temp_n' style=' font:12pt MS ゴシック;width:6em;height:2.2em' />
        <font size='6' id='relativeDo'>℃</font>
        <input id='relativeButton' type='submit' value='確認' size='5'  style='font:15pt MS ゴシック; width:5%; height:7%'/>
        <font size='6'></font>
        </form>
      </div>
  </body>
</html>

<?php
/*
/* 日のリストボックス表示  */
/*$mon = $_POST["month"];
for($month = 1; $month <= 12; $month++){
  echo'<option value='.$month.'>'.$month.'</option>';
}
if($mon==2) $day = 28;
else if($mon==4 || $mon==6 || $mon==9 || $mon==11) $day = 30;
else $day = 31;
for($i = 1; $i <= $day; $i++){
    echo'<option value='.$i.'>'.$i.'</option>';              //日のリストボックス表示
}*/
?>
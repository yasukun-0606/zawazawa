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
    <!--入力画面専用のCSS-->
    <link rel="stylesheet" href="register.css">
  
    <script type="text/javascript">

    function check(){
      var temp = document.formName.temp_n.value;

      if(temp<34.0 || temp>41.0){
        window.alert('適切な体温を入力してください。'); // 入力ミスがあれば警告ダイアログを表示
        return false; // 送信を中止
      }
      else{
        return true; // 送信を実行
      }
    }
    </script>
</head>
<header>
      <link rel="stylesheet" href="Booom.css">
      <h1 class="title">入力画面</h1>
</header>

<?php
  session_start();

  $name = $_SESSION['user_name'];
  ?>
    <body>
    <div class="parent">
    <form name="formName" action="check.php" method="post" onsubmit="return check()">                     <!--確認画面へのフォーム-->
      <font size="7">日付と体温を入力してください</font><br><br><br><br><br>
      <font size="6"><b>日付</b></font>
      <br>
      <select name="year" style="width:90px; font-size:28px" id="relativesel">   <!--今年と去年のリストボックス-->
      <?php
          $y = date('Y');
          $my = $y-1;
          echo "<option value = '" . $y . "'selected>" . $y . "</option>'"; 
          echo "<option value = '" . $my . "'>" . $my . "</option>'";            
      ?>
      </select>
      <font size="6">年</font>
      <select name="month" style="width:75px; font-size:28px" id="relativesel" onChange="functionName()">   <!--月のリストボックス-->
        <?php
          $m = date('m');
          $i = 1;
          while($i<=12){
            if($i==$m) echo "<option value = '" . $i . "'selected>" . $i . "</option>'"; 
            else echo "<option value = '" . $i . "'>" . $i . "</option>'";                            //現在の月を表示
            $i++;
          }
        ?>
      </select>
      <font size="6">月</font>
      <select name="day" style="width:75px; font-size:28px" id="relativeday">  <!--日のリストボックス-->   
      <?php
        $y = date('Y');
        $m = date('d');
        $i = 1;
        $ld = 0;
        if($m==2){                                                  //2月の場合
          if(($y%4==0 && $y%100!=0) || $y%400==0) $l = 29;          //うるう年の判定
          else $ld = 28;
        }
        else if( $m == "4" || $m == "6" ||                        //4,6,9,11月なら30日まで追加
                    $m == "9" || $m == "11" ){
          $ld = 30;
        }
        else {
          $ld = 31;
        }
        while($i<=$ld){
          if($i==$m) echo "<option value = '" . $i . "'selected>" . $i . "</option>'"; 
          else echo "<option value = '" . $i . "'>" . $i . "</option>'"; 
          $i++;
        }
      ?>
      </select>
      <font size="6">月</font>
        <script type = "text/javascript">   //javascriptのコード
          function functionName(){
            
            　var now = new Date();
              var year = now.getFullYear();
              var y;
              var select1 = document.forms.formName.month;    
              var select2 = document.forms.formName.day;      
              var i=1;
              var sel =  select1.options[select1.selectedIndex].value;
              select2.options.length = 0;                                     //日のリストボックス初期化
              if(sel == "2") {                                              //2月なら28日まで追加
                if((year%4==0 && year%100!=0) || year%400==0) y = 29;
                else y = 28;
                while(i<=y){
                  select2.options[i-1] = new Option(i);            
                  i++;
                }
              }
              else if( sel == "4" || sel == "6" ||                        //4,6,9,11月なら30日まで追加
                        sel == "9" || sel == "11" ) {
                        
                        while(i<=30){
                          select2.options[i-1] = new Option(i);            
                          i++;
                        }
                      }
              else {                                                          //1,3,5,7,8,10,12月なら31日まで表示
                while(i<=31){
                  select2.options[i-1] = new Option(i);            
                  i++;
                }
              }
          }
        </script>
        <br>
        <br>
        <font size='6' id='relativetemptext'><b>体温</b></font>
        <!--体温入力-->
        <input id='temptext' pattern='[\d.]*' maxlength='4' type='text' name='temp_n' style=' font:12pt MS ゴシック;width:5em;height:1.8em' />
        <font size='6' id='relativeDo'>℃</font>
        <br>
        <!-- 確認画面へ -->
        <input id='relativeButton' type='submit' value='確認' size='5'  style='font:15pt MS ゴシック; width:75px; height:7%'/>
        <!-- 選択画面へ -->
        <input type='button' value='戻る' onClick='history.back()' style='font:15pt MS ゴシック; width:75px; height:7%'>
        </form>
      </div>
  </body>
  <style>
body{
  background-color:#F0E7B3;
}
</style>
</html>

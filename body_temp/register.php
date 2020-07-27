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
</head>

<header>
  <h1 class="title" align="center">入力画面</h1>
</header>
<?php
  session_start();

  $name = $_SESSION['user_name'];
  ?>
    <body style="background-color:skyblue;">
    <div class="parent">
    <form name="formName" action="check.php" method="post">                     <!--確認画面へのフォーム-->
      <font size="7">日付と体温を入力してください</font><br><br><br><br><br>
      <font size="6"><b>日付</b></font>
      <br>
      <select name="month" style="width:75px; font-size:28px" id="relativesel" onChange="functionName()">   <!--月のリストボックス-->
        <option value = "1">1</option>
        <option value = "2">2</option>
        <option value = "3">3</option>
        <option value = "4">4</option>
        <option value = "5">5</option>
        <option value = "6">6</option>
        <option value = "7">7</option>
        <option value = "8">8</option>
        <option value = "9">9</option>
        <option value = "10">10</option>
        <option value = "11">11</option>
        <option value = "12">12</option>
      </select>
      <font size="6">月</font>
      <select name="day" style="width:75px; font-size:28px" id="relativeday">  <!--日のリストボックス-->   
      <?php
        $i = 1;
        while($i<=31){
          echo "<option value = $i>$i</option>'";                            //最初の画面表示時に日のリストボックスを31日まで要素に追加
          //echo '<option value = " . $i . ">' . $i . '</option>';
          $i++;
        }
      ?>
      </select>
      <font size="6">月</font>
        <script type = "text/javascript">   //javascriptのコード
          function functionName(){
            
              var select1 = document.forms.formName.month;    
              var select2 = document.forms.formName.day;      
              var i=1;
              var sel =  select1.options[select1.selectedIndex].value;
              select2.options.length = 0;                                     //日のリストボックス初期化
              if(sel == "2") {                                              //2月なら28日まで追加
                
                while(i<=28){
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
        <input id='temptext' type='text' name='temp_n' style=' font:12pt MS ゴシック;width:5em;height:1.8em' />
        <font size='6' id='relativeDo'>℃</font>
        <br>
        <!-- 確認画面へ -->
        <input id='relativeButton' type='submit' value='確認' size='5'  style='font:15pt MS ゴシック; width:75px; height:7%'/>
        <font size='6'></font>
        </form>
      </div>
  </body>
</html>
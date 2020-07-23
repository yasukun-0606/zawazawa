<!--
********************************************
*This is Login display
*Name: Katsuaki Matsushima
*CreateDate: 2020/07/09 9:10:00
*Version: 1.0
*Update: 2020/07/20
*******************************************
-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>新規登録画面</title>
    <link rel="stylesheet" href = "Login.css">　<!--CSS読み込み-->

    <script type="text/javascript">  //Js読み込み

    function check(){
        var flag = 0;
        // 設定開始（必須にする項目を設定してください）

        if(document.user.age.value == ""){ // 「年齢」の入力をチェック
            flag = 1;
        }
        else if(document.user.gender.value == ""){ // 「性別」の入力をチェック
            flag = 1;
        }
        else if(document.user.height.value == ""){  // 「身長」の入力チェック
            flag = 1;
        }
        else if(document.user.weight.value == ""){  // 「体重」の入力チェック
            flag = 1;
        }
        else if(document.user.moment.value == ""){  // 「運動強度」の入力チェック
            flag = 1;
        }

        // 現実的な数値のチェック
        if(document.user.age.value > 130 || document.user.age.value < 0){          //年齢の数値チェック
            flag = 2;
        }
        else if(document.user.height.value > 272 || document.user.height.value < 50){   //身長の数値チェック
            flag = 2;
        }
        else if(document.user.weight.value > 150 || document.user.weight.value < 0){　//体重の数値チェック
            flag = 2;
        }

        // 設定終了
        if(flag == 1){
            window.alert('必須項目に未入力がありました'); // 入力漏れがあれば警告ダイアログを表示
            return false; // 送信を中止
        }
        else if (flag == 2){
            window.alert('入力項目に誤りがあります'); // ありえない数値があれば警告ダイアログを表示
            return false; // 送信を中止
        }else{
            return true; // 送信を実行
        }
    }
    </script>

</head>

<header>
      <h1 class="head">ユーザー情報登録</h1>        <!--ヘッダー情報-->
</header>

<body background ="back.png">               <!--背景設定-->
    <br>
    <form method="POST" action="calendar.php" name="user" onsubmit="return check()">        <!--ユーザー情報入力-->
    <table border="0">　<!--表のふちを消す-->  
        <tr>
            <tb><b class="left">年齢</b></tb>                           <!--年齢入力-->
            <tb>&emsp;<input class="input_form" type = "number" name ="age">歳</tb>　<!--年齢入力フォーム-->
        </tr>
        <tr>
            <tb><b>&emsp;&emsp;&emsp;性別</b></tb>                          <!--性別入力-->
            <tb>&emsp;<input type="radio" name="gender" value="1">男        <!--ラジオボタンで男と女を決める-->
            &emsp;<input type="radio" name="gender" value="2">女</tb>
        </tr>
        </table>
        <br>
        <table border="0">              <!--表のふちを消す-->
        <tr>
            <tb><b class="left">身長(㎝)</b></tb>                           <!--身長入力-->
            <tb><input class="input_form" type = "number" name ="height">㎝</tb>        <!--身長入力フォーム-->
        </tr>
        <tr>
            <tb><b class="left">&emsp;体重(kg)</b></tb>                     <!--体重入力-->
            <tb><input class="input_form" type = "text" name ="weight">kg</tb>      <!--体重入力フォーム-->
        </tr>
    </table> 
    <br>
    <br>
    <p class="text">普段の運動強度目安</p>        <!--運動強度の入力-->
    <div class="Login_t1">日常生活の運動強度についての説明<br>          <!--運動強度の説明とラジオボタン-->
    &emsp;<input type="radio" name="moment" value="1">1.生活の大部分が座っている(例：デスクワークが多い人)<br>　　<!--ラジオボタンで入力する-->
    <input type="radio" name="moment" value="2">2.座位中心だが移動することが多い。あるいは軽いスポーツ等を<br>
    &emsp;&emsp;している人(例：営業等で移動が多い人)<br>
    &emsp;<input type="radio" name="moment" value="3">3.移動や肉体労働が多い人(例：工事現場で作業している人)<br>
    上記で近いものを選択してください。</div>
 
    <br>
    <p class="text">目標(目標の体重や体系を入力)</p>           <!--目標入力-->
        <textarea  class="text" type = "text" name ="target" cols="40"></textarea>      <!--入力フォームてテキストフォーム-->
        <br>
    <p><input class="send" type="submit" value="送信"></p> <!--カレンダー画面へ遷移-->
    
    </form>

    <br>
        <br>
        <div>
            <button class="margin1" type="submit" onclick="location.href='https://www.dpt-inc.co.jp/'" >ホームへ<!--ホーム画面へ遷移-->
        </div>

</body>
</html>
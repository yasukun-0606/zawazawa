<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登録変更画面</title>                     <!--タイトル-->
    <link rel="stylesheet" href = "update.css">     <!--CSS呼び出し-->

    <script type="text/javascript">         //JS起動
    function check(){
        var flag = 0;       //フラグ管理(初期値0)
        var height = document.user.height.value;        //身長の入力値格納
        var weight = document.user.weight.value;        //体重の入力値格納
        var age = document.user.age.value;              //年齢の入力値格納        
        // 設定開始（必須にする項目を設定してください）

        // 現実的な数値のチェック
        if((height > 272 || height < 50 )&& height != ""){   //身長の入力チェック
            flag = 2;
        }
        else if((weight > 150 || weight < 0 )&& weight != ""){　//体重の入力チェック
            flag = 2;
        }
        else if((age >130 || age < 0) && age != ""){         //年齢の入力チェック
            flag = 2;
        }
        
        // 設定終了
        if (flag == 2){
            window.alert('入力項目に誤りがあります'); // ありえない数値があれば警告ダイアログを表示
            return false; // 送信を中止
        }else{
            return true; // 送信を実行
        }
    }
    </script>

</head>

<header>
      <h1 class="head">登録情報変更画面</h1>    <!--ヘッダー設定-->
</header>

<body background ="back.png">      <!--背景設定-->
    <br>
    <div class="text2">         <!--注意書き-->
        ※変更がある項目だけ入力してください。
    </div>
    <br>

    <form method="POST" action="update_Eiyou.php" name="user" onsubmit="return check()"> <!--ユーザー入力-->
    <table border="0"　class="text1">           <!--画面の体裁を整えるためにのテーブル-->
        <tr>
            <tb><b class="left">年齢</b></tb>
            <tb>&emsp;<input class="input_form" type = "text" name ="age">歳</tb>   <!--年齢変更フォーム-->
        </tr>
        <tr>
            <tb><b>&emsp;&emsp;&emsp;性別</b></tb>                          <!--性別入力-->
            <tb>&emsp;<input type="radio" name="gender" value="1">男        <!--ラジオボタンで男と女を決める-->
            &emsp;<input type="radio" name="gender" value="2">女</tb>
        </tr>
        </table>
        <br>
        <table border="0">          <!--画面の体裁を整えるためにのテーブル-->
        <tr>
            <tb><b class="left">身長(㎝)</b></tb>
            <tb><input class="input_form" type = "text" name ="height">㎝</tb>      <!--身長変更フォーム-->
        </tr>
        <tr>
            <tb><b class="left">体重(kg)</b></tb>
            <tb><input class="input_form" type = "text" name ="weight">kg</tb>      <!--体重変更フォーム-->
        </tr>
    </table> 
    <br>
    <br>
    <p class="text">普段の運動強度目安</p>        <!--運動強度の変更フォーム-->
    <div class="Login_t1">日常生活の運動強度についての説明<br>
    &emsp;<input type="radio" name="moment" value="1">1.生活の大部分が座っている(例：デスクワークが多い人)<br>
    &emsp;<input type="radio" name="moment" value="2">2.座位中心だが移動することが多い。あるいは軽いスポーツ等を<br>
    &emsp;&emsp;している人(例：営業等で移動が多い人)<br>
    &emsp;<input type="radio" name="moment" value="3">3.移動や肉体労働が多い人(例：工事現場で作業している人)<br>
    上記で近いものを選択してください。</div>
 
    <br>
    <p class="text">目標(目標の体重や体系を入力)</p>           <!--目標入力-->
        <textarea  class="text" type = "text" name ="target" cols="40"></textarea>      <!--目標変更入力フォーム-->
        <br>
    <p><input class="send" type="submit" value="送信" ></p>      <!--ユーザー情報画面に戻る-->
    
    </form>

</body>
</html>

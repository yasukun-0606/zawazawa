<!--
********************************************
*カレンダーデータ表示
*Name: T・M
*CreateDate: 2020/07/21
*Version: 0.02
*Update: 2020/07/24
*******************************************
-->

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>体温結果表示</title>
</head>
<header>
      <link rel="stylesheet" href="Booom.css">
      <a href="../login/home.php"><img class="roll float" src="../login/img/まちおさん3.jpg" alt="サンプル画像" width=100px height=48px></a>
      <h1 class="title">体温結果表示</h1>
</header>
<form name="tempform" action="templist.php" method="post">
<style>
body{
  background-color:#F0E7B3;
}
</style>
<body>
    <!--中央揃え-->
    <center>

    <?php
    session_start();

    $year = $_POST['year'];                   //対象年       
    $month = $_POST['month'];                 //対象月
    if($month < 10){
        $month = '0' . $month;
    }                                                        
    $day = $_POST["day"];                     //対象日         
    if($day < 10){
        $day = '0' . $day;
    }
    $date = $year . "-" . $month . "-" . $day; //対象の日付
    $name = $_SESSION['user_name'];            //UserName
    $error_code=0;                             //error_code
    $tempsum=0;                                //月体温合計
    $tempave=0;                                //月体温平均
    $counter=0;                                //月体温データ数
    $sun='';                                   //朝の体温
    $noon='';                                 //昼の体温
    $night='';                                 //夜の体温
    $i=0;                                      //ループ用変数
    $error_name='データがありません';           //エラー内容 

    /****タイトル表示****/
     echo "<br/>";                             
     echo "<h2>";
     echo $name;                                 //UserName                      
     echo "さんの ";
     echo substr($date,0,4);                   //文字列から年を取得
     echo "年";
     echo substr($date,5,2);                   //文字列から月を取得
     echo "月";
     echo substr($date,8,2);                   //文字列から日付を取得
     echo "日";
     echo " の体温</h2>";

     echo "<br/>";      //改行
     echo "<br/>";      //改行

        //データベース接続情報ファイル
       require_once('../config.php');
    
        try{

            
            $sql = 'select * from body_temp where user_name ="' . $name .'" AND date = "' . $date . '"';       //SQL文
            $stmt = $pdo->prepare($sql);                            //SQL文のセットとデータベースへ接続
            $stmt->execute();                                //日付データの一致参照
            foreach ($stmt as $row) {                               
                                                                    // データベースのフィールド名で出力
                $temp = $row['temp'];                                                    
                if($row['time']=='朝') {
                    $sun=$row['temp'];                                  //朝の体温を抽出
                } else if($row['time']=='昼'){
                    $noon=$row['temp'];                                  //朝の体温を抽出
                } else if($row['time']=='夜'){
                    $night=$row['temp'];
                }
            }
            
            $sql = 'select * from body_temp_sub where month ="' . $month .'"';       //SQL文
            $stmt = $pdo->prepare($sql);                            //SQL文のセットとデータベースへ接続
            $stmt->execute();                                //日付データの一致参照
            foreach ($stmt as $row) {                               
                                                                    // データベースのフィールド名で出力
                $tempsum+=$row['temp'];                             //月の体温の合計
                $counter+=1;                                        //月データ数
            
            }

            $tempave=round($tempsum/$counter, 1);                   //月データのアベレージ
            
            if(empty($temp)){                                      //体温の空白チェック
                $error_code = 200;
            }
            echo '<p style="font-size:20px;">';
            echo "<h3 align='center'>";
            echo '朝　　　　　　　　　　　　昼　　　　　　　　　　　　夜<br/>';
            
            for($i=1;$i<=3;$i++){
                                      //指定日の体温表示
                if($i==1) {
                    if(empty($sun)) echo $error_name;
                    else echo   $sun . "℃";
                    echo "　　　";
                }
                else if($i==2) {
                    echo "　　　";
                    if(empty($noon)) echo $error_name;
                    else echo "＞　" . $noon . "℃　＜";
                    echo "　　";
                }
                else if($i==3) {
                    echo "　　　";
                    if(empty($night)) {
                        echo $error_name;
                        echo "<br/>";
                    } else echo "＞　" . $night . "℃　＜<br/>";
                    echo "　　　　";
                }
            }
            for($i=1;$i<=3;$i++){
                echo "￣^Y^Y^Y^Y^￣　　　";
                if($i==3) echo "<br/>";
            }

            echo "<br/><br/>";
            echo "月の平均体温";
            echo "<br/>";
            echo $tempave;
            echo "℃　<br/>";
            echo '</h3></p>';

        }catch(Exception $e){
            $error_code = 900;                                      //データベースに接続できなかった場合
        }

        if($error_code==900){
            echo "<h2>DBエラー</h2>";                               //エラーコード
          //  echo "<hr><br>";
        }elseif($error_code==200){
            echo "<h2>データがありません 登録をお願いします</h2>";                  //データベースエラー
        }else{


            echo '<br/>';       //改行

            //echo "<div aline = 'left'>判断結果</div>";

            //echo '<br/>';

            /****体温データの判断結果****/
            if($temp>=42){
                echo "<div class='flame01'><p align='center'>体温が高すぎます　測り直してください</p></div>";
            }elseif($temp>=37.5){
                //37.5℃以上
                echo "<div class='flame01'><p align='center'>規定体温を超えています！病院に行きましょう</p></div>";
            }elseif($temp>=37){
                //37℃以上
                echo "<div class='flame01'><p align='center'>微熱気味です　状況報告を行い判断を仰ぎましょう</p></div>";
            }elseif($temp>=34){
                //平熱
                echo "<div class='flame01'><p align='center'>問題ありません　元気よく出勤をしましょう</p></div>";
            }else{
                echo "<div class='flame01'><p align='center'>体温が低すぎます　測り直してください</p></div>";
            }
                
        }

        echo '<br/><br/>';      //改行
        echo '<input type="hidden" name="month" value="' . $month . '">';
        echo '<input type="hidden" name="nowyear" value="' . $year . '">';
        /****カレンダーに戻るリンク設定****/
        echo "<input type='submit' value='カレンダーに戻る' size='5'  style='font:15pt MS ゴシック; width:200px; height:60px'/>";
        echo "      ";
        echo "<a href='register.php'><input type='button' value='登録画面へ' size='5'  style='font:15pt MS ゴシック; width:200px; height:60px'/></a>";
        
    ?>

    </center>

</body>
</form>
</html>

<!--
********************************************
*カレンダーデータ表示
*Name: T・M
*CreateDate: 2020/07/21
*Version: 0.01
*Update: 2020/07/21
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
      <h1 class="title">体温結果表示</h1>
</header>
<body>

    <center>

    <?php
    $year = date('Y');
    $month = date('m');                                                        
    $day = $_POST["day"];         
    if($day < 10){
        $day = '0' . $day;
    }
    $date = $year . "-" . $month . "-" . $day; //対象の日付
    $id = "Miyaji";             //UserName
    $error_code=0;              //error_code                                                 

    
     echo "<br/>";
     echo "<h2>";
     echo $id;
     echo "さんの ";
     echo substr($date,0,4);
     echo "年";
     echo substr($date,5,2);
     echo "月";
     echo substr($date,8,2);
     echo "日";
     echo " の体温</h2>";

     echo "<br/>";      //改行
     echo "<br/>";

        //データベース接続情報ファイル
        require_once __DIR__ .'/config.php';
    
        
        try{                                                  
            
            $sql = "select * from body_temp where date = ?";       //SQL文
            $stmt = $pdo->prepare($sql);                            //SQL文のセットとデータベースへ接続
            $stmt->execute([$date]);                                //日付データの一致参照
            foreach ($stmt as $row) {                               
                                                                    // データベースのフィールド名で出力
                $cal=$row['temp'];                                  //体温を抽出
            }

            echo '<p style="font-size:20px;">'; 
            echo $cal ."℃";
            echo '</p>';                                        //体温の表示

        }catch(Exception $e){
            $error_code = 900;                                      //データベースに接続できなかった場合
        }

        if($error_code==900){
            echo "<h2>DBエラー</h2>";                               //エラーコード
          //  echo "<hr><br>";
        }

    
        echo '<br/>';

        //echo "<div aline = 'left'>判断結果</div>";

        //echo '<br/>';

        if($cal>=37.5){
            echo "<div class='flame01'><p align='center'>規定体温を超えています！病院に行きましょう</p></div>";
        }elseif($cal>=37){
            echo "<div class='flame01'><p align='center'>微熱気味です　状況報告を行い判断を仰ぎましょう</p></div>";
        }else{
            echo "<div class='flame01'><p align='center'>問題ありません　元気よく出勤をしましょう</p></div>";
        }

        echo '<br/><br/>';

        echo "<div aline = 'center'><a href='https://www.dpt-inc.co.jp/'>カレンダーに戻る</a></div>";

        
    ?>

    </center>

</body>
</html>

    

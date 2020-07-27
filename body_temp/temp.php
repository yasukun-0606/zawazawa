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
      <h1 class="title">体温結果表示</h1>
</header>
<form name="tempform" action="templist.php" method="post">
<body>
    <!--中央揃え-->
    <center>

    <?php
    session_start();

    $year = date('Y');                        //対象年       
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
                $temp=$row['temp'];                                  //体温を抽出
                //echo $stmt;
            }
            
            if(empty($temp)){                                      //体温の空白チェック
                $error_code = 200;
            } else {

               /****体温の表示****/
                echo '<p style="font-size:20px;">';
                echo "<h3 align='center'>";
                echo "＿人人人人人人＿<br/>";
                echo "＞　".$temp;                                       //指定日の体温表示
                echo "℃　＜<br/>";
                echo "￣^Y^Y^Y^Y^￣<br/></h3>";                         
                echo '</p>';
                
            }

        }catch(Exception $e){
            $error_code = 900;                                      //データベースに接続できなかった場合
        }

        if($error_code==900){
            echo "<h2>DBエラー</h2>";                               //エラーコード
          //  echo "<hr><br>";
        }elseif($error_code==200){
            echo "<h2>DBにデータがありません</h2>";                  //データベースエラー
        }else{


            echo '<br/>';       //改行

            //echo "<div aline = 'left'>判断結果</div>";

            //echo '<br/>';

            /****体温データの判断結果****/
            if($temp>=37.5){
                //37.5℃以上
                echo "<div class='flame01'><p align='center'>規定体温を超えています！病院に行きましょう</p></div>";
            }elseif($temp>=37){
                //37℃以上
                echo "<div class='flame01'><p align='center'>微熱気味です　状況報告を行い判断を仰ぎましょう</p></div>";
            }else{
                //平熱
                echo "<div class='flame01'><p align='center'>問題ありません　元気よく出勤をしましょう</p></div>";
            }
                
        }

        echo '<br/><br/>';      //改行
        echo '<input type="hidden" name="month" value="' . $month . '">'; 
        /****カレンダーに戻るリンク設定****/
        echo "<input type='submit' value='カレンダーに戻る' size='5'  style='font:15pt MS ゴシック; width:200px; height:60px'/>";

        
    ?>

    </center>

</body>
</form>
</html>

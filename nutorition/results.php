<!--
********************************************
*結果表示画面
*Name: T.S
*CreateDate: 2020/07/15
*Version: 1.10
*Update: 2020/07/24
*******************************************
-->

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>カロリー結果表示</title>
</head>
<header>
      <link rel="stylesheet" href="Booom.css">
      <h1 class="title">カロリー結果表示</h1>
</header>
<body>
    <link rel="stylesheet" href="Booom.css">

    <?php
    //データベース接続情報ファイル
    require_once('../config.php');

    //セッションスタート
    //session_start();
    //$id=$_SESSION[''];                                                        //セッションのゆーざーIDの格納
    //$name=$_SESSION[''];
    //$date=$_SESSION[''];                                                 //セッションの日付
    $id="bbbbb";
    $name="塩谷友浩";
    $date="2020-07-25";
    
    $error_code=0;
    /****タイトル表示****/
     echo "<br/>";
     echo "<h2 class='title'>";
     echo $name;
     echo " さんの ";
     /*echo substr($date,0,4);
     echo "年";*/
     echo substr($date,5,2);
     echo "月";
     echo substr($date,8,2);
     echo "日";
     echo " のカロリー評価</h2>";

     echo "<br/>";      //改行
     echo "<br/>"; 

        try{
   
            /*ユーザーID＆日付で検索する*/
            $sql = "select * from nutritionreg_table where UserID = ? and Date = ? ";                             //SQL文
            $stmt = $pdo->prepare($sql);                                //SQL文のセットとデータベースへ接続
            $stmt->execute([$id,$date]);                                     //フォーム情報をSQL文にセットし実行       
          
            /*****摂取コーナー！！！******/
            echo "<div class='block_a'>";                               //2段組左の設定
            echo "<div class='title-box2-a'>";
            echo "<div class='title-box2-title-a'>総摂取カロリー</div>";
           
            echo "<p>";
            $eats=0;                                                    //総摂取カロリーを0で初期化
            
            echo "<textarea name='' cols=36% rows=13% >";             //摂取内訳テキストボックス
            
                foreach($stmt as $row){
                    if(empty($row['Date'])){        /*えらーしょり　*/
                        break;
                    }
                    echo $name=$row['DetaName']."：";                    //登録データ名の取得
                    echo $calorie=$row['Calorie']." kcal ";   //登録されたカロリーと個数の積
                    echo "\n";
                    $a=$row['Calorie'];                       //登録されたカロリーと個数の積
                    $eats = $eats + $a;                                     //総摂取カロリーの計算
                }
                echo "</textarea>";
                /*えらーしょり　*/
                if(empty($row['Date'])){
                    $error_code = 200;
                }else{

                
                echo "<h3 align='center'>";                                     //中央揃え
                echo $eats;                                                     //総摂取カロリーの表示
                echo " kcal</h3>";
                }
                echo "</p></div></div>";
            
                

        }catch(Exception $e){
            $error_code = 900;           //データベースに接続できなかった場合
        }
        

        try{

            $sql = "select * from momentreg_table where UserID = ? and Date = ?";    //SQL文
            $stmt = $pdo->prepare($sql);     //SQL文のセットとデータベースへ接続
            $stmt->execute([$id,$date]);             //フォーム情報をSQL文にセットし実行
            
            /*****消費コーナー！！！！******/
            echo "<div class='block_b'>";       //2段組み右設定
            echo "<div class='title-box2-b'>";
            echo "<div class='title-box2-title-b'>総消費カロリー</div>";

            echo "<p>";
            $total2=0;      //総消費カロリー変数の初期化
            echo "<textarea name='' cols=36% rows=13% >";     //消費内訳テキストボックス
            
                foreach($stmt as $row){
                    if(empty($row['Date'])){        /*えらーしょり　*/
                    break;
                    }
                    echo $row['Method']."：";       //運動名の取得
                    $a=$row['Calorie'];    //消費カロリーの算出
                    echo $a." kcal";                        //消費カロリーの表示
                    echo "      ".$row['WorkTime']."分\n";   //運動時間の表示
                    $total2 = $total2 + $a;             //総消費カロリーの算出
                }
                echo "</textarea>";
                /*えらーしょり　*/
                if(empty($row['Date'])){
                    $error_code = 200;
                }else{
                
                
                echo "<h3 align='center'>";                
                echo $total2;       //総消費カロリーの表示
                echo " kcal</h3>";
                }
                echo "</p></div></div>";
                
            echo "<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";    //表示エリア分割
            
        }catch(Exception $e){
            $error_code = 900;           //データベースに接続できなかった場合
        }
             
        /*エラーコメント */
        if($error_code==900){
            echo "<center><h1>でーたべーすえらー</h1></center>";
        }else if($error_code==200){
            echo "<center><h1>内容が登録されていません<br/>登録をお願いします</h1></center>";
        }else{

        
            /*****差分******/
            echo "<div class='title-box2-c'>";
            echo "<div class='title-box2-title-c'>カロリーの差</div>";

            echo "<h3 align='center'>";
            echo "＿人人人人人人＿<br/>";
            echo "＞　".$sa = $eats - $total2."";       //総消費カロリーと総摂取カロリーの差分
            echo "kcal　＜<br/>";
            echo "￣^Y^Y^Y^Y^￣<br/></h3>";
            if($sa>100){      
                echo "<div class='flame01'><p align='center'>ウォーキング20分強程度です</p></div>";
            }elseif($sa>200){      
                echo "<div class='flame01'><p align='center'>ウォーキング40分強程度です</p></div>";
            }elseif($sa>300){      
                echo "<div class='flame01'><p align='center'>ランニング30分程度です</p></div>";
            }elseif($sa>400){      
                echo "<div class='flame01'><p align='center'>ランニング40分程度です</p></div>";
            }elseif($sa>500){      
                echo "<div class='flame01'><p align='center'>ランニング50分程度です</p></div>";
            }elseif($sa>1000){         
                echo "<div class='flame01'><p align='center'>5.5km遠泳分程度です</p></div>";            
            }elseif($sa<-1000){       
                echo "<div class='flame01'><p align='center'>和牛のサーロインステーキ200g程度の差です</p></div>";
            }elseif($sa<-500){       
                echo "<div class='flame01'><p align='center'>きのこの山1箱分です</p></div>";
            }elseif($sa<-400){      
                echo "<div class='flame01'><p align='center'>マクドナルドのポテトMサイズ分程度です</p></div>";
            }elseif($sa<-300){      
                echo "<div class='flame01'><p align='center'>じゃがりこサラダ味1箱分です</p></div>";
            }elseif($sa<-200){      
                echo "<div class='flame01'><p align='center'>リンゴ1個分です</p></div>";
            }elseif($sa<-100){      
                echo "<div class='flame01'><p align='center'>リンゴ1/2個程度です</p></div>";
            }else{                  
                echo "<div class='flame01'><p align='center'>その調子です！</p></div>";
            }
                echo "</div>";
        }

            ?>
            <!--/*****OKボタン******/-->
            <br/><p align='center'><a href='https://www.dpt-inc.co.jp'><input type='button' value='OK' name='button' style='width:400px;height:100px;font-size:50px;font-weight:bold'></p></a><br/>
        
        
        
    
</body>
</html>

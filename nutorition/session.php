<?php
    session_start();

    //session_idを新しく生成し、置き換える
    //session_regenerate_id(true); 

    $_SESSION['Year']=$_POST['year'];
    $_SESSION['Month']=$_POST['month'];
    $_SESSION['Day']=$_POST['day'];

    echo($_SESSION['Month']);
    header('Location:user_information.php')
?>

<?php
session_start();
var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
    if(!empty($_POST)){
        $i = 1;
        while($i<=4){
            if(!empty($_POST['open_navbar'.$i])){
                $_SESSION['class'.$i]='open';
                if(!isset($_SESSION['jeu'])){
                $_SESSION['jeu']=$_POST['open_navbar'.$i];
                }
                if($_SESSION['jeu']==$_POST['open_navbar'.$i]){
                    $_SESSION['class'.$i]='open';
                }
                else{
                    $u=1;
                    while($u<=4){
                    $_SESSION['class'.$u]='close';
                    $u++;
                    }
                    break;
                }
            }
            elseif($_SESSION['class'.$i]=='open')
            {
                $_SESSION['class'.$i]='open';
            }
            else{
                $_SESSION['class'.$i]='close';
            }
        $i++;
        }
    }
    else{
        $i=1;
        while($i<=4){
        $_SESSION['class'.$i]='close';
        $i++;
    }
    }
    if(isset($_SESSION['jeu'])){
        echo $_SESSION['jeu'];
    }
    ?>
    <form>
    <button  action="" formmethod="post" type="submit" name="open_navbar1" value="1"><div class="<?=$_SESSION['class1']?>_base"></div></button>
    <button  action="" formmethod="post" type="submit" name="open_navbar2" value="2"><div class="<?=$_SESSION['class2']?>_base"></div></button>
    <button  action="" formmethod="post" type="submit" name="open_navbar3" value="1"><div class="<?=$_SESSION['class3']?>_base"></div></button>
    <button  action="" formmethod="post" type="submit" name="open_navbar4" value="2"><div class="<?=$_SESSION['class4']?>_base"></div></button>
    </form>
    <a href="deconnexion.php">revenir</a>
</body>
</html>
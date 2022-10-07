<?php
session_start();


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            <p>Name</p>
            <input type="text" name="name" required />

        </label>
        <p><?php if(isset($_SESSION['name'])){
                echo $_SESSION['name'];
            } ?></p>
        <label>
            <p>Number</p>
            <input type="tel" name="number" title="Должно быть не менее 6" required />
        </label>
        <p><?php if(isset($_SESSION['number'])){
                echo $_SESSION['number'];

            } ?></p>

        <label>
            <p>Email</p>
            <input type="email" name="email" required />
        </label>
        <p><?php if(isset($_SESSION['mail'])){
            echo $_SESSION['mail'];

} ?></p>
        <label>
            <p>Сycles</p>
            <input type="number" name="cycles" required />
        </label></br>
        <button class="register-but" type="submit" name="register" id="submit" value="register">Register</button>
    </form>
    <?php if(isset($_SESSION['red'])&&isset($_SESSION['green'])) {  ?>
<p>крассных:<?php
    echo $_SESSION['red'];
    unset($_SESSION['red']);
?>
    зеленых:<?php
       echo $_SESSION['green'];
    unset($_SESSION['green']);
     ?></p>
    <?php } ?>
</body>

</html>
<?php

if(isset($_POST['register'])){
    $i=0;
    $name=$_POST['name'];
    $number=$_POST['number'];
    $email=$_POST['email'];
    $cycles=$_POST['cycles'];

    if(preg_match('/[A-Za-z]/',$name) ){
        $_SESSION['name']=' ';
    }else{
        $i++;
        $_SESSION['name']='Неверное имя, должны быть только латинские буквы';
    }
    if(preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)){
        $_SESSION['mail']=' ';
    } else{
        $i++;
        $_SESSION['mail']='Неверный email';
    }
   if(preg_match("/^((80212|\+375)[\- ]?)?(\(?\d{2}\)?[\- ]?)?[\d\- ]{7,10}$/", $number)){

       $_SESSION['number']=' ';
   }else{
       $i++;
       var_dump($i);
        $_SESSION['number']='Неверный номер';
    }

   if($i==0){
       $response=[
           "red"=>1,
           "green"=>1,
       ];
       for($i=0;$i<$cycles;$i++){
           $r=$response['red'];
           $g=$response['green'];
           $response['red']=$r * 5 + $g * 4;
           $response['green']=$g * 3 + $r * 7;
       }
$_SESSION['red']=$response['red'];
$_SESSION['green']=$response['green'];
   }

    header('Location: /index.php');
}
?>
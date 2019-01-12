<?php
/**
 * Created by PhpStorm.
 * User: phibonachos
 * Date: 21/12/18
 * Time: 13.52
 */
//trim request
$name = $_REQUEST['p'];
$surname = $_REQUEST['q'];
$username = $_REQUEST['r'];
$city = $_REQUEST['s'];
$description = 'ciao sono lucia sono una sirena, può sembrare strano ma è una storia vera, la leggenda su di noi è già la verità.'
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Phibonachos</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="favicon.png">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:300|Concert+One" rel="stylesheet">
</head>
<body>
    <div class="sticky-header">
        <div class="header-logo">
            <h1 class="logishtitle">Herschel</h1>
        </div>
        </div>
    </div>
    <div class="descriptiondiv userinfo">
        <div class="avatarnname">
            <div id="avatar">
                <img src="../img/default_avatar.png" alt="">
            </div>
            <div id="name">
                <h1><?php echo $username;?></h1>
            </div>
        </div>
        <div class="userpropcontainer">
            <ul>
                <li><?php echo $name;?></li>
                <li><?php echo $username;?></li>
                <li class="nobullet"><?php echo $city;?></li>
            </ul>
    </div>
    <div class="userdesc">
        <h1>About me</h1>
        <p><?php echo $description?></p>
    </div>
</body>
</html>

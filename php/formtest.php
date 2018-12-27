<?php
/**
 * Created by PhpStorm.
 * User: phibonachos
 * Date: 17/12/18
 * Time: 14.11
 */

?>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Phibonachos</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" href="favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:300|Concert+One" rel="stylesheet">
</head>

<body id>
<div class="global-header">
    <div class="banner">
        <div class="titlediv main">
            <h1>Form Test!</h1>
        </div>
    </div>
    <div class="titlediv sub">
        <blockquote>
           You might be nato imparato but you still have to test your forms
            <figcaption>-M. Ribaudo</figcaption>
        </blockquote>
    </div>
</div>
<div class="customform">
    <h1>Sign Up!</h1>
    <form action="">
        <div class="inputfield">
            <label for="name">Name</label>
            <input type="text" name="name">
        </div>
        <div class="inputfield">
            <label for="surname">Surname</label>
            <input type="text" name="surname">
        </div>
        <div class="inputfield">
            <label for="username">Username</label>
            <input type="text" name="username">
        </div>
        <div class="inputfield">
            <label for="pw">Password</label>
            <input type="password" name="pw">
        </div>
        <div class="inputfield">
            <label for="pwc">Confirm</label>
            <input type="password" name="pwc">
        </div>
        <div class="inputfield sub">
            <input type="submit" value="Sign Up" name="signupb">
        </div>
    </form>
</div>
<div class="customform">
    <h1>Log In!</h1>
    <form action="sign_in.php" method="post">
        <input type="hidden" name="loginform">
        <div class="inputfield">
            <label for="username">Username</label>
            <input type="text" name="username">
        </div>
        <div class="inputfield">
            <label for="pw">Password</label>
            <input type="password" name="pswd">
        </div>
        <div class="inputfield sub">
            <input type="submit" value="Log In" name="loginb">
        </div>
    </form>
</div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>
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

<!--    <link rel="apple-touch-icon" href="favicon.png">-->
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../css/common.css">
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
        <figure>
            <blockquote>
               You might be nato imparato but you still have to test your forms
            </blockquote>
            <figcaption>-M. Ribaudo</figcaption>
        </figure>
    </div>
</div>
<div>
    <?php
        require '../components/signupform.php';
        require '../components/loginform.php';
    ?>
</div>
<script src="../vendor/jquery/jquery.js"></script>
<script src="../js/common.js"></script>
</body>

</html>
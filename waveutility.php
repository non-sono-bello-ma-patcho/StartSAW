<?php
/**
 * Created by PhpStorm.
 * User: phibonachos
 * Date: 21/12/18
 * Time: 14.37
 */
/*
M0,20
                            L0,100
                            C0,103.7 5,103.7 5,100
                            L5,180
                            C5,183.7 10,183.7 10,180
                            L10,120
                            C10,123.7 15,123.7 15,120
                            L15,110
                            C15,113.7 20,113.7 20,110
                            L20,20
                            Z
*/
$value = trim($_REQUEST["q"]);
$xspan=50;
$maxxspan = 5000;
$yspan=37;
$lastx=0;
$lasty=0;
$maxy = $lasty;
//echo 'M', $lastx, ',', $lasty, ' ';
/*
// creo la prima linea
$lasty = rand(0,20);
echo 'L', $lastx, ',', $lasty, ' ';

// creo la prima curva
echo 'C', $lastx, ',', $lasty+$yspan, ' ', $lastx+$xspan, ',', $lasty+$yspan, ' ', $lastx+$xspan, ',', $lasty, ' ';
$lastx = $lastx+$xspan;
*/
// crea
//chiude
//echo 'L', $lastx, ',0 Z';

function curve($min, $max, $rev){
    global $lastx, $lasty, $xspan, $yspan;

    $lasty = $rev>0? rand($min, $max) : rand($min, $lasty-($yspan+30));

    echo 'L', $lastx, ',', $lasty, ' ';
    // creo la prima curva
    echo 'C', $lastx, ',', $lasty+$yspan*$rev, ' ', $lastx+$xspan, ',', $lasty+$yspan*$rev, ' ', $lastx+$xspan, ',', $lasty, ' ';
    $lastx = $lastx+$xspan;
}

function printlayer($min, $height){
    global $lastx, $lasty;
    $lastx = 0;
    $lasty = 0;
    echo 'M', $lastx, ',', $lasty, ' ';
    for ($i=0; $i<25; $i++) {
        curve($min, $height, $i % 2 === 0 ? 1 : -1);
        echo ' ';
    }
    echo 'L', $lastx, ',0 Z';
}

function printcap(){
    global $lastx;
    // move cursor to the end:
    echo 'M', $lastx, ',', 0, ' ';
    // create bezier curve:
    // define yspan:
    $yspan = $lastx*3/4;
    echo 'C', $lastx, ',', -$yspan, ' 0,', -$yspan, ' 0,0 Z';

}
?>

<html>
<head>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body background="#001021">
<svg viewBox="0 0 1802 1533">
    <g transform="scale(0.5) translate(100,2000) rotate(270)">
        <path d="<?php printlayer(200, 500) ?>" fill="#f3efe0"></path>
        <?php /*
        <path d="<?php printlayer(80, 120) ?>" fill="#ffd25a"></path>
        <path d="<?php printlayer(40, 60) ?>" fill="#fff05a"></path>
        <path d="<?php printlayer(20, 30) ?>" fill="#d6fff6"></path>
        <path d="<?php printcap() ?>" fill="#d6fff6"></path>
 */?>
    </g>
</svg>
</body>
</html>

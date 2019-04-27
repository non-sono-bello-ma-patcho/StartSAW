<?php session_start();
?>
<html>
<head>
	<title>An error occured</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/error.css">
    <style>

        /*html, body {*/
            /*margin: 0 0;*/
            /*padding: 0 0;*/
            /*text-align: center;*/
            /*font-size: 0;*/
            /*height: 100%;*/
            /*width: 100%;*/
        /*}*/
        #gradient-rotate {
            z-index: -2;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
        }
        #trianglify-overlay {
            z-index: -1;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
        }
        #color-stop-1 {
            -webkit-animation: change-color-1 12s ease-in-out infinite alternate;
            animation: change-color-1 12s ease-in-out infinite alternate
        }
        #color-stop-2 {
            -webkit-animation: change-color-2 12s ease-in-out infinite alternate;
            animation: change-color-2 12s ease-in-out infinite alternate
        }
        #color-stop-3 {
            -webkit-animation: change-color-3 12s ease-in-out infinite alternate;
            animation: change-color-3 12s ease-in-out infinite alternate
        }

        @keyframes change-color-1 {
            0% {
                stop-color: #85ffc7
            }
            25% {
                stop-color: #39393a
            }
            50% {
                stop-color: #297373
            }
            75% {
                stop-color: #ff8552
            }
        }
        @keyframes change-color-2 {
            0% {
                stop-color: #297373
            }
            25% {
                stop-color: #85ffc7
            }
            350% {
                stop-color: #ff8552
            }
            75% {
                stop-color: #e6e6e6
            }
        }
        @keyframes change-color-3 {
            0% {
                stop-color: #39393a
            }
            25% {
                stop-color: #ff8552
            }
            50% {
                stop-color: #e6e6e6
            }
            75% {
                stop-color: #297373
            }
        }
    </style>
</head>
<body>
<!--                <img src="../img/error.png" height="300">-->
<div class="row h-100 text-center">
    <div class="col-12 pb-0 mb-1">
        <img src="../img/error.png" class="my-auto" alt="">
    </div>
    <div class="col-6 mx-auto">
        <div class="card my-auto" style="background: rgba(14,18,25, 0.6)">
            <div class="card-header">
                <h6 class="text-white text-center">An Error Occurred</h6>
            </div>
            <div class="card-body ">
                <p class="text-white text-center" style="z-index: 2">
                    <?php

                    switch($_GET['code']){
                        case 400: $text = 'Error 400: Bad Request'; break;
                        case 401: $text = 'Error 401: Unauthorized'; break;
                        case 500: $text = 'Error 500: Internal Server Error'; break;
                        case 501: $text = 'Error 501: Not Implemented'; break;
                        case 503: $text = 'Error 503: Service Unavailable'; break;
                        default:  $text= "unknown http error status";
                    }
                    if(isadmin($_SESSION['id']))
                        $text.= " \n".$_SESSION['last_error'];
                    echo $text;                    //echo $_SESSION['last_error'];

                    ?>
                </p>
            </div>
        </div>

    </div>
    </div>

    <svg id="gradient-rotate" preserveAspectRatio="none" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
            <linearGradient x1="0%" y1="0%" y2="100%" id="a">
                <stop id="color-stop-1" stop-color="#187795" offset="0%"></stop>
                <stop id="color-stop-2" stop-color="#2589bd" offset="65%"></stop>
                <stop id="color-stop-3" stop-color="#258ea6" offset="100%"></stop>
            </linearGradient>
        </defs>
        <path fill="url(#a)" d="M0 0h500v500H0z"></path>
    </svg>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trianglify/2.0.0/trianglify.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script>
            var pattern = Trianglify({
                cell_size: 75,
                variance: 0.75,
                x_colors: ['rgba(255, 255, 255, 0.1)', 'rgba(255, 255, 255, 1)'],
                stroke_width: 0.2,
                width: window.innerWidth,
                height: window.innerHeight
            });
            let svg = pattern.svg();
            svg.id = "trianglify-overlay"
            document.body.appendChild(svg)
        </script>
	</body>
</html>

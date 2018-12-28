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
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="favicon.png">
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Catamaran:300|Concert+One" rel="stylesheet">
    </head>

<body id>
    <div class="global-header">
        <div class="buttondiv">
            <input type="button" value="signup" onclick="loadDiv('templates/signupform.php', 'modalviewer'); showform()">
            <input type="button" value="login">
        </div>
        <div class="modal" id="modalviewer">
        </div>
        <div class="banner">
            <div class="titlediv main">
                <h1>Herschel</h1>
            </div>
        </div>
        <div class="titlediv sub">
            <blockquote>
                That’s the advantage of space.  It’s big enough to hold practically anything, and so, eventually, it does.
                <figcaption>-T. Pratchett</figcaption>
            </blockquote>
        </div>
    </div>
    <svg  viewBox="0 0 1802 500" id="descbg">

        <!-- Deepest comet level -->
        <g transform="translate(400, 400), rotate(135), scale(3)">
                  <path d="
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
                          "
                        fill="#fff05a"
                  ></path>
                <path d="
                        M0,20
                        L0,80
                        C0,83.7 5,83.7 5,80
                        L5,90
                        C5,93.7 10,93.7 10,90
                        L10,110
                        C10,113.7 15,113.7 15,110
                        L15,95
                        C15,98.7 20,98.7 20,95
                        L20,20
                        Z
                        "
                      fill="#ffd25a"
                ></path>
                <path d="
                        M0,20
                        L0,60
                        C0,63.7 5,63.7 5,60
                        L5,80
                        C5,83.7 10,83.7 10,80
                        L10,70
                        C10,73.7 15,73.7 15,70
                        L15,60
                        C15,63.7 20,63.7 20,60
                        L20,20
                        C20,5 0,5 0,20
                        Z
                        "
                      fill="#ffaa5a"
                ></path>
            </g>
            <g transform="translate(1700, 80), rotate(45), scale(1)">
                <path d="M0,0 L0,180 C0,183.7 5,183.7 5,180  L5,160 C5,156.3 10,156.3 10,160  L10,200 C10,203.7 15,203.7 15,200  L15,112 C15,108.3 20,108.3 20,112  L20,187 C20,190.7 25,190.7 25,187  L25,170 C25,166.3 30,166.3 30,170  L30,190 C30,193.7 35,193.7 35,190  L35,0 Z" fill="#424874"></path>
                <path d="M0,0 L0,95 C0,98.7 5,98.7 5,95  L5,78 C5,74.3 10,74.3 10,78  L10,114 C10,117.7 15,117.7 15,114  L15,65 C15,61.3 20,61.3 20,65  L20,98 C20,101.7 25,101.7 25,98  L25,60 C25,56.3 30,56.3 30,60  L30,115 C30,118.7 35,118.7 35,115  L35,0 Z" fill="#ffd25a"></path>
                <path d="M0,0 L0,56 C0,59.7 5,59.7 5,56  L5,36 C5,32.3 10,32.3 10,36  L10,59 C10,62.7 15,62.7 15,59  L15,24 C15,20.3 20,20.3 20,24  L20,45 C20,48.7 25,48.7 25,45  L25,28 C25,24.3 30,24.3 30,28  L30,56 C30,59.7 35,59.7 35,56  L35,0 Z" fill="#fff05a"></path>
                <path d="M0,0 L0,27 C0,30.7 5,30.7 5,27  L5,18 C5,14.3 10,14.3 10,18  L10,20 C10,23.7 15,23.7 15,20  L15,14 C15,10.3 20,10.3 20,14  L20,30 C20,33.7 25,33.7 25,30  L25,13 C25,9.3 30,9.3 30,13  L30,20 C30,23.7 35,23.7 35,20  L35,0 Z" fill="#d6fff6"></path>
                <path d="M35,0 C35,-26.25 0,-26.25 0,0 Z" fill="#d6fff6"></path>
            </g>
            <g transform="translate(1500, 500), rotate(50), scale(0.6)">
                <path d="M0,0 L0,183 C0,186.7 5,186.7 5,183  L5,109 C5,105.3 10,105.3 10,109  L10,198 C10,201.7 15,201.7 15,198  L15,109 C15,105.3 20,105.3 20,109  L20,196 C20,199.7 25,199.7 25,196  L25,144 C25,140.3 30,140.3 30,144  L30,192 C30,195.7 35,195.7 35,192  L35,0 Z" fill="#424874"></path>
                <path d="M0,0 L0,118 C0,121.7 5,121.7 5,118  L5,74 C5,70.3 10,70.3 10,74  L10,86 C10,89.7 15,89.7 15,86  L15,53 C15,49.3 20,49.3 20,53  L20,104 C20,107.7 25,107.7 25,104  L25,65 C25,61.3 30,61.3 30,65  L30,113 C30,116.7 35,116.7 35,113  L35,0 Z" fill="#ffd25a"></path>
                <path d="M0,0 L0,40 C0,43.7 5,43.7 5,40  L5,20 C5,16.3 10,16.3 10,20  L10,55 C10,58.7 15,58.7 15,55  L15,34 C15,30.3 20,30.3 20,34  L20,53 C20,56.7 25,56.7 25,53  L25,31 C25,27.3 30,27.3 30,31  L30,43 C30,46.7 35,46.7 35,43  L35,0 Z" fill="#fff05a"></path>
                <path d="M0,0 L0,27 C0,30.7 5,30.7 5,27  L5,18 C5,14.3 10,14.3 10,18  L10,26 C10,29.7 15,29.7 15,26  L15,11 C15,7.3 20,7.3 20,11  L20,24 C20,27.7 25,27.7 25,24  L25,12 C25,8.3 30,8.3 30,12  L30,21 C30,24.7 35,24.7 35,21  L35,0 Z" fill="#d6fff6"></path>
                <path d="M35,0 C35,-26.25 0,-26.25 0,0 Z" fill="#d6fff6"></path>
            </g>
    </svg>
    <div class="descriptiondiv">
        <h1>Chi siamo</h1>
        <p>Herschel è la prima piattaforma che ti permette di prenotare le tue vacanze extra terrestri!</p>
        <pre>
            La memoria è venuta meno
            per fare spazio a poche parole chiave,
            ave avi,
            abbiamo dimenticato i vostri racconti
            Esterno il ricordo
            comune il sapere certe le fonti
            comodo, domotico, modifico
            la casa stando fermo
            Condizionare l'aria in terza persona
            non sento più freddo non provo dolore
            sono e non sono un giovane
            illuminato
            a risparmio energetico
            io sono un giovane illuminato
            da una realtà che non conosco più
        </pre>
    </div>
    <svg  viewBox="0 0 1800 750">
        <g transform="scale(1.5, -1.5) translate(-10,-530)">
            <path d="M0,0 L0,442 C0,479 50,479 50,442  L50,297 C50,260 100,260 100,297  L100,458 C100,495 150,495 150,458  L150,250 C150,213 200,213 200,250  L200,464 C200,501 250,501 250,464  L250,227 C250,190 300,190 300,227  L300,289 C300,326 350,326 350,289  L350,205 C350,168 400,168 400,205  L400,216 C400,253 450,253 450,216  L450,189 C450,152 500,152 500,189  L500,265 C500,302 550,302 550,265  L550,200 C550,163 600,163 600,200  L600,374 C600,411 650,411 650,374  L650,241 C650,204 700,204 700,241  L700,236 C700,273 750,273 750,236  L750,172 C750,135 800,135 800,172  L800,346 C800,383 850,383 850,346  L850,277 C850,240 900,240 900,277  L900,284 C900,321 950,321 950,284  L950,202 C950,165 1000,165 1000,202  L1000,213 C1000,250 1050,250 1050,213  L1050,157 C1050,120 1100,120 1100,157  L1100,317 C1100,354 1150,354 1150,317  L1150,204 C1150,167 1200,167 1200,204  L1200,447 C1200,484 1250,484 1250,447  L1250,0 Z" fill="#ded6d6"></path>
            </path>
        </g>
        <g transform="scale(1.5, -1.5) translate(0,-528)">
            <path d="M0,0 L0,442 C0,479 50,479 50,442  L50,297 C50,260 100,260 100,297  L100,458 C100,495 150,495 150,458  L150,250 C150,213 200,213 200,250  L200,464 C200,501 250,501 250,464  L250,227 C250,190 300,190 300,227  L300,289 C300,326 350,326 350,289  L350,205 C350,168 400,168 400,205  L400,216 C400,253 450,253 450,216  L450,189 C450,152 500,152 500,189  L500,265 C500,302 550,302 550,265  L550,200 C550,163 600,163 600,200  L600,374 C600,411 650,411 650,374  L650,241 C650,204 700,204 700,241  L700,236 C700,273 750,273 750,236  L750,172 C750,135 800,135 800,172  L800,346 C800,383 850,383 850,346  L850,277 C850,240 900,240 900,277  L900,284 C900,321 950,321 950,284  L950,202 C950,165 1000,165 1000,202  L1000,213 C1000,250 1050,250 1050,213  L1050,157 C1050,120 1100,120 1100,157  L1100,317 C1100,354 1150,354 1150,317  L1150,204 C1150,167 1200,167 1200,204  L1200,447 C1200,484 1250,484 1250,447  L1250,0 Z" fill="#f9e7e7"></path>
            </path>
        </g>
        <g transform="scale(25) translate(10,20)">
            <path d="M9,5 L9,10 L17,10 L17,5 Z" fill="#6d8ea0"></path>
            <path d="M0,0 L0,10 L19,10 L19,7 Q19,6 18,6 L13,6 Q12,6 12,7 L8,7 L8,0 Z" fill="#ded6d6"></path>
            <path d="M2,0 L6,0 L6,10 L2,10 Z M12,10 L12.5,10 L12.5,7 Q12.5,6.5 13,6.5 L14,6.5 L14,7 L17,7 L 17,6.5 L18,6.5 Q18.5,6.5 18.5,7 L18.5,10 L19,10 L19,7 Q19,6 18,6 L13,6 Q12,6 12,7" fill="#182825"></path>
            <path d="M18,4 Q18,6 20,6" fill="#eff9f0"></path>
            <circle r="1" cx="4" cy="2" fill="#016fb9"></circle>
            <path d="M3,2.5 C3,3 5.5,1.5 5,1.5 C5.4,1.6 3.1,2.9 3,2.5 " stroke="red" fill="transparent"></path>
        </g>
    </svg>
    <div class="productpreview">
        <div class="singleitem"></div>
        <div class="singleitem"></div>
        <div class="singleitem"></div>
        <div class="singleitem"></div>
        <div class="singleitem"></div>
        <div class="singleitem"></div>

    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
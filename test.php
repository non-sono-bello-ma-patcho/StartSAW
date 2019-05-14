







<?php
session_start();
require_once "databaseUtility.php";
require_once "productUtility.php";

?>


<html>
    <body>
        <div align="center">
            <?php
            /*
                  $myarray = array();
                  $myarray = getEntireProductsColumn("name");
                  foreach ($myarray as $item){
                      echo $item." ///// ";
                  }

            $myarray2 = getEntireProductRow("1");
            foreach ($myarray2 as $item){
                echo $item." ///// ";
            }
            */
            $myarray = array();
            $myarray = getAllProducts();
            foreach ($myarray as $item){
                echo $item." ///// ";
            }
                  ?>
        </div>

    </body>
</html>
<!--

<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Private Page - Herschel</title>


        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/private.css">
        <link rel="stylesheet" href="../css/grayscale.css">
        <link rel="stylesheet" href="../css/common.css">
        <link rel="stylesheet" href="../vendor/fontawesome-free/css/all.css">
    </head>
    <body>
        <div class="tab-content" id="usercontent">
            <div class="row">
                <div class="col-md-6">
                    <label class="text-muted" for="newusername">Search within our catalogue</label>
                    <div class="input-group">
                        <input type="text" name="itemsearchID" id="itemsearch" placeholder="Type something..." class="form-control rightcorners" style="border-top-right-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                        <div class="input-group-append">

                            <a onclick="load_search_result()">
                                <span class="input-group-text glyphicon glyphicon-search" style="top: 0!important; border-top-left-radius: 0; border-bottom-left-radius: 0;">search</span>
                            </a>

                        </div>
                    </div>
                    <input type="radio" name="orderby" id="order_by_min_price" value="lowest price" > lowest price <br>
                    <input type="radio" name="orderby" id="order_by_max_price" value="hightest price" >hightest price <br>
                    <input type="radio" name="orderby" id="order_by_relevance" value="relevance" > relevance <br>
                    <input type = "submit" onclick="load_search_result()">
                </div>
            </div>
            <div id="item-search-results"></div>
        </div>
    <script src ="../js/popper.min.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/private.js"></script>
    <script src="../js/common.js"></script>
    </body>
</html>

-->
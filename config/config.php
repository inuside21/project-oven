<?php

    // database
    // =========================================================
    // Declare
    //$connection = mysqli_connect("localhost","root","","eetech-n2");
    $connection = mysqli_connect("localhost","","~Orenzo0912","");

    // Define Date
    date_default_timezone_set("Asia/Manila");
    $date = new DateTime();
    $dateResult = $date->format('Y-m-d H:i:s');
    $dateOnlyResult = $date->format('Y-m-d');
    $dateOnlyResultYearMonth = $date->format('Y-m');
    $dateOnlyResultYear = $date->format('Y');
?>
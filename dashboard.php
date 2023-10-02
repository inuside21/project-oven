<?php

    // Database
    include("config/config.php");

    /*
    // Check
    // =============================
    {
        // ID
        // --------------------------
        if (!isset($_GET['id']))
        {
            // redirect
            //header("Location: areaadd.php?info");
            //exit();
        }
    }
    */

    // Fetch
    // =============================
    {
        /*
        // Fetch Cabinet
        // --------------------------
        {
            $rowCabinet = array();
            $sql = "select * from device_tbl";
            $rsCabinet = mysqli_query($connection, $sql);
            $rsCabinetRowCount = mysqli_num_rows($rsCabinet);
            if ($rsCabinetRowCount > 0)
            {
                while ($rowsCabinet = mysqli_fetch_object($rsCabinet))
                {
                    $rowCabinet[] = $rowsCabinet;
                }
            }
            else
            {
                // redirect
                //header("Location: cabinetlist.php");
                //exit();
            }
        }
        */

        /*
        // Fetch Area
        // --------------------------
        {
            $rowArea = array();
            $sql = "select * from area_tbl";
            $rsArea = mysqli_query($connection, $sql);
            $rsAreaRowCount = mysqli_num_rows($rsArea);
            if ($rsAreaRowCount > 0)
            {
                while ($rowsArea = mysqli_fetch_object($rsArea))
                {
                    $rowArea[] = $rowsArea;
                }
            }
            else
            {
                // redirect
                header("Location: areaadd.php?info");
                exit();
            }
        }
        */
    }
?>

<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset=utf-8>
        <meta http-equiv=X-UA-Compatible content="IE=edge">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <meta name=description content="">
        <meta name=author content="">
        <title><?php echo $contentPageTitle; ?></title>
        <?php
            // ================
            // CSS
            // ================ 
            echo $contentPageCSS; 
        ?>
    </head> 
    <body>
        <div id=wrapper class="wrapper animsition">

            <!-- Menu Header -->
            <nav class="navbar navbar-fixed-top" role=navigation>
                <div class=navbar-header>
                    <button type=button class=navbar-toggle data-toggle=collapse data-target=.navbar-collapse>
                        <span class=sr-only>Toggle navigation</span>
                        <i class=material-icons>apps</i>
                    </button>
                    <a class=navbar-brand href="#">
                        <img class="main-logo hidden-xs" src="<?php echo $contentPageLogoSmall; ?>" width="150" height="50" alt="">
                    </a>
                </div>
                <div class=nav-container>

                    <!-- Menu Header [Left] -->
                    <ul class="nav navbar-nav hidden-xs">
                        <li><a id=fullscreen href="#"><i class=material-icons>fullscreen</i> </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle material-ripple" data-toggle=dropdown>Welcome Back! <span id="userFname"></span></a>
                        </li>
                    </ul>

                    <!-- Menu Header [Right] -->
                    <ul class="nav navbar-top-links navbar-right">
                        
                    </ul>
                </div>
            </nav>

            <!-- Menu Side -->
            <?php echo $configMenu; ?>
            <?php echo $configMenu2; ?>

            <!-- Main Content -->
            <div id=page-wrapper>
                <div class=content>
                    <div class=content-header>
                        <div class=header-icon>
                            <i class=pe-7s-display1></i>
                        </div>
                        <div class=header-title>
                            <h1>Dashboard</h1>
                            <small>Navigate left menu to view or modify app content</small>
                            <ol class=breadcrumb>
                                <li class=active><a href=dashboard.php><i class=pe-7s-home></i> Home</a></li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <a href="">
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-number1">---</span><span class="slight"></span></h2>
                                    <div class="small">Total Oven</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class=row style="display: none;">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <i class="ti-panel"></i>
                                        <h4>Total Item Quantity Stored Per Area</h4>
                                    </div>
                                    <div class=n2Status>
                                        <br><br>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="chartdivTotal1"></div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <i class="ti-panel"></i>
                                        <h4>Total Item w/ Alert Level Stored Per Area</h4>
                                    </div>
                                    <div class=n2Status>
                                        <br><br>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div id="chartdivTotal2"></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
            // ================
            // JS
            // ================
            echo $contentPageJS; 
        ?>


        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
                $(".progress-animated").each(function () {
                    each_bar_width = $(this).attr('aria-valuenow');
                    $(this).width(each_bar_width + '%');
                });     

                //Sparklines Charts
                $('.sparkline1').sparkline([4,1000], {
                    type: 'bar',
                    barColor: '#fff',
                    height: '40',
                    barWidth: '3',
                    barSpacing: 2
                });
            });


            // Variables
            // ===========================
            var chart1;
            var chart2;


            // Start
            // ===========================
            LoadUser();
            //LoadChart1();
            //LoadChart2();
            LoadDataDashboard1();
            
            
            // Loop
            // ===========================
            setInterval(function() {
                
            }, 1000);


            // Function
            // ===========================
            // Load User
            function LoadUser() {
                $.ajax({
                    type: "POST",
                    url: "server/api.php?mode=userverifytoken",
                    data: JSON.stringify({ "utoken": localStorage.getItem("tokenId") }),
                    success: function(data) {
                        // result
                        const result = JSON.parse(data);

                        // check
                        if (result.status == "ok")
                        {
                            // display
                            $('#userFname').text(result.data.user_fname.toUpperCase());

                            // check admin
                            if (result.data.user_pos == "0")
                            {
                                $('[id="admmenu"]').show();
                                $('[id="opmenu"]').hide();
                            }
                            else
                            {
                                $('[id="admmenu"]').hide();
                                $('[id="opmenu"]').show();
                            }
                        }
                        else
                        {
                            window.location.href = "login.php";
                        }
                    },
                    error: function(data) {
                        window.location.href = "login.php";
                    }
                });
            }

            // Logout User
            $('[id="uLogout"]').click(function(e) {
                localStorage.setItem("tokenId", "");
                window.location.href = "login.php";
            });

            // Load Chart 1 
            function LoadChart1()
            {
                // Load Chart
                chart1 = AmCharts.makeChart("chartdivTotal1", {
                    "type": "serial",
                    "theme": "light",
                    "precision": 2,
                    "valueAxes": [{
                            "id": "v1",
                            "title": "Item Quantity",
                            "position": "left",
                            "minimum": 0,
                            "maximum": 100,
                            "autoGridCount": false,
                        }],
                    "graphs": [{
                            "id": "g1",
                            "valueAxis": "v1",
                            "lineColor": "#5b69bc",
                            "fillColors": "#5b69bc",
                            "fillAlphas": 1,
                            "type": "column",
                            "title": "Item Quantity",
                            "clustered": false,
                            "columnWidth": 0.5,
                            "valueField": "market1",
                            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
                        }],
                    "chartScrollbar": [{
                        "graph": "g1",
                        "oppositeAxis": false,
                        "offset": 30,
                        "scrollbarHeight": 50,
                        "backgroundAlpha": 0,
                        "selectedBackgroundAlpha": 0.9,
                        "selectedBackgroundColor": "#ffffff",
                        "graphFillAlpha": 0,
                        "graphLineAlpha": 0.5,
                        "selectedGraphFillAlpha": 0,
                        "selectedGraphLineAlpha": 1,
                        "autoGridCount": true,
                        "color": "#AAAAAA"
                    }, {
                        "graph": "g2",
                        "oppositeAxis": false,
                        "offset": 30,
                        "scrollbarHeight": 50,
                        "backgroundAlpha": 0,
                        "selectedBackgroundAlpha": 0.9,
                        "selectedBackgroundColor": "#ffffff",
                        "graphFillAlpha": 0,
                        "graphLineAlpha": 0.5,
                        "selectedGraphFillAlpha": 0,
                        "selectedGraphLineAlpha": 1,
                        "autoGridCount": true,
                        "color": "#AAAAAA"
                    }],
                    "chartCursor": {
                        "pan": true,
                        "valueLineEnabled": true,
                        "valueLineBalloonEnabled": true,
                        "cursorAlpha": 0,
                        "valueLineAlpha": 0.2
                    },
                    "categoryField": "date",
                    "categoryAxis": {
                        "dashLength": 1,
                        "minorGridEnabled": false,
                        "labelRotation": 90,
                    },
                    "balloon": {
                        "borderThickness": 1,
                        "shadowAlpha": 0
                    },
                    "dataProvider": [{
                            "date": "2013-01-16",
                            "market1": 71,
                            "market2": 75,
                            "sales1": 5,
                            "sales2": 8
                        }, {
                            "date": "2013-01-17",
                            "market1": 74,
                            "market2": 78,
                            "sales1": 4,
                            "sales2": 6
                        }, {
                            "date": "2013-01-18",
                            "market1": 78,
                            "market2": 88,
                            "sales1": 5,
                            "sales2": 2
                        }, {
                            "date": "2013-01-19",
                            "market1": 85,
                            "market2": 89,
                            "sales1": 8,
                            "sales2": 9
                        }, {
                            "date": "2013-01-20",
                            "market1": 82,
                            "market2": 89,
                            "sales1": 9,
                            "sales2": 6
                        }, {
                            "date": "2013-01-21",
                            "market1": 83,
                            "market2": 85,
                            "sales1": 3,
                            "sales2": 5
                        }, {
                            "date": "2013-01-22",
                            "market1": 88,
                            "market2": 92,
                            "sales1": 5,
                            "sales2": 7
                        }, {
                            "date": "2013-01-23",
                            "market1": 85,
                            "market2": 90,
                            "sales1": 7,
                            "sales2": 6
                        }, {
                            "date": "2013-01-24",
                            "market1": 85,
                            "market2": 91,
                            "sales1": 9,
                            "sales2": 5
                        }, {
                            "date": "2013-01-25",
                            "market1": 80,
                            "market2": 84,
                            "sales1": 5,
                            "sales2": 8
                        }, {
                            "date": "2013-01-26",
                            "market1": 87,
                            "market2": 92,
                            "sales1": 4,
                            "sales2": 8
                        }, {
                            "date": "2013-01-27",
                            "market1": 84,
                            "market2": 87,
                            "sales1": 3,
                            "sales2": 4
                        }, {
                            "date": "2013-01-28",
                            "market1": 83,
                            "market2": 88,
                            "sales1": 5,
                            "sales2": 7
                        }, {
                            "date": "2013-01-29",
                            "market1": 84,
                            "market2": 87,
                            "sales1": 5,
                            "sales2": 8
                        }, {
                            "date": "2013-01-30",
                            "market1": 81,
                            "market2": 85,
                            "sales1": 4,
                            "sales2": 7
                        }]
                });
            }

            // Load Chart 2
            function LoadChart2()
            {
                // Load Chart
                chart2 = AmCharts.makeChart("chartdivTotal2", {
                    "type": "serial",
                    "theme": "light",
                    "precision": 2,
                    "valueAxes": [{
                            "id": "v1",
                            "title": "Item Quantity",
                            "position": "left",
                            "minimum": 0,
                            "maximum": 100,
                            "autoGridCount": false,
                        }],
                    "graphs": [{
                            "id": "g1",
                            "valueAxis": "v1",
                            "lineColor": "#E5343D",
                            "fillColors": "#E5343D",
                            "fillAlphas": 1,
                            "type": "column",
                            "title": "Item Quantity",
                            "clustered": false,
                            "columnWidth": 0.5,
                            "valueField": "market1",
                            "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
                        }],
                    "chartScrollbar": [{
                        "graph": "g1",
                        "oppositeAxis": false,
                        "offset": 30,
                        "scrollbarHeight": 50,
                        "backgroundAlpha": 0,
                        "selectedBackgroundAlpha": 0.9,
                        "selectedBackgroundColor": "#ffffff",
                        "graphFillAlpha": 0,
                        "graphLineAlpha": 0.5,
                        "selectedGraphFillAlpha": 0,
                        "selectedGraphLineAlpha": 1,
                        "autoGridCount": true,
                        "color": "#AAAAAA"
                    }, {
                        "graph": "g2",
                        "oppositeAxis": false,
                        "offset": 30,
                        "scrollbarHeight": 50,
                        "backgroundAlpha": 0,
                        "selectedBackgroundAlpha": 0.9,
                        "selectedBackgroundColor": "#ffffff",
                        "graphFillAlpha": 0,
                        "graphLineAlpha": 0.5,
                        "selectedGraphFillAlpha": 0,
                        "selectedGraphLineAlpha": 1,
                        "autoGridCount": true,
                        "color": "#AAAAAA"
                    }],
                    "chartCursor": {
                        "pan": true,
                        "valueLineEnabled": true,
                        "valueLineBalloonEnabled": true,
                        "cursorAlpha": 0,
                        "valueLineAlpha": 0.2
                    },
                    "categoryField": "date",
                    "categoryAxis": {
                        "dashLength": 1,
                        "minorGridEnabled": false,
                        "labelRotation": 90,
                    },
                    "balloon": {
                        "borderThickness": 1,
                        "shadowAlpha": 0
                    },
                    "dataProvider": [{
                            "date": "2013-01-16",
                            "market1": 71,
                            "market2": 75,
                            "sales1": 5,
                            "sales2": 8
                        }, {
                            "date": "2013-01-17",
                            "market1": 74,
                            "market2": 78,
                            "sales1": 4,
                            "sales2": 6
                        }, {
                            "date": "2013-01-18",
                            "market1": 78,
                            "market2": 88,
                            "sales1": 5,
                            "sales2": 2
                        }, {
                            "date": "2013-01-19",
                            "market1": 85,
                            "market2": 89,
                            "sales1": 8,
                            "sales2": 9
                        }, {
                            "date": "2013-01-20",
                            "market1": 82,
                            "market2": 89,
                            "sales1": 9,
                            "sales2": 6
                        }, {
                            "date": "2013-01-21",
                            "market1": 83,
                            "market2": 85,
                            "sales1": 3,
                            "sales2": 5
                        }, {
                            "date": "2013-01-22",
                            "market1": 88,
                            "market2": 92,
                            "sales1": 5,
                            "sales2": 7
                        }, {
                            "date": "2013-01-23",
                            "market1": 85,
                            "market2": 90,
                            "sales1": 7,
                            "sales2": 6
                        }, {
                            "date": "2013-01-24",
                            "market1": 85,
                            "market2": 91,
                            "sales1": 9,
                            "sales2": 5
                        }, {
                            "date": "2013-01-25",
                            "market1": 80,
                            "market2": 84,
                            "sales1": 5,
                            "sales2": 8
                        }, {
                            "date": "2013-01-26",
                            "market1": 87,
                            "market2": 92,
                            "sales1": 4,
                            "sales2": 8
                        }, {
                            "date": "2013-01-27",
                            "market1": 84,
                            "market2": 87,
                            "sales1": 3,
                            "sales2": 4
                        }, {
                            "date": "2013-01-28",
                            "market1": 83,
                            "market2": 88,
                            "sales1": 5,
                            "sales2": 7
                        }, {
                            "date": "2013-01-29",
                            "market1": 84,
                            "market2": 87,
                            "sales1": 5,
                            "sales2": 8
                        }, {
                            "date": "2013-01-30",
                            "market1": 81,
                            "market2": 85,
                            "sales1": 4,
                            "sales2": 7
                        }]
                });
            }

            // Load Dashboard 1
            function LoadDataDashboard1()
            {
                $.ajax({
                    type: "POST",
                    url: "server/api.php?mode=dashboard1",
                    data: {},
                    success: function(data) {
                        // result
                        const result = JSON.parse(data);

                        // check
                        if (result.status == "ok")
                        {
                            // display
                            $('#count-number1').text(result.data);
                        }
                        else
                        {
                            //window.location.href = "aitemlist.php";
                        }
                    },
                    error: function(data) {
                        //window.location.href = "aitemlist.php";
                    }
                });
            }
        </script>
    </body>
</html>

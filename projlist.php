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

            <!-- Main Content -->
            <div id=page-wrapper>
                <div class=content>
                    <div class=content-header>
                        <div class=header-icon>
                            <i class=pe-7s-box1></i>
                        </div>
                        <div class=header-title>
                            <h1>Project List</h1>
                            <small>List of all project</small>
                            <ol class=breadcrumb>
                                <li class=active><a href=dashboard.php><i class=pe-7s-home></i> Home</a></li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class=row>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class=row>
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h4>Project List</h4> <br>
                                            <h5>Click on item name to view details</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Name</th>
                                                    <th>Dept.</th>
                                                    <th>Customer</th>
                                                    <th>PO #</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
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
            });


            // Variables
            // ===========================
            const params = new URLSearchParams(window.location.search);
            const getId = params.get('d');
            

            // Start
            // ===========================
            LoadUser();
            
            
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
                                $('[id="isadmin"]').hide();
                                //window.location.href = "dashboard.php";
                            }

                            LoadTable(result.data.id);
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
            $('#uLogout').click(function(e) {
                localStorage.setItem("tokenId", "");
                window.location.href = "login.php";
            });

            // Load Table
            function LoadTable(uid)
            {   
                $("#dataTableExample1").DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel'
                    ],
                    aaSorting: [],
                    ajax: {
                        url: 'server/api.php?mode=projlist4&uid=' + encodeURIComponent(uid),
                        dataSrc: 'data',
                    },
                    columns: [
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.proj_type.toUpperCase();
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return '<center><a href="projview.php?id=' + data.id + '"><h4><b>' + data.proj_name + '</b></h4></a><center>';
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.proj_dept.toUpperCase();
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.proj_clientText + " <br> " + data.proj_companyText;
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.proj_po.toUpperCase();
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.proj_date;
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                if (data.proj_status == "0")
                                {
                                    return '<center><span class="label label-pill label-warning">Active</span> <span class="label label-pill label-info">' + data.proj_phaseText + '</span></center>';
                                }

                                if (data.proj_status == "1")
                                {
                                    return '<center><span class="label label-pill label-success">Completed</span> <span class="label label-pill label-info">' + data.proj_phaseText + '</span></center>';
                                }

                                if (data.proj_status == "2")
                                {
                                    return '<center><span class="label label-pill label-danger">Cancelled</span> <span class="label label-pill label-info">' + data.proj_phaseText + '</span></center>';
                                }
                            } 
                        },
                    ]
                });
            }
        </script>
    </body>
</html>

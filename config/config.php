<?php

    // database
    // =========================================================
    // Declare
    $connection = mysqli_connect("localhost","u684904720_ovendb","~Orenzo0912","u684904720_ovendb");   

    // Date
    date_default_timezone_set("Asia/Manila");
    $date = new DateTime();
    $dateResult = $date->format('Y-m-d H:i:s');
    $dateOnlyResult = $date->format('Y-m-d');
    $dateOnlyResultYearMonth = $date->format('Y-m');
    $dateOnlyResultYear = $date->format('Y');

    // Page URL
    $_SESSION['mainUrl'] = "";

    // Content
    $contentPageTitle = "EETech FileSystem";
    $contentPageLogoSmall = "";
    $contentPageLogoLarge = "";

    // CSS
    $contentPageCSS = '
        <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
        <link href="assets/dist/css/base.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/toastr/toastr.min.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/emojionearea/emojionearea.min.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/monthly/monthly.min.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/amcharts/export.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/modals/modal-component.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/component_ui.min.css" rel=stylesheet type="text/css"/>
        <link href="assets/dist/css/custom.css" rel=stylesheet type="text/css"/>
        <link href="assets/plugins/dropzone/dropzone.min.css" rel="stylesheet" type="text/css"/>
    ';

    // JS
    $contentPageJS = '
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
        <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/metisMenu/metisMenu.min.js"></script>
        <script src="assets/plugins/icheck/icheck.min.js"></script>
        <script src="assets/plugins/bootstrap-toggle/bootstrap-toggle.min.js"></script>
        <script src="assets/plugins/bootstrap-toggle/toggle-active.js"></script>
        <script src="assets/plugins/lobipanel/lobipanel.min.js"></script>
        <script src="assets/plugins/animsition/js/animsition.min.js"></script>
        <script src="assets/plugins/bootsnav/js/bootsnav.min.js"></script>
        <script src="assets/plugins/fastclick/fastclick.min.js"></script>
        <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/toastr/toastr.min.js"></script>
        <script src="assets/plugins/sparkline/sparkline.min.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
        <script src="assets/plugins/counterup/waypoints.js"></script>
        <script src="assets/plugins/monthly/monthly.min.js"></script>
        <script src="assets/plugins/amcharts/amcharts.js"></script>
        <script src="assets/plugins/amcharts/ammap.js"></script>
        <script src="assets/plugins/amcharts/worldLow.js"></script>
        <script src="assets/plugins/amcharts/serial.js"></script>
        <script src="assets/plugins/amcharts/export.min.js"></script>
        <script src="assets/plugins/amcharts/dark.js"></script>
        <script src="assets/plugins/amcharts/pie.js"></script>
        <script src="assets/plugins/datatables/dataTables.min.js"></script>
        <script src="assets/plugins/select2/select2.min.js"></script>
        <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
        <script src="assets/plugins/modals/classie.js"></script>
        <script src="assets/plugins/modals/modalEffects.js"></script>
        <script src="assets/dist/js/app.min.js"></script>
        <script src="assets/dist/js/jQuery.style.switcher.min.js"></script>
        <script src="assets/plugins/dropzone/dropzone.min.js"></script>
        <script src="assets/plugins/dropzone/dropzone-active.js"></script> 
    ';

    // API Read ?
    function APIRead($url) 
    {
        $newUrl = $_SESSION['mainUrl'] . $url;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $newUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);
        if(!$json) {
            echo curl_error($ch);
        }
        curl_close($ch);
        return $json;
    }

    // API Read w/ Post ?
    function APIReadPost($url, $post) 
    {
        $newUrl = $_SESSION['mainUrl'] . $url;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $newUrl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);
        if(!$json) {
            echo curl_error($ch);
        }
        curl_close($ch);
        return $json;
    }


    // Inventory Settings Load
    // ======================================
    $sql="select * FROM inv_settings"; 
    $rsgetacc=mysqli_query($connection,$sql);
    while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
    {
        $contentPageTitle = $rowsgetacc->set_title;
        $contentPageLogoSmall = "assets/images/" . $rowsgetacc->set_logo_small; // Place image to assets/images
        $contentPageLogoLarge = "assets/images/" . $rowsgetacc->set_logo_large; // Place image to assets/images
    }

    $sql="select * FROM user_tbl"; 
    $rsgetacc=mysqli_query($connection,$sql);
    while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
    {
        
    }

    // Menu
    $configMenu = '
        <div class=sidebar role=navigation>
            <div class="sidebar-nav navbar-collapse">
                <ul class=nav id=side-menu>
                    <li class="nav-heading "> <span>Main Navigation</span></li>
                    <li class=active><a href=dashboard.php class=material-ripple><i class=material-icons>home</i> Dashboard</a></li>
                    <li><a href="projlist.php" class=material-ripple><i class=material-icons>assignment</i> Project List</a></li>

                    <li class="nav-heading "> <span>User</span></li>
                    <li><a href="#" class=material-ripple id="uLogout"><i class=material-icons>keyboard_backspace</i> Logout</a></li>
                </ul>
            </div>
        </div>
        <div class=control-sidebar-bg></div>
    ';

    
    // department
    $getDepartmentList = array();
    $getDepartmentListByName = array();
    $sql="select * FROM department_tbl"; 
    $rsgetacc=mysqli_query($connection,$sql);
    while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
    {
        $getDepartmentList[] = $rowsgetacc;
        $getDepartmentListByName[$rowsgetacc->dept_name] = $rowsgetacc;
    }

    // company
    $getCompanyList = array();
    $getCompanyListById = array();
    $sql="select * FROM company_tbl"; 
    $rsgetacc=mysqli_query($connection,$sql);
    while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
    {
        $getCompanyList[] = $rowsgetacc;
        $getCompanyListById[$rowsgetacc->id] = $rowsgetacc;
    }

    // customer
    $getCustomerList = array();
    $getCustomerListById = array();
    $sql="select * FROM customer_tbl"; 
    $rsgetacc=mysqli_query($connection,$sql);
    while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
    {
        //
        $rowsgetacc->companyName = $getCompanyListById[$rowsgetacc->cust_companyid]->company_name;

        //
        $getCustomerList[] = $rowsgetacc;
        $getCustomerListById[$rowsgetacc->id] = $rowsgetacc;
    }

    // sales
    $getSalesList = array();
    $getSalesListById = array();
    $sql="select * FROM user_tbl where user_dept = 'sales'"; 
    $rsgetacc=mysqli_query($connection,$sql);
    while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
    {
        //
        $getSalesList[] = $rowsgetacc;
        $getSalesListById[$rowsgetacc->id] = $rowsgetacc;
    }

    // project - status
    $getProjStatusList = [
        "Active",
        "Completed",
        "Cancelled"
    ];

    // project - phase
    $getProjPhaseList = array();
    $getProjPhaseListById = array();
    $sql="select * FROM project_phase_tbl"; 
    $rsgetacc=mysqli_query($connection,$sql);
    while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
    {
        $getProjPhaseList[] = $rowsgetacc;
        $getProjPhaseListById[$rowsgetacc->id] = $rowsgetacc;
    }
?>
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

    /*
    // Fetch
    // =============================
    {
        // Custom
        // --------------------------
        {
            $rowCustom = array();
            $sql = "select * from item_custom_tbl order by custom_pos asc";
            $rsCustom = mysqli_query($connection, $sql);
            $rsCustomCount = mysqli_num_rows($rsCustom);
            if ($rsCustomCount > 0)
            {
                while ($rowsCustom = mysqli_fetch_object($rsCustom))
                {
                    $rowCustom[] = $rowsCustom;
                }
            }
            else
            {
                // redirect
                //header("Location: aareaadd.php");
                //exit();
            }
        }

        // Area
        // --------------------------
        {
            $rowArea = array();
            $sql = "select * from item_warehouse_tbl";
            $rsArea = mysqli_query($connection, $sql);
            $rsAreaCount = mysqli_num_rows($rsArea);
            if ($rsAreaCount > 0)
            {
                while ($rowsArea = mysqli_fetch_object($rsArea))
                {
                    $rowArea[] = $rowsArea;
                }
            }
            else
            {
                // redirect
                //header("Location: aareaadd.php");
                //exit();
            }
        }

        // Supplier
        // --------------------------
        {
            $rowSupplier = array();
            $sql = "select * from item_supplier_tbl";
            $rsSupplier = mysqli_query($connection, $sql);
            $rsSupplierCount = mysqli_num_rows($rsSupplier);
            if ($rsSupplierCount > 0)
            {
                while ($rowsSupplier = mysqli_fetch_object($rsSupplier))
                {
                    $rowSupplier[] = $rowsSupplier;
                }
            }
            else
            {
                // redirect
                //header("Location: asupadd.php");
                //exit();
            }
        }

        // UOM
        // --------------------------
        {
            $rowUOM = array();
            $sql = "select * from item_uom_tbl";
            $rsUOM = mysqli_query($connection, $sql);
            $rsUOMCount = mysqli_num_rows($rsUOM);
            if ($rsUOMCount > 0)
            {
                while ($rowsUOM = mysqli_fetch_object($rsUOM))
                {
                    $rowUOM[] = $rowsUOM;
                }
            }
            else
            {
                // redirect
                //header("Location: aitemuomadd.php");
                //exit();
            }
        }

        // Category
        // --------------------------
        {
            $rowCat = array();
            $sql = "select * from item_cat_tbl";
            $rsCat = mysqli_query($connection, $sql);
            $rsCatCount = mysqli_num_rows($rsCat);
            if ($rsCatCount > 0)
            {
                while ($rowsCat = mysqli_fetch_object($rsCat))
                {
                    $rowCat[] = $rowsCat;
                }
            }
            else
            {
                // redirect
                //header("Location: aitemcatadd.php");
                //exit();
            }
        }
    }
    */
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

                <br>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <a>
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-numberTemp">---</span><span class="slight"></span></h2>
                                    <div class="small">Temperature</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <a>
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-numberCurrent">---</span><span class="slight"></span></h2>
                                    <div class="small">Current</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <a>
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-numberKwh">---</span><span class="slight"></span></h2>
                                    <div class="small">KWH</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <a>
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-numberConnection">---</span><span class="slight"></span></h2>
                                    <div class="small">Connection</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" id="cMenuOperationBtn">
                            <a>
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-numberOperation">---</span><span class="slight"></span></h2>
                                    <div class="small">Operation</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" id="cMenuTimerBtn">
                            <a>
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-numberTimer">---</span><span class="slight"></span></h2>
                                    <div class="small">Timer</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" id="cMenuStockBtn">
                            <a>
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-numberStock">---</span><span class="slight"></span></h2>
                                    <div class="small">Stock</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" id="cMenuLockBtn">
                            <a>
                                <div class="statistic-box statistic-filled-3">
                                    <h2><span class="count-number1" id="count-numberLock">---</span><span class="slight"></span></h2>
                                    <div class="small">Lock</div>
                                    <i class="ti-check-box statistic_icon"></i>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row text-right">
                        <a id="fSubmit">
                            <button type="button" class="btn btn-labeled btn-danger m-b-5">
                                <span class="btn-label"><i class="glyphicon glyphicon-floppy-disk"></i></span>Save
                            </button>
                        </a>
                    </div>

                    <form id="fInfo" enctype="multipart/form-data">
                        <div class=row>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 p-t-30 p-b-30 d-none">
                                <div class="text-center">
                                    <label for="image-upload">
                                    <image id="preview-image" src="files/images/none.png" width="400px" height="400px">
                                    </label>
                                    <br>
                                    Tap to upload image (400x400)
                                    <br>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class=row>
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h4>Oven Information</h4> <br>
                                                <h5>General information of the oven</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group row" style="display: none;">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" id="rId" name="rId" value="" readonly>
                                                            <input class="form-control" type="text" id="rUid" name="rUid" value="" readonly>
                                                            <input class="form-control" type="text" id="rImageOrig" name="rImageOrig" value="" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" style="display: none;">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" id="rImage" name="rImage">
                                                            <input type="file" id="image-upload" name="image-upload" accept="image/*">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Oven Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" id="oName" name="oName">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class=row>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class=row>
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h4>Logs</h4> <br>
                                            <h5>Logging of this oven</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Temp</th>
                                                    <th>Current</th>
                                                    <th>KWH</th>
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

                    <div class="modal fade modal-danger in" id="modal-timer" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h1 class="modal-title"><b style="font-size:80px;"><span id="tTimerMain">00:00:00</span></b><br>HH:MM:SS</h1>
                                </div>
                                <div class="modal-body">
                                    <p>
                                    <form id="fInfoTimer" enctype="multipart/form-data">
                                        <div class="text-center">
                                            <button type="button" class="btn btn-success" id="tTimerHourUpBtn">+1 Hour</button>
                                            <button type="button" class="btn btn-success" id="tTimerHourDownBtn">-1 Hour</button>
                                            <button type="button" class="btn btn-success" id="tTimerMinUpBtn">+1 Minute</button>
                                            <button type="button" class="btn btn-success" id="tTimerMinDownBtn">-1 Minute</button>
                                        </div>
                                    </form>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <div class="modal fade modal-danger in" id="modal-stock" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h1 class="modal-title"><b style="font-size:80px;"><span id="tStockMain">0</span></b></h1>
                                </div>
                                <div class="modal-body">
                                    <p>
                                    <form id="fInfoStock" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Stock</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" id="tStock" name="tStock">
                                            </div>
                                        </div>
                                    </form>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" id="fSubmitStock">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
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

                /*
                $('#pDept').select2();
                $('#pStatus').select2();
                $('#pPhase').select2();
                $('#pCustomer').select2();
                */
            });


            // Variables
            // ===========================
            const params = new URLSearchParams(window.location.search);
            const getId = params.get('id');
            
            var getReqDataOven;
            var table1;


            // Start
            // ===========================
            LoadUser();
            LoadTable();
            

            // Loop
            // ===========================
            setInterval(function() {
                LoadDataOven();
                table1.ajax.reload();
            }, 200);


            // Interaction
            // ==========================
            // Press - Submit
            $('#fSubmit').click(function(e) {
                // check
                swal(
                    {
                        title: "Are you sure?",
                        text: "Pressing the Proceed button will save the data.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#E5343D",
                        confirmButtonText: "Proceed",
                        closeOnConfirm: false
                    },
                    function() {
                        /*
                        // image
                        var file = $('#rImage')[0].files[0];
                        var reader = new FileReader();
                        reader.onload = function() {
                            var base64 = reader.result.replace(/^data:image\/(png|jpeg|jpg);base64,/, '');
                            $('#rWe').val(base64);
                        };
                        reader.readAsDataURL(file);
                        */

                        // form
                        var formData = {};
                        $.each($('#fInfo').serializeArray(), function() {
                            var key = this.name;
                            var value = this.value;
                            if (formData[key] !== undefined) {
                                if (!Array.isArray(formData[key])) {
                                    formData[key] = [formData[key]];
                                }
                                formData[key].push(value);
                            } else {
                                formData[key] = value;
                            }
                        });

                        // request
                        $.ajax({
                            type: "POST",
                            contentType: false,
                            processData: false,
                            url: "server/api.php?mode=ovenedit",
                            data: JSON.stringify(formData),
                            beforeSend: function() {
                                // button
                                $('#fButton').toggle();
                            },
                            success: function(data) {
                                // button
                                $('#fButton').toggle();

                                console.log(data)
                                
                                // result
                                const result = JSON.parse(data);
                               
                                // check
                                if (result.status == "ok")
                                {
                                    //message
                                    swal(result.title, result.message, "success");
                                    setTimeout(() => {
                                        location.reload(true);
                                    }, 1000);
                                }
                                else
                                {
                                    // message
                                    swal(result.title, result.message, "error");
                                }
                            },
                            error: function(data) {
                                // button
                                $('#fButton').toggle();

                                // message
                                swal("Error!", "Something went wrong. Please try again.", "error");
                            }
                        });
                    }
                );
            });

            // Press - Delete
            $('#fDelete').click(function(e) {
                // check
                swal(
                    {
                        title: "Are you sure?",
                        text: "Pressing the Proceed button will REMOVE the data.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#E5343D",
                        confirmButtonText: "Proceed",
                        closeOnConfirm: false
                    },
                    function() {
                        // request
                        $.ajax({
                            type: "POST",
                            contentType: false,
                            processData: false,
                            url: "server/api.php?mode=ovendelete",
                            data: JSON.stringify({
                                dOven: getReqDataOven,
                            }),
                            beforeSend: function() {
                                // button
                                $('#fButton').toggle();
                            },
                            success: function(data) {
                                // button
                                $('#fButton').toggle();
                                
                                // result
                                const result = JSON.parse(data);
                               
                                // check
                                if (result.status == "ok")
                                {
                                    //message
                                    swal(result.title, result.message, "success");
                                    setTimeout(() => {
                                        location.reload(true);
                                    }, 1000);
                                }
                                else
                                {
                                    // message
                                    swal(result.title, result.message, "error");
                                }
                            },
                            error: function(data) {
                                // button
                                $('#fButton').toggle();

                                // message
                                swal("Error!", "Something went wrong. Please try again.", "error");
                            }
                        });
                    }
                );
            });

            // Operation
            $('#cMenuOperationBtn').click(function(e) {
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    url: "server/api.php?mode=ovenoperationedit",
                    data: JSON.stringify({
                        dOven: getReqDataOven,
                    }),
                    beforeSend: function() {
                        // button
                        $('#fButton').toggle();
                    },
                    success: function(data) {
                        // button
                        $('#fButton').toggle();
                        
                        // result
                        console.log(data);
                        const result = JSON.parse(data);
                        
                        
                        // check
                        if (result.status == "ok")
                        {
                            
                        }
                        else
                        {
                            
                        }
                    },
                    error: function(data) {
                        
                    }
                });
            });

            // Timer
            $('#cMenuTimerBtn').click(function(e) {
                $('#modal-timer').modal('show');
            });

            $('#tTimerHourUpBtn').click(function(e) {
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    url: "server/api.php?mode=oventimerhourupedit",
                    data: JSON.stringify({
                        dOven: getReqDataOven,
                    }),
                    beforeSend: function() {
                        // button
                        $('#fButton').toggle();
                    },
                    success: function(data) {
                        // button
                        $('#fButton').toggle();
                        
                        // result
                        const result = JSON.parse(data);
                        
                        // check
                        if (result.status == "ok")
                        {
                            
                        }
                        else
                        {
                            
                        }
                    },
                    error: function(data) {
                        
                    }
                });
            });

            $('#tTimerHourDownBtn').click(function(e) {
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    url: "server/api.php?mode=oventimerhourdownedit",
                    data: JSON.stringify({
                        dOven: getReqDataOven,
                    }),
                    beforeSend: function() {
                        // button
                        $('#fButton').toggle();
                    },
                    success: function(data) {
                        // button
                        $('#fButton').toggle();
                        
                        // result
                        const result = JSON.parse(data);
                        
                        // check
                        if (result.status == "ok")
                        {
                            
                        }
                        else
                        {
                            
                        }
                    },
                    error: function(data) {
                        
                    }
                });
            });

            $('#tTimerMinUpBtn').click(function(e) {
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    url: "server/api.php?mode=oventimerminupedit",
                    data: JSON.stringify({
                        dOven: getReqDataOven,
                    }),
                    beforeSend: function() {
                        // button
                        $('#fButton').toggle();
                    },
                    success: function(data) {
                        // button
                        $('#fButton').toggle();
                        
                        // result
                        const result = JSON.parse(data);
                        
                        // check
                        if (result.status == "ok")
                        {
                            
                        }
                        else
                        {
                            
                        }
                    },
                    error: function(data) {
                        
                    }
                });
            });

            $('#tTimerMinDownBtn').click(function(e) {
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    url: "server/api.php?mode=oventimermindownedit",
                    data: JSON.stringify({
                        dOven: getReqDataOven,
                    }),
                    beforeSend: function() {
                        // button
                        $('#fButton').toggle();
                    },
                    success: function(data) {
                        // button
                        $('#fButton').toggle();
                        
                        // result
                        const result = JSON.parse(data);
                        
                        // check
                        if (result.status == "ok")
                        {
                            
                        }
                        else
                        {
                            
                        }
                    },
                    error: function(data) {
                        
                    }
                });
            });

            // Stock
            $('#cMenuStockBtn').click(function(e) {
                $('#modal-stock').modal('show');
            });

            $('#fSubmitStock').click(function(e) {
                // check
                swal(
                    {
                        title: "Are you sure?",
                        text: "Pressing the Proceed button will save the data.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#E5343D",
                        confirmButtonText: "Proceed",
                        closeOnConfirm: false
                    },
                    function() {
                        /*
                        // image
                        var file = $('#rImage')[0].files[0];
                        var reader = new FileReader();
                        reader.onload = function() {
                            var base64 = reader.result.replace(/^data:image\/(png|jpeg|jpg);base64,/, '');
                            $('#rWe').val(base64);
                        };
                        reader.readAsDataURL(file);
                        */

                        // form
                        var formData = {};
                        $.each($('#fInfoStock').serializeArray(), function() {
                            var key = this.name;
                            var value = this.value;
                            if (formData[key] !== undefined) {
                                if (!Array.isArray(formData[key])) {
                                    formData[key] = [formData[key]];
                                }
                                formData[key].push(value);
                            } else {
                                formData[key] = value;
                            }
                        });

                        // request
                        $.ajax({
                            type: "POST",
                            contentType: false,
                            processData: false,
                            url: "server/api.php?mode=ovenstockedit&oid=" + getId,
                            data: JSON.stringify(formData),
                            beforeSend: function() {
                                // button
                                $('#fButton').toggle();
                            },
                            success: function(data) {
                                // button
                                $('#fButton').toggle();

                                console.log(data)
                                
                                // result
                                const result = JSON.parse(data);
                               
                                // check
                                if (result.status == "ok")
                                {
                                    //message
                                    swal(result.title, result.message, "success");
                                }
                                else
                                {
                                    // message
                                    swal(result.title, result.message, "error");
                                }
                            },
                            error: function(data) {
                                // button
                                $('#fButton').toggle();

                                // message
                                swal("Error!", "Something went wrong. Please try again.", "error");
                            }
                        });
                    }
                );
            });

            // Lock
            $('#cMenuLockBtn').click(function(e) {
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    url: "server/api.php?mode=ovenlockedit",
                    data: JSON.stringify({
                        dOven: getReqDataOven,
                    }),
                    beforeSend: function() {
                        // button
                        $('#fButton').toggle();
                    },
                    success: function(data) {
                        // button
                        $('#fButton').toggle();
                        
                        // result
                        const result = JSON.parse(data);
                        console.log(result.message);
                        
                        // check
                        if (result.status == "ok")
                        {
                            
                        }
                        else
                        {
                            
                        }
                    },
                    error: function(data) {
                        
                    }
                });
            });


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
                            $('#rUid').val(result.data.id);

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

            function LoadDataOven()
            {
                $.ajax({
                    type: "POST",
                    url: "server/api.php?mode=ovenview",
                    data: JSON.stringify({
                        "reqid": getId,
                    }),
                    success: function(data) {
                        // result
                        const result = JSON.parse(data);

                        // check
                        if (result.status == "ok")
                        {
                            getReqDataOven = result.data;
                            
                            // detail
                            $('#dName').text(getReqDataOven.oven_name);
                            //$('#preview-image').attr('src', 'files/images/' + getReqDataProject.proj_img);

                            // form
                            $('#rId').val(getReqDataOven.id);
                            //$('#rImageOrig').val(getReqDataOven.proj_img);
                            $('#oName').val(getReqDataOven.oven_name);

                            //
                            $('#count-numberTemp').text(getReqDataOven.oven_temp + " °C");
                            $('#count-numberCurrent').text(getReqDataOven.oven_current + " A");
                            $('#count-numberKwh').text(getReqDataOven.oven_kwh + " KWH");
                            $('#count-numberConnection').text(getReqDataOven.oven_connected);

                            $('#count-numberOperation').text(getReqDataOven.oven_status);
                            $('#count-numberTimer').text(ConvertIntToTimer(getReqDataOven.oven_timer));
                            $('#count-numberStock').text(getReqDataOven.oven_stock);
                            $('#count-numberLock').text(getReqDataOven.oven_lock);

                            // timer 
                            $('#tTimerMain').text(ConvertIntToTimer(getReqDataOven.oven_timermain));

                            // stock
                            $('#tStockMain').text(getReqDataOven.oven_stock);

                            /*
                            $('#pDept').trigger('change');
                            $('#pStatus').trigger('change');
                            $('#pPhase').trigger('change');
                            $('#pCustomer').trigger('change');
                            */
                        }
                        else
                        {
                            window.location.href = "ovenlist.php";
                        }
                    },
                    error: function(data) {
                        window.location.href = "ovenlist.php";
                    }
                });
            }

            // Load Table
            function LoadTable()
            {
                table1 = $("#dataTableExample1").DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        
                    ],
                    aaSorting: [],
                    ajax: {
                        url: 'server/api.php?mode=ovenloglist&oid=' + getId,
                        dataSrc: 'data',
                    },
                    columns: [
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.oven_date;
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.oven_temp + " °C";
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.oven_current + " A";
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.oven_kwh + " KWH";
                            } 
                        },
                    ]
                });
            }


            // Other
            // ===========================
            function ConvertIntToTimer(getVal) 
            {
                var thisVal = getVal;

                //
                if (thisVal > 0)
                {
                    var hours = Math.floor(thisVal / 3600);
                    var minutes = Math.floor((thisVal - (hours * 3600)) / 60);
                    var seconds = Math.floor(thisVal) - (hours * 3600) - (minutes * 60);
                    var timeString = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);
                    return timeString;
                }

                //
                else
                {
                    return "00:00:00";
                }
            }
        </script>

        <script>
            /* IMAGE SCRIPT */
            const imageUpload = document.getElementById("image-upload");
            const previewImage = document.getElementById("preview-image");

            imageUpload.addEventListener("change", function() {
                const file = this.files[0];
                const reader = new FileReader();
                
                reader.addEventListener("load", function() {
                    // set image
                    previewImage.src = this.result;

                    // set base
                    //var base64 = this.result.replace(/^data:image\/(png|jpeg|jpg);base64,/, '');

                    var base64 = this.result.split(",")[1];
                    $('#rImage').val(base64);
                    console.log(base64);
                });
                
                reader.readAsDataURL(file);
            });
        </script>

        <script>
            // Initialize Dropzone
            Dropzone.autoDiscover = false;
            var myDropzone = new Dropzone("#dzFrom", {
                url: "server/api.php?mode=fileupload2&pid=" + getId,
                maxFilesize: 20, // Maximum file size in MB
                addRemoveLinks: true, // Show remove file links
                dictRemoveFile: "Remove",
                init: function() {
                    this.on("success", function(file, response) {
                        console.log("File uploaded successfully:", response);
                        table1.ajax.reload();
                    });
                    this.on("error", function(file, errorMessage) {
                        console.log("Error uploading file:", errorMessage);
                    });
                }
            });
        </script>

    </body>
</html>

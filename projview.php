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

            <!-- Main Content -->
            <div id=page-wrapper>
                <div class=content>
                    <div class=content-header>
                        <div class=header-icon>
                            <i class=pe-7s-box1></i>
                        </div>
                        <div class=header-title>
                            <h1>View: <b><span id="dName"></span></b></h1>
                            <small>Navigate left menu to view or modify app content</small>
                            <ol class=breadcrumb>
                                <li class=active><a href=dashboard.php><i class=pe-7s-home></i> Home</a></li>
                            </ol>
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

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class=row>
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h4>Project Information</h4> <br>
                                                <h5>General information of the project</h5>
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
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Project Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" id="pName" name="pName">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-none">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Details</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" type="text" id="pDesc" name="pDesc" maxlength="1000" rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">PO #</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" id="pPo" name="pPo">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Customer</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="pCustomer" name="pCustomer">
                                                                <?php

                                                                    foreach ($getCustomerList as $dCustomer)
                                                                    {
                                                                        echo '<option value="' . $dCustomer->id . '">' . $dCustomer->cust_name . ' - ' . $dCustomer->companyName . '</option>';
                                                                    }

                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-none">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Contact Person</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" id="pCustomerName" name="pCustomerName">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Department</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="pDept" name="pDept">
                                                                <?php

                                                                    foreach ($getDepartmentList as $dDepartment)
                                                                    {
                                                                        echo '<option value="' . $dDepartment->dept_name . '">' . strtoupper($dDepartment->dept_name) . '</option>';
                                                                    }

                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row"></div>
                                                    <div class="form-group row"></div>
                                                    <div class="form-group row"></div>
                                                    <div class="form-group row"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <div class=row>
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h4>Project Information</h4> <br>
                                                <h5>General information of the project</h5>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Status</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="pStatus" name="pStatus">
                                                                <option value="0">Active</option>
                                                                <option value="1">Completed</option>
                                                                <option value="2">Cancelled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Phase</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="pPhase" name="pPhase">
                                                                <?php

                                                                    foreach ($getProjPhaseList as $dProjPhase)
                                                                    {
                                                                        echo '<option value="' . $dProjPhase->id . '">' . $dProjPhase->proj_phase_name . '</option>';
                                                                    }

                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Project In-Charge</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" id="pOic" name="pOic">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Start Date</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="date" id="pDateStart" name="pDateStart">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="example-text-input" class="col-sm-2 col-form-label">Target Date</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="date" id="pDateEnd" name="pDateEnd">
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

                    <div class="row text-right">
                        <a data-toggle="modal" data-target="#modal-danger">
                            <button type="button" class="btn btn-labeled btn-danger m-b-5">
                                <span class="btn-label"><i class="glyphicon glyphicon-cloud-upload"></i></span>File Upload
                            </button>
                        </a>
                        <a id="fDeleteTable1">
                            <button type="button" class="btn btn-labeled btn-danger m-b-5">
                                <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Delete All
                            </button>
                        </a>
                    </div>

                    <div class=row>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class=row>
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h4>Files List</h4> <br>
                                            <h5>Click on item name to download</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Filename</th>
                                                    <th>Type</th>
                                                    <th>Date Added</th>
                                                    <th>Control</th>
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

                    <div class="modal fade modal-danger in" id="modal-danger" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h1 class="modal-title">Upload</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <strong>Note:</strong> 20MB Max each file. Better zip it first.
                                    </div>
                                    <p>
                                    <form action="#" class="dropzone" id="dzFrom">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
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

                $('#pDept').select2();
                $('#pStatus').select2();
                $('#pPhase').select2();
                $('#pCustomer').select2();
            });


            // Variables
            // ===========================
            const params = new URLSearchParams(window.location.search);
            const getId = params.get('id');
            
            var getReqDataProject;
            var table1;


            // Start
            // ===========================
            LoadUser();
            LoadDataProject();
            LoadTable();
            

            // Loop
            // ===========================
            setInterval(function() {
                
            }, 1000);


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
                            url: "server/api.php?mode=projedit",
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
                            url: "server/api.php?mode=projdelete",
                            data: JSON.stringify({
                                dProj: getReqDataProject,
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

            // Press - Delete All Table1
            $('#fDeleteTable1').click(function(e) {
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
                            url: "server/api.php?mode=filedelete2all",
                            data: JSON.stringify({
                                dPid: getId,
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
                                    table1.ajax.reload();
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

            // Press - Delete Table1
            function filePressDelete(fid)
            {
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    url: "server/api.php?mode=filedelete2",
                    data: JSON.stringify({
                        dId: fid,
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
                            table1.ajax.reload();
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
                                $('[id="isadmin"]').hide();
                                //window.location.href = "dashboard.php";
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
            $('#uLogout').click(function(e) {
                localStorage.setItem("tokenId", "");
                window.location.href = "login.php";
            });

            function LoadDataProject()
            {
                $.ajax({
                    type: "POST",
                    url: "server/api.php?mode=projview",
                    data: JSON.stringify({
                        "reqid": getId,
                    }),
                    success: function(data) {
                        // result
                        const result = JSON.parse(data);

                        // check
                        if (result.status == "ok")
                        {
                            getReqDataProject = result.data;
                            
                            // detail
                            $('#dName').text(getReqDataProject.proj_name);
                            $('#preview-image').attr('src', 'files/images/' + getReqDataProject.proj_img);

                            // form
                            $('#rId').val(getReqDataProject.id);
                            $('#rImageOrig').val(getReqDataProject.proj_img);
                            $('#pName').val(getReqDataProject.proj_name);
                            $('#pDesc').val(getReqDataProject.proj_description);
                            $('#pPo').val(getReqDataProject.proj_po);
                            $('#pDept').val(getReqDataProject.proj_dept);
                            $('#pStatus').val(getReqDataProject.proj_status);
                            $('#pPhase').val(getReqDataProject.proj_phase);
                            $('#pOic').val(getReqDataProject.proj_oic);
                            $('#pDateStart').val(getReqDataProject.proj_startdate);
                            $('#pDateEnd').val(getReqDataProject.proj_enddate);
                            $('#pCustomer').val(getReqDataProject.proj_clientid);
                            $('#pCustomerName').val(getReqDataProject.proj_clientcontact);

                            $('#pDept').trigger('change');
                            $('#pStatus').trigger('change');
                            $('#pPhase').trigger('change');
                            $('#pCustomer').trigger('change');
                        }
                        else
                        {
                            window.location.href = "projlist.php";
                        }
                    },
                    error: function(data) {
                        window.location.href = "projlist.php";
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
                        url: 'server/api.php?mode=filelist2&pid=' + getId,
                        dataSrc: 'data',
                    },
                    columns: [
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return '<center><a href="projectfiles/' + data.file_name + '"><h4><b>' + data.file_name + '</b></h4></a><center>';
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.file_type;
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return data.file_date;
                            } 
                        },
                        { 
                            data: null, 
                            render: function ( data, type, row, meta ) {
                                return '<center><span class="label label-pill label-danger" onclick="filePressDelete(' + data.id + ')">Delete</span></center>';
                            } 
                        },
                    ]
                });
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

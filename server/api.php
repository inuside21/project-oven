<?php
    ini_set('display_errors', 0);

    // Database
    include("../config/config.php");

    // check
    if (!isset($_GET['mode'])) {
        echo json_encode(array("status" => "error", "message" => "Mode Error"));
        exit();
    }

    /*
        tip:    USE var_dump return in this page, then console.log return in webpage form submit / ajax
                to view structures

        use:    https://vardumpformatter.io/
    /*

    /*
        ======================================
        MODES
        ======================================
    */

    // User Login
    // ----------------------
    if ($_GET['mode'] == 'userlogin')
    {
        $resData = JSONGet();

        // login
        $sql="select * FROM user_tbl where binary user_uname = '" . $_POST['uuname'] . "' and binary user_pword = '" . $_POST['upword'] . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            // others
            {
                // archive?
                if ($rowsgetacc->user_archive == "1")
                {
                    continue;
                }

                // blocked?
                if ($rowsgetacc->user_block == "1")
                {
                    JSONSet("error", "Login Error", "This account is temporarily blocked.");
                }
            }

            $tokenNew = GUID();

            $sql="update user_tbl set user_token = '" . $tokenNew . "' where id = '" . $rowsgetacc->id . "'"; 
            $rsupdate=mysqli_query($connection,$sql);


            JSONSet("ok", "", "", $tokenNew);
        }

        // result
        JSONSet("error", "Login Error", "Login Error");
    }

    // User Token
    // ----------------------
    if ($_GET['mode'] == 'userverifytoken')
    {
        $resData = JSONGet();

        // login
        $sql="select * FROM user_tbl where user_token = '" . $resData->utoken . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            // others
            {
                // archive?
                if ($rowsgetacc->user_archive == "1")
                {
                    continue;
                }

                // blocked?
                if ($rowsgetacc->user_block == "1")
                {
                    JSONSet("error", "Login Error", "This account is temporarily blocked.");
                }
            }

            JSONSet("ok", "", "", $rowsgetacc);
        }

        // result
        JSONSet("error", "Token Error", "Token Error");
    }


    // Dashboard Rep Item 1
    // ----------------------
    if ($_GET['mode'] == 'dashboard1')
    {
        $resData = JSONGet();
        
        // set
        $output = 0;

        // login
        $sql="select count(*) as resCount FROM oven_tbl"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            $output = $rowsgetacc->resCount;
        }

        JSONSet("ok", "", "", $output);
    }

    // Dashboard Rep Item 2
    // ----------------------
    if ($_GET['mode'] == 'dashboard2')
    {
        $resData = JSONGet();

        // set
        $output = 0;

        // login
        $sql="select count(*) as resCount FROM project_tbl where proj_status = '0'"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            $output = $rowsgetacc->resCount;
        }

        JSONSet("ok", "", "", $output);
    }

    // Dashboard Rep Item 3
    // ----------------------
    if ($_GET['mode'] == 'dashboard3')
    {
        $resData = JSONGet();

        // set
        $output = 0;

        // login
        $sql="select count(*) as resCount FROM project_tbl where proj_status = '0' and proj_enddate < '" . $dateResult . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            $output = $rowsgetacc->resCount;
        }

        JSONSet("ok", "", "", $output);
    }


    // User List
    // ----------------------
    if ($_GET['mode'] == 'guserlist')
    {
        $resData = JSONGet();

        // set
        $resList = array();

        // login
        $sql="select * FROM user_tbl where user_archive != 1"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            // others
            {
                if ($rowsgetacc->user_pos == "0")
                {
                    $rowsgetacc->user_pos = "Normal User";
                }

                if ($rowsgetacc->user_pos == "1")
                {
                    $rowsgetacc->user_pos = "Administrator";
                }
            }

            $resList[] = $rowsgetacc;
        }

        JSONSet("ok", "", "", $resList);
    }

    // User View
    // ----------------------
    if ($_GET['mode'] == 'guserview')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM user_tbl where id = '" . $resData->reqid . "' and user_archive != 1"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                // result
                JSONSet("ok", "", "", $rowsgetacc);
            }
        }

        // result
        JSONSet("error", "", "");
    }

    // User Add
    // ----------------------
    if ($_GET['mode'] == 'guseradd')
    {
        $resData = JSONGet();

        // check
        {

        }

        // check exist
        {
            // login
            $sql="select * FROM user_tbl where binary user_uname = '" . $resData->rUname . "' and user_archive != 1"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                JSONSet("error", "Adding Failed", "Username already exist.");
            }
        }

        // login
        $sql="insert into user_tbl
                (
                    user_date,
                    user_block,
                    user_pos,
                    user_uname,
                    user_pword,
                    user_fname
                )
            values
                (
                    '" . $dateOnlyResult . "',
                    '" . $resData->rBlock. "',
                    '" . $resData->rAccess. "',
                    '" . $resData->rUname . "',
                    '" . $resData->rPword . "',
                    '" . $resData->rFname . "'
                )"; 
        $rsgetacc=mysqli_query($connection,$sql);

        // result
        JSONSet("ok", "Adding Success!", "New user added successfully.");
    }

    // User Edit
    // ----------------------
    if ($_GET['mode'] == 'guseredit')
    {
        $resData = JSONGet();

        // check
        {

        }

        // check exist
        {
            $isExist = false;
            $sql="select * FROM user_tbl where id = '" . $resData->rId . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                $isExist = true;
            }

            if (!$isExist)
            {
                JSONSet("error", "Update Failed", "User not exist.");
            }
        }

        // check exist
        {
            // login
            $sql="select * FROM user_tbl where binary user_uname = '" . $resData->rUname . "' and id != '" . $resData->rId  . "' and user_archive != 1"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                JSONSet("error", "Update Failed", "Username already exist.");
            }
        }

        // login
        $sql="  update user_tbl set
                    user_block = '" . $resData->rBlock. "',
                    user_pos = '" . $resData->rAccess. "',
                    user_uname = '" . $resData->rUname. "',
                    user_pword = '" . $resData->rPword. "',
                    user_fname = '" . $resData->rFname. "'
                where
                    id = '" . $resData->rId . "'
        "; 
        $rsgetacc=mysqli_query($connection,$sql);

        // result
        JSONSet("ok", "Update Success!", "User updated successfully.");
    }

    // User Delete
    // ----------------------
    if ($_GET['mode'] == 'guserdelete')
    {
        $resData = JSONGet();

        // check
        {

        }

        // check exist
        {
            $isExist = false;
            $sql="select * FROM user_tbl where id = '" . $resData->duser->id . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                $isExist = true;
            }

            if (!$isExist)
            {
                JSONSet("error", "Delete Failed", "User not exist.");
            }
        }

        // login
        $sql="update user_tbl set user_archive = 1 where id = '" . $resData->duser->id . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);

        // result
        JSONSet("ok", "Delete Success!", "User removed successfully.");
    }

    // User Edit (Settings)
    // ----------------------
    if ($_GET['mode'] == 'guseredit2')
    {
        $resData = JSONGet();

        // check
        {

        }

        // check exist
        {
            $isExist = false;
            $sql="select * FROM user_tbl where id = '" . $resData->rId . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                $isExist = true;
            }

            if (!$isExist)
            {
                JSONSet("error", "Update Failed", "Account not exist.");
            }
        }

        // check exist
        {
            
        }

        // login
        $sql="  update user_tbl set
                    user_pword = '" . $resData->rPword. "'
                where
                    id = '" . $resData->rId . "'
        "; 
        $rsgetacc=mysqli_query($connection,$sql);

        // result
        JSONSet("ok", "Update Success!", "Account updated successfully.");
    }



    // Oven Add
    // ----------------------
    if ($_GET['mode'] == 'ovenadd')
    {
        $resData = JSONGet();

        // check
        {
            if ($resData->oName == "")
            {
                JSONSet("error", "Add Failed", "Name must not empty.");
            }
        }

        // check image
        {
            /*
            // create image name
            $imageName = GUID() . ".png";
            $imagemptyName = "none.png";

            try 
            {
                if ($resData->rImage != "")
                {
                    $imageConvert = base64_decode($resData->rImage);

                    // check
                    if (getimagesizefromstring($imageConvert) !== false) 
                    {
                        file_put_contents("../files/images/" . $imageName, $imageConvert);
                    }   
                    else
                    {
                        $imageName = $imagemptyName;
                    }
                }
                else
                {
                    $imageName = $imagemptyName;
                }
            }
            catch (Exception $e)
            {
                $imageName = $imagemptyName;
            }
            */
        }

        // item
        {
            $sql="insert into oven_tbl
                    (
                        oven_name
                    )
                values
                    (
                        '" . $resData->oName . "'
                    )"; 
            $rsgetacc=mysqli_query($connection,$sql);
            $itemId = mysqli_insert_id($connection);
        }

        // result
        JSONSet("ok", "Add Success!", "New oven detail added successfully.");
    }

    // Oven Edit
    // ----------------------
    if ($_GET['mode'] == 'ovenedit')
    {
        $resData = JSONGet();

        // check
        {
            if ($resData->oName == "")
            {
                JSONSet("error", "Update Failed", "Name must not empty.");
            }
        }

        // check image
        {
            /*
            // create image name
            $imageName = GUID() . ".png";
            $imagemptyName = "none.png";

            try 
            {
                if ($resData->rImage != "")
                {
                    $imageConvert = base64_decode($resData->rImage);

                    // check
                    if (getimagesizefromstring($imageConvert) !== false) 
                    {
                        file_put_contents("../files/images/" . $imageName, $imageConvert);
                    }   
                    else
                    {
                        $imageName = $imagemptyName;
                    }
                }
                else
                {
                    $imageName = $imagemptyName;
                }
            }
            catch (Exception $e)
            {
                $imageName = $imagemptyName;
            }
            */
        }

        // item
        { 
            $sql="  update oven_tbl set
                        oven_name = '" . $resData->oName . "'
                    where
                        id = '" . $resData->rId . "'
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
        }

        // result
        JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
    }

    // Oven Delete
    // ----------------------
    if ($_GET['mode'] == 'ovendelete')
    {
        $resData = JSONGet();

        $sql="delete from oven_tbl where id = '" . $resData->dOven->id . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);

        // result
        JSONSet("ok", "Delete Success!", "Oven detail has been removed successfully.");
    }

    // Oven List
    // ----------------------
    if ($_GET['mode'] == 'ovenlist')
    {
        $resData = JSONGet();

        // set
        $resList = array();  

        // login
        $sql="select * FROM oven_tbl order by id desc"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            // other
            {
                //
                if ($rowsgetacc->oven_status == "0")
                {
                    $rowsgetacc->oven_status = "IDLE";
                }

                //
                if ($rowsgetacc->oven_status == "1")
                {
                    $rowsgetacc->oven_status = "RUNNING";
                }

                //
                if ($rowsgetacc->oven_status == "2")
                {
                    $rowsgetacc->oven_status = "COMPLETE";
                }

                //
                if ((int)$rowsgetacc->oven_connected < strtotime($dateResult))
                {
                    $rowsgetacc->oven_connected = "OFFLINE";
                }

                //
                if ((int)$rowsgetacc->oven_connected >= strtotime($dateResult))
                {
                    $rowsgetacc->oven_connected = "ONLINE";
                }
            }

            $resList[] = $rowsgetacc;
        }

        JSONSet("ok", "", $sql, $resList);
    }

    // Oven Log List
    // ----------------------
    if ($_GET['mode'] == 'ovenloglist')
    {
        $resData = JSONGet();

        // set
        $resList = array();  

        // login
        $sql="select * FROM oven_log_tbl where oven_id = '" . $_GET['oid'] . "' order by id desc limit 1000"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            // other
            {

            }

            $resList[] = $rowsgetacc;
        }

        JSONSet("ok", "", $sql, $resList);
    }

    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'ovenview')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM oven_tbl where id = '" . $resData->reqid . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                // other
                {
                    //
                    if ($rowsgetacc->oven_lock == "0")
                    {
                        $rowsgetacc->oven_lock = "LOCKED";
                    }

                    if ($rowsgetacc->oven_lock == "1")
                    {
                        $rowsgetacc->oven_lock = "OPEN";
                    }


                    //
                    if ($rowsgetacc->oven_status == "0")
                    {
                        $rowsgetacc->oven_status = "IDLE";
                    }

                    if ($rowsgetacc->oven_status == "1")
                    {
                        $rowsgetacc->oven_status = "RUNNING";
                    }

                    if ($rowsgetacc->oven_status == "2")
                    {
                        $rowsgetacc->oven_status = "COMPLETE";
                    }


                    //
                    if ((int)$rowsgetacc->oven_connected < strtotime($dateResult))
                    {
                        $rowsgetacc->oven_connected = "OFFLINE";
                    }

                    if ((int)$rowsgetacc->oven_connected >= strtotime($dateResult))
                    {
                        $rowsgetacc->oven_connected = "ONLINE";
                    }
                }

                // result
                JSONSet("ok", "", $resData->reqid, $rowsgetacc);
            }
        }

        // result
        JSONSet("error", "", "");
    }


    // Oven Timer Hour Up Edit
    // ----------------------
    if ($_GET['mode'] == 'oventimerhourupedit')
    {
        $resData = JSONGet();

        // item
        { 
            $sql="  update oven_tbl set
                        oven_name = '" . $resData->oName . "'
                    where
                        id = '" . $resData->rId . "'
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
        }

        // result
        JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
    }



















    // project - add
    // ----------------------
    if ($_GET['mode'] == 'projadd')
    {
        $resData = JSONGet();

        // check
        {
            if ($resData->pName == "")
            {
                JSONSet("error", "Add Failed", "Name must not empty.");
            }
        }

        // check image
        {
            // create image name
            $imageName = GUID() . ".png";
            $imagemptyName = "none.png";

            try 
            {
                if ($resData->rImage != "")
                {
                    $imageConvert = base64_decode($resData->rImage);

                    // check
                    if (getimagesizefromstring($imageConvert) !== false) 
                    {
                        file_put_contents("../files/images/" . $imageName, $imageConvert);
                    }   
                    else
                    {
                        $imageName = $imagemptyName;
                    }
                }
                else
                {
                    $imageName = $imagemptyName;
                }
            }
            catch (Exception $e)
            {
                $imageName = $imagemptyName;
            }
        }

        // item
        {
            $sql="insert into project_tbl
                    (
                        proj_userid,
                        proj_clientid,
                        proj_clientcontact,
                        proj_dept,
                        proj_date,
                        proj_status,
                        proj_phase,
                        proj_startdate,
                        proj_enddate,
                        proj_name,
                        proj_description,
                        proj_po,
                        proj_oic,
                        proj_img
                    )
                values
                    (
                        '" . $resData->rUid . "',
                        '" . $resData->pCustomer . "',
                        '" . $resData->pCustomerName . "',
                        '" . $resData->pDept . "',
                        '" . $dateResult . "',
                        '" . $resData->pStatus . "',
                        '" . $resData->pPhase . "',
                        '" . $resData->pDateStart . "',
                        '" . $resData->pDateEnd . "',
                        '" . $resData->pName . "',
                        '" . $resData->pDesc . "',
                        '" . $resData->pPo . "',
                        '" . $resData->pOic . "',
                        '" . $imageName . "'
                    )"; 
            $rsgetacc=mysqli_query($connection,$sql);
            $itemId = mysqli_insert_id($connection);
        }

        // result
        JSONSet("ok", "Add Success!", "New project detail added successfully.");
    }

    // project - edit
    // ----------------------
    if ($_GET['mode'] == 'projedit')
    {
        $resData = JSONGet();

        $targetDirectory = "../files/images/";

        // check
        {
            if ($resData->pName == "")
            {
                JSONSet("error", "Update Failed", "Name must not empty.");
            }
        }

        /*
        // check image
        {
            // create image name
            $imageName = GUID() . ".png";
            $imagemptyName = $resData->rImageOrig;

            try 
            {
                if ($resData->rImage != "")
                {
                    $imageConvert = base64_decode($resData->rImage);

                    // check
                    if (getimagesizefromstring($imageConvert) !== false) 
                    {
                        file_put_contents("../files/images/" . $imageName, $imageConvert);

                        // delete
                        unlink($targetDirectory . $resData->rImageOrig);
                    }   
                    else
                    {
                        $imageName = $imagemptyName;
                    }
                }
                else
                {
                    $imageName = $imagemptyName;
                }
            }
            catch (Exception $e)
            {
                $imageName = $imagemptyName;
            }
        }
        */

        // item
        {
            $sql="update project_tbl set
                        proj_status = '" . $resData->pStatus . "',
                        proj_phase = '" . $resData->pPhase . "',
                        proj_startdate = '" . $resData->pDateStart . "',
                        proj_enddate = '" . $resData->pDateEnd . "',
                        proj_oic = '" . $resData->pOic . "'
                where
                        id = '" . $resData->rId . "'
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
            $itemId = mysqli_insert_id($connection);
        }

        // result
        JSONSet("ok", "Update Success!", "Project detail updated successfully.");
    }

    // project - List By Dept Name
    // ----------------------
    if ($_GET['mode'] == 'projlist4')
    {
        $resData = JSONGet();

        // set
        $resList = array();

        // login
        $userData = new stdClass();
        $sql="select * FROM user_tbl where id = '" . $_GET['uid'] . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            $userData = $rowsgetacc;
        }

        // user dept?
        {
            // upper
            if ($userData->user_dept == "management" || $userData->user_dept == "sales" || $userData->user_dept == "admin" || $userData->user_dept == "cso")
            {
                $sql="select * FROM project_tbl where (proj_type = '0' or proj_type = '4') order by id desc"; 
            }   

            //
            else
            {
                $sql="select * FROM project_tbl where proj_dept = '" . $userData->user_dept . "' and (proj_type = '0' or proj_type = '4') order by id desc"; 
            }
        }   

        // login
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            // other
            {
                //
                if ($rowsgetacc->proj_type == "0")
                {
                    $rowsgetacc->proj_type = "WITH P.O.";
                }

                //
                if ($rowsgetacc->proj_type == "4")
                {
                    $rowsgetacc->proj_type = "FOR INQUIRY";
                }

                //
                $rowsgetacc->proj_clientText = $getCustomerListById[(int)$rowsgetacc->proj_clientid]->cust_name;
                $rowsgetacc->proj_companyText = $getCompanyListById[$getCustomerListById[(int)$rowsgetacc->proj_clientid]->cust_companyid]->company_name;
                $rowsgetacc->proj_phaseText = $getProjPhaseListById[(int)$rowsgetacc->proj_phase]->proj_phase_name;
            }

            $resList[] = $rowsgetacc;
        }

        JSONSet("ok", "", $sql, $resList);
    }

    // project - view
    // ----------------------
    if ($_GET['mode'] == 'projview')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM project_tbl where id = '" . $resData->reqid . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                // result
                JSONSet("ok", "", "", $rowsgetacc);
            }
        }

        // result
        JSONSet("error", "", "");
    }

    // project - delete
    // ----------------------
    if ($_GET['mode'] == 'projdelete')
    {
        /*
        $resData = JSONGet();

        $targetDirectory = "../files/images/";

        // check
        {

        }

        //
        $sql = " select * from project_tbl where id = '" . $resData->dProj->id . "'";
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            if ($rowsgetacc->proj_img == "none.png")
            {
                continue;
            }

            // delete
            unlink($targetDirectory . $rowsgetacc->proj_img);
        }

        // login
        $sql="delete from project_tbl where id = '" . $resData->dProj->id . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);

        // result
        JSONSet("ok", "Delete Success!", "Project detail removed successfully.");
        */

        JSONSet("ok", "Delete Failed!", "Request to OM for project data removal.");
    }


    // file - List By Proj Id
    // ----------------------
    if ($_GET['mode'] == 'filelist2')
    {
        $resData = JSONGet();

        // set
        $resList = array();

        // login
        $sql="select * FROM files_tbl where file_projid = '" . $_GET['pid'] . "' order by file_type asc"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            $resList[] = $rowsgetacc;
        }

        JSONSet("ok", "", "", $resList);
    }

    // file - upload By Proj Id
    // ----------------------
    if ($_GET['mode'] == 'fileupload2')
    {
        $targetDirectory = "../projectfiles/"; // Specify the directory where you want to store the uploaded files
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];

            //
            $fileName = $_GET['pid'] . "-" . $fileName;

            // 
            $targetFile = $targetDirectory . $fileName;
            $ext = pathinfo($targetFile, PATHINFO_EXTENSION);

            // save DB
            $sql = "    insert into files_tbl
                            (
                                file_projid,
                                file_name,
                                file_type,
                                file_date
                            )
                        values
                            (
                                '" . $_GET['pid'] . "',
                                '" . $fileName . "',
                                '" . $ext . "',
                                '" . $dateResult . "'
                            )
            ";
            $rsgetacc=mysqli_query($connection,$sql);


            // Move the uploaded file to the target directory
            if (move_uploaded_file($tempFile, $targetFile)) {
                // File was uploaded successfully
                echo "File uploaded: " . $fileName;
            } else {
                // Error occurred while uploading the file
                echo "Error uploading file.";
            }
        }
    }

    // file - delete By Id
    // ----------------------
    if ($_GET['mode'] == 'filedelete2')
    {
        $resData = JSONGet();

        $targetDirectory = "../projectfiles/"; // Specify the directory where you want to store the uploaded files
        
        //
        $sql = " select * from files_tbl where id = '" . $resData->dId . "'";
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            // delete
            unlink($targetDirectory . $rowsgetacc->file_name);
        }

        // 
        $sql = " delete from files_tbl where id = '" . $resData->dId . "'";
        $rsgetacc=mysqli_query($connection,$sql);


        // result
        JSONSet("ok", "Delete Success!", "File has been deleted. (" . $resData->dPid . ")");    
    }

    // file - delete all By Proj Id
    // ----------------------
    if ($_GET['mode'] == 'filedelete2all')
    {
        $resData = JSONGet();

        $targetDirectory = "../projectfiles/"; // Specify the directory where you want to store the uploaded files
        
        //
        $sql = " select * from files_tbl where file_projid = '" . $resData->dPid . "'";
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            // delete
            unlink($targetDirectory . $rowsgetacc->file_name);
        }

        // 
        $sql = " delete from files_tbl where file_projid = '" . $resData->dPid . "'";
        $rsgetacc=mysqli_query($connection,$sql);

        // result
        JSONSet("ok", "Delete Success!", "All files associated with this project has been deleted. (" . $resData->dId . ")");
    }


    /*
        ======================================
        FUNCTIONS
        ======================================
    */

    // JSON - Get
    // ---------------------------------------
    function JSONGet()
    {
        // get json
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        // sanitize?
        {
            sanitize_array($data);
        }

        return $data;
    }

    // JSON - Set     
    // ---------------------------------------
    function JSONSet($resStatus, $resTitle = "", $resMsg = "", $resData = "")
    {
        /*
            status:
                ok      - success
                error   - error

            title:
                return any notif title

            message:
                return any notif msg
            
            data:
                return any result
        */
        echo json_encode(array("status" => $resStatus, "title" => $resTitle, "message" => $resMsg, "data" => $resData));
        exit();
    }

    // IDs
    // ---------------------------------------
    function GUID()
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535));
    }

    // Sanitize
    // ---------------------------------------
    function sanitize_string($string) {
        // Remove any characters that could be used to inject SQL code
        $string = str_replace("'", "", $string);
        $string = str_replace("`", "", $string);
        $string = str_replace("\"", "", $string);
        $string = str_replace("\\", "", $string);
        $string = str_replace("*", "", $string);
        $string = str_replace("%", "", $string);
        $string = str_replace(";", "", $string);
        $string = strip_tags($string);
        return $string;
    }

    function sanitize_array(&$array) {
        foreach ($array as &$item) {
            if (is_array($item)) {
                sanitize_array($item);
            } else if (is_string($item)) {
                $item = sanitize_string($item);
            }
        }
    }
?>
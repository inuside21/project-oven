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
                if ($rowsgetacc->user_pos == "1")
                {
                    $rowsgetacc->user_pos = "Operator";
                }

                if ($rowsgetacc->user_pos == "0")
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
                $timeDiff = strtotime($dateResult) - (int)$rowsgetacc->oven_connected;
                if ($timeDiff > 10)
                {
                    $rowsgetacc->oven_connected = "OFFLINE";
                }

                //
                if ($timeDiff <= 10)
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


                    $timeDiff = strtotime($dateResult) - (int)$rowsgetacc->oven_connected;
                    if ($timeDiff > 10)
                    {
                        $rowsgetacc->oven_connected = "OFFLINE";
                    }

                    //
                    if ($timeDiff <= 10)
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


    // Oven Operation Edit
    // ----------------------
    if ($_GET['mode'] == 'ovenoperationedit')
    {
        $resData = JSONGet();

        // 
        {
            // idle?
            if ($resData->dOven->oven_status == "IDLE")
            {
                $sql="  update oven_tbl set
                            oven_status = 1,
                            oven_timer = oven_timermain,
                            oven_lock = 0
                        where
                            id = '" . $resData->dOven->id . "'
                "; 
                $rsgetacc=mysqli_query($connection,$sql);

                // result
                JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
            }

            // running?
            if ($resData->dOven->oven_status == "RUNNING")
            {
                $sql="  update oven_tbl set
                            oven_status = 2,
                            oven_timer = 0
                        where
                            id = '" . $resData->dOven->id . "'
                "; 
                $rsgetacc=mysqli_query($connection,$sql);

                // result
                JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
            }

            // complete?
            if ($resData->dOven->oven_status == "COMPLETE")
            {
                $sql="  update oven_tbl set
                            oven_status = 0
                        where
                            id = '" . $resData->dOven->id . "'
                "; 
                $rsgetacc=mysqli_query($connection,$sql);

                // result
                JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
            }
        }

        echo $resData->dOven->oven_status;
    }

    // Oven Timer Hour Up Edit
    // ----------------------
    if ($_GET['mode'] == 'oventimerhourupedit')
    {
        $resData = JSONGet();

        {
            if ($resData->dOven->oven_status != "IDLE")
            {
                return;
            }
        }

        // item
        { 
            $sql="  update oven_tbl set
                        oven_timermain = oven_timermain + 3600
                    where
                        id = '" . $resData->dOven->id . "'
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
        }

        // result
        JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
    }

    // Oven Timer Hour Down Edit
    // ----------------------
    if ($_GET['mode'] == 'oventimerhourdownedit')
    {
        $resData = JSONGet();

        {
            if ($resData->dOven->oven_status != "IDLE")
            {
                return;
            }
        }

        // item
        { 
            $sql="  update oven_tbl set
                        oven_timermain = oven_timermain - 3600
                    where
                        id = '" . $resData->dOven->id . "' and oven_timermain >= 3600
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
        }

        // result
        JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
    }

    // Oven Timer Min Up Edit
    // ----------------------
    if ($_GET['mode'] == 'oventimerminupedit')
    {
        $resData = JSONGet();

        {
            if ($resData->dOven->oven_status != "IDLE")
            {
                return;
            }
        }

        // item
        { 
            $sql="  update oven_tbl set
                        oven_timermain = oven_timermain + 60
                    where
                        id = '" . $resData->dOven->id . "'
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
        }

        // result
        JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
    }

    // Oven Timer Min Down Edit
    // ----------------------
    if ($_GET['mode'] == 'oventimermindownedit')
    {
        $resData = JSONGet();

        {
            if ($resData->dOven->oven_status != "IDLE")
            {
                return;
            }
        }

        // item
        { 
            $sql="  update oven_tbl set
                        oven_timermain = oven_timermain - 60
                    where
                        id = '" . $resData->dOven->id . "' and oven_timermain >= 60
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
        }

        // result
        JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
    }

    // Oven Stock Edit
    // ----------------------
    if ($_GET['mode'] == 'ovenstockedit')
    {
        $resData = JSONGet();

        {
            /*
            if ($resData->dOven->oven_status != "IDLE")
            {
                return;
            }
            */
        }

        // item
        { 
            $sql="  update oven_tbl set
                        oven_stock = '" . $resData->tStock . "'
                    where
                        id = '" . $_GET['oid'] . "'
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
        }

        // result
        JSONSet("ok", "Update Success!", "Oven detail has been updated successfully.");
    }

    // Oven Lock Edit
    // ----------------------
    if ($_GET['mode'] == 'ovenlockedit')
    {
        $resData = JSONGet();
        
        {
            /*
            if ($resData->dOven->oven_status != "IDLE" || $resData->dOven->oven_status != "COMPLETE")
            {
                return;
            }
            */
        }

        $lockVal = 0;
        if ($resData->dOven->oven_lock == "LOCKED")
        {
            $lockVal = 1;
        }
        else
        {
            $lockVal = 0;
        }

        // item
        { 
            $sql="  update oven_tbl set
                        oven_lock = '" . $lockVal . "'
                    where
                        id = '" . $resData->dOven->id . "'
            "; 
            $rsgetacc=mysqli_query($connection,$sql);
        }

        // result
        JSONSet("ok", "Update Success!", "Oven detail has been updated successfully." . $resData->dOven->oven_lock);
    }



    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'getstatus')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                echo $rowsgetacc->oven_status;
            }
        }
    } 

    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'getlock')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                echo $rowsgetacc->oven_lock;
            }
        }
    }

    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'getcurrent')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                echo $rowsgetacc->oven_current;
            }
        }
    }

    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'gethumi')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                echo number_format($rowsgetacc->oven_humi, 2, '.', ''); //echo $rowsgetacc->oven_humi;
            }
        }
    }

    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'gettemp')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                echo number_format($rowsgetacc->oven_temp, 2, '.', ''); //$rowsgetacc->oven_temp;
            }
        }
    }

    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'gettimer')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                echo convertSecondsToTime($rowsgetacc->oven_timer);
            }
        }
    }

    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'gettimermain')
    {
        $resData = JSONGet();

        // check exist
        {
            $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
            $rsgetacc=mysqli_query($connection,$sql);
            while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
            {
                echo convertSecondsToTime($rowsgetacc->oven_timermain);
            }
        }
    }

    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'setdata')
    {
        $resData = JSONGet();

        {
            // kwh?
            $watt = $_GET['val1'] * 220;
            $kwh = ($watt * 24) / 1000;
        }

        //
        $sql="  update oven_tbl set
                    oven_current = '" . $_GET['val1'] . "',
                    oven_kwh = '" . $kwh . "',
                    oven_humi = '" . $_GET['val2'] . "',
                    oven_temp = '" . $_GET['val3'] . "'
                where 
                    id = '" . $_GET['id'] . "'
        ";
        $rsupd=mysqli_query($connection,$sql); 

        //
        $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            if ($rowsgetacc->oven_status == "1")
            {
                $sql="  insert into oven_log_tbl
                            (
                                oven_id,
                                oven_date,
                                oven_temp,
                                oven_current,
                                oven_kwh
                            )
                        values
                            (
                                '" . $_GET['id'] . "',
                                '" . $dateResult . "',
                                '" . $_GET['val3'] . "',
                                '" . $_GET['val1'] . "',
                                '" . $kwh . "'
                            )
                "; 
                $rsupd=mysqli_query($connection,$sql);
            }
        }

        
    }

    // ards
    // Oven View
    // ----------------------
    if ($_GET['mode'] == 'settimer')
    {
        $resData = JSONGet();

        {

        }

        //
        $ovenData = new stdClass();
        $sql="select * FROM oven_tbl where id = '" . $_GET['id'] . "'"; 
        $rsgetacc=mysqli_query($connection,$sql);
        while ($rowsgetacc = mysqli_fetch_object($rsgetacc))
        {
            $ovenData = $rowsgetacc;
        }

        {
            // running?
            if ($ovenData->oven_status == "1")
            {
                if ((int)$ovenData->oven_timer > 0)
                {
                    $timeDiff = strtotime($dateResult) - (int)$ovenData->oven_connected;

                    $sql="  update oven_tbl set
                                oven_timer = oven_timer - " . $timeDiff . "
                            where 
                                id = '" . $_GET['id'] . "'
                    "; 
                    $rsgetacc=mysqli_query($connection,$sql);
                }

                if ((int)$ovenData->oven_timer <= 0)
                {
                    $sql="  update oven_tbl set
                                oven_timer = 0,
                                oven_status = 2
                            where 
                                id = '" . $_GET['id'] . "'
                    "; 
                    $rsgetacc=mysqli_query($connection,$sql);
                }
            }
        }

        // update connection
        $sql="  update oven_tbl set
                    oven_connected = '" . strtotime($dateResult) . "'
                where 
                    id = '" . $_GET['id'] . "'
        "; 
        $rsgetacc=mysqli_query($connection,$sql);
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

    // Time
    // ---------------------------------------
    function convertSecondsToTime($seconds) {
        if ($seconds <= 0)
        {
            $seconds = 0;
        }

        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
        
        return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
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
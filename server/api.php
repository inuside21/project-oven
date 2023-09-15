<?php

    // Database
    include("../config/config.php");

    // check
    if (!isset($_GET['mode'])) {
        ResultError("error");
    }

    // Convert GET to OBJECT
    {
        $resData = new stdClass();
        foreach ($_GET as $key => $value) 
        {
            if ($key != 'mode') 
            {
                $resData->$key = $value;
            }
        }
    }



    /*
        ======================================
        MODES
        ======================================
    */
    // System
    if ($_GET['mode'] == 'systemcheck')
    {
        //
        $systemList = array();

        //
        $sql = "select * from system_tbl";
        $rsSystem = mysqli_query($connection, $sql);
        $rsSystemCount = mysqli_num_rows($rsSystem);
        if ($rsSystemCount > 0)
        {
            while ($rowsSystem = mysqli_fetch_object($rsSystem))
            {
                $systemList[] = implode(',', (array)$rowsSystem);
            }
        }
        
        $newResult = implode('|', $systemList);
        ResultOK("", $newResult);
    }

    // User - Login
    if ($_GET['mode'] == 'userlogin')
    {
        // check
        {
            if (strlen($resData->uuname) <= 0 || strlen($resData->uuname) > 100 || ctype_space($resData->uuname) || str_contains($resData->uuname, ' ') || $resData->uuname == "")
            {
                ResultError("Login failed. Invalid characters detected.");
            }

            if (strlen($resData->upword) <= 0 || strlen($resData->upword) > 100 || ctype_space($resData->upword) || str_contains($resData->upword, ' ') || $resData->upword == "")
            {
                ResultError("Login failed. Invalid characters detected.");
            }
        }

        //
        $userList = array();

        //
        $sql = "select * from user_tbl where binary user_uname = '" . $resData->uuname . "' and binary user_pword = '" . $resData->upword . "'";
        $rsUser = mysqli_query($connection, $sql);
        $rsUserCount = mysqli_num_rows($rsUser);
        if ($rsUserCount > 0)
        {
            while ($rowsUser = mysqli_fetch_object($rsUser))
            {
                $userList[] = implode(',', (array)$rowsUser);
            }

            $newResult = implode('|', $userList);
            ResultOK("", $newResult);
        }
        
        ResultError("Login failed. Account not exist.");
    }

    // User - Register
    if ($_GET['mode'] == 'userregister')
    {
        // check
        {
            if (strlen($resData->uuname) <= 0 || strlen($resData->uuname) > 100 || ctype_space($resData->uuname) || str_contains($resData->uuname, ' ') || $resData->uuname == "")
            {
                ResultError("Register failed. Invalid characters detected1.");
            }

            if (strlen($resData->upword) <= 0 || strlen($resData->upword) > 100 || ctype_space($resData->upword) || str_contains($resData->upword, ' ') || $resData->upword == "")
            {
                ResultError("Register failed. Invalid characters detected2.");
            }

            if (strlen($resData->unick) <= 0 || strlen($resData->unick) > 100 || ctype_space($resData->unick) || str_contains($resData->unick, ' ') || $resData->unick == "")
            {
                ResultError("Register failed. Invalid characters detected3.");
            }

            if (strlen($resData->uemail) <= 0 || strlen($resData->uemail) > 100 || ctype_space($resData->uemail) || str_contains($resData->uemail, ' ') || $resData->uemail == "")
            {
                ResultError("Register failed. Invalid characters detected4.");
            }

            if (strlen($resData->uaddbnb) <= 0 || strlen($resData->uaddbnb) > 100 || ctype_space($resData->uaddbnb) || str_contains($resData->uaddbnb, ' ') || $resData->uaddbnb == "")
            {
                ResultError("Register failed. Invalid characters detected5.");
            }
        }

        //
        {
            // exist?
            $sql = "select * from user_tbl where binary user_uname = '" . $resData->uuname . "'";
            $rsUser = mysqli_query($connection, $sql);
            $rsUserCount = mysqli_num_rows($rsUser);
            if ($rsUserCount > 0)
            {
                ResultError("Register failed. Account already exist.");
            }

            // exist?
            $sql = "select * from user_tbl where binary user_email = '" . $resData->uemail . "'";
            $rsUser = mysqli_query($connection, $sql);
            $rsUserCount = mysqli_num_rows($rsUser);
            if ($rsUserCount > 0)
            {
                ResultError("Register failed. Email already exist.");
            }

            // exist?
            $sql = "select * from user_tbl where binary user_nickname = '" . $resData->unick . "'";
            $rsUser = mysqli_query($connection, $sql);
            $rsUserCount = mysqli_num_rows($rsUser);
            if ($rsUserCount > 0)
            {
                ResultError("Register failed. Nickname already exist.");
            }

            // exist?
            $sql = "select * from user_tbl where binary user_address_bnb = '" . $resData->uaddbnb . "'";
            $rsUser = mysqli_query($connection, $sql);
            $rsUserCount = mysqli_num_rows($rsUser);
            if ($rsUserCount > 0)
            {
                ResultError("Register failed. Binance address already exist.");
            }
        }

        // Ref
        {
            $refData = new stdClass();
            $refData->id = "-1";

            // exist?
            $sql = "select * from user_tbl where user_ref = '" . $resData->uref . "'";
            $rsUser = mysqli_query($connection, $sql);
            $rsUserCount = mysqli_num_rows($rsUser);
            if ($rsUserCount > 0)
            {
                while ($rowsUser = mysqli_fetch_object($rsUser))
                {
                    $refData = $rowsUser;
                }
            }
        }

        //
        $sql = "    insert into user_tbl
                        (
                            user_date,
                            user_ref,
                            user_refby,
                            user_uname,
                            user_pword,
                            user_nickname,
                            user_email,
                            user_address_bnb
                        )
                    values
                        (
                            '" . strtotime($dateResult) . "',
                            '" . GUID() . "',
                            '" . $resData->uuname . "',
                            '" . $refData->id . "'
                            '" . $resData->upword . "',
                            '" . $resData->unick . "',
                            '" . $resData->uemail . "',
                            '" . $resData->uaddbnb . "'
                        )
        ";
        $rsUser = mysqli_query($connection, $sql);

        ResultOK("Registration success!");
    }

    // User - Select Save
    if ($_GET['mode'] == 'userselectsave')
    {
        // check
        {
            
        }

        //
        {
            // exist?
            $sql = "select * from user_tbl where id = '" . $resData->uid . "' and user_activated = '1'";
            $rsUser = mysqli_query($connection, $sql);
            $rsUserCount = mysqli_num_rows($rsUser);
            if ($rsUserCount > 0)
            {
                ResultError("Saving failed. Avatar and Pokemon is already set. Relogin your account.");
            }
        }

        // poke data
        {
            $pokeData = RequestData('https://pokeapi.co/api/v2/pokemon/' . $resData->upokemon);
        }

        //
        $sql = "    insert into poke_tbl
                        (
                            poke_date,
                            poke_id,
                            poke_trainer_original,
                            poke_trainer_current,
                            poke_nickname
                        )
                    values
                        (
                            '" . strtotime($dateResult) . "',
                            '" . $resData->upokemon . "',
                            '" . $resData->uid . "',
                            '" . $resData->uid . "',
                            '" . $pokeData->name . "'
                        )
        ";
        $rsUser = mysqli_query($connection, $sql);

        //
        $sql = "    update user_tbl set
                            user_activated = '" . $resData->uid . "',
                            user_avatar = '" . $resData->uavatar . "'
                    where
                        id = '" . $resData->uid . "'
        ";
        $rsUser = mysqli_query($connection, $sql);

        ResultOK("Saving success!");
    }

    // Test
    if ($_GET['mode'] == 'test1')
    {
        echo GUID();
    }


    /*
        ======================================
        FUNCTIONS
        ======================================
    */
    // Result Handler
    // ---------------------------------------
    function ResultJSON($resStatus, $resMsg, $resData = "")
    {
        /*
            status:
                ok      - success
                error   - error

            message:
                return any notif
            
            data:
                return any result
        */
        echo json_encode(array("status" => $resStatus, "message" => $resMsg, "data" => $resData));
        exit();
    }

    // Req
    // ---------------------------------------
    function RequestData($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $responseObj = json_decode($response);
        
        return $responseObj;
    }

    // OK
    // ---------------------------------------
    function ResultOK($errMsg = "", $errData = "")
    {
        echo "ok#" . $errMsg . "#" . $errData;
        exit();
    }

    // Error
    // ---------------------------------------
    function ResultError($errMsg = "")
    {
        echo "error#" . $errMsg;
        exit();
    }

    // IDs
    // ---------------------------------------
    function GUID()
    {
        return strtoupper(substr(uniqid(), -6));
    }
?>
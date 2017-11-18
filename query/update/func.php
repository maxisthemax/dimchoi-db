<?php
include "system/function.php";
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateuser() 
{
    global $dbhandler0;

//define variable for query >>>
    $userid = !empty($_POST['userid']) ? $_POST['userid'] : ''; 
//define variable for query <<<

    $sqlcheckuser = "SELECT * FROM user WHERE i_user_id = '$userid' LIMIT 1"; 
    $resuser = $dbhandler0->query($sqlcheckuser);

    if (!$resuser)
    {
        return $resuser;
    }
    else
    {    

//define variable for query >>>
    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : $resuser[0]['va_first_name'];
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : $resuser[0]['va_last_name'];
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : $resuser[0]['va_gender'];
    $countrycode = !empty($_POST['countrycode']) ? $_POST['countrycode'] : $resuser[0]['va_country_code'];
    $phonecode = !empty($_POST['phonecode']) ? $_POST['phonecode'] : $resuser[0]['va_phone_code'];
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : $resuser[0]['va_phone'];
    $dob = !empty($_POST['dob']) ? $_POST['dob'] : $resuser[0]['dt_dob'];
    $email = !empty($_POST['email']) ? $_POST['email'] : $resuser[0]['va_email'];
    $pass = !empty($_POST['pass']) ? $_POST['pass'] : $resuser[0]['va_pass'];
    $facebook = !empty($_POST['facebook']) ? $_POST['facebook'] : $resuser[0]['va_facebook'];
    $google = !empty($_POST['google']) ? $_POST['google'] : $resuser[0]['va_google'];  
    $token = !empty($_POST['token']) ? $_POST['token'] : $resuser[0]['va_token'];  
//define variable for query <<<

    $sqlcheck = 
    "UPDATE user
    set va_first_name = '$firstname',
    va_last_name ='$lastname',    
    va_gender ='$gender',
    va_country_code = '$countrycode',
    va_phone_code = '$phonecode',
    va_phone ='$phone',
    dt_dob ='$dob',
    va_email ='$email',
    va_pass ='$pass',
    va_facebook ='$facebook',
    va_google ='$google',
    va_token = '$token'
    where i_user_id = '$userid'";

    $res = $dbhandler0->update($sqlcheck);

    return $res;
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateresusertoken() 
{
    global $dbhandler0;

//define variable for query >>>    
    $res_user = !empty($_POST['res_user']) ? $_POST['res_user'] : ''; 
    $token = !empty($_POST['token']) ? $_POST['token'] : ''; 
//define variable for query <<<

    if ($res_user != '')
    {
        $sqlcheck = "SELECT 1 FROM resuser where va_username = $res_user";
        $rescheck= $dbhandler0->query($sqlcheck); 
        if($rescheck)
        {         
         $sqlcheck = 
            "UPDATE resuser 
            SET va_token = '$token'
            where va_username = '$res_user'";
            $res = $dbhandler0->update($sqlcheck);
        return $res;  
        }  
    }
}        
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateresorderstatus() 
{
    global $dbhandler0;

//define variable for query >>>       
    $res_order_id = !empty($_POST['res_order_id']) ? $_POST['res_order_id'] : ''; 
    $res_order_status = !empty($_POST['res_order_status']) ? $_POST['res_order_status'] : ''; 
//define variable for query <<<  

    if ($res_order_id > 0)
    {
        $sqlcheck = "SELECT 1 FROM resorder where i_resorder_id = $res_order_id";
        $rescheck= $dbhandler0->query($sqlcheck); 
        if($rescheck)
        {        
         $sqlcheck = 
            "UPDATE resorder 
            SET i_status = '$res_order_status', dt_resorderclosed = now()
            where i_resorder_id = '$res_order_id'";
            $res = $dbhandler0->update($sqlcheck);
        return $res; 
        }   
    }
}        
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateresordertable() 
{
    global $dbhandler0;

//define variable for query >>>       
    $res_order_id = !empty($_POST['res_order_id']) ? $_POST['res_order_id'] : ''; 
    $res_order_table = !empty($_POST['res_order_table']) ? $_POST['res_order_table'] : ''; 
//define variable for query <<<
   
    if ($res_order_id > 0)
    {
        $sqlcheck = "SELECT 1 FROM resorder where i_resorder_id = $res_order_id";
        $rescheck= $dbhandler0->query($sqlcheck); 
        if($rescheck)
        {
        $sqlqrtable = 
            "UPDATE resorder 
            SET i_res_order_table_id = '$res_order_table'
            where i_resorder_id = '$res_order_id'";
            $restable = $dbhandler0->update($sqlqrtable);
        return $restable;
        }  
    }  
}        
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateqrdata() 
{
    global $dbhandler0;
//define variable for query >>>       
    $qr_id = !empty($_POST['qr_id']) ? $_POST['qr_id'] : ''; 
//define variable for query <<< 
    if ($qr_id > 0)
    {    
        $sqlcheck = "SELECT 1 FROM qrcode where i_qr_id = $qr_id";
        $rescheck= $dbhandler0->query($sqlcheck); 
  
        if($rescheck)
        {
        //define variable for query >>>       
            $qr_data_1 = addslashes(!empty($_POST['qr_data_1'])? $_POST['qr_data_1'] : '');
            $qr_data_2 = addslashes(!empty($_POST['qr_data_2'])? $_POST['qr_data_2'] : '');
        //define variable for query <<<
            if (!empty($qr_data_1) OR !empty($qr_data_2))
            {
            $sqlqrcodeupdate = 
                "UPDATE qrcode 
                SET va_qr_data_1 = '$qr_data_1',va_qr_data_2 = '$qr_data_2'
                where i_qr_id = $qr_id";

                $resqr = $dbhandler0->update($sqlqrcodeupdate);
            return $resqr; 
            }
        }
    }     
}        
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateresorderdata() 
{
    global $dbhandler0;
//define variable for query >>>       
    $res_order_id = !empty($_POST['res_order_id']) ? $_POST['res_order_id'] : ''; 
//define variable for query <<< 
    if ($res_order_id > 0)
    {    
        $sqlcheck = "SELECT 1 FROM resorder where i_resorder_id = $res_order_id";
        $rescheck= $dbhandler0->query($sqlcheck);

        if($rescheck)
        {    
        //define variable for query >>>       
            $res_order_data_1 = addslashes(!empty($_POST['res_order_data_1'])? $_POST['res_order_data_1'] : '');
            $res_order_data_2 = addslashes(!empty($_POST['res_order_data_2'])? $_POST['res_order_data_2'] : '');
        //define variable for query <<<
            if (!empty($res_order_data_1) OR !empty($res_order_data_2))
            {            
            $sqlorderdata = 
                "UPDATE resorder 
                SET va_resorder_data_1 = '$res_order_data_1',va_resorder_data_2 = '$res_order_data_2'
                where i_resorder_id = $res_order_id";

                $resorderdata= $dbhandler0->update($sqlorderdata);
            return $resorderdata; 
            }   
        } 
    }     
}        
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
?>
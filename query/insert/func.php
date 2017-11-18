<?php

include "system/function.php";

//====================================================================================================== 
function insertnewqrcoderow() {
    global $dbhandler0;

    $qrdatanew1 = !empty($_POST['qrdatanew1']) ? $_POST['qrdatanew1'] : '';
    $qrdatanew1=str_replace("'","\'", $qrdatanew1);
    $qrdatanew2 = !empty($_POST['qrdatanew2']) ? $_POST['qrdatanew2'] : '';
    $qrdatanew2=str_replace("'","\'", $qrdatanew2);
    
    $qrtypenew = !empty($_POST['qrtypenew']) ? $_POST['qrtypenew'] : '';
    $resid_insert = !empty($_POST['resid_insert']) ? $_POST['resid_insert'] : '';
    $userid_insert = !empty($_POST['userid_insert']) ? $_POST['userid_insert'] : 0;

    $sqlcheck = 
    "INSERT INTO qrcode (
    i_res_id,
    i_user_id,
    i_qr_type_id,    
    va_qr_data_1,
    va_qr_data_2)
    VALUES (
    '$resid_insert',
    '$userid_insert',
    '$qrtypenew',
    '$qrdatanew1',
    '$qrdatanew2')";

    $res = $dbhandler0->insert($sqlcheck);
    $last_id = $res;

    $sqlqrcode = "SELECT * FROM qrcode WHERE i_qr_id = '$last_id' LIMIT 1";    
    $resqrcode = $dbhandler0->query($sqlqrcode);
    
    $finalresult = array (
        'i_res_id' => $resqrcode[0]['i_res_id'],
        'i_qr_id' => $last_id
            );
    return $finalresult;
}
//====================================================================================================== 
function insertnewuser() {
    global $dbhandler0;
    
    $firstnamenew = !empty($_POST['firstnamenew']) ? $_POST['firstnamenew'] : '';
    $lastnamenew = !empty($_POST['lastnamenew']) ? $_POST['lastnamenew'] : '';
    $gendernew = !empty($_POST['gendernew']) ? $_POST['gendernew'] : '';
    $countrycodenew = !empty($_POST['countrycodenew']) ? $_POST['countrycodenew'] : '';
    $phonecodenew = !empty($_POST['phonecodenew']) ? $_POST['phonecodenew'] : '';
    $phonenew = !empty($_POST['phonenew']) ? $_POST['phonenew'] : '';
    $dobnew = !empty($_POST['dobnew']) ? $_POST['dobnew'] : '0000-00-00';
    $emailnew = !empty($_POST['emailnew']) ? $_POST['emailnew'] : '';
    $passnew = !empty($_POST['passnew']) ? $_POST['passnew'] : '';
    $facebooknew = !empty($_POST['facebooknew']) ? $_POST['facebooknew'] : '';
    $googlenew = !empty($_POST['googlenew']) ? $_POST['googlenew'] : '';    
    $tokennew = !empty($_POST['tokennew']) ? $_POST['tokennew'] : ''; 
    $sqlcheckuser = "SELECT * FROM user where va_email = '$emailnew'";
    $resuser = $dbhandler0->query($sqlcheckuser);

if (empty($resuser))
{
    $sqlcheck = 
    "INSERT INTO user (
    va_first_name,
    va_last_name,    
    va_gender,
    va_country_code,
    va_phone_code,
    va_phone,
    dt_dob,
    va_email,
    va_pass,
    va_facebook,
    va_google,
    va_token)
    VALUES (
    '$firstnamenew',
    '$lastnamenew',
    '$gendernew',
    '$countrycodenew',
    '$phonecodenew',
    '$phonenew',
    '$dobnew',
    '$emailnew',
    '$passnew',
    '$facebooknew',
    '$googlenew',
    '$tokennew'        
    )";

    $res = $dbhandler0->insert($sqlcheck);
    $last_id = $res;
    return $res;
}
else
{
    if ($facebooknew != '' or $googlenew != '')
    {
    $res_i_user_id=$resuser[0]['i_user_id'];
    $sqlcheckupdate = "UPDATE user SET

    va_facebook = '$facebooknew',
    va_google = '$googlenew'
    WHERE i_user_id = '$res_i_user_id'"; 
    $resupdate = $dbhandler0->update($sqlcheckupdate);
    return $resupdate;
    }
    else
    {
    return -3;
    }
}
}
//====================================================================================================== 
function insertorderfromqr() {
    global $dbhandler0;

    $qr_id = !empty($_POST['qr_id']) ? $_POST['qr_id'] : '';
    $res_order_table = !empty($_POST['res_order_table']) ? $_POST['res_order_table'] : 0;
    $sqlqr = "SELECT * FROM qrcode where i_qr_id = '$qr_id' and i_qr_type_id = 1 LIMIT 1";

    $resqr = $dbhandler0->query($sqlqr);

     if ($resqr)
     {
        $res_id = $resqr[0]['i_res_id'];
        $user_id = $resqr[0]['i_user_id'];
        $qr_type_id = $resqr[0]['i_qr_type_id'];
        $qr_data_1 = $resqr[0]['va_qr_data_1'];
        $qr_data_1=str_replace("'","\'", $qr_data_1);
        $qr_data_2 = $resqr[0]['va_qr_data_2'];
        $qr_data_2=str_replace("'","\'", $qr_data_2);
        $create_date = $resqr[0]['dt_create'];

        $sqlinstouserorder = 
        "INSERT INTO 
        userorder (i_userorder_id,i_res_id,i_user_id,i_userorder_type_id,va_userorder_data_1,va_userorder_data_2,dt_create,i_status,dt_userordercreate) 
        values ('$qr_id','$res_id','$user_id','$qr_type_id','$qr_data_1','$qr_data_2','$create_date',1,now())";

        $resinsuseroder = $dbhandler0->insert($sqlinstouserorder);

        $sqlinstoresorder = 
        "INSERT INTO 
        resorder (i_resorder_id,i_res_id,i_user_id,i_resorder_type_id,va_resorder_data_1,va_resorder_data_2,dt_create,i_status,dt_resordercreate,dt_resorderclosed,i_res_order_table_id) 
        values ('$qr_id','$res_id','$user_id','$qr_type_id','$qr_data_1','$qr_data_2','$create_date',1,now(),'0000-00-00 00:00:00','$res_order_table')";

        $resinsresorder = $dbhandler0->insert($sqlinstoresorder);    

        if ($resinsuseroder == $qr_id && $resinsresorder == $qr_id)
        {
            $sqldeleteoqr = "DELETE FROM qrcode where i_qr_id = '$qr_id' and i_qr_type_id = 1";
            $resdeleteqr = $dbhandler0->delete($sqldeleteoqr);
        }
     }

    if ($resinsuseroder != '' AND $resinsresorder !='' AND $resdeleteqr != '')
    {
        generatefirebase('','','BACK_TO_MAIN',$user_id,'','',2);//generatefirebase($title,$body,$broadcast,$userid,$resuserid,$token,$mode);
    }
    return $resdeleteqr;
}
?>
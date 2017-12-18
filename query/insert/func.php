<?php

include "system/function.php";

//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function insertnewqrcoderow() {
    global $dbhandler0;
    $dbhandler0->begin(); 
    $jsonfoodorderdata = !empty($_POST['jsonfoodorderdata']) ? $_POST['jsonfoodorderdata'] : '[]';
    $jsonfoodorderdata=str_replace("'","\'", $jsonfoodorderdata);
    $qrtypenew = !empty($_POST['qrtypenew']) ? $_POST['qrtypenew'] : '';
    $resid_insert = !empty($_POST['resid_insert']) ? $_POST['resid_insert'] : '';
    $userid_insert = !empty($_POST['userid_insert']) ? $_POST['userid_insert'] : 0;

    $foodresult = array();
    $foodpriceresult = array();  
    $finalfoodresult = array();

    $foodtypearray = array();  

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
    '[]',
    '$jsonfoodorderdata')";

    $res = $dbhandler0->insert($sqlcheck,1);
    $last_id = $res;
    if ($last_id > 0)
    {
       $arrayfoodorderdata = json_decode($jsonfoodorderdata);
            $sqlitem = "CREATE TEMPORARY TABLE temp_item LIKE item;";
            $resitem = $dbhandler0->insert($sqlitem,1); 
        foreach ($arrayfoodorderdata as $data) 
        {
            $food_item_id = $data->food_id;
            $price_item_id = $data->price_id;
            $item_quantity = $data->quantity;
            $item_remark = $data->remark;           
            $sqlitem = "INSERT INTO temp_item (i_order_id,i_food_id,i_price_id,i_quantity,va_remark,dt_itemcreate,i_status) VALUES ($last_id,$food_item_id,$price_item_id,$item_quantity,'$item_remark',now(),0)";
            $resitem = $dbhandler0->insert($sqlitem,1);
        }
            $jsondata = generatejsonfromitem_temp($last_id,'0'); 
            $jsondata=str_replace("'","\'", $jsondata); 
            $sqlfoodinsert = "UPDATE qrcode set va_qr_data_1 = '$jsondata' WHERE i_qr_id = $last_id";
            $ressqlfoodinsert = $dbhandler0->update($sqlfoodinsert);   
    }  

    if ($last_id>0 AND $resitem>0)
    {
            $sqlqrcode = "SELECT * FROM qrcode WHERE i_qr_id = '$last_id' LIMIT 1";
            $resqrcode = $dbhandler0->query($sqlqrcode);
            $finalresult = array (
                'i_res_id' => $resqrcode[0]['i_res_id'],
                'i_qr_id' => $last_id
                    );
            $dbhandler0->commit();  
            return $finalresult;            
    }
    else    
    {
            $sqlauto = "ALTER TABLE qrcode AUTO_INCREMENT = 1"; 
            $res = $dbhandler0->update($sqlauto);
            $sqlauto = "ALTER TABLE item AUTO_INCREMENT = 1";
            $res = $dbhandler0->update($sqlauto);  

            $dbhandler0->rollback(); 
            $dbhandler0->commit();         
    }    

}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function insertnewuser() {
        global $dbhandler0;
        $dbhandler0->begin(); 
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

        $c = uniqid (rand(), true);
        $md5c = md5($c);  

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
        va_token,
        va_uuid)
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
        '$tokennew' ,       
        '$md5c')";

        $res = $dbhandler0->insert($sqlcheck,1);
        $last_id = $res;
     
        if ($last_id > 0)
        {
            $dbhandler0->commit();
            return $last_id;
        }
        else
        {
            $dbhandler0->rollback();  
            $dbhandler0->commit();
            return false;      
        }      
    }
    else
    {
        if ($resuser[0]['va_facebook'] != '')
        {
          $facebooknew = $resuser[0]['va_facebook'];
        }
        if ($resuser[0]['va_google'] != '')
        {
          $googlenew = $resuser[0]['va_google'];
        }        
        if ($facebooknew != '' or $googlenew != '')
        {
            $res_i_user_id=$resuser[0]['i_user_id'];
            $sqlcheckupdate = "UPDATE user SET

            va_facebook = '$facebooknew',
            va_google = '$googlenew'
            WHERE i_user_id = '$res_i_user_id'"; 
            $resupdate = $dbhandler0->update($sqlcheckupdate,1);
            if ($resupdate)
            {
                $dbhandler0->commit();
                return $res_i_user_id;
            }    
        }
        else
        {
            $dbhandler0->rollback();     
            $dbhandler0->commit();     
            return -3;
        }
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function insertorderfromqr() {
    global $dbhandler0;
    $dbhandler0->begin(); 
    $qr_id = !empty($_POST['qr_id']) ? $_POST['qr_id'] : '';
    $res_order_table = !empty($_POST['res_order_table']) ? $_POST['res_order_table'] : 0;
    $sqlqr = "SELECT * FROM qrcode where i_qr_id = '$qr_id' and i_qr_type_id = 1 LIMIT 1";

    $resqr = $dbhandler0->query($sqlqr);
    $sqlfoodjson = array();
     if ($resqr)
     {
        $res_id = $resqr[0]['i_res_id'];
        $user_id = $resqr[0]['i_user_id'];
        $qr_type_id = $resqr[0]['i_qr_type_id'];
        $qr_data_1 = !empty($resqr[0]['va_qr_data_1']) ? $resqr[0]['va_qr_data_1'] : '[]';        
        $qr_data_1=str_replace("'","\'", $qr_data_1);
        $qr_data_2 = !empty($resqr[0]['va_qr_data_2']) ? $resqr[0]['va_qr_data_2'] : '[]';
        $qr_data_2=str_replace("'","\'", $qr_data_2);
        $create_date = $resqr[0]['dt_create'];

        $sqlfoodjson = json_decode($resqr[0]['va_qr_data_2']);

        foreach ($sqlfoodjson as $data) 
        {
            $food_item_id = $data->food_id;
            $price_item_id = $data->price_id;
            $item_quantity = $data->quantity;
            $item_remark = $data->remark;           
            $sqlitem = "INSERT INTO item (i_order_id,i_food_id,i_price_id,i_quantity,va_remark,dt_itemcreate,i_status) VALUES ($qr_id,$food_item_id,$price_item_id,$item_quantity,'$item_remark',now(),1)";
            $resitem = $dbhandler0->insert($sqlitem,1);
        }

        $jsondata = generatejsonfromitem($qr_id,'1');
        $jsondata=str_replace("'","\'", $jsondata);
        $sqlinstouserorder = 
        "INSERT INTO 
        userorder (i_userorder_id,i_res_id,i_user_id,i_userorder_type_id,va_userorder_data_1,va_userorder_data_2,dt_create,i_status,dt_userordercreate,dt_userorderclosed,i_user_order_table_id) 
        values ('$qr_id','$res_id','$user_id','$qr_type_id','$jsondata','$qr_data_2','$create_date',1,now(),'0000-00-00 00:00:00','$res_order_table')";

        $resinsuseroder = $dbhandler0->insert($sqlinstouserorder,1);

        $sqlinstoresorder = 
        "INSERT INTO 
        resorder (i_resorder_id,i_res_id,i_user_id,i_resorder_type_id,va_resorder_data_1,va_resorder_data_2,dt_create,i_status,dt_resordercreate,dt_resorderclosed,i_res_order_table_id) 
        values ('$qr_id','$res_id','$user_id','$qr_type_id','$jsondata','$qr_data_2','$create_date',1,now(),'0000-00-00 00:00:00','$res_order_table')";

        $resinsresorder = $dbhandler0->insert($sqlinstoresorder,1);    

        if ($resinsuseroder == $qr_id && $resinsresorder == $qr_id)
        {
            $sqldeleteoqr = "DELETE FROM qrcode where i_qr_id = '$qr_id' and i_qr_type_id = 1";
            $resdeleteqr = $dbhandler0->delete($sqldeleteoqr,1);
        }
     

        if ($resinsuseroder != '' AND $resinsresorder !='' AND $resdeleteqr != '')
            {
                generatefirebase('','','BACK_TO_MAIN',$user_id,'','',2);//generatefirebase($title,$body,$broadcast,$userid,$resuserid,$token,$mode);
                $dbhandler0->commit();  
                return true;
            }
        else
            {
                $dbhandler0->rollback(); 
                $dbhandler0->commit();  
                return false;
            }
        }
        else
        {
            return false;
        }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function insertitem() {
    global $dbhandler0;
    $dbhandler0->begin(); 
    
    $order_id = !empty($_POST['order_id']) ? $_POST['order_id'] : '';
    $food_id = !empty($_POST['food_id']) ? $_POST['food_id'] : '';
    $price_id = !empty($_POST['price_id']) ? $_POST['price_id'] : '';
    $item_quantity = !empty($_POST['item_quantity']) ? $_POST['item_quantity'] : 0;
    $item_remark = !empty($_POST['item_remark']) ? $_POST['item_remark'] : '';
    $item_remark=str_replace("'","\'", $item_remark);
    $item_status = !empty($_POST['item_status']) ? $_POST['item_status'] : 0;
    $sqluserorder = "SELECT 1 FROM userorder where i_userorder_id = '$order_id' LIMIT 1";
    $resuserorder = $dbhandler0->query($sqluserorder);

    if ($resuserorder)
    {
    $sqlitem = "INSERT INTO item (i_order_id,i_food_id,i_price_id,i_quantity,va_remark,dt_itemcreate,i_status) 
    VALUES ($order_id,$food_id,$price_id,$item_quantity,'$item_remark',now(),$item_status)";

    $resitem = $dbhandler0->insert($sqlitem,1);

        if ($resitem)
        {

            $jsondata = generatejsonfromitem($order_id,'0');  
            $jsondata=str_replace("'","\'", $jsondata);
            
            $sqlupdate = "UPDATE userorder SET va_userorder_data_2 = '$jsondata' WHERE i_userorder_id = $order_id";
            $ressqlupdate = $dbhandler0->update($sqlupdate);
            $sqlupdate = "UPDATE resorder SET va_resorder_data_2 = '$jsondata' WHERE i_resorder_id = $order_id";
            $ressqlupdate = $dbhandler0->update($sqlupdate);

            $jsondata = generatejsonfromitem($order_id,'1');  
            $jsondata=str_replace("'","\'", $jsondata);
            
            $sqlupdate = "UPDATE userorder SET va_userorder_data_1 = '$jsondata' WHERE i_userorder_id = $order_id";
            $ressqlupdate = $dbhandler0->update($sqlupdate);
            $sqlupdate = "UPDATE resorder SET va_resorder_data_1 = '$jsondata' WHERE i_resorder_id = $order_id";
            $ressqlupdate = $dbhandler0->update($sqlupdate);

            $dbhandler0->commit();  
            return $resitem;
        }   
        else
        {
            $dbhandler0->rollback(); 
            $dbhandler0->commit();
            return false;               
        } 
    }
    else
    {
    $dbhandler0->rollback(); 
    $dbhandler0->commit();  
    return false;    
    }         
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function insertnewusertoken() {
    global $dbhandler0;
    $dbhandler0->begin(); 
    
    $email = !empty($_POST['email']) ? $_POST['email'] : '';

    $sqlsearchuser = "SELECT i_user_id,va_first_name,va_last_name FROM user where va_email = '$email' LIMIT 1";
    $ressearchuser = $dbhandler0->query($sqlsearchuser);
    $recipientname = $ressearchuser[0]['va_first_name'].' '.$ressearchuser[0]['va_last_name'];

    if (empty($ressearchuser))
    {
        return false;
    }

    $user_id = $ressearchuser[0]['i_user_id'];

    $sqlsearchusertoken = "SELECT * FROM usertoken where i_user_id = '$user_id' LIMIT 1";
    $ressearchusertoken = $dbhandler0->query($sqlsearchusertoken);   

    $token = openssl_random_pseudo_bytes(16);
    $token = bin2hex($token);

    $subject = 'Reset Password For Dimchoi Account';

    $body = '<h1>Please Click The Link Below to Redirect To Our Page For Reset Password</h1><br><br>';
    $link = 'http://103.233.1.196/dimchoi/forgotpassword.php?token='.$token;
    $finalbody = $body.'<h1>'.$link.'</h1>';

    if ($ressearchusertoken)
    {
    $sqlupdatetoken = "UPDATE usertoken SET va_forgot_token = '$token',dt_create=now() WHERE i_user_id = $user_id";
    $resupdatetoken = $dbhandler0->update($sqlupdatetoken);
    sendmail($email,$recipientname,$subject,$finalbody);
    return $resupdatetoken;
    }
    else        
    {    
    $sqlinserttoken = "INSERT INTO usertoken (i_user_id,va_forgot_token,dt_create,i_token_expired) 
    VALUES ($user_id,'$token',now(),'1800')";
    $reinsertoken = $dbhandler0->update($sqlinserttoken);
    sendmail($email,$recipientname,$subject,$finalbody);
    return $reinsertoken;
    }         
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function generatejsonfromitem ($last_id,$item_status)
{
$foodtypeloop = array();    
global $dbhandler0;
$sqlfood = 
"SELECT d.va_food_type_name,d.i_food_type_id,b.va_food_name,b.i_food_id,c.va_food_size,FORMAT(c.d_food_price,2) AS d_food_price,c.i_price_id,a.i_quantity,a.va_remark,a.i_status,b.va_food_pic_url
,a.dt_itemcreate,e.va_item_status,a.i_item_id,a.i_status,b.va_food_code 
FROM item a
LEFT JOIN food b on a.i_food_id = b.i_food_id
LEFT JOIN food_price c on a.i_price_id = c.i_price_id AND a.i_food_id = c.i_food_id 
LEFT JOIN food_type d on d.i_food_type_id = b.i_food_type_id
LEFT JOIN itemstatus e on e.i_item_status_id = a.i_status
WHERE a.i_order_id = '$last_id'";

if ($item_status != '')
{
$sqlfood .= " and a.i_status = '$item_status'";
}

$sqlfood .= " ORDER BY a.dt_itemcreate ASC";

$resfood = $dbhandler0->query($sqlfood);

$sqlhqid = 
"SELECT b.i_hq_id FROM qrcode a LEFT JOIN restaurant b on a.i_res_id = b.i_res_id WHERE a.i_qr_id = '$last_id'";    
$reshqid = $dbhandler0->query($sqlhqid);
$hqid = $reshqid[0]['i_hq_id'];

$sqlrescode = 
"SELECT va_res_code FROM restaurant where i_hq_id = '$hqid' LIMIT 1";    
$resrescode = $dbhandler0->query($sqlrescode);
$rescode = $resrescode[0]['va_res_code'];

foreach($resfood as $foodtypedata){
    if ( in_array($foodtypedata['va_food_type_name'], $foodtypeloop) ) {
        continue;
    }
    $foodtypeloop[] = $foodtypedata['va_food_type_name'];

    $foodtypearray[] = ['food_type' => $foodtypedata['va_food_type_name'],'food_type_id' => $foodtypedata['i_food_type_id'] ];
}

foreach($foodtypearray as $data1){    

    foreach($resfood as $data2){
                if ($data1['food_type'] == $data2['va_food_type_name'])
                {
                $foodpriceresult[] = [
                                'item_id' => $data2['i_item_id'],
                                'price_id' => $data2['i_price_id'],
                                'price' => $data2['d_food_price'],
                                'quantity' => $data2['i_quantity'],
                                'size' => $data2['va_food_size'],
                                'remark' => $data2['va_remark'],
                                'item_create_date' => $data2['dt_itemcreate'],
                                'status' => $data2['va_item_status'],
                                'statusid' => $data2['i_status']
                                ];   

                $foodresult[] = [
                                'name' => $data2['va_food_name'],
                                'foodcode' => $data2['va_food_code'],
                                'order' => $foodpriceresult,
                                'image_url' => $_SESSION['file'].$rescode.'/'.$data2['va_food_pic_url'],
                                'food_id' => $data2['i_food_id'],
                                ]; 
                }  
                unset($foodpriceresult);               
    }

    $finalfoodresult[] = 
    [
    'food_type' => $data1['food_type'],
    'food_type_id' => $data1['food_type_id'],
    'menu' => $foodresult
    ];

    unset($foodresult);
}
$finalfoodresult=str_replace("'","\'", $finalfoodresult);
$finalfoodresultjson = json_encode($finalfoodresult,JSON_UNESCAPED_SLASHES);
$finalfoodresultjson = !empty($finalfoodresultjson) ? $finalfoodresultjson : '[]';
return $finalfoodresultjson;
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function generatejsonfromitem_temp ($last_id,$item_status)
{
$foodtypeloop = array();    
global $dbhandler0;
$sqlfood = 
"SELECT d.va_food_type_name,d.i_food_type_id,b.va_food_name,b.i_food_id,c.va_food_size,FORMAT(c.d_food_price,2) AS d_food_price,c.i_price_id,a.i_quantity,a.va_remark,a.i_status,b.va_food_pic_url
,a.dt_itemcreate,e.va_item_status,a.i_item_id,a.i_status,b.va_food_code 
FROM temp_item a
LEFT JOIN food b on a.i_food_id = b.i_food_id
LEFT JOIN food_price c on a.i_price_id = c.i_price_id AND a.i_food_id = c.i_food_id 
LEFT JOIN food_type d on d.i_food_type_id = b.i_food_type_id
LEFT JOIN itemstatus e on e.i_item_status_id = a.i_status
WHERE a.i_order_id = '$last_id'";

if ($item_status != '')
{
$sqlfood .= " and a.i_status = '$item_status'";
}

$sqlfood .= " ORDER BY a.dt_itemcreate ASC";

$resfood = $dbhandler0->query($sqlfood);

$sqlhqid = 
"SELECT b.i_hq_id FROM qrcode a LEFT JOIN restaurant b on a.i_res_id = b.i_res_id WHERE a.i_qr_id = '$last_id'";    
$reshqid = $dbhandler0->query($sqlhqid);
$hqid = $reshqid[0]['i_hq_id'];

$sqlrescode = 
"SELECT va_res_code FROM restaurant where i_hq_id = '$hqid' LIMIT 1";    
$resrescode = $dbhandler0->query($sqlrescode);
$rescode = $resrescode[0]['va_res_code'];

foreach($resfood as $foodtypedata){
    if ( in_array($foodtypedata['va_food_type_name'], $foodtypeloop) ) {
        continue;
    }
    $foodtypeloop[] = $foodtypedata['va_food_type_name'];

    $foodtypearray[] = ['food_type' => $foodtypedata['va_food_type_name'],'food_type_id' => $foodtypedata['i_food_type_id'] ];
}

foreach($foodtypearray as $data1){    

    foreach($resfood as $data2){
                if ($data1['food_type'] == $data2['va_food_type_name'])
                {
                $foodpriceresult[] = [
                                'item_id' => $data2['i_item_id'],
                                'price_id' => $data2['i_price_id'],
                                'price' => $data2['d_food_price'],
                                'quantity' => $data2['i_quantity'],
                                'size' => $data2['va_food_size'],
                                'remark' => $data2['va_remark'],
                                'item_create_date' => $data2['dt_itemcreate'],
                                'status' => $data2['va_item_status'],
                                'statusid' => $data2['i_status']
                                ];   

                $foodresult[] = [
                                'name' => $data2['va_food_name'],
                                'foodcode' => $data2['va_food_code'],
                                'order' => $foodpriceresult,
                                'image_url' => $_SESSION['file'].$rescode.'/'.$data2['va_food_pic_url'],
                                'food_id' => $data2['i_food_id'],
                                ]; 
                }  
                unset($foodpriceresult);               
    }

    $finalfoodresult[] = 
    [
    'food_type' => $data1['food_type'],
    'food_type_id' => $data1['food_type_id'],
    'menu' => $foodresult
    ];

    unset($foodresult);
}
$finalfoodresult=str_replace("'","\'", $finalfoodresult);
$finalfoodresultjson = json_encode($finalfoodresult,JSON_UNESCAPED_SLASHES);
$finalfoodresultjson = !empty($finalfoodresultjson) ? $finalfoodresultjson : '[]';
return $finalfoodresultjson;
}
function sendmail($recipientemail,$recipientname,$subject,$body)
{
    $mail = new PHPMailer;
    $mail->isSMTP();                                   // Set mailer to use SMTP
    $mail->Host = 'mail.maxisthemax.com';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                            // Enable SMTP authentication
    $mail->Username = 'test@maxisthemax.com';          // SMTP username
    $mail->Password = '123qweasdzxc'; // SMTP password
    $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                 // TCP port to connect to
    $mail->setFrom('dimchoi.my@gmail.com', 'Max Leong');
    $mail->addAddress($recipientemail, $recipientname);   // Add a recipient
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
        // visit our site www.studyofcs.com for more learning
    }
}

?>
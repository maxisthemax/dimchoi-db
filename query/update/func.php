<?php
function closeorder() 
{
    global $dbhandler0;
    $dbhandler0->begin();
    $_POST['user_order_id']=$_POST['order_id'];
    $_POST['user_order_status']=99;    

    $_POST['res_order_id']=$_POST['order_id'];
    $_POST['res_order_status']=99;
    $order_id=$_POST['order_id'];
    $sqlcloseitem = "UPDATE item set i_status = 99 where i_order_id = '$order_id'";
    $rescloseitem = $dbhandler0->update($sqlcloseitem);

    $_POST['order_data_1'] = generatejsonfromitem($order_id);
    
    if (updateuserorderstatus(1) == true AND updateresorderstatus(1) == true AND syncorderdata() == true)
    {
    	unset($_POST['order_id']);
        unset($_POST['order_data_1']);
        $dbhandler0->commit();
        return true;
    }
    else
    {
    	unset($_POST['order_id']);
        unset($_POST['order_data_1']);
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
function syncorderdata() 
{
    global $dbhandler0;
    $dbhandler0->begin();    
    $_POST['user_order_id']=$_POST['order_id'];
    $_POST['user_order_data_1']=$_POST['order_data_1'];    
    $_POST['user_order_data_2']=$_POST['order_data_2'];

    $_POST['res_order_id']=$_POST['order_id'];
    $_POST['res_order_data_1']=$_POST['order_data_1'];    
    $_POST['res_order_data_2']=$_POST['order_data_2'];   

    unset($_POST['order_id']);   
    unset($_POST['order_data_1']); 
    unset($_POST['order_data_2']);    

    if (updateuserorderdata(1) == true AND updateresorderdata(1) == true)
    {
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
        return false;
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
        if ($res)
        {    
            return true;
        }  
        }  
    }
}        
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateresorderstatus($mode=0) 
{
    global $dbhandler0;

//define variable for query >>>       
    $res_order_id = !empty($_POST['res_order_id']) ? $_POST['res_order_id'] : ''; 
    $res_order_status = !empty($_POST['res_order_status']) ? $_POST['res_order_status'] : ''; 

    if ($res_order_status == 99)
    {
        $time = date("Y-m-d H:i:s");
    }
    else
    {
        $time = "0000-00-00 00:00:00";    
    }        
//define variable for query <<<  

    if ($res_order_id > 0)
    {
        $sqlcheck = "SELECT 1 FROM resorder where i_resorder_id = $res_order_id";
        $rescheck= $dbhandler0->query($sqlcheck); 
        if($rescheck)
        {        
         $sqlcheck = 
            "UPDATE resorder 
            SET i_status = '$res_order_status', dt_resorderclosed = '$time'
            where i_resorder_id = '$res_order_id'";
            $res = $dbhandler0->update($sqlcheck,$mode);
        return $res; 
        }   
    }
}        
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateuserorderstatus($mode=0) 
{
    global $dbhandler0;

//define variable for query >>>       
    $user_order_id = !empty($_POST['user_order_id']) ? $_POST['user_order_id'] : ''; 
    $user_order_status = !empty($_POST['user_order_status']) ? $_POST['user_order_status'] : ''; 

    if ($user_order_status == 99)
    {
        $time = date("Y-m-d H:i:s");
    }
    else
    {
        $time = "0000-00-00 00:00:00";    
    }    

//define variable for query <<<  

    if ($user_order_id > 0)
    {
        $sqlcheck = "SELECT 1 FROM userorder where i_userorder_id = $user_order_id";
        $rescheck= $dbhandler0->query($sqlcheck); 
        if($rescheck)
        {        
         $sqlcheck = 
            "UPDATE userorder 
            SET i_status = '$user_order_status', dt_userorderclosed = '$time'
            where i_userorder_id = '$user_order_id'";
            $res = $dbhandler0->update($sqlcheck,$mode);
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
        $order_id = $res_order_id;  
        $sqlqrtable = 
            "UPDATE resorder 
            SET i_res_order_table_id = '$res_order_table'
            where i_resorder_id = '$order_id'";
            $restable = $dbhandler0->update($sqlqrtable);

        $sqlqrtable = 
            "UPDATE userorder 
            SET i_user_order_table_id = '$res_order_table'
            where i_userorder_id = '$order_id'";
            $usertable = $dbhandler0->update($sqlqrtable);

            if ($restable and $usertable)
            {
                return true;
            }
            else
            { 
                return false;
            }    
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
function updateresorderdata($mode=0) 
{
    global $dbhandler0;
//define variable for query >>>       
    $res_order_id = !empty($_POST['res_order_id']) ? $_POST['res_order_id'] : ''; 
//define variable for query <<< 
    if ($res_order_id > 0)
    {    
        $sqlcheck = "SELECT * FROM resorder where i_resorder_id = $res_order_id LIMIT 1";
        $rescheck= $dbhandler0->query($sqlcheck);

        if($rescheck)
        {
        //define variable for query >>>       
            $res_order_data_1 = addslashes(!empty($_POST['res_order_data_1'])? $_POST['res_order_data_1'] : $rescheck[0]['va_resorder_data_1']);
            $res_order_data_2 = addslashes(!empty($_POST['res_order_data_2'])? $_POST['res_order_data_2'] : $rescheck[0]['va_resorder_data_2']);
        //define variable for query <<<

            if (!empty($_POST['res_order_data_1']) AND $_POST['res_order_data_1'] == '')
            {
                $res_order_data_1 = '';
            }
            if (!empty($_POST['res_order_data_2']) AND $_POST['res_order_data_2'] == '')
            {
                $res_order_data_2 = '';
            }

            if (!empty($res_order_data_1) OR !empty($res_order_data_2))
            {            
            $sqlorderdata = 
                "UPDATE resorder 
                SET va_resorder_data_1 = '$res_order_data_1',va_resorder_data_2 = '$res_order_data_2'
                where i_resorder_id = $res_order_id";

                $resorderdata= $dbhandler0->update($sqlorderdata,$mode);
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
function updateuserorderdata($mode=0) 
{   
    global $dbhandler0;
//define variable for query >>>       
    $user_order_id = !empty($_POST['user_order_id']) ? $_POST['user_order_id'] : ''; 
//define variable for query <<< 
    if ($user_order_id > 0)
    {    
        $sqlcheck = "SELECT * FROM userorder where i_userorder_id = $user_order_id LIMIT 1";
        $rescheck= $dbhandler0->query($sqlcheck);

        if($rescheck)
        {    
        //define variable for query >>>       
            $user_order_data_1 = addslashes(!empty($_POST['user_order_data_1'])? $_POST['user_order_data_1'] : $rescheck[0]['va_userorder_data_1']);
            $user_order_data_2 = addslashes(!empty($_POST['user_order_data_2'])? $_POST['user_order_data_2'] : $rescheck[0]['va_userorder_data_2']);
        //define variable for query <<<
            
            if (!empty($user_order_data_1) OR !empty($user_order_data_2))
            {            
            $sqlorderdata = 
                "UPDATE userorder 
                SET va_userorder_data_1 = '$user_order_data_1',va_userorder_data_2 = '$user_order_data_2'
                where i_userorder_id = $user_order_id";

                $resorderdata= $dbhandler0->update($sqlorderdata,$mode);
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
function updateitemstatus() {
    global $dbhandler0;
    $dbhandler0->begin(); 
    
    $item_id = !empty($_POST['item_id']) ? $_POST['item_id'] : '';
    $item_status = !empty($_POST['item_status']) ? $_POST['item_status'] : 0;


    $sqlitem = "UPDATE item SET i_status=$item_status WHERE i_item_id = $item_id";

    $resitem = $dbhandler0->update($sqlitem,1);

    $sqlorderid = "SELECT i_order_id FROM item WHERE i_item_id = $item_id LIMIT 1";

    $resorderid  = $dbhandler0->query($sqlorderid);

    $order_id = $resorderid[0]['i_order_id'];

    if ($resitem)
    {
        if ($item_status==1)
        {    
            $jsondata = generatejsonfromitem($order_id,'1');  
            $jsondata=str_replace("'","\'", $jsondata);
            
            $sqlupdate = "UPDATE userorder SET va_userorder_data_1 = '$jsondata' WHERE i_userorder_id = $order_id";
            $ressqlupdate1 = $dbhandler0->update($sqlupdate);
            $sqlupdate = "UPDATE resorder SET va_resorder_data_1 = '$jsondata' WHERE i_resorder_id = $order_id";
            $ressqlupdate2 = $dbhandler0->update($sqlupdate);

            unset($jsondata);

            $jsondata = generatejsonfromitem($order_id,'0');  
            $jsondata=str_replace("'","\'", $jsondata);
            $sqlupdate = "UPDATE userorder SET va_userorder_data_2 = '$jsondata' WHERE i_userorder_id = $order_id";
            $ressqlupdate3 = $dbhandler0->update($sqlupdate);
            $sqlupdate = "UPDATE resorder SET va_resorder_data_2 = '$jsondata' WHERE i_resorder_id = $order_id";
            $ressqlupdate4 = $dbhandler0->update($sqlupdate);

            if ($ressqlupdate1 and $ressqlupdate2 and $ressqlupdate3 and $ressqlupdate4)
            {    
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
            $dbhandler0->commit();  
            return true;
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
function updateresetpassword() {
    global $dbhandler0;

    $token = $_POST['token'];

    $sql = "SELECT 1 FROM usertoken where va_forgot_token = '$token'";
    $ressql  = $dbhandler0->query($sql);    

    if (!$ressql)
    {
        return false;
    }

    $user_id = $_POST['userid'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if ($password != $repassword)
    {
        return false;
    }

    $sql = "SELECT * FROM user where i_user_id = '$user_id'";
    $ressql  = $dbhandler0->query($sql);

    if ($ressql)
    {

    $updatesql = "UPDATE user SET va_pass = '$password' where i_user_id = '$user_id'";
    $ressqlupdate  = $dbhandler0->update($updatesql); 

    if ($ressqlupdate)
        {
            $deletesql = "DELETE FROM usertoken where i_user_id = '$user_id'";  
            $resdelete = $dbhandler0->delete($deletesql); 
            return $resdelete;       
        }
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
$finalfoodresult = array(); 
global $dbhandler0;
$sqlfood = 
"SELECT d.va_food_type_name,d.i_food_type_id,b.va_food_name,b.i_food_id,c.va_food_size,FORMAT(c.d_food_price,2) AS d_food_price,c.i_price_id,a.i_quantity,a.va_remark,a.i_status,b.va_food_pic_url
,a.dt_itemcreate,e.va_item_status,a.i_item_id,b.va_food_code,a.i_status
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

if ($reshqid == '')
{
$sqlhqid = "SELECT b.i_hq_id FROM userorder a LEFT JOIN restaurant b on a.i_res_id = b.i_res_id WHERE a.i_userorder_id = '$last_id'";    
$reshqid = $dbhandler0->query($sqlhqid);  
}

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
return $finalfoodresultjson;
}
?>
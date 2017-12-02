<?php

include "system/function.php";

//====================================================================================================== 
function insertnewqrcoderow() {
    global $dbhandler0;
    $dbhandler0->begin(); 
    $jsonfoodorderdata = !empty($_POST['jsonfoodorderdata']) ? $_POST['jsonfoodorderdata'] : '';
    $jsonfoodorderdata=str_replace("'","\'", $jsonfoodorderdata);
    $qrtypenew = !empty($_POST['qrtypenew']) ? $_POST['qrtypenew'] : '';
    $resid_insert = !empty($_POST['resid_insert']) ? $_POST['resid_insert'] : '';
    $userid_insert = !empty($_POST['userid_insert']) ? $_POST['userid_insert'] : 0;

    $foodresult = array();
    $foodpriceresult = array();  
    $finalfoodresult = array();

    $foodtypeloop = array();
    $foodtypearray = array();  

    $sqlcheck = 
    "INSERT INTO qrcode (
    i_res_id,
    i_user_id,
    i_qr_type_id)
    VALUES (
    '$resid_insert',
    '$userid_insert',
    '$qrtypenew')";

    $res = $dbhandler0->insert($sqlcheck,1);
    $last_id = $res;
    if ($last_id > 0)
    {
       $arrayfoodorderdata = json_decode($jsonfoodorderdata);

        foreach ($arrayfoodorderdata as $data) 
        {
            $food_item_id = $data->food_id;
            $price_item_id = $data->price_id;
            $item_quantity = $data->quantity;
            $item_remark = $data->remark;
            $sqlitem = "INSERT INTO item (i_order_id,i_food_id,i_price_id,i_quantity,va_remark,dt_itemcreate,i_status) VALUES ($last_id,$food_item_id,$price_item_id,$item_quantity,'$item_remark',now(),0)";
            $resitem = $dbhandler0->insert($sqlitem,1);
        }

            $sqlfood = 
            "SELECT d.va_food_type_name,d.i_food_type_id,b.va_food_name,b.i_food_id,c.va_food_size,FORMAT(c.d_food_price,2) AS d_food_price,c.i_price_id,a.i_quantity,a.va_remark,a.i_status,b.va_food_pic_url
            ,a.dt_itemcreate
            FROM item a
            LEFT JOIN food b on a.i_food_id = b.i_food_id
            LEFT JOIN food_price c on a.i_price_id = c.i_price_id AND a.i_food_id = c.i_food_id 
            LEFT JOIN food_type d on d.i_food_type_id = b.i_food_type_id
            WHERE a.i_order_id = '$last_id'
            ORDER BY i_food_type_order ASC";    
            $resfood = $dbhandler0->query($sqlfood);

            $sqlhqid = 
            "SELECT i_hq_id FROM restaurant where i_res_id = '$resid_insert' LIMIT 1";    
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
                                            'price_id' => $data2['i_price_id'],
                                            'price' => $data2['d_food_price'],
                                            'quantity' => $data2['i_quantity'],
                                            'size' => $data2['va_food_size'],
                                            'remark' => $data2['va_remark'],
                                            'item_create_date' => $data2['dt_itemcreate'],
                                            'status' => $data2['i_status']
                                            ];   

                            $foodresult[] = [
                                            'name' => $data2['va_food_name'],
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

            $sqlfoodinsert = "UPDATE qrcode set va_qr_data_1 = '$finalfoodresultjson' WHERE i_qr_id = $last_id";
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
//====================================================================================================== 
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

        $res = $dbhandler0->insert($sqlcheck,1);
        $last_id = $res;
     
        if ($last_id > 0)
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
                return true;
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
//====================================================================================================== 
function insertorderfromqr() {
    global $dbhandler0;
    $dbhandler0->begin(); 
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
        userorder (i_userorder_id,i_res_id,i_user_id,i_userorder_type_id,va_userorder_data_1,va_userorder_data_2,dt_create,i_status,dt_userordercreate,dt_userorderclosed) 
        values ('$qr_id','$res_id','$user_id','$qr_type_id','$qr_data_1','$qr_data_2','$create_date',1,now(),'0000-00-00 00:00:00')";

        $resinsuseroder = $dbhandler0->insert($sqlinstouserorder,1);

        $sqlinstoresorder = 
        "INSERT INTO 
        resorder (i_resorder_id,i_res_id,i_user_id,i_resorder_type_id,va_resorder_data_1,va_resorder_data_2,dt_create,i_status,dt_resordercreate,dt_resorderclosed,i_res_order_table_id) 
        values ('$qr_id','$res_id','$user_id','$qr_type_id','$qr_data_1','$qr_data_2','$create_date',1,now(),'0000-00-00 00:00:00','$res_order_table')";

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
?>
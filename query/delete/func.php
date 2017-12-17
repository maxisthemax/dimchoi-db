<?php
function deleteitem() {
    global $dbhandler0;
    $dbhandler0->begin(); 
    
    $item_id = !empty($_POST['item_id']) ? $_POST['item_id'] : '';

    $sqlorderid = "SELECT i_order_id FROM item WHERE i_item_id = $item_id LIMIT 1";

    $resorderid  = $dbhandler0->query($sqlorderid);

    $order_id = $resorderid[0]['i_order_id'];

    if ($item_id > 0)
    {
    $sqlitem = "DELETE FROM item WHERE i_item_id = $item_id";
    $resitem = $dbhandler0->delete($sqlitem,1);
    }

    if ($resitem)
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
        $dbhandler0->rollback(); 
        $dbhandler0->commit();
        return false;               
    }       
  
}
//=====================================================================================================================================
//=====================================================================================================================================
//=====================================================================================================================================
//=====================================================================================================================================
//=====================================================================================================================================
function deleteqrcode() {
    global $dbhandler0;
    $dbhandler0->begin(); 
    
    $qrid = !empty($_POST['qrid']) ? $_POST['qrid'] : '';

    $sqldeleteqr = "DELETE FROM qrcode WHERE i_qr_id = $qrid" 
    $resdeleteqr = $dbhandler0->delete($sqldeleteqr,1);    
    $dbhandler0->commit();    
    return
}
//=====================================================================================================================================
//=====================================================================================================================================
//=====================================================================================================================================
//=====================================================================================================================================
//=====================================================================================================================================

function generatejsonfromitem ($last_id,$item_status)
{
$finalfoodresult = array();
$foodtypeloop = array();    
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
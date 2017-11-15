<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
echo'<FORM id=getfoodtypeform action="development.php" method="post"><table>';
echo'<select name=Options id=Options><option></option></select>';
echo'</table><br><br></FORM>';
if (isset($_POST['Options']))
{
$_SESSION['Options']=$_POST['Options'];
}
if (isset($_SESSION['Options'])) {
    if ($_SESSION['Options'] != '')
    {
    getfoodtype($_SESSION['Options']);
    echo("<br><br>");
    getbevtype($_SESSION['Options']);
    }
}
else
{
    $_SESSION['Options'] = '';
}

function getfoodtype($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;
    
    $sqlfoodtype = "SELECT DISTINCT a.*
    FROM food_type a 
    LEFT JOIN restaurant b on b.i_hq_id = a.i_res_id
    WHERE b.i_res_id = $resid ORDER BY a.i_food_type_order ASC";

    $resfoodtype = $dbhandler0->query($sqlfoodtype);
    


    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>FOOD TYPE</td></tr>";    
    echo "<tr><td width=10%>Food Type ID</td><td width=10%>Food Type Name</td><td width=10%>Food Pic URL</td><td width=10%>Food Type Ordering No</td><td width=10%></td>";

    foreach($resfoodtype as $resfoodtypevalue) 
    {
        $foodtypeid = $resfoodtypevalue['i_food_type_id'];    
        echo "<tr><td>".$resfoodtypevalue['i_food_type_id'];
        echo "</td><td><input name = foodtypename[$foodtypeid] id = foodtypename[$foodtypeid] value ='".$resfoodtypevalue['va_food_type_name']
        ."'></td><td><input name = foodpictypeurl[$foodtypeid] id = foodpictypeurl[$foodtypeid] value ='".$resfoodtypevalue['va_food_type_pic_url']."'></td>";

        echo "</td><td><input name = foodtypeorder[$foodtypeid] id = foodtypeorder[$foodtypeid] value ='".$resfoodtypevalue['i_food_type_order']."'></td>";

        echo "<td>"."<button onclick='setformupdatefood(".$resfoodtypevalue['i_food_type_id'].");'>Update Food Type</button>"."</td></tr>";    
    }   
    echo "<input type=hidden id='foodtype_update' name='foodtype_update'>";
    echo "<input type=hidden id='func' name='func' value='updatefoodtype_dev'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo '</table></form>';    
 

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>FOOD TYPE</td></tr>"; 

    echo "<tr><td width=10%>Food Type Name</td><td width=10%>Food Pic Url</td>";

    echo "<tr><td><input id=foodtypenew name=foodtypenew></td>";
    echo "<td><input id=foodtypepicurlnew name=foodtypepicurlnew></td></tr>";

    echo "<tr><TD colspan = 3 align=center><button onclick='setforminsertfood(".$resid.");'>Insert New Food Type</button></td></tr>";   
    echo "<input type=hidden id='func' name='func' value='insertnewfoodtype_dev'>";
    echo "<input type=hidden id='resid_insertfood' name='resid_insertfood'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo '</table></form>';  
    } 

function getbevtype($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;
    
    $sqlbevtype = "SELECT DISTINCT a.*
    FROM bev_type a 
    LEFT JOIN restaurant b on b.i_hq_id = a.i_res_id
    WHERE b.i_res_id = $resid ORDER BY i_bev_type_order ASC";

    $resbevtype = $dbhandler0->query($sqlbevtype);
    


    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>BEV TYPE</td></tr>";    
    echo "<tr><td width=10%>Bev Type ID</td><td width=10%>Bev Type Name</td><td width=10%>Bev Pic URL</td><td width=10%></td>";

    foreach($resbevtype as $resbevtypevalue) 
    {
        $bevtypeid = $resbevtypevalue['i_bev_type_id'];    
        echo "<tr><td>".$resbevtypevalue['i_bev_type_id'];
        echo "</td><td><input name = bevtypename[$bevtypeid] id = bevtypename[$bevtypeid] value ='".$resbevtypevalue['va_bev_type_name']
        ."'></td><td><input name = bevpictypeurl[$bevtypeid] id = bevpictypeurl[$bevtypeid] value ='".$resbevtypevalue['va_bev_type_pic_url']."'></td>";

        echo "</td><td><input name = bevtypeorder[$bevtypeid] id = bevtypeorder[$bevtypeid] value ='".$resbevtypevalue['i_bev_type_order']."'></td>";

        echo "<td>"."<button onclick='setformupdatebev(".$resbevtypevalue['i_bev_type_id'].");'>Update bev Type</button>"."</td></tr>";    
    }   
    echo "<input type=hidden id='bevtype_update' name='bevtype_update'>";
    echo "<input type=hidden id='func' name='func' value='updatebevtype_dev'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo '</table></form>';    
 

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Bev TYPE</td></tr>"; 

    echo "<tr><td width=10%>Bev Type Name</td><td width=10%>Bev Pic Url</td>";

    echo "<tr><td><input id=bevtypenew name=bevtypenew></td>";
    echo "<td><input id=bevtypepicurlnew name=bevtypepicurlnew></td></tr>";

    echo "<tr><TD colspan = 3 align=center><button onclick='setforminsertbev(".$resid.");'>Insert New Bev Type</button></td></tr>";   
    echo "<input type=hidden id='func' name='func' value='insertnewbevtype_dev'>";
    echo "<input type=hidden id='resid_insertbev' name='resid_insertbev'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo '</table></form>';   
    }     
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function setforminsertfood(resid)
{   
$("#resid_insertfood").val(resid);
}
function setformupdatefood(foodtypeid)
{   
$("#foodtype_update").val(foodtypeid);
}

function setforminsertbev(resid)
{   
$("#resid_insertbev").val(resid);
}
function setformupdatebev(bevtypeid)
{   
$("#bevtype_update").val(bevtypeid);
}

$(document).ready(function() 
{    
    $.getJSON('data/res.php',function(data)
    {
        var optiondata = "<?php echo $_SESSION['Options'] ?>" ;
        var combo = $("#Options");
        $.each(data.data,function(i,value)
        {
        if (value.i_res_id == value.i_hq_id)
        {
        var hq = '- HQ';   
        }    
        else
        {
        var hq = '';
        }    
        combo.append("<option value="+value.i_res_id+">" + value.va_res_name + hq + "</option>");
        });

        $("#SELECTOR").append(combo);
        if(optiondata!='')
        {
            $("#Options").val(optiondata);
        }    
    });
       $('#Options').change(function(){
             $("#getfoodtypeform").submit();
    })
});
</script>
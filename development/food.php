<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
echo'<FORM id=getfoodform action="development.php" method="post"><table>';
echo'<select name=Options id=Options><option></option></select>';
echo'</table><br><br></FORM>';
if (isset($_POST['Options']))
{
$_SESSION['Options']=$_POST['Options'];
}
if (isset($_SESSION['Options'])) {
    if ($_SESSION['Options'] != '')
    {
    getresmenufood($_SESSION['Options']);
    }
}
else
{
    $_SESSION['Options'] = '';
}

function getresmenufood($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;
    
    $sqlHQ = "SELECT i_hq_id from restaurant where i_res_stat = 1 AND i_res_id = '$resid' LIMIT 1";
    $resHQ = $dbhandler0->query($sqlHQ);
    $hqid = $resHQ[0]['i_hq_id'];
    $_SESSION['reshqid'] = $hqid;
    $sqlfood = "SELECT *,a.i_food_id AS foodid
    FROM food a LEFT JOIN menu b on a.i_menu_id = b.i_menu_id
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id and c.i_res_stat = 1
    LEFT JOIN food_price e on a.i_food_id = e.i_food_id
    LEFT JOIN food_type f on f.i_food_type_id = a.i_food_type_id
    WHERE c.i_res_id = $hqid
    ORDER BY f.i_food_type_order ASC,a.i_food_id ASC";
    $res = $dbhandler0->query($sqlfood);

    $sqlfoodlist = "SELECT *,a.i_food_id AS foodid
    FROM food a LEFT JOIN menu b on a.i_menu_id = b.i_menu_id
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id and c.i_res_stat = 1
    WHERE c.i_res_id = $hqid
    ORDER BY a.i_food_id ASC";
    $resfood = $dbhandler0->query($sqlfoodlist);


    $sqlcheck1 = "SELECT *
    FROM menu b
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id and c.i_res_stat = 1
    WHERE c.i_res_id = $hqid";
    $res1 = $dbhandler0->query($sqlcheck1);
   
    $sqlfoodtype = "SELECT * FROM food_type
    WHERE i_res_id = $hqid order by i_food_type_order ASC";
    $resfoodtype = $dbhandler0->query($sqlfoodtype);

echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
echo "<tr><td>Restaurant Name</td><td id=resname>".$res1[count($res1)-1]['va_res_name']."</td></tr>";
echo "<tr><td>Res Code</td><td>".$res1[count($res1)-1]['va_res_code']."</td></tr>";
echo "<tr><td>Menu Code</td><td id=menucode>".$res1[count($res1)-1]['va_menu_code']."</td></tr>";
echo "<tr><td>Food ID</td><td>Food Name</td><td>Food Desc</td><td>Food Type</td><td>Size</td><td>Price</td><td>Pic Url</td><td>Pic Display</td><td>Hide This Food</td><td>Hide This Price</td>";
echo "<td>Food Order</td><td>Food Price Order</td></tr>";

echo "<tr><TD colspan = 5 align=center>FOOD</td></tr>";
    foreach($res as $resvalue) {
        $food_id=$resvalue["foodid"];
        $food_price_id=$resvalue["i_price_id"];
        echo "<tr>";
        echo "<td ";
        if ($resvalue["i_food_price_status"] != 1)
        echo "style='background-color:#000000;color:white;'";
        if ($resvalue["i_food_status"] != 1)
        echo "style='background-color:#000000;color:white;'"; 
        echo " >".$resvalue["foodid"]."</td>";    
        $foodname=str_replace("'","&#39;", $resvalue["va_food_name"]);
        echo "<td><input name='food_name[$food_price_id]' size=50 value='".$foodname."'></td>";
        echo "<td><textarea name='food_desc[$food_price_id]' rows=5 cols=50>".$resvalue["va_food_desc"]."</textarea></td>";          

        echo "<td><select name='food_type[$food_price_id]'>";    
        foreach($resfoodtype as $resvaluefoodtype) {
            echo "<option value =".$resvaluefoodtype["i_food_type_id"];
            if ($resvalue["i_food_type_id"]==$resvaluefoodtype["i_food_type_id"]){echo " selected";}
            echo ">".$resvaluefoodtype["va_food_type_name"]."</option>";  
        }
        echo "</select></td>"; 

        echo "<td><input name='food_size[$food_price_id]' value='".$resvalue["va_food_size"]."'></td>";    
        echo "<td><input name='food_price[$food_price_id]' value='".$resvalue["d_food_price"]."'></td>";
        echo "<td><input name='food_pic_url[$food_price_id]' value='".$resvalue["va_food_pic_url"]."'></td>";
        echo "<td><img src='".$_SESSION["file"].$res1[count($res1)-1]['va_res_code']."/".$resvalue["va_food_pic_url"]."' height='150' width='180'></td>";
        echo "<td><input type='checkbox' name='food_status[$food_price_id]' id=food_status[$food_price_id]";
        if ($resvalue["i_food_status"] == 1){echo " checked";}
        echo "></td>";
        echo "<td><input type='checkbox' name='food_price_status[$food_price_id]' id=food_price_status[$food_price_id]";
        if ($resvalue["i_food_price_status"] == 1){echo " checked";}
        echo "></td>";  
        echo "<td><input name='food_order[$food_price_id]' value='".$resvalue["i_food_order"]."'></td>";       
        echo "<td><input name='food_price_order[$food_price_id]' value='".$resvalue["i_food_price_order"]."'></td>";     
        echo "<td width=20%><button onclick='setformupdate($food_id,$food_price_id);'>Update Current Row</button></td>";  
        echo "<td width=20%><button onclick='setformdelete($food_id);'>Delete This Food</button></td>";  
        echo "<td width=30%><button onclick='setformdeleteprice($food_price_id);'>Delete This Price Only</button></td>";  

        echo "<input type=hidden name='foodidloop[$food_price_id]' id='foodidloop[$food_price_id]' value=".$food_id.">";  
        echo "<input type=hidden name='foodpriceidloop[$food_price_id]' id='foodpriceidloop[$food_price_id]' value=".$food_price_id.">";  
        echo "</tr>";
    }
        echo "<tr><td colspan = 5>&nbsp;</td></tr>";
        echo '</table>';
        echo "<input type=hidden name='func' id='func' value=''>";
        echo "<input type=hidden name='food_id' id='food_id'>";  
        echo "<input type=hidden name='food_price_id' id='food_price_id'>";     
        echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
        if (!empty($_POST["page"])){
        echo "<input type=hidden name='page' id='page' value=".$_POST["page"].">";
        echo "<input type=hidden name='Options' id='Options' value=".$_SESSION["Options"].">";
    }
        echo '</form>';

        echo '<br><br>';
        echo'<form action="index.php" method="post"><table id="addfood" border=1 style="font-size:100%;">';
        echo "<tr><TD colspan =2 align=center>FOOD</td></tr>";
        echo "<tr><td><select name=inserttypefood id=inserttypefood><option value=1>Insert New Food</option><option value=2>Insert New Variant</option></select></td><td><button onclick='setforminsert();'>GO</button></td></tr>";
        echo "<tr><td>Food Name</td><td>Food Type</td></tr>";
        echo "<tr>";

        echo "<td id = updatefood1><input name='food_name_new' size=50 value='"."'></td>";
        echo "<td id = updatefood2 style='display:none;'><select name = food_name_update>";
        foreach($resfood as $res3value) {
        echo "<option value=".$res3value["foodid"].">";    
        echo $res3value["va_food_name"];  
        echo "</option>";  
        }
        echo "</select></td>";

        echo "<td><select name='food_type_new' id='food_type_new' required>";
        foreach($resfoodtype as $resvaluefoodtype) {
            echo "<option value =".$resvaluefoodtype["i_food_type_id"];
            echo ">".$resvaluefoodtype["va_food_type_name"]."</option>";  
        }
        echo "</select></td>";   

        echo "</tr>"; 
        echo "<tr><td>VARIANT</td></tr>";          
        echo "<tr><td>Size</td><td>Price</td></tr>";
        echo "<tr><td><input name='food_size_new[1]' id='food_size_new[]' size=10 value='"."'></td>";
        echo "<td><input name='food_price_new[1]' id='food_price_new[]' size=10 value='"."'></td></tr>";
        echo "<input type=hidden name='func' value='insertnewfood_dev'>";    
        echo "<input type=hidden id='resid_insert' name='resid_insert'>";
        echo "<input type=hidden id='resname_insert' name='resname_insert'>";
        echo "<input type=hidden id='menucode_insert' name='menucode_insert'>"; 
        echo '</table>';    
        echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
        echo '</form>';
        echo '<button onclick=addnewvariantfood();>Add New Variant</button>';
        echo '<br><br>';    
    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function addnewvariantfood()
{
$('#addfood tr:last').after('<tr><td><input name=food_size_new[] id=food_size_new[] size=10 value=></td><td><input name=food_price_new[] id=food_price_new[] size=10></td></tr>');
}

function setformupdate(id,price_id)
{  

    $("#food_id").val(id);
    $("#food_price_id").val(price_id);    
    $("#func").val('updatefood_dev');


}
function setformdelete(id)
{
    $("#food_id").val(id);
    $("#func").val('deletefood_dev');

}
function setformdeleteprice(price_id)
{       
    $("#food_price_id").val(price_id);
    $("#func").val('deletefoodprice_dev');
  
}
function setforminsert()
{  
var resid = "<?php echo $_SESSION['Options'] ?>" ;    
var menucode = $("#menucode").html();
var resname= $("#resname").html(); 
$("#resid_insert").val(resid);   
$("#resname_insert").val(resname);
$("#menucode_insert").val(menucode);
}
function setforminsert1()
{  
var resid = "<?php echo $_SESSION['Options'] ?>" ;    
var menucode = $("#menucode").html();
var resname= $("#resname").html(); 
}
$(document).ready(function() 
{
    $('#inserttypefood').change(function(){
        if (this.value == 1)
        {
        $("#updatefood1").show();
        $("#updatefood2").hide();
        $('#food_type_new').show();
        }
        else if (this.value == 2)
        {
        $("#updatefood1").hide();     
        $("#updatefood2").show();
        $('#food_type_new').hide();
        }
    })         
    $.getJSON('data/res.php',function(data)
    {
        var optiondata = "<?php echo $_SESSION['Options'] ?>" ;
        var combo = $("#Options");
        $.each(data.data,function(i,value)
        {
        if (value.i_res_id == value.i_hq_id)
        {
        var hq = ' (HQ)';    
        }    
        else
        {
        var hq = '';
        }    
        combo.append("<option value="+value.i_res_id+">" + value.va_res_name + ' - ' + value.va_area_name + hq + "</option>");
        });

        $("#SELECTOR").append(combo);
        if(optiondata!='')
        {
            $("#Options").val(optiondata);
        }    
    });

       $('#Options').change(function(){
             $("#getfoodform").submit();
    }) 
    $("#food_price_new").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        if (e.which != 46)
        { 
               return false;
        }
    }
   });  
});   
</script>
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
    
    $sqlHQ = "SELECT i_hq_id from restaurant where i_res_id = '$resid' LIMIT 1";
    $resHQ = $dbhandler0->query($sqlHQ);
    $hqid = $resHQ[0]['i_hq_id'];

    $sqlfood = "SELECT *,a.i_food_id AS foodid
    FROM food a LEFT JOIN menu b on a.i_menu_id = b.i_menu_id
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id
    LEFT JOIN food_price e on a.i_food_id = e.i_food_id
    LEFT JOIN food_type f on f.i_food_type_id = a.i_food_type_id
    WHERE c.i_res_id = $hqid
    ORDER BY a.i_food_id ASC";
    $res = $dbhandler0->query($sqlfood);

    $sqlfoodlist = "SELECT *,a.i_food_id AS foodid
    FROM food a LEFT JOIN menu b on a.i_menu_id = b.i_menu_id
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id
    WHERE c.i_res_id = $hqid
    ORDER BY a.i_food_id ASC";
    $resfood = $dbhandler0->query($sqlfoodlist);


    $sqlcheck1 = "SELECT *
    FROM menu b
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id
    WHERE c.i_res_id = $hqid";
    $res1 = $dbhandler0->query($sqlcheck1);

    $sqlbev = "SELECT *,a.i_bev_id AS bevid
    FROM bev a LEFT JOIN menu b on a.i_menu_id = b.i_menu_id
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id
    LEFT JOIN bev_price e on a.i_bev_id = e.i_bev_id
    LEFT JOIN bev_type f on f.i_bev_type_id = a.i_bev_type_id
    WHERE c.i_res_id = $hqid
    ORDER BY a.i_bev_id ASC";
    $res2 = $dbhandler0->query($sqlbev);    

    $sqlbevlist = "SELECT *,a.i_bev_id AS bevid
    FROM bev a LEFT JOIN menu b on a.i_menu_id = b.i_menu_id
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id
    WHERE c.i_res_id = $resid
    ORDER BY a.i_bev_id ASC";
    $resbev = $dbhandler0->query($sqlbevlist);

echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
echo "<tr><td>Restaurant Name</td><td id=resname>".$res1[count($res1)-1]['va_res_name']."</td></tr>";
echo "<tr><td>Res Code</td><td>".$res1[count($res1)-1]['va_res_code']."</td></tr>";
echo "<tr><td>Menu Code</td><td id=menucode>".$res1[count($res1)-1]['va_menu_code']."</td></tr>";
echo "<tr><td>Food ID</td><td>Food Name</td><td>Food Desc</td><td>Food Type</td><td>Size</td><td>Price</td><td>Pic Url</td></tr>";
echo "<tr><TD colspan = 5 align=center>FOOD</td></tr>";
    foreach($res as $resvalue) {
        $food_id=$resvalue["foodid"];
        $food_price_id=$resvalue["i_price_id"];
        echo "<tr>";
        echo "<td>".$resvalue["foodid"]."</td>";    
        echo "<td><input name='food_name[$food_id][$food_price_id]' size=50 value='".$resvalue["va_food_name"]."'></td>";
        echo "<td><textarea name='food_desc[$food_id][$food_price_id]' rows=5 cols=50>".$resvalue["va_food_desc"]."</textarea></td>";        
        echo "<td><select name='food_type[$food_price_id]'>";
        echo "<option value=1 ";
        if ($resvalue["i_food_type_id"]==1){echo "selected";}
        echo ">Main</option>";
        echo "<option value=2 ";
        if ($resvalue["i_food_type_id"]==2){echo "selected";}
        echo ">Side Dish</option>";        
        echo "</select></td>";         
        echo "<td><input name='food_size[$food_price_id]' value='".$resvalue["va_food_size"]."'></td>";    
        echo "<td><input name='food_price[$food_price_id]' value='".$resvalue["d_food_price"]."'></td>";
        echo "<td><input name='food_pic_url[$food_price_id]' value='".$resvalue["va_food_pic_url"]."'></td>";
        echo "<td><img src='".$_SESSION["file"].$res1[count($res1)-1]['va_res_code']."/".$resvalue["va_food_pic_url"]."' height='150' width='180'></td>";
        echo "<td width=20%><button onclick='setformupdate($food_id,$food_price_id,1);'>Update Current Row</button></td>";  
        echo "<td width=20%><button onclick='setformdelete($food_id,1);'>Delete This Food</button></td>";  
        echo "<td width=30%><button onclick='setformdeleteprice($food_price_id,1);'>Delete This Price Only</button></td>";  
        echo "</tr>";
    }

echo "<tr><TD colspan = 5 align=center>BEVERAGE</td></tr>";
    foreach($res2 as $res2value) {
        $bev_id=$res2value["bevid"];
        $bev_price_id=$res2value["i_price_id"];
        echo "<tr>";
        echo "<td>".$res2value["bevid"]."</td>";    
        echo "<td><input name='bev_name[$bev_id][$bev_price_id]' size=50 value='".$res2value["va_bev_name"]."'></td>";
        echo "<td><textarea name='bev_desc[$bev_id][$bev_price_id]' rows=5 cols=50>".$res2value["va_bev_desc"]."</textarea></td>"; 
        echo "<td><select name='bev_type[$bev_price_id]'>";
        echo "<option value=1 ";
        if ($res2value["i_bev_type_id"]==1){echo "selected";}
        echo ">Drink</option>";
        echo "<option value=2 ";
        if ($res2value["i_bev_type_id"]==2){echo "selected";}
        echo ">Others</option>";        
        echo "</select></td>";         
        echo "<td><input name='bev_size[$bev_price_id]' value='".$res2value["va_bev_size"]."'></td>";    
        echo "<td><input name='bev_price[$bev_price_id]' value='".$res2value["d_bev_price"]."'></td>";

        echo "<td><input name='bev_pic_url[$bev_price_id]' value='".$res2value["va_bev_pic_url"]."'></td>";
        echo "<td><img src='".$_SESSION["file"].$res1[count($res1)-1]['va_res_code']."/".$res2value["va_bev_pic_url"]."' height='150' width='180'></td>";
        echo "<td width=20%><button onclick='setformupdate($bev_id,$bev_price_id,2);'>Update Current Row</button></td>";  
        echo "<td width=20%><button onclick='setformdelete($bev_id,2);'>Delete This Beverage</button></td>";
        echo "<td width=30%><button onclick='setformdeleteprice($bev_price_id,2);'>Delete This Price Only</button></td>";    
        echo "</tr>";
    }

        echo '</table>';
        echo "<input type=hidden name='func' id='func' value=''>";
        echo "<input type=hidden name='food_id' id='food_id'>";  
        echo "<input type=hidden name='bev_id' id='bev_id'>";
        echo "<input type=hidden name='food_price_id' id='food_price_id'>";     
        echo "<input type=hidden name='bev_price_id' id='bev_price_id'>";  
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
        echo "<td><select name='food_type_new' id='food_type_new' required></select></td>";     
        echo "</tr>"; 
        echo "<tr><td>VARIANT</td></tr>";          
        echo "<tr><td>Size</td><td>Price</td></tr>";
        echo "<tr><td><input name='food_size_new[1]' id='food_size_new[]' size=10 value='"."'></td>";
        echo "<td><input name='food_price_new[1]' id='food_price_new[]' size=10 value='"."'></td></tr>";
        echo "<input type=hidden name='func' value='insertnewfood'>";    
        echo "<input type=hidden id='resid_insert' name='resid_insert'>";
        echo "<input type=hidden id='resname_insert' name='resname_insert'>";
        echo "<input type=hidden id='menucode_insert' name='menucode_insert'>"; 
        echo '</table>';    
        echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
        echo '</form>';
        echo '<button onclick=addnewvariantfood();>Add New Variant</button>';

        echo '<br><br>';
        echo'<form action="index.php" method="post"><table id="addbev" border=1 style="font-size:100%;">';
        echo "<tr><TD colspan =2 align=center>BEVERAGE</td></tr>";
        echo "<tr><td><select name=inserttypebev id=inserttypebev><option value=1>Insert New Bev</option><option value=2>Insert New Variant</option></select></td><td><button onclick='setforminsert1();'>GO</button></td></tr>";
        echo "<tr><td>Bev Name</td><td>Bev Type</td></tr>";
        echo "<tr>";

        echo "<td id = updatebev1><input name='bev_name_new' size=50 value='"."'></td>";
        echo "<td id = updatebev2 style='display:none;'><select name = bev_name_update>";
        foreach($resbev as $res4value) {
        echo "<option value=".$res4value["bevid"].">";    
        echo $res4value["va_bev_name"];  
        echo "</option>";  
        }
        echo "</select></td>";
        echo "<td><select name='bev_type_new' id='bev_type_new' required></select></td>";     
        echo "</tr>"; 
        echo "<tr><td>VARIANT</td></tr>";          
        echo "<tr><td>Size</td><td>Price</td></tr>";
        echo "<tr><td><input name='bev_size_new[1]' id='bev_size_new[]' size=10 value='"."'></td>";
        echo "<td><input name='bev_price_new[1]' id='bev_price_new[]' size=10 value='"."'></td></tr>";
        echo "<input type=hidden name='func' value='insertnewbev'>";    
        echo "<input type=hidden id='resid_insertbev' name='resid_insertbev'>";
        echo "<input type=hidden id='resname_insertbev' name='resname_insertbev'>";
        echo "<input type=hidden id='menucode_insertbev' name='menucode_insertbev'>"; 
        echo '</table>';    
        echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
        echo '</form>';
        echo '<button onclick=addnewvariantbev();>Add New Variant</button>';        
    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function addnewvariantfood()
{
$('#addfood tr:last').after('<tr><td><input name=food_size_new[] id=food_size_new[] size=10 value=></td><td><input name=food_price_new[] id=food_price_new[] size=10></td></tr>');
}
function addnewvariantbev()
{
$('#addbev tr:last').after('<tr><td><input name=bev_size_new[] id=bev_size_new[] size=10 value=></td><td><input name=bev_price_new[] id=bev_price_new[] size=10></td></tr>');
}
function setformupdate(id,price_id,type)
{  
if (type == 1)
{
    $("#food_id").val(id);
    $("#food_price_id").val(price_id);    
    $("#func").val('updatefood');
}
else if (type == 2)
{
    $("#bev_id").val(id); 
    $("#bev_price_id").val(price_id);   
    $("#func").val('updatebev');
}
}
function setformdelete(id,type)
{
if (type == 1)
{
    $("#food_id").val(id);
    $("#func").val('deletefood');
}
else if (type == 2)
{
    $("#bev_id").val(id);
    $("#func").val('deletebev');
}
}
function setformdeleteprice(price_id,type)
{   
if (type == 1)
{    
    $("#food_price_id").val(price_id);
    $("#func").val('deletefoodprice');
}
else if (type == 2)
{
    $("#bev_price_id").val(price_id);
    $("#func").val('deletebevprice');
}    
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
$("#resid_insertbev").val(resid);   
$("#resname_insertbev").val(resname);
$("#menucode_insertbev").val(menucode); 
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
    $('#inserttypebev').change(function(){
        if (this.value == 1)
        {
        $("#updatebev1").show();
        $("#updatebev2").hide();
        $('#bev_type_new').show();
        }
        else if (this.value == 2)
        {
        $("#updatebev1").hide();     
        $("#updatebev2").show();
        $('#bev_type_new').hide();
        }
    })        
    $.getJSON('data/res.php',function(data)
    {
        var optiondata = "<?php echo $_SESSION['Options'] ?>" ;
        var combo = $("#Options");
        $.each(data.data,function(i,value)
        {
        combo.append("<option value="+value.i_res_id+">" + value.va_res_name + "</option>");
        });

        $("#SELECTOR").append(combo);
        if(optiondata!='')
        {
            $("#Options").val(optiondata);
        }    
    }); 

    $.getJSON('data/foodtype.php',function(data)
    {
        var combo = $("#food_type_new");
        $.each(data.data,function(i,value)
        {
        combo.append("<option value="+value.i_food_type_id+">" + value.va_food_type_name + "</option>");
        });  
    });
    $.getJSON('data/bevtype.php',function(data)
    {
        var combo = $("#bev_type_new");
        $.each(data.data,function(i,value)
        {
        combo.append("<option value="+value.i_bev_type_id+">" + value.va_bev_type_name + "</option>");
        });  
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
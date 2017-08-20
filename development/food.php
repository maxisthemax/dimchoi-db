<br><br>
<?php
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
function getresmenufood($resid)
{
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
global $dbhandler0;
    
    $sqlcheck = "SELECT *,a.i_food_id AS foodid
    FROM food a LEFT JOIN menu b on a.i_menu_id = b.i_menu_id
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id
    LEFT JOIN food_price e on a.i_food_id = e.i_food_id
    LEFT JOIN food_type f on f.i_food_type_id = a.i_food_type_id
    WHERE c.i_res_id = $resid
    ORDER BY a.i_food_id ASC";
    $res = $dbhandler0->query($sqlcheck);

    $sqlcheck1 = "SELECT *
    FROM menu b
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id
    WHERE c.i_res_id = $resid";
    $res1 = $dbhandler0->query($sqlcheck1);
echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
echo "<tr><td>Restaurant Name</td><td id=resname>".$res1[count($res1)-1]['va_res_name']."</td></tr>";
echo "<tr><td>Res Code</td><td>".$res1[count($res1)-1]['va_res_code']."</td></tr>";
echo "<tr><td>Menu Code</td><td id=menucode>".$res1[count($res1)-1]['va_menu_code']."</td></tr>";
echo "<tr><td>Food ID</td><td>Food Name</td><td>Food Type</td><td>Size</td><td>Price</td></tr>";
if ($res != ''){
    foreach($res as $res) {
        $food_id=$res["foodid"];
        $price_id=$res["i_price_id"];
        echo "<tr>";
        echo "<td>".$res["foodid"]."</td>";    
        echo "<td><input name='food_name[$food_id][$price_id]' size=50 value='".$res["va_food_name"]."'></td>";
        echo "<td><select name='food_type[$price_id]'>";
        echo "<option value=1 ";
        if ($res["i_food_type_id"]==1){echo "selected";}
        echo ">Main</option>";
        echo "<option value=2 ";
        if ($res["i_food_type_id"]==2){echo "selected";}
        echo ">Side Dish</option>";        
        echo "</select></td>";         
        echo "<td><input name='food_size[$price_id]' value='".$res["va_food_size"]."'></td>";    
        echo "<td><input name='food_price[$price_id]' value='".$res["d_food_price"]."'></td>";
        echo "<td width=20%><button onclick='setformupdate($food_id,$price_id);'>Update Current Row</button></td>";  
        echo "<td width=20%><button onclick='setformdelete($food_id);'>Delete Current Row</button></td>";  
        echo "</tr>";
    }
    echo '</table>';
        echo "<input type=hidden name='func' id='func' value=''>";
        echo "<input type=hidden name='food_id' id='food_id'>";  
        echo "<input type=hidden name='price_id' id='price_id'>";      
        echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
        if (!empty($_POST["page"])){
        echo "<input type=hidden name='page' id='page' value=".$_POST["page"].">";
        echo "<input type=hidden name='Options' id='Options' value=".$_SESSION["Options"].">";
    }
        echo '</form>';
    }
        echo '<br><br>';
        echo'<form action="index.php" method="post"><table id="addfood" border=1 style="font-size:100%;">';
        echo "<button onclick='setforminsert();''>Insert New Row</button>";  
        echo "<tr><td>Food Name</td><td>Food Type</td></tr>";
        echo "<tr>";
        echo "<td><input name='food_name_new' size=50 value='"."' required></td>";
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
        echo '<button onclick=addnewvariant();>Add New Variant</button>';
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function addnewvariant()
{
$('#addfood tr:last').after('<tr><td><input name=food_size_new[] id=food_size_new[] size=10 value=></td><td><input name=food_price_new[] id=food_price_new[] size=10></td></tr>');
}
function setformupdate(food_id,price_id)
{   
$("#food_id").val(food_id);
$("#price_id").val(price_id);
$("#func").val('updatefood');
}
function setformdelete(food_id)
{   
$("#food_id").val(food_id);
$("#func").val('deletefood');
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
$(document).ready(function() 
{
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
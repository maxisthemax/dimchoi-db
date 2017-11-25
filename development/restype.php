<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
echo'<FORM id=getrestypeform action="development.php" method="post"><table>';
echo'<select name=Options id=Options><option></option></select>';
echo'</table><br><br></FORM>';
if (isset($_POST['Options']))
{
$_SESSION['Options']=$_POST['Options'];
}
if (isset($_SESSION['Options'])) {
    if ($_SESSION['Options'] != '')
    {
    getrestype($_SESSION['Options']);
    }
}
else
{
    $_SESSION['Options'] = '';
}

function getrestype($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;



    $sqlrestype = "SELECT *,(CASE WHEN a.i_res_type_bit&(SELECT i_res_type_bit FROM restaurant b WHERE b.i_res_id = $resid)>0 THEN 1 ELSE 0 END) AS CHECKED FROM res_type a";
    $restype = $dbhandler0->query($sqlrestype);

    

 echo '<br><br>';

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Res Type</td></tr>";    
    echo "<tr><td width=10%>Res Type Id</td><td width=10%>Res Type Bit</td><td width=10%>Res Type Name</td></tr>";

    foreach($restype as $resvalue) 
    {        
        if ($resvalue['CHECKED'] == 1)
        {
            $check = 'CHECKED';
        }
        else
        {
            $check = '';
        }
        $restypeid = $resvalue['i_res_type_id'];
        echo "<tr><td>"
        .$resvalue['i_res_type_id']."</td><td>"."<input name = res_type_bit[$restypeid] value="
        .$resvalue['i_res_type_bit']."></td><td>"."<input name = res_type_name[$restypeid] value='"
        .$resvalue['va_res_type_name']."'></td><td>"
        ."<td><input type=checkbox name = checked[$restypeid] value=".$resvalue['i_res_type_bit'].' '.$check."></td>"
        ."<td><button name = res_type_submit value=$restypeid".">Update Current This Type</button></td>"
        ."<td><button onclick='deletecurrentrestype(".$resid.");' name = res_type_submit value=$restypeid".">Delete Current This Type</button></td></tr>";
    }   
    echo "<input type=hidden id='func' name='func' value='updaterestypetable_dev'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo "<input type=hidden name='resid' id='resid' value=".$resid.">"; 
    echo "<tr><TD colspan = 3 align=center><button onclick='updatecurrentrestype(".$resid.");'>Update Current Res Type</button></td></tr>";    
    echo '</table>';
    echo '</form>';    
 

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Res Type</td></tr>";    
    echo "<tr><td width=10%>Res Type Bit</td><td width=10%>Res Type Name</td></tr>";
    echo "<tr><td><input id=res_type_bit name=res_type_bit></td><td><input id=res_type_name name=res_type_name></td></tr>";
    echo "<tr><TD colspan = 3 align=center><button onclick='setforminsert(".$resid.");'>Insert New Res Type</button></td></tr>";   
    echo "<input type=hidden id='func' name='func' value='insertnewrestype_dev'>";
    echo "<input type=hidden id='resid_insert' name='resid_insert'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo "</form>";   
    } 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function updatecurrentrestype(resid)
{   
$("#func").val('updaterestype_dev');
}
function deletecurrentrestype(resid)
{   
$("#func").val('deletecurrentrestype_dev');
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
        var hq = ' (HQ)';   
        }    
        else
        {
        var hq = '';
        }
        combo.append("<option value="+value.i_res_id+">" + value.va_res_name + " - " +value.va_area_name + hq +  "</option>");
        });

        $("#SELECTOR").append(combo);
        if(optiondata!='')
        {
            $("#Options").val(optiondata);
        }    
    });
       $('#Options').change(function(){
             $("#getrestypeform").submit();
    })       
});   
</script>
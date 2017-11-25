<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
echo'<FORM id=getressettingform action="development.php" method="post"><table>';
echo'<select name=Options id=Options><option></option></select>';
echo'</table><br><br></FORM>';
if (isset($_POST['Options']))
{
$_SESSION['Options']=$_POST['Options'];
}
if (isset($_SESSION['Options'])) {
    if ($_SESSION['Options'] != '')
    {
    getressetting($_SESSION['Options']);
    }
}
else
{
    $_SESSION['Options'] = '';
}

function getressetting($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;



    $sqlressetting = "SELECT *,(CASE WHEN a.i_res_setting_bit&(SELECT i_res_setting_bit FROM restaurant b WHERE b.i_res_id = $resid)>0 THEN 1 ELSE 0 END) AS CHECKED FROM res_setting a";
    $ressetting = $dbhandler0->query($sqlressetting);

    

 echo '<br><br>';

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Res Setting</td></tr>";    
    echo "<tr><td width=10%>Res Setting Id</td><td width=10%>Res Setting Bit</td><td width=10%>Res Setting Name</td></tr>";

    foreach($ressetting as $resvalue) 
    {        
        if ($resvalue['CHECKED'] == 1)
        {
            $check = 'CHECKED';
        }
        else
        {
            $check = '';
        }
        $ressettingid = $resvalue['i_res_setting_id'];
        echo "<tr><td>"
        .$resvalue['i_res_setting_id']."</td><td>"."<input name = res_setting_bit[$ressettingid] value="
        .$resvalue['i_res_setting_bit']."></td><td>"."<input name = res_setting_name[$ressettingid] value='"
        .$resvalue['va_res_setting_name']."'></td><td>"
        ."<td><input type=checkbox name = checked[$ressettingid] value=".$resvalue['i_res_setting_bit'].' '.$check."></td>"
        ."<td><button name = res_setting_submit value=$ressettingid".">Update Current This Setting</button></td>"
        ."<td><button onclick='deletecurrentressetting(".$resid.");' name = res_setting_submit value=$ressettingid".">Delete Current This Setting</button></td></tr>";
    }   
    echo "<input type=hidden id='func' name='func' value='updateressettingtable_dev'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo "<input type=hidden name='resid' id='resid' value=".$resid.">"; 
    echo "<tr><TD colspan = 3 align=center><button onclick='updatecurrentressetting(".$resid.");'>Update Current Res Setting</button></td></tr>";    
    echo '</table>';
    echo '</form>';    
 

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Res Setting</td></tr>";    
    echo "<tr><td width=10%>Res Setting Bit</td><td width=10%>Res Setting Name</td></tr>";
    echo "<tr><td><input id=res_setting_bit name=res_setting_bit></td><td><input id=res_setting_name name=res_setting_name></td></tr>";
    echo "<tr><TD colspan = 3 align=center><button onclick='setforminsert(".$resid.");'>Insert New Res Setting</button></td></tr>";   
    echo "<input type=hidden id='func' name='func' value='insertnewressetting_dev'>";
    echo "<input type=hidden id='resid_insert' name='resid_insert'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo "</form>";   
    } 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function updatecurrentressetting(resid)
{   
$("#func").val('updateressetting_dev');
}
function deletecurrentressetting(resid)
{   
$("#func").val('deletecurrentressetting_dev');
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
             $("#getressettingform").submit();
    })       
});   
</script>
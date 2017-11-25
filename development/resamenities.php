<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
echo'<FORM id=getresamenitiesform action="development.php" method="post"><table>';
echo'<select name=Options id=Options><option></option></select>';
echo'</table><br><br></FORM>';
if (isset($_POST['Options']))
{
$_SESSION['Options']=$_POST['Options'];
}
if (isset($_SESSION['Options'])) {
    if ($_SESSION['Options'] != '')
    {
    getresamenities($_SESSION['Options']);
    }
}
else
{
    $_SESSION['Options'] = '';
}

function getresamenities($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;



    $sqlresamenities = "SELECT *,(CASE WHEN a.i_res_amenities_bit&(SELECT i_res_amenities_bit FROM restaurant b WHERE b.i_res_id = $resid)>0 THEN 1 ELSE 0 END) AS CHECKED FROM res_amenities a";
    $resamenities = $dbhandler0->query($sqlresamenities);

    

 echo '<br><br>';

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Res Amenities</td></tr>";    
    echo "<tr><td width=10%>Res Amenities Id</td><td width=10%>Res Amenities Bit</td><td width=10%>Res Amenities Name</td></tr>";

    foreach($resamenities as $resvalue) 
    {        
        if ($resvalue['CHECKED'] == 1)
        {
            $check = 'CHECKED';
        }
        else
        {
            $check = '';
        }
        $resamenitiesid = $resvalue['i_res_amenities_id'];
        echo "<tr><td>"
        .$resvalue['i_res_amenities_id']."</td><td>"."<input name = res_amenities_bit[$resamenitiesid] value="
        .$resvalue['i_res_amenities_bit']."></td><td>"."<input name = res_amenities_name[$resamenitiesid] value='"
        .$resvalue['va_res_amenities_name']."'></td><td>"
        ."<td><input type=checkbox name = checked[$resamenitiesid] value=".$resvalue['i_res_amenities_bit'].' '.$check."></td>"
        ."<td><button name = res_amenities_submit value=$resamenitiesid".">Update Current This Amenities</button></td>"
        ."<td><button onclick='deletecurrentresamenities(".$resid.");' name = res_amenities_submit value=$resamenitiesid".">Delete Current This Amenities</button></td></tr>";
    }   
    echo "<input type=hidden id='func' name='func' value='updateresamenitiestable_dev'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo "<input type=hidden name='resid' id='resid' value=".$resid.">"; 
    echo "<tr><TD colspan = 3 align=center><button onclick='updatecurrentresamenities(".$resid.");'>Update Current Res Amenities</button></td></tr>";    
    echo '</table>';
    echo '</form>';    
 

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Res Amenities</td></tr>";    
    echo "<tr><td width=10%>Res Amenities Bit</td><td width=10%>Res Amenities Name</td></tr>";
    echo "<tr><td><input id=res_amenities_bit name=res_amenities_bit></td><td><input id=res_amenities_name name=res_amenities_name></td></tr>";
    echo "<tr><TD colspan = 3 align=center><button onclick='setforminsert(".$resid.");'>Insert New Res Amenities</button></td></tr>";   
    echo "<input type=hidden id='func' name='func' value='insertnewresamenities_dev'>";
    echo "<input type=hidden id='resid_insert' name='resid_insert'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo "</form>";   
    } 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function updatecurrentresamenities(resid)
{   
$("#func").val('updateresamenities_dev');
}
function deletecurrentresamenities(resid)
{   
$("#func").val('deletecurrentresamenities_dev');
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
             $("#getresamenitiesform").submit();
    })       
});   
</script>
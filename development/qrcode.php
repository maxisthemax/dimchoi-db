<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
echo'<FORM id=getqrcodeform action="development.php" method="post"><table>';
echo'<select name=Options id=Options><option></option></select>';
echo'</table><br><br></FORM>';
if (isset($_POST['Options']))
{
$_SESSION['Options']=$_POST['Options'];
}
if (isset($_SESSION['Options'])) {
    if ($_SESSION['Options'] != '')
    {
    getqrcode($_SESSION['Options']);
    }
}
else
{
    $_SESSION['Options'] = '';
}

function getqrcode($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;
    
    $sqlqr = "SELECT *
    FROM qrcode a LEFT JOIN qrcode_type b on a.i_qr_type_id = b.i_qr_type_id
    WHERE a.i_res_id = $resid";
    $resqr = $dbhandler0->query($sqlqr);

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>QR CODE</td></tr>";    
    echo "<tr><td width=10%>Qr ID</td><td width=10%>Qr Type</td><td width=10%>User ID</td><td>Qr Data 1</td><td>Qr Data 2</td></tr>";

    foreach($resqr as $resvalue) 
    {
        echo "<tr><td>".$resvalue['i_qr_id']."</td><td>".$resvalue['va_qr_type_name']."</td><td>".$resvalue['i_user_id']."</td><td>".$resvalue['va_qr_data_1']."</td><td>".$resvalue['va_qr_data_2']."</td></tr>";
    }   
    echo '</form>';    
 

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>QR CODE</td></tr>";    
    echo "<tr><td width=10%>Qr Type</td><td width=10%>User ID</td><td>Qr Data 1</td><td>Qr Data 2</td></tr>";
    echo "<tr><td width=10%><select name=qrtypenew id=qrtypenew><option value=1>food</option></select></td>
    <td><input id=userid_insert name=userid_insert></td>
    <td><textarea name=qrdatanew1 id=qrdatanew1 rows=8 cols=50></textarea></td><td><textarea name=qrdatanew2 id=qrdatanew2 rows=8 cols=50></textarea></td></tr>";
    echo "<tr><TD colspan = 3 align=center><button onclick='setforminsert(".$resid.");'>Insert New Qr Code</button></td></tr>";   
    echo "<input type=hidden id='func' name='func' value='insertnewqrcoderow'>";
    echo "<input type=hidden id='resid_insert' name='resid_insert'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo "</form>";   
    } 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function setforminsert(resid)
{   
$("#resid_insert").val(resid);
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
             $("#getqrcodeform").submit();
    })       
});   
</script>
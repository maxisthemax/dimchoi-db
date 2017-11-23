<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
echo'<FORM id=getuserorderform action="development.php" method="post"><table>';
echo'<select name=Options id=Options><option></option></select>';
echo'</table><br><br></FORM>';
if (isset($_POST['Options']))
{
$_SESSION['Options']=$_POST['Options'];
}
if (isset($_SESSION['Options'])) {
    if ($_SESSION['Options'] != '')
    {
    getuserorder($_SESSION['Options']);
    }
}
else
{
    $_SESSION['Options'] = '';
}

function getuserorder($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;
    
    $sqluserorder = "SELECT *
    FROM userorder a LEFT JOIN qrcode_type b on a.i_userorder_type_id = b.i_qr_type_id
    WHERE a.i_res_id = $resid";
    $resuserorder = $dbhandler0->query($sqluserorder);

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>USER ORDER CODE</td></tr>";    
    echo "<tr><td width=10%>USER ORDER ID</td><td width=10%>USER ORDER Type</td><td width=10%>USER ORDER ID</td><td>USER ORDER Data 1</td><td>USER ORDER Data 2</td><td>Order Create Date</td></tr>";

    foreach($resuserorder as $resvalue) 
    {
        echo "<tr><td>".$resvalue['i_userorder_id']."</td><td>".$resvalue['va_qr_type_name']."</td><td>".$resvalue['i_user_id']."</td><td>".$resvalue['va_userorder_data_1']."</td><td>".$resvalue['va_userorder_data_2']."</td><td>".$resvalue['dt_userordercreate']."</td></tr>";
    }   
    echo '</form>';       
    } 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
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
        combo.append("<option value="+value.i_res_id+">" + value.va_res_name + ' - ' + value.va_area_name + hq + "</option>");
        });

        $("#SELECTOR").append(combo);
        if(optiondata!='')
        {
            $("#Options").val(optiondata);
        }    
    });
       $('#Options').change(function(){
             $("#getuserorderform").submit();
    })       
});   
</script>
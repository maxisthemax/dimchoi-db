<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
echo'<FORM id=getresorderform action="development.php" method="post"><table>';
echo'<select name=Options id=Options><option></option></select>';
echo'</table><br><br></FORM>';
if (isset($_POST['Options']))
{
$_SESSION['Options']=$_POST['Options'];
}
if (isset($_SESSION['Options'])) {
    if ($_SESSION['Options'] != '')
    {
    getresorder($_SESSION['Options']);
    }
}
else
{
    $_SESSION['Options'] = '';
}

function getresorder($resid) {
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;
    
    $sqlresorder = "SELECT *
    FROM resorder a LEFT JOIN qrcode_type b on a.i_resorder_type_id = b.i_qr_type_id
    WHERE a.i_res_id = $resid";
    $resresorder = $dbhandler0->query($sqlresorder);

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Res Order CODE</td></tr>";    
    echo "<tr><td width=10%>Res Order ID</td><td width=10%>Res Order Type</td><td width=10%>Res Order ID</td><td>Res Order Data 1</td><td>Res Order Data 2</td></tr>";

    foreach($resresorder as $resvalue) 
    {
        echo "<tr><td>".$resvalue['i_resorder_id']."</td><td>".$resvalue['va_qr_type_name']."</td><td>".$resvalue['i_user_id']."</td><td>".$resvalue['va_resorder_data_1']."</td><td>".$resvalue['va_resorder_data_2']."</td></tr>";
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
        combo.append("<option value="+value.i_res_id+">" + value.va_res_name + "</option>");
        });

        $("#SELECTOR").append(combo);
        if(optiondata!='')
        {
            $("#Options").val(optiondata);
        }    
    });
       $('#Options').change(function(){
             $("#getresorderform").submit();
    })       
});   
</script>
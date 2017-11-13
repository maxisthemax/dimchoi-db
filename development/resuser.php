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
    
    $sqlresuser = "SELECT *
    FROM resuser a LEFT JOIN restaurant b on a.i_res_id = b.i_res_id
    WHERE a.i_res_id = $resid";
    $resresuser = $dbhandler0->query($sqlresuser);

    echo'<form action="index.php" method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>Restaurant User</td></tr>";    
    echo "<tr><td width=10%>Res User Name</td><td>Res Token</td></tr>";

    foreach($resresuser as $resvalue) 
    {
        echo "<tr><td>".$resvalue['va_username']."</td><td>".$resvalue['va_token']."</td>";
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
      var combo = $("#Options");
      $.each(data.data,function(i,value)
      {
        if (value.i_res_id == value.i_hq_id)
        {
            var ishq = ' (HQ)';
        }    
        else
        {
            var ishq = '';
        }    
        combo.append("<option value=" + value.va_res_code + ">" + value.va_res_name + ' - '+ value.va_area_name + ishq + "</option>");
      });

      $("#SELECTOR").append(combo);
    });
       $('#Options').change(function(){
             $("#getresorderform").submit();
    })       
});   
</script>
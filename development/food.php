<br><br>
<?php
global $dbhandler0;
    $sqlcheck = "SELECT *
    FROM food a LEFT JOIN menu b on a.i_menu_id = b.i_menu_id
    LEFT JOIN restaurant c on c.i_res_id = b.i_res_id
    LEFT JOIN food_price e on a.i_food_id = e.i_food_id";
    $res = $dbhandler0->query($sqlcheck);

echo'<form action="index.php" method="post" target="_blank"><table id="tab" border=1 style="font-size:100%;">';
echo "<tr><td>Restaurant Name</td><td><input value='".$res[count($res)-1]['va_res_name']."'></td></tr>";
echo "<tr><td>Menu Code/Res Code</td><td><input value='".$res[count($res)-1]['va_menu_code']."'></td></tr>";

echo "<tr><td>Food ID</td><td>Food Name</td><td>Size</td><td>Price</td></tr>";
foreach($res as $res) {
    $food_id=$res["i_food_id"];
    $price_id=$res["i_price_id"];
    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.
    echo "<tr>";
    echo "<td>".$res["i_food_id"]."</td>";    
    echo "<td><input name='food_name[$food_id][$price_id]' size=50 value='".$res["va_food_name"]."'></td>";
    echo "<td><input name='food_size[$price_id]' value='".$res["va_food_size"]."'></td>";    
    echo "<td><input name='food_price[$price_id]' value='".$res["d_food_price"]."'></td>";
    echo "<td><button onclick='setformvalue($food_id,$price_id);''>Update Current Row</button></td>";  
    echo "</tr>";
}
echo '</table>';
    echo "<input type=hidden name='func' value='updatefood'>";
    echo "<input type=hidden name='food_id' id='food_id'>";  
    echo "<input type=hidden name='price_id' id='price_id'>";      
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    if (!empty($_POST["page"])){
    echo "<input type=hidden name='page' id='page' value=".$_POST["page"].">";  
}
echo '</form>';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function setformvalue(food_id,price_id)
{
$("#food_id").val(food_id);
$("#price_id").val(price_id);
}

</script>
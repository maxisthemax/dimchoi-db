<div id="escDivTable" class="subText">RESTAURANT NAME</div>
<br><br>

<form action="index.php" method="post" target="_blank">

    <select id="func" name="func">
        <option></option>
        <option value=updateres>updateres</option>
        <option value=insertnewres>insertnewres</option>
    </select>
    <input type="submit" name="submitfunc">

    <br><br>

    <div id="updateres" class="toggleable" style="display:none;">
        <select id="Options">
            <option></option>
        </select>
        <table id="tab" style="font-size:150%;">
        </table>    
    </div>

    <div id="insertnewres" class="toggleable" style="display:none;">
       <table id="tabinsertnewres" style="font-size:150%;">
            <tr><td>Name :</td><td><input name = "resname_new" value=""></td></tr> 
            <tr><td>Res Code :</td><td><input name = "rescode_new" value=""></td></tr>
            <tr><td>Logo Url :</td><td><input name = "reslogo_new" value=""></td></tr>
            <tr><td>State :</td><td><input name = "state_new" value=""></td></tr>
            <tr><td>City :</td><td><input name = "city_new" value=""></td></tr>
        </table>
    </div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

var data = 
{
    "func": "getres"
};    

$.ajax(
{
    type: 'POST',
    url: 'index.php',
    datatype: "json",
    data: data
});

$(document).ready(function() 
{
    $.getJSON('result.php',function(data)
    {
      var combo = $("#Options");
      $.each(data.data,function(i,value)
      {
        combo.append("<option>" + value.va_res_name + "</option>");
      });

      $("#SELECTOR").append(combo);
    });  
   
    $("#func").on('change', function()
    {
        var inhalt = $('#func option:selected').val();
        if (inhalt=='updateres')
        {
            $('#updateres').show();
            $('#insertnewres').hide();
        }
        else if (inhalt=='insertnewres')
        {
            $('#insertnewres').show();
            $('#updateres').hide();

        }       
    });    

    $("#Options").change(function()
    {                
        var name = this.value;   
        $.getJSON('result.php',function(data)
        {
            var tb = $("#tab");
            tb.empty();
            $.each(data.data,function(i,value)
            {
                if (value.va_res_name==name)
                {
                tb.append("<tr><td>ID:</td><td>" + value.i_res_id + "</td></tr>");
                tb.append("<tr><td>Name:</td><td>"+"<input name = 'resname' value='"+value.va_res_name+"'>" + "</td></tr>");
                tb.append("<tr><td>Res Code:</td><td>"+"<input name = 'rescode' value='"+value.va_res_code+"'>" + "</td></tr>");   
                tb.append("<tr><td>Logo Url:</td><td>"+"<input name = 'reslogo' value='"+value.va_res_logo+"'>" + "</td></tr>");
                tb.append("<tr><td>Logo Url:</td><td>"+"<img src="+value.va_res_logo+" height='400'>" + "</td></tr>");
                tb.append("<input hidden name = 'resid' value='"+value.i_res_id+"'>");                                 
                }
            });
        });  

    });
});


</script>   
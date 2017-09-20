
<div id="escDivTable" class="subText">RESTAURANT NAME</div>
<br><br>

<form action="index.php" method="post">

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
            <tr><td>Menu Code :</td><td><input name = "menucode_new" value=""></td></tr>
            <tr><td>Logo Url :</td><td><input name = "reslogo_new" value=""></td></tr>
            <tr><td>City :</td><td><select id = "city_new" name = "city_new"></select></td></tr>
        </table>
    </div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function() 
{
    $.getJSON('data/res.php',function(data)
    {
      var combo = $("#Options");
      $.each(data.data,function(i,value)
      {
        combo.append("<option value=" + value.va_res_code + ">" + value.va_res_name + ' - '+ value.va_area + "</option>");
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
            var city_new = $('#city_new');
            city_new.empty();
            city_new.append("<option></option>");     
            var ii=0;
            $.getJSON('data/place.php',function(data)
            {   
                    $.each(data.data,function(i,data1)
                    {
                        $.each(data1.cities,function(j,city)
                        { 
                            city_new.append($("<option></option>")
                            .attr("value",city.city_name)
                            .text(city.city_name));   
                        });
                    });    
            });            
        }      
    });    

    $("#Options").change(function()
    {  
        var name = this.value;
        var tb = $('#tab');
        tb.empty();
        $.getJSON('data/res.php',function(data)
            {
            $.each(data.data, function(i, value)
                {
                    if (value.va_res_code == name)
                    {
                        tb.append("<tr><td>ID:</td><td>" + value.i_res_id + "</td></tr>");
                        tb.append("<tr><td>Name:</td><td>"+"<input name = 'resname' value='"+value.va_res_name+"'>" + "</td></tr>");
                        tb.append("<tr><td>Res Code:</td><td>"+"<input name = 'rescode' value='"+value.va_res_code+"'>" + "</td></tr>");
                        tb.append("<tr><td>Menu Code:</td><td>"+"<input name = 'menucode' value='"+value.va_menu_code+"'>" + "</td></tr>");
                        tb.append("<tr><td>Add 1:</td><td>"+"<input name = 'add1' value='"+value.va_res_add1+"'>" + "</td></tr>");
                        tb.append("<tr><td>Add 2:</td><td>"+"<input name = 'add2' value='"+value.va_res_add2+"'>" + "</td></tr>");
                        tb.append("<tr><td>Area</td><td>"+"<input name = 'area' value='"+value.va_area+"'>" + "</td></tr>");

                        tb.append("<tr><td>Lat:</td><td>"+"<input name = 'lat' value='"+value.d_lat+"'>" + "</td></tr>");    
                        tb.append("<tr><td>Long:</td><td>"+"<input name = 'long' value='"+value.d_long+"'>" + "</td></tr>");  
                        tb.append("<tr><td>Desc:</td><td>"+"<textarea name = 'desc' rows=6 cols=100>"+value.va_res_desc+"</textarea>" + "</td></tr>");      

                        tb.append("<tr><td>City:</td><td><select id='city' name='city'><option></option></select></td></tr>");
                        tb.append("<tr><td>State:</td><td id = 'state' name='state'></div></td></tr>");    

                        tb.append("<tr><td>Logo Url:</td><td>"+"<input name = 'reslogo' value='"+value.va_res_logo+"'>" + "</td></tr>");
                        tb.append("<tr><td>Logo Url:</td><td>"+"<img src="+value.va_res_logo+" height='150' width='250'>" + "</td></tr>");

                        tb.append("<tr><td>Feature Ad:</td><td>"+"<input name = 'featuread' value='"+value.va_feature_ad+"'>" + "</td></tr>");
                        tb.append("<tr><td>Feature Ad:</td><td>"+"<img src="+value.va_feature_ad+" height='400'>" + "</td></tr>");
                        tb.append("<tr><td>Feature:</td><td>"+"<input name = 'resfeature' value='"+value.i_feature+"'>" + "</td></tr>");

                        tb.append("<input hidden name = 'resid' value='"+value.i_res_id+"'>");
                        var citysel = $('#city');
                        $.getJSON('data/place.php',function(data)
                        {  
                            $.each(data.data,function(i,data1)
                            {
                                $.each(data1.cities,function(j,city)
                                { 
                                    citysel.append($("<option></option>")
                                    .attr("value",city.city_name)
                                    .text(city.city_name));   
                                });
                            });  
                            $("#city").val(value.va_city_name);
                            $("#state").html(value.va_state_name);
                        });
                    }
                });
        })            
    });
});
</script>


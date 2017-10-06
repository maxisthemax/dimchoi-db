
<div id="escDivTable" class="subText">RESTAURANT NAME</div>
<br><br>

<form action="index.php" method="post">

    <select id="func" name="func">
        <option></option>
        <option value=updateres>updateres</option>
        <option value=insertnewres>insertnewres</option>
    </select>
    <input type="submit" name="submitfunc" id="submitfunc">

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
            <tr><td>Name :</td><td><input id = "resname_new" name = "resname_new" value="" required></td></tr> 
            <tr><td>Res Code :</td><td><input id = "rescode_new" name = "rescode_new" value="" required></td></tr>
            <tr><td>Menu Code :</td><td><input id = "menucode_new" name = "menucode_new" value="" required></td></tr>
            <tr><td>Area :</td><td><select id = "area_new" name = "area_new" required></select></td></tr>
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

    $( "#submitfunc" ).click(function() {
     $('#resname_new').removeAttr('required'); 
     $('#rescode_new').removeAttr('required');    
     $('#menucode_new').removeAttr('required');   
     $('#area_new').removeAttr('required');  
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
            var area_new = $('#area_new');
            area_new.empty();
            area_new.append("<option></option>");     

            $.getJSON('data/area.php',function(data)
            {   
                    $.each(data.data,function(i,data1)
                    {
                        $.each(data1.cities,function(j,city)
                        { console.log(city);
                            $.each(city.areas,function(k,area)
                            {                            
                            area_new.append($("<option></option>")
                            .attr("value",area.area_id)
                            .text(area.area_name));
                            });   
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
                        tb.append("<tr><td>HQ ID:</td><td>" +"<input name = 'hqid' value='"+value.i_hq_id+"'>" + "</td></tr>");
                        tb.append("<tr><td>Name:</td><td>"+"<input id='resname' name = 'resname' value='"+"'>" + "</td></tr>");
                        tb.append("<tr><td>Res Code:</td><td>"+"<input name = 'rescode' value='"+value.va_res_code+"'>" + "</td></tr>");
                        tb.append("<tr><td>Menu Code:</td><td>"+"<input name = 'menucode' value='"+value.va_menu_code+"'>" + "</td></tr>");
                        tb.append("<tr><td>Add 1:</td><td>"+"<input name = 'add1' value='"+value.va_res_add1+"'>" + "</td></tr>");
                        tb.append("<tr><td>Add 2:</td><td>"+"<input name = 'add2' value='"+value.va_res_add2+"'>" + "</td></tr>");
                        tb.append("<tr><td>Area:</td><td><select id='area' name='area'><option></option></select></td></tr>");
                        tb.append("<tr><td>Lat:</td><td>"+"<input name = 'lat' value='"+value   .d_lat+"'>" + "</td></tr>");    
                        tb.append("<tr><td>Long:</td><td>"+"<input name = 'long' value='"+value.d_long+"'>" + "</td></tr>");  
                        tb.append("<tr><td>Desc:</td><td>"+"<textarea name = 'desc' rows=6 cols=100>"+value.va_res_desc+"</textarea>" + "</td></tr>");      

                        tb.append("<tr><td>City:</td><td><select id='city' name='city'><option></option></select></td></tr>");
                        tb.append("<tr><td>State:</td><td id = 'state' name='state'></div></td></tr>");    

                        tb.append("<tr><td>Logo Url:</td><td>"+"<input name = 'reslogo' value='"+value.va_res_logo+"'>" + "</td></tr>");
                        tb.append("<tr><td>Logo Url:</td><td>"+"<img src="+value.va_res_logo+" height='200'>" + "</td></tr>");
                        tb.append("<tr><td>Ad:</td><td><select id='ad' name='ad'><option value = 1>Yes</option><option value = 0>No</option></select></td></tr>");                        
     
                        tb.append("<tr><td>Feature Ad:</td><td>"+"<input name = 'featuread' value='"+value.va_feature_ad+"'>" + "</td></tr>");
                        tb.append("<tr><td>Feature Ad:</td><td>"+"<img src="+value.va_feature_ad+" height='200'>" + "</td></tr>");
                        tb.append("<tr><td>Feature:</td><td>"+"<input name = 'resfeature' value='"+value.i_feature+"'>" + "</td></tr>");

                        tb.append("<input hidden name = 'resid' value='"+value.i_res_id+"'>");
                        var ad = $('#ad');
                        ad.val(value.i_res_ad);
                        var resname = $('#resname');
                        resname.val(value.va_res_name);
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
                        var areasel = $('#area');
                        $.getJSON('data/area.php',function(dataarea)
                        { 
                            $.each(dataarea.data,function(i,dataarea)
                            {    console.log(dataarea); 
                                $.each(dataarea.cities,function(i,dataarea)
                                {  console.log(dataarea);   
                                    $.each(dataarea.areas,function(i,dataarea)
                                    {                                                                                                     
                                    areasel.append($("<option></option>")
                                    .attr("value",dataarea.area_name)
                                    .text(dataarea.area_name));
                                    }); 
                                }); 
                            }); 
                            $("#area").val(value.va_area_name);                                        
                        });                       
                    }
                });
        })            
    });
});
</script>


function load_subpage(subpage_name)
{
     $.ajax({
                   type     : "POST",
                   url      : subpage_name,
                   data     : {},
    		   success : function(msg) {
                          $("#body_page").html(msg);
    		   },
                   complete : function(r) { },
    		   error:    function(error) { }
      });
}


$(document).ready(function(){
    surki();
  // surki_load();
});



function surki() {
  
  //  document.getElementById('godzina').innerHTML =
   // h + ":" + m + ":" + s;
    surki_load();
    var t = setTimeout(surki, 3000);
}

function surki_load()
{
 $.ajax({
                   type     : "POST",
                   url      : "surki_load.php",
                   data     : {},
    		   success : function(msg) {
                      var wynik=$.parseJSON(msg);
                        //  alert(wynik['metal']);
                        surki_upload(wynik);
    		   },
                   complete : function(r) { },
    		   error:    function(error) { }
      });
}

function surki_upload(tab)
{
        //alert(tab['metal']);
   $('#metal').html(tab['metal']);
     $('#crystal').html(tab['crystal']);
     $('#deuterium').html(tab['deuterium']);
     //Energia

     var energy_free=tab['energy_max']-tab['energy_used'];
     $('#energy').html(energy_free+'/'+tab['energy_max']);
}

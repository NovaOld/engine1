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

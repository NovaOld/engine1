<html>
  <head>
     <?php
      require("config.php");
      require("planets.php");
      $planeta=new planets();
      $planeta->load_planet(102);
      //poziom_metalu 
      
    ?>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script>
      // $( "#metal" ).change(function() {
       //  alert($("#meta").val());
       //     test($("#meta").val());
      // });
         function demo()
         {
            test($("#metal").val());
         } 
 
        
        function test(proc)
        {
                var id_planety=<?php echo $planeta->id; ?>;
                $.ajax({
                   type     : "POST",
                   url      : "surki.php",
                   data     : {
                          id:id_planety,
                          procent:proc
                       //  kraj : 'Polska'
    		   },
    		   success : function(msg) {
                          $("#wynik").html(msg);
                         // document.getElementById('link').value=msg;
    		   },
                   complete : function(r) {
        		//ten fragment wykona się po ZAKONCZENIU połączenia
        		//"r" to przykładowa nazwa zmiennej, która zawiera dane zwrócone z serwera
    		   },
    		   error:    function(error) {
       			 //ten fragment wykona się w przypadku BŁĘDU
                        //  var ddok='dodaj_okno('+id+')';
        		 // setTimeout(ddok,4500);
                  }
             });
        }
     </script>
  </head>
  <body>
    <?php echo "procent: ".$planeta->metal_mine_porcent."<br>"; 
    $wartosc=$planeta->metal_mine_porcent;
    if($wartosc==6) echo "ok<br>";
   ?>

<br>
   <div id="wynik">Wynik</div>
  <br>
  <select id="metal" onchange="demo();">
      <option value="10" >100</option>
      <option value="9" >90</option>
      <option value="8" >80</option>
      <option value="7"  >70</option>
      <option value="6"  <?php if($wartosc==6) echo "selected"; ?>>60</option>
    </select> 
</body>
</html>

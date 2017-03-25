<!DOCTYPE html>
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
         function demo(id)
         {
            test($("#"+id).val(),id);
         } 
        
        function test(proc,id_sr)
        {
                var id_planety=<?php echo $planeta->id; ?>;
                $.ajax({
                   type     : "POST",
                   url      : "surki.php",
                   data     : {
                          id:id_planety,
                          procent:proc,
                          surek:id_sr
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
  <?php //echo "procent: ".$planeta->metal_mine_porcent."<br>"; 
    $wartosc_m=$planeta->metal_mine_porcent;
    $wartosc_k=$planeta->crystal_mine_porcent;
//    if($wartosc==6) echo "ok<br>";
       $zaznaczone='selected="selected"';
   ?>
<b>Metal: <b>
<select id="metal" onchange="demo('metal');">
      <option value="10"  <?php if($wartosc_m==10) echo $zaznaczone; ?>>100</option>
      <option value="9"   <?php if($wartosc_m==9) echo $zaznaczone; ?>>90</option>
      <option value="8"   <?php if($wartosc_m==8) echo $zaznaczone; ?>>80</option>
      <option value="7"   <?php if($wartosc_m==7) echo $zaznaczone; ?>>70</option>
      <option value="6"   <?php if($wartosc_m==6) echo $zaznaczone; ?>>60</option>
      <option value="5"   <?php if($wartosc_m==5) echo $zaznaczone; ?>>50</option>
      <option value="4"   <?php if($wartosc_m==4) echo $zaznaczone; ?>>40</option>
      <option value="3"   <?php if($wartosc_m==3) echo $zaznaczone; ?>>30</option>
      <option value="2"   <?php if($wartosc_m==2) echo $zaznaczone; ?>>20</option>
      <option value="1"   <?php if($wartosc_m==1) echo $zaznaczone; ?>>10</option>
      <option value="0"   <?php if($wartosc_m==0) echo $zaznaczone; ?>>0</option>
    </select><br>

<b>Krysztal: <b>
<select id="krysztal" onchange="demo('krysztal');">
      <option value="10"  <?php if($wartosc_k==10) echo $zaznaczone; ?>>100</option>
      <option value="9"   <?php if($wartosc_k==9) echo $zaznaczone; ?>>90</option>
      <option value="8"   <?php if($wartosc_k==8) echo $zaznaczone; ?>>80</option>
      <option value="7"   <?php if($wartosc_k==7) echo $zaznaczone; ?>>70</option>
      <option value="6"   <?php if($wartosc_k==6) echo $zaznaczone; ?>>60</option>
      <option value="5"   <?php if($wartosc_k==5) echo $zaznaczone; ?>>50</option>
      <option value="4"   <?php if($wartosc_k==4) echo $zaznaczone; ?>>40</option>
      <option value="3"   <?php if($wartosc_k==3) echo $zaznaczone; ?>>30</option>
      <option value="2"   <?php if($wartosc_k==2) echo $zaznaczone; ?>>20</option>
      <option value="1"   <?php if($wartosc_k==1) echo $zaznaczone; ?>>10</option>
      <option value="0"   <?php if($wartosc_k==0) echo $zaznaczone; ?>>0</option>
    </select>


 <br>
  <div id="wynik">Wynik</div>
</body>
</html>


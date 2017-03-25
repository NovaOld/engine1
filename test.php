<?php
       define('DB_HOST','localhost');
       define('DB_USER','strona'); //wpisz nazwęużytkownika bazy danych @94-23-92-182.ovh.net
       define('DB_PASS','test'); //wpisz hasło dla tego użytkownikar
       $polacz = mysql_connect(DB_HOST, DB_USER, DB_PASS)
           or die('Nie udalo polaczyc sie z baza danych. '.mysql_error());
       $link=$polacz;
       define('DB_POLACZ','$polacz');
       $DB = mysql_select_db('ugm'); //db1170634');
       mysql_query("SET NAMES 'utf8';"); 
       mysql_query('SET CHARACTER SET utf8_polish_ci;');
       require("planets.php");
     //  mysql_query("select * from ugml_planets order by id desc limit 50") or die(mysql_query());
       $planety=new planets();
       $planety->load_planets();
?>
<table border="2">
  <th>
   <td>ID</td>
   <td>Nazwa</td>
   <td>ID Wlasciciela</td>
   <td>Galaktyka</td>
   <td>System</td>
   <td>Planeta</td>
   <td>Czy zniszczona?</td>
   <td>Punkt</td>
  <th>
<?php
  while($odp=$planety->get_planets())
  {
      $id=$odp['id'];
      $planeta=new planets();
      $planeta->load_planet($id);
      ?>
      <tr>
        <td></td>
        <td><?php echo $planeta->id; ?></td>
        <td><?php echo $planeta->name; ?></td>
        <td><?php echo $planeta->id_owner; ?></td>
        <td><?php echo $planeta->galaxy; ?></td>
        <td><?php echo $planeta->system; ?></td>
        <td><?php echo $planeta->planet; ?></td>
        <td><?php echo $planeta->destroyed; ?></td>
        <td><?php echo $planeta->points; ?></td>
      <tr>
      <?php
  }
?>
</table>

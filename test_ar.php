<?php
  require("config.php");
  $zap=mysql_query("select * from ugml_planets where id=102") or die(mysql_error());
  $odp=mysql_fetch_array($zap);
  echo "<pre>";
  print_r($odp);
  echo "</pre><br>";
  $zap=mysql_query("select * from ugml_users where id=71") or die(mysql_error());
  $odp=mysql_fetch_array($zap);
  echo "<pre>";
  print_r($odp);
  echo "</pre>";

?>

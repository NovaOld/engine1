<?php
  require("config.php");
  require("planets.php");
  $planeta=new planets();
  $planeta->load_planet(102);
  $planeta->update_ressource();
  echo $planeta->get_ressource_json();
?>

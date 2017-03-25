<?php
  require("config.php");
  require("planets.php");
  $planeta=new planets();
  $planeta->load_planet(102);
  $nazwa_pliku="test.tpl";
  $myfile = fopen($nazwa_pliku, "r") or die("Unable to open file!");
  $template=fread($myfile,filesize($nazwa_pliku));
  fclose($myfile);
  
  $template=str_replace('{select_planetlist}','<option value="planeta1" selected="selected">'.$planeta->name.'</option>',$template);
  $template=str_replace('{metal_over}',$planeta->is_metal_max(),$template);
  $template=str_replace('{crystal_over}',$planeta->is_crystal_max(),$template);
  $template=str_replace('{deuterium_over}',$planeta->is_deuterium_max(),$template);
  $template=str_replace('{energy_over}',$planeta->is_energy_max(),$template);
  $template=str_replace('{metal_src}',$planeta->metal,$template);
  // $template=str_replace('{metal_src}','0',$template);
   $template=str_replace('{crystal_src}',$planeta->crystal,$template);
   $template=str_replace('{deuterium_src}',$planeta->deuterium,$template);
      $template=str_replace('{energy_free}',$planeta->energy_free(),$template);
      $template=str_replace('{energy_max}',$planeta->energy_max,$template);
   echo $template;
?>

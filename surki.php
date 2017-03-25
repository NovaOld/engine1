<?php
  require("config.php");
  require("planets.php");
  $metal=$_POST['procent'];
  $id_planety=$_POST['id'];
  $typ_surowca=$_POST['surek'];
  $planeta=new planets();
  $planeta->load_planet($id_planety);
  if($typ_surowca=="metal") $planeta->metal_mine_porcent=$metal;
  if($typ_surowca=="krysztal") $planeta->crystal_mine_porcent=$metal;
  if($typ_surowca=="deuter") $planeta->deuterium_sintetizer_porcent=$metal;
  if($typ_surowca=="elek_solar") $planeta->solar_plant_porcent=$metal;
  if($typ_surowca=="elek_fuz") $planeta->fusion_plant_porcent=$metal;
  if($typ_surowca=="satelita") $planeta->solar_satelit_porcent=$metal;
  $planeta->save();
  echo "zapisano!";
?>

<?php
   require("config.php");
   require("planets.php");
   require("template.php");
   
   function translate_month($name)
   {
       if($name=="January") return "Stycznia";
       if($name=="Feburary") return "Lutego";
       if($name=="March") return "Marca";
       if($name=="April") return "Kwietnia";
       if($name=="May") return "Maja";
       if($name=="June") return "Czerwca";
       if($name=="July") return "Lipca";
       if($name=="August") return "Sierpnia";
       if($name=="September") return "Werzesnia";
       if($name=="October") return "Października";
       if($name=="November") return "Listopada";
       if($name=="December") return "Grudnia";
     return "";
   }

   function translate_day($name)
   {
      if($name=="Monday") return "poniedzialek";
      if($name=="Tuesday") return "Wtorek";
      if($name=="Wednesday") return "Środa";
      if($name=="Thursday") return "Czwartek";
      if($name=="Friday") return "Piątek";
      if($name=="Saturday") return "Sobota";
      if($name=="Sunday") return "Niedziela";
    return "";
   }

   $planeta=new planets();
   $planeta->load_planet(102);
   $tpl=new template();

   //HEAD
   $tpl->add_schematic("template/nova/head.tpl");
   $tpl->add_value("","{head}");
   $tpl->add_to_page();
   
   //HEADRER
   $tpl->add_schematic("template/nova/header.tpl");
   $tpl->add_value('<option value="planeta1" selected="selected">'.$planeta->name.'</option>',"{select_planetlist}");
   $tpl->add_value($planeta->is_metal_max(),"{metal_over}");
   $tpl->add_value($planeta->is_crystal_max(),"{crystal_over}");
   $tpl->add_value($planeta->is_deuterium_max(),"{deuterium_over}");
   $tpl->add_value($planeta->is_energy_max(),"{energy_over}");
   $tpl->add_value($planeta->metal,"{metal_src}");
   $tpl->add_value($planeta->crystal,"{crystal_src}");
   $tpl->add_value($planeta->deuterium,"{deuterium_src}");
   $tpl->add_value($planeta->energy_max,"{energy_max}");
   $tpl->add_value($planeta->energy_free(),"{energy_free}");
   $tpl->add_to_page();
   
   //MENU
   $tpl->add_schematic("template/nova/menu.tpl");
   $tpl->add_to_page();
  
   //OVERVIEW
   $tpl->add_schematic("template/nova/overview.tpl");
   $tpl->add_value($planet->name,"{planet_name}");

   $dzien=translate_day(date('l'));
  // $dzien=date('l');
   $miesiac=translate_month(date('F'));
 // $miesiac=date('F');
   $dzien_liczba=date('d');
   $rok=date('Y');
   $data=$dzien.", ".$dzien_liczba." ".$miesiac.", ".$rok;

   $tpl->add_value($data,"{data}");
   $tpl->add_value(date("H:i:s"),"{godzina}");
   $tpl->add_to_page();
   $tpl->display();
?>

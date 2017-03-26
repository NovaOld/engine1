<?php
  //overview generator 
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

   //OVERVIEW
   $tpl->add_schematic("template/nova/overview.tpl");
   $tpl->add_value($planeta->name,"{planet_name}");

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


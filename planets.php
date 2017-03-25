<?php
 class planets {
   public $id=0;
   public $name="planeta";
   public $id_owner=0; //id wlasciciela planety
   public $galaxy=0;
   public $system=0;
   public $planet=0; //ktora planeta w ukladzie
   public $last_update=0; //ostatnia aktualizacja statusu planety
   public $sensors_phalax=0; //falanga czujnikow
   public $planet_type=0; 
   public $destruyed=0;
   public $image="";
   public $diameter=0; //srednica ksiezyca
   public $points=0;
   public $ranks=0;
   public $solar_satelit=0;
   public $metal_mine_porcent=0;
   public $crystal_mine_porcent=0;
   public $deuterium_sintetizer_porcent=0;
   public $solar_plant_porcent=0;
   public $fusion_plant_porcent=0;
   public $solar_satelit_porcent=0;

   //surowce
   public $metal=0;
   public $metal_max=0;
   public $crystal=0;
   public $crystal_max=0;
   public $deuterium=0;
   public $deuterium_max=0;
   public $energy_used=0;
   public $energy_max=0;

   public function save()
   {
      $prefix="ugml_"; 
      $nazwa_tabeli=$prefix."planets";
      $zapytanie="update $nazwa_tabeli set ";
      $zapytanie.="name='".$this->name."', ";
      $zapytanie.="metal_mine_porcent=".$this->metal_mine_porcent.", ";
      $zapytanie.="crystal_mine_porcent=".$this->crystal_mine_porcent.", ";
      $zapytanie.="deuterium_sintetizer_porcent=".$this->deuterium_sintetizer_porcent.", ";
      $zapytanie.="solar_plant_porcent=".$this->solar_plant_porcent.", ";
      $zapytanie.="fusion_plant_porcent=".$this->fusion_plant_porcent.", ";
      $zapytanie.="solar_satelit_porcent=".$this->solar_satelit_porcent." ";
      $zapytanie.="where id=".$this->id;
      mysql_query($zapytanie) or die($zapytanie." - ".mysql_error());
   }

   public function load_planet($id)
   {
      //TODO zabezpieczyc zmienna id
      $prefix="ugml_"; 
      $nazwa_tabeli=$prefix."planets";
      $zapytanie="select * from $nazwa_tabeli where id=$id";
      $zap=mysql_query($zapytanie) or die("planets.php-load_planets-".$zapytanie."-".mysql_error());
      $odp=mysql_fetch_assoc($zap);
      $this->id=$odp['id'];
      $this->name=$odp['name'];
      $this->id_owner=$odp['id_owner']; //id wlasciciela
      $this->galaxy=$odp['galaxy'];
      $this->system=$odp['system']; 
      $this->planet=$odp['planet']; //ktora planeta w systemie
      $this->destroyed=$odp['destruyed'];
      $this->image=$odp['image'];
      $this->diameter=$odp['diameter'];
      $this->points=$odp['points'];
      $this->ranks=$odp['ranks'];
      $this->solar_satelit=$odp['solar_satelit'];
      $this->metal_mine_porcent=$odp['metal_mine_porcent'];
      $this->crystal_mine_porcent=$odp['crystal_mine_porcent'];
      $this->deuterium_sintetizer_porcent=$odp['deuterium_sintetizer_porcent'];
      $this->solar_plant_porcent=$odp['solar_plant_porcent'];
      $this->fusion_plant_porcent=$odp['fusion_plant_porcent'];
      $this->solar_satelit_porcent=$odp['solar_satelit_porcent'];
      $this->load_resources();
   }

   public function load_planet_by_user($id)
   {
      //TODO zabezpieczyc zmienna id
      $prefix="ugml_"; 
      $nazwa_tabeli=$prefix."planets";
      $zapytanie="select * from $nazwa_tabeli where id_owner=$id";
      $zap=mysql_query($zapytanie) or die("planets.php-load_planets-".$zapytanie."-".mysql_error());
      $odp=mysql_fetch_assoc($zap);
      $this->id=$odp['id'];
      $this->name=$odp['name'];
      $this->id_owner=$odp['id_owner']; //id wlasciciela
      $this->galaxy=$odp['galaxy'];
      $this->system=$odp['system']; 
      $this->planet=$odp['planet']; //ktora planeta w systemie
      $this->destroyed=$odp['destruyed'];
      $this->image=$odp['image'];
      $this->diameter=$odp['diameter'];
      $this->points=$odp['points'];
      $this->ranks=$odp['ranks'];
      $this->solar_satelit=$odp['solar_satelit'];
      $this->metal_mine_porcent=$odp['metal_mine_porcent'];
      $this->crystal_mine_porcent=$odp['crystal_mine_porcent'];
      $this->deuterium_sintetizer_porcent=$odp['deuterium_sintetizer_porcent'];
      $this->solar_plant_porcent=$odp['solar_plant_porcent'];
      $this->fusion_plant_porcent=$odp['fusion_plant_porcent'];
      $this->solar_satelit_porcent=$odp['solar_satelit_porcent'];
      $this->load_resources();
   }

   private function load_resources()
   {
     $prefix="ugml_"; 
     $nazwa_tabeli=$prefix."planets";
     $id_planety=$this->id;
     $zap=mysql_query("select metal, metal_max, crystal, crystal_max, deuterium, deuterium_max, energy_used, energy_max from $nazwa_tabeli where id=$id_planety");
     $odp=mysql_fetch_assoc($zap);
     $this->metal=$odp['metal'];
     $this->metal_max=$odp['metal_max'];
     $this->crystal=$odp['crystal'];
     $this->crystal_max=$odp['crystal_max'];
     $this->deuterium=$odp['deuterium'];
     $this->deuterium_max=$odp['deuterium_max'];
     $this->energy_used=$odp['energy_used'];
     $this->energy_max=$odp['energy_max'];
   }

   private $planety_odp;
   
   public function load_planets()
   {
       $prefix="ugml_"; 
       $nazwa_tabeli=$prefix."planets";
       $this->planety_odp=mysql_query("select * from $nazwa_tabeli order by id desc limit 50") or die(mysql_query());
   }

   public function get_planets()
   {
        return mysql_fetch_assoc($this->planety_odp);
   }
 
   public function zmiana_nazwy_planety($nowa_nazwa)
   {
       $this->name=$nowa_nazwa;
   }

   public function zmiana_metalu_procent($procent)
   {
     $this->metal_mine_porcent=$procent;
   }

   public function zmiana_krysztalu_procent($procent)
   {
     $this->crystal_mine_porcent=$procent;
   }

   public function zmiana_duteru_procent($procent)
   {
     $this->deuterium_mine_porcent=$procent;
   }

   public function zmiana_elektrowni_slonecznej_procent($procent)
   {
     $this->solar_mine_porcent=$procent;
   }

  
   public function zmiana_elektrowni_fuzyjnej_procent($procent)
   {
     $this->fusion_mine_porcent=$procent;
   }

   public function zmiana_satelit_procent($procent)
   {
     $this->solar_satelit_porcent=$procent;
   }

   public function is_metal_max()
   {
         if($this->metal>=$this->metal_max) return "";
       return "r-ok";
   }

   public function is_crystal_max()
   {
         if($this->crystal>=$this->crystal_max) return "";
       return "r-ok";
   }
  
   public function is_deuterium_max()
   {
         if($this->deuterium>=$this->crystal_max) return "";
       return "r-ok";
   }

   public function energy_free()
   {
      return $this->energy_max-$this-energy_used;
   }

   public function is_energy_max()
   {
         if($this->energy_free()<0) return "";
       return "r-ok";
   }
  
 }
?>

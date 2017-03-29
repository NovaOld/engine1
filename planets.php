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
     $this->load_max_resources();
   }


   private function load_max_resources()
   {
     $prefix="ugml_"; 
     $nazwa_tabeli=$prefix."planets";
     $id_planety=$this->id;
     $zap=mysql_query("select metal_store, crystal_store, deuterium_store from $nazwa_tabeli where id=$id_planety");
     $odp=mysql_fetch_assoc($zap);
     $metal_store=$odp['metal_store'];
     $crystal_store=$odp['crystal_store'];
     $deuterium_store=$odp['deuterium_store'];
     $this->metal_max+=pow(2,$metal_store);
     $this->crystal_max+=pow(2,$crystal_store);
     $this->deuterium_max+=pow(2,$deuterium_store);
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
         if($this->metal>=$this->metal_max) return "r-overload";
       return "";
   }

   public function is_crystal_max()
   {
         if($this->crystal>=$this->crystal_max) return "r-overload";
       return "";
   }
  
   public function is_deuterium_max()
   {
         if($this->deuterium>=$this->crystal_max) return "r-overload";
       return "";
   }

   public function energy_free()
   {
      return $this->energy_max-$this->energy_used;
   }

   public function is_energy_max()
   {
         if($this->energy_free()<0) return "r-overload";
       return "";
   }

   public function update_ressource()
   {
       $PLANET=$this->get_one_planets_array($this->id);
   echo	'<br>'.$PLANET['metal'].' - ';//		= max($PLANET['metal'], 0);
echo		'<br>'.$PLANET['crystal'].' - ';//	= max($PLANET['crystal'], 0);
echo		'<br>'.$PLANET['deuterium'].' - ';//	= max($PLANET['deuterium'], 0);

       $USER=$this->get_one_player($PLANET['id_owner']);
       $CONF=$this->get_game_settings();
       $odp=$this->UpdateRessource($PLANET, $USER, $CONF);
       $this->save_update($odp);
   }

   public function factory_array()
   {
      $factory=array(); $factory['bilidspeed']=1; $factory[0]=1490727720; $factory[1]=0.1; $factory[2]=0;
      $factory['techspeed']=1; $factory[3]=1490727720; $factory[4]=0.1; $factory[5]=0; $factory['fleetspeed']=1;
      $factory[6]=1490727720; $factory[7]=0.1; $factory[8]=0; $factory['defspeed']=1; $factory[9]=1490727720;
      $factory[10]=0.1; $factory[11]=0; $factory['metal']=1; $factory[12]=1490727720; $factory[13]=0.1;
      $factory[14]=0; $factory['crystal']=1; $factory[15]=1490727720; $factory[16]=0.1; $factory[17]=0;
      $factory['deuterium']=1; $factory[18]=1490727720; $factory[19]=0.1; $factory[20]=0; $factory['norio']=1;
      $factory[21]=1490727720; $factory[22]=0.1; $factory[23]=0;
      $factory['energy']=1; $factory[24]=1490727720; $factory[25]=0.1; $factory[26]=0;
     return $factory;
   }

   private function get_one_planets_array($id_planety)
   {
        require("factory_array.php");
        $prefix="ugml_"; 
        $nazwa_tabeli=$prefix."planets";
         $zap=mysql_query("select * from $nazwa_tabeli where id=$id_planety") or die(mysql_error());
         $odp=mysql_fetch_array($zap);
         $odp['factory']=$this->factory_array();
       return $odp;
   }


   private function get_one_player($player_id)
   {
       $prefix="ugml_"; 
       $nazwa_tabeli=$prefix."users";
       $zap=mysql_query("select * from $nazwa_tabeli where id=$player_id") or die(mysql_error());
       return mysql_fetch_array($zap);
   }

   private function get_game_settings()
   {
        $prefix="ugml_"; 
        $nazwa_tabeli=$prefix."config";
     $zap=mysql_query("select * from $nazwa_tabeli") or die(mysql_error());
     $settings=null;
     while($odp=mysql_fetch_assoc($zap))
     {
       $key=$odp['config_name'];
       $value=$odp['config_value'];
       $settings[$key]=$value;
     }
     return $settings;
   }
  
   private function save_update($PLANET)
   {
      $last_up=$PLANET['last_update'];
      $metal=$PLANET['metal'];
      $crystal=$PLANET['crystal'];
      $deuterium=$PLANET['deuterium'];
       if($deuterium<0) die($deuterium);
      $id=$PLANET['id'];
       $prefix="ugml_"; 
      $nazwa_tabeli=$prefix."planets";
           echo	'<br>'.$PLANET['metal'].' - ';
      mysql_query("update $nazwa_tabeli set last_update='$last_up', metal='$metal', crystal='$crystal', deuterium='$deuterium' where id=$id") or die(mysql_error());
   }

   private  function UpdateRessource($PLANET, $USER, $CONF)
   {
                $TIME=date('U');
                define('STORAGE_FACTOR' , 1.0);
                define('MAX_OVERFLOW' , 1.0);
		global $ProdGrid;//, $resource, $reslist;
                //Dział uzupełnienia resurce dla stworzenia kompatybilności z silnikiem XNova 
                $resource[1]='metal_mine';
                $resource[2]='crystal_mine';
                $resource[3]='deuterium_sintetizer';
                $resource[4]='solar_plant';
                $resource[12]='fusion_plant';
                $resource[212]='solar_satelit';

                //Dział uzupełnienia reslist dla stworzenia kompatybilności z silnikiem XNova
                $reslist['prod']= array ( 0 => 1, 1 => 2, 2 => 3, 3 => 4,  4 => 12, 5 => 212 ); 
 
                          // PLANET metal_max
		$PLANET['metal_max']			= floor(2.5 * pow(1.8331954764, $PLANET['metal_store'])) * 5000  * $CONF['resource_multiplier'] * STORAGE_FACTOR;
		$PLANET['crystal_max']		= floor(2.5 * pow(1.8331954764, $PLANET['crystal_store'])) * 5000  * $CONF['resource_multiplier'] * STORAGE_FACTOR;
		$PLANET['deuterium_max']		= floor(2.5 * pow(1.8331954764, $PLANET['deuterium_store'])) * 5000  * $CONF['resource_multiplier'] * STORAGE_FACTOR;
		$PLANET['norio_max']		    = 1;
		
		$MaxMetalStorage                	= $PLANET['metal_max']     * MAX_OVERFLOW;
		$MaxCristalStorage              	= $PLANET['crystal_max']   * MAX_OVERFLOW;
		$MaxDeuteriumStorage     		    = $PLANET['deuterium_max'] * MAX_OVERFLOW;
		$MaxNorioStorage     		        = 0;
		$ProductionTime    			= ($TIME - $PLANET['last_update']);

		$PLANET['last_update']   		= $TIME;

		if ($PLANET['planet_type'] == 3)
		{
			$CONF['metal_basic_income']     	= 0;
			$CONF['crystal_basic_income']   	= 0;
			$CONF['deuterium_basic_income'] 	= 0;
			$CONF['norio_basic_income'] 	    = 0;
			$PLANET['metal_perhour']      = 0;
			$PLANET['crystal_perhour']    = 0;
			$PLANET['deuterium_perhour']  = 0;
			$PLANET['norio_perhour']      = 0;
			$PLANET['energy_used']        = 0;
			$PLANET['metal_proc']                     = array(0);
            $PLANET['crystal_proc']                   = array(0);
            $PLANET['deuterium_proc']                 = array(0);
            $PLANET['deuterium_userd_proc']   = array(0);
			$PLANET['norio_proc']                 = array(0);
            $PLANET['energy_used_proc']               = array(0);
            if($PLANET[$resource[212]] == 0) {
                $PLANET['energy_max_proc']                = array(0);
                $PLANET['energy_max']             = 0;
            } else {
                $BuildTemp      = $PLANET['temp_max'];
                $BuildLevelFactor                                               = $PLANET[$resource[212].'_porcent'];
                $BuildLevel                                                     = $PLANET[$resource[212]];
                $PLANET['energy_max_proc'][212]   = 1; 
				$PLANET['energy_max']             = $PLANET['energy_max_proc'][212];
            }
		}
		else
		{
			$Caps           = array();
			$BuildTemp      = $PLANET['temp_max'];
			$BuildEnergy	= $USER['energy_tech'];
			$Caps['metal_perhour'] = $Caps['crystal_perhour'] = $Caps['deuterium_perhour'] = $Caps['norio_perhour'] = $Caps['energy_used'] = $Caps['energy_max'] = $Caps['deuterium_used'] = 0;

			foreach($reslist['prod'] as $id => $ProdID)
			{
                         
				$BuildLevelFactor	= $PLANET[$resource[$ProdID]."_porcent" ];
				$BuildLevel 		= $PLANET[$resource[$ProdID]];
				$Caps['metal_perhour']		+= 1* $CONF['resource_multiplier'];
				$Caps['crystal_perhour']	+= 1* $CONF['resource_multiplier'];
                                 

				if ($ProdID < 4 or $ProdID == 7) {
					$Caps['deuterium_perhour'] 	+= 1 * $CONF['resource_multiplier'];
					$Caps['energy_used']   		+= 1 * $CONF['resource_multiplier'];
				} else {
					if($ProdID == 12 && $PLANET['deuterium'] == 0)
						continue;

					$Caps['deuterium_used'] 	+= 1 * ($CONF['resource_multiplier']);
					$Caps['energy_max']		+= 1 * ($CONF['resource_multiplier']);
				}
			}
			
			if ($Caps['energy_max'] == 0)
			{
				$PLANET['metal_perhour']     = $CONF['metal_basic_income'];
				$PLANET['crystal_perhour']   = $CONF['crystal_basic_income'];
				$PLANET['deuterium_perhour'] = $CONF['deuterium_basic_income'];
				$LEVEL = 0;
			}
			elseif ($Caps['energy_max'] >= abs($Caps['energy_used']))
				$LEVEL = 100;
			else
			{
            if($Caps['energy_max'] == 0 || $Caps['energy_used'] == 0)
               $LEVEL = 0;
            else
               $LEVEL =  floor($Caps['energy_max'] / abs($Caps['energy_used']) * 100);
			}
				
			if($LEVEL > 100)
				$LEVEL = 100;
			elseif ($LEVEL < 0)
				$LEVEL = 0;				
			
			$PLANET['metal_perhour']        = $Caps['metal_perhour'] * (0.01 * $LEVEL);
			$PLANET['crystal_perhour']      = $Caps['crystal_perhour'] * (0.01 * $LEVEL);
			$PLANET['deuterium_perhour']    = $Caps['deuterium_perhour'] * (0.01 * $LEVEL) + $Caps['deuterium_used'];
			$PLANET['energy_used']          = $Caps['energy_used'];
			$PLANET['energy_max']           = $Caps['energy_max'];

			#ADDED 
			$MetalTheorical		= 0;
                        $CristalTheorical	= 0;
			$DeuteriumTheorical	= 0;
			
			if ($PLANET['metal'] <= $MaxMetalStorage)
			{
				$MetalTheorical 		= ($ProductionTime * (($CONF['metal_basic_income'] * $CONF['resource_multiplier']) + $PLANET['metal_perhour']) / 3600);
				$PLANET['metal']  		= min($PLANET['metal'] + $MetalTheorical, $MaxMetalStorage);
			}
			
			if ($PLANET['crystal'] <= $MaxCristalStorage)
			{
				$CristalTheorical  		= ($ProductionTime * (($CONF['crystal_basic_income'] * $CONF['resource_multiplier']) + $PLANET['crystal_perhour']) / 3600);
				$PLANET['crystal']  	= min($PLANET['crystal'] + $CristalTheorical, $MaxCristalStorage);
	 		}	

	 		if ($PLANET['deuterium'] <= $MaxDeuteriumStorage || $PLANET['deuterium_perhour'] < 0)
			{

				$DeuteriumTheorical		= ($ProductionTime * (($CONF['deuterium_basic_income'] * $CONF['resource_multiplier']) + $PLANET['deuterium_perhour']) / 3600);
				$PLANET['deuterium']	= min($PLANET['deuterium'] + $DeuteriumTheorical, $MaxDeuteriumStorage);
			}

		}
		
	
	        $PLANET['metal']	= max($PLANET['metal'], 0);
		$PLANET['crystal']	= max($PLANET['crystal'], 0);
		$PLANET['deuterium']	= max($PLANET['deuterium'], 0);

            return $PLANET;
	}

        public function get_ressource_json()
        { 
             $tablica=null;
             $tablica['metal']=$this->metal;
             $tablica['metal_max']=$this->metal_max;
             $tablica['crystal']=$this->crystal;
             $tablica['crystal_max']=$this->crystal_max;
             $tablica['deuterium']=$this->deuterium;
             $tablica['deuterium_max']=$this->deuterium_max;
             $tablica['energy_used']=$this->energy_used;
             $tablica['energy_max']=$this->energy_max;
           return json_encode($ar);
        }
  
 }
?>

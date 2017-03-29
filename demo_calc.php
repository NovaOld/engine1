<?php
 require("config.php");
 require("factory_array.php");
 $zap=mysql_query("select * from ugml_planets where id=102") or die(mysql_error());
 $PLANET=mysql_fetch_array($zap);
 $PLANET['factory']=$factory;
 $zap=mysql_query("select * from ugml_users where id=71") or die(mysql_error());
 $USER=mysql_fetch_array($zap);

 $zap=mysql_query("select * from ugml_config") or die(mysql_error());
 $settings=null;
 while($odp=mysql_fetch_assoc($zap))
 {
   $key=$odp['config_name'];
   $value=$odp['config_value'];
   $settings[$key]=$value;
 }
 /*$PlanetRess = new ResourceUpdate();
 $PlanetRess->CalcResource($USER, $PLANET,TRUE);
 $PlanetRess->SavePlanetToDB();*/
echo	'<br>'.$PLANET['metal'];//		= max($PLANET['metal'], 0);
echo		'<br>'.$PLANET['crystal'];//	= max($PLANET['crystal'], 0);
echo		'<br>'.$PLANET['deuterium'];//	= max($PLANET['deuterium'], 0);

 $odp=UpdateRessource($PLANET, $USER, $settings);
  save_update($odp);
 function save_update($PLANET)
 {
      $last_up=$PLANET['last_update'];
      $metal=$PLANET['metal'];
      $crystal=$PLANET['crystal'];
      $deuterium=$PLANET['deuterium'];
      $id=$PLANET['id'];
      mysql_query("update ugml_planets set last_update='$last_up', metal='$metal', crystal='$crystal', deuterium='$deuterium' where id=$id") or die(mysql_error());
 }


 function UpdateRessource($PLANET, $USER, $CONF)
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
                  echo ' '.$PLANET['metal_max'];
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
	
?>

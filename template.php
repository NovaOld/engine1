<?php
  class template 
  {
    private $page="";
    private $schematic="";
    private $head="";
    
    public function add_schematic($name_file)
    {
        $tpl_file = fopen($name_file, "r") or die("Unable to open file!");
        $this->schematic=fread($tpl_file,filesize($name_file));
        fclose($tpl_file);
    }

    public function add_value($value, $tag)
    {
   //    echo "str_replace(\"".$tag."\", \"".$value."\" \$this->schematic);<br>";
       $this->schematic=str_replace($tag,$value,$this->schematic); 
    }

    public function add_to_page()
    {
          $this->page.=$this->schematic;
    }

    public function display()
    {
        $this->page=str_replace('{HEAD}',$this->head,$this->page); 
        echo $this->page;
    }

    public function add_js($file_name)
    {
        $this->head.='<script src="'.$file_name.'"></script>';
    }
  }
?>

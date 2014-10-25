<?php
/**
* File: tabble2arr.php
* Description: class to convert HTML table to an PHP array
* Author: Patrick Ingle for PHK Corporation
* Author URL: http://phkcorp.com
* License: COMMON DEVELOPMENT AND DISTRIBUTION LICENSE Version 1.0 (CDDL-1.0) [See lincese.txt]
*/

class table2arr 
{ 
var $cells; 
var $table; 
var $trans; 
var $tablecount; 
var $colspan; 

function findfirst($table,$level) 
// correct bug for multi extract problem, thanks Daniel Sepeur 
        { 
        if (is_array($table)) {
        foreach ($table as $key=>$arr) 
          { 
          $flevel=$arr["level"]; 
          $flen=$arr["len"]; 
          if (($flevel==$level) AND 
             ($flen==0)) return $key; 
          } 
		}
        return -1; 
        } 


function table2arr($html,$aspan=False,$tabidx=-1) 
    { 
    $this->trans = get_html_translation_table(HTML_ENTITIES); 
    $this->trans["€"]="&euro;"; 
    $this->trans = array_flip($this->trans); 
    $this->tablecount=0; 
    $this->colspan=$aspan; 
    $this->parsetable($html); 
    if ($tabidx>=0) 
       $this->getcells($tabidx); 
    } 


function parsetable($html) 
{ 
    $shtml=strtolower($html); 
    $level=0; 
    $idx=0; 
    $posbegin = strpos($shtml, '<table', 1); 
    while ($posbegin) 
      { 
      $tabpos[$posbegin]="b"; 
      $posbegin = strpos($shtml, '<table', $posbegin+1); 
      } 
    $posend = strpos($shtml, '</table>', 1); 
    while ($posend) 
      { 
      $tabpos[$posend+8]="e"; 
      $posend = strpos($shtml, '</table>', $posend+1); 
      } 
    ksort($tabpos); 
    $idx=0; 

    foreach ($tabpos as $posbegin=>$beginend) 
    { 
    if ($beginend=="b") 
        { 
        $level++; 
        $this->table[$idx]=array("parent"=>false,"level"=>$level,"begin"=>$posbegin,"len"=>0,"content"=>""); 
        $idx++; 
        } 

        if ($beginend=="e") 
        { 
        $findidx=$this->findfirst($this->table,$level); 
        // correct bug for multi extract problem, thanks Daniel Sepeur 
        if ($findidx>=0) 
            { 
            $tmpbeg=$this->table[$findidx]["begin"]; 
            $len=$posbegin-$tmpbeg; 
            $this->table[$findidx]["len"]=$len; 
            $this->table[$findidx]["content"]=substr($html, $tmpbeg, $len) ; 
            $level--; 
            } 
        } 
    } 
	$this->tablecount=$idx; 

	if (is_array($this->table)) {
	foreach ($this->table as $k=>$tab) 
	  { 
	  if ($k>0) 
	     { 
	     $level=$tab["level"]; 
	     if ($level>$lastlevel) $this->table[$k-1]["parent"]=true; 
	     } 
	  $lastlevel=$tab["level"]; 
	  } 
	}
} 


function getcells($tabidx) 
{ 

  $curtable=$this->table[$tabidx]["content"]; 
  $stable=strtolower($curtable); 
  $this->cells=array(); // initialise array, add this line for repaired bug finded by Braukmann, Juergen thanks 
  // ---------- find all rows and cells ---------- 
  $rowbegin=strpos($stable, '<tr', 1); 
  $rowend=strpos($stable, '</tr>', 1);; 
  $rowlen=($rowend+5)-($rowbegin); 
  $rowidx=0; 
  While ($rowbegin>0) 
   { 
   $row=substr($curtable, $rowbegin, $rowlen) ; 
      // ----------------- find all cols ------------------ 
      $srow=strtolower($row); 
      $colbegin=strpos($srow, '<td', 1); 
      $colend=strpos($srow, '</td>', 1); 
      $collen=($colend+5)-($colbegin); 
      $colidx=0; 
      While ($colbegin>0) 
         { 
         $col=substr($row, $colbegin, $collen) ; 

         $span=1; 

         if ($this->colspan) 
            { 
            if (preg_match("|colspan\s?=[\s\'\"]+?(\d+)[\s\'\"]+?|s",$col,$match)) 
              { 
              $span=$match[1]; 
              print $span."\n"; 
              } 
            } 
         if ($span==0) $span=1;
		 //preg_match("/\<span class=\"jobTitle\"\>(.*)\<\/span\>/",$col,$href);		
		 preg_match('/\<span class="jobTitle"\>(.*)\<\/span\>/i', $col, $result);
         $col=trim(preg_replace("'<[\/\!]*?[^<>]*?>'si","",$col)); 
         $col=htmlentities($col,ENT_QUOTES,"UTF-8"); 
         $col = strtr($col, $this->trans); 
         $this->cells[$rowidx][$colidx]=$col; 
		 if (is_array($result) && isset($result[1])) {
		 	preg_match("/a href=\"(.*)\"/i",$result[1],$href);
		 	$this->cells[$rowidx]['url'] = 'http://jobs.siac.com'.$href[1];
		 }
		 
//         print "row = $rowidx, col = $colidx\n"; 
//         print "----------------------------\n"; 
//         print_r($this->cells); 
         $colbegin=strpos($srow, '<td', $colbegin+1); 
         $colend=strpos($srow, '</td>', $colbegin+1);; 
         $collen=($colend+5)-($colbegin); 
         $colidx+=$span; 
         } 
      // ----------------- find all cols ------------------ 
      $rowbegin=strpos($stable, '<tr', $rowbegin+1); 
      $rowend=strpos($stable, '</tr>', $rowbegin+1);; 
      $rowlen=($rowend+5)-($rowbegin); 
      $rowidx++; 
    } 
} 


} // class table2arr 
?>
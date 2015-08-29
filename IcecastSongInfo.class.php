<?
class IcecastSongInfo {

  private $error=false;
  private $info=array();

 function fetch($url,$viaProxy=false) {
     $ch = curl_init();
     if ($ch) {
        curl_setopt($ch,CURLOPT_URL,$url);

     	if ($viaProxy) 
		curl_setopt($ch, CURLOPT_PROXY, $viaProxy);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION,1);

        if (!$output = curl_exec($ch))
		$this->error=curl_error($ch);

        curl_close($ch);
      } else if (!$viaProxy) $output=file_get_contents($url);

   if (!$output) return false;

   $streams=explode('<br><br>',$output);
   array_pop($streams); //remove last item
   $this->info=$streams;
   return true;
  }

//////////////////// SELECT DATA FROM $info //////////////
 function select($search='',$param='',$mountPoint='') {
  $result=false;
  if (count($this->info)>0) {
   $result=array();
     foreach ($this->info as $i) {
      if (preg_match('#('.$mountPoint.'.*?'.$search.')#usi',$i)) {
       if ($param!=='' && preg_match('#'.$param.':.*?<td.*?>(.*?)</td>#usi',$i,$m)) {
         $i=$m[1];
         if ($i) array_push($result,$i);
       }
        
       if ($param==='') array_push($result,$i);
      }
     }
  }

   return $result;  
 }

 function error() {
   $e=$this->error;
   $this->error=false;
   return $e;
 }
}

?>
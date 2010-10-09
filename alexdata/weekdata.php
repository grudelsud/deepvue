<?php

require_once('../load.php');


$latm=0;
$lonm=0;

$elements = $dvdb->get_elements();

$count=0;
$messi=0;

$primo = true;

echo "var photos = new Array(200);";
echo "var numgiorno =new Array(200);";
echo "var hash=new Array(200);";
echo "var timestring=new Array(200);";
//echo "var captionstring=new Array(200);";
echo "var datestring=new Array(200);";

$first = $_GET["first"];

$old_event = -1;

$bestmetric = -2;

$giornate = 1;

$place="";

foreach ($elements as $element) 
{

	if ( !empty($element->filename) ) {
		$print_img = true;
		$hashname=$element->filename;
	} else {
		$print_img = false;
		$hashname="null";
	}

	$mettilo = $print_img;
	
	$diverso = 0;
	
	if ($element->id_event!=$old_event)
	{
		$diverso=1;
	}
			
	$tc=strtotime($element->created." GMT");
	$tc+=$element->timezone*3600;				  // per tagliare bene le giornate sia a firenze che a cali
	$tc-=3600;									  // una ora indietro per far tornare le cose alle 3.30 del mattino nel giorno prima e le cose alle 4.30 del mattino nel giorno stesso (dopo)

	
	$u_start = strtotime($element->time_start." GMT");
	$u_end = strtotime($element->time_end." GMT");
	
	$durata = $u_end-$u_start;
	
	$mtype=1;		//move
	if ( ($element->lat_start==$element->lat_end) && ($element->lon_start==$element->lon_end) )
	{
		$mtype=0;	//stay
	}
	
	
  if ( ($tc>=$first-86400*3) && ($tc<($first+86400*4)) && ( strcmp($element->user_login,"liquene") == 0 ) && ($messi < 100) && ($mettilo) && ($durata>1800) &&($mtype==0) )
  {	
	
	$old_event = $element->id_event;
	
	$utcode = strtotime($element->created." GMT");
	$utcode+=$element->timezone*3600;			
	$giorno = gmdate("M j", $utcode);
	
	$utcode = strtotime($element->created." GMT");
	$utcode+=$element->timezone*3600;			
	
	$ora = gmdate("g.ia", $utcode);

	if ( $diverso )
	{
		if ($primo)
		{
			$primo = false;
		}
		else
		{
			echo "datestring[".$messi.']="'.$bestgiorno.'";';
			echo "numgiorno[".$messi.']="'.$giornate.'";';
			echo "timestring[".$messi.']="'.$bestora." ".$place.'";';
			echo "hash[".$messi.']="'.$besthashname.'";   ';	
			$messi++;
			$bestmetric = -2;
			
		}
	}
	
			
	if ($element->metric > $bestmetric)
	{
		if ($tc>($first-86400*3+86400*$giornate))
		{
			$giornate++;
		}

		$bestgiorno = $giorno;
		$bestora = $ora;
		$besthashname = $hashname;
		$bestmetric = $element->metric;
		
		
		if ($lat > 27)	//florence
		{
			$latm=111131.745;
			$lonm=78846.80572069259;
		}
		else			//cali
		{
			$latm=110577.31;
			$lonm=111167.92;
		}
		
		
		$place = "";//alex_find_place( "liquene", $element->lat_start, $element->lon_start );
		$places = $dvdb->get_places();
		foreach ($places as $plac) 
		{
			$dlatm = ($element->lat_start - $plac->lat)*$latm;
			$dlonm = ($element->lon_start - $plac->lon)*$lonm;
			$distanza = round(sqrt($dlatm*$dlatm+$dlonm*$dlonm));
			if ( $distanza < 80 )
			{
				$place = $plac->text;
				break;
			}
		}
		
		if ($place == "")		//riprova con la posizione della foto stessa
		{
			$places = $dvdb->get_places();
			foreach ($places as $plac) 
			{
				$dlatm = ($element->lat - $plac->lat)*$latm;				
				$dlonm = ($element->lon - $plac->lon)*$lonm;
				$distanza = round(sqrt($dlatm*$dlatm+$dlonm*$dlonm));
				if ( $distanza < 80 )
				{
					$place = $plac->text;
					break;
				}
			}
		}
	}
	
  }
  $count++;
}




		echo "datestring[".$messi.']="'.$bestgiorno.'";';
		echo "numgiorno[".$messi.']="'.$giornate.'";';
		echo "timestring[".$messi.']="'.$bestora." ".$place.'";';
		echo "hash[".$messi.']="'.$besthashname.'";   ';	
		$messi++;
		

echo "var size = ".$messi.";";

?>

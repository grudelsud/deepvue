<?php

require_once('../load.php');

$elements = $dvdb->get_elements("", "", false);

$count=0;
$messi=0;

echo "var photos = new Array(200);";
echo "var mapfoto =new Array(200);";
echo "var hash=new Array(200);";
echo "var timestring=new Array(200);";
echo "var captionstring=new Array(200);";
echo "var datestring=new Array(200);";

$first = $_GET["first"];

$old_event = -1;

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
	
  if ( ($count>1000) && ($messi < 200) && ($mettilo) )
  {	
	
	$old_event = $element->id_event;
	
	$utcode = strtotime($element->created." GMT");
	//$utcode+=$element->timezone*3600;			
	$giorno = gmdate("F jS, Y", $utcode);
	
	$utcode = strtotime($element->created." GMT");
	
	$ora = gmdate("g.ia", $utcode);
	
	echo "datestring[".$messi.']="'.$giorno.'";';
	echo "timestring[".$messi.']="'.$ora.' GMT";';

	echo "mapfoto[".$messi.']="http://maps.google.com/maps?q='.$element->lat."+".$element->lon.'";   ';
	echo "hash[".$messi.']="'.$hashname.'";   ';
	
	echo "captionstring[".$messi.']="'.$element->caption.'";   ';
	
	$messi++;
  }
  $count++;
}

echo "var size = ".$messi.";";

?>

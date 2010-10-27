<?php

$latm=100000;
$lonm=100000;
$VICINO=100;

require_once('../load.php');

$elements = $dvdb->get_elements("", "", false);

$count=0;
$messi=0;

echo "var debugtime = new Array(100);";

echo "var cesura = new Array(100);";
echo "var photos = new Array(100);";
echo "var thumbtexts = new Array(100);";
echo "var mapcenter =new Array(100);";
echo "var mapstart =new Array(100);";
echo "var mapend =new Array(100);";
echo "var maptype =new Array(100);";
echo "var mapfoto =new Array(100);";
echo "var hash=new Array(100);";
echo "var datestring=new Array(100);";
echo "var timestring=new Array(100);";
echo "var thumbstring=new Array(100);";
echo "var whostring=new Array(100);";
echo "var captionstring=new Array(100);";
echo "var distancestring=new Array(100);";
echo "var periodstring=new Array(100);";
echo "var mapzoom=new Array(100);";
echo "var namedplace=new Array(100);";
echo "var idelement=new Array(100);";
echo "var ispublic=new Array(100);";

$owner = $_GET["owner"];

$username = $_GET["user"];
if ( $username == 0 )
{
	$username = "liquene";
}

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
	
	if ( ($element->is_new) && ($element->has_photos==0) && ($element->id_event!=$old_event) )
	{
		$mettilo = true;
	}	
	
	if ($element->id_event!=$old_event)
	{
		$diverso=1;
	}


	$tc=strtotime($element->created." GMT");
	$tc+=$element->timezone*3600;				  // per tagliare bene le giornate ovunque nel mondo
	$tc-=3600;									  // una ora indietro per far tornare le cose alle 3.30 del mattino nel giorno prima e le cose alle 4.30 del mattino nel giorno stesso (dopo)
	
	if ($owner==-1 && $element->is_public==0)
	{
		$mettilo=0;
	}
	
  if ( ($tc>=$first) && ($tc<($first+86400)) && ( strcmp($element->user_login,$username) == 0 ) && ($messi < 100) && ($mettilo) )
  {	
	
	$old_event = $element->id_event;
	
	echo "ispublic[".$messi."]=".$element->is_public.";   ";
	echo "idelement[".$messi."]=".$element->id_element.";   ";
	echo "cesura[".$messi."]=".$diverso.";   ";


	$avglat=($element->lat_start+$element->lat_end)/2.0;
	$avglon=($element->lon_start+$element->lon_end)/2.0;
	$mtype=1;		//move
	if ( ($element->lat_start==$element->lat_end) && ($element->lon_start==$element->lon_end) )
	{
		$mtype=0;	//stay
	}
	echo "maptype[".$messi."]=".$mtype.";   ";
	echo "mapcenter[".$messi."]=new google.maps.LatLng(".$avglat.",".$avglon.");   ";
	echo "mapstart[".$messi."]=new google.maps.LatLng(".$element->lat_start.",".$element->lon_start.");   ";
	echo "mapend[".$messi."]=new google.maps.LatLng(".$element->lat_end.",".$element->lon_end.");   ";
	
	$utcode = strtotime($element->created." GMT");
	$utcode+=$element->timezone*3600;	
	
	echo "debugtime[".$messi."]=".$utcode.";   ";
	
			
	$giorno = gmdate("F jS, Y", $utcode);
	
	echo "datestring[".$messi.']="'.$giorno.'";   ';  //"November 23rd, 2010"


	$utcode = strtotime($element->created." GMT");
	$utcode+=$element->timezone*3600;
	$ora = gmdate("g.ia", $utcode);
	$orat = gmdate("g.ia", $utcode);
	
	$utcode1 = strtotime($element->time_start." GMT");
	$utcode1+=$element->timezone*3600;
	$ora1 = gmdate("g.ia", $utcode1);
	//if (giorno1!=giorno)
	//{
		//scrivere day(s) before o after
	//}
	$utcode2 = strtotime($element->time_end." GMT");
	$utcode2+=$element->timezone*3600;
	$ora2 = gmdate("g.ia", $utcode2);
	
	
	$avgutcode=($utcode1+$utcode2)/2.0;
	$avgora=gmdate("g.ia", $avgutcode);
	
	//in alcuni casi voglio che $orat="";
	if ($diverso==0)
	{
		$orat="";
		$avgora="";
	}
	
	
	if ( $print_img )
	{
		echo "thumbstring[".$messi.']="'.$orat.'";';
	}
	else
	{
		echo "thumbstring[".$messi.']="'.$avgora.'";';
	}
	
	echo "timestring[".$messi.']="";';  //"10.27am - 10.31am"

	if ( $print_img )
	{
		echo "mapfoto[".$messi."]=new google.maps.LatLng(".$element->lat.",".$element->lon.");   ";
	}
	else
	{
		echo "mapfoto[".$messi."]=new google.maps.LatLng(666,666);   ";
	}	
	echo "hash[".$messi.']="'.$hashname.'";   ';
		
	$place = "";
	$places = $dvdb->get_places();
	foreach ($places as $plac) 
	{
		$dlatm = ($element->lat - $plac->lat)*$latm;
		$dlonm = ($element->lon - $plac->lon)*$lonm;
		$distanza = round(sqrt($dlatm*$dlatm+$dlonm*$dlonm));
		if ( $distanza < $VICINO )
		{
			$place = $plac->text;
			break;
		}
	}
	
	$place_start = "";
	$places = $dvdb->get_places();
	foreach ($places as $plac) 
	{
		$dlatm = ($element->lat_start - $plac->lat)*$latm;
		$dlonm = ($element->lon_start - $plac->lon)*$lonm;
		$distanza = round(sqrt($dlatm*$dlatm+$dlonm*$dlonm));
		if ( $distanza < $VICINO )
		{
			$place_start = $plac->text;
			break;
		}
	}
	
	$place_end = "";
	$places = $dvdb->get_places();
	foreach ($places as $plac) 
	{
		$dlatm = ($element->lat_end - $plac->lat)*$latm;
		$dlonm = ($element->lon_end - $plac->lon)*$lonm;
		$distanza = round(sqrt($dlatm*$dlatm+$dlonm*$dlonm));
		if ( $distanza < $VICINO )
		{
			$place_end = $plac->text;
			break;
		}
	}
	
	$utcode1 = strtotime($element->time_start." GMT");
	$utcode2 = strtotime($element->time_end." GMT");
	$circa = round(($utcode2-$utcode1)/60);
	$circa = round($circa/5);
	$circa*=5;
	if ($circa == 0) { $circa = 5; }
	
	$temp = "Alex ";
	
	if ( $print_img )
	{
		$temp = $temp.'at '.$ora.' ';
	}
	if ( $place != "")
	{	
		$temp = $temp.'at '.$place.' ';
	}
	if  ( ($circa>10) || ($print_img==false) )
	{
		$temp = $temp.'('."$ora1"." - "."$ora2".')';
	}
		
	echo "whostring[".$messi.']="'.$temp.'";   ';
	
	if ( strcmp($element->caption,"...")!=0 && $print_img )
	{
		echo "captionstring[".$messi.']="'.$element->caption.'";   ';			// {'.$element->timezone.'}
	}
	else
	{
		echo "captionstring[".$messi.']="";   ';			
	}
	
	$dlatm= abs($element->lat_start - $element->lat_end)*$latm;
	$dlonm= abs($element->lon_start - $element->lon_end)*$lonm;
	$distanza = round(sqrt($dlatm*$dlatm+$dlonm*$dlonm));
	       
	$distanza/=1000;	//chilometri
	$distanza/=1.609344;	//miglia
	$imiglia = round ($distanza);
		
	if ($imiglia == 0)
	{
		$hundredyards = $distanza*1760.0/100.0;
		$hundredyards=round($hundredyards);
		if ($hundredyards<=1) 
		{
			$distanza="a few yards";
			if ($mtype==0)
			{
				$distanza=" ";
			}
		}
		else
		{
			$distanza="around ".$hundredyards." hundred yards";
		}
	}
	if ($imiglia==1) 
	{
		$distanza="about a mile";
	}
	if ($imiglia>1)
	{
		$distanza = "about ".$imiglia." miles";
	}
	echo "distancestring[".$messi.']="'.$distanza.'";   ';  // "a few yards"
	
	
	
	$maxmetri = $dlatm;
	if ($dlonm > $maxmetri) $maxmetri=$dlonm;
	
	$zoomvalue = 17;
	if ($mtype==1)	//move
	{
		if ( $maxmetri > 200 )
		{
			$tempmaxmetri = $maxmetri;
			
			$curmetri = 200;
			while( $tempmaxmetri > $curmetri)
			{
				$curmetri *= 2;
				$zoomvalue--;
			}
		}
		else
		if ( $maxmetri > 100 )
		{
			$zoomvalue = 16;
		}
	}
	
	echo "mapzoom[".$messi.']='.$zoomvalue.';   ';
	
	$azione = "";
	
	if ( $mtype==0 )		//stay
	{
		
		if( $place_start != "" )
		{
		
			echo "namedplace[".$messi.']=1;   ';

			if ( strcmp($place_start,$place)==0 )		//intendo eguaglianza di testo, non di puntatore
			{
				$azione= $azione."staying there";
			}
			else
			{
				$azione= $azione."staying at ".$place_start;
			}
			$azione= $azione." for ";
		}
		else
		{
			
			echo "namedplace[".$messi.']=0;   ';
			
			$azione= $azione."staying there for ";
		}
	}
	else		//move
	{	
		
		if ( $place != "" )
		{	
			echo "namedplace[".$messi.']=1;   ';		
		}
		else
		{
			echo "namedplace[".$messi.']=0;   ';		
		}			
		
		if( $place_start != "")
		{
			if( $place_end != "")
			{
				if ( strcmp($place_start,$place_end)!=0 )	//intendo eguaglianza di stringhe, non di puntatori
				{
					if ( $place != "" )
					{	
					

						$azione= $azione."while ";
						if ( strcmp($place_start,$place)==0 )
						{
							$place_start = "there";
						}
						if ( strcmp($place_end,$place)==0 )
						{
							$place_end = "there";
						}
					}
					$azione= $azione."going from ".$place_start." to ".$place_end." in ";
				}
				else
				{
					//in realta' non e' contraddizione perche' potrei fare un lungo giro tornando al punto di partenza, quindi questo resta cosi' (non e' neanche una ripetizione, in effetti)
					if ( $place != "" )
					{
						$azione =$azione."while ";
					}					
					if ( strcmp($place_start,$place)==0 )
					{
						$azione =$azione."moving around there for ";
					}
					else
					{
						$azione =$azione."moving around in ".$place_start." area for ";
					}
				}
			}
			else
			{
				if ( $place != "" )
				{
					$azione =$azione."while ";
				}
				$azione =$azione."moving away from ".$place_start." for ";
			}
		}
		else if( $place_end != "")
		{
			if ( $place != "" )
			{
				$azione =$azione."while ";
				if ( strcmp($place_end,$place)==0 )
				{
					$place_end = "there";
				}
			}
			$azione =$azione."going to ".$place_end." for ";
		}
		else	//sconosciuta sia partenza che destinazione
		{
			if ( $place != "" )
			{
				$azione =$azione."while ";
			}		
			$azione =$azione."moving for ";
		}	
	}
	
			if ($circa <55)
			{
				$circa = $circa." minutes";
			}
			if ( ($circa>=55) && ($circa<=75) )
			{
				$circa = "an hour";
			}
			if ( ($circa>75) && ($circa<=105) )
			{
				$circa= "an hour and a half";
			}
			if ($circa>105)
			{
				$circa=round ($circa/60);
				$circa = $circa." hours";
			}
	
	echo "periodstring[".$messi.']= "'.$azione.'about '.$circa.'";   ';  //"staying there for about 5 minutes" "while going from teguise parking to castillo de santa barbara in about an hour"
	
	$messi++;
  }
  $count++;
}

echo "var size = ".$messi.";";

?>

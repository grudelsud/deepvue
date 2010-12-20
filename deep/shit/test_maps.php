<?php

$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=43.7961998,11.0510998&sensor=false";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$res_json = curl_exec($ch);
curl_close($ch);

if( FALSE != $res_json ) {
	$obj_loc = json_decode( $res_json );
	
	if( "OK" == $obj_loc->status ) {
		foreach( $obj_loc->results as $result ) {
			echo "address: ".$result->formatted_address."<br />";
		}
	}
}

<?php
require_once('load.php');

$now = date( "c" );
$msg = $now." -- ";
$success = false;
$has_photo = false;

if( !empty( $_POST['deepvue_upload'] ) ) {

	$user = $_POST["user"]; // => liquene
	$user_result = chk_credentials( "user_login", $user );

	if( !empty( $user_result ) ) {

		$id_user = $user_result->id_user;
		$user_login = $user_result->user_login;
		$msg .= "uid=".$id_user." -- ";
		
		/**
		 * ADJUST EVENT
		 */
		$table_el = $table_prefix."element";
		$table_ev = $table_prefix."event";

		$lat_start = $_POST["lat_start"]; // => 33.333
		$lon_start = $_POST["lon_start"]; // => 44.444
		$place_start = find_place( $id_user, $lat_start, $lon_start );

		$values_ev['id_place_start'] = $place_start;
		$values_ev['lat_start'] = $lat_start;
		$values_ev['lon_start'] = $lon_start;

		$lat_end = $_POST["lat_end"]; // => 55.555
		$lon_end = $_POST["lon_end"]; // => 66.666
		$place_end = find_place( $id_user, $lat_end, $lon_end );

		$values_ev['id_place_end'] = $place_end;
		$values_ev['lat_end'] = $lat_end;
		$values_ev['lon_end'] = $lon_end;
		
		$time_start = $_POST["time_start"]; // => 2010-08-08 13:13:13 +0200
		$time_end = $_POST["time_end"]; // => 2010-08-08 15:15:15 +0200
		$values_ev['time_start'] = $time_start;
		$values_ev['time_end'] = $time_end;
		
		list( $ev_time, $ev_timezone ) = explode( "GMT", $time_start );
		$values_ev['timezone'] = $ev_timezone;

		if ( 1 == $_POST["is_new"] ) {
			
			// TODO: check this, should it really close all previous running events?
			$dvdb->update( $table_ev, array( 'running' => 0 ), array( 'id_user' => $id_user ) );
			
			$values_ev['id_user'] = $id_user;
			$values_ev['running'] = 1;
			$values_ev['has_photos'] = 0;

			// missing text + description here
			
			$dvdb->insert( $table_ev, $values_ev );

			$id_event = $dvdb->insert_id;
			$values_elem['id_event'] = $id_event;
			$msg .= "nev_id=".$dvdb->insert_id." -- ";
		} else {
			// TODO: make it smarter! quite dull presently, takes the latest event published by id_user
			$sql = "SELECT * FROM ".$table_ev." WHERE id_user=".$id_user." ORDER BY id_event DESC";
			$result_ev = $dvdb->get_row( $sql );

			$id_event = $result_ev->id_event;
			$values_elem['id_event'] = $id_event;
			$dvdb->update( $table_ev, $values_ev, array( 'id_event' => $id_event) );
			$msg .= "uev_id=".$id_event." -- ";
		}
		
		// ok, we have a valid id_event, now proceed creating an element
		$values_elem['id_user'] = $id_user;
		
		$caption = $_POST["caption"];
		$notify = $_POST["notify"];

		/**
		 * SET MISC PARAMETERS
		 */
		$values_elem['is_new'] = $_POST["is_new"]; // => true
		// description + relevance missing here
		$values_elem['metric'] = $_POST["metric"]; // => 666.666
		// is_geo_precise + is_manual missing here
		$values_elem['is_public'] = $_POST["is_public"]; // => true
		// modified + device_version missing here
		$values_elem['app_version'] = $_POST["app_version"]; // => 0
		
		/**
		 * READ CAPTION
		 */
		if( !empty( $caption ) ) {
			$values_elem['caption'] = $caption; // => this is a caption, in this case image should be null.jpg
			$msg .= "cap -- ";
			$success = true;
		}

		/**
		 * SET TIME AND GEO
		 */
		$elem_time = $_POST["time"];
		list( $el_time, $el_timezone ) = explode( "GMT", $elem_time );
		$time_stamp = strtotime( $el_time );

		$values_elem['created'] = $elem_time; // => 2010-08-08 14:14:14 +0200
		$msg .= "t=".$elem_time." -- ";

		$lat = $_POST["lat"];
		$lon = $_POST["lon"];

		$values_elem['id_place'] = find_place( $id_user, $lat, $lon );
		$values_elem['lat'] = $lat; // => 11.111
		$values_elem['lon'] = $lon; // => 22.222
		
		/**
		 * UPLOAD FILE
		 */
		$fileField = FILEFIELD;
		$fileName = md5( "-".$id_user."-".$now."-" );
		if ( $file = move_uploaded( $fileField, true, $fileName ) ) {
			$path_info = pathinfo( $file );
			if ( IMG_NULL != $path_info['basename'] ) {
				$values_elem['ext'] = $path_info['extension'];
				image_resize( $file, THUMB_W, THUMB_H, false, THUMB_SUFFIX );
				$values_elem['filename'] = $fileName;
				$has_photo = true;
			}
			$msg .= "fup=".$path_info['basename']." -- ";
			$success = true;
		}
		
		if( $success ) {
			$dvdb->insert( $table_el, $values_elem );
			$msg .= "el_id=".$dvdb->insert_id." -- ";
			
			if( 1 == $notify ) {

				$oauth_token = $user_result->oauth_token;
				$oauth_token_secret = $user_result->oauth_secret;

				$twitterObj = new EpiTwitter(CONS_KEY, CONS_SECR, $oauth_token, $oauth_token_secret);
				$status = "#DVa ".$caption;

				if( $has_photo ) {
					$image_url = SERVER."/alpha/?time=".$time_stamp."&image=".$values_elem['filename']."&user=".$user_login;
					$status .= " ".$image_url;
				}
				
				$parameters['status']  = $status;
				$parameters['lat'] = $lat; // => 11.111
				$parameters['long'] = $lon; // => 22.222
				$parameters['display_coordinates'] = true;

				try {
					// update the status
					$update_status = $twitterObj->post_statusesUpdate( $parameters );
					// get the ID of the tweet just sent
					$tweet_id = $update_status->response['id'];
					$msg .= "status: ".$tweet_id." - ".$status." -- ";
				} catch( Exception $e ) {
					$msg .= "excep=".$e->getMessage()." -- ";					
				}
			} // endif notify

			if( $has_photo ) {
				$dvdb->update( $table_ev, array( 'has_photos' => 1 ), array( 'id_event' => $id_event ) );
			}
			
		} // endif success

	}
}

log_req( $msg, "upload_remote.log" );

if ( $success ) {
	header($_SERVER["SERVER_PROTOCOL"]." 200 OK");
} else {
	header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden");
}
?>

<?php

function log_req( $msg, $file_name = 'default.log' ) {
	if ( DEBUG ) {
		$handler = fopen( LOG_DIR."/".$file_name, "a+" );
		$msg .= "\n";
		fwrite( $handler, $msg ); 
		fclose( $handler );
	}
}

function logout() 
{
	unset( $_SESSION['oauth_token'] );
	unset( $_SESSION['oauth_token_secret'] );
	unset( $_SESSION['access_token'] );
	unset( $_SESSION['user_id'] );
	unset( $_SESSION['user_login'] );
	unset( $_SESSION['oauth_id'] );
}

// returns informations regarding directories, theme and related
function siteinfo( $value )
{
	global $dvfe;
	if( 'theme_dir' == $value ) {
		echo $dvfe->get_theme_directory();
	}
}
function move_uploaded( $fileField, $chkValidImage = true, $fileName = CONS_EMPTY, $dir = UPLOAD_DIR ) {
	if ($_FILES[$fileField]["error"] == UPLOAD_ERR_OK) {
		$tmp_name = $_FILES[$fileField]["tmp_name"];
		if( $chkValidImage ) {
			$size = @getimagesize( $tmp_name );
			if( $size ) {
				list($w, $h, $type) = $size;
			} else {
				return false;
			}
		}
		// received null.jpg
		if( IMG_NULL == $_FILES[$fileField]["name"] ) {
			return $dir."/".IMG_NULL;
		}
		if( $fileName == CONS_EMPTY ) {
			$name = $_FILES[$fileField]["name"];
		} else {
			if ( $chkValidImage ) {
				$name = $fileName.image_type_to_extension( $type );
			} else {
				$name = $fileName.image_type_to_extension( $_FILES[$fileField]["type"] );
			}
		}
		$full_path = $dir."/".$name;
		move_uploaded_file($tmp_name, $full_path);
		return $full_path;
	}
	return false;
}

function chk_credentials( $key ) {
	global $table_prefix, $dvdb;
	$table = $table_prefix."user";
	$field = "user_login";
	$result = $dvdb->get_row( "SELECT * FROM ".$table." WHERE ".$field."='". $key ."'" );
	if ( !empty( $result ) ) {
		return $result->id_user;
	} else {
		return CONS_EMPTY;
	}
}

function find_place( $id_user, $lat, $lon ) {
	// TODO: implement!
	return 0;
}

function dv_die( $message ) {
	if( DEBUG == true ) {
		die( $message );
	} else {
		die();
	}
}

/**
 * Load an image from a string, if PHP supports it.
 *
 * @param string $file Filename of the image to load.
 * @return resource The resulting image resource on success, Error string on failure.
 */
function dv_load_image( $file ) {
	if ( is_numeric( $file ) )
		$file = get_attached_file( $file );

	if ( ! file_exists( $file ) )
		return sprintf(__('File &#8220;%s&#8221; doesn&#8217;t exist?'), $file);

	if ( ! function_exists('imagecreatefromstring') )
		return __('The GD image library is not installed.');

	// Set artificially high because GD uses uncompressed images in memory
	@ini_set('memory_limit', '256M');
	$image = imagecreatefromstring( file_get_contents( $file ) );

	if ( !is_resource( $image ) )
		return sprintf(__('File &#8220;%s&#8221; is not an image.'), $file);

	return $image;
}

/**
 * Create new GD image resource with transparency support
 *
 * @param $width
 * @param $height
 * @return image resource
 */
function dv_imagecreatetruecolor($width, $height) {
	$img = imagecreatetruecolor($width, $height);
	if ( is_resource($img) && function_exists('imagealphablending') && function_exists('imagesavealpha') ) {
		imagealphablending($img, false);
		imagesavealpha($img, true);
	}
	return $img;
}

/**
 * Calculates the new dimentions for a downsampled image.
 *
 * If either width or height are empty, no constraint is applied on
 * that dimension.
 *
 * @param int $current_width Current width of the image.
 * @param int $current_height Current height of the image.
 * @param int $max_width Optional. Maximum wanted width.
 * @param int $max_height Optional. Maximum wanted height.
 * @return array First item is the width, the second item is the height.
 */
function dv_constrain_dimensions( $current_width, $current_height, $max_width=0, $max_height=0 ) {
	if ( !$max_width and !$max_height )
		return array( $current_width, $current_height );

	$width_ratio = $height_ratio = 1.0;
	$did_width = $did_height = false;

	if ( $max_width > 0 && $current_width > 0 && $current_width > $max_width ) {
		$width_ratio = $max_width / $current_width;
		$did_width = true;
	}

	if ( $max_height > 0 && $current_height > 0 && $current_height > $max_height ) {
		$height_ratio = $max_height / $current_height;
		$did_height = true;
	}

	// Calculate the larger/smaller ratios
	$smaller_ratio = min( $width_ratio, $height_ratio );
	$larger_ratio  = max( $width_ratio, $height_ratio );

	if ( intval( $current_width * $larger_ratio ) > $max_width || intval( $current_height * $larger_ratio ) > $max_height )
 		// The larger ratio is too big. It would result in an overflow.
		$ratio = $smaller_ratio;
	else
		// The larger ratio fits, and is likely to be a more "snug" fit.
		$ratio = $larger_ratio;

	$w = intval( $current_width  * $ratio );
	$h = intval( $current_height * $ratio );

	// Sometimes, due to rounding, we'll end up with a result like this: 465x700 in a 177x177 box is 117x176... a pixel short
	// We also have issues with recursive calls resulting in an ever-changing result. Contraining to the result of a constraint should yield the original result.
	// Thus we look for dimensions that are one pixel shy of the max value and bump them up
	if ( $did_width && $w == $max_width - 1 )
		$w = $max_width; // Round it up
	if ( $did_height && $h == $max_height - 1 )
		$h = $max_height; // Round it up

	return array( $w, $h );
}

/**
 * Retrieve calculated resized dimensions for use in imagecopyresampled().
 *
 * Calculate dimensions and coordinates for a resized image that fits within a
 * specified width and height. If $crop is true, the largest matching central
 * portion of the image will be cropped out and resized to the required size.
 *
 * @param int $orig_w Original width.
 * @param int $orig_h Original height.
 * @param int $dest_w New width.
 * @param int $dest_h New height.
 * @param bool $crop Optional, default is false. Whether to crop image or resize.
 * @return bool|array False, on failure. Returned array matches parameters for imagecopyresampled() PHP function.
 */
function image_resize_dimensions($orig_w, $orig_h, $dest_w, $dest_h, $crop = false) {

	if ($orig_w <= 0 || $orig_h <= 0)
		return false;
	// at least one of dest_w or dest_h must be specific
	if ($dest_w <= 0 && $dest_h <= 0)
		return false;

	if ( $crop ) {
		// crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
		$aspect_ratio = $orig_w / $orig_h;
		$new_w = min($dest_w, $orig_w);
		$new_h = min($dest_h, $orig_h);

		if ( !$new_w ) {
			$new_w = intval($new_h * $aspect_ratio);
		}

		if ( !$new_h ) {
			$new_h = intval($new_w / $aspect_ratio);
		}

		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );
	} else {
		// don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
		$crop_w = $orig_w;
		$crop_h = $orig_h;

		$s_x = 0;
		$s_y = 0;

		list( $new_w, $new_h ) = dv_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );
	}

	// if the resulting image would be the same size or larger we don't want to resize it
	if ( $new_w >= $orig_w && $new_h >= $orig_h )
		return false;

	// the return array matches the parameters to imagecopyresampled()
	// int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
	return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );

}

/**
 * Scale down an image to fit a particular size and save a new copy of the image.
 *
 * The PNG transparency will be preserved using the function, as well as the
 * image type. If the file going in is PNG, then the resized image is going to
 * be PNG. The only supported image types are PNG, GIF, and JPEG.
 *
 * Some functionality requires API to exist, so some PHP version may lose out
 * support. This is not the fault of WordPress (where functionality is
 * downgraded, not actual defects), but of your PHP version.
 *
 * @param string $file Image file path.
 * @param int $max_w Maximum width to resize to.
 * @param int $max_h Maximum height to resize to.
 * @param bool $crop Optional. Whether to crop image or resize.
 * @param string $suffix Optional. File Suffix.
 * @param string $dest_path Optional. New image file path.
 * @param int $jpeg_quality Optional, default is 90. Image quality percentage.
 * @return mixed WP_Error on failure. String with new destination path.
 */
function image_resize( $file, $max_w, $max_h, $crop = false, $suffix = null, $dest_path = null, $jpeg_quality = 90 ) {

	$image = dv_load_image( $file );
	if ( !is_resource( $image ) ) {
		// return some error
	}

	$size = @getimagesize( $file );
	if ( !$size ) {
		// return some error
	}

	list($orig_w, $orig_h, $orig_type) = $size;

	$dims = image_resize_dimensions($orig_w, $orig_h, $max_w, $max_h, $crop);
	if ( !$dims ) {
		// return some error
	}

	list($dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) = $dims;

	$newimage = dv_imagecreatetruecolor( $dst_w, $dst_h );

	imagecopyresampled( $newimage, $image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

	// convert from full colors to index colors, like original PNG.
	if ( IMAGETYPE_PNG == $orig_type && function_exists('imageistruecolor') && !imageistruecolor( $image ) ) {
		imagetruecolortopalette( $newimage, false, imagecolorstotal( $image ) );
	}
	// we don't need the original in memory anymore
	imagedestroy( $image );

	// $suffix will be appended to the destination filename, just before the extension
	if ( !$suffix )
		$suffix = "{$dst_w}x{$dst_h}";

	$info = pathinfo($file);
	$dir = $info['dirname'];
	$ext = $info['extension'];
	$name = basename($file, ".{$ext}");
	if ( !is_null($dest_path) and $_dest_path = realpath($dest_path) ) {
		$dir = $_dest_path;
	}
	$destfilename = "{$dir}/{$name}-{$suffix}.{$ext}";

	if ( IMAGETYPE_GIF == $orig_type ) {
		if ( !imagegif( $newimage, $destfilename ) ) {
			// return resize path invalid error
		}
	} elseif ( IMAGETYPE_PNG == $orig_type ) {
		if ( !imagepng( $newimage, $destfilename ) ) {
			// return resize path invalid error
		}
	} else {
		// all other formats are converted to jpg
		$destfilename = "{$dir}/{$name}-{$suffix}.jpeg";
		if ( !imagejpeg( $newimage, $destfilename, $jpeg_quality ) ) {
			// return resize path invalid error
		}
	}

	imagedestroy( $newimage );

	// Set correct file permissions
	$stat = stat( dirname( $destfilename ));
	$perms = $stat['mode'] & 0000666; //same permissions as parent folder, strip off the executable bits
	@ chmod( $destfilename, $perms );

	return $destfilename;
}

?>
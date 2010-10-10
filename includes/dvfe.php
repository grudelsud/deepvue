<?php

class DVFE {
	
	var $dvdb;
	var $last_images;
	var $data;
	var $theme;
	var $absdomain;

	public function DVFE( &$dvdb ) 
	{	
		return $this->__construct( $dvdb );
	}

	public function __construct( &$dvdb )
	{
		$this->dvdb = $dvdb;
	}

	public function set_absdomain( $url )
	{
		$this->absdomain = $url;
	}

	public function set_theme( $folder )
	{
		$this->theme = $folder;
	}

	public function get_theme_directory()
	{
		return $this->absdomain.$this->theme;
	}
	
	public function get_header()
	{
		include( $this->theme . '/header.php' );
	}

	public function get_login()
	{
		include( $this->theme . '/login.php' );
	}

	public function get_reg()
	{
		include( $this->theme . '/registration.php' );
	}
	
	public function get_main()
	{
		include( $this->theme . '/index.php' );
	}

	public function get_navigation()
	{
		include( $this->theme . '/navigation.php' );
	}

	public function get_footer()
	{
		include( $this->theme . '/footer.php' );
	}
	
	public function get_data( $user_login = "", $year = 2010, $month = 9, $format = JSON )
	{
		$this->data = array();

		// TODO: add temporal boundaries
		$this->get_images( $user_login );
		$this->data['images'] = $this->last_images;
		$this->data['image_count'] = count( $this->last_images );
		$this->data['user_login'] = $user_login;
		$this->data['year'] = $year;
		$this->data['month'] = $month;
		if( $format == JSON ) {
			return json_encode( $this->data );
		} else {
			return $this->data;
		}
	}
	/**
	 * Retrieve a list of images
	 */
	public function get_images( $id_element = "", $user_login = "", $public_only = true, $format = JSON ) 
	{
		// TODO: add temporal boundaries
		$elements = $this->dvdb->get_elements( $id_element, $user_login, $public_only );
		$this->last_images = array();

		$index = 0;
		foreach ($elements as $element) {
			if ( !empty($element->filename) ) {
				$img_src = ABSDOMAIN.UPLOAD_FOLDER."/".$element->filename.".".$element->ext;
				$img_thumb_src = ABSDOMAIN.UPLOAD_FOLDER."/".$element->filename."-".THUMB_SUFFIX.".".$element->ext;
				
				$this->last_images[$index]['id_element'] = $element->id_element;
				$this->last_images[$index]['name'] = $img_src;
				$this->last_images[$index]['thumb'] = $img_thumb_src;
				$index++;
			}
		}
		if( $format == JSON ) {
			return json_encode( $this->last_images );
		} else {
			return $this->last_images;
		}
	}
	
	public function get_size() 
	{
		if( !empty( $this->last_images ) ) {
			return count( $this->last_images );
		} else {
			return 0;
		}
	}
}

?>
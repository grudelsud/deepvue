<?php

define( 'OBJECT', 'OBJECT', true );
define( 'OBJECT_K', 'OBJECT_K' );
define( 'ARRAY_A', 'ARRAY_A' );
define( 'ARRAY_N', 'ARRAY_N' );

class DVDB {

	var $dbuser;
	var $dbh;
	var $base_prefix;
	var $last_query;
	var $num_queries = 0;
	var $result;
	var $rows_affected;
	var $insert_id;
	var $col_info;
	var $last_result;
	var $num_rows;

	function DV( $dbuser, $dbpassword, $dbname, $dbhost ) {
		return $this->__construct( $dbuser, $dbpassword, $dbname, $dbhost );
	}
	
	function __construct( $dbuser, $dbpassword, $dbname, $dbhost ) {
		register_shutdown_function( array( &$this, '__destruct' ) );

		$this->dbuser = $dbuser;

		$this->dbh = @mysql_connect( $dbhost, $dbuser, $dbpassword, true );
		if ( !$this->dbh ) {
			$this->bail( "<h1>Error establishing a database connection</h1>" );
			return;
		}

		$this->select( $dbname, $this->dbh );
	}

	function __destruct() {
		return true;
	}

	/**
	 * set public state for a specific element
	 * 
	 * @param unknown_type $id_element
	 * @param unknown_type $is_public
	 */
	public function set_public( $id_element = "", $is_public = 1, $id_user = -1, $check_user = false ) {
		global $table_prefix;
		
		$tbl_element = $table_prefix."element";
		$result = $this->query( "SELECT * FROM ".$tbl_element." WHERE id_element=".$id_element );
		if( $this->num_rows > 0 ) {
			$update = false;
			if( true == $check_user && $id_user == $result->id_user ) {
				$update = true;
			} else if( false == $check_user ) {
				$update = true;
			}
			if( $update ) {
				$this->update( $tbl_element, array( 'is_public' => $is_public ), array( 'id_element' => $id_element ) );
			}
		}
	}

	/**
	 * Retrieve list of comments
	 *
	 * @param string $id_element
	 * @return array of comments objects with properties:
	 */
	public function get_comments( $id_element = "", $format = OBJECT ) {
		global $table_prefix;
		
		$tbl_comment = $table_prefix."comment";
		$tbl_user = $table_prefix."user";
		
		$sql  = "SELECT ".$tbl_comment.".id_comment as id_comment, ".$tbl_comment.".id_element as id_element, ";
		$sql .= $tbl_comment.".id_user as id_user, ".$tbl_user.".user_login as user_login, ";
		$sql .= $tbl_comment.".user_email as user_email, ".$tbl_comment.".comment_status as comment_status, ";
		$sql .= $tbl_comment.".comment_content as comment_content, ".$tbl_comment.".created as created ";

		$sql .= "FROM ".$tbl_comment.", ".$tbl_user." ";
		$sql .= "WHERE ".$tbl_comment.".id_user = ".$tbl_user.".id_user ";
		$sql .= "AND ".$tbl_comment.".id_element=".$id_element." ";
		
		$sql .= "ORDER BY ".$tbl_comment.".id_comment ASC;";
		
		$this->query( $sql );
		if( $this->num_rows > 0 ) {
			if( $format == OBJECT ) {
				return $this->last_result;
			} else {
				return json_encode( $this->last_result );
			}
		} else {
			$obj = new stdClass();

			if( $format == OBJECT ) {
				return $obj;
			} else {
				return json_encode( $obj );
			}
		}
	}
	
	/**
	 * Add comment to list
	 * 
	 * @param unknown_type $id_element
	 * @param unknown_type $id_user
	 * @param unknown_type $comment_status
	 * @param unknown_type $comment_content
	 */
	public function add_comment( $id_element, $id_user, $comment_status, $comment_content ) {
		global $table_prefix;
		$tbl_comment = $table_prefix."comment";
		$tbl_element = $table_prefix."element";
		$tbl_user = $table_prefix."user";

		$now = date( "c" );
		$msg = $now." -- add comment -- ";

		$element = $this->get_row( "SELECT * FROM ".$tbl_element." WHERE id_element = ".$id_element );

		if( 1 == $element->is_public ) {
			
			$id_user_to = $element->id_user;
			$user_to = $this->get_row( "SELECT * FROM ".$tbl_user." WHERE id_user = ".$id_user_to );
	
			$time = 3600 * $element->timezone + strtotime( $element->created. " GMT" );
			$image_url = SERVER."/?time=".$time."&image=".$element->filename."&story=".$user_to->user_login;
			$image_url = get_short_link( $image_url );
				
			// fetch recipient and send notification email
			if( $id_user_to != $id_user ) {
				
				$msg .= "from: ".$id_user." to: ".$id_user_to." -- ";
				
				$message  = "\n".stripslashes( $comment_content )."\n";
				$message .= "\n".$image_url."\n\n";

				send_email( $user_to->user_email, "Someone commented on your Story!", $message );
			}
			// now post a tweet if no previous comments are present
//			$comment = $this->get_row( "SELECT * FROM ".$tbl_comment." WHERE id_element = ".$id_element );

//			if( 0 == $this->num_rows ) {
				$user_from = $this->get_row( "SELECT * FROM ".$tbl_user." WHERE id_user = ".$id_user );
				$oauth_token = $user_from->oauth_token;
				$oauth_token_secret = $user_from->oauth_secret;

				$twitterObj = new EpiTwitter(CONS_KEY, CONS_SECR, $oauth_token, $oauth_token_secret);

				$sign = "@".$user_to->user_login." ".$image_url;
				$status = "";
				$tokens = explode( " ", stripslashes($comment_content) );
				$broken = false;
				foreach( $tokens as $token ) {
					if( 140 > strlen( $token ) + strlen( $status ) + strlen( $sign ) + 4 ) {
						$status .= $token." ";
					} else {
						$broken = true;
						break;
					}
				}
				if( $broken ) {
					$status .= "...";
				}
				$status .= $sign;
				$parameters['status']  = $status;
				try {
					// update the status
					$update_status = $twitterObj->post_statusesUpdate( $parameters );
					$msg .= "status: ".$update_status->responseText;
				} catch( Exception $e ) {
					$msg .= "excep=".$e->getMessage()." -- ";
				}
//			}
			
			// and finally update the comments table
			$comment_values["id_element"] = $id_element;
			$comment_values["id_user"] = $id_user; 
			$comment_values["comment_status"] = $comment_status;
			$comment_values["comment_content"] = $comment_content; 
			$comment_values["created"] = date( "c" );

			$this->insert( $tbl_comment, $comment_values );
		}
		log_req( $msg, "comment.log" );
	}

	/**
	 * Retrieve list of elements
	 *
	 * @param string $user_login
	 * @return array of element objects with properties: id_element, lat, lon, notify, is_public, metric, created, filename, ext, caption, user_login, id_event, (*)_start, (*)_end. with (*) = [lat, lon, time]
	 */
	public function get_elements( $id_element = "", $user_login = "", $public_only = true, $limit = "", $since = "", $until = "" ) {
		global $table_prefix;
		
		$tbl_elem = $table_prefix."element";
		$tbl_user = $table_prefix."user";
		$tbl_event = $table_prefix."event";

		$sql  = "SELECT ".$tbl_elem.".id_element as id_element, ".$tbl_elem.".id_event as id_event, ".$tbl_elem.".lat as lat, ".$tbl_elem.".lon as lon, ".$tbl_elem.".is_new as is_new, ".$tbl_elem.".is_public as is_public, ";
		$sql .= $tbl_elem.".metric as metric, ".$tbl_elem.".created as created, ".$tbl_elem.".timezone as tz_elem, ".$tbl_elem.".filename as filename, ".$tbl_elem.".ext as ext, ".$tbl_elem.".caption as caption, ";
		$sql .= $tbl_user.".user_login as user_login, ".$tbl_user.".user_name as user_name, ";
		$sql .= $tbl_event.".lat_start as lat_start, ".$tbl_event.".lon_start as lon_start, ".$tbl_event.".time_start as time_start, ";
		$sql .= $tbl_event.".lat_end as lat_end, ".$tbl_event.".lon_end as lon_end, ".$tbl_event.".time_end as time_end, ";
		$sql .= $tbl_event.".timezone as timezone, ".$tbl_event.".has_photos as has_photos ";
		$sql .= "FROM ".$tbl_elem.", ".$tbl_event.", ".$tbl_user." ";
		$sql .= "WHERE ".$tbl_elem.".id_user = ".$tbl_user.".id_user AND ".$tbl_elem.".id_event = ".$tbl_event.".id_event ";
		
		if( !empty( $id_element ) ) {
			$sql .= "AND ".$tbl_elem.".id_element=".$id_element." ";
		}
		if ( !empty( $user_login ) ) {
			$sql .= "AND ".$tbl_user.".user_login = '".$user_login."' ";
		}
		if( $public_only == true ) {
			$sql .= "AND ".$tbl_elem.".is_public=1 ";
		}
		
		if( !empty( $since ) ) {
			$sql .= "AND ".$tbl_elem.".created > '". date("Y-m-d G:i:s", $since)."' ";
		}

		if( !empty( $until ) ) {
			$sql .= "AND ".$tbl_elem.".created < '". date("Y-m-d G:i:s", $until)."' ";
		}
		
		$sql .= "ORDER BY created ASC ";
		
		if( !empty( $limit ) ) {
			$sql .= "LIMIT ".$limit;
		}

		$this->query( $sql );
		if( $this->num_rows > 0 ) {
			return $this->last_result;
		} else {
			return new stdClass();
		}
	}

	/**
	 * Retrieve list of users
	 *
	 */
	public function get_users( $id_user = "" ) {
		global $table_prefix;

		$tbl_user = $table_prefix."user";

		$sql  = "SELECT * FROM ".$tbl_user;
		
		if( !empty( $id_user ) ) {
			$sql .= " WHERE id_user=".$id_user;
		}

		$sql .= " ORDER BY id_user DESC;";
		$this->query( $sql );
		if( $this->num_rows > 0 ) {
			return $this->last_result;
		} else {
			return new stdClass();
		}
	}

	public function del_place( $lat, $lon ) {
		global $table_prefix;
		$tbl_place = $table_prefix."place";

		$sql = "SELECT * FROM ".$tbl_place.";";
		$res = $this->query( $sql );
		$places = $this->last_result;
			
		foreach( $places as $place ) {
			$delta = abs( $lat - $place->lat ) + abs( $lon - $place->lon );
			if( $delta < 0.001 ) {
				$delplace[] = $place->id_place;
			}
		}
		$rows = 0;
		foreach( $delplace as $id ) {
			$sql = "DELETE FROM ".$tbl_place." WHERE id_place=".$id.";";
			$rows += $this->query( $sql );
		}
		return $rows;
	}

	/**
	 * Retrieve list of places
	 *
	 * @param string $user_login
	 * @return array of element objects with properties: id_place, id_user, user_login, lat, lon, text
	 */
	public function get_places( $user_login = "" ) {
		global $table_prefix;
		
		$tbl_place = $table_prefix."place";
		$tbl_user = $table_prefix."user";

		$sql  = "SELECT ".$tbl_place.".id_place as id_place, ".$tbl_place.".id_user as id_user, ".$tbl_place.".lat as lat, ".$tbl_place.".lon as lon, ".$tbl_place.".text as text, ";
		$sql .= $tbl_user.".user_login as user_login ";
		$sql .= "FROM ".$tbl_place.", ".$tbl_user." ";
		$sql .= "WHERE ".$tbl_place.".id_user = ".$tbl_user.".id_user ";
		
		if ( !empty( $user_login ) ) {
			$sql .= "AND ".$tbl_user.".user_login = '".$user_login."' ";
		}

		$sql .= "ORDER BY ".$tbl_place.".id_user, ".$tbl_place.".text ASC";
		
		$this->query( $sql );
		if( $this->num_rows > 0 ) {
			return $this->last_result;
		} else {
			return new stdClass();
		}
	}

	/**
	 * Selects a database using the current database connection.
	 *
	 * The database name will be changed based on the current database
	 * connection. On failure, the execution will bail and display an DB error.
	 *
	 * @param string $db MySQL database name
	 * @param resource $dbh Optional link identifier.
	 * @return null Always null.
	 */
	function select( $db, $dbh = null) {
		if ( is_null($dbh) ) 
			$dbh = $this->dbh;

		if ( !@mysql_select_db( $db, $dbh ) ) {
			$this->bail( "<h1>Can&#8217;t select database</h1>" );
			return;
		}
	}

	function escape( $string ) {
		if ( $this->dbh )
			return mysql_real_escape_string( $string, $this->dbh );
		else
			return addslashes( $string );
	}

	/**
	 * Real escape, using mysql_real_escape_string() or addslashes()
	 *
	 * @see mysql_real_escape_string()
	 * @see addslashes()
	 * @access private
	 *
	 * @param  string $string to escape
	 * @return string escaped
	 */
	function _real_escape( $string ) {
		if ( $this->dbh )
			return mysql_real_escape_string( $string, $this->dbh );
		else
			return addslashes( $string );
	}

	/**
	 * Escapes content by reference for insertion into the database, for security
	 *
	 * @uses wpdb::_real_escape()
	 * @param string $string to escape
	 * @return void
	 */
	function escape_by_ref( &$string ) {
		$string = $this->_real_escape( $string );
	}


	/**
	 * Prepares a SQL query for safe execution. Uses sprintf()-like syntax.
	 *
	 * The following directives can be used in the query format string:
	 *   %d (decimal number)
	 *   %s (string)
	 *   %% (literal percentage sign - no argument needed)
	 *
	 * Both %d and %s are to be left unquoted in the query string and they need an argument passed for them.
	 * Literals (%) as parts of the query must be properly written as %%.
	 *
	 * This function only supports a small subset of the sprintf syntax; it only supports %d (decimal number), %s (string).
	 * Does not support sign, padding, alignment, width or precision specifiers.
	 * Does not support argument numbering/swapping.
	 *
	 * May be called like {@link http://php.net/sprintf sprintf()} or like {@link http://php.net/vsprintf vsprintf()}.
	 *
	 * Both %d and %s should be left unquoted in the query string.
	 *
	 * <code>
	 * wpdb::prepare( "SELECT * FROM `table` WHERE `column` = %s AND `field` = %d", 'foo', 1337 )
	 * wpdb::prepare( "SELECT DATE_FORMAT(`field`, '%%c') FROM `table` WHERE `column` = %s", 'foo' );
	 * </code>
	 *
	 * @link http://php.net/sprintf Description of syntax.
	 *
	 * @param string $query Query statement with sprintf()-like placeholders
	 * @param array|mixed $args The array of variables to substitute into the query's placeholders if being called like
	 * 	{@link http://php.net/vsprintf vsprintf()}, or the first variable to substitute into the query's placeholders if
	 * 	being called like {@link http://php.net/sprintf sprintf()}.
	 * @param mixed $args,... further variables to substitute into the query's placeholders if being called like
	 * 	{@link http://php.net/sprintf sprintf()}.
	 * @return null|false|string Sanitized query string, null if there is no query, false if there is an error and string
	 * 	if there was something to prepare
	 */
	function prepare( $query = null ) { // ( $query, *$args )
		if ( is_null( $query ) )
			return;

		$args = func_get_args();
		array_shift( $args );
		// If args were passed as an array (as in vsprintf), move them up
		if ( isset( $args[0] ) && is_array($args[0]) )
			$args = $args[0];
		$query = str_replace( "'%s'", '%s', $query ); // in case someone mistakenly already singlequoted it
		$query = str_replace( '"%s"', '%s', $query ); // doublequote unquoting
		$query = preg_replace( '|(?<!%)%s|', "'%s'", $query ); // quote the strings, avoiding escaped strings like %%s
		array_walk( $args, array( &$this, 'escape_by_ref' ) );
		return @vsprintf( $query, $args );
	}

	/**
	 * Perform a MySQL database query, using current database connection.
	 *
	 * More information can be found on the codex page.
	 *
	 * @param string $query Database query
	 * @return int|false Number of rows affected/selected or false on error
	 */
	function query( $query ) {
		// Keep track of the last query for debug..
		$this->last_query = $query;
		$dbh = &$this->dbh;
		$this->result = @mysql_query( $query, $dbh );
		$this->num_queries++;

		if ( preg_match( "/^\\s*(insert|delete|update|replace|alter) /i", $query ) ) {
			$this->rows_affected = mysql_affected_rows( $dbh );
			// Take note of the insert_id
			if ( preg_match( "/^\\s*(insert|replace) /i", $query ) ) {
				$this->insert_id = mysql_insert_id($dbh);
			}
			// Return number of rows affected
			$return_val = $this->rows_affected;
		} else {
			$i = 0;
			while ( $i < @mysql_num_fields( $this->result ) ) {
				$this->col_info[$i] = @mysql_fetch_field( $this->result );
				$i++;
			}
			$num_rows = 0;
			while ( $row = @mysql_fetch_object( $this->result ) ) {
				$this->last_result[$num_rows] = $row;
				$num_rows++;
			}

			@mysql_free_result( $this->result );

			// Log number of rows the query returned
			// and return number of rows selected
			$this->num_rows = $num_rows;
			$return_val     = $num_rows;
		}

		return $return_val;
	}

	/**
	 * Insert a row into a table.
	 *
	 * <code>
	 * wpdb::insert( 'table', array( 'column' => 'foo', 'field' => 'bar' ) )
	 * wpdb::insert( 'table', array( 'column' => 'foo', 'field' => 1337 ), array( '%s', '%d' ) )
	 * </code>
	 *
	 * @param string $table table name
	 * @param array $data Data to insert (in column => value pairs). Both $data columns and $data values should be "raw" (neither should be SQL escaped).
	 * @param array|string $format Optional. An array of formats to be mapped to each of the value in $data. If string, that format will be used for all of the values in $data.
	 * 	A format is one of '%d', '%s' (decimal number, string). If omitted, all values in $data will be treated as strings unless otherwise specified in wpdb::$field_types.
	 * @return int|false The number of rows inserted, or false on error.
	 */
	function insert( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'INSERT' );
	}

	/**
	 * Replace a row into a table.
	 *
	 * <code>
	 * wpdb::replace( 'table', array( 'column' => 'foo', 'field' => 'bar' ) )
	 * wpdb::replace( 'table', array( 'column' => 'foo', 'field' => 1337 ), array( '%s', '%d' ) )
	 * </code>
	 *
	 * @param string $table table name
	 * @param array $data Data to insert (in column => value pairs). Both $data columns and $data values should be "raw" (neither should be SQL escaped).
	 * @param array|string $format Optional. An array of formats to be mapped to each of the value in $data. If string, that format will be used for all of the values in $data.
	 * 	A format is one of '%d', '%s' (decimal number, string). If omitted, all values in $data will be treated as strings unless otherwise specified in wpdb::$field_types.
	 * @return int|false The number of rows affected, or false on error.
	 */
	function replace( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'REPLACE' );
	}

	/**
	 * Helper function for insert and replace.
	 *
	 * Runs an insert or replace query based on $type argument.
	 *
	 * @param string $table table name
	 * @param array $data Data to insert (in column => value pairs).  Both $data columns and $data values should be "raw" (neither should be SQL escaped).
	 * @param array|string $format Optional. An array of formats to be mapped to each of the value in $data. If string, that format will be used for all of the values in $data.
	 * 	A format is one of '%d', '%s' (decimal number, string). If omitted, all values in $data will be treated as strings unless otherwise specified in wpdb::$field_types.
	 * @return int|false The number of rows affected, or false on error.
	 */
	function _insert_replace_helper( $table, $data, $format = null, $type = 'INSERT' ) {
		if ( ! in_array( strtoupper( $type ), array( 'REPLACE', 'INSERT' ) ) )
			return false;
		$formats = $format = (array) $format;
		$fields = array_keys( $data );
		$formatted_fields = array();
		foreach ( $fields as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$formatted_fields[] = $form;
		}
		$sql = "{$type} INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES ('" . implode( "','", $formatted_fields ) . "')";
		return $this->query( $this->prepare( $sql, $data ) );
	}

	/**
	 * Update a row in the table
	 *
	 * <code>
	 * wpdb::update( 'table', array( 'column' => 'foo', 'field' => 'bar' ), array( 'ID' => 1 ) )
	 * wpdb::update( 'table', array( 'column' => 'foo', 'field' => 1337 ), array( 'ID' => 1 ), array( '%s', '%d' ), array( '%d' ) )
	 * </code>
	 *
	 * @param string $table table name
	 * @param array $data Data to update (in column => value pairs). Both $data columns and $data values should be "raw" (neither should be SQL escaped).
	 * @param array $where A named array of WHERE clauses (in column => value pairs). Multiple clauses will be joined with ANDs. Both $where columns and $where values should be "raw".
	 * @param array|string $format Optional. An array of formats to be mapped to each of the values in $data. If string, that format will be used for all of the values in $data.
	 * 	A format is one of '%d', '%s' (decimal number, string). If omitted, all values in $data will be treated as strings unless otherwise specified in wpdb::$field_types.
	 * @param array|string $format_where Optional. An array of formats to be mapped to each of the values in $where. If string, that format will be used for all of the items in $where.  A format is one of '%d', '%s' (decimal number, string).  If omitted, all values in $where will be treated as strings.
	 * @return int|false The number of rows updated, or false on error.
	 */
	function update( $table, $data, $where, $format = null, $where_format = null ) {
		if ( ! is_array( $data ) || ! is_array( $where ) )
			return false;

		$formats = $format = (array) $format;
		$bits = $wheres = array();
		foreach ( (array) array_keys( $data ) as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset($this->field_types[$field]) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$bits[] = "`$field` = {$form}";
		}

		$where_formats = $where_format = (array) $where_format;
		foreach ( (array) array_keys( $where ) as $field ) {
			if ( !empty( $where_format ) )
				$form = ( $form = array_shift( $where_formats ) ) ? $form : $where_format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$wheres[] = "`$field` = {$form}";
		}

		$sql = "UPDATE `$table` SET " . implode( ', ', $bits ) . ' WHERE ' . implode( ' AND ', $wheres );
		return $this->query( $this->prepare( $sql, array_merge( array_values( $data ), array_values( $where ) ) ) );
	}

	/**
	 * Retrieve one variable from the database.
	 *
	 * Executes a SQL query and returns the value from the SQL result.
	 * If the SQL result contains more than one column and/or more than one row, this function returns the value in the column and row specified.
	 * If $query is null, this function returns the value in the specified column and row from the previous SQL result.
	 *
	 * @param string|null $query Optional. SQL query. Defaults to null, use the result from the previous query.
	 * @param int $x Optional. Column of value to return.  Indexed from 0.
	 * @param int $y Optional. Row of value to return.  Indexed from 0.
	 * @return string|null Database query result (as string), or null on failure
	 */
	function get_var( $query = null, $x = 0, $y = 0 ) {
		if ( $query )
			$this->query( $query );

		// Extract var out of cached results based x,y vals
		if ( !empty( $this->last_result[$y] ) ) {
			$values = array_values( get_object_vars( $this->last_result[$y] ) );
		}

		// If there is a value return it else return null
		return ( isset( $values[$x] ) && $values[$x] !== '' ) ? $values[$x] : null;
	}

	/**
	 * Retrieve one row from the database.
	 *
	 * Executes a SQL query and returns the row from the SQL result.
	 *
	 * @param string|null $query SQL query.
	 * @param string $output Optional. one of ARRAY_A | ARRAY_N | OBJECT constants. Return an associative array (column => value, ...),
	 * 	a numerically indexed array (0 => value, ...) or an object ( ->column = value ), respectively.
	 * @param int $y Optional. Row to return. Indexed from 0.
	 * @return mixed Database query result in format specifed by $output or null on failure
	 */
	function get_row( $query = null, $output = OBJECT, $y = 0 ) {
		if ( $query )
			$this->query( $query );
		else
			return null;

		if ( !isset( $this->last_result[$y] ) )
			return null;

		if ( $output == OBJECT ) {
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} elseif ( $output == ARRAY_A ) {
			return $this->last_result[$y] ? get_object_vars( $this->last_result[$y] ) : null;
		} elseif ( $output == ARRAY_N ) {
			return $this->last_result[$y] ? array_values( get_object_vars( $this->last_result[$y] ) ) : null;
		} else {
			$this->print_error(/*WP_I18N_DB_GETROW_ERROR*/" \$db->get_row(string query, output type, int offset) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N"/*/WP_I18N_DB_GETROW_ERROR*/);
		}
	}

	/**
	 * Retrieve one column from the database.
	 *
	 * Executes a SQL query and returns the column from the SQL result.
	 * If the SQL result contains more than one column, this function returns the column specified.
	 * If $query is null, this function returns the specified column from the previous SQL result.
	 *
	 * @param string|null $query Optional. SQL query. Defaults to previous query.
	 * @param int $x Optional. Column to return. Indexed from 0.
	 * @return array Database query result. Array indexed from 0 by SQL result row number.
	 */
	function get_col( $query = null , $x = 0 ) {
		if ( $query )
			$this->query( $query );

		$new_array = array();
		// Extract the column values
		for ( $i = 0, $j = count( $this->last_result ); $i < $j; $i++ ) {
			$new_array[$i] = $this->get_var( null, $x, $i );
		}
		return $new_array;
	}

	/**
	 * Retrieve an entire SQL result set from the database (i.e., many rows)
	 *
	 * Executes a SQL query and returns the entire SQL result.
	 *
	 * @param string $query SQL query.
	 * @param string $output Optional. Any of ARRAY_A | ARRAY_N | OBJECT | OBJECT_K constants. With one of the first three, return an array of rows indexed from 0 by SQL result row number.
	 * 	Each row is an associative array (column => value, ...), a numerically indexed array (0 => value, ...), or an object. ( ->column = value ), respectively.
	 * 	With OBJECT_K, return an associative array of row objects keyed by the value of each row's first column's value.  Duplicate keys are discarded.
	 * @return mixed Database query results
	 */
	function get_results( $query = null, $output = OBJECT ) {
		if ( $query )
			$this->query( $query );
		else
			return null;

		$new_array = array();
		if ( $output == OBJECT ) {
			// Return an integer-keyed array of row objects
			return $this->last_result;
		} elseif ( $output == OBJECT_K ) {
			// Return an array of row objects with keys from column 1
			// (Duplicates are discarded)
			foreach ( $this->last_result as $row ) {
				$key = array_shift( get_object_vars( $row ) );
				if ( ! isset( $new_array[ $key ] ) )
					$new_array[ $key ] = $row;
			}
			return $new_array;
		} elseif ( $output == ARRAY_A || $output == ARRAY_N ) {
			// Return an integer-keyed array of...
			if ( $this->last_result ) {
				foreach( (array) $this->last_result as $row ) {
					if ( $output == ARRAY_N ) {
						// ...integer-keyed row arrays
						$new_array[] = array_values( get_object_vars( $row ) );
					} else {
						// ...column name-keyed row arrays
						$new_array[] = get_object_vars( $row );
					}
				}
			}
			return $new_array;
		}
		return null;
	}

	/**
	 * Retrieve column metadata from the last query.
	 *
	 * @param string $info_type Optional. Type one of name, table, def, max_length, not_null, primary_key, multiple_key, unique_key, numeric, blob, type, unsigned, zerofill
	 * @param int $col_offset Optional. 0: col name. 1: which table the col's in. 2: col's max length. 3: if the col is numeric. 4: col's type
	 * @return mixed Column Results
	 */
	function get_col_info( $info_type = 'name', $col_offset = -1 ) {
		if ( $this->col_info ) {
			if ( $col_offset == -1 ) {
				$i = 0;
				$new_array = array();
				foreach( (array) $this->col_info as $col ) {
					$new_array[$i] = $col->{$info_type};
					$i++;
				}
				return $new_array;
			} else {
				return $this->col_info[$col_offset]->{$info_type};
			}
		}
	}

	function set_prefix( $prefix ) {

		if ( preg_match( '|[^a-z0-9_]|i', $prefix ) ) {
			$this->bail( "<h1>table prefix using unsupported characters</h1>" );
			return;
		}

		$old_prefix = $this->base_prefix;
		$this->base_prefix = $prefix;
		return $old_prefix;
	}
	
	function bail( $message ) {
		dv_die($message);
	}
}

?>
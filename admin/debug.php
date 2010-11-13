<?php 
if ( DEBUG == true ) {
	global $dv_globals;
?>
	<div id="debug">
		<pre>SESSION - <?php print_r( $_SESSION ); ?></pre>
		<pre>dv_globals - <?php print_r( $dv_globals ); ?></pre>
	</div>
<?php
}
?>
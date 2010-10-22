<pre>
<?php 

	$requestUri = pathinfo($_SERVER['REQUEST_URI']);
	print_r( $requestUri ); 
	print_r( $_SERVER );
?>
</pre>
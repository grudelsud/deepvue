	<div id="footer">
	</div><!-- end of #footer -->
</div><!-- end of #wrapper -->

<?php
if ( DEBUG == true ) {
	global $dv_globals;
?>
	<div id="debug"><a href="clearsession.php">clear session</a>
		<pre>SESSION - <?php print_r( $_SESSION ); ?></pre>
		<pre>dv_globals - <?php print_r( $dv_globals ); ?></pre>
	</div>
<?php
}
?>
</body>
</html>

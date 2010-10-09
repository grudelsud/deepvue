<?php
/**
 * @file
 * Clears PHP sessions and redirects to the index page.
 */
 
/* Load and clear sessions */
session_start();
session_destroy();
 
/* Redirect to page with the connect to Twitter option. */
header('Location: index.php');
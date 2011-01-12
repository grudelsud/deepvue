
VERSION 1.0


Overview
=========================

This package includes everything you need to get your application using both the server-side facebook api and client-side
facebook connect functions.

You can read more about this at http://www.haughin.com/code/facebook/



Licensing
=========================

facebook-client directory and contents licensed by Facebook.
All other contents licensed under GNU/GPL (see license.txt)


Basic setup instructions
=========================

1. 	Copy the files within application/ to your CodeIgniter application directory.
	Included is one config file (facebook.php), one library file (facebook_connect.php), the facebook-client
	one sample controller (home.php), and one sample view file (fbtest.php).
	
2.	Copy xd_receiver.htm to the root of your CodeIgniter install (in the same directory as CI's index.php)

3.	Go to facebook developer application and register your application ( http://www.facebook.com/developers/ )

4.	Copy your API and Secret key to config/facebook.php

5.	In the facebook developer application, set your 'Connect URL' under the connect tab, to the CodeIgniter application url.
	I.E. http://mygroovyapp.com/
	
6.	If your application lives on a subdomain (like : http://my.groovyapp.com ) set your 'base domain' under the connect tab
	to the top level domain of your application ( in this case: groovyapp.com )
	
7.	Give it a go!
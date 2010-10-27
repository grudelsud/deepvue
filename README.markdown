# General documentation

please refer to the following:

- authentication workflow: detailed in /index.php

- web frontend template: presently is total crap, please refer to functions dvfe->get[header, navigation, main]. 
please refer to /view/header.php /view/index.php for main functionalities

- add / get comment functions defined in dvdb and used in ajax_fe.php 

# FIXME - TODO - Things missing

- generally speaking, search for TODO and FIXME labels in the source code to find the exhaustive list of microtasks

- upload_remote.php, ln 132 check post to twitter is working

- db, table comments: text field for author is missing even if it's ok to have it as it is while the website 
is restricted to registered twitter user only. add DATE for comments!

- db, table user: all logging fields and functionalities, last check-in, navigation tracking, ...

- db, check tables element, event, comment: implement TIMEZONE for elements and start/end event

# Next steps

- give images a decent name in order to simplify merge/diff of folders

## References

### General libraries

- postmark app

### PHP frameworks

- code igniter
- doctrine ORM

### Comments

- markdown syntax http://daringfireball.net/projects/markdown/syntax
- markdown editor plugin for eclipse: http://winterstein.me.uk/projects/tt-update-site/
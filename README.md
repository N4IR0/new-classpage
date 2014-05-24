School-Class Management System
=============

###### A class info page for homeworks, tests, timetable changes etc.

  1. What it does
  2. What it need
  3. How you set it up
  4. What we want to do

## Description | What it does

This software can be used to easily display timetables, homeworks and tests. It is build for a two group block system wich is pretty usually in a German vocational school.

###### What it exacly does:

1. for each group
 + display the timetable - with support for dropped lessons and changed ones
 + display the homeworks - with a counter and different colors
 + display the homework details - with notifitation date (if email support is integrated) and support for link for examples and solutions
 + display the tests - with the same features as above

2. for all together
 + display some stats - overview for homeworks using amcharts
 + rewriting urls using htaccess
 

## Requirements | What it need

+ LAMP Server ( PHP 5.x ,  MySQL 5.x or better )
+ Apache mod_rewrite, Options All, AllowOverride All enabled
+ optional: FTP for file-sharing
+ optional: Pear:Mail ( php-mail )

<?php


// ERROR solved

#1. MySQL: MySQL Server has gone away when importing large sql file
my.ini file:

search: [mysqld]
max_allowed_packet = 256M
wait_timeout = 600
net_read_timeout = 300
net_write_timeout = 300


#2. PHP: Can't import database through phpmyadmin file size too large
php.ini file:

upload_max_filesize = 100M
post_max_size = 100M
max_execution_time = 259200
max_input_time = 259200
memory_limit = 1000M


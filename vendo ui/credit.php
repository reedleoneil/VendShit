<?php
$host    = "127.0.0.1";
$port    = 7777;
$message = "q";
// create socket
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 0, 'usec' => 7777));
socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 0, 'usec' => 7777));
// connect to server
$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
usleep(100000);
// send string to server
socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
usleep(100000);
// get server response
$result = trim(socket_read ($socket, 1024, PHP_NORMAL_READ)) or die("0");// die("Could not read server response\n");
usleep(100000);
// close socket
socket_close($socket);
echo $result;
?>

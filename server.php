<?php
$host = '127.0.0.1';
$port = 80811;
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Not created!");
$res = socket_bind($socket, $host, $port) or die('Not bind!');
$res = socket_listen($socket, 3) or die("Not listen!");
do{
    $accept = socket_accept($socket) or die("Not accept!");
    $read = socket_read($accept, 1024);
    $msg = trim($read);
    echo $msg ."\n";

    echo "Enter Reply";
    $reply = fgets(STDIN);
    socket_write($accept, $reply , strlen($reply));

}while(true);
socket_close($accept,$socket);
?>
<?php


ini_set( 'soap.wsdl_cache_enable', 0);
ini_set( 'soap.wsdl_cache_ttl', 0);

require 'class/Test.php';

file_put_contents('log.txt',  'user: ' . $_SERVER['PHP_AUTH_USER'] . ' pwd: ' .$_SERVER['PHP_AUTH_PW']);

$login = 'A';
$pass = 'B';

if(($_SERVER['PHP_AUTH_PW']!= $pass || $_SERVER['PHP_AUTH_USER'] != $login)|| !$_SERVER['PHP_AUTH_USER'])
{
    header('WWW-Authenticate: Basic realm="Test auth"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}

$server = new SoapServer('soap.xml', array('encoding'=>'UTF-8'));
$server->setClass('Test');
$server->setPersistence(SOAP_PERSISTENCE_SESSION);
$server->handle();
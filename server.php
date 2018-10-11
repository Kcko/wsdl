<?php


ini_set( 'soap.wsdl_cache_enable', 0);
ini_set( 'soap.wsdl_cache_ttl', 0);

require 'class/Test.php';

$server = new SoapServer('soap.xml', array('encoding'=>'UTF-8'));
$server->setClass('Test');
$server->handle();
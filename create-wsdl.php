<?php

require 'vendor/autoload.php';
require 'class/Test.php';

$class = "Test";
$serviceURI = "http://localhost/wsdl/server.php";
$wsdlGenerator = new PHP2WSDL\PHPClass2WSDL($class, $serviceURI);
$wsdlGenerator->generateWSDL(FALSE);
$wsdlXML = $wsdlGenerator->save('soap.xml');

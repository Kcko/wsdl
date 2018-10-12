<?php

$url = 'http://localhost/wsdl/server.php?wsdl';

ini_set( 'soap.wsdl_cache_enable', 0);
ini_set( 'soap.wsdl_cache_ttl', 0);

try
{
    // PHP AUTH verification
    $client = new SoapClient($url, array('exceptions' => TRUE, 'trace' => 1, 'login' => 'A', 'password' => 'B'));
    
    // non authorized method
    // echo $client->getTime();

    // authorized
    $sid = $client->login('guest', 'guest');
    echo $client->getTimeAuthorized($sid);

}
catch (SoapFault $e)
{
    //var_dump($e->getCode());
    //var_dump($e->faultcode);
    var_dump($e->getMessage());
    //var_dump($e);
    //var_dump($client->__getLastResponse());
}
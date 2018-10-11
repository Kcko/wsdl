<?php

ini_set( 'soap.wsdl_cache_enable', 0);
ini_set( 'soap.wsdl_cache_ttl', 0);

/**
 * Example class with @soap annotation.
 */
class Test
{
    // is user verified?
    private $authToken = NULL;
    
    // user level
    private $level = 0;


    public function __construct()
    {
        $this->authToken = md5(time());
    }
    

    /**
     * Login - verify user
     * @soap 
     *
     * @param string $username
     * @param string $password
     * @return string
     */
    public function login($username, $password)
    {
        $users = array(
            array('user' => 'guest', 'pwd' => 'guest', 'level' => 1),
            array('user' => 'master', 'pwd' => 'master', 'level' => 2),
        );
        
        foreach ($users as $row)
        {
            if ($username == $row['user'] && $password == $row['pwd'])
            {
                $this->level = $row['level']; // nastavime 1 nebo 2
                return $this->authToken;
            }
        }

        return '';
    }

    /**
     * @soap
     * @param string $sid
     * @throws SoapFault
     * @return int 
     */
    public function getTimeAuthorized($sid)
    {
        // file_put_contents('log.txt', $this->level); // prekvapive 0, ne nastavena hodnota po loginu

        if (!($sid && $this->authToken && $sid == $this->authToken))
            throw new SoapFault('403', '403 - Error');
    
        return time();
    }


    /**
     * @soap
     * @throws SoapFault
     * @return int 
     */
    public function getTime()
    {
        return time();
    }


    /** 
    * @soap
    * @param bool $one
    * @return int 
    */
    public function getOneOrTwo($one = TRUE)
    {
        if ($one)
            return 1;
        
        return 2;
    }


}
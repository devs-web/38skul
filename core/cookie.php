<?

class cookie {
    var $cookie;

    function __construct($core)
    {
        $this->cookie = $core->values->COOKIE;
    }

    function getCookie($key)
    {
        $cookie = null;

        $boolean = array_key_exists($key, $this->cookie);
        
        if ($boolean)
            $cookie = $this->cookie[$key];

        return $cookie;
    }

    function setCookie($key, $value, $time = COOKIE_TIME, $patch = '/')
    {
        $time = $time < time() ? time()+COOKIE_TIME : $time;
        setcookie($key, $value, $time, $patch);
    }

    function deleteCookie($key, $patch = '/')
    {
        setcookie($key, "", 1, $patch);
    }

    function deleteAllCookie ()
    {
        foreach ($this->cookie AS $key => $value)
        {
            self::deleteCookie($key);
        }
    }

    function UpdateAllCookie ($time = COOKIE_TIME, $patch = '/')
    {
        $time = $time < time() ? time()+COOKIE_TIME : $time;
        foreach ($this->cookie AS $key => $value)
        {
            setcookie($key, $value, $time, $patch);
        }
    }
}
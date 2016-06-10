<?

class activity {

    function __construct($core)
    {
        $this->core = $core;
        self::main();
    
    }
    
    function main()
    {
        $obj = new stdClass;
        self::account($obj);
        self::ip($obj);
        self::agent($obj);
        self::get($obj);
        self::post($obj);
        self::cookie($obj);
        self::time($obj);
        self::insert($obj);
    }

    function account (&$obj)
    {    
        $obj->account = $this->core->session->getId();
    }

    function ip (&$obj)
    {
        $obj->ip = $this->core->values->SERVER['REMOTE_ADDR'];
    }

    function agent (&$obj)
    {    
        $obj->agent = $this->core->values->SERVER['HTTP_USER_AGENT'];
    }

    function get (&$obj)
    {    
        $obj->get = $this->core->values->SERVER['REQUEST_URI'];
    }

    function post (&$obj)
    {    
        $str = '';
        
        foreach($this->core->values->POST AS $key => $value)
        {
            $str .= "$key=$value;";
        }

        $obj->post = $str;
    }

    function cookie (&$obj)
    {    
        $boolean = array_key_exists('HTTP_COOKIE', $this->core->values->SERVER);
        $obj->cookie = $boolean ? $this->core->values->SERVER['HTTP_COOKIE'] : null;
    }

    function time (&$obj)
    {    
        $obj->time = time();
    }
    
    function insert ($obj)
    {    
        $str = 'INSERT INTO activity SET ';
        $itr = 0;
        
        foreach($obj AS $key => $value)
        {
            $str .= $itr > 0 ? ", `$key` = '$value'" : "`$key` = '$value'";
            $itr++;
        }
        $this->core->cfg->db_site->query($str);
    }
}
<?

class configuration {
    var $db;
    
    function __construct ($dbs)
    {
        $this->db = $dbs;
        self::constructDbs ();
    }
    
    
    function constructDbs ()
    {
        foreach ($this->db AS $key => $value)
        {
            $host    = $value['host'];
            $port    = $value['port'];
            $login   = $value['login'];
            $pass    = $value['password'];
            $db      = $value['db'];
            $charset = $value['charset'];

            $this->{"db_$key"} = new db("$host:$port", $login, $pass, $db, $charset);
        }
    }
}
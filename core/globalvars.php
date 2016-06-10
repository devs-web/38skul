<?

class globalvars {

    var $vars = array();

    function __construct($core)
    {
        $this->db = $core->cfg->db_site;
        self::main();
    }

    function main()
    {
        self::loadVarFromDB();
    }

    function loadVarFromDB()
    {
        $result = $this->db->query("SELECT * FROM globalvars");
        if ($result)
        {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $var   = $row['var'];
                $value = $row['value'];
                
                $this->vars[$var] = $value;
            }
        }
    }

    function make($html)
    {
        if ($this->vars)
        {
            foreach ($this->vars AS $key => $value)
            {
                $html = str_replace('{&#036;' . $key . '}', $value , $html);
            }
        }
        return $html;
    }
}
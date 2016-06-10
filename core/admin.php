<?

class AdminSystem {

    private $isAdmin,
             $rank;

    public $Sec;

    function __construct($core) 
    {
        $this->core = $core;
        $this->sqls = $core->cfg->db_site;

        $this->autch = $core->session->getAutch();

        $this->Sec = new stdClass;

        self::adminInit();
    }

    public function adminInit()
    {
        $this->isAdmin = false;
        $this->rank    = 0;

        $this->Sec->NEWS       = false;
        $this->Sec->COMMENTS   = false;
        $this->Sec->PAGES      = false;
        $this->Sec->CATEGORYES = false;
        $this->Sec->INFO       = false;
        $this->Sec->EDITCATPAGES       = false;
        $this->Sec->EDITPAGES       = false;

        self::adminLoad();
        self::adminLoadParams();
    }

    private function setFullSecurity()
    {
        foreach($this->Sec AS $key => $value)
        {
            $this->Sec->$key = true;
        }
    }

    private function unsetFullSecurity()
    {
        foreach($this->Sec AS $key => $value)
        {
            $this->Sec->$key = false;
        }
    }

    private function adminLoad()
    {
        if ($this->autch)
        {
            $account_id = $this->core->session->getId(); /* Need rework session */
            $result = $this->sqls->query("SELECT rank FROM admins WHERE id = '$account_id'");
            if ($result)
            {
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                    $rank = $row['rank'];
                    self::setRank($rank);
                }
            }
        }
    }
    
    private function adminLoadParams()
    {
        $isAdmin = self::isAdmin();

        if($isAdmin)
        {
            $account_id = $this->core->session->getId(); /* Need rework session */

            $result = $this->sqls->query("SELECT const FROM admins_param WHERE id = '$account_id'");
            if ($result)
            {
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                    $const = $row['const'];

                    if ($const == 'ALL')
                    {
                        self::setFullSecurity();
                        break;
                    }

                    $isConst = isset($this->Sec->$const);

                    if ($isConst)
                    {
                        $this->Sec->$const = true;
                    }
                    else
                    {
                        /* Unknown admin constant */
                    }
                }
            }
        }
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    public function getRank()
    {
        return $this->rank;
    }

    private function setRank($rank)
    {
        $this->rank = $rank;
        self::setAdmin($rank);
    }

    private function setAdmin($rank)
    {
        if ($rank > 1) /* Rank = 0 is VIP, not Admin. Correct if need. */
            $this->isAdmin = true;
        else if ($rank == 0)
            $this->isAdmin = false;
        else {} /* Set VIP */
    }

    function deAutch()
    {
        self::setRank(0);
        self::unsetFullSecurity();
    }
}
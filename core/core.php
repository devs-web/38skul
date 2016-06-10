<?

class core {
    var $db,
        $core,
        $module;

    var $filesIgnoring = array('.', '..', 'index.php', 'core.php');

    function __construct($dbs)
    {

        $this->core = new stdClass();
        $this->module = new stdClass();

        self::loadingCores();

        $this->core->time     = new Time();        
        $this->core->screen   = new screening($this->core);        
        $this->core->values   = new values($this->core);
        $this->core->cookie   = new cookie($this->core);
        $this->core->debug    = new dbgInfo($this->core);
        $this->core->cfg      = new configuration($dbs);
        $this->core->session  = new session($this->core);
        $this->core->autch    = new autch($this->core);
        $this->core->admin    = new AdminSystem($this->core);
        $this->core->gv       = new globalvars($this->core);
        $this->core->activity = new activity($this->core);


        //$this->core->templates   = new templates($this->core);
        $this->core->blocks   = new blocks($this->core);
        //var_dump($this->core->templates);

        //$this->core->autch->authorization('NarkoHeal', '25789');
        //$this->core->session->deAutch ();
    }
    
    function loadingCores()
    {
        $coreDir = DOCUMENT_ROOT . '/core';
        $files1 = scandir($coreDir);
        foreach ($files1 as $key => $value)
        {
            if (!in_array($value, $this->filesIgnoring))
            {
                $openFile = $coreDir . '/' . $value;
                if (is_file($openFile))
                    include_once ($openFile);
            }
        }
    }
}



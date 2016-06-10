<?
/* Кодировка */

class objectModule extends tpl {
    var $MySQL;
    function __construct($core)
    {
        $this->core = $core;
        $this->time = $core->time;
        $this->screen = $core->screen;
        $this->val  = $core->values;
        $this->ses  = $core->session;
        $this->user = $core->autch;
        $this->MySQL   = $core->cfg->db_site;
        $this->admin  = $core->admin;
        $this->Sec    = $this->admin->Sec;
        $this->gv     = $core->gv;
    }
    
    function main()
    {
        $id = $this->core->session->getPageId(2);
        
        if ($id > 0)
            include("view/mo.php");
        else
            include("news.php");
        
    }
}

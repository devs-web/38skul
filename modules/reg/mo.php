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
        $this->sqls = $core->cfg->db_site;
    }
    
    function main()
    {
        $tpl = parent::initTpl();
        //$tpl->Set('cat_name', $name);
        parent::make($tpl);
    }
}

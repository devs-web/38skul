<?
/* Кодировка */

class objectModule extends tpl {
    var $MySQL;
    function __construct($core)
    {
        $this->core  = $core;
        $this->MySQL = $core->cfg->db_site;
    }
    
    function main()
    {
        header("HTTP/1.0 503 Forbidden");
        $tpl = parent::initTpl();
        parent::make($tpl);
    }
}

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
        self::editMyProfile();
    }
    
    function editMyProfile()
    {
        $autch = $this->ses->getAutch();
        if ($autch == true)
        {
            $tpl = parent::initTpl();

            $Name       = $this->ses->getName();
            $LastName   = $this->ses->getLastName();
            $BrithDay   = $this->ses->getBrithDay();
            $BrithMonth = $this->ses->getBrithMonth();
            $BrithYear  = $this->ses->getBrithYear();
            $Gender     = $this->ses->getGender();

            $tpl->Set('lk_name', $Name);
            $tpl->Set('lk_last_name', $LastName);
            $tpl->Set('lk_brithDay', $BrithDay);
            $tpl->Set('lk_brithYear', $BrithYear);

            for ($i = 1; $i <= 12; $i++)
            {
                $selected = $BrithMonth == $i ? "selected" : "";
                $tpl->Set('opt_month_'.$i, $selected);
            }

            for ($i = 0; $i <= 1; $i++)
            {
                $selected = $Gender == $i ? "checked" : "";
                $tpl->Set('opt_gender_'.$i, $selected);
            }
            parent::make($tpl);
        }
    }
}

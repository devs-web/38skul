<?
/* Кодировка */

include("pages.php");
include("news.php");

class objectModule extends tpl {
    function __construct($core)
    {
        $this->core   = $core;
        $this->time   = $core->time;
        $this->screen = $core->screen;
        $this->val    = $core->values;
        $this->ses    = $core->session;
        $this->user   = $core->autch;
        $this->sqls   = $core->cfg->db_site;
        $this->admin  = $core->admin;
        $this->Sec    = $this->admin->Sec;
    }
    
    function main()
    {
        $autch = $this->ses->getAutch();
        if ($autch)
        {
            $admin = $this->admin->isAdmin();
            if ($admin)
            {
                $moduleid = $this->ses->getPageId(1);
                self::modulesadmin($moduleid != '0' ? $moduleid : null);
            }
        }
    }
    
    function modulesadmin($moduleid = null)
    {
        switch($moduleid)
        {
            case 'news': { if ($this->Sec->NEWS) self::news(); } break;
            case 'pages': { if ($this->Sec->EDITCATPAGES) self::pages(); } break;
            default: echo "lol";
        } 
    }
    
    function news()
    {
        $moduleid = (string)$this->ses->getPageId(2);
        switch($moduleid)
        {
            case 'add': { if ($this->Sec->NEWS) self::newsadd(); } break;
            case 'edit': { if ($this->Sec->NEWS) self::newsedit(); } break;
            default: echo "lol";
        } 

    }
    
    function newsadd()
    {
        $tplNews = parent::initTpl('news/newsadd');
        parent::make($tplNews);
    }

    function newsedit()
    {
        $newsid = (int)$this->ses->getPageId(3);
        {
            $result = $this->sqls->query("SELECT * FROM `news` WHERE guid='$newsid'");
            if ($result)
            {
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                    $text = $row['text'];
                    $text = $row['text'];
                    $title = $row['title'];

                    $tplNews = parent::initTpl('news/newsedit');
                    $tplNews->Set('news_text', $text);
                    $tplNews->Set('news_title', $title);
                    $tplNews->Set('news_id', $newsid);
                    parent::make($tplNews);
                }
            }
        }
    }
    
    function pages()
    {
        $obj = new pagesadmin($this->core);
        parent::smake($obj);
    }
}

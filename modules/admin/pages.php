<?

class pagesadmin extends tpl {

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
        self::main();
    }
    
    function main()
    {
        $moduleid   = (string)$this->ses->getPageId(2);
        $moduletype = (string)$this->ses->getPageId(3);
        switch($moduleid)
        {
            case 'page':
            {
                switch($moduletype)
                {
                    case 'add': { if ($this->Sec->NEWS) self::pagesadd(); } break;
                    case 'edit': { if ($this->Sec->NEWS) self::pagesedit(); } break;
                    default: echo "Module type 'page' not setted.";
                } break;
            }
                
            case 'cat':
            {
                switch($moduletype)
                {
                    case 'add': { if ($this->Sec->NEWS) self::catadd(); } break;
                    case 'edit': { if ($this->Sec->NEWS) self::catedit(); } break;
                    default: echo "Module type 'catalog' not setted.";
                } break;
            }

            case 'url':
            {
                switch($moduletype)
                {
                    case 'add': { if ($this->Sec->NEWS) self::urladd(); } break;
                    case 'edit': { if ($this->Sec->NEWS) self::urledit(); } break;
                    default: echo "Module type 'catalog' not setted.";
                } break;
            }

            default: echo "Module not setted.";
        } 
    }

    function pagesadd()
    {
        $tplNews = parent::initTpl('pages/page/add');
        $tplNews->Set('catalog_id', (int)$this->ses->getPageId(4));
        parent::make($tplNews);
    }

    function pagesedit()
    {
        $id = (int)$this->ses->getPageId(4);
        {
            $result = $this->sqls->query("SELECT * FROM `v2_pages` WHERE id='$id'");
            if ($result)
            {
                while($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                    $text = $row['text'];
                    $name = $row['name'];

                    $tpl = parent::initTpl('pages/page/edit');
                    $tpl->Set('page_text', $text);
                    $tpl->Set('page_title', $name);
                    $tpl->Set('catalog_id', $id);
                    parent::make($tpl);
                }
            }
        }
    }

    function catadd()
    {
        $tplNews = parent::initTpl('pages/cat/add');
        $tplNews->Set('catalog_id', (int)$this->ses->getPageId(4));
        parent::make($tplNews);
    }

    function catedit()
    {
        $tplNews = parent::initTpl('pages/cat/edit');
        parent::make($tplNews);
    }

    function urladd()
    {
        $tplNews = parent::initTpl('pages/url/add');
        $tplNews->Set('catalog_id', (int)$this->ses->getPageId(4));
        parent::make($tplNews);
    }

    function urledit()
    {
        $tplNews = parent::initTpl('pages/url/edit');
        parent::make($tplNews);
    }
}
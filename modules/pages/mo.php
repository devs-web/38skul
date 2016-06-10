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
        $this->admin  = $core->admin;
        $this->Sec    = $this->admin->Sec;
        $this->gv     = $core->gv;
    }

    function main()
    {
        $page_id = (string)$this->ses->getPageId(1);

        $sql     = null;
        $obj     = new stdClass;

        if(preg_match('@[A-z]@u', $page_id))
        {
            $sql = "SELECT * FROM `v2_pages` WHERE `nurl` = '$page_id'";
        }
        else if (preg_match('@[0-9]@u', $page_id))
        {
            $page_id = (int)($page_id);
            $sql = "SELECT * FROM `v2_pages` WHERE `id` = '$page_id'";
        }

        if (isset($sql))
        {
            $result = $this->sqls->query($sql);
            if ($result)
            {
                while ($row = $result->fetch_array(MYSQLI_ASSOC))
                {
                    $obj->id    = $row['id'];
                    $obj->name  = $row['name'];
                    $obj->text  = $row['text'];
                    $obj->type  = $row['type'];
                    $obj->time  = $row['time'];
                    $obj->cid   = $row['cid'];
                    $obj->cname = $row['cname'];

                    self::viewCatalogName($obj);

                    switch($obj->type)
                    {
                        case 1: self::viewCatalog($obj); break;
                        case 2: self::viewPage($obj); break;
                        default: break;
                    }
                }

                if ($result->num_rows == 0)
                {
                    header("HTTP/1.0 404 Not Found");
                    $tpl = parent::initTpl('404');
                    parent::make($tpl);
                }
            }
            else
            {
                $tpl = parent::initTpl('500');
                parent::make($tpl);
            }
        }
        else
        {
            header("HTTP/1.0 503 Forbidden");
            $tpl = parent::initTpl('503');
            parent::make($tpl);
        }
    }

    function viewCatalogName($obj)
    {
        $tpl  = parent::initTpl('catname');
        $name = $obj->name;

        $tpl->Set('cat_name', $name);

        parent::make($tpl);
    }

    function viewPage($obj)
    {
        $tpl   = parent::initTpl('page');

        $id    = $obj->id;
        $name  = $obj->name;
        $text  = $this->gv->make($obj->text);
        $time  = $obj->time;
        $cid   = $obj->cid;
        $cname = $obj->cname;

        $time = $this->time->GetDate(1, 1, 0, 1, $time);
        $text = $this->screen->ScreeningBB($text);
        $text = $this->screen->viewUrl($text);

        $button = '';

        if ($this->Sec->EDITCATPAGES)
        {
            $tplbutton = parent::initTpl('admin/editpage');
            $tplbutton->Set('pg_field_id', $id);
            $button    = parent::make($tplbutton, true);
        }

        $tpl->Set('buttons', $button);


        $tpl->Set('id', $id);
        $tpl->Set('text', $text);
        $tpl->Set('time', $time);
        $tpl->Set('author_id', $cid);
        $tpl->Set('author_name', $cname);

        parent::make($tpl);
    }

    function viewCatalog($obj)
    {
        $id = $obj->id;

        if ($this->Sec->EDITCATPAGES)
        {
            $tpl = parent::initTpl('admin/addpage');
            $tpl->Set('catalog_id', $obj->id);
            parent::make($tpl);
        }

        $result = $this->sqls->query("SELECT * FROM v2_pages WHERE `pid` = '$id'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $id   = $row['id'];
            $name = $row['name'];
            $nurl = $row['nurl'] ? $row['nurl'] : $id;
            $type = $row['type'];
            $text = $row['text'];

            $button = '';

            if ($this->Sec->EDITCATPAGES)
            {
                $tplbutton = parent::initTpl('admin/buttons');
                $tplbutton->Set('pg_field_id', $id);
                $button    = parent::make($tplbutton, true);
            }

            $tpl  = parent::initTpl('catfields');
            if ($type == 3)
            {
                $tpl  = parent::initTpl('catfieldsurl');
                $tpl->Set('url', $text);
            }
            else if ($type == 2)
            {
                $tpl  = parent::initTpl('catfieldspage');
                $tpl->Set('url', $nurl);
            }
            else if ($type == 1)
            {
                $tpl  = parent::initTpl('catfields');
                $tpl->Set('url', $nurl);
            }

            $tpl->Set('name', $name);
            $tpl->Set('button', $button);

            parent::make($tpl);
        }

        if ($result->num_rows == 0)
        {
            $tpl = parent::initTpl('emptyfields');
            parent::make($tpl);
        }
    }
}

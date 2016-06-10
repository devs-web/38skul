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
    }
    
    function main()
    {
        self::identifyType();
    }
    
    function identifyType()
    {
        $type = (string)$this->ses->getPageId(1);

        $id   = $this->ses->getPageId(2);
        
        (bool) $isString = false;
        
        if(preg_match('@[A-z]@u',$id))
        {
            $isString = true;
        }
        else
        {
           $id = (int)$id;
        }

        switch($type)
        {
            case 'cat':  self::viewCatalog($id, $isString); break;
            case 'page': self::viewPage($id, $isString); break;
            default: $tpl = parent::initTpl('503'); parent::make($tpl);
        }
    }
    
    function viewCatalog($id, $isString)
    {
        $obj = self::viewCatalogName($id, $isString);
        
        if($obj->found)
        {
            if ($this->Sec->EDITCATPAGES)
            {
                $tpl = parent::initTpl('admin/addpage');
                $tpl->Set('catalog_id', $obj->id);
                parent::make($tpl);
            }
            self::viewCatalogData($obj);
        }
        else
        {
            $tpl = parent::initTpl('404');
            parent::make($tpl);

            if ($this->Sec->EDITCATPAGES)
            {
                $tpl = parent::initTpl('admin/addpage');
                parent::make($tpl);
            }
        }

    }

    function viewPage($id, $isString)
    {
        $whereName = $isString ? 'urlname' : 'id';
        $result    = $this->sqls->query("SELECT * FROM pages WHERE `$whereName` = '$id'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $tpl         = parent::initTpl('page');

            $id          = $row['id'];
            $name        = $row['name'];
            $text        = $row['text'];
            $time        = $row['time'];
            $author_id   = $row['author_id'];
            $author_name = $row['author_name'];
            
            $time = $this->time->GetDate(1, 1, 0, 1, $time);
            $text = $this->screen->ScreeningBB($text);
            $text = $this->screen->viewUrl($text);
            
            
            $tpl->Set('id', $id);
            $tpl->Set('name', $name);
            $tpl->Set('text', $text);
            $tpl->Set('time', $time);
            $tpl->Set('author_id', $author_id);
            $tpl->Set('author_name', $author_name);
            
            parent::make($tpl);
        }
    }
    
    function viewCatalogName($id, $isString)
    {
        $obj = new stdClass;
        
        (bool) $obj->found = false;

        $whereName = $isString ? 'urlname' : 'id';

        $result = $this->sqls->query("SELECT * FROM catalog WHERE `$whereName` = '$id'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $tpl = parent::initTpl('catname');

            $name = $row['name'];
            $id   = $row['id'];

            $tpl->Set('cat_name', $name);
            parent::make($tpl);

            $obj->found = !$obj->found;
            $obj->id    = $id;
        }
        $result->free();
        return $obj;
    }
    
    function viewCatalogData($obj)
    {
        $id = $obj->id;

        $result = $this->sqls->query("SELECT * FROM catalog_fields WHERE `catalog` = '$id'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            if ($this->Sec->EDITCATPAGES)
                $tpl = parent::initTpl('admin/catfields');
            else
                $tpl = parent::initTpl('catfields');

            $name = $row['name'];
            $url  = $row['url'];
            $guid  = $row['guid'];

            $tpl->Set('name', $name);
            $tpl->Set('url', $url);
            $tpl->Set('pg_field_id', $guid);

            parent::make($tpl);
        }
        $result->free();
    }
    
}

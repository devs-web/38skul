<?

class admPages extends tpl {
    var $respond;
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
        $this->affected = 0;

        if($this->Sec->EDITCATPAGES)
        {            
            self::main();
        }
        else
        {
            $this->respond['error'] = 3;
        }

        $this->used = true;
    }

    function main()
    {
        $obj = new stdClass;

        $obj->type    = (string)$this->val->post('subtype');
        $obj->method  = (string)$this->val->post('method');
        $obj->text    = (string)$this->val->post('text');    
        $obj->title   = (string)$this->val->post('title');
        $obj->pgid    = (int)$this->val->post('pgid');

        switch($obj->method)
        {
            case 'create': self::create($obj); break;
            case 'update': self::update($obj); break;
            case 'delete': self::delete($obj); break;
            default: break;
        }
    }

    function create($obj)
    {
        $type   = $obj->type;
        $method = $obj->method;
        $text   = $obj->text;    
        $title  = $obj->title;
        $pgid   = $obj->pgid;
        $time   = time();
        $cname  = $this->ses->getNickname();
        $cid    = $this->ses->getId();
        $nurl   = null;

        if ((isset($title) && ($type == 1 || $type == 3)) || ($type == 2 && strlen($title) > 0 && strlen ($text) > 0))
        {
            $this->sqls->query("INSERT INTO v2_pages SET
                `pid` = '$pgid',
                `name` = '$title',
                `text` = '$text',
                `nurl` = '$nurl',
                `type` = '$type',
                `time` = '$time',
                `cid` = '$cid',
                `cname` = '$cname'");

            $this->respond['error'] = 0;
            $this->respond['type'] = 1;
            $this->respond['url'] = $this->sqls->insert_id;
        }
        else
        {
            $this->respond['error'] = 2;
        }
    }

    function update($obj)
    {
        $type   = $obj->type;
        $text   = $obj->text;    
        $title  = $obj->title;
        $pgid   = $obj->pgid;
        $time   = time();
        $cname  = $this->ses->getNickname();
        $cid    = $this->ses->getId();
        $nurl   = null;

        if ((isset($title) && ($type == 1 || $type == 3)) || ($type == 2 && strlen($title) > 0 && strlen ($text) > 0))
        {
            $this->sqls->query("UPDATE v2_pages SET
                `name` = '$title',
                `text` = '$text',
                `time` = '$time',
                `cid` = '$cid',
                `cname` = '$cname' WHERE id='$pgid'");
                /*`nurl` = '$nurl',*/

            $this->respond['error'] = 0;
            $this->respond['type'] = 2;
            $this->respond['url'] = $pgid;
        }
        else
        {
            $this->respond['error'] = 2;
        }
    }

    function delete($obj)
    {
        $pgid = $obj->pgid;
        ignore_user_abort(true);
        set_time_limit(0);
        self::deleteFromId($pgid);

        $this->respond['error'] = 0;

        if ($this->affected > 0)
        {
            $this->respond['type'] = 7;
            $this->respond['affected'] = $this->affected;
        }
        else
        {
            $this->respond['type'] = 8;
        }

        flush();
        set_time_limit(1);
    }
    
    function deleteFromId($pgid)
    {
        $this->sqls->query("DELETE FROM v2_pages WHERE `id` = '$pgid'");
        $this->affected = $this->affected + $this->sqls->affected_rows;

        $result = $this->sqls->query("SELECT * FROM v2_pages WHERE `pid` = '$pgid'");
        if ($result)
        {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $id = $row['id'];
                self::deleteFromId($id);
            }
        }
    }
}
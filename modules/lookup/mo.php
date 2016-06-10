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
        $post = urldecode ((string)$this->ses->getPageId(1));
        
        if (strlen($post) < 2)
        {
            $tpl = parent::initTpl('warning');
            $tpl->Set('err_msg', "Слишком короткий текст запроса. Минимум 3 символа");
            parent::make($tpl);
            return;
        }
        else if (strlen($post) > 100)
        {
            $tpl = parent::initTpl('warning');
            $tpl->Set('err_msg', "Слишком длинный текст запроса. Максимум 100 символов");
            parent::make($tpl);
            return;
        }
        
        $join_text = $post;

        $arr = self::splitLook($join_text);
        $sql_text = self::createTextForLookup($arr);
        
        $sql_template = "SELECT `guid`, `text`, `title` FROM `news` WHERE UCASE(`text`) REGEXP UCASE('$sql_text') OR UCASE(`title`) REGEXP UCASE('$sql_text') LIMIT 20";

        $result = $this->sqls->query($sql_template);
        if ($result)
        {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $guid = $row['guid'];
                $title = self::lookuptext($arr, $row['title']);
                $text = self::lookuptext($arr, $this->screen->screeningBB($row['text']));
                

                $tpl = parent::initTpl();
                $tpl->Set('title', $title);
                $tpl->Set('description', $text);
                $tpl->Set('id', $guid);

                parent::make($tpl);
            }
            
            if ($result->num_rows < 1)
            {
                $tpl = parent::initTpl('warning');
                $tpl->Set('err_msg', $this->screen->screeningBB("Ничего не найдено. ;("));
                parent::make($tpl);
            }
        
        }
    }

    function splitLook($join_text)
    {
        $arr = preg_split("/[\s,|\/]+/", trim($join_text, ' '));
        $arr2 = array();
        
        foreach($arr AS $key => $value)
        {
            if (strlen($value) < 3)
                continue;

            if (in_array($value, $arr2))
                continue;

            array_push($arr2, $value);
        }
        
        return $arr2;
    }

    function createTextForLookup($arr)
    {
        $text = '';
        $cnt = 0;
        foreach($arr AS $key => $value)
        {
            $text .= $cnt > 0 ? '|' . $value : $value;
            $cnt++;
        }

        return $text;
    }

    function lookuptext($arr, $text)
    {
        foreach($arr AS $key => $value)
        {
            $text = self::selection($text, $value);
        }

        return $text;
    }

    function selection($str, $val)
    {
        return str_ireplace($val, "<font style=\"background: rgb(160, 14, 206); color: #fff;\">$val</font>", $str);
    }
}

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
        $obj = new stdClass;
        $obj->used = false;
        $this->respond = array();
        header('Access-Control-Allow-Origin: *');
        
        include ("pages.php");

        $type = $this->val->post('type');
        switch($type)
        {
            case 'autch': self::autch(); break;
            case 'deautch': self::deautch(); break;
            case 'comment': self::commentadd(); break;
            case 'register': self::register(); break;
            case 'backpassword': self::backpassword(); break;
            case 'moderate': self::moderate(); break;
            case 'resaveuser': self::resaveuser(); break;
            case 'sendmessage': self::sendmessage(); break;
            case 'gettokens': self::gettokens(); break;
            case 'gettokenresult': self::gettokenresult(); break;
            case 'page': self::createpage(); break;
            case 'pages': $obj = new admPages($this->core); break;
            default: self::error();
        }
        
        if ($obj->used)
        {
            $this->respond = $obj->respond ? $obj->respond : array();
        }

        echo json_encode($this->respond);
    }
    
    function autch()
    {
        $username = $this->val->post('username');
        $password = $this->val->post('password');
        $respond = $this->user->authorization($username, $password);
        
        $this->respond['autch'] = $respond ? 1 : 0;
        if ($respond)
        {
            $fio      = $this->ses->getName();
            $username = $this->ses->getUsername();
            
            $myName = $fio != null && $fio != '' ? $fio : $username;
            $this->respond['myname'] = $myName;
        }
    }

    function deautch()
    {
        $this->ses->deAutch();
        $this->respond['autch'] = 0;
    }

    function commentadd()
    {
    
    }

    function register()
    {
        $error = false;
        $reg_name       = $this->val->post("reg_name");
        $reg_last_name  = $this->val->post("reg_last_name");
        $reg_username   = $this->val->post("reg_username");
        $reg_email      = $this->val->post("reg_email");
        $reg_password   = $this->val->post("reg_password");
        $reg_birthDay   = $this->val->post("reg_birthDay");
        $reg_birthMonth = $this->val->post("reg_birthMonth");
        $reg_birthYear  = $this->val->post("reg_birthYear");
        $reg_gender     = $this->val->post("reg_gender");
        
        $test_login    = preg_match("/^[a-zA-Z0-9]/i", $reg_username);
        $test_password = preg_match("/^[a-zA-Z0-9]/i", $reg_password);
        $test_email    = preg_match("/^[a-z0-9-_.]+@[a-z0-9-]+\.[a-z-]+$/i", $reg_email);
        
        if (!$test_login)
        {
            $this->respond['register']['login'] = 1;
            $error = true;
        }

        if (!$test_password)
        {
            $this->respond['register']['password'] = 1;
            $error = true;
        }

        if (!$test_email)
        {
            $this->respond['register']['email'] = 1;
            $error = true;
        }

        $this->respond['register']['error'] = $error ? 1 : 0;
        
        if ($error)
        {
            return false;
        }
        
        $result = $this->sqls->query("SELECT * FROM account WHERE username='$reg_username' OR email='$reg_email'");
        if ($result)
        {
            while ($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $username = $row['username'];
                $email    = $row['email'];
                
                $this->respond['register']['login'] = (mb_strtolower($username) == mb_strtolower($reg_username)) ? 2 : 0;
                $this->respond['register']['email'] = (mb_strtolower($email)    == mb_strtolower($reg_email)) ? 2 : 0;
                $error = true;
            }
        }
        
        $result->free();

        $this->respond['register']['error'] = $error ? 1 : 0;

        if ($error)
        {
            return false;
        }
        
        $sha_pass_hash = $this->user->sha_password($reg_username, $reg_password);

        $registr = $this->sqls->query("INSERT INTO account SET
            `name` = '$reg_name',
            `last_name` = '$reg_last_name',
            `username` = '$reg_username',
            `email` = '$reg_email',
            `birthDay` = '$reg_birthDay',
            `birthMonth` = '$reg_birthMonth',
            `birthYear` = '$reg_birthYear',
            `gender` = '$reg_gender',
            `sha_pass_hash` = '$sha_pass_hash'");
        
        if($registr)
        {
            $respond = $this->user->authorization($reg_username, $reg_password);

            $this->respond['autch'] = $respond ? 1 : 0;
            if ($respond)
            {
                $fio      = $this->ses->getName();
                $username = $this->ses->getUsername();
            
                $myName = $fio != null && $fio != '' ? $fio : $username;
                $this->respond['myname'] = $myName;
                $this->respond['register']['error'] = 0;
            }
        }
        else
        {
            $this->respond['register']['error'] = 3;
        }
    }

    function backpassword()
    {
    
    }

    function moderate()
    {
    
    }

    function error()
    {
    
    }

    function resaveuser()
    {
        $error = false;
        $reg_name       = $this->val->post("reg_name");
        $reg_last_name  = $this->val->post("reg_last_name");

        $reg_password   = $this->val->post("reg_password");

        $reg_birthDay   = $this->val->post("reg_birthDay");
        $reg_birthMonth = $this->val->post("reg_birthMonth");
        $reg_birthYear  = $this->val->post("reg_birthYear");

        $reg_gender     = $this->val->post("reg_gender");
        
        $test_password = preg_match("/^[a-zA-Z0-9]/i", $reg_password);

        if (!$test_password && $reg_password != '')
        {
            $this->respond['register']['password'] = 1;
            $error = true;
        }

        $this->respond['register']['error'] = $error ? 1 : 0;
        
        if ($error)
        {
            return false;
        }
        
        $autch = $this->ses->getAutch();

        if ($autch == true)
        {
            $account_id   = $this->ses->getId();
            $reg_username = $this->ses->getUsername();

            $registr = $this->sqls->query("UPDATE account SET
                `name` = '$reg_name',
                `last_name` = '$reg_last_name',
                `birthDay` = '$reg_birthDay',
                `birthMonth` = '$reg_birthMonth',
                `birthYear` = '$reg_birthYear',
                `gender` = '$reg_gender' WHERE id = '$account_id'");
        
            if($registr)
            {
                if ($reg_password != '')
                {
                    $sha_pass_hash  = $this->user->sha_password($reg_username, $reg_password);
                    $updatePassword = $this->sqls->query("UPDATE account SET sha_pass_hash = '$sha_pass_hash' WHERE id = '$account_id'");
                    
                    if ($updatePassword)
                    {
                        $respond = $this->user->authorizationSha($sha_pass_hash);
                    }
                }
                else
                {
                    $sha     = $this->ses->getSha();
                    $respond = $this->user->authorizationSha($sha);
                }

                $fio      = $this->ses->getName();
                $username = $this->ses->getUsername();
            
                $myName = $fio != null && $fio != '' ? $fio : $username;
                $this->respond['myname'] = $myName;
                $this->respond['register']['error'] = 0;
            }
            else
            {
                $this->respond['register']['error'] = 3;
            }
        }
    }

    function sendmessage()
    {
        $commented = false;
        $text = $this->val->post('text');
        $key  = (int)$this->val->post('key');
        $id   = $this->val->post('id');
        
        $autch = $this->ses->getAutch();

        if ($autch)
        {
            switch($key)
            {
                case 1: $commented = self::commentNews($id, $text); break;
                default: break;
            }
        }
        $this->respond['error'] = $commented ? 0 : 1;
    }
    
    function commentNews($id, $text)
    {
        $account_id = $this->ses->getId();
        $Name       = $this->ses->getName();
        $LastName   = $this->ses->getLastName();
        $username   = $this->ses->getUsername();
            
        $myName = $Name != null && $Name != '' ? ($Name . ' ' . $LastName) : $username;


        $commented = $this->sqls->query("INSERT INTO comments SET
            `userid` = '$account_id',
            `username` = '$myName',
            `text` = '$text',
            `time` = '". time() ."',
            `ava` = '/uploads/avatar/1.jpg',
            `type` = '1',
            `blocked` = '0',
            `id` = '$id',
            `raiting` = '0'");
        
        if ($commented)
        {
            return true;
        }
        return false;
    }
    
    function gettokens()
    {
        $autch = $this->ses->getAutch();

        if ($autch == true)
        {
            $token1 = md5(time() + rand(1, 10000));
            $token2 = md5(time() - rand(10000, 100000));

            $account_id = $this->ses->getId();
            $time = time();

            $this->sqls->query("INSERT INTO tokens SET
            `token1` = '$token1',
            `token2` = '$token2',
            `account_id` = '$account_id',
            `time` = '$time'");
            
            
            $this->respond['token1'] = $token1;
            $this->respond['token2'] = $token2;
            $this->respond['error']  = 0;
        }
        else
        {
            $this->respond['error']  = 1;
        }
    }
    
    function gettokenresult()
    {
        $token1 = $this->val->post('token1');
        $token2 = $this->val->post('token2');

        $result = $this->sqls->query("SELECT code, respond, name FROM tokens WHERE token1='$token1' AND token2='$token2'");
        if ($result)
        {
            while($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $code = $row['code'];
                $respond = $row['respond'];
                $name = $row['name'];
            
                $this->respond['code'] = $code;
                $this->respond['respond'] = $respond;
                $this->respond['name'] = $name;
            }
        }
    }
    
    function createpage()
    {
        $type = $this->val->post('subtype');    
        $text = $this->val->post('text');    
        $title = $this->val->post('title');

        $Name       = $this->ses->getName();
        $LastName   = $this->ses->getLastName();
        $username   = $this->ses->getUsername();
            
        $myName = $Name != null && $Name != '' ? ($Name . ' ' . $LastName) : $username;
        
        switch($type)
        {
            case 1: self::CreateNews($text, $title, $myName); break;
            case 2: self::UpdateNews($text, $title, $myName); break;
            default: break;
        }
    }
    
    function CreateNews($text, $title, $myName)
    {
        if ($this->Sec->NEWS)
        {
            $this->sqls->query("INSERT INTO news SET
                `author_name` = '$myName',
                `title` = '$title',
                `text` = '$text',
                `text_full` = '$text',
                `time` = '". time() ."'");

                $this->respond['error'] = 0;
                $this->respond['type'] = 1;
        }
        else
        {
            $this->respond['error'] = 1;
        }
    }

    function UpdateNews($text, $title, $myName)
    {
        if ($this->Sec->NEWS)
        {
            $id = (int)$this->val->post('pgid');

            $this->sqls->query("UPDATE news SET
                `author_name` = '$myName',
                `title` = '$title',
                `text` = '$text',
                `text_full` = '$text',
                `time` = '". time() ."' WHERE guid='$id'");

                $this->respond['error'] = 0;
                $this->respond['type'] = 3;
        }
        else
        {
            $this->respond['error'] = 1;
        }
    }
}

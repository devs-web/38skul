<?

class session {
    var $Username,
        $Id,
        //$Fio,

        $Name,
        $LastName,
        $BrithDay,
        $BrithMonth,
        $BrithYear,
        $Gender,

        $Sha,
        $unbanDate,
        $banReason,
        $Banned,
        $AutchCookie,
        $EndDelete,
        $Ip,
        $UserAgent,
        $Host,
        $Uri,
        $uri,
        $autch,
        $MySQL,
        $cookie;

    function __construct($core)
    { /* Need rework */
        $this->MySQL  = $core->cfg->db_site;
        $this->cookie = $core->cookie;
        $this->values = $core->values;
        
        $this->autch  = false;
        $this->Banned = false;
        self::setPageId();
    }

    function setUsername  ($value) { $this->Username = $value; }
    function setId        ($value) { $this->Id = $value; }
    //function setFio       ($value) { $this->Fio = $value; }

    function setName       ($value) { $this->Name = $value; }
    function setLastName   ($value) { $this->LastName = $value; }
    function setBrithDay   ($value) { $this->BrithDay = $value; }
    function setBrithMonth ($value) { $this->BrithMonth = $value; }
    function setBrithYear  ($value) { $this->BrithYear = $value; }
    function setGender     ($value) { $this->Gender = $value; }

    function setSha       ($value) { $this->Sha = $value; }
    function setIp        ($value) { $this->Ip = $value; }
    function setUserAgent ($value) { $this->UserAgent = $value; }
    function setHost      ($value) { $this->Host = $value; }
    function setUri       ($value) { $this->Uri = $value; }
    function setAutch           () { $this->autch = true;
                                      $this->AutchCookie = $this->Sha;
                                      $this->cookie->setCookie('autch_id', $this->Sha);
                                      self::CheckBanned(); }

    function setBan       ($value,
                           $value2) { $this->unbanDate = $value; 
                                      $this->banReason = $value2;
                                      $this->Banned    = true; }

    /* GET DATA START*/

    /* Account data */
    function getAutch     () { return $this->autch; } /* Autch ? First check */

    function getUsername  () { return $this->Username; } /* Login account */
    function getId        () { return self::getAutch() ? (int)$this->Id : 0; } /* account Id */
    function getSha       () { return $this->Sha; } /* password hash */


    /* Connect Data */
    function getIp        () { return $this->Ip; } /* Connect IP */
    function getUserAgent () { return $this->UserAgent; } /* User agent: firefox, opera, chrome, IE.... */
    function getHost      () { return $this->Host; } /* hostname */
    function getUri       () { return $this->Uri; } /* FULL URL */


    /* banned data */
    function getIsBaneed  () { return $this->Banned; } /* Is banned account ? after getAutch() */

    function getUnanDate  () { return $this->unbanDate; } /* Is banned, return unban date */
    function getBanReason () { return $this->banReason; } /* Is banned, return ban reason */


    /* personal information */

    //function getFio       () { return $this->Fio; } /* old data. Need correct clean */

    function getName       () { return $this->Name; }
    function getLastName   () { return $this->LastName; }
    function getBrithDay   () { return $this->BrithDay; }
    function getBrithMonth () { return $this->BrithMonth; }
    function getBrithYear  () { return $this->BrithYear; }
    function getGender     () { return $this->Gender; }
    function getNickname()
    {
        $Name       = self::getName();
        $LastName   = self::getLastName();
        $username   = self::getUsername();
            
        return $Name != null && $Name != '' ? ($Name . ' ' . $LastName) : $username;
    }

    /* Cookie data */
    function getAutchCookie () { return $this->AutchCookie; } /* autch_id, аля sha_pass_hash */

    /* GET DATA END */
    
    function deAutch ()
    { /* Need rework */
        $this->cookie->deleteAllCookie();
        $this->autch = false;

        foreach ($this AS $key => $value)
        {
            if ($key == 'EndDelete') break;
            unset($this->$key);
        }
        unset($this->cookie);
    }

    function CheckBanned ()
    {
        $id   = $this->Id;
        $date = time();

        $result = $this->MySQL->query("SELECT * FROM account_banned WHERE id='$id' AND (unban_date > '$date' OR unban_date = '0')");
        if ($result)
        {
            while ($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $unbanDate = $row['unban_date'];
                $reason    = $row['reason'];

                self::setBan($unbanDate, $reason);
            }
        }
    }

    function setPageId()
    { /* Работает? Не трогай... */
        $this->uri = array();
        $this->uri[0] = null;
        $uri = explode('/', trim($this->values->SERVER['REQUEST_URI'], '/'));

        $keyIgnore = 0;

        foreach($uri AS $key => $value)
        {    
            $pos   = mb_stripos($value, '?');

            if ($pos === false)
            {
                $value = $value;
            }
            else if ($pos > 0)
            {
                $value = $pos ? substr($value, 0, $pos) : $value;
            }
            else if ($pos == 0)
            {
                $keyIgnore++;
                $value = "";
                continue;
            }

            $key = $keyIgnore > 0 ? $key - $keyIgnore : $key;
            $this->uri[$key] = $value;
        }
    }

    function getPageId($id = 0)
    {
        $page = 0;
        $keyBool = array_key_exists($id, $this->uri);
        if ($keyBool)
        {
            $page = $this->uri[$id] == 'home' ? 0 : $this->uri[$id];
        }

        return $page;
    }
}
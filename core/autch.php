<?

class autch {
    var $session;
    var $MySQL;

    function SetClientDefaultInfo ()
    {
        $Ip        = $_SERVER['REMOTE_ADDR'];
        $UserAgent = $_SERVER['HTTP_USER_AGENT'];
        $Host      = $_SERVER['HTTP_HOST'];
        $Uri       = $_SERVER['REQUEST_URI'];

        $this->session->setIp($Ip);
        $this->session->setUserAgent($UserAgent);
        $this->session->setHost($Host);
        $this->session->setUri($Uri);
    }

    function authorizationSha($pass_hash)
    {
        $result = $this->MySQL->query("SELECT * FROM account WHERE sha_pass_hash='$pass_hash'");
        if ($result)
        {
            while ($row = $result->fetch_array(MYSQLI_ASSOC))
            {
                $username = $row['username'];
                $id       = $row['id'];

                $Name       = $row['name'];
                $LastName   = $row['last_name'];
                $BrithDay   = $row['birthDay'];
                $BrithMonth = $row['birthMonth'];
                $BrithYear  = $row['birthYear'];
                $Gender     = $row['gender'];

                $this->session->setName($Name);
                $this->session->setLastName($LastName);
                $this->session->setBrithDay($BrithDay);
                $this->session->setBrithMonth($BrithMonth);
                $this->session->setBrithYear($BrithYear);
                $this->session->setGender($Gender);

                $this->session->setUsername($username);
                $this->session->setId($id);

                $this->session->setSha($pass_hash);

                $this->session->setAutch();
            }
        }

        return $this->session->getAutch() ? true : false;
    }

    function sha_password($username, $pass)
    {
        $user = strtoupper($username);
        $pass = strtoupper($pass);

        return SHA1($user.':'.$pass);
    }

    function authorization ($username, $password)
    {
        $pass_hash = $this->sha_password($username, $password);
        $autch     = self::authorizationSha($pass_hash);

        return $autch;
    }
    
    function automaticAutch($core)
    {
        $cookieAutch = $core->cookie->getCookie('autch_id');
        $cookieAutch ? self::authorizationSha($cookieAutch) : NULL;
    }

    function __construct($core)
    {
        $this->session = $core->session;
        $this->MySQL   = $core->cfg->db_site;
        self::SetClientDefaultInfo ();
        self::automaticAutch($core);
    }
}


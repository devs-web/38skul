<?


class values {
    var $COOKIE  = array(),
        $SESSION = array(),
        $GET     = array(),
        $POST    = array(),
        $POSTBB    = array(),
        $SERVER  = array();

    function __construct($core)
    {
        $screen = $core->screen;
        foreach ($_COOKIE as $key => $value)
        {
            $key   = $screen->Screening_text($key);
            $value = $screen->Screening_text($value);

            $this->COOKIE[$key] = $value;
        }

        foreach ($_SESSION as $key => $value)
        {
            $key   = $screen->Screening_text($key);
            $value = $screen->Screening_text($value);

            $this->SESSION[$key] = $value;
        }

        foreach ($_GET as $key => $value)
        {
            $key   = $screen->Screening_text($key);
            $value = $screen->Screening_text($value);

            $this->GET[$key] = $value;
        }

        foreach ($_POST as $key => $value)
        {
            $key   = $screen->Screening_text($key);
            $value = $screen->Screening_text($value);

            $this->POST[$key] = $value;
        }

        foreach ($_POST as $key => $value)
        {
            $key   = $screen->Screening_text($key);
            $value = $screen->preEditParse($value);
            $value = $screen->Screening_text($value);

            $this->POSTBB[$key] = $value;
        }

        foreach ($_SERVER as $key => $value)
        {
            $key   = $screen->Screening_text($key);
            $value = $screen->Screening_text($value);

            $this->SERVER[$key] = $value;
        }
    }
    
    function get($key)
    {
        $boolean = array_key_exists($key, $this->GET);
        $get = $boolean ? $this->GET[$key] : null;
        return $get;
    }

    function pget($key) /* Protected Get */
    {
        $boolean = array_key_exists($key, $this->GET);
        $get = $boolean ? $this->GET[$key] : null;

        $getTst = preg_match("/^[A-Za-z0-9]+$/", $get);

        if (!$getTst)
           return null;

        return $get;
    }

    function post($key)
    {
        $boolean = array_key_exists($key, $this->POST);
        $post = $boolean ? $this->POST[$key] : null;
        return $post;
    }

    function postBB($key)
    {
        $boolean = array_key_exists($key, $this->POST);
        $post = $boolean ? $this->POSTBB[$key] : null;
        return $post;
    }
}

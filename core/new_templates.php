<?

class new_templates {
    var $vars;
    var $html;
    var $filesIgnoring = array('.', '..');

    function __construct($value, $desing = false, $restyle = null)
    {
        $this->file   = $value;
        $this->desing = $desing;
        $this->restyle = $restyle;
        $this->vars = new stdClass;
        $this->html = ' ';
    }
    
    function Set($name, $value)
    {
        //$this->vars = new stdClass;
        //$this->vars->$name = new stdClass;
        $this->vars->$name = $value;
    }

    function make()
    {
        return self::complieVars($this->file);
    }

    function complieVars($file)
    {
        if ($this->desing)
            $fileHTML = self::getContentDesing();
        else
            $fileHTML = file_get_contents($file);
            
        if ($this->vars)
        {
            foreach ($this->vars AS $key => $value)
            {
                $fileHTML = str_replace('{$' . $key . '}', $value , $fileHTML);
            }
        }

        return $fileHTML;
    }
    
    function GetStyle()
    {
        $isStyle = is_dir(STYLE_DIRECTORY . $this->restyle . '/');
        return $isStyle ? STYLE_DIRECTORY . $this->restyle . '/' : STYLE_DIRECTORY .  DEFAULT_STYLE;
    }

    function getContentDesing()
    {
        $html = '';

        $openStyle = $this->restyle ? self::GetStyle() : STYLE_DIRECTORY .  DEFAULT_STYLE;

        $files1 = scandir($openStyle);

        foreach ($files1 as $key => $value)
        {
            if (!in_array($value, $this->filesIgnoring))
            {
                $openFile = $openStyle . $value;

                if (is_file($openFile))
                {
                    $html .= file_get_contents($openFile);
                }
            }
        }

        return $html;
    }
}
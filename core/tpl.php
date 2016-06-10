<?

class tpl {
    var $_echo;
    var $html;
    var $modules;

    function __construct($core) 
    {
        $this->core = $core;
        $this->core->module = new stdClass;
        $this->modules      = array();
        $this->html = '';
    }

    function loadModuleError($errorid)
    {
        switch($errorid)
        {
            case 404: self::openModuleId('404'); break;
            case 503: self::openModuleId('503'); break;
            return 0;
        }
        return 0; 
    }

    function loadModule()
    {
        $moId = $this->core->session->getPageId() ? $this->core->session->getPageId() : DEFAULT_MODULE;
        $obj  = self::checkModule($moId);

        $errorid = self::openModuleId($obj);
    }

    function checkModule($moId)
    {
        $filesIgnoring = array('.', '..', 'index.php', 'core.php');
        $obj = new stdClass;

        $moduleDir = MODULES_DIRECTORY;
        $files1    = scandir($moduleDir);

        foreach ($files1 as $key => $value)
        {
            if (!in_array($value, $filesIgnoring))
            {
                $openFile = $moduleDir . $value . '/' . FILEMO_NAME;
                if (is_file($openFile))
                {
                    $this->modules[$value] = $openFile;
                    if (mb_strtolower($moId) == mb_strtolower($value) || (mb_strtolower($moId) == 'home' && mb_strtolower($value) == mb_strtolower(DEFAULT_MODULE)))
                    {
                        $obj->name = $value;
                        $obj->file = $openFile;

                        return $obj;
                        break;
                    }
                }
            }
        }

        $obj->name = '404';
        $obj->file = $moduleDir . '404' . '/' . FILEMO_NAME;

        return $obj;
    }

    function openModuleId($obj)
    {
        include $obj->file;
        $this->core->module->name = $obj->name;
                
        $this->core->module->object = new objectModule($this->core);

        if (method_exists($this->core->module->object,'main'))
        {
            ob_start(); // Начинаем буферизировать вывод
                    
            $this->core->module->object->main();
                    
            $getHTML = ob_get_contents(); // Собираем буфер в переменную
                    
            ob_end_clean(); // Чистим буфер
                    
            $this->html .= $getHTML; // Передаем буфер в общий вывод
            $this->html .= $this->core->module->object->_echo;
        }
    }

    function initTpl($tpl = NULL)
    {
        $tpl     = $tpl == NULL ? $this->core->module->name : $tpl;
        $tplFile = TEMPLATES_DIRECTORY . $this->core->module->name . '/' . $tpl . '.' . EXTENSION_TPL;

        if (is_file($tplFile))
        {
            $newObject = new new_templates($tplFile);

            return $newObject;
        }
        else
        {
            return false;
        }
    }

    function make($object = null, $return = false)
    {
        if (!$object)
        {
            $this->_echo .= "Ошибка. Объект не указан, или указан неверно. parent::make(\$object);<br>";
            return false;
        }

        if ($return)
        {
            return $object->make();
        }
        else
        {
            $this->_echo .= $object->make();
        }

        unset ($object);
    }

    function _echo($output)
    {
        $this->_echo .= $output;
    }

    function getEcho()
    {
        return $this->html;
    }

    function smake($obj)
    {
        $this->_echo .= $obj->_echo;
    }
}

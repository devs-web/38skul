<?

class io {
    function __construct($core) 
    {
        $this->core = $core;
    
    
    }
    
    function loadModuleError($errorid) { return 0; }

    function loadModule()
    {
        $session = $this->core->session;
        $moId = $session->getPageId() ? $session->getPageId() : DEFAULT_MODULE;

        $errorid = self::openModuleId($moId);
        self::loadModuleError($errorid);
    }

    function openModuleId($moduleName)
    {
        $fileModule = MODULES_DIRECTORY . $moduleName . '/' . FILEMO_NAME;
        $includeMO  = file_exists($fileModule);
        if ($includeMO)
        {
            if (is_file($fileModule))
            {
                include $fileModule;
                $this->core->module->name = $moduleName;
                
                $this->core->module->object = new objectModule($this->core);
                if (method_exists($this->core->module->object,'main'))
                {
                    $this->core->module->object->main();
                    $this->vars = $this->core->module->object->vars;

                    self::setWorkAreaHTML();

                    echo $this->vars->html;
                }

                return 200;
            }
            else return 500;
        }
        else return 404;
    }




}
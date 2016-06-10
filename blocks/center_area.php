<?

class center_area_block {
    var $html;
    function __construct($core)
    {
        $this->core = $core;
        self::main();
    }
    
    function main()
    {
        // object create templates
        $tpl  = new tpl($this->core);

        // load module found in object template
        $tpl->loadModule();

        // get output
        $html = $tpl->getEcho();

        // write output in collector
        $this->html = $html;
        
        // clean memory
        unset($io);
    }
}

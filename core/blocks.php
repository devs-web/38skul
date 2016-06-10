<?

class blocks {
    var $filesIgnoring = array('.', '..');
    var $blocks;

    function __construct($core)
    {
        $this->core = $core;
        $this->blocks = new stdClass;
        self::main();
    }

    function main()
    {
        self::createObjectsBlocks();
        self::createFullPage();
    }

    function getFileName ($file)
    {
        $posFileType  = strripos($file, '.');
        $fileName     = substr($file, 0, $posFileType);
        return $fileName;
    }

    function createObjectsBlocks()
    {
        $files1 = scandir(BLOCKS_DIRECTORY);
        foreach ($files1 as $key => $value)
        {
            if (!in_array($value, $this->filesIgnoring))
            {
                $openFile = BLOCKS_DIRECTORY . $value;

                if (is_file($openFile))
                {
                    include_once ($openFile);
                    $blockName = self::getFileName ($value);
                    $className = $blockName . '_block';                    
                    $this->blocks->$blockName = new $className ($this->core);
                }
            }
        }
    }

    function createFullPage()
    {
        $style = $this->core->values->pget('style');

        $template = new new_templates(null, true, $style);

        foreach ($this->blocks AS $key => $value)
        {
            $template->Set($key, $value->html);
        }

        $this->core->echo_html = $template->make();
        unset($template);
    }
}
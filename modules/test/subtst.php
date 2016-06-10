<?

class subtesttest extends tpl {

    function __construct($core)
    {
        $this->core = $core;
        echo "123";
        $tpl = parent::initTpl();
        var_dump(parent::make($tpl, 1));
    }



}
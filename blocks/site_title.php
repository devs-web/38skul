<?

class site_title_block {
    var $html;
    function __construct($core)
    {
        $this->html = "Новости";
    }
    
    function main()
    {
        return $this->html;
    }
}
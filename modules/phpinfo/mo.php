<?
/* Кодировка */

class objectModule extends tpl {
    function __construct($core)
    {
    }
    
    function main()
    {
        $output = `ps aux --sort -rss | head -50`;
        echo "<pre>$output</pre>";

        phpinfo();
    }
}

<?

class db extends mysqli {
    var $user,
        $password,
        $port,
        $host,
        $db;

    function __construct($host, $user, $password, $db, $charset)
    {
        parent::init();

        if (!parent::real_connect($host, $user, $password, $db))
        {
            die('Ошибка подключения (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }
}
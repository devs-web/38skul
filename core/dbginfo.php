<?

class dbgInfo {
    var $NowUsedRAM,
        $core;

    function __construct($core)
    {
        $this->NowUsedRAM = memory_get_usage();
        $this->core = $core;
    }
    
    function tick_handler()
    {
        echo "tick_handler() выполнено\n";
    }

    function GetDbgRam ()
    {
        $NowRamUsed = memory_get_usage() - $this->NowUsedRAM;
        $NowPeakRamUsed = memory_get_peak_usage() - $this->NowUsedRAM;
        
        $NowRamUsed     = $NowRamUsed / 1024;
        $NowPeakRamUsed = $NowPeakRamUsed / 1024;
        
        return "<!-- Текущая нагрузка на ОЗУ: $NowRamUsed кб \n<br>Пиковая нагрузка на ОЗУ: $NowPeakRamUsed  кб -->";
        
    }
}
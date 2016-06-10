<?

class left_area_block {
    var $html;
    function __construct($core)
    {
        /*$this->html = "<div id=\"Docs\" class=\"NormalBlock\"><z id=\"FPDPN\">Учащимся и родите - лям</z></div><div id=\"PhotoGallery\" class=\"NormalBlock\"><z id=\"FPDPN\">Воспита - тельная работа</z></div>
     <div id=\"DopMenu\" class=\"BigMetroBlock\"><z id=\"FPDPB\">Сведения об образовательной организации</z></div>
     <div id=\"Announce\" class=\"NormalBlock\"><z id=\"FPDPN\">Анти - коррупция</z></div><div id=\"Search\" class=\"NormalBlock\"><z id=\"FPDPN\">Музей</z></div>
     <div id=\"DopElRes\" class=\"BigMetroBlock\"><z id=\"FPDPB\">Социально-педагогическая служба</z></div>
     <div id=\"Docs\" class=\"NormalBlock\"><z id=\"FPDPN\">Библио - тека</z></div><div id=\"Search\" class=\"NormalBlock\"><z id=\"FPDPN\">Фото - альбом</z></div>
     ";*/
     
        $this->html = '
        <a onclick="return false;" href="/pages/iaeo/"><div id="iaeo" class="MenuButtonv2"><div class="FixPosMenuName">Сведения об образовательной организации</div></div></a>
        <a onclick="return false;" href="/pages/1kl/"><div id="1kl" class="MenuButtonv2"><div class="FixPosMenuName">Прием в первый класс</div></div></a>
        <a onclick="return false;" href="/pages/edwork/"><div id="edwork" class="MenuButtonv2"><div class="FixPosMenuName">Воспитательная работа</div></div></a>
        <a onclick="return false;" href="/pages/students/"><div id="students" class="MenuButtonv2"><div class="FixPosMenuName">Учащимся</div></div></a>
        <a onclick="return false;" href="/pages/parents/"><div id="parents" class="MenuButtonv2"><div class="FixPosMenuName">Родителям</div></div></a>
        <a onclick="return false;" href="/pages/sps/"><div id="sps" class="MenuButtonv2"><div class="FixPosMenuName">Социально-педагогическая служба</div></div></a>
        <a onclick="return false;" href="/pages/lib/"><div id="lib" class="MenuButtonv2"><div class="FixPosMenuName">Библиотека</div></div></a>
        <a onclick="return false;" href="/pages/Museum/"><div id="Museum" class="MenuButtonv2"><div class="FixPosMenuName">Музей</div></div></a>
        <a onclick="return false;" href="/pages/gallery/"><div id="gallery" class="MenuButtonv2"><div class="FixPosMenuName">Фотоальбом</div></div></a>
        <a onclick="return false;" href="/pages/Anticorruption/"><div id="Anticorruption" class="MenuButtonv2"><div class="FixPosMenuName">Антикоррупция</div></div></a>
        <a onclick="return false;" href="/pages/yrc/"><div id="yrc" class="MenuButtonv2"><div class="FixPosMenuName">2016 год - год российского кино</div></div></a>
        <a onclick="return false;" href="/pages/yrc/"><div id="orkse" class="MenuButtonv2"><div class="FixPosMenuName">Изучаем ОРКСЭ</div></div></a>
        <a onclick="return false;" href="/pages/107/"><div id="vpr" class="MenuButtonv2"><div class="FixPosMenuName">Всероссийские проверочные работы</div></div></a>
        <!--<div id="MapSite" class="MenuButtonv2"><div class="FixPosMenuName">Карта сайта</div></div>
        <div id="news" class="MenuButtonv2"><div class="FixPosMenuName">Новости</div></div>-->
        
        
        
        ';
    }
    
    function main()
    {
        return $this->html;
    }
}
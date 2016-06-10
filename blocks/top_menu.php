<?

class top_menu_block {
    var $html;
    function __construct($core)
    {/*
        $this->html = '<div id="Home" class="MenuButtonSelected"><div class="FixPosMenuName">Главная</div></div><div id="Forum" class="MenuButton"><div class="FixPosMenuName">Форум</div></div><div id="Gia" class="MenuButton"><div class="FixPosMenuName">ГИА</div></div><div id="Ege" class="MenuButton"><div class="FixPosMenuName">ЕГЭ</div></div><div id="prepod" class="MenuButton"><div class="FixPosMenuName">Преподаватели</div></div><div class="MenuButton"><div id="schedule" class="FixPosMenuName">Расписание</div></div><div id="charter" class="MenuButton"><div class="FixPosMenuName">Устав</div></div><div id="feedback" class="MenuButton"><div class="FixPosMenuName">Обратная связь</div></div>';
    */
        $this->html = '<a onclick="return false;" href="/home/"><div style="width: 83px" id="Home" class="MenuButton"><div class="FixPosMenuName">Главная</div></div></a><a onclick="return false;" href="/pages/admissions/"><div style="width: 108px" id="Admissions" class="MenuButton"><div class="FixPosMenuName">Приемная</div></div></a><a onclick="return false;" href="/pages/security/"><div style="width: 144px" id="Security" class="MenuButton"><div class="FixPosMenuName">Безопасность</div></div></a><a onclick="return false;" href="/pages/achievements/"><div style="width: 130px" class="MenuButton"><div id="Achievements" class="FixPosMenuName">Достижения</div></div></a><a onclick="return false;" href="/pages/schedule/"><div style="width: 124px" id="schedule" class="MenuButton"><div class="FixPosMenuName">Расписание</div></div></a><a onclick="return false;" href="/pages/exam/"><div style="width: 91px" id="Exam" class="MenuButton"><div class="FixPosMenuName">Экзамен</div></div></a><div style="width: 40px; text-align: center;" onclick="document.getElementById(\'searcher\').style.opacity = \'1\';" id="lookup" class="MenuButton"><div style="width: 40px; text-align: center;" class="FixPosMenuName"><img style="width: 30px; height: 30px;" src="//web-rubiks.ru/school38/images/search.png" /></div></div>';
    }
    
    function main()
    {
        return $this->html;
    }
}
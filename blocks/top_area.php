<?

class top_area_block {
    var $html;
    function __construct($core)
    {
        $this->core = $core;
        self::main();
    }
    
    function main()
    {
        $autch = $this->core->session->getAutch();

        if ($autch == true)
        {
            $fio      = $this->core->session->getName();
            $username = $this->core->session->getUsername();
            
            $myName = $fio != null && $fio != '' ? $fio : $username;

            $this->html = '<div class="WelcomeBlock">Добро пожаловать, ' . $myName . '!</div><div onclick="AddToUrl (\'/lk/\');" class="buttonReg button_1">Личный кабинет</div><div onclick="DeAutch();" class="buttonReg button_1">Выход</div>';
        }
        else
        {
            $this->html = '<input placeholder="Имя пользователя" id="input_username" class="inputJoinLK" /><input placeholder="Пароль" id="input_password" type="password" class="inputJoinLK" /><div onclick="Autch();" class="RegRecLKU ButtonAnimation button_1">Войти</div><div onclick="openRegister();" class="RegRecLKU button_1">Регистрация</div><div class="RegRecLKU button_1">Забыли пароль?</div>';
        }

    }
}

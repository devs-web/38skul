$(document).ready(function()
{
    setInterval('Time()',500);
    _img_status = 1;
    _fontSize   = 0;
    _lineSpace  = 0;
    _fontfamily = 0;
    
    setTimeout(function() {
        if (getCookie('vvi') == 1)
        {
            _img_status = getCookie('vviimg');
            _fontSize = getCookie('vvisize');
            _lineSpace = getCookie('vvispace');
            _fontfamily = getCookie('vvifamily');
            document.getElementById('BlockVVI').style.display = 'block';


            vvi(getCookie('vvicolor'));
            console.log('vvi color: '+getCookie('vvicolor'));
        }
    
    
    }, 500);



    lastlocation = window.location.pathname;
    setInterval(function()
    {
        if (lastlocation != window.location.pathname)
        {
            AddToUrl (window.location.pathname, nohistory = true)
        }
    }
    , 200);
    //nicEditors.allTextAreas();

    
    colorSet = false;
    reInit();
    /*setInterval(function ()
    {
        if(colorSet == false)
        {
            document.getElementById("TitleBlock").style.background = '#00B0F0 none repeat scroll 0% 0%';
            document.getElementById("MenuBlock").style.background = '#00B0F0 none repeat scroll 0% 0%';
            document.getElementById("LeftArea").style.background = '#00B0F0 none repeat scroll 0% 0%';
            colorSet = true;
        }
        else
        {
            document.getElementById("TitleBlock").style.background = '#3888BF none repeat scroll 0% 0%';
            document.getElementById("MenuBlock").style.background = '#3888BF none repeat scroll 0% 0%';
            document.getElementById("LeftArea").style.background = '#3888BF none repeat scroll 0% 0%';
            colorSet = false;
        }
    
    
    }
    , 2000);*/
    
    setInterval(function () {
        var doc = document.getElementById('fullimage');
        var imgfull = document.getElementById('imgfull');
        
        if(!imgfull)
            return;

        myWidth = window.innerWidth - 100;
        myHeight = window.innerHeight - 100;

        imgfull.style.maxWidth = myWidth +'px';
        imgfull.style.maxHeight = myHeight +'px';

        var width = imgfull.offsetWidth;
        var height = imgfull.offsetHeight;
        
        
        var _width = (myWidth - width) / 2;
        var _height = (myHeight - height) / 2;

        doc.style.left = _width +'px';
        doc.style.top = _height +'px';
    }, 25);
    


});

var exp = new Object();
exp.expires = 2592000;
exp.path = '/';
exp.domain = 'xn--38-8kc3bfr2e.xn--p1ai';

function notka(text, type, pos)
{ 
    switch (type)
    {
        case 0: type = 'notification'; break;
        case 1: type = 'warning'; break;
        case 2: type = 'error'; break;
        case 3: type = 'information'; break;
        case 4: type = 'success'; break;
        default: type = 'notification'; break;
    }

    switch (pos)
    {
        case 0: pos = 'topCenter'; break;
        case 1: pos = 'center'; break;
        case 2: pos = 'bottomCenter'; break;
        case 3: pos = 'inline'; break;
        case 4: pos = 'topLeft'; break;
        case 5: pos = 'topRight'; break;
        case 6: pos = 'bottomLeft'; break;
        case 7: pos = 'bottomRight'; break;
        case 8: pos = 'centerLeft'; break;
        case 9: pos = 'centerRight'; break;
        case 10: pos = 'bottom'; break;
        default: pos = 'bottomLeft'; break;
    }


    noty({
        layout: pos,
        theme: 'relax', // or 'relax'
        type: type,
        text: text, // can be html or string
        dismissQueue: true, // If you want to use queue feature set this true
        template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
        animation: {
            open: 'animated bounceInLeft', // Animate.css class names
            close: 'animated bounceOutLeft', // Animate.css class names
            easing: 'swing',
            speed: 500 // opening & closing animation speed
        },
        timeout: 5000, // delay for closing event. Set false for sticky notifications
        force: false, // adds notification to the beginning of queue when set to true
        modal: false,
        maxVisible: 5, // you can set max visible notification for dismissQueue true option,
        killer: false, // for close all notifications before show
        closeWith: ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications
        callback: {
            onShow: function() {},
            afterShow: function() {},
            onClose: function() {},
            afterClose: function() {},
            onCloseClick: function() {},
        },
        buttons: false // an array of buttons
    });

}

function sendMess(key, id)
{
    var text = $('#input_text').val();

    $.ajax({
        type: "POST",
        url: "//"+window.location.host+"/api/?style=clear",
        data:
        {
            "type": 'sendmessage',
            "text": text,
            "key": key,
            "id": id
        },
        dataType: 'json',
        success: function (result)
        {
            if(result.error == 0)
            {
                AddToUrl (window.location.pathname);
                errormsg.commentsend();
            }
            else
            {
                errormsg.errorSendMessage();
            }
        }
    });
}

function errormsg()
{
    this.commentsend = function() { notka("Комментарий отправлен и находится на модерации.", 4, 6); }
    this.Autched = function() { notka("Добро пожаловать!", 4, 6); }
    this.deAutched = function() { notka("Вы вышли из системы!", 2, 6); }
    this.saveUser = function() { notka("Данные сохранены!", 4, 6); }
    this.errorSendMessage = function() { notka("Сообщение не было отправлено.", 2, 6); }
    this.notAutch = function() { notka("Комбинация логина и пароля не найдена!", 2, 6); }
    this.fileLoad = function() { notka("Файл загружен", 4, 6); }
    this.fileNoLoad = function() { notka("Файл не загружен. Допустимы форматы только: .doc, .docx, .pdf, .ppt, .pptx, .jpg, .png, .gif, .rar, .zip", 2, 6); }

    this.newscreate = function() { notka("Новость создана", 4, 6); }
    this.newscreatemoderate = function() { notka("Новость создана и отправлена на модерацию", 3, 6); }
    this.newsupdate = function() { notka("Новость обновлена", 3, 6); }
    this.newserror = function() { notka("Новость не создана", 2, 6); }

    this.pagecreate = function() { notka("Страница создана", 4, 6); }
    this.pagecreatemoderate = function() { notka("Страница создана и отправлена на модерацию", 3, 6); }
    this.pageupdate = function() { notka("Страница обновлена", 3, 6); }


    this.strinputmin = function() { notka("Не все поля заполнены, либо длина менее 3х символов.", 2, 6); }
    this.minrank = function() { notka("Недостаточно доступа. Действие занесено в журнал с прекреплением IP адреса и данных пользователя.", 2, 6); }
    
    this.pagedelete = function(msg) { notka("Страниц удалено: " + msg, 3, 6); }
    this.pagenodelete = function() { notka("Страницы не удалены, т.к. не были найдены. Неизвестная ошибка.", 3, 6); }
}

var errormsg = new errormsg();

function Autch()
{
    var username = $('#input_username').val();
    var password = $('#input_password').val();

    $.ajax({
        type: "POST",
        url: "//"+window.location.host+"/api/?style=clear",
        data:
        {
            "type": 'autch',
            "username": username,
            "password": password
        },
        dataType: 'json',
        success: function (result)
        {
            if(result.autch == 1)
            {
                var myname = result.myname;
                document.getElementById("JoinLkBlock").innerHTML = '<div class="WelcomeBlock">Добро пожаловать, ' + myname + '!</div><div onclick="AddToUrl (\'/lk/\');" class="buttonReg button_1">Личный кабинет</div><div onclick="DeAutch();" class="buttonReg button_1">Выход</div>';
                AddToUrl (window.location.pathname);
                errormsg.Autched();
            }
            else
            {
                document.getElementById("JoinLkBlock").innerHTML = '<div class="errorLogin">Комбинация логина или пароля не верна!</div>';
                errormsg.notAutch();
                setTimeout(function ()
                    {
                        document.getElementById("JoinLkBlock").innerHTML = '<input placeholder="Имя пользователя" value="'+username+'" id="input_username" class="inputJoinLK" /><input placeholder="Пароль" value="'+password+'" id="input_password" type="text" class="inputJoinLK" /><div onclick="Autch();" class="RegRecLKU ButtonAnimation button_1">Войти</div><div onclick="openRegister();" class="RegRecLKU button_1">Регистрация</div><div class="RegRecLKU button_1">Забыли пароль?</div>';
                    }, 3000);
            }
        }
    });
}

function DeAutch()
{
    $.ajax({
        type: "POST",
        url: "//"+window.location.host+"/api/?style=clear",
        data:
        {
            "type": 'deautch'
        },
        dataType: 'json',
        success: function (result)
        {
            if(result.autch == 0)
            {
                document.getElementById("JoinLkBlock").innerHTML = '<input placeholder="Имя пользователя" id="input_username" class="inputJoinLK" /><input placeholder="Пароль" id="input_password" type="password" class="inputJoinLK" /><div onclick="Autch();" class="RegRecLKU ButtonAnimation button_1">Войти</div><div onclick="openRegister();" class="RegRecLKU button_1">Регистрация</div><div class="RegRecLKU button_1">Забыли пароль?</div>';
                AddToUrl (window.location.pathname);
                errormsg.deAutched();
            }
        }
    });
}

function openRegister()
{

    var blockPopWindow = document.getElementById("blockPopWindow");
    var backgroundreg = document.getElementById("backgroundreg");

    var openUrl = '/reg/?style=clear';

    setTimeout (function (){
        var req = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject( 'Microsoft.XMLHTTP' );
        req.open( 'GET', openUrl, true );
        req.onreadystatechange = function () {

        if ( req.readyState == 4 ) {
            if ( req.status == 200 ) {
                blockPopWindow.innerHTML = req.responseText;
                setTimeout (function () {
                    blockPopWindow.style.visibility = 'visible'; 

                    var top = $('#FormRegistration').offset().top - 50;
                    $('html, body').animate({scrollTop: top}, 300);
            
            }, 0);}}};

        req.send( null );}, 200);
}

function closeRegister()
{
    var blockPopWindow = document.getElementById("blockPopWindow");
    blockPopWindow.style.visibility = 'hidden';
}

function register()
{
    var reg_name       = document.getElementById("reg_name").value;
    var reg_last_name  = document.getElementById("reg_last_name").value;
    var reg_username   = document.getElementById("reg_username").value;
    var reg_email      = document.getElementById("reg_email").value;
    var reg_password1  = document.getElementById("reg_password1").value;
    var reg_password2  = document.getElementById("reg_password2").value;
    var reg_birthDay   = document.getElementById("reg_birthDay").value;
    var reg_birthMonth = document.getElementById("reg_birthMonth").value;
    var reg_birthYear  = document.getElementById("reg_birthYear").value;
    var reg_gender     = document.getElementById("reg_gender1").checked == true ? 0 : 1;

    var error1  = document.getElementById("error1");
    var error2  = document.getElementById("error2");
    var error3  = document.getElementById("error3");
    var error4  = document.getElementById("error4");

    error1.style.visibility = 'hidden';
    error2.style.visibility = 'hidden';        
    error3.style.visibility = 'hidden';        
    error4.style.visibility = 'hidden';        

    if (reg_password1 != reg_password2)
    {
        error3.style.visibility = 'visible';
        error4.style.visibility = 'visible';        
        error3.innerHTML = 'Пароли не совпадают';
        error4.innerHTML = 'Пароли не совпадают';
        return 0;
    }

    $.ajax({
        type: "POST",
        url: "//"+window.location.host+"/api/?style=clear",
        data:
        {
            "type": 'register',
            "reg_name": reg_name,
            "reg_last_name": reg_last_name,
            "reg_username": reg_username,
            "reg_email": reg_email,
            "reg_password": reg_password1,
            "reg_birthDay": reg_birthDay,
            "reg_birthMonth": reg_birthMonth,
            "reg_birthYear": reg_birthYear,
            "reg_gender": reg_gender,
        },
        dataType: 'json',
        success: function (result)
        {
            if(result.register.error == 1)
            {
                if (result.register.email == 1)
                {
                    error2.style.visibility = 'visible';        
                    error2.innerHTML = 'Недопустимый e-mail';
                }
                else if (result.register.email == 2)
                {
                    error2.style.visibility = 'visible';        
                    error2.innerHTML = 'e-mail занят';
                }
                
                if (result.register.login == 1)
                {
                    error1.style.visibility = 'visible';        
                    error1.innerHTML = 'Недопустимый логин';
                }
                else if (result.register.login == 2)
                {
                    error1.style.visibility = 'visible';        
                    error1.innerHTML = 'Логин занят';
                }

                if (result.register.password == 1)
                {
                    error3.style.visibility = 'visible';        
                    error4.style.visibility = 'visible';        
                    error3.innerHTML = 'Недопустимый пароль';
                    error4.innerHTML = 'Недопустимый пароль';
                }
            }
            else if (result.register.error == 0)
            {
                var myname = result.myname;
                closeRegister();
                errormsg.Autched();
                document.getElementById("JoinLkBlock").innerHTML = '<div class="WelcomeBlock">Добро пожаловать, ' + myname + '!</div><div onclick="AddToUrl (\'/lk/\');" class="buttonReg button_1">Личный кабинет</div><div onclick="DeAutch();" class="buttonReg button_1">Выход</div>';
                AddToUrl (window.location.pathname);
            }
            else if (result.register.error == 3)
            {
                    error1.style.visibility = 'visible';        
                    error2.style.visibility = 'visible';        
                    error3.style.visibility = 'visible';        
                    error4.style.visibility = 'visible';        

                    error1.innerHTML = 'Вы заблокированы на данном сайте. Можете даже не пытаться регистрироваться.';
                    error2.innerHTML = 'Вы заблокированы на данном сайте. Можете даже не пытаться регистрироваться.';
                    error3.innerHTML = 'Вы заблокированы на данном сайте. Можете даже не пытаться регистрироваться.';
                    error4.innerHTML = 'Вы заблокированы на данном сайте. Можете даже не пытаться регистрироваться.';
            }
        }
    });
}

function SaveProfUser()
{
    var reg_name       = document.getElementById("reg_name").value;
    var reg_last_name  = document.getElementById("reg_last_name").value;
    var reg_password1  = document.getElementById("reg_password1").value;
    var reg_password2  = document.getElementById("reg_password2").value;
    var reg_birthDay   = document.getElementById("reg_birthDay").value;
    var reg_birthMonth = document.getElementById("reg_birthMonth").value;
    var reg_birthYear  = document.getElementById("reg_birthYear").value;
    var reg_gender     = document.getElementById("reg_gender1").checked == true ? 0 : 1;

    var error3  = document.getElementById("error3");
    var error4  = document.getElementById("error4");

    error3.style.visibility = 'hidden';        
    error4.style.visibility = 'hidden';        

    if (reg_password1 != reg_password2)
    {
        error3.style.visibility = 'visible';
        error4.style.visibility = 'visible';        
        error3.innerHTML = 'Пароли не совпадают';
        error4.innerHTML = 'Пароли не совпадают';
        return 0;
    }

    $.ajax({
        type: "POST",
        url: "//"+window.location.host+"/api/?style=clear",
        data:
        {
            "type": 'resaveuser',
            "reg_name": reg_name,
            "reg_last_name": reg_last_name,
            "reg_password": reg_password1,
            "reg_birthDay": reg_birthDay,
            "reg_birthMonth": reg_birthMonth,
            "reg_birthYear": reg_birthYear,
            "reg_gender": reg_gender
        },
        dataType: 'json',
        success: function (result)
        {
            if(result.register.error == 1)
            {
                if (result.register.password == 1)
                {
                    error3.style.visibility = 'visible';        
                    error4.style.visibility = 'visible';        
                    error3.innerHTML = 'Недопустимый пароль';
                    error4.innerHTML = 'Недопустимый пароль';
                }
            }
            else if (result.register.error == 0)
            {
                var myname = result.myname;
                document.getElementById("JoinLkBlock").innerHTML = '<div class="WelcomeBlock">Добро пожаловать, ' + myname + '!</div><div onclick="AddToUrl (\'/lk/\');" class="buttonReg button_1">Личный кабинет</div><div onclick="DeAutch();" class="buttonReg button_1">Выход</div>';
                AddToUrl (window.location.pathname);
                errormsg.saveUser();
            }
        }
    });
}

function reInit()
{
$(function() {
  $("#texteditor1").wysibb();
})
}

window.onload = function ()
{
    document.getElementById('Home').onclick = function (event){ AddToUrl("/home/");}  
    document.getElementById('Admissions').onclick = function (event){ AddToUrl("/pages/admissions/");}  
    document.getElementById('Security').onclick = function (event){ AddToUrl("/pages/security/");}  
    document.getElementById('Achievements').onclick = function (event){ AddToUrl("/pages/achievements/");}  
    document.getElementById('schedule').onclick = function (event){ AddToUrl("/pages/schedule/");}  
    document.getElementById('1kl').onclick = function (event){ AddToUrl("/pages/1kl/");}  


   // document.getElementById('news').onclick = function (event){ AddToUrl("/news/");}
    document.getElementById('iaeo').onclick = function (event){ AddToUrl("/pages/iaeo/");}
    document.getElementById('sps').onclick = function (event){ AddToUrl("/pages/sps/");}
    document.getElementById('yrc').onclick = function (event){ AddToUrl("/pages/yrc/");}
    document.getElementById('edwork').onclick = function (event){ AddToUrl("/pages/edwork/");}
    document.getElementById('Anticorruption').onclick = function (event){ AddToUrl("/pages/Anticorruption/");}
    //document.getElementById('MapSite').onclick = function (event){ AddToUrl("/pages/cat/MapSite/");}
    document.getElementById('lib').onclick = function (event){ AddToUrl("/pages/lib/");}
    document.getElementById('gallery').onclick = function (event){ AddToUrl("/pages/gallery/");}
    document.getElementById('parents').onclick = function (event){ AddToUrl("/pages/parents/");}
    document.getElementById('students').onclick = function (event){ AddToUrl("/pages/students/");}
    document.getElementById('Museum').onclick = function (event){ AddToUrl("/pages/Museum/");}
    document.getElementById('Exam').onclick = function (event){ AddToUrl("/pages/exam/");}

    document.getElementById('orkse').onclick = function (event){ AddToUrl("/pages/orkse/");}

    document.getElementById('vpr').onclick = function (event){ AddToUrl("/pages/107/");}


/*
    document.getElementById('fullcontent').onclick = function (event){
        document.getElementById('searcher').style.opacity = '0';

    
    
    }*/

}  



function AddToUrl (EventId, nohistory, and)
{
    var speed = 300;
    var top = $('#MenuBlock').offset().top - 50;
    $('html, body').animate({scrollTop: top}, speed);

    nohistory = typeof nohistory !== 'undefined' ?  nohistory : false;
    and = typeof and !== 'undefined' ?  '&' : '?';

    if (!nohistory)
        history.pushState(null, null, EventId);

    lastlocation = EventId;
    console.log(lastlocation);

    var openUrl = EventId + and+'style=clear';
    //console.log(openUrl);

    var CenterA = document.getElementById('CenterA');
    CenterA.style.opacity = '0';

    setTimeout (function (){
        var req = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject( 'Microsoft.XMLHTTP' );
        req.open( 'GET', openUrl, true );
        req.onreadystatechange = function () {

        if ( req.readyState == 4 ) {
            if ( req.status == 200 || req.status == 404 || req.status == 503 || req.status == 500) { CenterA.innerHTML = req.responseText; setTimeout (function () { CenterA.style.opacity = '1'; }, 0); reInit(); /*nicEditors.allTextAreas();*/ }}};

        
        req.send( null );}, 200);
}


function GetMonthName (id)
{
    switch (id)
    {
        case 0: return "январь"; break;
        case 1: return "февраль"; break;
        case 2: return "март"; break;
        case 3: return "апрель"; break;
        case 4: return "май"; break;
        case 5: return "июнь"; break;
        case 6: return "июль"; break;
        case 7: return "август"; break;
        case 8: return "сентябрь"; break;
        case 9: return "октябрь"; break;
        case 10: return "ноябрь"; break;
        case 11: return "декабрь"; break;
    }
}

function Time()
{
    var _Time = new Date();

    document.getElementById("houres").innerHTML = _Time.getHours() > 9 ? _Time.getHours() : "0" + _Time.getHours();
    document.getElementById("Minutes").innerHTML = _Time.getMinutes() > 9 ? _Time.getMinutes() : "0" + _Time.getMinutes();
    document.getElementById("Year").innerHTML = _Time.getFullYear();
    document.getElementById("Date").innerHTML = _Time.getDate();
    document.getElementById("Month").innerHTML = GetMonthName(_Time.getMonth());

    var secBlink = document.getElementById("secBlink");
    if (secBlink.innerHTML == ":")
        secBlink.innerHTML = "&nbsp;";
    else
        secBlink.innerHTML = ":";
}

var _file = new _files();
var _newform = false;

function loadfile(newform)
{
    newform = typeof newform !== 'undefined' ?  newform : false;
    _newform = newform;

    _file.clickForm();
}

function _files()
{
    this.input_text = document.getElementById('input_text');

    this.load = function()
    {
        //document.getElementById('input_text').disabled = "disabled";
        
        $.ajax({
            type: "POST",
            url: "//"+window.location.host+"/api/?style=clear",
            data:
            {
                "type": 'gettokens'
            },
            dataType: 'json',
            success: function (result)
            {
                if (result.error == 0)
                {
                    var token1 = result.token1;
                    var token2 = result.token2;

                    document.getElementById('token1').value = token1;
                    document.getElementById('token2').value = token2;
                    console.log("token1: " + token1);
                    console.log("token2: " + token2);

                    document.getElementById('my_hidden_load').click();
                }
                else
                {


                }
            }
        });
    }

    this.clickForm = function()
    {
        document.getElementById('files').click();
    }
    
    this.readFrame = function()
    {
        var token1 = document.getElementById('token1').value;
        var token2 = document.getElementById('token2').value;

        $.ajax({
            type: "POST",
            url: "//"+window.location.host+"/api/?style=clear",
            data:
            {
                "type": 'gettokenresult',
                "token1": token1,
                "token2": token2
            },
            dataType: 'json',
            success: function (result)
            {
                if (result.code)
                    console.log(result.code);

                if (result.code == 10)
                {
                    var doc = document.getElementById('input_text');
                    if (_newform)
                    {
                        var txt = doc.innerHTML;
                        var img = new Image();

                        img.onload = function()
                        {      
                            var width = this.width;
                            var hight = this.height;
                            
                            var _width = width / 300;
                            var _hight = hight / 600;
                            
                            
                            if (width > 300 || hight > 600)
                            {
                                if (_width > _hight)
                                {
                                    width = width / _width;
                                    hight = hight / _width;
                                }
                                else if (_width < _hight)
                                {
                                    width = width / _hight;
                                    hight = hight / _hight;
                                }
                                else
                                {
                                    width = 300;
                                    hight = 300;
                                }
                            }
                                console.log("x: " + width + "y: " + hight)

                            doc.innerHTML = txt + ' <img class="LoadedImg" src=' + result.respond + ' width="'+ width +'" height="'+ hight +'" />';
                        }     
                        img.src = result.respond;
                        _newform = false;
                    }
                    else
                    {
                        var txt = doc.value;
                        doc.value = txt + ' [img]' + result.respond + '[/img]';
                    }

                    errormsg.fileLoad();
                }
                else if (result.code == 11)
                {
                    var doc = document.getElementById('input_text');

                    if (_newform)
                    {
                        var txt = doc.innerHTML;
                        doc.innerHTML = txt + ' [url='+ result.respond +']' + result.name + '[/url]';
                        _newform = false;
                    }
                    else
                    {
                        var txt = doc.value;
                        doc.value = txt + ' [url='+ result.respond +']' + result.name + '[/url]';
                    }
                    errormsg.fileLoad();
                }
                else
                {
                    //errormsg.fileNoLoad();
                    //console.log("Код ошибки: " + result.code);
                }
            }        
        });
        //document.getElementById('input_text').disabled = "";
    }
}

function createPage(text, title, type, pgid, method)
{
    pgid = typeof pgid !== 'undefined' ?  pgid : 0;
    method = typeof method !== 'undefined' ?  method : 0;

    console.log(text);
    console.log(title);
    console.log(type);
    console.log(pgid);
    
    $.ajax({
        type: "POST",
        url: "//"+window.location.host+"/api/?style=clear",
        data:
        {
            "type": 'page',
            "subtype": type,
            "text": text,
            "title": title,
            "pgid": pgid,
            "method": method,
        },
        dataType: 'json',
        success: function (result)
        {
            console.log(result);
            if(result.error == 0)
            {
                if (result.type == 1)
                    errormsg.newscreate();

                if (result.type == 2)
                    errormsg.newscreatemoderate();
                
                if (result.type == 3)
                    errormsg.newsupdate();
                
                AddToUrl('/news/');
            }
            else
            {
                errormsg.newserror();
                console.log(result.error);
            }
        }
    });





}



function createPg(text, title, subtype, pgid, method)
{
    //type   = typeof type !== 'undefined' ?  type : 0;
    pgid    = typeof pgid !== 'undefined' ?  pgid : 0;
    method  = typeof method !== 'undefined' ?  method : 0;
    subtype = typeof subtype !== 'undefined' ?  subtype : 0;
    
    var lastpg = window.location.pathname;

    console.log(text);
    console.log(title);
    console.log(subtype);
    console.log(pgid);
    console.log(method);

    $.ajax({
        type: "POST",
        url: "//"+window.location.host+"/api/?style=clear",
        data:
        {
            "type":   'pages',
            "subtype": subtype,
            "text":    text,
            "title":   title,
            "pgid":    pgid,
            "method":  method,
        },
        dataType: 'json',
        success: function (result)
        {
            console.log(result);
            switch(result.error)
            {
                case 0:
                {
                    switch(result.type)
                    {
                        case 1:
                        {
                            errormsg.pagecreate();
                            AddToUrl('/pages/'+ result.url + '/');
                        }   break;
                    
                        case 2:
                        {
                            errormsg.pageupdate();
                            AddToUrl('/pages/'+ result.url + '/');
                        }   break;
                    
                        case 3:
                        {
                            errormsg.pagecreatemoderate();
                            AddToUrl('/pages/'+ result.url + '/');
                        }   break;
                        
                        case 4:
                        {
                            errormsg.newscreate();
                            AddToUrl('/pages/'+ result.url + '/');
                        }   break;
                    
                        case 5:
                        {
                            errormsg.newsupdate();
                            AddToUrl('/pages/'+ result.url + '/');
                        }   break;
                    
                        case 6:
                        {
                            errormsg.newscreatemoderate();
                            AddToUrl('/pages/'+ result.url + '/');
                        }   break;

                        case 7:
                        {
                            errormsg.pagedelete(result.affected);
                            AddToUrl(lastpg);
                        }   break;

                        case 8:
                        {
                            errormsg.pagenodelete();
                            AddToUrl(lastpg);
                        }   break;

                        default: break;
                    }
                }   break;
                case 2: errormsg.strinputmin(); break;
                case 3: errormsg.minrank(); break;
            }
        }
    });
}

function openimg(url, close)
{
    close = typeof close !== 'undefined' ?  close : false;

    var doc = document.getElementById('fullimage');

    if (close)
    {
        document.getElementById('fullimage').style.opacity = '0';
        setTimeout(function () {document.getElementById('fullimage').style.display = 'none';}, 100);
    }

    url = url.replace('mini/', '');

    var img = new Image();

    img.onload = function()
    {
        var doc = document.getElementById('fullimage');
        doc.innerHTML = '<div class="buttonCloseFullImg"><img onclick="openimg(\'\', 1);" style="width: 20px; height: 20px; background: #fff; border-radius: 20px;" src="//web-rubiks.ru/school38/images/close-btn.png" /></div><a href="' + url + '" target="_blank" title="Кликните, для увелечения"><img id="imgfull" style="max-width: 100%; max-height: 100%;" src="' + url + '" /></a>';
        doc.style.opacity = '1';

        var imgfull = document.getElementById('imgfull');

        myWidth = window.innerWidth - 100;
        myHeight = window.innerHeight - 100;

        imgfull.style.maxWidth = myWidth +'px';
        imgfull.style.maxHeight = myHeight +'px';

        var width = imgfull.offsetWidth;
        var height = imgfull.offsetHeight;
        
        
        var _width = (myWidth - width) / 2;
        var _height = (myHeight - height) / 2;

        doc.style.left = _width +'px';
        doc.style.top = _height +'px';
    }

    if (!close)
    {
        img.src = url;
        doc.style.display = 'block';
        doc.innerHTML = '';
    }
}




function vvi (color_id)
{
    var cfgs     = document.getElementById('cfgs');
    var BlockVVI = document.getElementById('BlockVVI');


    console.log('Call: ' + color_id);
    switch (color_id)
    {
        case '0':
            setCookie('vvi', '0', exp);
            cfgs.innerHTML = '';
            document.getElementById('BlockVVI').style.display = 'none';
            return;

        case '1':
             setCookie('vvicolor', '1', exp);
             color_text = '#000000';
             color_block = '#FFFFFF';
            break;
            
        case '2':
             setCookie('vvicolor', '2', exp);
             color_text = '#FFFFFF';
             color_block = '#000000';
            break;
            
        case '3':
             setCookie('vvicolor', '3', exp);
             color_text = '#063462';
             color_block = '#9DD1FF';
            break;
            
        case '4':
             setCookie('vvicolor', '4', exp);
             color_text = '#A9E44D';
             color_block = '#3B2716';
            break;
            
        case '5':
             setCookie('vvicolor', '5', exp);
             color_text = '#3B2716';
             color_block = '#F7F3D6';
            break;
            
        case 6:
             if (_img_status == 1)
                 _img_status = 0;
             else
                 _img_status = 1;
            break;

        case 7: _fontSize = 0; break;
        case 8: _fontSize = 1; break;
        case 9: _fontSize = 2; break;
        case 10: _lineSpace = 0; break;
        case 11: _lineSpace = 1; break;
        case 12: _lineSpace = 2; break;
        case 13: _fontfamily = 0; break;
        case 14: _fontfamily = 1; break;
        case 15: _fontfamily = 2; break;
            
        default:
            color_text = '#000000';
            color_block = '#FFFFFF';
    }
    

    var styleCFG = '';

             if (_img_status == 1)
             {
                 setCookie('vviimg', '1', exp);

                 document.getElementById('img_status').innerHTML = 'Изображения: Выкл';

                 styleCFG = styleCFG+'<style>';
                 styleCFG = styleCFG+' .LoadedImg, .markerImg { display: none !important; overflow: hidden !important;}';
                 styleCFG = styleCFG+' .Logo, .block_uzor_left, .block_uzor_right { background-image: none !important; }';
                 styleCFG = styleCFG+' </style>';
             }
             else
             {
                 setCookie('vviimg', '0', exp);
                 document.getElementById('img_status').innerHTML = 'Изображения: Вкл';
             }


    setCookie('vvi', '1', exp);

    styleCFG = styleCFG+'<style>';

    if (_fontfamily == 1)
    {
        setCookie('vvifamily', '1', exp);
        styleCFG = styleCFG+' .FontSize, .MiniTextMiniNews, .urlField, .DateNews, .CopyrightCenter, .MenuButtonv2, .LogoText { font-family: "Times New Roman" !important;  }';
        styleCFG = styleCFG+' .TitleMiniNews { font-family: "Times New Roman" !important; }';
        styleCFG = styleCFG+' .BlockCopyright { font-family: "Times New Roman" !important; }';
    
    }
    else if (_fontfamily == 2)
    {
        setCookie('vvifamily', '2', exp);
        styleCFG = styleCFG+' .FontSize, .MiniTextMiniNews, .urlField, .DateNews, .CopyrightCenter, .MenuButtonv2, .LogoText  { font-family: "Arial" !important; }';
        styleCFG = styleCFG+' .TitleMiniNews { font-family: "Arial" !important; }';
        styleCFG = styleCFG+' .BlockCopyright { font-family: "Arial" !important; }';
    }
    else
        setCookie('vvifamily', '0', exp);



    if (_fontSize == 1)
    {
        setCookie('vvisize', '1', exp);
        styleCFG = styleCFG+' .FontSize, .MiniTextMiniNews, .urlField, .DateNews, .CopyrightCenter, .MenuButtonv2, .LogoText { font-size: 24px !important;  word-break: break-all; }';
        styleCFG = styleCFG+' .TitleMiniNews { font-size: 30px !important; }';
        styleCFG = styleCFG+' .BlockCopyright { height: auto !important; } .CopyrightCenter { width: 90%; } .Copy_Left, .Copy_Right { width: 50%;}';
    
    }
    else if (_fontSize == 2)
    {
        setCookie('vvisize', '2', exp);
        styleCFG = styleCFG+' .FontSize, .MiniTextMiniNews, .urlField, .DateNews, .CopyrightCenter, .MenuButtonv2, .LogoText  { font-size: 30px !important; word-break: break-all; }';
        styleCFG = styleCFG+' .TitleMiniNews { font-size: 36px !important; }';
        styleCFG = styleCFG+' .BlockCopyright { height: auto !important; } .CopyrightCenter { width: 90%; } .Copy_Left, .Copy_Right { width: 50%;}';
    }
    else
        setCookie('vvisize', '0', exp);



    if (_lineSpace == 1)
    {
        setCookie('vvispace', '1', exp);
        styleCFG = styleCFG+' .FontSize, .MiniTextMiniNews, .urlField, .DateNews, .CopyrightCenter, .MenuButtonv2, .LogoText {letter-spacing: 2px; word-break: break-all; }';
        styleCFG = styleCFG+' .TitleMiniNews { letter-spacing: 2px  !important;}';
    
        styleCFG = styleCFG+' .BlockCopyright { height: auto !important; } .CopyrightCenter { width: 90%; } .Copy_Left, .Copy_Right { width: 50%;}';
    }
    else if (_lineSpace == 2)
    {
        setCookie('vvispace', '2', exp);
        styleCFG = styleCFG+' .FontSize, .MiniTextMiniNews, .urlField, .DateNews, .CopyrightCenter, .MenuButtonv2, .LogoText  { letter-spacing: 5px; word-break: break-all; }';
        styleCFG = styleCFG+' .TitleMiniNews { letter-spacing: 5px  !important;}';

        styleCFG = styleCFG+' .BlockCopyright { height: auto !important; } .CopyrightCenter { width: 90%; } .Copy_Left, .Copy_Right { width: 50%;}';
    }
    else
        setCookie('vvispace', '0', exp);

    styleCFG = styleCFG+' .ButtonReadMiniNews, .BlockButtonsNews { display: none !important; }';
    styleCFG = styleCFG+' .DateNews, .FDMN { width: 700px !important; }';
    styleCFG = styleCFG+' .vhr, #BlockVVI, .NewsComments, .commentTextArea, .MiniNews, .TitleBlock, .MenuBlock, .LeftArea, .BlockCopyright, .MenuButtonv2, .MenuButton, .button_1, .HRTitleNews { background: '+ color_block +'  !important; color: '+ color_text +' #FFF !important; box-shadow: 0 0 1px '+ color_text +'}';

    styleCFG = styleCFG+' body {background: '+ color_block +' !important;}';

    styleCFG = styleCFG+' .vviBlock.exit, .TitleVersion, .BlockButtonsNews, .commentTextArea, a, .FixPosTimeBlock, .MenuButton, .TitleMiniNews, .MiniTextMiniNews, .MenuButtonv2, .CopyrightCenter, .WarningURL, .DateNews, .button_1, .LogoText, .ColorText, .WelcomeBlock { color: '+ color_text +' !important; text-shadow: none !important; }';

    styleCFG = styleCFG+' td:hover {color: '+ color_text +' !important;}';
    styleCFG = styleCFG+' td {box-shadow: 0 0 1px '+ color_text +' !important;}';

    styleCFG = styleCFG+' </style>';
    
    console.log(styleCFG);
    
    cfgs.innerHTML = styleCFG;
}

function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name) {
  setCookie(name, "", {
    expires: -1
  })
}

<style>

.backgroundreg {
  transition: all 0.2s ease 0.1s;
  width: 100%;
  height: 100vh;
  background: #000;
  position: fixed;
  opacity: 0.7;
  z-index: 2;
  left: 0%;
  top: 0%; }


</style>
<div class="backgroundreg" id="backgroundreg" onclick="closeRegister();"></div>
<div class="FormRegistration" id="FormRegistration">
 <div class="title">Добро пожаловать!</div>
 <div class="formNameLeft">Как Вас Зовут?</div><div class="formNameRight"></div>
 <div class="formregleft_1"><input id="reg_name" class="inputDefault" type="text" placeholder="Имя"/></div><div class="formregright_1"><input id="reg_last_name" class="inputDefault" type="text" placeholder="Фамилия"/></div>

 <div class="formNameLeft">Придумайте имя пользователя</div><div class="formNameRight">Электронная почта</div>
 <div class="formregleft_1"><input id="reg_username" class="inputDefault" type="text" placeholder="Логин"/></div><div class="formregright_1"><input id="reg_email" class="inputDefault" type="text" placeholder="username@yandex.ru"/></div>
 <div id="error1" class="formNameLeft"></div><div id="error2" class="formNameRight"></div>

 <div class="formNameLeft">Придумайте пароль</div><div class="formNameRight">Подтвердите пароль</div>
 <div class="formregleft_1"><input id="reg_password1" class="inputDefault" type="text" placeholder="****"/></div><div class="formregright_1"><input id="reg_password2" class="inputDefault" type="text" placeholder="****"/></div>
 <div id="error3" class="formNameLeft"></div><div id="error4" class="formNameRight"></div>

 <div class="formNameLeft">Дата Вашего рождения</div><div class="formNameRight"></div>
 <div class="formDatenumeric"><input id="reg_birthDay" class="inputDate" type="text" placeholder="День"/></div><div class="formDateMonth"><SELECT id="reg_birthMonth" class="inputMonth">
 <option class="optionMonth" value="1">Январь</option>
 <option class="optionMonth" value="2">Февраль</option>
 <option class="optionMonth" value="3">Март</option>
 <option class="optionMonth" value="4">Апрель</option>
 <option class="optionMonth" value="5">Май</option>
 <option class="optionMonth" value="6">Июнь</option>
 <option class="optionMonth" value="7">Июль</option>
 <option class="optionMonth" value="8">Август</option>
 <option class="optionMonth" value="9">Сентябрь</option>
 <option class="optionMonth" value="10">Октябрь</option>
 <option class="optionMonth" value="11">Ноябрь</option>
 <option class="optionMonth" value="12">Декабрь</option>
 </SELECT><!--<input class="inputMonth" type="text" placeholder="Месяц"/>--></div><div class="formDateYear"><input id="reg_birthYear" class="inputYear" type="text" placeholder="Год"/></div>


 <div class="formNameLeft">Пол</div><div class="formNameRight"></div>
 <div class="formGender"><input id="reg_gender1" class="inputGenderMale" name="gender" type="radio" placeholder="м" value="0" />м<input id="reg_gender2" class="inputGenderFemale" name="gender" type="radio" placeholder="ж" value="1" checked />ж</div><div class="formDateMonth"></div><div class="formDateYear"></div>

<div onclick="register();" class="buttonRegister button_1">Регистрация</div>
</div>
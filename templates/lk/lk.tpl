<style>
.CenterA {
  border-radius: 6px; }

.FormRegistration {
  position: static;
  margin: 0; }
</style>

<div class="FormRegistration">
 <div class="title">Добро пожаловать!</div>
 <div class="formNameLeft">Как Вас Зовут?</div><div class="formNameRight"></div>
 <div class="formregleft_1"><input id="reg_name" class="inputDefault" type="text" value="{$lk_name}" placeholder="Имя"/></div><div class="formregright_1"><input id="reg_last_name" class="inputDefault" type="text" value="{$lk_last_name}" placeholder="Фамилия"/></div>

 <div class="formNameLeft">Новый пароль</div><div class="formNameRight">Подтвердите пароль</div>
 <div class="formregleft_1"><input id="reg_password1" class="inputDefault" type="text" placeholder="****"/></div><div class="formregright_1"><input id="reg_password2" class="inputDefault" type="text" placeholder="****"/></div>
 <div id="error3" class="formNameLeft"></div><div id="error4" class="formNameRight"></div>

 <div class="formNameLeft">Дата Вашего рождения</div><div class="formNameRight"></div>
 <div class="formDatenumeric"><input id="reg_birthDay" class="inputDate" type="text" value="{$lk_brithDay}" placeholder="День"/></div><div class="formDateMonth"><SELECT id="reg_birthMonth" class="inputMonth">
 <option class="optionMonth" {$opt_month_1} value="1">Январь</option>
 <option class="optionMonth" {$opt_month_2} value="2">Февраль</option>
 <option class="optionMonth" {$opt_month_3} value="3">Март</option>
 <option class="optionMonth" {$opt_month_4} value="4">Апрель</option>
 <option class="optionMonth" {$opt_month_5} value="5">Май</option>
 <option class="optionMonth" {$opt_month_6} value="6">Июнь</option>
 <option class="optionMonth" {$opt_month_7} value="7">Июль</option>
 <option class="optionMonth" {$opt_month_8} value="8">Август</option>
 <option class="optionMonth" {$opt_month_9} value="9">Сентябрь</option>
 <option class="optionMonth" {$opt_month_10} value="10">Октябрь</option>
 <option class="optionMonth" {$opt_month_11} value="11">Ноябрь</option>
 <option class="optionMonth" {$opt_month_12} value="12">Декабрь</option>
 </SELECT></div><div class="formDateYear"><input id="reg_birthYear" class="inputYear" type="text" value="{$lk_brithYear}" placeholder="Год"/></div>

 <div class="formNameLeft">Пол</div><div class="formNameRight"></div>
 <div class="formGender"><input id="reg_gender1" class="inputGenderMale" {$opt_gender_0} name="gender" type="radio" placeholder="м" value="0" />м<input id="reg_gender2" class="inputGenderFemale" {$opt_gender_1} name="gender" type="radio" placeholder="ж" value="1" />ж</div><div class="formDateMonth"></div><div class="formDateYear"></div>

<div onclick="SaveProfUser();" class="buttonRegister button_1">Сохранить</div>
</div>
<style>
.input_title {
  display: inline-block;
  vertical-align: top;
  width: 635px;
  padding: 5px;
  box-shadow: 0 0 2px rgb(0, 176, 240);
  border: none;
  height: 50px;
  font-size: 30px;
  color: #F2AC1F;
  text-shadow: 0 0 1px #000;
  word-wrap: break-word; }

#sample {
  width: 710px;
  margin: 15px 5px 5px 5px; }

.minibuttonadd {
  transition: all 0.1s ease 0s;
  background-image: url(//web-rubiks.ru/school38/images/add_site_t.png);
  margin-left: 5px;
  cursor: pointer;
  background-size: 60px 60px;
  width: 60px;
  height: 60px;
  display: inline-block;
  vertical-align: top; }

.minibuttonadd:hover {
  background-size: 58px 58px;
  background-position: 1px 1px;
  background-repeat: no-repeat;
 }
</style>

 <div id="sample"><input type="text" id="input_title" class="input_title" placeholder="Название ссылки" /><br><input type="text" id="input_url" class="input_title" placeholder="Ссылка" /><div onclick="createPg ($('#input_url').val(), $('#input_title').val(), 3, {$catalog_id}, 'create')" class="minibuttonadd"></div></div>

<style>
.input_title {
  width: 680px;
  padding: 5px;
  box-shadow: 0 0 2px rgb(0, 176, 240);
  border: none;
  height: 50px;
  margin-top: 5px;
  font-size: 30px;
  color: #F2AC1F;
  text-shadow: 0 0 1px #000;
  word-wrap: break-word; }

.DateNews {
  text-align: right;
  width: 690px; }

#sample {
  width: 690px;
  margin: 15px 5px 5px 5px; }

</style>

<div class="MiniNews NewsColor_1">
 <div id="sample"><input type="text" id="input_title" class="input_title" placeholder="Название новости" /></div>

 <div id="sample"><textarea id="texteditor1" class="area3" style="width: 100%; min-height: 300px;"></textarea></div>
 <div class="HRTitleNews"></div>
 <div class="DateNews"><div onclick="loadfile(true);" class="button_addFile" id="button_addFile"><img class="imgAddFile" src="//web-rubiks.ru/school38/images/w128h1281390727880addlink128.png" /></div><div onclick="createPage ($('#texteditor1').bbcode(), $('#input_title').val(), 1)" class="miniButton button_1">Добавить новость?</div></div>
</div>
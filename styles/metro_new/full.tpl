<!DOCTYPE html>
<head>
 <link rel="Shortcut Icon" type="image/x-icon" href="//web-rubiks.ru/school38/images/tutorial.png" />
 <title>СОШ № 38 | {$site_title}</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <link href="/style2.css?123" media="all" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="//web-rubiks.ru/school38/jquery.js"></script>
 <script type='text/javascript' src='//web-rubiks.ru/school38/js/noty/jquery.noty.js'></script>
<meta name="viewport" content="width=1100, initial-scale=1">
 <script type='text/javascript' src='//web-rubiks.ru/school38/js/noty/layouts/bottomLeft.js'></script>
 <script type='text/javascript' src='//web-rubiks.ru/school38/js/noty/themes/default.js'></script>
 <script type='text/javascript' src='//web-rubiks.ru/school38/js/noty/themes/relax.js'></script>
 <script type='text/javascript' src='//web-rubiks.ru/school38/js/noty/themes/bootstrap.js'></script>
 <link href="//web-rubiks.ru/school38/Animate.css" media="all" rel="stylesheet" type="text/css" />
<script src="//web-rubiks.ru/school38/js/wysibb_editor/jquery.wysibb.js"></script>
<link rel="stylesheet" href="//web-rubiks.ru/school38/js/wysibb_editor/theme/default/wbbtheme.css" />

 <script type="text/javascript" src="/js/main/main2.js?1234"></script>
</head>
<body class="fullcontent" id="fullcontent">
 <div class="block_uzor_left"></div>
 <div class="block_uzor_right"></div>

<style>
.vviBlock {
  cursor: pointer;
  width: 28px;
  height: 28px;
  border-radius: 3px;
  display: inline-block;
  vertical-align: middle;
  margin: 5px; }

.vviBlock.color1 {
  background: #FFFFFF;
  box-shadow: 0 0 2px #000000; }

.vviBlock.color2 {
  background: #000000;
  box-shadow: 0 0 2px #FFFFFF; }

.vviBlock.color3 {
  background: #8FCFF3;
  box-shadow: 0 0 2px #063462; }

.vviBlock.color4 {
  background: #3B2716;
  box-shadow: 0 0 2px #A9E44D; }

.vviBlock.color5 {
  background: #F7F3D6;
  box-shadow: 0 0 2px #3B2716; }


.vviBlock.color1 .vviKrug, .vviBlock.color2 .vviKrug, .vviBlock.color3 .vviKrug, .vviBlock.color4 .vviKrug, .vviBlock.color5 .vviKrug {
  width: 14px;
  height: 14px;
  margin: 7px;
  border-radius: 14px; }

.vviBlock.color1 .vviKrug{
  background: #000000; }

.vviBlock.color2 .vviKrug{
  background: #FFFFFF; }

.vviBlock.color3 .vviKrug{
  background: #063462; }

.vviBlock.color4 .vviKrug{
  background: #A9E44D; }

.vviBlock.color5 .vviKrug{
  background: #3B2716; }

.valign-text, .vhr, .vviBlock.exit {
  font-size: 20px;
  display: inline-block;
  vertical-align: middle; }

.TitleVersion {
  cursor: pointer;
  vertical-align: middle;
  color: #FFF;
  font-size: 18px; }

#BlockVVI {
text-align: center; vertical-align: middle; display: none; position: fixed; top: 0; left: 0; z-index: 777; width: 100%; }

</style>


 <div id='cfgs' style=""></div>



 <div id='BlockVVI'>
  <div class="valign-text">Цвет:</div>
  <div onclick="vvi('1'); return;" class="vviBlock color1"><div class="vviKrug"></div></div>
  <div onclick="vvi('2'); return;" class="vviBlock color2"><div class="vviKrug"></div></div>
  <div onclick="vvi('3'); return;" class="vviBlock color3"><div class="vviKrug"></div></div>
  <div onclick="vvi('4'); return;" class="vviBlock color4"><div class="vviKrug"></div></div>
  <div onclick="vvi('5'); return;" class="vviBlock color5"><div class="vviKrug"></div></div>
  <div onclick="vvi('0'); return;" style="width: 60px;" class="vviBlock exit">Выход</div>
  <div class="vhr" style="width: 2px; background: #000; height: 28px; margin: 7px;"></div>
  <div id="img_status" onclick="vvi(6); return;" style="width: 180px;" class="vviBlock exit">Изображения: Вкл</div>
  <div class="vhr" style="width: 2px; background: #000; height: 28px; margin: 7px;"></div>
  <div onclick="vvi(7); return;" style="font-size: 18px; height: 35px" class="vviBlock exit">А</div>
  <div onclick="vvi(8); return;" style="font-size: 26px; height: 35px" class="vviBlock exit">А</div>
  <div onclick="vvi(9); return;" style="font-size: 34px; height: 35px" class="vviBlock exit">А</div>
  <div class="vhr" style="width: 2px; background: #000; height: 28px; margin: 7px;"></div>
  <div onclick="vvi(10); return;" style="letter-spacing: 0px; width: 35px" class="vviBlock exit">Аб</div>
  <div onclick="vvi(11); return;" style="letter-spacing: 2px; width: 35px" class="vviBlock exit">Аб</div>
  <div onclick="vvi(12); return;" style="letter-spacing: 5px; width: 35px" class="vviBlock exit">Аб</div>
  <div class="vhr" style="width: 2px; background: #000; height: 28px; margin: 7px;"></div>
  <div onclick="vvi(14); return;" style="width: 180px" class="vviBlock exit">Times New Roman</div>
  <div onclick="vvi(15); return;" style="width: 50px" class="vviBlock exit">Arial</div>

 </div>


 <div class="TitleBlock" id="TitleBlock">
  <div class="TimeBlock"><div class="FixPosTimeBlock"><div style="display: inline;" id="Date"></div> <div style="display: inline;" id="Month"></div> <div style="display: inline;" id="Year"></div> - <div style="display: inline;" id="houres"></div><div style="display: inline-block; width: 7px ;" id="secBlink"></div><div style="display: inline;" id="Minutes"></div></div></div>
  <div class="LKAuthBlock">
   <div id='JoinLkBlock' class="JoinLkBlock"><font class="TitleVersion" onclick="vvi(1); document.getElementById('BlockVVI').style.display = 'block';">Версия для слабовидящих: </font><img onclick="vvi(1); document.getElementById('BlockVVI').style.display = 'block';" title="Версия для слабовидящих" style="cursor: pointer; vertical-align: middle; margin-right: 50px; border-radius: 6px;" src="https://static.mvd.ru/media/limited/img/access/normal.png" /> {$top_area}</div>
  </div>
 </div>
 <div class="WorkArea" id="fullcontent">
  <div class="Logo"><div style="background-image: url('//web-rubiks.ru/school38/images/logo.png'); width: 84px; height: 116px; margin-left: 40px; margin-top: 30px; display: inline-block; vertical-align: top;" class="gerb"></div><div class="LogoText" style="display: inline-block; vertical-align: top; color: rgb(255, 255, 255); word-wrap: break-word; width: 846px; margin-left: 30px; text-shadow: 0px 0px 5px rgb(0, 0, 0); text-align: center; font-size: 34px; margin-top: 5px;">
МАОУ «Средняя общеобразовательная<br>школа №38» г. Сыктывкар<br>
«38 №-а шoр школа» муниципальнoй асъюралана велoдан учреждение</div></div>
  <div class="MenuBlock" id="MenuBlock" >{$top_menu}
  </div>
  <div class="CenterArea">
   <div id="LeftArea" class="LeftArea">{$left_area}</div><div id="CenterA" class="CenterA">{$center_area}</div>
  </div>
 </div>
 <!--<div class="DivImgSlideCopyright"><img class="ImgSlideCopyright" src="/images/20.png" /></div>-->
 <div class="BlockCopyright">
  <div class="CopyrightCenter">
   <div class="Copy_Left">
    <div class="CopyAddress">Адрес: 167000, г. Сыктывкар, ул. Коммунистическая 74</div>
    <div class="CopyPhone">8 (8212) 31-28-99, 31-25-89</div>
    <div class="CopyEmail"><a class="WarningURL" href="mailto:sykt.school38@mail.ru">sykt.school38@mail.ru</a></div>
   </div><div class="Copy_Right">
    <div class="OrgName">МАОУ СОШ № 38</div>
    <div class="CopyTM">Все права защищены © 2014-2016</div>
    <div class="Developed">Dev by <a class="WarningURL" href="mailto:slavikwow2009@yandex.ru">Вячеслав Кравцов</a></div>
   </div>
  </div>
 </div>

<div class="blockPopWindow" id="blockPopWindow"></div>


<div id="fullimage" class="fullimage"></div>

<div id="searcher" class="searcher">
<div class="buttonCloseSearcher"><img onclick="document.getElementById('searcher').style.opacity = '0';" style="width: 20px; height: 20px; background: #fff; border-radius: 20px;" src="//web-rubiks.ru/school38/images/close-btn.png" /></div>
<input id="inputlookup" placeholder="Искать..." type="text" /><img onclick="AddToUrl('/lookup/' + document.getElementById('inputlookup').value + '/'); document.getElementById('searcher').style.opacity = '0';" class="searcherimg button_1" src="//web-rubiks.ru/school38/images/search.png" /></div>
<form style="display: none" class="FormLoadFile2" action="//web-rubiks.ru/school38/uploads/upload.php" target="rFrame" method="POST" enctype="multipart/form-data">
 <input multiple type="file" name="userfile" id="files" size="1" class="h3" onchange="_file.load();">
 <input type="text" name="token1" id="token1" value="" />
 <input type="text" name="token2" id="token2" value="" />
 <input type="submit" id="my_hidden_load" style="display: none; width: 0; height: 0;" value='Загрузить'>
</form>

<iframe id="rFrame" name="rFrame" onload="_file.readFrame();" style="display: none;"> </iframe>

<!-- Yandex.Metrika informer -->
<img src="https://informer.yandex.ru/informer/35093775/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0; position: fixed; right: 0; bottom: 0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:35093775,lang:'ru'});return false}catch(e){}" />
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter35093775 = new Ya.Metrika({
                    id:35093775,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/35093775" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
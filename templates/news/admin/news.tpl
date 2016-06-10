   <div class="MiniNews NewsColor_1">
    <div class="TitleMiniNews">{$news_title}</div>
    <div class="MiniTextMiniNews">{$news_description}</div>
    <div class="HRTitleNews"></div>
    <div class="MiniNewsButtons">
     <div class="DateNews"><div class="FDMN">{$news_date}</div></div><div class="BlockButtonsNews">{$author_name}<div onclick='delete ("{$news_id}")' class="ButtonReadMiniNews button_1">Удалить</div><div onclick='AddToUrl ("/admin/news/edit/{$news_id}")' class="ButtonReadMiniNews button_1">Редактировать</div><div onclick='AddToUrl ("/news/view/{$news_id}")' class="ButtonReadMiniNews button_1">Подробнее...</div></div>
    </div>
   </div>

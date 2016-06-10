<?

class screening {
    var $screen;
    function __construct($core)
    {
        $this->core = $core;
    }

    function Screening_text ($text)
    {
        $text = str_replace( "&"				, "&amp;"         , $text );
        $text = str_replace( ">"				, "&gt;"          , $text );
        $text = str_replace( "<"				, "&lt;"          , $text );
        $text = str_replace( "\\\\"		  , "&#092;"        , $text );
        $text = str_replace( "\'"			  , "&#39;"         , $text );
        $text = str_replace( "\""		  	, "&quot;"        , $text );
        $text = str_replace( '"'				, "&quot;"        , $text );
        $text = str_replace( '"'				, "&quot;"        , $text );
        $text = str_replace( "$"				, "&#036;"        , $text );
        $text = str_replace( "!"				, "&#33;"         , $text );
        $text = str_replace( "'"				, "&#39;"         , $text );
        $text = str_replace( "\&#39;"   , "&#39;"         , $text );
        $text = str_replace( "\&quot;"  , "&quot;"        , $text );

        return $text;
    }

    function unScreening_text ($text)
    {
        $text = str_replace("&quot;"        , "\&quot;" , $text );
        $text = str_replace("&#39;"         , "\&#39;"  , $text );
        $text = str_replace("&#39;"         , "'"				, $text );
        $text = str_replace("&#33;"         , "!"				, $text );
        $text = str_replace("&#036;"        , "$"				, $text );
        $text = str_replace("&quot;"        , '"'				, $text );
        $text = str_replace("&quot;"        , '"'				, $text );
        $text = str_replace("&quot;"        , "\""		  , $text );
        $text = str_replace("&#39;"         , "\'"			, $text );
        $text = str_replace("&#092;"        , "\\\\"	  , $text );
        $text = str_replace("&lt;"          , "<"				, $text );
        $text = str_replace("&gt;"          , ">"				, $text );
        $text = str_replace("&amp;"         , "&"				, $text );
    }

    function ScreeningBB($message, $br = true)
    {
        
        $message = str_replace( "[b][/b]"				, ""          , $message );
        $message = str_replace( "[p][/p]"				, ""          , $message );

        if ($this->core->values->get('nobb') == 'full')
            return $message;

        if ($br)
            $message = nl2br($message);

        if ($this->core->values->get('nobb') == 'true')
            return $message;
            
        $message = str_replace("http://web-rubiks.ru/", '//web-rubiks.ru/', $message);
        
        $message = preg_replace("#\[table\](.+)\[\/table\]#isU", '<table>\\1</table>', $message);
        $message = preg_replace("#\[tr\](.+)\[\/tr\]#isU", '<tr align="left" valign="top">\\1</tr>', $message);
        $message = preg_replace("#\[td\](.+)\[\/td\]#isU", '<td align="left" valign="top">\\1</td>', $message);

        while ( preg_match( "#\[table=bo\](.+)\[\/table\]#isU", $message ) )
        {
            $message = preg_replace("#\[table=bo\](.+)\[\/table\]#isU", '<table class="bo">\\1</table>', $message);
        }

        while ( preg_match( "#\[td=nbo\](.+)\[\/td\]#isU", $message ) )
        {
            $message = preg_replace("#\[td=nbo\](.+)\[\/td\]#isU", '<td class="nbo">\\1</td>', $message);
        }

        $message = str_replace( "[p]<br />"				, "[p]"          , $message );
        $message = str_replace( "[/p]<br />"				, "[/p]"          , $message );
        $message = str_replace( "[/li]<br />"				, "[/li]"          , $message );
        $message = str_replace( "[ul]<br />"				, "[ul]"          , $message );
        $message = str_replace( "[/ul]<br />"				, "[/ul]"          , $message );

        $message = str_replace( "[left]<br />"				, "[left]"          , $message );
        $message = str_replace( "[/left]<br />"				, "[/left]"          , $message );

        $message = str_replace( "[right]<br />"				, "[right]"          , $message );
        $message = str_replace( "[/right]<br />"				, "[/right]"          , $message );

        $message = str_replace( "[center]<br />"				, "[center]"          , $message );
        $message = str_replace( "[/center]<br />"				, "[/center]"          , $message );

        $message = str_replace( "[justify]<br />"				, "[justify]"          , $message );
        $message = str_replace( "[/justify]<br />"				, "[/justify]"          , $message );

        $message = str_replace( "[br]"				, "<br>"          , $message );

        $message = preg_replace("#\[code\](.+)\[\/code\]#isU", '<div class="code"> \\1</div>', $message);

        $message = preg_replace("#\[style\](.+)\[\/style\]#isU", '<div class="Style contacts_block">\\1</div>', $message);
        $message = preg_replace("#\[db\](.+)\[\/db\]#isU", '<div class="phone_table_two">\\1</div>', $message);

        while ( preg_match( "#\[table\](.+)\[\/table\]#isU", $message ) )
        {
            $message = preg_replace("#\[table\](.+)\[\/table\]#isU", '<table width="100%">\\1</table>', $message);
        }

        while ( preg_match( "#\[tr\](.+)\[\/tr\]#isU", $message ) )
        {
            $message = preg_replace("#\[tr\](.+)\[\/tr\]#isU", '<tr>\\1</tr>', $message);
        }

        while ( preg_match( "#\[td\](.+)\[\/td\]#isU", $message ) )
        {
            $message = preg_replace("#\[td\](.+)\[\/td\]#isU", '<td>\\1</td>', $message);
        }

        while ( preg_match( "#\[font=(.+)\](.+)\[\/font\]#isU", $message ) )
        {
            $message = preg_replace("#\[font=(.+)\](.+)\[\/font\]#isU", '<font face="\\1">\\2</font>', $message);
        }

        while ( preg_match("#\[size=(.+)\](.+)\[\/size\]#isU", $message ) )
        {
            //$cnt     = preg_replace("#\[size=(.+)\](.+)\[\/size\]#isU", '\\1', $message);
            //echo "<!--$cnt-->";
            //$size    = (int)($cnt / 33);
            $message = preg_replace("#\[size=(.+)\](.+)\[\/size\]#isU", '<font class="FontSize" size="\\1">\\2</font>', $message);
        }

        while ( preg_match("#\[color=(.+)\](.+)\[\/color\]#isU", $message ) )
        {
            $message = preg_replace("#\[color=(.+)\](.+)\[\/color\]#isU", '<span class="ColorText" style="color: \\1">\\2</span>', $message);
        }

        while ( preg_match("#\[list\](.+)\[\/list\]#isU", $message ) )
        {
            $message = preg_replace("#\[list\](.+)\[\/list\]#isU", '<ul class="Pages">\\1</ul>', $message);
        }

        while ( preg_match("#\[list=1\](.+)\[\/list\]#isU", $message ) )
        {
            $message = preg_replace("#\[list=1\](.+)\[\/list\]#isU", '<ol class="Pages">\\1</ol>', $message);
        }

        while ( preg_match("#\[\*\](.+)\[\/\*\]#isU", $message ) )
        {
            $message = preg_replace("#\[\*\](.+)\[\/\*\]#isU", '<li class="Pages">\\1</li>', $message);
        }

        while ( preg_match("#\[p\](.+)\[\/p\]#isU", $message ) )
        {
            $message = preg_replace("#\[p\](.+)\[\/p\]#isU", '<p>\\1</p>', $message);
        }

        while ( preg_match("#\[b\](.+)\[\/b\]#isU", $message ) )
        {
            $message = preg_replace("#\[b\](.+)\[\/b\]#isU", '<b>\\1</b>', $message);
        }
        
        

        while ( preg_match("#\[i\](.+)\[\/i\]#isU", $message ) )
        {
            $message = preg_replace("#\[i\](.+)\[\/i\]#isU", '<i>\\1</i>', $message);
        }

        while ( preg_match("#\[u\](.+)\[\/u\]#isU", $message ) )
        {
            $message = preg_replace("#\[u\](.+)\[\/u\]#isU", '<u>\\1</u>', $message);
        }

        while ( preg_match("#\[s\](.+)\[\/s\]#isU", $message ) )
        {
            $message = preg_replace("#\[s\](.+)\[\/s\]#isU", '<s>\\1</s>', $message);
        }

        while ( preg_match("#\[sup\](.+)\[\/sup\]#isU", $message ) )
        {
            $message = preg_replace("#\[sup\](.+)\[\/sup\]#isU", '<sup>\\1</sup>', $message);
        }

        while ( preg_match("#\[sub\](.+)\[\/sub\]#isU", $message ) )
        {
            $message = preg_replace("#\[sub\](.+)\[\/sub\]#isU", '<sub>\\1</sub>', $message);
        }

        while ( preg_match("#\[h(.+)\](.+)\[\/h(.+)\]#isU", $message ) )
        {
            $message = preg_replace("#\[h(.+)\](.+)\[\/h(.+)\]#isU", '<h\\1>\\2</h\\1>', $message);
        }

        while ( preg_match("#\[left\](.+)\[\/left\]#isU", $message ) )
        {
            $message = preg_replace("#\[left\](.+)\[\/left\]#isU", '<div align="left">\\1</div>', $message);
        }

        while ( preg_match("#\[right\](.+)\[\/right\]#isU", $message ) )
        {
            $message = preg_replace("#\[right\](.+)\[\/right\]#isU", '<div align="right">\\1</div>', $message);
        }

        while ( preg_match("#\[center\](.+)\[\/center\]#isU", $message ) )
        {
            $message = preg_replace("#\[center\](.+)\[\/center\]#isU", '<div style="text-align: center; width: 100%; vertical-align: top; display: inline-block;">\\1</div>', $message);
        }

        while ( preg_match("#\[justify\](.+)\[\/justify\]#isU", $message ) )
        {
            $message = preg_replace("#\[justify\](.+)\[\/justify\]#isU", '<div align="justify">\\1</div>', $message);
        }

        while ( preg_match("#\[p left\](.+)\[\/p left\]#isU", $message ) )
        {
            $message = preg_replace("#\[p left\](.+)\[\/p left\]#isU", '<p align="left">\\1</p>', $message);
        }

        while ( preg_match("#\[p right\](.+)\[\/p right\]#isU", $message ) )
        {
            $message = preg_replace("#\[p right\](.+)\[\/p right\]#isU", '<p align="right">\\1</p>', $message);
        }

        while ( preg_match("#\[p center\](.+)\[\/p center\]#isU", $message ) )
        {
            $message = preg_replace("#\[p center\](.+)\[\/p center\]#isU", '<p align="center">\\1</p>', $message);
        }

        while ( preg_match("#\[p justify\](.+)\[\/p justify\]#isU", $message ) )
        {
            $message = preg_replace("#\[p justify\](.+)\[\/p justify\]#isU", '<p align="justify">\\1</p>', $message);
        }

        $message = preg_replace("#\[img width=(.+),height=(.+)\](.+)\[\/img\]#isU", '<a target="_blank" href="\\3"><img onclick="openimg(\'\\3\'); return false;" class="LoadedImg" style="width: \\1px; height: \\2px;" src="\\3" /></a>', $message);


        $message = preg_replace("#\[img\](.+)\[\/img\]#isU", '<a target="_blank" href="\\3"><img class="LoadedImg" src="\\1" /></a>', $message);

        while ( preg_match("#\[background=(.+)\](.+)\[\/font\]#isU", $message ) )
        {
            $message = preg_replace("#\[background=(.+)\](.+)\[\/font\]#isU", '<span style="background-color: \\1">\\2</span>', $message);
        }

        $message = preg_replace("#\[quote\](.+)\[\/quote\]#isU",'<div class="quoteHead">Цитата</div><div class="quoteContent">\\1</div>',$message);
        $message = preg_replace("#\[url=(.+)\](.+)\[\/url\]#isU", '<a href="\\1" target="_blank">\\2</a>', $message);
        return replaceSmily($message);
    }
    
    function viewUrl($text){ return $text; }

    function preEditParse( $txt="" ){return replaceSmily(trim(stripslashes($txt)));}
}

function replaceSmily($text)
{
$text = str_replace( ":)"				, "<img src=\"http://forums.arena-wow.ru/public/style_emoticons/default/smile.png\" />"         , $text );
$text = str_replace( "*rofl*"				, "<img src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile036.gif\" />"         , $text );
$text = str_replace( ":D"				, "<img src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile007.gif\" />"         , $text );
$text = str_replace( "*crazy*"				, "<img title=\"*crazy*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile039.gif\" />"         , $text );
$text = str_replace( "*warning*"				, "<img title=\"*warning*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/excl.png\" />"         , $text );
$text = str_replace( "*sexygirl*"				, "<img title=\"*sexygirl*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile218.gif\" />"         , $text );
$text = str_replace( "*youcrazy*"				, "<img title=\"*youcrazy*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile152.gif\" />"         , $text );
$text = str_replace( ":("				, "<img title=\":(\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile003.gif\" />"         , $text );
$text = str_replace( "*idea*"				, "<img title=\"*idea*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile124.gif\" />"         , $text );
$text = str_replace( "%)"				, "<img title=\"%)\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile031.gif\" />"         , $text );
$text = str_replace( ";("				, "<img title=\";(\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile011.gif\" />"         , $text );
$text = str_replace( "*yahoo*"				, "<img title=\"*yahoo*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile042.gif\" />"         , $text );
$text = str_replace( "*help*"				, "<img title=\"*help*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile251.gif\" />"         , $text );
$text = str_replace( "=*"				, "<img title=\"=*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile010.gif\" />"         , $text );
$text = str_replace( "*kiss*"				, "<img title=\"*kiss*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile023.gif\" />"         , $text );

$text = str_replace( "*Smile099.gif*"				, "<img title=\"*Smile099.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile099.gif\" />"         , $text );
$text = str_replace( "*Smile009.gif*"				, "<img title=\"*Smile009.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile009.gif\" />"         , $text );
$text = str_replace( "*Smile201.gif*"				, "<img title=\"*Smile201.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile201.gif\" />"         , $text );
$text = str_replace( "*Smile172.gif*"				, "<img title=\"*Smile172.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile172.gif\" />"         , $text );
$text = str_replace( "*wub.png*"				, "<img title=\"*wub.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/wub.png\" />"         , $text );
$text = str_replace( "*sleep.png*"				, "<img title=\"*sleep.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/sleep.png\" />"         , $text );
$text = str_replace( "*Smile152.gif*"				, "<img title=\"*Smile152.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile152.gif\" />"         , $text );
$text = str_replace( "*biggrin.png*"				, "<img title=\"*biggrin.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/biggrin.png\" />"         , $text );
$text = str_replace( "*cool.gif*"				, "<img title=\"*cool.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/cool.gif\" />"         , $text );
$text = str_replace( "*Smile075.gif*"				, "<img title=\"*Smile075.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile075.gif\" />"         , $text );
$text = str_replace( "*Smile102.gif*"				, "<img title=\"*Smile102.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile102.gif\" />"         , $text );
$text = str_replace( "*Smile066.gif*"				, "<img title=\"*Smile066.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile066.gif\" />"         , $text );
$text = str_replace( "*Smile226.gif*"				, "<img title=\"*Smile226.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile226.gif\" />"         , $text );
$text = str_replace( "*Smile113.gif*"				, "<img title=\"*Smile113.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile113.gif\" />"         , $text );
$text = str_replace( "*Smile024.gif*"				, "<img title=\"*Smile024.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile024.gif\" />"         , $text );
$text = str_replace( "*Smile006.gif*"				, "<img title=\"*Smile006.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile006.gif\" />"         , $text );
$text = str_replace( "*biggrin.gif*"				, "<img title=\"*biggrin.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/biggrin.gif\" />"         , $text );
$text = str_replace( "*ph34r.png*"				, "<img title=\"*ph34r.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/ph34r.png\" />"         , $text );
$text = str_replace( "*Smile061.gif*"				, "<img title=\"*Smile061.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile061.gif\" />"         , $text );
$text = str_replace( "*Smile176.gif*"				, "<img title=\"*Smile176.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile176.gif\" />"         , $text );
$text = str_replace( "*wacko.png*"				, "<img title=\"*wacko.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/wacko.png\" />"         , $text );
$text = str_replace( "*Smile083.gif*"				, "<img title=\"*Smile083.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile083.gif\" />"         , $text );
$text = str_replace( "*Smile223.gif*"				, "<img title=\"*Smile223.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile223.gif\" />"         , $text );
$text = str_replace( "*Smile158.gif*"				, "<img title=\"*Smile158.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile158.gif\" />"         , $text );
$text = str_replace( "*Smile145.gif*"				, "<img title=\"*Smile145.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile145.gif\" />"         , $text );
$text = str_replace( "*Smile040.gif*"				, "<img title=\"*Smile040.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile040.gif\" />"         , $text );
$text = str_replace( "*Smile139.gif*"				, "<img title=\"*Smile139.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile139.gif\" />"         , $text );
$text = str_replace( "*Smile016.gif*"				, "<img title=\"*Smile016.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile016.gif\" />"         , $text );
$text = str_replace( "*Smile170.gif*"				, "<img title=\"*Smile170.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile170.gif\" />"         , $text );
$text = str_replace( "*dry.gif*"				, "<img title=\"*dry.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/dry.gif\" />"         , $text );
$text = str_replace( "*Smile029.gif*"				, "<img title=\"*Smile029.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile029.gif\" />"         , $text );
$text = str_replace( "*Smile238.gif*"				, "<img title=\"*Smile238.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile238.gif\" />"         , $text );
$text = str_replace( "*Smile227.gif*"				, "<img title=\"*Smile227.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile227.gif\" />"         , $text );
$text = str_replace( "*Smile032.gif*"				, "<img title=\"*Smile032.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile032.gif\" />"         , $text );
$text = str_replace( "*Smile008.gif*"				, "<img title=\"*Smile008.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile008.gif\" />"         , $text );
$text = str_replace( "*Smile064.gif*"				, "<img title=\"*Smile064.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile064.gif\" />"         , $text );
$text = str_replace( "*Smile222.gif*"				, "<img title=\"*Smile222.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile222.gif\" />"         , $text );
$text = str_replace( "*Smile097.gif*"				, "<img title=\"*Smile097.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile097.gif\" />"         , $text );
$text = str_replace( "*Smile014.gif*"				, "<img title=\"*Smile014.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile014.gif\" />"         , $text );
$text = str_replace( "*Smile134.gif*"				, "<img title=\"*Smile134.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile134.gif\" />"         , $text );
$text = str_replace( "*cool.png*"				, "<img title=\"*cool.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/cool.png\" />"         , $text );
$text = str_replace( "*Smile001.gif*"				, "<img title=\"*Smile001.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile001.gif\" />"         , $text );
$text = str_replace( "*Smile147.gif*"				, "<img title=\"*Smile147.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile147.gif\" />"         , $text );
$text = str_replace( "*Smile031.gif*"				, "<img title=\"*Smile031.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile031.gif\" />"         , $text );
$text = str_replace( "*Smile071.gif*"				, "<img title=\"*Smile071.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile071.gif\" />"         , $text );
$text = str_replace( "*Smile043.gif*"				, "<img title=\"*Smile043.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile043.gif\" />"         , $text );
$text = str_replace( "*Smile056.gif*"				, "<img title=\"*Smile056.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile056.gif\" />"         , $text );
$text = str_replace( "*Smile239.gif*"				, "<img title=\"*Smile239.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile239.gif\" />"         , $text );
$text = str_replace( "*blink.gif*"				, "<img title=\"*blink.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/blink.gif\" />"         , $text );
$text = str_replace( "*Smile085.gif*"				, "<img title=\"*Smile085.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile085.gif\" />"         , $text );
$text = str_replace( "*Smile055.gif*"				, "<img title=\"*Smile055.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile055.gif\" />"         , $text );
$text = str_replace( "*Smile194.gif*"				, "<img title=\"*Smile194.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile194.gif\" />"         , $text );
$text = str_replace( "*Smile138.gif*"				, "<img title=\"*Smile138.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile138.gif\" />"         , $text );
$text = str_replace( "*Smile127.gif*"				, "<img title=\"*Smile127.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile127.gif\" />"         , $text );
$text = str_replace( "*Smile092.gif*"				, "<img title=\"*Smile092.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile092.gif\" />"         , $text );
$text = str_replace( "*mad.gif*"				, "<img title=\"*mad.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/mad.gif\" />"         , $text );
$text = str_replace( "*Smile004.gif*"				, "<img title=\"*Smile004.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile004.gif\" />"         , $text );
$text = str_replace( "*Smile051.gif*"				, "<img title=\"*Smile051.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile051.gif\" />"         , $text );
$text = str_replace( "*Smile150.gif*"				, "<img title=\"*Smile150.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile150.gif\" />"         , $text );
$text = str_replace( "*Smile114.gif*"				, "<img title=\"*Smile114.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile114.gif\" />"         , $text );
$text = str_replace( "*Smile010.gif*"				, "<img title=\"*Smile010.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile010.gif\" />"         , $text );
$text = str_replace( "*Smile111.gif*"				, "<img title=\"*Smile111.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile111.gif\" />"         , $text );
$text = str_replace( "*Smile252.gif*"				, "<img title=\"*Smile252.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile252.gif\" />"         , $text );
$text = str_replace( "*Smile251.gif*"				, "<img title=\"*Smile251.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile251.gif\" />"         , $text );
$text = str_replace( "*Smile183.gif*"				, "<img title=\"*Smile183.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile183.gif\" />"         , $text );
$text = str_replace( "*Smile037.gif*"				, "<img title=\"*Smile037.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile037.gif\" />"         , $text );
$text = str_replace( "*Smile153.gif*"				, "<img title=\"*Smile153.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile153.gif\" />"         , $text );
$text = str_replace( "*Smile118.gif*"				, "<img title=\"*Smile118.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile118.gif\" />"         , $text );
$text = str_replace( "*Smile049.gif*"				, "<img title=\"*Smile049.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile049.gif\" />"         , $text );
$text = str_replace( "*tongue.gif*"				, "<img title=\"*tongue.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/tongue.gif\" />"         , $text );
$text = str_replace( "*Smile123.gif*"				, "<img title=\"*Smile123.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile123.gif\" />"         , $text );
$text = str_replace( "*Smile022.gif*"				, "<img title=\"*Smile022.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile022.gif\" />"         , $text );
$text = str_replace( "*Smile205.gif*"				, "<img title=\"*Smile205.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile205.gif\" />"         , $text );
$text = str_replace( "*Smile069.gif*"				, "<img title=\"*Smile069.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile069.gif\" />"         , $text );
$text = str_replace( "*Smile193.gif*"				, "<img title=\"*Smile193.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile193.gif\" />"         , $text );
$text = str_replace( "*Smile052.gif*"				, "<img title=\"*Smile052.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile052.gif\" />"         , $text );
$text = str_replace( "*Smile143.gif*"				, "<img title=\"*Smile143.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile143.gif\" />"         , $text );
$text = str_replace( "*Smile178.gif*"				, "<img title=\"*Smile178.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile178.gif\" />"         , $text );
$text = str_replace( "*Smile215.gif*"				, "<img title=\"*Smile215.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile215.gif\" />"         , $text );
$text = str_replace( "*Smile119.gif*"				, "<img title=\"*Smile119.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile119.gif\" />"         , $text );
$text = str_replace( "*Smile249.gif*"				, "<img title=\"*Smile249.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile249.gif\" />"         , $text );
$text = str_replace( "*Smile157.gif*"				, "<img title=\"*Smile157.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile157.gif\" />"         , $text );
$text = str_replace( "*Smile240.gif*"				, "<img title=\"*Smile240.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile240.gif\" />"         , $text );
$text = str_replace( "*Smile101.gif*"				, "<img title=\"*Smile101.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile101.gif\" />"         , $text );
$text = str_replace( "*Smile175.gif*"				, "<img title=\"*Smile175.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile175.gif\" />"         , $text );
$text = str_replace( "*Smile045.gif*"				, "<img title=\"*Smile045.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile045.gif\" />"         , $text );
$text = str_replace( "*Smile057.gif*"				, "<img title=\"*Smile057.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile057.gif\" />"         , $text );
$text = str_replace( "*Smile213.gif*"				, "<img title=\"*Smile213.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile213.gif\" />"         , $text );
$text = str_replace( "*Smile091.gif*"				, "<img title=\"*Smile091.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile091.gif\" />"         , $text );
$text = str_replace( "*Smile167.gif*"				, "<img title=\"*Smile167.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile167.gif\" />"         , $text );
$text = str_replace( "*Smile203.gif*"				, "<img title=\"*Smile203.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile203.gif\" />"         , $text );
$text = str_replace( "*Smile062.gif*"				, "<img title=\"*Smile062.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile062.gif\" />"         , $text );
$text = str_replace( "*Smile156.gif*"				, "<img title=\"*Smile156.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile156.gif\" />"         , $text );
$text = str_replace( "*Smile033.gif*"				, "<img title=\"*Smile033.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile033.gif\" />"         , $text );
$text = str_replace( "*Smile120.gif*"				, "<img title=\"*Smile120.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile120.gif\" />"         , $text );
$text = str_replace( "*Smile048.gif*"				, "<img title=\"*Smile048.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile048.gif\" />"         , $text );
$text = str_replace( "*blink.png*"				, "<img title=\"*blink.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/blink.png\" />"         , $text );
$text = str_replace( "*Smile241.gif*"				, "<img title=\"*Smile241.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile241.gif\" />"         , $text );
$text = str_replace( "*Smile231.gif*"				, "<img title=\"*Smile231.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile231.gif\" />"         , $text );
$text = str_replace( "*Smile063.gif*"				, "<img title=\"*Smile063.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile063.gif\" />"         , $text );
$text = str_replace( "*Smile197.gif*"				, "<img title=\"*Smile197.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile197.gif\" />"         , $text );
$text = str_replace( "*Smile068.gif*"				, "<img title=\"*Smile068.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile068.gif\" />"         , $text );
$text = str_replace( "*Smile112.gif*"				, "<img title=\"*Smile112.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile112.gif\" />"         , $text );
$text = str_replace( "*Smile247.gif*"				, "<img title=\"*Smile247.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile247.gif\" />"         , $text );
$text = str_replace( "*Smile028.gif*"				, "<img title=\"*Smile028.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile028.gif\" />"         , $text );
$text = str_replace( "*Smile050.gif*"				, "<img title=\"*Smile050.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile050.gif\" />"         , $text );
$text = str_replace( "*Smile058.gif*"				, "<img title=\"*Smile058.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile058.gif\" />"         , $text );
$text = str_replace( "*Smile136.gif*"				, "<img title=\"*Smile136.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile136.gif\" />"         , $text );
$text = str_replace( "*Smile225.gif*"				, "<img title=\"*Smile225.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile225.gif\" />"         , $text );
$text = str_replace( "*Smile246.gif*"				, "<img title=\"*Smile246.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile246.gif\" />"         , $text );
$text = str_replace( "*ohmy.gif*"				, "<img title=\"*ohmy.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/ohmy.gif\" />"         , $text );
$text = str_replace( "*laugh.png*"				, "<img title=\"*laugh.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/laugh.png\" />"         , $text );
$text = str_replace( "*Smile121.gif*"				, "<img title=\"*Smile121.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile121.gif\" />"         , $text );
$text = str_replace( "*Smile067.gif*"				, "<img title=\"*Smile067.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile067.gif\" />"         , $text );
$text = str_replace( "*Smile098.gif*"				, "<img title=\"*Smile098.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile098.gif\" />"         , $text );
$text = str_replace( "*tongue.png*"				, "<img title=\"*tongue.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/tongue.png\" />"         , $text );
$text = str_replace( "*Smile168.gif*"				, "<img title=\"*Smile168.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile168.gif\" />"         , $text );
$text = str_replace( "*Smile198.gif*"				, "<img title=\"*Smile198.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile198.gif\" />"         , $text );
$text = str_replace( "*Smile013.gif*"				, "<img title=\"*Smile013.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile013.gif\" />"         , $text );
$text = str_replace( "*Smile169.gif*"				, "<img title=\"*Smile169.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile169.gif\" />"         , $text );
$text = str_replace( "*unsure.png*"				, "<img title=\"*unsure.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/unsure.png\" />"         , $text );
$text = str_replace( "*Smile103.gif*"				, "<img title=\"*Smile103.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile103.gif\" />"         , $text );
$text = str_replace( "*Smile242.gif*"				, "<img title=\"*Smile242.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile242.gif\" />"         , $text );
$text = str_replace( "*Smile210.gif*"				, "<img title=\"*Smile210.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile210.gif\" />"         , $text );
$text = str_replace( "*happy.png*"				, "<img title=\"*happy.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/happy.png\" />"         , $text );
$text = str_replace( "*Smile218.gif*"				, "<img title=\"*Smile218.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile218.gif\" />"         , $text );
$text = str_replace( "*sad.gif*"				, "<img title=\"*sad.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/sad.gif\" />"         , $text );
$text = str_replace( "*Smile133.gif*"				, "<img title=\"*Smile133.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile133.gif\" />"         , $text );
$text = str_replace( "*Smile007.gif*"				, "<img title=\"*Smile007.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile007.gif\" />"         , $text );
$text = str_replace( "*Smile087.gif*"				, "<img title=\"*Smile087.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile087.gif\" />"         , $text );
$text = str_replace( "*Smile165.gif*"				, "<img title=\"*Smile165.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile165.gif\" />"         , $text );
$text = str_replace( "*Smile221.gif*"				, "<img title=\"*Smile221.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile221.gif\" />"         , $text );
$text = str_replace( "*Smile219.gif*"				, "<img title=\"*Smile219.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile219.gif\" />"         , $text );
$text = str_replace( "*Smile115.gif*"				, "<img title=\"*Smile115.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile115.gif\" />"         , $text );
$text = str_replace( "*Smile245.gif*"				, "<img title=\"*Smile245.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile245.gif\" />"         , $text );
$text = str_replace( "*Smile109.gif*"				, "<img title=\"*Smile109.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile109.gif\" />"         , $text );
$text = str_replace( "*Smile039.gif*"				, "<img title=\"*Smile039.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile039.gif\" />"         , $text );
$text = str_replace( "*Smile002.gif*"				, "<img title=\"*Smile002.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile002.gif\" />"         , $text );
$text = str_replace( "*Smile208.gif*"				, "<img title=\"*Smile208.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile208.gif\" />"         , $text );
$text = str_replace( "*Smile207.gif*"				, "<img title=\"*Smile207.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile207.gif\" />"         , $text );
$text = str_replace( "*Smile130.gif*"				, "<img title=\"*Smile130.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile130.gif\" />"         , $text );
$text = str_replace( "*huh.png*"				, "<img title=\"*huh.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/huh.png\" />"         , $text );
$text = str_replace( "*Smile171.gif*"				, "<img title=\"*Smile171.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile171.gif\" />"         , $text );
$text = str_replace( "*wub.gif*"				, "<img title=\"*wub.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/wub.gif\" />"         , $text );
$text = str_replace( "*dry.png*"				, "<img title=\"*dry.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/dry.png\" />"         , $text );
$text = str_replace( "*mellow.png*"				, "<img title=\"*mellow.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/mellow.png\" />"         , $text );
$text = str_replace( "*Smile059.gif*"				, "<img title=\"*Smile059.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile059.gif\" />"         , $text );
$text = str_replace( "*Smile108.gif*"				, "<img title=\"*Smile108.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile108.gif\" />"         , $text );
$text = str_replace( "*Smile106.gif*"				, "<img title=\"*Smile106.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile106.gif\" />"         , $text );
$text = str_replace( "*Smile030.gif*"				, "<img title=\"*Smile030.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile030.gif\" />"         , $text );
$text = str_replace( "*Smile235.gif*"				, "<img title=\"*Smile235.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile235.gif\" />"         , $text );
$text = str_replace( "*Smile216.gif*"				, "<img title=\"*Smile216.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile216.gif\" />"         , $text );
$text = str_replace( "*Smile084.gif*"				, "<img title=\"*Smile084.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile084.gif\" />"         , $text );
$text = str_replace( "*Smile151.gif*"				, "<img title=\"*Smile151.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile151.gif\" />"         , $text );
$text = str_replace( "*wink.gif*"				, "<img title=\"*wink.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/wink.gif\" />"         , $text );
$text = str_replace( "*Smile088.gif*"				, "<img title=\"*Smile088.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile088.gif\" />"         , $text );
$text = str_replace( "*Smile174.gif*"				, "<img title=\"*Smile174.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile174.gif\" />"         , $text );
$text = str_replace( "*angry.png*"				, "<img title=\"*angry.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/angry.png\" />"         , $text );
$text = str_replace( "*Smile229.gif*"				, "<img title=\"*Smile229.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile229.gif\" />"         , $text );
$text = str_replace( "*Smile035.gif*"				, "<img title=\"*Smile035.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile035.gif\" />"         , $text );
$text = str_replace( "*Smile060.gif*"				, "<img title=\"*Smile060.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile060.gif\" />"         , $text );
$text = str_replace( "*Smile117.gif*"				, "<img title=\"*Smile117.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile117.gif\" />"         , $text );
$text = str_replace( "*smile253.gif*"				, "<img title=\"*smile253.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/smile253.gif\" />"         , $text );
$text = str_replace( "*Smile094.gif*"				, "<img title=\"*Smile094.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile094.gif\" />"         , $text );
$text = str_replace( "*Smile154.gif*"				, "<img title=\"*Smile154.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile154.gif\" />"         , $text );
$text = str_replace( "*Smile160.gif*"				, "<img title=\"*Smile160.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile160.gif\" />"         , $text );
$text = str_replace( "*Smile044.gif*"				, "<img title=\"*Smile044.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile044.gif\" />"         , $text );
$text = str_replace( "*Smile025.gif*"				, "<img title=\"*Smile025.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile025.gif\" />"         , $text );
$text = str_replace( "*Smile079.gif*"				, "<img title=\"*Smile079.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile079.gif\" />"         , $text );
$text = str_replace( "*ph34r.gif*"				, "<img title=\"*ph34r.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/ph34r.gif\" />"         , $text );
$text = str_replace( "*Smile186.gif*"				, "<img title=\"*Smile186.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile186.gif\" />"         , $text );
$text = str_replace( "*Smile125.gif*"				, "<img title=\"*Smile125.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile125.gif\" />"         , $text );
$text = str_replace( "*Smile212.gif*"				, "<img title=\"*Smile212.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile212.gif\" />"         , $text );
$text = str_replace( "*Smile233.gif*"				, "<img title=\"*Smile233.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile233.gif\" />"         , $text );
$text = str_replace( "*Smile196.gif*"				, "<img title=\"*Smile196.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile196.gif\" />"         , $text );
$text = str_replace( "*Smile230.gif*"				, "<img title=\"*Smile230.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile230.gif\" />"         , $text );
$text = str_replace( "*sleep.gif*"				, "<img title=\"*sleep.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/sleep.gif\" />"         , $text );
$text = str_replace( "*blush.png*"				, "<img title=\"*blush.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/blush.png\" />"         , $text );
$text = str_replace( "*Smile110.gif*"				, "<img title=\"*Smile110.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile110.gif\" />"         , $text );
$text = str_replace( "*Smile116.gif*"				, "<img title=\"*Smile116.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile116.gif\" />"         , $text );
$text = str_replace( "*Smile086.gif*"				, "<img title=\"*Smile086.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile086.gif\" />"         , $text );
$text = str_replace( "*excl.gif*"				, "<img title=\"*excl.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/excl.gif\" />"         , $text );
$text = str_replace( "*Smile011.gif*"				, "<img title=\"*Smile011.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile011.gif\" />"         , $text );
$text = str_replace( "*Smile243.gif*"				, "<img title=\"*Smile243.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile243.gif\" />"         , $text );
$text = str_replace( "*Smile187.gif*"				, "<img title=\"*Smile187.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile187.gif\" />"         , $text );
$text = str_replace( "*Smile020.gif*"				, "<img title=\"*Smile020.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile020.gif\" />"         , $text );
$text = str_replace( "*Smile072.gif*"				, "<img title=\"*Smile072.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile072.gif\" />"         , $text );
$text = str_replace( "*Smile190.gif*"				, "<img title=\"*Smile190.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile190.gif\" />"         , $text );
$text = str_replace( "*Smile184.gif*"				, "<img title=\"*Smile184.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile184.gif\" />"         , $text );
$text = str_replace( "*Smile054.gif*"				, "<img title=\"*Smile054.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile054.gif\" />"         , $text );
$text = str_replace( "*Smile164.gif*"				, "<img title=\"*Smile164.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile164.gif\" />"         , $text );
$text = str_replace( "*mellow.gif*"				, "<img title=\"*mellow.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/mellow.gif\" />"         , $text );
$text = str_replace( "*Smile065.gif*"				, "<img title=\"*Smile065.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile065.gif\" />"         , $text );
$text = str_replace( "*excl.png*"				, "<img title=\"*excl.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/excl.png\" />"         , $text );
$text = str_replace( "*Smile220.gif*"				, "<img title=\"*Smile220.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile220.gif\" />"         , $text );
$text = str_replace( "*Smile089.gif*"				, "<img title=\"*Smile089.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile089.gif\" />"         , $text );
$text = str_replace( "*Smile038.gif*"				, "<img title=\"*Smile038.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile038.gif\" />"         , $text );
$text = str_replace( "*Smile017.gif*"				, "<img title=\"*Smile017.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile017.gif\" />"         , $text );
$text = str_replace( "*Smile232.gif*"				, "<img title=\"*Smile232.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile232.gif\" />"         , $text );
$text = str_replace( "*Smile132.gif*"				, "<img title=\"*Smile132.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile132.gif\" />"         , $text );
$text = str_replace( "*laugh.gif*"				, "<img title=\"*laugh.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/laugh.gif\" />"         , $text );
$text = str_replace( "*Smile140.gif*"				, "<img title=\"*Smile140.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile140.gif\" />"         , $text );
$text = str_replace( "*Smile005.gif*"				, "<img title=\"*Smile005.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile005.gif\" />"         , $text );
$text = str_replace( "*Smile096.gif*"				, "<img title=\"*Smile096.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile096.gif\" />"         , $text );
$text = str_replace( "*Smile080.gif*"				, "<img title=\"*Smile080.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile080.gif\" />"         , $text );
$text = str_replace( "*Smile026.gif*"				, "<img title=\"*Smile026.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile026.gif\" />"         , $text );
$text = str_replace( "*Smile206.gif*"				, "<img title=\"*Smile206.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile206.gif\" />"         , $text );
$text = str_replace( "*Smile042.gif*"				, "<img title=\"*Smile042.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile042.gif\" />"         , $text );
$text = str_replace( "*Smile027.gif*"				, "<img title=\"*Smile027.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile027.gif\" />"         , $text );
$text = str_replace( "*Smile003.gif*"				, "<img title=\"*Smile003.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile003.gif\" />"         , $text );
$text = str_replace( "*Smile180.gif*"				, "<img title=\"*Smile180.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile180.gif\" />"         , $text );
$text = str_replace( "*Smile015.gif*"				, "<img title=\"*Smile015.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile015.gif\" />"         , $text );
$text = str_replace( "*Smile146.gif*"				, "<img title=\"*Smile146.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile146.gif\" />"         , $text );
$text = str_replace( "*Smile124.gif*"				, "<img title=\"*Smile124.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile124.gif\" />"         , $text );
$text = str_replace( "*Smile107.gif*"				, "<img title=\"*Smile107.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile107.gif\" />"         , $text );
$text = str_replace( "*Smile128.gif*"				, "<img title=\"*Smile128.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile128.gif\" />"         , $text );
$text = str_replace( "*Smile179.gif*"				, "<img title=\"*Smile179.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile179.gif\" />"         , $text );
$text = str_replace( "*Smile188.gif*"				, "<img title=\"*Smile188.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile188.gif\" />"         , $text );
$text = str_replace( "*Smile081.gif*"				, "<img title=\"*Smile081.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile081.gif\" />"         , $text );
$text = str_replace( "*Smile122.gif*"				, "<img title=\"*Smile122.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile122.gif\" />"         , $text );
$text = str_replace( "*Smile129.gif*"				, "<img title=\"*Smile129.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile129.gif\" />"         , $text );
$text = str_replace( "*Smile199.gif*"				, "<img title=\"*Smile199.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile199.gif\" />"         , $text );
$text = str_replace( "*Smile018.gif*"				, "<img title=\"*Smile018.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile018.gif\" />"         , $text );
$text = str_replace( "*angry.gif*"				, "<img title=\"*angry.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/angry.gif\" />"         , $text );
$text = str_replace( "*Smile135.gif*"				, "<img title=\"*Smile135.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile135.gif\" />"         , $text );
$text = str_replace( "*Smile228.gif*"				, "<img title=\"*Smile228.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile228.gif\" />"         , $text );
$text = str_replace( "*Smile166.gif*"				, "<img title=\"*Smile166.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile166.gif\" />"         , $text );
$text = str_replace( "*Smile159.gif*"				, "<img title=\"*Smile159.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile159.gif\" />"         , $text );
$text = str_replace( "*Smile173.gif*"				, "<img title=\"*Smile173.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile173.gif\" />"         , $text );
$text = str_replace( "*Smile177.gif*"				, "<img title=\"*Smile177.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile177.gif\" />"         , $text );
$text = str_replace( "*Smile217.gif*"				, "<img title=\"*Smile217.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile217.gif\" />"         , $text );
$text = str_replace( "*Smile185.gif*"				, "<img title=\"*Smile185.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile185.gif\" />"         , $text );
$text = str_replace( "*wacko.gif*"				, "<img title=\"*wacko.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/wacko.gif\" />"         , $text );
$text = str_replace( "*Smile161.gif*"				, "<img title=\"*Smile161.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile161.gif\" />"         , $text );
$text = str_replace( "*Smile076.gif*"				, "<img title=\"*Smile076.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile076.gif\" />"         , $text );
$text = str_replace( "*Smile104.gif*"				, "<img title=\"*Smile104.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile104.gif\" />"         , $text );
$text = str_replace( "*Smile202.gif*"				, "<img title=\"*Smile202.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile202.gif\" />"         , $text );
$text = str_replace( "*Smile163.gif*"				, "<img title=\"*Smile163.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile163.gif\" />"         , $text );
$text = str_replace( "*Smile181.gif*"				, "<img title=\"*Smile181.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile181.gif\" />"         , $text );
$text = str_replace( "*rolleyes.gif*"				, "<img title=\"*rolleyes.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/rolleyes.gif\" />"         , $text );
$text = str_replace( "*Smile034.gif*"				, "<img title=\"*Smile034.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile034.gif\" />"         , $text );
$text = str_replace( "*Smile047.gif*"				, "<img title=\"*Smile047.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile047.gif\" />"         , $text );
$text = str_replace( "*unsure.gif*"				, "<img title=\"*unsure.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/unsure.gif\" />"         , $text );
$text = str_replace( "*Smile074.gif*"				, "<img title=\"*Smile074.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile074.gif\" />"         , $text );
$text = str_replace( "*Smile244.gif*"				, "<img title=\"*Smile244.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile244.gif\" />"         , $text );
$text = str_replace( "*Smile012.gif*"				, "<img title=\"*Smile012.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile012.gif\" />"         , $text );
$text = str_replace( "*Smile149.gif*"				, "<img title=\"*Smile149.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile149.gif\" />"         , $text );
$text = str_replace( "*Smile023.gif*"				, "<img title=\"*Smile023.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile023.gif\" />"         , $text );
$text = str_replace( "*Smile019.gif*"				, "<img title=\"*Smile019.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile019.gif\" />"         , $text );
$text = str_replace( "*Smile192.gif*"				, "<img title=\"*Smile192.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile192.gif\" />"         , $text );
$text = str_replace( "*Smile191.gif*"				, "<img title=\"*Smile191.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile191.gif\" />"         , $text );
$text = str_replace( "*Smile090.gif*"				, "<img title=\"*Smile090.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile090.gif\" />"         , $text );
$text = str_replace( "*huh.gif*"				, "<img title=\"*huh.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/huh.gif\" />"         , $text );
$text = str_replace( "*Smile077.gif*"				, "<img title=\"*Smile077.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile077.gif\" />"         , $text );
$text = str_replace( "*Smile100.gif*"				, "<img title=\"*Smile100.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile100.gif\" />"         , $text );
$text = str_replace( "*happy.gif*"				, "<img title=\"*happy.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/happy.gif\" />"         , $text );
$text = str_replace( "*Smile144.gif*"				, "<img title=\"*Smile144.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile144.gif\" />"         , $text );
$text = str_replace( "*Smile021.gif*"				, "<img title=\"*Smile021.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile021.gif\" />"         , $text );
$text = str_replace( "*Smile073.gif*"				, "<img title=\"*Smile073.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile073.gif\" />"         , $text );
$text = str_replace( "*ohmy.png*"				, "<img title=\"*ohmy.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/ohmy.png\" />"         , $text );
$text = str_replace( "*Smile224.gif*"				, "<img title=\"*Smile224.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile224.gif\" />"         , $text );
$text = str_replace( "*Smile142.gif*"				, "<img title=\"*Smile142.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile142.gif\" />"         , $text );
$text = str_replace( "*Smile041.gif*"				, "<img title=\"*Smile041.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile041.gif\" />"         , $text );
$text = str_replace( "*Smile211.gif*"				, "<img title=\"*Smile211.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile211.gif\" />"         , $text );
$text = str_replace( "*Smile070.gif*"				, "<img title=\"*Smile070.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile070.gif\" />"         , $text );
$text = str_replace( "*smile.png*"				, "<img title=\"*smile.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/smile.png\" />"         , $text );
$text = str_replace( "*Smile162.gif*"				, "<img title=\"*Smile162.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile162.gif\" />"         , $text );
$text = str_replace( "*Smile148.gif*"				, "<img title=\"*Smile148.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile148.gif\" />"         , $text );
$text = str_replace( "*Smile236.gif*"				, "<img title=\"*Smile236.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile236.gif\" />"         , $text );
$text = str_replace( "*smile.gif*"				, "<img title=\"*smile.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/smile.gif\" />"         , $text );
$text = str_replace( "*Smile078.gif*"				, "<img title=\"*Smile078.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile078.gif\" />"         , $text );
$text = str_replace( "*Smile082.gif*"				, "<img title=\"*Smile082.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile082.gif\" />"         , $text );
$text = str_replace( "*blush.gif*"				, "<img title=\"*blush.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/blush.gif\" />"         , $text );
$text = str_replace( "*Smile137.gif*"				, "<img title=\"*Smile137.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile137.gif\" />"         , $text );
$text = str_replace( "*Smile131.gif*"				, "<img title=\"*Smile131.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile131.gif\" />"         , $text );
$text = str_replace( "*Smile204.gif*"				, "<img title=\"*Smile204.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile204.gif\" />"         , $text );
$text = str_replace( "*Smile141.gif*"				, "<img title=\"*Smile141.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile141.gif\" />"         , $text );
$text = str_replace( "*Smile053.gif*"				, "<img title=\"*Smile053.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile053.gif\" />"         , $text );
$text = str_replace( "*Smile155.gif*"				, "<img title=\"*Smile155.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile155.gif\" />"         , $text );
$text = str_replace( "*Smile214.gif*"				, "<img title=\"*Smile214.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile214.gif\" />"         , $text );
$text = str_replace( "*Smile095.gif*"				, "<img title=\"*Smile095.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile095.gif\" />"         , $text );
$text = str_replace( "*Smile046.gif*"				, "<img title=\"*Smile046.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile046.gif\" />"         , $text );
$text = str_replace( "*Smile105.gif*"				, "<img title=\"*Smile105.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile105.gif\" />"         , $text );
$text = str_replace( "*Smile036.gif*"				, "<img title=\"*Smile036.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile036.gif\" />"         , $text );
$text = str_replace( "*Smile093.gif*"				, "<img title=\"*Smile093.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile093.gif\" />"         , $text );
$text = str_replace( "*wink.png*"				, "<img title=\"*wink.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/wink.png\" />"         , $text );
$text = str_replace( "*sad.png*"				, "<img title=\"*sad.png*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/sad.png\" />"         , $text );
$text = str_replace( "*Smile200.gif*"				, "<img title=\"*Smile200.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile200.gif\" />"         , $text );
$text = str_replace( "*Smile234.gif*"				, "<img title=\"*Smile234.gif*\" src=\"http://forums.arena-wow.ru/public/style_emoticons/default/Smile234.gif\" />"         , $text );
$text = str_replace( "*fail*"			        	, "<img title=\"*fail*\" src=\"http://skaip-app.appspot.com/static/img/emoticons/v2/facepalm.gif\" />"         , $text );
return $text;
}
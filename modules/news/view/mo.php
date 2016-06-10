<?

$result = $this->MySQL->query("SELECT * FROM `news` WHERE guid='$id'");

if (!$result)
{
    log::error("ERROR_MYSQL_READ_NEWS");
    return;
}

while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
    $tpl     = parent::initTpl('view/view');

    $guid        = $row['guid'];
    $author_name = $row['author_name'];
    $title       = $row['title'];
    $text        = $row['text_full'];
    $time        = $row['time'];

    $text = $this->screen->ScreeningBB($text);
    $text = $this->screen->viewUrl($text);

    $tpl->Set('news_title', $title);
    $tpl->Set('news_description', $text);
    $tpl->Set('news_date', $this->core->time->GetDate(1, 1, 0, 1, $time));
    $tpl->Set('author_name', $author_name);

    parent::make($tpl);

    $autch = $this->ses->getAutch();
    if ($autch)
    {
        $tpl = parent::initTpl('view/commentadd');
        $tpl->Set('news_id', $guid);
    }
    else
        $tpl = parent::initTpl('view/commentaddautch');

    parent::make($tpl);
}

$result = $this->MySQL->query("SELECT * FROM `comments` WHERE type=1 AND blocked=0 AND id='$id' ORDER BY `guid` DESC");

if (!$result)
{
    log::error("ERROR_MYSQL_COMMENTS_SELECT_IN_NEWS");
    return;
}

while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
    $tpl = parent::initTpl('view/comments');

    $guid     = $row['guid'];
    $userid   = $row['userid'];
    $username = $row['username'];
    $text     = $row['text'];
    $time     = $row['time'];
    $ava      = $row['ava'];
    $raiting      = $row['raiting'];
    
    $text = $this->screen->ScreeningBB($text);
    
    $raiting = $raiting > 0 ? "+".$raiting : $raiting;
    $raiting = $raiting < -1000 ? "Fatal Error" : $raiting;

    $tpl->Set('comment_id', $guid);
    $tpl->Set('comment_user_avatar', $ava);
    $tpl->Set('comment_username', $username);
    $tpl->Set('comment_text', $text);
    $tpl->Set('comment_raiting', $raiting);
    $tpl->Set('comment_date', $this->core->time->GetDate(1, 1, 0, 1, $time));

    parent::make($tpl);
}



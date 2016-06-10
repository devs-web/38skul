<?

    if($this->admin->Sec->NEWS)
    {
        $tplNews     = parent::initTpl('admin/newsadd');
        parent::make($tplNews);
    }

        $result = $this->MySQL->query("SELECT * FROM `news` ORDER BY guid DESC");
        if(!$result) return;
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            if($this->admin->Sec->NEWS)
                $tplNews     = parent::initTpl('admin/news');
            else
                $tplNews     = parent::initTpl();

            $author_name = $row['author_name'];
            $guid        = $row['guid'];
            $title       = $row['title'];
            $text        = $this->gv->make($row['text']);
            $time        = $row['time'];

            $text = $this->screen->ScreeningBB($text);
            $text = $this->screen->viewUrl($text);

            $tplNews->Set('news_id', $guid);
            $tplNews->Set('news_title', $title);
            $tplNews->Set('news_description', $text);
            $tplNews->Set('news_date', $this->core->time->GetDate(1, 1, 0, 1, $time));
            $tplNews->Set('author_name', $author_name);

            parent::make($tplNews);
        }

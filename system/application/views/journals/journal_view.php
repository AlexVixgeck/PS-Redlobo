<div class="basic-box">
    

<div class="entry">
    <div class="header">
        <div class="avatar FINISHME"><img src="<? echo $this->cdn->cdn_url(); ?>/avatars/<?=$journal_avatar_location ?>"/></div>
        <div class="author">
            

<span class="userlink">
    <a href="/~<?=$journal_username?>" class="js-userlink-target"><?=$journal_username?></a>
</span>

        </div>
        <h3><a href="/~<?=$journal_username?>/journals/<?=$journal_entry['id']?>"><?=$journal_entry['title']?></a></h3>
        <div class="date"><?=$journal_entry['time']?></div>
    </div>
    <div class="message">
		<?=$journal_entry['content']?>
    </div>
</div>


    
</div>

<div class="basic-box">
    <h2> <img alt="" src="/images/icons/h2-comments.png" title="" /> Comments </h2>
    need comment loop in view.
</div>


<div class="basic-box">

    <h2>Journal for 
<span class="userlink">
    <a href="/~<?=$journal_username;?>" class="js-userlink-target"><?=$journal_username;?></a>
</span>
</h2>
    
    
<?php foreach($journal_entries as $entry):?>
<?php $username = $this->user_model->get_username_by_id($entry['user_id']);?>

<div class="entry">
    <div class="header">

        <div class="avatar FINISHME"><img src="<? echo $this->cdn->cdn_url() . 'avatars/' . $this->avatar_model->get_avatar($entry['user_id']); ?>" alt="avatar"/></div>
        <div class="author">
            
<span class="userlink">
    <a href="/~<?=$username;?>" class="js-userlink-target"><?=$username;?></a>
</span>

        </div>
        <h3><a href="/~<?=$username;?>/journals/<?=$entry['id']; ?>"><?=$entry['title']; ?></a></h3>
        <div class="date"><?=$entry['time']; ?></div>

    </div>
    <div class="message">
            <?=$entry['content']; ?>
    </div>
</div>

<?php endforeach;?>
    

</div>

<div class="basic-box">

    <h2>Journal for 
<span class="userlink">
    <a href="/~<?=$journal_username;?>" class="js-userlink-target"><?=$journal_username;?></a>
</span>
</h2>
    
    
<?php foreach($journal_entries as $entry):?>

<div class="entry">
    <div class="header">

        <div class="avatar FINISHME"><img src="<?=$journal_avatar_location; ?>" alt="avatar"/></div>
        <div class="author">
            
<span class="userlink">
    <a href="/~<?=$journal_username;?>" class="js-userlink-target"><?=$journal_username;?></a>
</span>

        </div>
        <h3><a href="/~<?=$journal_username;?>/journals/<?=$entry['id']; ?>"><?=$entry['title']; ?></a></h3>
        <div class="date"><?=$entry['time']; ?></div>

    </div>
    <div class="message">
            <?=$entry['content']; ?>
    </div>
</div>

<?php endforeach;?>
    

</div>

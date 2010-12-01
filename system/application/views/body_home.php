
<div class="columns32-left">

    <div class="basic-box">
        <h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Recent Submissions</h2>
       
		<div class="basic-box-center">
<ul class="thumbnail-grid">
<!-- comment to remove intervening whitespace
    -->
	<?
	foreach($latest_submissions as $submission)
	{
		//echo '	<li id="sub1">';
		if($submission['adult'] == 0) {
		echo '<li class="">';
		}
		else {
		echo '<li class="adult">';
		}
		echo '		<a href="' . site_url() . 'view/' . $submission['id'] . '">';
		echo '			<span class="thumbnail"><img alt="' . $submission['title'] . '" src="' . $this->cdn->cdn_url() . 'submissions/' . $submission['owner_id'] . '/thumb.' . $submission['filename'] . '" title="' . $submission['title'] . '"></span>';
		echo ' 			<span class="title">' . $submission['title'] . '</span>';
		echo '			</a><a href="' . site_url() . '~' . $submission['owner_name'] . '">';
		echo '			<span class="user">' . $submission['owner_name'] . '</span>';
		echo '		</a>';
		echo '	</li>';
	}
	?>
	<!--
-->
</ul>
		</div>

    </div>
</div>

<!-- News -->

<div class="columns32-right">
    <div class="basic-box">
        <h2><img alt="" src="/images/icons/h2-news.png" title="" /> News</h2>

<!-- Start News Item -->

<?php foreach($news_data as $news_item): ?>

<div class="entry">
    <div class="header">

        <div class="avatar">
            <img alt="<?php echo $news_item['username']; ?>" src="<? echo $this->cdn->cdn_url(); ?>avatars/<? echo $this->avatar_model->get_avatar($news_item['user_id']); ?>" title="<?php echo $news_item['username']; ?>" />
        </div>

        <div class="author">
<span class="userlink">
    <a href="/~<?php echo $news_item['username']; ?>" class="js-userlink-target"><?php echo $news_item['username']; ?></a>
</span>
</div>
        <h3><a href="/news/<?php echo $news_item['id']; ?>"><?php echo $news_item['title']; ?></a></h3>

        <div class="date"><?php echo $this->time->unix_time_to_date($news_item['timestamp']); ?></div>
    </div>
    <div class="message">
            <?php echo $news_item['content']; ?>
    </div>
</div>


<?php endforeach;?>

<!-- End News Item -->

    </div>
	
	 <div class="basic-box">
        <h2><img alt="" src="/images/icons/star.png" title="" /> Featured Submission</h2>
		<div class="basic-box-center">
			<img src="<? echo $this->cdn->cdn_url(); ?>submissions/<? echo $featured_submission['owner_id'] . '/half.' . $featured_submission['filename']; ?>">
		</div>
	</div>
</div>


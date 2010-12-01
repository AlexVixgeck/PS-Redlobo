<div class="columns-left">
	<div class="basic-box">
		<h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Featred Submission</h2>
		<p>Stuffs...</p>
	</div>
	<div class="basic-box">
		<h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Latest Submissions</h2>
		<div class="basic-box-center">
			<ul class="thumbnail-grid">
			<!-- comment to remove intervening whitespace -->
			<?
				foreach($latest_submissions as $submission)
				{
					echo '	<li id="sub1">';
					echo '		<a href="' . site_url() . 'view/' . $submission['id'] . '">';
					echo '			<span class="thumbnail"><img alt="' . $submission['title'] . '" src="' . $this->cdn->cdn_url() . 'submissions/' . $submission['owner_id'] . '/thumb.' . $submission['filename'] . '" title="' . $submission['title'] . '"></span>';
					echo '		</a>';
					echo '	</li>';
				}
			?>
			<!-- -->
			</ul>
		</div>
	</div>
	<div class="basic-box">
		<h2><img alt="" src="/images/icons/h2-featured.png" title="" /> Favorites</h2>
		
		<div class="basic-box-center">
			<ul class="thumbnail-grid">
			<!-- comment to remove intervening whitespace -->
			<?
				foreach($fav_entries as $fav)
				{
					echo '	<li id="sub1">';
					echo '		<a href="' . site_url() . 'view/' . $fav['id'] . '">';
					echo '			<span class="thumbnail"><img alt="' . $fav['title'] . '" src="' . $this->cdn->cdn_url() . 'submissions/' . $fav['owner_id'] . '/thumb.' . $fav['filename'] . '" title="' . $fav['title'] . '"></span>';
					echo ' 			<span class="title">' . $fav['title'] . '</span>';
					echo '			</a><a href="' . site_url() . '~' . $fav['owner_name'] . '">';
					echo '			<span class="user">' . $fav['owner_name'] . '</span>';
					echo '		</a>';
					echo '	</li>';
				}
			?>
			<!-- -->
			</ul>
		</div>
		
	</div>
	<div class="basic-box">
		<h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Watched By</h2>
		<div class="basic-box-center">
			<ul class="small-thumbnail-grid">
			<?
			foreach($watched_by as $watching_user)
			{
				$username = $this->user_model->get_username_by_id($watching_user['user_id']);
				echo '	<li id="sub1">';
				echo '		<a href="' . site_url() . '~' . $username . '">';
				echo '			<span class="thumbnail"><img alt="' . $username . '" src="' . $this->cdn->cdn_url() . 'avatars/' . $this->avatar_model->get_avatar($watching_user['user_id']) . '" title="' . $username . '"></span>';
				echo '		</a>';
				echo '	</li>';
			}
			?>
			</ul>
			<a href="/~<? echo $dash_username; ?>/list">List all (<? echo $this->watchstream_model->get_watchstream_watchers_count($profile_user_id); ?>)</a>
		</div>
	</div>
		<div class="basic-box">
		<h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Is Watching</h2>
		<div class="basic-box-center">
			<ul class="small-thumbnail-grid">
			<?
			foreach($is_watching as $watching_user)
			{
				$username = $this->user_model->get_username_by_id($watching_user['watched_user_id']);
				echo '	<li id="sub1">';
				echo '		<a href="' . site_url() . '~' . $username . '">';
				echo '			<span class="thumbnail"><img alt="' . $username . '" src="' . $this->cdn->cdn_url() . 'avatars/' . $this->avatar_model->get_avatar($watching_user['watched_user_id']) . '" title="' . $username . '"></span>';
				echo '		</a>';
				echo '	</li>';
			}
			?>
			</ul>
			<a href="/~<? echo $dash_username; ?>/list">List all (<? echo $this->watchstream_model->get_watchstream_is_watching_count($profile_user_id); ?>)</a>
		</div>
	</div>
</div>

<div class="columns-right">

<div class="basic-box">
    <h2><img alt="" src="/images/icons/h2-journal.png" title="" /> Journal</h2>

    <?php foreach($journal_entries as $journal_entry):?>

		<?php print('<div class="latest-journal">
        <h3>' . $journal_entry['title'] . '</h3>
        <p class="timestamp">' . $journal_entry['time'] . '</p>
        <div class="message TODO">
            ' . $journal_entry['content'] . '
        </div>
              
        
        <ul class="inline links">
            <li><a class="button" href="/~' . $dash_username . '/journals/' . $journal_entry['id'] . '"><img alt="" src="/images/icons/link-comments.png" title="" /> 0 comments</a></li>
        </ul>
    </div>

    <ul class="recent-journals">
    </ul>'); ?>

	<?php endforeach;?>

</div>

<div class="basic-box TODO">
    <h2><img alt="" src="/images/icons/h2-shouts.png" title="" /> Shouts</h2>

    

    <ul class="shoutbox">
        <li>
		<?
		foreach($shouts as $shout)
		{
			echo '<div class="avatar"><img alt="" src="' . $this->cdn->cdn_url() . 'avatars/' . $this->avatar_model->get_avatar($shout['from_user_id']) . '" title="" /></div>';
			echo '	<div class="'; if($shout['private'] == 1) { echo 'header-private'; } else { echo 'header'; } '">';
			echo '		<span class="userlink">';
			echo '			<a href="/~' . $this->user_model->get_username_by_id($shout['from_user_id']) . '" class="js-userlink-target"> ' . $this->user_model->get_username_by_id($shout['from_user_id']) . '</a>';
			echo '		</span>';
			echo '      <span class="timestamp">' . $this->time->unix_time_to_date($shout['timestamp']) . '</span>';
			echo '	</div>';
			echo '	<div class="message">';
			echo $shout['message'];
			echo '	</div>';
		}
		?>
        </li>
    </ul>
	
	<?
	if($is_logged_in){
	echo '<div class="basic-box">';
	echo '	<div class="shout-form">';
	echo '		<form name="shout" action="' . site_url() . 'shouts/post" method="post">';
	echo '			<textarea name="shout_message" cols="25" rows="5"></textarea>';
	echo '			<div class="shout-form-bottom">';
	echo '				Make Private: <input type="checkbox" name="private" value="1" />';
	echo '				<input type="hidden" name="from_user_id" value="' . $shout_from_user_id . '" />';
	echo '				<input type="hidden" name="for_user_id" value="' . $shout_for_user_id . '" />';
	echo '				<input type="submit" value="Submit" />';
	echo '			</div>';
	echo '		</form>';
	echo '	</div>';
	echo '</div>';
	}
	?>
	
</div>
</div>


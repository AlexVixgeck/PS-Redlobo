<div class="columns-left">
	<div class="basic-box">
		<h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> New Watchstream Submissions</h2>
		<div class="basic-box-center">
			<ul class="thumbnail-grid">
			<!-- comment to remove intervening whitespace -->
			<?
				foreach($watchstream_submissions as $submission)
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
	
	
		
</div>

<div class="columns-right">

<div class="basic-box">
    <h2><img alt="" src="/images/icons/h2-journal.png" title="" /> New Watchstream Comments</h2>


</div>

<div class="basic-box">
    <h2><img alt="" src="/images/icons/h2-journal.png" title="" /> Watchstream Journals</h2>

    <?php
	foreach($watchstream_journals as $journal_entry) {
		echo '<div class="latest-journal">';
        echo '	<h3>' . $journal_entry['title'] . ' - ' . $this->user_model->get_username_by_id($journal_entry['user_id']) . '</h3>';
        echo '	<p class="timestamp">' . $journal_entry['time'] . '</p>';
        echo '	<div class="message TODO">';
        echo $journal_entry['content'];
        echo '	</div>';
        echo '	<ul class="inline links">';
        echo '		<li><a class="button" href="/~' . $this->user_model->get_username_by_id($journal_entry['user_id']) . '/journals/' . $journal_entry['id'] . '"><img alt="" src="/images/icons/link-comments.png" title="" /> 0 comments</a></li>';
        echo '	</ul>';
		echo '</div>';
		echo '<ul class="recent-journals">';
		echo '</ul>';
	}
	?>

</div>

</div>


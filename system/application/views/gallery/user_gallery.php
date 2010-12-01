<div class="basic-box">
<div class="basic-box-center">
<ul class="thumbnail-grid">
<!-- comment to remove intervening whitespace
    -->
	<?
	foreach($latest_submissions as $submission)
	{
		echo '	<li id="sub1">';
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
</div>
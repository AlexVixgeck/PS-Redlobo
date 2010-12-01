<?
echo '<ul class="thumbnail-grid">';
foreach($submissions as $submission){
echo '	<li id="sub1">';
echo '		<a href="'  . 'view/' . $submission['id'] . '">';
echo '			<span class="thumbnail"><img alt="' . $submission['title'] . '" src="http://data.fur.indiebeats.org/submissions/' . $submission['owner_id'] . '/thumb.' . $submission['filename'] . '" title="' . $submission['title'] . '"></span>';
echo ' 			<span class="title">' . $submission['title'] . '</span>';
echo '		</a>';
echo '	</li>';
}
echo '</ul>';

?>
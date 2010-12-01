<div class="gallery_nav-box">

	<div class="gallery_nav">
	
		<?
		if($nav_left_link > 0) {
			echo '<div class="page_left"><a href="' . site_url() . '~' . $username . '/gallery/' . $nav_left_link . '"><img src="' . site_url() . 'images/icons/arrow-transition-180.png"></a></div>';
		}
		else {
			echo '<div class="page_left"></div>';
		}
		
		if($nav_right_link > 0) {
			echo '<div class="page_right"><a href="' . site_url() . '~' . $username . '/gallery/' . $nav_right_link . '"><img src="' . site_url() . 'images/icons/arrow-transition.png"></a></div>';
		}
		else {
			echo '<div class="page_right"></div>';
		}
		?>
	</div>
	
</div>
<div class="basic-box"><h2> Browse</h2></div>

<div class="gallery_nav-box">

	<div class="gallery_nav">
	
		<?
		if($nav_left_link > 0) {
			echo '<div class="page_left"><a href="/browse/' . $nav_left_link . '"><img src="' . site_url() . 'images/icons/arrow-transition-180.png"></a></div>';
		}
		else {
			echo '<div class="page_left"></div>';
		}
		
		if($nav_right_link > 0) {
			echo '<div class="page_right"><a href="/browse/' . $nav_right_link . '"><img src="' . site_url() . 'images/icons/arrow-transition.png"></a></div>';
		}
		else {
			echo '<div class="page_right"></div>';
		}
		?>
	</div>
	
</div>
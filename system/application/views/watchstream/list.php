<div class="basic-box">
	
	<div class="basic-box">
		<h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Watching By</h2> 
		
		<div class="basic-box-center">
        
		<ul class="thumbnail-grid"> 
<!-- comment to remove intervening whitespace
    -->
			<?
			foreach($watched_by as $is_watched_by_user)
			{
			$username = $this->user_model->get_username_by_id($is_watched_by_user['user_id']);
			echo '<li id="sub1">';		
			echo '	<a href="' . site_url() . '~' . $username . '">';			
			echo '		<span class="thumbnail"><img alt="' . $username . '" src="' . $this->cdn->cdn_url() . 'avatars/' . $this->avatar_model->get_avatar($is_watched_by_user['user_id']) . '" title="' . $username . '"></span>';
			echo '		<span class="user">' . $username . '</span>';
			echo '	</a>';
			echo '</li>';
			}
			?>
		</ul> 
		</div>
	</div>
	
	<div class="basic-box">
		<h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Is Watching</h2> 
        
		<div class="basic-box-center">
		<ul class="thumbnail-grid"> 
<!-- comment to remove intervening whitespace
    -->
			<?
			foreach($is_watching as $is_watching_user)
			{
			$username = $this->user_model->get_username_by_id($is_watching_user['watched_user_id']);
			echo '<li id="sub1">';		
			echo '	<a href="' . site_url() . '~' . $username . '">';			
			echo '		<span class="thumbnail"><img alt="' . $username . '" src="' . $this->cdn->cdn_url() . 'avatars/' . $this->avatar_model->get_avatar($is_watching_user['watched_user_id']) . '" title="' . $username . '"></span>';
			echo '		<span class="user">' . $username . '</span>';
			echo '	</a>';
			echo '</li>';
			}
			?>
		</ul> 
		</div>
	</div>
   
</div>



    </div>
</div>
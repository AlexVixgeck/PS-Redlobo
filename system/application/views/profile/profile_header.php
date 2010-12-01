<div id="user-header">

    <img alt="<?=$profile_username?>" class="avatar TODO" src="<? echo $this->cdn->cdn_url(); ?>avatars/<?=$profile_avatar_filename?>" title="<?=$profile_username?>" />
    <div id="user-header-name">
        <span id="user-header-name-handle"><?=$profile_username?></span>
        <!-- <span id="user-header-name-alias" class="TODO">aka..  Eevee?</span> -->
    </div>
	
	<div id="user-header-actions">
		<!-- <span id="user-header-name-alias" class="TODO">aka..  Eevee?</span> -->
		
	</div>
	
	
		<ul class="tab-bar">

        
			<li><a class="<? if($profile_location == 1) { echo "you-are-here"; } ?>" href="/~<?=$profile_username?>"><img alt="" src="/images/icons/link-user-recent.png" title="" />Dash</a></li>
        
			<li><a class="<? if($profile_location == 2) { echo "you-are-here"; } ?>" href="/~<?=$profile_username?>/profile"><img alt="" src="/images/icons/link-user-profile.png" title="" />Profile</a></li>
        
			<li><a class="<? if($profile_location == 3) { echo "you-are-here"; } ?>" href="/~<?=$profile_username?>/journals"><img alt="" src="/images/icons/link-user-journal.png" title="" />Journal</a></li>
        
			<li><a class="<? if($profile_location == 4) { echo "you-are-here"; } ?>" href="/~<?=$profile_username?>/gallery"><img alt="" src="/images/icons/link-user-gallery.png" title="" />Gallery</a></li>
			
			<li><a class="<? if($profile_location == 5) { echo "you-are-here"; } ?>" href="/~<?=$profile_username?>/watch"><img alt="" src="/images/icons/book-plus.png" title="" />Watch</a></li>
			
			<li><a class="<? if($profile_location == 6) { echo "you-are-here"; } ?>" href="/~<?=$profile_username?>/notes/write"><img alt="" src="/images/icons/note-plus.png" title="" />Send Note</a></li>
		</ul>
		
		<div class="sub-bar-thing">more stuff here yeah</div>


	
	
	
	
    
		

		 
	
	


</div>


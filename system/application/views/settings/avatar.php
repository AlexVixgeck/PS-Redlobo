
<div class="profile-settings">

    <div class="basic-box">
        <h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Avatar</h2>
		<p>Current Avatar:</p>
		<img src="<? echo $this->cdn->cdn_url(); ?>avatars/<? echo $current_avatar?>">

		<? echo validation_errors(); ?>
		<? if(isset($upload_error)) { echo $upload_error; } ?>

		<?php echo form_open_multipart(site_url() . 'settings/avatar_upload'); ?>
	    	<dl class="standard-form">
    	    	<dt>Avatar Location</dt>
        		<dd><? echo form_upload('location'); ?></dd>
			</dl>
    		<p><? echo form_submit('submit', 'Save Avatar'); ?></p>
    	<? echo form_close(); ?>
        
</div>

</div>


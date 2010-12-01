
<div class="profile-settings">

    <div class="basic-box">
        <h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> User Info</h2>
		<form name="info" action="<? echo site_url() . '~' . $this->dx_auth->get_username() . '/settings/update'; ?>" method="post">
		Allow Adult Images: <input type="checkbox" name="AllowAdult" value="1" <? if($preferences['allow_adult'] == 1) { echo 'checked'; } ?>/>
		<input name="Submit" value="Submit" type="Submit"></input>
		</form>
        
</div>

</div>


<div class="basic-box">

  
        
        
<div class="submission-content">
<!-- comment to remove intervening whitespace
    -->
		<a href="<? echo $this->cdn->cdn_url() . "submissions/" . $submission_owner_id . "/" . $submission_filename; ?>"><img src="<? echo $this->cdn->cdn_url() . "submissions/" . $submission_owner_id . "/half." . $submission_filename; ?>"></img></a>

    <!--
-->
</div>

<div class="basic-box">
	<h2><? echo $submission_title; ?></h2><br>
	<div class="metadata">
	Category: <? echo $submission_category; ?><br>
	Media Type: <? echo $submission_media_type; ?><br>
	Date: <? echo $submission_time; ?><br>
	Views: <? echo $submission_views; ?><br>
	Res: <? echo $submission_xres . 'x' . $submission_yres; ?><br>
	<a href="<? echo site_url() . 'fav/' . $submission_id; ?>"><b>+Fav</b></a><br>
	</div>
	
	
	<? echo $submission_description; ?>
	
</div>



</div>
<div class="basic-box">


<div class="columns32-left"> 
 
    <div class="basic-box"> 
        <h2><img alt="" src="/images/icons/plus.png" title="" /> Submission Upload Success</h2> 
        
		<div class="basic-box">
		<!-- comment to remove intervening whitespace
		-->
			<form name="approve_submission_form" action="publish" enctype="multipart/form-data" method="post">
			Title: <input type="text" name="title"><br>
			
			Description: <textarea name="description" rows="4"></textarea><br>
			
			Keywords: <input type="text" name="keywords"><br>
			
			Category: <select name="category_id">
				<?
				foreach($category_types as $category)
				{
					print('<option value="' . $category['id'] . '">' . $category['type'] . '</option>');
				}
				?>
			</select><br>
			
			Media Type: <select name="media_type_id">
				<?
				foreach($media_types as $type)
				{
					print('<option value="' . $type['id'] . '">' . $type['type'] . '</option>');
				}
				?>
			</select><br>
			
			Adult: <input type="checkbox" name="adult" value="1"><br>
			
			<input type="hidden" name="submission_id" value="<? echo $submission_id; ?>">
			
			<input type="submit" value="Upload">
			</form>
		<!--
		-->
		</div>
 
    </div> 
</div> 





 
<div class="columns32-right"> 
    <div class="basic-box"> 
        <h2><img alt="" src="/images/icons/plus.png" title="" /> Preview</h2> 
 
		<div class="basic-box-center">
		<!-- comment to remove intervening whitespace
		-->
			<img src="<? echo $this->cdn->cdn_url() . 'submissions/' . $user_id . '/half.' . $filename; ?>"><br>
		<!--
		-->
		</div>
		

 
    </div> 
</div>

</div>




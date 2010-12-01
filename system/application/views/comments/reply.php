<div class="basic-box-center">
	<div class="basic-box">
		<form name="comment-reply" action="<? echo base_url() . 'comments/publish' ?>" method="post">
			<?
			echo '<input type="hidden" name="submission_id" value="' . $submission_id . '">';
			echo '<input type="hidden" name="type_id" value="' . $type_id . '">';
			if(isset($parent_id))
			{
				echo '<input type="hidden" name="parent_id" value="' . $parent_id . '">';
				echo 'In Reply To: ' . $this->user_model->get_username_by_id($this->comments_model->get_author_id($parent_id)) . '<br>';
			}
			?>
			<br>Subject: <input type="text" name="subject" value="">
			<br><textarea name="comment" rows="15" cols="100"></textarea>
			<br><input type="submit" name="submit">
		</form>
	</div>
</div>


    </div>
</div>
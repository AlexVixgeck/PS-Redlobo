<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment {

	var $CI;

	function Comment()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->library('cdn');

		$this->CI->load->model('comments_model');
		$this->CI->load->model('user_model');
		$this->CI->load->model('avatar_model');
	}
	
	function print_comments($submission_id, $parent = 0)
	{
		$comments = $this->get_comments($submission_id, $parent);
	
		foreach($comments as $comment)
		{
			
			echo '<div class="comment" style="margin-left:' . $comment['level'] * 20 . 'px;">';
			echo '	<div class="header">';
			echo '		<div class="author">';
			echo $this->CI->user_model->get_username_by_id($comment['author_id']);
			echo '			<div class="avatar FINISHME"><img src="' . $this->CI->cdn->cdn_url() . 'avatars/' . $this->CI->avatar_model->get_avatar($comment['author_id']) . '" alt="avatar"/></div>';
			echo '		</div>';
			echo '		<div class="title">';
			echo '			<a href="/comments/view/' . $comment['id'] . '"><span class="title">' . $comment['title'] . '</span></a>';
			echo '		</div>';
			echo '		<div class="date">' . $this->CI->time->unix_time_to_date($comment['timestamp']) . '</div>';
			echo '	</div>';
			echo '	<div class="message">';
			echo $comment['comment'] . '<B>' . $comment['level'] . '</B>';
			echo '	</div>';
			echo '	<ul class="inline actions">';
			echo '		<li><a href="/comments/reply/' . $comment['submission_id'] . '/' . $comment['submission_type'] . '/' . $comment['id'] . '"><img src="/images/icons/link-reply.png"></a></li>';
			echo '	</ul>';
			echo '</div>';
			
			$this->print_comments($submission_id, $comment['id']);
		}
	}
	
	function get_comments($submission_id, $parent = 0)
	{
		$comment = $this->CI->comments_model->get_submission_comment_children($submission_id, $parent);
		return $comment;
		/*
			echo '<div class="comment" style="margin-left:40px;">';
			echo '	<div class="header">';
			echo '		<div class="author">';
			echo $this->CI->user_model->get_username_by_id($comment['author_id']);
			echo '			<div class="avatar FINISHME"><img src="' . $this->cdn->cdn_url() . 'avatars/' . $this->avatar_model->get_avatar($comment['author_id']) . '" alt="avatar"/></div>';
			echo '		</div>';
			echo '		<div class="title">';
			echo '			<a href="/comments/view/$comment_id"><span class="title">' . $comment['title'] . '</span></a>';
			echo '		</div>';
			echo '		<div class="date">' . $this->CI->time->unix_time_to_date($comment['timestamp']) . '</div>';
			echo '	</div>';
			echo '	<div class="message">';
			echo $comment['comment'];
			echo '	</div>';
			echo '	<ul class="inline actions">';
			echo '		<li><a href="reply"><img src="/images/icons/link-reply.png"></a></li>';
			echo '	</ul>';
			echo '</div>';
			
		*/
	}
}

?>

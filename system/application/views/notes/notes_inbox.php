
<div class="basic-box">
    <h2>
	<?
	if($mailbox_type == 1) { echo 'Inbox'; }
	if($mailbox_type == 2) { echo 'Sent Notes'; }
	?>
	</h2>
	<div class="basic-box-center">

    <table class="bare-table">

    <col class="status-icon"/>
    <col class="time"/>
    <col class="user"/>
    <col class="subject"/>

<?php foreach($messages as $message):?>

	<tr>
		<td><? if($message['read'] == 0) { echo '<img src="/images/icons/new.png">'; } ?></td>
		<td><? echo '<a href="/~' . $this->dx_auth->get_username() . '/notes/read/' . $message['id'] . '">' . $message['title'] . '</a>'; ?></td>
		<td><? echo '<a href="/~' . $message['username'] . '/">' . $message['username'] . '</a>'; ?></td>
		<td><? echo $this->time->unix_time_to_date($message['time']); ?></td>
	</tr>

<?php endforeach;?>

    </table>

    <p> <?=$pagination_html;?> </p>
	</div>
</div>



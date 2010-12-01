<div class="basic-box">
    <h2><? echo $message['title']; ?></h2>

    <dl class="standard-form">
        <dt>From: </dt>
        <dd><? echo $this->user_model->get_username_by_id($message['from_user_id']); ?></dd><br>
        <dt>Sent</dt>
        <dd><? echo $this->time->unix_time_to_date($message['time']); ?></dd><br>
        <dt>Message</dt>
        <dd><p><? echo $message['content']; ?></p></dd>
    </dl>

</div>


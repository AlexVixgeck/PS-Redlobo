<div class="basic-box">
    <h2>Send note</h2>

    <form action="/~<? echo $rcpt_username; ?>/notes/send" method="post">
    <dl class="standard-form">
        <dt>To</dt>
        <dd><input name="recipient" type="text" value="<? echo $rcpt_username; ?>" /></dd>

        <dt>Subject</dt>
        <dd><input name="subject" type="text" /></dd>
        <dt>Message</dt>
        <dd><textarea cols="80" name="content" rows="10"></textarea></dd>
    </dl>
	<input type="hidden" name="to_user_id" value="<? echo $to_user_id; ?>" />
    <p><input type="submit" value="Send" /></p>
    </form>

</div>


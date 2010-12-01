<div class="basic-box">
    <h2>Post Journal</h2>

    <form action="/~<?=$journal_username;?>/journals/post_p" method="post">
    <dl class="standard-form">
        <dt>Title</dt>
        <dd><input name="title" type="text" /></dd>

    </dl>
    <p><textarea cols="80" name="content" rows="10"></textarea></p>

    <p><input type="submit" value="Save" /></p>
    </form>

</div>


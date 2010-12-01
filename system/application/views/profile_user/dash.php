<div class="columns-left">
<div class="basic-box TODO">
    <h2><img alt="" src="/images/icons/h2-featured.png" title="" /> Recently Watched</h2>

    <p>Recently Watched Bands.</p>

</div>
<div class="basic-box">
    <h2><img alt="" src="/images/icons/h2-gallery.png" title="" /> Member</h2>

    <p>Member of these bands.</p>
</div>
</div>
<div class="columns-right">

<div class="basic-box">
    <h2><img alt="" src="/images/icons/h2-journal.png" title="" /> Journal</h2>

    <?php foreach($journal_entries as $journal_entry):?>

		<?php print('<div class="latest-journal">
        <h3>' . $journal_entry['title'] . '</h3>
        <p class="timestamp">' . $journal_entry['time'] . '</p>
        <div class="message TODO">
            ' . $journal_entry['content'] . '
        </div>
              
        
        <ul class="inline links">
            <li><a class="button" href="/~' . $dash_username . '/journals/' . $journal_entry['id'] . '"><img alt="" src="/images/icons/link-comments.png" title="" /> 0 comments</a></li>
        </ul>
    </div>

    <ul class="recent-journals">
    </ul>'); ?>

	<?php endforeach;?>

</div>

<div class="basic-box TODO">
    <h2><img alt="" src="/images/icons/h2-shouts.png" title="" /> Shouts</h2>

    

    <ul class="shoutbox">
        <li>
            <div class="avatar"><img alt="" src="/avatars/default.jpg" title="" /></div>

            <div class="header">
                
<span class="userlink">
    <a href="/~guest" class="js-userlink-target"> guest</a>
</span>

                <span class="timestamp">time</span>
            </div>
            <div class="message">

                message goes here, but this aint done yet
            </div>
        </li>
        <li>
            <div class="avatar"><img alt="" src="/default_avatar.png" title="" /></div>
            <div class="header">
                
<span class="userlink">
    <a href="/~guest" class="js-userlink-target"> guest</a>

</span>

                <span class="timestamp">time</span>
            </div>
            <div class="message">
                message goes here, but this aint done yet
            </div>
        </li>
        <li>
            <div class="avatar"><img alt="" src="/default_avatar.png" title="" /></div>

            <div class="header">
                
<span class="userlink">
    <a href="/~guest" class="js-userlink-target"> guest</a>
</span>

                <span class="timestamp">time</span>
            </div>
            <div class="message">

                Quisque massa tellus, venenatis nec, vestibulum ut, dictum sed, nisi. Maecenas sollicitudin nulla quis dolor. Integer adipiscing bibendum turpis. Sed scelerisque, neque non egestas luctus, nisi magna condimentum dui, non blandit velit nunc id erat. In nec nunc ut leo tincidunt dapibus. Nullam eros. Nulla facilisi. Praesent gravida dui in arcu pulvinar fermentum. Phasellus pretium. Sed fermentum porttitor tortor. 
            </div>
        </li>
    </ul>
</div>
</div>


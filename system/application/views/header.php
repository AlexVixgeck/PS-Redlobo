<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Project Strawberry</title>
    
    
    <link rel="stylesheet" type="text/css" href="/css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="/css/bluePowder.css"/>
	<script src="/js/prototype.js" type="text/javascript"></script>
	<script src="/js/scriptaculous.js" type="text/javascript"></script>
	<script src="/js/fur.js" type="text/javascript"></script>
	<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-4001063-8']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>
</head>
<body>
<p id="skip-to-content"><a href="#content">Skip to content</a></p>
<div id="header">
    <div id="user">
	<?php
	if($is_logged_in == FALSE)
	{
	print ('
        <p>
            Welcome to IndieBeats! Please log in or
            <a href="/auth/register">register</a>.
        </p>

        <form action="/auth/login" method="post">
        <dl class="standard-form">
            <dt>Username</dt>
            <dd><input name="username" type="text" /></dd>
            <dt>Password</dt>
            <dd><input name="password" type="password" /></dd>
        </dl>
	<input type="hidden" name="remember" value="1" />
        <input type="submit" value="Login" />

        </form>');
	}
	else
	{
		print('<div id="user-links">
            <ul>
                <li><a href="/~' . $username .'/settings"><img alt="" src="/images/icons/wrench-screwdriver.png" title="" /> Settings</a></li>

                <li><a href="/~' . $username . '/upload"><img alt="" src="/images/icons/link-upload.png" title="" /> Upload</a></li>
                <li><a href="/~' . $username . '/write"><img alt="" src="/images/icons/link-write.png" title="" /> Write</a></li>
                <li><a href="/~' . $username . '/watchstream"><img alt="" src="/images/icons/link-watchstream.png" title="" /> Watchstream</a></li>
            </ul>
            <ul>
                
                <li> <a href="/~' . $username . '/notes"><img alt="" src="/images/icons/link-notes.png" title="" /> ' . $notes_count . ' new notes</a> </li>

                <li class="new TODO"> <a href=""><img alt="" src="/images/icons/link-comments.png" title="" /> 25 comments</a> </li>
                <li class="new TODO"> <a href="/~' . $username . '/watchstream/new"><img alt="" src="/images/icons/link-messages.png" title="" /> ' . $watchstream_count . ' other</a> </li>
            </ul>
        </div>
		<div id="user-info">

            <form action="/auth/logout" method="post">
            <p>
			<span class="userlink">
    			<a href="/~' . $username . '" class="js-userlink-target">' . $username . '</a>
			</span>
			</p>
            <p id="user-avatar"><img alt="[default avatar]" src="' . $this->cdn->cdn_url() . 'avatars/' . $avatar_location . '" title="' . $username . '" /></p>
            <p><input class="small" type="submit" value="Log out" /></p>
            </form>
        </div>');
	}
	?>
    </div>
    <h1 id="banner"><img alt="" src="/images/banner.png" title="" /></h1>
    <h1 id="logo"><img alt="Project Strawberry" src="/images/ps_logo.png" title="Project Strawberry" /></h1>
   
    <ul id="main-navigation">
		<li><a href="<? echo site_url(); ?>"><img alt="" src="/images/icons/link-browse.png" title="" /> Home</a></li>
        <li><a href="/browse"><img alt="" src="/images/icons/link-browse.png" title="" /> Browse</a></li>
        <li><a href="http://forums.projectstrawberry.com/"><img alt="" src="/images/icons/link-forum.png" title="" /> Forum</a></li>
        <li><a href="/news"><img alt="" src="/images/icons/link-news.png" title="" /> News</a></li>
        <li><a href="http://mantis.projectstrawberry.com/"><img alt="" src="/images/icons/link-wiki.png" title="" /> Support</a></li>

    </ul>
    <div id="css-shadow"></div>
</div>


<div id="content">


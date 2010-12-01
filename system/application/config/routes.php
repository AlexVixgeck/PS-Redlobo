<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
*/

//$route['profile']

/*
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "home";
$route['scaffolding_trigger'] = "";


//CUSTOM INDIEBEATS ROUTES!

//comments
$route['test_comments']							= "gallery/gallery/test_comments";
$route['comments/reply']						= "comments/comments/reply";
$route['comments/reply/([0-9-]+)/([0-9-]+)']	= "comments/comments/reply/$1/$2";
$route['comments/reply/([0-9-]+)/([0-9-]+)/([0-9-]+)']	= "comments/comments/reply/$1/$2/$3";
$route['comments/publish']						= "comments/comments/publish";

//profile home
$route['~([A-Za-z0-9-]+)']						= "profile/profile/index/$1";

//Gallery
$route['browse']								= "gallery/gallery/browse";
$route['browse/([0-9-]+)']						= "gallery/gallery/browse/$1";
$route['~([A-Za-z0-9-]+)/gallery']				= "gallery/gallery/user_gallery/$1";
$route['~([A-Za-z0-9-]+)/gallery/([0-9-]+)']	= "gallery/gallery/user_gallery/$1/$2";
$route['view/([0-9-]+)']						= "gallery/gallery/view/$1";
//$route['testgallery']							= "gallery/gallery/test";
//$route['ajax_gallery']							= "gallery/gallery/ajax_gallery";

//Watchstream
$route['~([A-Za-z0-9-]+)/watchstream']			= "watchstream/watchstream/watchstream_dash/$1";
$route['~([A-Za-z0-9-]+)/watch']				= "watchstream/watchstream/watch/$1";
$route['~([A-Za-z0-9-]+)/list']					= "watchstream/watchstream/index";
//$route['~([A-Za-z0-9-]+)/watchstream/new']		= "watchstream/watchstream/new_watch_data";

//Favorites
$route['fav/([0-9-]+)']							= "favorites/favorites/index/$1";

//Shouts
$route['shouts/post']							= "shouts/shouts/post";

//Submission Upload Stuffs.
$route['~([A-Za-z0-9-]+)/upload']				= "upload/submission/upload/$1";
$route['~([A-Za-z0-9-]+)/metadata']				= "upload/submission/metadata";
$route['~([A-Za-z0-9-]+)/publish']				= "upload/submission/publish";
$route['~([A-Za-z0-9-]+)/resize/([0-9-]+)']		= "upload/submission/upload_dynamic_resize/$2";

//Journals
$route['~([A-Za-z0-9-]+)/journals']				= "journals/journals/index/$1";
$route['~([A-Za-z0-9-]+)/journals/([0-9-]+)']	= "journals/journals/index/$1/$2";
$route['~([A-Za-z0-9-]+)/write']    			= "journals/journals/write";
$route['~([A-Za-z0-9-]+)/publish_journal']  	= "journals/journals/publish";

// profile_user stuff
$route['~([A-Za-z0-9-]+)/dash'] 				= "profile_user/dash/index/$1";
$route['~([A-Za-z0-9-]+)/profile']				= "profile_user/profile/$1";

//$route['~([A-Za-z0-9-]+)/music']				= "profile_user/music/$1";
// profile_settings
$route['~([A-Za-z0-9-]+)/settings']				= "settings/settings/index";
$route['~([A-Za-z0-9-]+)/settings/avatar']		= "avatar/avatar/change_avatar";
$route['settings/avatar_upload']				= "avatar/avatar/avatar_upload";
$route['~([A-Za-z0-9-]+)/settings/info']		= "settings/settings/info";
$route['~([A-Za-z0-9-]+)/settings/update']		= "settings/settings/update";

// notes
$route['~([A-Za-z0-9-]+)/notes']				= "notes/notes/index";
$route['~([A-Za-z0-9-]+)/notes/([0-9-]+)']		= "notes/notes/index/$2";
$route['~([A-Za-z0-9-]+)/notes/read/([0-9-]+)']	= "notes/notes/read/$2";
$route['~([A-Za-z0-9-]+)/notes/write']			= "notes/notes/write";
$route['~([A-Za-z0-9-]+)/notes/send']			= "notes/notes/send";
$route['~([A-Za-z0-9-]+)/notes/sent']			= "notes/notes/sent";
$route['~([A-Za-z0-9-]+)/notes/sent/([0-9-]+)']	= "notes/notes/sent/$2";



/* End of file routes.php */
/* Location: ./system/application/config/routes.php */

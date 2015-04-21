<?PHP
require_once("./include/fg_membersite.php");
require_once("./include/recommendation_site.php");
require_once("./include/personal_site.php");
require_once("./include/movie_site.php");
require_once("./include/movierate_site.php");

$fgmembersite = new FGMembersite();
$recommendationsite = new Recommendationsite();
$personalsite = new Personalsite();
$moviesite = new Moviesite();
$movieratesite = new Movieratesite();

//Provide your site name here
$fgmembersite->SetWebsiteName('user11.com');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('user11@user11.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'users');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('qSRcVS6DrTzrPvr');

//Provide your site name here
$recommendationsite->SetWebsiteName('user11.com');

//Provide the email address where you want to get notifications
$recommendationsite->SetAdminEmail('user11@user11.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$recommendationsite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'user_movies');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$recommendationsite->SetRandomKey('qSRcVS6DrTzrPvr');


//Provide your site name here
$personalsite->SetWebsiteName('user11.com');

//Provide the email address where you want to get notifications
$personalsite->SetAdminEmail('user11@user11.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$personalsite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'users');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$personalsite->SetRandomKey('qSRcVS6DrTzrPvr');


//Provide your site name here
$moviesite->SetWebsiteName('user11.com');

//Provide the email address where you want to get notifications
$moviesite->SetAdminEmail('user11@user11.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$moviesite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'movies');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$moviesite->SetRandomKey('qSRcVS6DrTzrPvr');


//Provide your site name here
$movieratesite->SetWebsiteName('user11.com');

//Provide the email address where you want to get notifications
$movieratesite->SetAdminEmail('user11@user11.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$movieratesite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'user_reviews');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$movieratesite->SetRandomKey('qSRcVS6DrTzrPvr');

?>
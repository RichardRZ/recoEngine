<?PHP
require_once("./include/user_site.php");
require_once("./include/recommendation_site.php");
require_once("./include/personal_site.php");
require_once("./include/movie_site.php");
require_once("./include/movierate_site.php");

$usersite = new Usersite();
$recommendationsite = new Recommendationsite();
$personalsite = new Personalsite();
$moviesite = new Moviesite();
$movieratesite = new Movieratesite();



//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$usersite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'users');



//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$recommendationsite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'movies');




//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$personalsite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'users');


//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$moviesite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'movies');



//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$movieratesite->InitDB(/*hostname*/'localhost',
                      /*username*/'watscuon',
                      /*password*/'mRJi%RL?',
                      /*database name*/'watscuon_dataproject',
                      /*table name*/'user_reviews');


?>
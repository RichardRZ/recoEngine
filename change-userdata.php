<?PHP
require_once("./include/membersite_config.php");

if($fgmembersite->CheckLogin() && isset($_POST['submitted']))
{
   if($personalsite->ChangeUserData($fgmembersite->GetIdFromEmail()))
   {
        $fgmembersite->RedirectToURL("personalpage.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Contact us</title>
    <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
    <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
    <script src="scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<!-- Form Code Start -->
<div id='change-userdatsite'>
<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Personal Information Register</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>



<!--<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>-->
<div class='container'>
    <label for='name' >Name*: </label><br/>
    <input type='text' name='name' id='name' value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
</div>

<div class='container'>
    <label for='age' >Age*:</label><br/>
    <input type='text' name='age' id='age' value='<?php echo $fgmembersite->SafeDisplay('age') ?>' maxlength="50" /><br/>
    <span id='register_age_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='gender' >Gender(Type F/M)*: </label><br/>
    <input type='text' name='gender' id='gender' value='<?php echo $fgmembersite->SafeDisplay('gender') ?>' maxlength="50" /><br/>

    <span id='register_gender_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='occupation' >occupation*: </label><br/>
    <input type='text' name='occupation' id='occupation' value='<?php echo $fgmembersite->SafeDisplay('occupation') ?>' maxlength="50" /><br/>
    <span id='register_occupation_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='zipcode' >zip_code*: </label><br/>
    <input type='text' name='zipcode' id='name' value='<?php echo $fgmembersite->SafeDisplay('zipcode') ?>' maxlength="50" /><br/>
    <span id='register_zipcode_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->



<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>
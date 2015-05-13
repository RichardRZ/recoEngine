<!doctype text/html'>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Jeremy Watson</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

</head>
<body>



    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     

                    <div style="paddinsg-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form action="main.php" method="POST" id="loginform" class="form-horizontal" role="form">

                            <?php
                                if(isset($msg) & !empty($msg)){
                                    echo '<div class="alert alert-warning" role="alert">'.$msg.'</div>';
                                }
                            ?>

                            <?php
                                if(isset($_SESSION['registration_success']) & $_SESSION['registration_success']==true ){
                                    echo '<div class="alert alert-success" role="alert">Registration Successful, please log in.</div>';
                                    $_SESSION['registration_success']=false;
                                }
                            ?>

                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="login-email" type="text" class="form-control" name="email" placeholder="email">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <input id="btn-login" type="submit" class="btn btn-success">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account? 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>




    </div>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/star-rating.js" type="text/javascript"></script>
            <script src="./auto-complete.js"></script>

            <?php 
        require('register.php'); 
        if ( $_SESSION['registration_failed']==true) {
            echo '<script>';
            echo "$(document).ready(function(){ $('#loginbox').hide(); $('#signupbox').show() });";
            echo "</script>";
            $_SESSION['registration_failed']==false;

        }
       ?>
    </body>
</html>
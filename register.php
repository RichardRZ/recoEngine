        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form action="newuser.php" method="POST" id="signupform" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>

                                <?php
                                    if(isset($_SESSION['email_fail']) && $_SESSION['email_fail']==true ){
                                        echo '<div class="alert alert-warning" role="alert">Email already in use!</div>';
                                        $_SESSION['email_fail']=false;
                                    }
                                 ?>
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" name="email" 
                                             placeholder="Email Address" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                                
                               <div class="form-group">
                                    <label for="age" class="col-md-3 control-label">Age</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="age" placeholder="Age" required>
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label for="occupation" class="col-md-3 control-label">Gender</label>
                                    <div class="col-md-9">
                                      <!-- <label for="sel1">Select list:</label> -->
                                      <select name="gender" class="form-control" id="sel1">
                                        <option>Male</option>
                                        <option>Female</option>
                                      </select>
                                    </div>
                                </div>  

                               <div class="form-group">
                                    <label for="occupation" class="col-md-3 control-label">Occupation</label>
                                    <div class="col-md-9">
                                      <!-- <label for="sel1">Select list:</label> -->
                                      <select name="occupation" class="form-control" id="sel1">
                                        <?php require('occupation_list.php') ?>
                                      </select>
                                    </div>
                                </div>                                

                               <div class="form-group">
                                    <label for="zip" class="col-md-3 control-label">ZIP Code</label>
                                    <div class="col-md-9">
                                        <input type="text" pattern="\d*" class="form-control" name="zip" placeholder="00000" required>
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label for="movie1" class="col-md-3 control-label">Movie #1</label>
                                    <div class="col-md-9">
                                        <input type="text"  class="form-control" id="keyword" name="movie1" placeholder="Search" required>
                                        <div id="results" class="list=group">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> Sign Up</button>
                                    </div>
                                </div>
                                
<!--                                 <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group"> -->
                                                                           
                                        
                                </div>
                                
                                
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
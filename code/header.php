<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="main.php">RecMovie</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="main.php">Home</a></li>
              <li><a href="personalpage.php">Personal Profile</a></li>
              <li><a href="recommendation.php">Movie Recommendations</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Explore Data <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="vismap.php">Map of Favorite Movies</a></li>
                  <li><a href="vismap_avg.php">Map of Average Ratings</a></li> 
                  <li><a href="heatmap_avg.php">HeatMap of Average Ratings</a></li>   
                  <li><a href="genders_avg.php">Genre Rating by Gender</a></li>
                </ul>
              </li>
         
              <li><a href="logout.php">Logout</a></li>
            </ul>
           
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
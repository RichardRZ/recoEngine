<?PHP
/*
    Registration/Login script from HTML Form Guide
    V1.0

    This program is free software published under the
    terms of the GNU Lesser General Public License.
    http://www.gnu.org/copyleft/lesser.html
    

This program is distributed in the hope that it will
be useful - WITHOUT ANY WARRANTY; without even the
implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.

For updates, please visit:
http://www.html-form-guide.com/php-form/php-registration-form.html
http://www.html-form-guide.com/php-form/php-login-form.html

*/


class Movieratesite
{
    var $from_address;
    
    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    var $rand_key;
    var $movie_id;
    var $error_message;
    
    //-----Initialization -------

    function setMovieId(){
        $this->movie_id = $_GET["movie_id"];
    }

    function getMovieId(){
        echo 'getmoviid';
        return $this->movie_id;
    }
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }

    function InitUserDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }

    function SetAdminEmail($email)
    {
        $this->admin_email = $email;
    }
    
    function SetWebsiteName($sitename)
    {
        $this->sitename = $sitename;
    }
    
    function SetRandomKey($key)
    {
        $this->rand_key = $key;
    }
    
    //-------Main Operations ----------------------
    
    function CheckLogin()
    {
         if(!isset($_SESSION)){ session_start(); }

         $sessionvar = $this->GetLoginSessionVar();
         
         if(empty($_SESSION[$sessionvar]))
         {
            return false;
         }
         return true;
    }
    
    function UserFullName()
    {
        return isset($_SESSION['name_of_user'])?$_SESSION['name_of_user']:'';
    }

    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }


    function GetAvgRateFromId($id){

        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $id = $this->SanitizeForSQL($id);
        $result = mysql_query("Select avg(rating) as average from $this->tablename where movieid='$id'",$this->connection);  
        if(!$result || mysql_num_rows($result) <= 0)
        {
            return false;
        }
        $row = mysql_fetch_assoc($result);

        
        return isset($row['average'])?$row['average']:'No Rate';
    }

    function GetRatedMoviesFromId($id)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $id = $this->SanitizeForSQL($id);
        
        $result = mysql_query("Select * from $this->tablename where userid='$id'",$this->connection);  
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        
        while($row = mysql_fetch_assoc($result)){

            $valueId = $row['movieid'];
            $valueId = $this->SanitizeForSQL($valueId);
        
            $result1 = mysql_query("Select * from movies where id='$valueId'",$this->connection);  

            if(!$result1 || mysql_num_rows($result1) <= 0)
            {
                $this->HandleError("There is no user with email: $email");
                return false;
            }
            $row1 = mysql_fetch_assoc($result1);
            $valueName = $row1['title'];
            echo '<a href="movie.php?movie_id='.urlencode($valueId).'">'.$valueName.'</a>';
            echo ' ';
        }
        
        return;
    }

    function rateMovie($id,$rate,$userid)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        echo $id;
        $id = $this->SanitizeForSQL($id);

        $result = mysql_query("Select * from $this->tablename where movieid='$id' and userid='$userid'",$this->connection);  
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $insert_query = 'Insert into '.$this->tablename.' values ( 
                ' . $this->SanitizeForSQL($userid) . ',
                ' . $this->SanitizeForSQL($id) . ',
                ' . $this->SanitizeForSQL($rate) . ');' ;
            
            if(!mysql_query( $insert_query ,$this->connection))
            {
                $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
                return false;
            }        
            return true;
        }
        else
        {
            $update_query = 'update '.$this->tablename.' SET 
                rating = "' . $this->SanitizeForSQL($rate) . '"
                WHERE userid = ' . $this->SanitizeForSQL($userid) . ' and movieid =
                ' . $this->SanitizeForSQL($id) . ';' ;
            
            if(!mysql_query( $update_query ,$this->connection))
            {
                $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
                return false;
            }        
            return true;
        }

        
    }

    
    
    //-------Public Helper functions -------------
    
    //-------Private Helper functions-----------
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err)
    {
        $this->HandleError($err."\r\n mysqlerror:".mysql_error());
    }
    
    
    
    function GetLoginSessionVar()
    {
        $retvar = md5($this->rand_key);
        $retvar = 'usr_'.substr($retvar,0,10);
        return $retvar;
    }
    
    function CheckLoginInDB($username,$password)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }          
        $username = $this->SanitizeForSQL($username);
        $pwdmd5 = md5($password);
        $qry = "Select id_user, name, email from $this->tablename where username='$username' and password='$pwdmd5' and confirmcode='y'";
        
        $result = mysql_query($qry,$this->connection);
        
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }
        
        $row = mysql_fetch_assoc($result);
        
        
        $_SESSION['name_of_user']  = $row['name'];
        $_SESSION['email_of_user'] = $row['email'];
        
        return true;
    }
    
    
    
    function GetUserFromEmail($email,&$user_rec)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        $email = $this->SanitizeForSQL($email);
        
        $result = mysql_query("Select * from $this->tablename where email='$email'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no user with email: $email");
            return false;
        }
        $user_rec = mysql_fetch_assoc($result);

        
        return true;
    }

    
    function DBLogin()
    {

        $this->connection = mysql_connect($this->db_host,$this->username,$this->pwd);

        if(!$this->connection)
        {   
            $this->HandleDBError("Database Login failed! Please make sure that the DB login credentials provided are correct");
            return false;
        }
        if(!mysql_select_db($this->database, $this->connection))
        {
            $this->HandleDBError('Failed to select database: '.$this->database.' Please make sure that the database name provided is correct');
            return false;
        }
        if(!mysql_query("SET NAMES 'UTF8'",$this->connection))
        {
            $this->HandleDBError('Error setting utf8 encoding');
            return false;
        }
        return true;
    }    
    
    
    
    
    
    function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
 /*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
    function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }    
    function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }    
}
?>
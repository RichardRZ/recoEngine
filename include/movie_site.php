<?PHP


class Moviesite
{

    var $username;
    var $pwd;
    var $database;
    var $tablename;
    var $connection;
    
    var $error_message;

    
    
    //-----Initialization -------
    
    function InitDB($host,$uname,$pwd,$database,$tablename)
    {
        $this->db_host  = $host;
        $this->username = $uname;
        $this->pwd  = $pwd;
        $this->database  = $database;
        $this->tablename = $tablename;
        
    }

    //-------Main Operations ----------------------
    
    function UserEmail()
    {
        return isset($_SESSION['email_of_user'])?$_SESSION['email_of_user']:'';
    }

    

    function GetTitleFromId($id)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        
        $result = mysql_query("Select title from $this->tablename where id='$id'",$this->connection);  
        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no result");
            return false;
        }
        $row = mysql_fetch_assoc($result);

        
        return $row['title'];
    }
    function GetReleaseFromId($id)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        
        $result = mysql_query("Select release_date from $this->tablename where id='$id'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no result");
            return false;
        }
        $row = mysql_fetch_assoc($result);

        
        return $row['release_date'];
    }
    function GetCatFromId($id)
    {
        if(!$this->DBLogin())
        {
            $this->HandleError("Database login failed!");
            return false;
        }   
        
        $result = mysql_query("Select * from $this->tablename where id='$id'",$this->connection);  

        if(!$result || mysql_num_rows($result) <= 0)
        {
            $this->HandleError("There is no result");
            return false;
        }
        $row = mysql_fetch_assoc($result);
        $str = "";
        $row['unknown']==1?$str = $str.' unknown':'';
        $row['action']==1?$str = $str.' action':'';
        $row['adventure']==1?$str =$str.' adventure':'';
        $row['animation']==1?$str =$str.' animation':'';
        $row['childrens']==1?$str =$str.' childrens':'';
        $row['comedy']==1?$str =$str.' comedy':'';
        $row['crime']==1?$str =$str.' crime':'';
        $row['documentary']==1?$str =$str.' documentary':'';
        $row['drama']==1?$str =$str.' drama':'';
        $row['fantasy']==1?$str =$str.' fantasy':'';
        $row['filmnoir']==1?$str =$str.'filmnoir':'';
        $row['horror']==1?$str =$str.' horror':'';
        $row['musical']==1?$str =$str.' musical':'';
        $row['mystery']==1?$str =$str.' mystery':'';
        $row['romance']==1?$str =$str.' romance':'';
        $row['scifi']==1?$str =$str.' scifi':'';
        $row['thriller']==1?$str =$str.' thriller':'';
        $row['war']==1?$str =$str.' war':'';
        $row['western']==1?$str =$str.' western':'';

        
        return $str;
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
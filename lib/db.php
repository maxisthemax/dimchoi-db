<?php
// Class database
class database 
{
    function database($dbhost, $dbuser, $dbpass, $db) 
    {
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
        if (!$this->connection || !mysqli_select_db($this->connection,$db)) 
        {
            return false;
        } 
        else 
        {
            return true;
        }
    }

    function query($sql) 
    {
        $query = mysqli_query($this->connection,$sql);        
        while ($row = mysqli_fetch_assoc($query)) 
        {
            $return[] = $row;
        }       
        if (!empty($return)) 
        {
            return $return;
        } else {
            return false;
        }  
        mysqli_free_result($query);               
    }

    function insert($sql) 
    {   mysqli_autocommit($this->connection, FALSE);
            if (mysqli_query($this->connection,$sql) === TRUE) {
                mysqli_commit($this->connection);  
                return true;
            } else {
                return false;
            }
    }
    function close() 
    {
        mysqli_close($this->connection);
    }
}
?>
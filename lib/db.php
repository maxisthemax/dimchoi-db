<?php
// Class database
class database 
{
    function database($dbhost, $dbuser, $dbpass, $db) 
    {
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass, $db);
        mysqli_set_charset($this->connection,"utf8");
        if (!$this->connection || !mysqli_select_db($this->connection,$db)) 
        {
            echo mysqli_error($this->connection);
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
            echo mysqli_error($this->connection);
        }  
        mysqli_free_result($query);               
    }

    function update($sql) 
    {
        if (mysqli_query($this->connection,$sql) === TRUE) 
        {
            mysqli_commit($this->connection);  
            return true;
        } 
        else 
        {
            echo mysqli_error($this->connection);
        }
    }
    function insert($sql) 
    {   mysqli_autocommit($this->connection, FALSE);
            if (mysqli_query($this->connection,$sql) === TRUE) {
                $last_id = mysqli_insert_id($this->connection);
                mysqli_commit($this->connection); 
                return $last_id;
            } else {
                echo mysqli_error($this->connection);
            }
    }
    function delete($sql) 
    {
        if (mysqli_query($this->connection,$sql) === TRUE) 
        {
            mysqli_commit($this->connection);  
            return true;
        } 
        else 
        {
            echo mysqli_error($this->connection);
        }
    }   
    function close() 
    {
        mysqli_close($this->connection);
    }
}
?>
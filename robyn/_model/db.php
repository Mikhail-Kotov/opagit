<?php

class DB {

    private $link;

    function connectDB() {
        $this->link = mysql_connect('127.0.0.1', 'root', 'root');
        if (!$this->link) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db('opadmin');
    }

    function closeDB() {
        mysql_close($this->link);
    }
    
    function query($query) {
        $sql = mysql_query($query);
        if (!$sql) {
            die('Invalid query: ' . mysql_error());
        }

        while ($arr[] = mysql_fetch_array($sql, MYSQL_ASSOC));
        
        unset($arr[(count($arr) - 1)]);
        
        return $arr;
    }
    
    function restoreDB() {
    
    }

}

?>

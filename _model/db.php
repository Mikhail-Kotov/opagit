<?php

class DB {

    private $link;

    function connectDB() {
    	 $this->link = mysql_connect('localhost', 'opadmin', 'Hu3bi9');
        if (!$this->link) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db('opadmin');
    }

    function closeDB() {
        mysql_close($this->link);
    }
    
    function query($query) { // add please validation here
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

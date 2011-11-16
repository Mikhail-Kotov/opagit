<?php

class DB {

    private $link;

    function connectDB() {
        $filename = "../../../../db_credentials.txt";
        
        $is_stable = strpos($_SERVER["SCRIPT_NAME"], "/stable/");
        
        if ($is_stable !== false) {
            $dbname = 'opadmin';
        } else {
            $dbname = 'opadmindev';
            $filename = "../" . $filename; // For directories inside dev/
        }
        
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);

        list($server, $login, $pass) = explode(",", $contents);

        $this->link = mysql_connect($server, $login, $pass);
        if (!$this->link) {
            die('Could not connect: ' . mysql_error());
        }

        mysql_select_db($dbname);
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

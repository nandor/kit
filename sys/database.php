<?php

    /**
        Database driver - singleton class, made nicer
        width some PHP voodoo
    */
    class DB
    {   
        private $conn;
        
        private function __construct()
        {
            global $cfg;
               
            $this->conn = mysql_connect($cfg['db']['host'], $cfg['db']['user'], $cfg['db']['pass']);
            mysql_select_db($cfg['db']['name'], $this->conn);
        }
        
        public function __destruct()
        {
            mysql_close($this->conn);
        }        
        
        private function query($command, $args)
        {

        }
        
        private function select($table, $arguments)
        {
            // Build the query
            $query = "SELECT * FROM `$table` WHERE ";
            
            $arg_count = count($arguments);         
            $count = 0;           
            
            foreach ($arguments as $name => $value)
            {
                $query .= "`$name` = '".mysql_real_escape_string($value)."'";
                $count++;
                
                if ($count < $arg_count)
                {
                    $query .= " AND ";
                }
            }
            
            $result = mysql_query($query);
            
            if (!$result)
            {
                return false;
            }
            
            return mysql_fetch_array($result, MYSQL_ASSOC);
        }
        
        private function update($table, $id, $data)
        {
            $query = "UPDATE `$table` SET";
            
            $arg_count = count($data);         
            $count = 0;    
                   
            foreach ($data as $name => $value)
            {
                $query .= " `$name` = '".mysql_real_escape_string($value)."'";
                $count++;
                
                if ($count < $arg_count)
                {
                    $query .= ", ";
                }            
            }
            
            $query .= " WHERE `id` = '$id'";
            
            if (!mysql_query($query))
            {
                throw new Exception("Cannot UPDATE database!");
            }
        }
        
        private static $inst = null;     
        public static function __callStatic($method, $args)
        {
            if (DB::$inst == null)
            {
                DB::$inst = new DB();
            }
            
            return call_user_func_array(array(DB::$inst, $method), $args);
        }
    }

?>


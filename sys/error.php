<?php
    /**
        Exception & error handlers go here
        
    */
    
    function exception_handler($exception)
    {
        global $cfg;
        
        include ($cfg['error_page']);
        return true;
    }
    
    function error_handler($errno, $errstr, $errfile, $errline)
    {
        throw new Exception($errstr);
    }
    
    set_error_handler('error_handler');
    set_exception_handler('exception_handler');
    
?>

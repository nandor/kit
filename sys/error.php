<?php
    /**
        Exception & error handlers go here
        
    */
    
    function exception_handler($exception)
    {
        error_handler(
            E_USER_ERROR, 
            $exception->getMessage(), 
            $exception->getFile(), 
            $exception->getLine()
        );
    }
    
    function error_handler($errno, $errstr, $errfile, $errline)
    {
        echo "[$errfile:$errline]: $errstr";
        
        return true;
    }
    
    set_error_handler('error_handler');
    set_exception_handler('exception_handler');
    
?>

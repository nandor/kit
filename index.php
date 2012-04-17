<?    
    /**
        Main file of the kit project
        
        This is the file where you can set up
        the routes
    */
    
    include ('config.php');
    
    include ('sys/common.php');
    include ('sys/model.php');
    include ('sys/controller.php');
    include ('sys/router.php');
    
    set_include_path(get_include_path().PATH_SEPARATOR.__DIR__);    
    
    try {
        $router = new Router();
        
        $router->pattern('/', 'HomeController::index'); 
        
        $router->pattern('/user/', 'UserController::user');  
        $router->pattern('/user/$id/', 'UserController::user'); 
        
        $router->route($_SERVER['REQUEST_URI']);    
    } catch (Exception $e) {
        echo $e;
    }
    
?>

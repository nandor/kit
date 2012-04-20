<?    
    /**
        Main file of the kit project
                
        This is the file where you can set up
        the routes
    */
    
    include ('config.php');
    
    include ('sys/error.php');
    include ('sys/database.php');
    include ('sys/common.php');
    include ('sys/model.php');
    include ('sys/controller.php');
    include ('sys/router.php');
    
    $router = new Router();
    
    $router->pattern('/', 'HomeController::index');     
    $router->pattern('/login', 'UserController::login');  
    $router->pattern('/logout', 'UserController::logout');      
    $router->pattern('/user', 'UserController::user');  
    $router->pattern('/user/upload/$ext', 'UserController::upload');      
    $router->pattern('/profile/$id', 'UserController::profile'); 
    $router->pattern('/timeline/', 'TimelineController::index');
    
    $router->route($_SERVER['REQUEST_URI']);  
    
?>

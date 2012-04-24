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
    
    // Homepage
    $router->pattern('/', 'HomeController::index');     
   
    // Authentication
    $router->pattern('/login', 'UserController::login');  
    $router->pattern('/logout', 'UserController::logout');     
    $router->pattern('/register', 'UserController::register');
    
    // Profile display 
    $router->pattern('/profile/$id', 'UserController::profile'); 
    
    // Profile edit
    $router->pattern('/user/edit', 'UserController::user');          
    $router->pattern('/user/save', 'UserController::save');  
    $router->pattern('/user/upload/$ext', 'UserController::save_picture'); 
    
    // Timeline
    $router->pattern('/timeline/', 'TimelineController::display');
    $router->pattern('/timeline/$list', 'TimelineController::display');
    
    // Groups
    $router->pattern('/group/$id', 'GroupController::display_group');
    
    // REST API
    $router->pattern('/api/user/$id', 'APIController::get_user');
    
    $router->route($_SERVER['REQUEST_URI']);  
    
?>

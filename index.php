<?    
    /**
        Main file of the kit project
                
        This is the file where you can set up
        the routes
    */
    
    include ('config.php');
    
    include ('sys/database.php');
    include ('sys/common.php');
    include ('sys/model.php');
    include ('sys/controller.php');
    include ('sys/router.php');
    
    try
    {        
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
        $router->pattern('/timeline/', 'TimelineController::user');
        $router->pattern('/timeline/$id', 'TimelineController::user');
        $router->pattern('/timeline/group', 'TimelineController::group');
        $router->pattern('/timeline/group/$id', 'TimelineController::group');
        
        // Statistics
        $router->pattern('/search/', 'StatisticsController::search');
        $router->pattern('/filter/', 'APIController::filter');
        
        // Groups
        $router->pattern('/group/$id', 'GroupController::display');
		$router->pattern('/group/edit/$id', 'GroupController::edit');
		$router->pattern('/group/save', 'GroupController::save');
        
        // REST API
        $router->pattern('/api/user/$id', 'APIController::get_user');
        $router->pattern('/api/search/', 'APIController::search');
        $router->pattern('/api/search/$what', 'APIController::search');
        $router->pattern('/api/filter/', 'APIController::filter');
        
        // Facebook channel file
        $router->pattern('/fb_channel.html', 'HomeController::fb_channel');
        
        // Other pages
        $router->pattern('/credits', 'HomeController::credits');
        $router->pattern('/license', 'HomeController::license');
        $router->pattern('/help', 'HomeController::help');
        
        $router->route($_SERVER['REQUEST_URI']);  
    }
    catch (Exception $exception)
    {
        include ($cfg['error_page']);
    }    
?>

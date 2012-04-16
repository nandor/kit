<?    
    /**
        Main file of the kit project
        
        This is the file where you can set up the routes
    */
    
    include ('router.php');
    include ('config.php');
    
    try {
        $router = new Router();
        
        $router->pattern('/', 'home.php', 'index');    
        $router->pattern('/:login', 'home.php', 'login')
     
        $router->route($_SERVER['REQUEST_URI']);    
    } catch (Exception $e) {
        echo $e;
    }
?>

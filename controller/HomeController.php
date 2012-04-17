<?php
    /**
        Home controller
    */
    class HomeController extends Controller 
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $this->render_view('head.php');
            $this->render_view('index.php');
            $this->render_view('footer.php');
        }     
    };
?>

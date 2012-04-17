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
            $this->view_args(array(
                'user' => null
            ));
            $this->render_view('head.php');
            $this->render_view('index.php');
        }     
    };
?>

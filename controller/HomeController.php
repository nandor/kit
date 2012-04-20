<?php
    /**
        Home controller
    */
    class HomeController extends Controller 
    {
        public function __construct()
        {
            parent::__construct();
            $this->user = Model::load('UserModel');
        }
        
        public function index()
        {
            $this->scripts = array(
                url('script/jquery.js'), 
                url('script/user.js')
            );
            $this->render_view('head');
            $this->render_view('index');
        }     
    };
?>

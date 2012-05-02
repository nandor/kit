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
                url('script/main.js'),
                url('script/searchbox.js')
            );
            
            $this->render_view('head');
            $this->render_view('index');
        }
        
        public function license()
        {
            $this->render_view('head');
            $this->render_view('license');
        }     
        
        public function help()
        {
            $this->render_view('head');
            $this->render_view('help');
        }     
        
        public function fb_channel()
        {
            global $cfg;
            header("Pragma: public");
            header("Cache-Control: max-age={$cfg['cache_expire']}");
            header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cfg['cache_expire']) . ' GMT');
            $this->render_view('fb_channel');
        }
    };
?>

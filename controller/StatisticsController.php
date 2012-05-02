<?php
    /**
        Controller for statistics
    */
    class StatisticsController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->user = Model::load('UserModel');
            $this->perPage = 25;
        }
        
        public function index()
        {
            $this->scripts = array(           
                url('script/jquery.js'),    
                url('script/statistics.js')
            );
            
       		$this->data = $this->user->get_range(0, $this->perPage, 'full_name');
            $this->render_view('head');
            $this->render_view('statistics');
        }
    };
    
?>
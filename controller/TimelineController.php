<?php
    
    class TimelineController extends Controller
    {
        public function __construct()
        {
            parent::__construct();            
            $this->user = Model::load('UserModel');
        }
        
        public function index()
        {            
            $this->timeline_data = DB::query(
                "SELECT * FROM `timeline` WHERE 
                `user` = '{$this->user->id}' 
                ORDER BY `date` ASC"
            );
                        
            $this->render_view('head');
            $this->render_view('timeline');
        } 
    };

?>

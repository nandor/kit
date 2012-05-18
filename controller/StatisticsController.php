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
            $this->perPage = 1;
           
        }
        
        public function search()
        {
            global $cfg;
            
            $this->scripts = array(        
                url('script/search.js')
            );
            
            $this->variables = array(
            	"site_url" => "\"{$cfg['host']}{$cfg['base_url']}/ \"",
            );
            
       		$this->data = $this->user->get_range(0, $cfg['per_page'], 'full_name');
            $this->render_view('head');
            $this->render_view('search');
        }
    };
    
?>

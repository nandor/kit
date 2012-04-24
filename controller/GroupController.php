<?php
    /**
        Controller for user groups
    */
    class GroupController extends Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        public function display_group($id)
        {
            $this->scripts = array(
                url('script/jquery.js')
            );
            
            $this->render_view('head');
            $this->render_view('group_view');
        }    
    };

?>

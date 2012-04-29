<?php
    /**
        CV controller
    */
    class CVController extends Controller 
    {
        public function __construct()
        {
            parent::__construct();
            $this->user = Model::load('UserModel');
        }
        
        public function view()
        {
            $this->scripts = array(
                url('script/jquery.js'), 
                url('script/cv.js')
            );
            
            $this->render_view('head');
            $this->render_view('cv_view');
        }
        
        public function save()
        {
        
        }
        
        public function export()
        {
            $pdf = PDF_new();

            pdf_open_file($pdf);
            pdf_begin_page($pdf, 595, 842);
            pdf_set_font($pdf, "Times-Roman", 30, "host");
            pdf_set_value($pdf, "textrendering", 1);
            pdf_show_xy($pdf, "LOOOL", 50, 750);
            pdf_end_page($pdf);
            pdf_close($pdf);

            $data = pdf_get_buffer($pdf);

            header("Content-type: application/pdf");
            header("Content-disposition: inline; filename=cv_{$this->user->name}.pdf");
            header("Content-length: " . strlen($data));
            print($data);
        }
    };
?>

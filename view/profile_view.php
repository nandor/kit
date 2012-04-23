<div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile'); ?>       
            </div> 
            <div id = "content">
                <? var_dump($this->user_data); ?>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>

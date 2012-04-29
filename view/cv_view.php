        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content">
                <? $this->render_view('messages'); ?>
                <h1> CV </h1>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>

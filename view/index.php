        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?> 
            </div> 
            <div id = "content">
                <? $this->render_view('messages'); ?>
                <h1> Keep In Touch </h1>
                This site is intended to help keep university students in touch.
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>

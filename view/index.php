        <div id = "container">
            <div id = "sidebar">
                <? if (!$this->user->logged_in()): ?>
                <div id = "login">
                    <h3> Login </h3>
                    <form method = "POST" action = "<?=url('login');?>">
                        <div><input name = "user" type = "text" placeholder = "Username"/></div>
                        <div><input name = "pass" type = "password" placeholder = "Password"/></div>
                        <div>
                            <input type = "submit" value = "Login" />
                            <a href = "register"> Need an account? </a>
                        </div>
                    </form>                    
                </div>
                <? else: ?>
                <? $this->render_view('profile'); ?> 
                <? endif; ?>
            </div> 
            <div id = "content">
                <h1> Keep In Touch </h1>
                This site is intended to help keep university students in touch.
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>

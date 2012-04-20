        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile'); ?>       
            </div> 
            <form method = "POST" action = "">
                <div id = "content">
                    <h3> Profile picture </h3>
                    <div id = 'upload'>   
                        <div class = "drop_normal">
                            <img class = "preview" width = "120" height = "120"/>
                            <div class = "text">Drag here to upload</div>
                            <div class = "drop_zone"></div>
                        </div>
                        <div class = 'progress'>
                            <div></div>
                        </div>
                    </div>
                    <h3> Address </h3>
                    <div id = "address">
                        <input type = "text" placeholder = "Street, Town, Country"/>
                        <div class = "addr_map"></div>
                    </div>
                    <h3> Visibility </h3>
                    Public/private stuff
                    <input type = "submit" value = "Submit" />
                </div>
            </form>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>

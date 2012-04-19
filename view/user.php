        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile'); ?>       
            </div> 
            <div id = "content">
                <div class = 'upload'>   
                    <div class = "drop_normal">
                        <img class = "preview" width = "120" height = "120"/>
                        <div class = "text">Drag here to upload</div>
                        <div class = "drop_zone"></div>
                    </div>
                    <div class = 'progress'>
                        <div></div>
                    </div>
                </div>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>

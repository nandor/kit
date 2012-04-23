        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?>       
            </div> 
            <form method = "POST" action = "">
                <div id = "content" class = 'profile_edit'>
                    <div class = 'row'>
                        <div class = 'title'>
                            Profile picture
                        </div>
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
                    </div>
                    <form method = "POST" action = "<?=url('user/save');?>">
                        <div class = 'row'>
                            <div class = 'title'>
                                Address
                            </div>
                            <div id = "address">
                                <input type = "text" name = "address" placeholder = "Street, Town, Country"/>
                                <div class = "addr_map"></div>
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class = 'title'>
                                University
                            </div>
                            <div id = "university">
                                <input type = "text" name = "university" placeholder = "University"/>
                                <input type = "text" name = "faculty" placeholder = "Faculty"/>
                                <input type = "text" name = "group" placeholder = "Group"/>
                            </div>
                        </div>
                        <div class = 'row'>
                            <div class = 'title'>
                                Visibility
                            </div>
                            <select name = "visibility">
                                <option value = "public">Public</option>
                                <option value = "private">Private</option>
                            </select>
                        </div>
                        <div class = 'row'>
                            <div class = 'title'>
                                Save
                            </div>
                            <input type = "submit" value = "Submit" />
                        </div>
                    </form>
                </div>
            </form>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>

        <div id="fb-root"></div>
        <script>
            var fb_app_id = <?=$cfg['fb']['app_id'];?>;
            var fb_channel_url = "<?=$cfg['fb']['channel_file'];?>";
            var fb_scope = "<?=$cfg['fb']['scope'];?>";
            
            var google_client_id = "<?=$cfg['google']['client_id'];?>";
            var google_scopes = "<?=$cfg['google']['scopes'];?>";
            
        </script>
        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?>       
            </div> 
            <div id = "content" class = 'profile'>
                <? $this->render_view('messages'); ?>
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
                            Full Name
                        </div>
                        <div id = "full_name">
                            <input type = "text" name = "full_name" placeholder = "Full Name"/>
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'>
                            Email Address
                        </div>
                        <div id = "email">
                            <input type = "email" name = "email" placeholder = "Email Address"/>
                        </div>
                    </div>
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
                            Education
                        </div>
                        <div id = "university">
                            <input type = "text" name = "university" placeholder = "Institution"/>
                            <input type = "text" name = "group" placeholder = "Class / Group"/>
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'>
                            Workplace
                        </div>
                        <div id = "workplace">
                            <input type = "text" name = "workplace" placeholder = "Company/Institution name"/>
                            <input type = "text" name = "job" placeholder = "Job"/>
                        </div>
                    </div>
                    <div class = 'row'>
                        <div class = 'title'>
                            Interests
                        </div>
                        <div id = "workplace">
                            <input type = "text" name = "hobby" placeholder = "Hobbies"/>
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
                <div class = 'row'>
                    <div class = 'title'>
                        Import
                    </div>
                    <a id = "facebook_import"><img src = "<?=url('img/fb.png');?>" /></a>
                    <a id = "google_import"><img src = "<?=url('img/g.png');?>" /></a>
                </div>
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>

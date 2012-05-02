        <div id = "container">
            <div id = "sidebar">
                <? $this->render_view('profile_short'); ?>       
            </div> 
            <div id = "content" class = 'profile' itemscope itemtype="http://schema.org/Person">
                <div style = "visibility:hidden" itemprop = "url"><?=url("profile/{$this->user->id}");?></div>
                <div class = 'row'>
                    <div class = 'value'>
                        <img width = "130" height = "130" alt = "profile" itemprop = "image" src = "
                            <?=$this->user_data['profile'] ? content($this->user_data['profile']) : url('img/pdef.png');?>" />
                    </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Full Name </div>
                    <div class = 'value' itemprop = 'name'> <?=$this->user_data['full_name'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Email Address </div>
                    <div class = 'value' itemprop = 'email'> <?=$this->user_data['email'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Birthday </div>
                    <div class = 'value' itemprop = 'birthDate'> <?=date("F j, o", strtotime($this->user_data['birthday']));?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Date joined </div>
                    <div class = 'value' itemprop = 'dateCreated'> <?=date("F j, o", $this->user_data['time_registered']);?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Address </div>
                    <div class = 'value' itemprop = 'address'> <?=$this->user_data['address'];?> </div>
                </div>
                <div class = 'row'>
                    <div class = 'title'> Trail </div>
                    <div class = 'value'>
                        <div id = "trail"></div>
                        <script type = "text/javascript">
                            var trail = [
                            <?php
                                foreach($this->user_trail as $location)
                                {
                                    print("\"{$location['value']}\",");
                                }
                            ?>
                            ];
                        </script>
                    </div>
                </div>  
            </div>
            <? $this->render_view('footer'); ?>
        </div>
    </body>
</html>
